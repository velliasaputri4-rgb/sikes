<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class SipintuService
{
    public function ping(): array
    {
        $startedAt = microtime(true);
        try {
            $response = $this->client(config('sipintu.timeout_ping', 10))->get('/api/v1/ping', [
                'client_id' => config('sipintu.client_id'),
            ]);
        } catch (\Throwable $e) {
            if ($this->isTimeout($e->getMessage())) {
                throw new \RuntimeException('Tes koneksi SiPintu melewati batas waktu ' . config('sipintu.timeout_ping', 10) . ' detik.', 504, $e);
            }

            throw new \RuntimeException($this->messageForException($e), (int) $e->getCode(), $e);
        }

        if ($response->failed()) {
            $payload = $response->json();
            $message = $payload['message'] ?? $payload['error'] ?? 'Gateway SiPintu tidak merespons.';
            throw new \RuntimeException($this->messageForResponse($response->status(), $message), $response->status());
        }

        $payload = $response->json() ?? [];

        return [
            'status' => $payload['status'] ?? 'ok',
            'latency_ms' => (int) round((microtime(true) - $startedAt) * 1000),
            'data' => $payload,
        ];
    }

    public function validateClient(): array
    {
        $response = $this->client()->post('/api/v1/validate-client', [
            'client_id' => config('sipintu.client_id'),
            'client_secret' => config('sipintu.client_secret'),
        ]);

        $payload = $response->json() ?? [];

        if ($response->successful()) {
            return [
                'valid' => true,
                'data' => $payload['data'] ?? $payload,
            ];
        }

        return [
            'valid' => false,
            'message' => $payload['message'] ?? $payload['error'] ?? 'Kredensial SiPintu tidak valid.',
        ];
    }

    public function fetchStudents(bool $forceRefresh = false): array
    {
        $cacheKey = 'sipintu:students:fetch';
        if ($forceRefresh) {
            cache()->forget($cacheKey);
        }

        $cached = cache()->get($cacheKey);
        if (is_array($cached)) {
            return $cached;
        }

        $response = $this->requestStudentsPage();
        $payload = $response['payload'];
        if (! isset($payload['data']) || ! is_array($payload['data']) || ! array_is_list($payload['data'])) {
            throw new \RuntimeException('Format data siswa SiPintu tidak dikenali.', 422);
        }

        $results = array_values(array_filter($payload['data'], 'is_array'));
        cache()->put($cacheKey, $results, config('sipintu.cache_ttl', 600));

        return $results;
    }

    protected function requestStudentsPage(): array
    {
        for ($attempt = 0; $attempt <= config('sipintu.retry', 1); $attempt++) {
            try {
                $response = $this->client()->get('/api/v1/sijuna/students', [
                    'limit' => 5000,
                    'page' => 1,
                ]);

                if ($response->successful()) {
                    return ['payload' => $response->json() ?? [], 'status_code' => $response->status()];
                }

                $status = $response->status();
                $payload = $response->json() ?? [];
                $message = $payload['message'] ?? $payload['error'] ?? 'Gagal mengambil data siswa dari SiPintu.';

                if ($status >= 500 && $attempt < config('sipintu.retry', 1)) {
                    usleep(300000);
                    continue;
                }

                throw new \RuntimeException($this->messageForResponse($status, $message), $status);
            } catch (\Throwable $e) {
                $message = $e->getMessage();
                if ($this->isTimeout($message)) {
                    throw new \RuntimeException('SiPintu terlalu lama merespons (lebih dari ' . config('sipintu.timeout_fetch', 120) . ' detik). Server SiPintu sedang lambat. Coba lagi beberapa saat atau hubungi admin SiPintu.', 504);
                }

                if ($this->isConnectionError($message) && $attempt < config('sipintu.retry', 1)) {
                    usleep(300000);
                    continue;
                }

                throw new \RuntimeException($this->messageForException($e), $e->getCode(), $e);
            }
        }

        throw new \RuntimeException('Gagal mengambil data siswa dari SiPintu.');
    }

    public function fetchTeachers(): array
    {
        $page = 1;
        $results = [];

        while (true) {
            $response = $this->client()->get('/api/v1/sijuna/teachers', [
                'limit' => 500,
                'page' => $page,
            ]);

            if ($response->failed()) {
                $payload = $response->json();
                $message = $payload['message'] ?? $payload['error'] ?? 'Gagal mengambil data guru dari SiPintu.';
                throw new \RuntimeException($message);
            }

            $payload = $response->json() ?? [];
            $items = $this->extractListFromPayload($payload);

            if (empty($items)) {
                break;
            }

            foreach ($items as $item) {
                if (is_array($item)) {
                    $results[] = $item;
                }
            }

            if (! $this->hasNextPage($payload, $page)) {
                break;
            }

            $page++;
        }

        return $results;
    }

    public function mapStudentRow(array $row): array
    {
        return [
            'nis' => $this->resolveMappedValue($row, 'nis'),
            'full_name' => $this->resolveMappedValue($row, 'full_name'),
            'address' => $this->resolveMappedValue($row, 'address'),
            'classroom_name' => $this->resolveMappedValue($row, 'classroom_name'),
        ];
    }

    protected function messageForResponse(int $status, string $message): string
    {
        return match ($status) {
            401, 403 => 'Kredensial SiPintu ditolak. Periksa SIPINTU_CLIENT_ID dan SIPINTU_CLIENT_SECRET di .env, lalu php artisan config:clear.',
            404 => 'Endpoint data siswa SiPintu tidak ditemukan. Periksa versi API atau URL gateway.',
            429 => 'Terlalu banyak permintaan ke SiPintu. Tunggu beberapa menit lalu coba lagi.',
            422 => 'Format data siswa SiPintu tidak dikenali.',
            default => $status >= 500
                ? 'Server SiPintu sedang bermasalah (HTTP ' . $status . '). Coba lagi nanti.'
                : $message,
        };
    }

    protected function messageForException(\Throwable $e): string
    {
        $message = $e->getMessage();
        if ($this->isTimeout($message)) {
            return 'SiPintu terlalu lama merespons (lebih dari ' . config('sipintu.timeout_fetch', 120) . ' detik). Server SiPintu sedang lambat. Coba lagi beberapa saat atau hubungi admin SiPintu.';
        }

        if ($this->isConnectionError($message)) {
            return 'Tidak dapat terhubung ke SiPintu. Periksa koneksi internet dan alamat SIPINTU_BASE_URL.';
        }

        if (in_array((int) $e->getCode(), [401, 403, 404, 422, 429], true)) {
            return $this->messageForResponse((int) $e->getCode(), $message);
        }

        return $message ?: 'Format data siswa SiPintu tidak dikenali.';
    }

    protected function isTimeout(string $message): bool
    {
        $message = strtolower($message);

        return str_contains($message, 'timed out')
            || str_contains($message, 'operation timed out')
            || str_contains($message, 'curl error 28');
    }

    protected function isConnectionError(string $message): bool
    {
        $message = strtolower($message);

        return str_contains($message, 'connection')
            || str_contains($message, 'could not resolve host')
            || str_contains($message, 'failed to open stream');
    }

    protected function resolveMappedValue(array $row, string $field): mixed
    {
        $map = config('sipintu.field_map.' . $field, []);

        foreach ($map as $key) {
            if (str_contains($key, '.')) {
                $segments = explode('.', $key);
                $value = $row;
                foreach ($segments as $segment) {
                    if (is_array($value) && array_key_exists($segment, $value)) {
                        $value = $value[$segment];
                    } else {
                        $value = null;
                        break;
                    }
                }
                if ($value !== null) {
                    return $value;
                }
                continue;
            }

            if (array_key_exists($key, $row)) {
                return $row[$key];
            }

            $camel = Str::camel($key);
            if (array_key_exists($camel, $row)) {
                return $row[$camel];
            }

            $snake = Str::snake($key);
            if (array_key_exists($snake, $row)) {
                return $row[$snake];
            }
        }

        return null;
    }

    protected function extractListFromPayload(array $payload): array
    {
        if (isset($payload['data']) && is_array($payload['data'])) {
            $data = $payload['data'];

            if (isset($data['items']) && is_array($data['items'])) {
                return $data['items'];
            }

            if (isset($data['data']) && is_array($data['data'])) {
                return $data['data'];
            }

            if (isset($data['students']) && is_array($data['students'])) {
                return $data['students'];
            }

            if (isset($data['teachers']) && is_array($data['teachers'])) {
                return $data['teachers'];
            }

            if (array_is_list($data)) {
                return $data;
            }
        }

        foreach (['data', 'students', 'items', 'result'] as $key) {
            if (isset($payload[$key]) && is_array($payload[$key])) {
                if (array_is_list($payload[$key])) {
                    return $payload[$key];
                }

                if (isset($payload[$key]['items']) && is_array($payload[$key]['items'])) {
                    return $payload[$key]['items'];
                }
            }
        }

        if (array_is_list($payload)) {
            return $payload;
        }

        return [];
    }

    protected function hasNextPage(array $payload, int $currentPage): bool
    {
        if (isset($payload['next_page_url']) && ! empty($payload['next_page_url'])) {
            return true;
        }

        if (isset($payload['meta'])) {
            $meta = $payload['meta'];
            $current = $meta['current_page'] ?? $currentPage;
            $last = $meta['last_page'] ?? null;
            if ($last !== null) {
                return (int) $current < (int) $last;
            }
        }

        if (isset($payload['pagination'])) {
            $pagination = $payload['pagination'];
            $current = $pagination['current_page'] ?? $currentPage;
            $last = $pagination['last_page'] ?? null;
            if ($last !== null) {
                return (int) $current < (int) $last;
            }

            return ! empty($pagination['next_page_url'] ?? null) || ! empty($pagination['next_page'] ?? null);
        }

        return false;
    }

    protected function client(?int $timeout = null)
    {
        return Http::withHeaders([
            'X-Client-ID' => config('sipintu.client_id'),
            'X-Client-Secret' => config('sipintu.client_secret'),
            'Accept' => 'application/json',
        ])
            ->acceptJson()
            ->baseUrl(rtrim(config('sipintu.base_url'), '/'))
            ->timeout($timeout ?? config('sipintu.timeout', 120));
    }
}
