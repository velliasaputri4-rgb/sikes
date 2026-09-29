<?php

namespace App\Jobs;

use App\Models\ClassRoom;
use App\Models\SipintuSyncLog;
use App\Models\Student;
use App\Models\User;
use App\Services\SipintuService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class SyncSipintuStudentsJob implements ShouldQueue
{
    public $timeout = 900;
    public $tries = 1;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $logId, public ?int $userId = null, public bool $forceRefresh = false)
    {
    }

    public function failed(\Throwable $e): void
    {
        $log = SipintuSyncLog::find($this->logId);
        if ($log) {
            $log->update([
                'status' => 'failed',
                'error_message' => $this->messageForException($e),
                'finished_at' => now(),
            ]);
        }

        Log::error('Job sinkronisasi SiPintu gagal.', ['exception' => get_class($e)]);
    }

    public function handle(SipintuService $service): void
    {
        set_time_limit(0);
        $log = SipintuSyncLog::findOrFail($this->logId);
        $lock = Cache::lock(config('sipintu.queue_lock_key', 'sipintu-sync-lock'), 1200);

        if (! $lock->get()) {
            $log->update([
                'status' => 'failed',
                'error_message' => 'Sinkronisasi sedang berjalan.',
                'finished_at' => now(),
            ]);
            return;
        }

        register_shutdown_function(fn () => $this->markLogFailedAfterShutdown($log->id));

        try {
            $log->update([
                'status' => 'running',
                'processed' => 0,
                'error_message' => 'Menunggu respons SiPintu (bisa sampai 1-2 menit)...',
                'started_at' => now(),
            ]);

            $students = $service->fetchStudents($this->forceRefresh);
            $total = count($students);
            $processed = 0;
            $created = 0;
            $updated = 0;
            $skipped = 0;
            $failed = 0;
            $rowErrors = [];
            $unmatchedClassrooms = [];
            $seenNis = [];

            if ($total === 0) {
                $log->update([
                    'status' => 'failed',
                    'total' => 0,
                    'processed' => 0,
                    'error_message' => 'SiPintu tidak mengembalikan data siswa.',
                    'finished_at' => now(),
                ]);
                return;
            }

            $passwordHash = Hash::make('password');
            $studentRole = Role::firstOrCreate(['name' => 'siswa', 'guard_name' => 'web']);
            $classCache = ClassRoom::query()->get(['id', 'name'])->mapWithKeys(function ($classroom) {
                return [$this->normalizeClassName($classroom->name) => $classroom->id];
            })->all();
            $classTemplate = ClassRoom::query()->first();

            foreach (array_chunk($students, 200) as $chunk) {
                DB::transaction(function () use ($chunk, $service, $passwordHash, $studentRole, &$processed, &$created, &$updated, &$skipped, &$failed, &$rowErrors, &$unmatchedClassrooms, &$seenNis, &$classCache, &$classTemplate) {
                    $records = [];
                    foreach ($chunk as $item) {
                        $processed++;

                        try {
                            $row = (array) $item;
                            $mapped = $service->mapStudentRow($row);
                            $nis = $this->normalizeNis($mapped['nis'] ?? null);
                            if (! $nis) {
                                $skipped++;
                                $rowErrors[] = 'Baris dilewati: NIS tidak ditemukan atau kosong.';
                                continue;
                            }

                            if (($row['deleted_at'] ?? null) !== null) {
                                $skipped++;
                                $rowErrors[] = 'NIS ' . $nis . ': data sudah dihapus di SiPintu dan dilewati.';
                                continue;
                            }

                            if (isset($seenNis[$nis])) {
                                $skipped++;
                                continue;
                            }
                            $seenNis[$nis] = true;

                            if (strlen($nis) > 20) {
                                $failed++;
                                $rowErrors[] = 'NIS melebihi batas 20 karakter dan gagal diproses.';
                                continue;
                            }

                            $fullName = $this->normalizeText($mapped['full_name'] ?? null);
                            if (! $fullName || mb_strlen($fullName) > 100) {
                                $failed++;
                                $rowErrors[] = 'NIS ' . $nis . ': nama kosong atau melebihi batas 100 karakter.';
                                continue;
                            }

                            $records[] = [
                                'nis' => $nis,
                                'full_name' => $fullName,
                                'address' => $this->normalizeText($mapped['address'] ?? null),
                                'classroom_name' => $this->normalizeClassText($mapped['classroom_name'] ?? null),
                            ];
                        } catch (\Throwable $e) {
                            $failed++;
                            $rowErrors[] = 'Satu baris gagal diproses karena format datanya tidak sesuai.';
                            Log::warning('Baris sinkronisasi SiPintu gagal dipetakan.', ['exception' => get_class($e)]);
                        }
                    }

                    $nisValues = array_column($records, 'nis');
                    $existingStudents = $nisValues
                        ? Student::withTrashed()->whereIn('nis', $nisValues)->get()->keyBy('nis')
                        : collect();
                    $newRecords = [];

                    foreach ($records as $record) {
                        $nis = $record['nis'];
                        $existing = $existingStudents->get($nis);

                        if ($existing && $existing->trashed()) {
                            $skipped++;
                            $rowErrors[] = 'NIS ' . $nis . ': siswa lokal sudah soft-delete dan tidak diduplikasi atau dipulihkan.';
                            continue;
                        }

                        $classroomId = $this->resolveClassroomId(
                            $record['classroom_name'],
                            $classCache,
                            $classTemplate,
                            $unmatchedClassrooms
                        );

                        if ($existing) {
                            try {
                                $changes = [];
                                if ($record['full_name'] !== '' && $existing->full_name !== $record['full_name']) {
                                    $changes['full_name'] = $record['full_name'];
                                }
                                if ($record['address'] !== null && $record['address'] !== '' && $existing->address !== $record['address']) {
                                    $changes['address'] = $record['address'];
                                }
                                if ($classroomId !== null && (int) $existing->classroom_id !== $classroomId) {
                                    $changes['classroom_id'] = $classroomId;
                                }
                                $existing->update($changes + ['sipintu_last_synced_at' => now()]);
                                $updated++;
                            } catch (\Throwable $e) {
                                $failed++;
                                $rowErrors[] = 'NIS ' . $nis . ': gagal memperbarui data siswa.';
                                Log::warning('Pembaruan siswa SiPintu gagal.', ['exception' => get_class($e)]);
                            }
                            continue;
                        }

                        $newRecords[] = $record + ['classroom_id' => $classroomId];
                    }

                    $emails = array_values(array_unique(array_map(fn ($record) => $record['nis'] . '@sikes.sch.id', $newRecords)));
                    $users = $emails
                        ? DB::table('users')->whereIn('email', $emails)->get(['id', 'email', 'deleted_at'])->keyBy('email')
                        : collect();
                    $usersToInsert = [];
                    $eligibleRecords = [];
                    $now = now();

                    foreach ($newRecords as $record) {
                        $email = $record['nis'] . '@sikes.sch.id';
                        if ($users->has($email)) {
                            if ($users->get($email)->deleted_at !== null) {
                                $failed++;
                                $rowErrors[] = 'NIS ' . $record['nis'] . ': akun lokal sudah dihapus dan tidak dipulihkan.';
                                continue;
                            }
                            $eligibleRecords[] = $record;
                            continue;
                        }

                        $eligibleRecords[] = $record;
                        $usersToInsert[$email] = [
                            'name' => $record['full_name'],
                            'email' => $email,
                            'password' => $passwordHash,
                            'status' => 'active',
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }

                    $newRecords = $eligibleRecords;
                    $emails = array_values(array_unique(array_map(fn ($record) => $record['nis'] . '@sikes.sch.id', $newRecords)));
                    if ($usersToInsert) {
                        DB::table('users')->insertOrIgnore(array_values($usersToInsert));
                    }

                    $users = $emails
                        ? DB::table('users')->whereIn('email', $emails)->whereNull('deleted_at')->get(['id', 'email'])->keyBy('email')
                        : collect();
                    $userIds = $users->pluck('id')->map(fn ($id) => (int) $id)->all();
                    $pivotTable = config('permission.table_names.model_has_roles', 'model_has_roles');
                    $roleColumn = config('permission.column_names.role_pivot_key') ?: 'role_id';
                    $modelColumn = config('permission.column_names.model_morph_key', 'model_id');
                    $modelType = (new User())->getMorphClass();
                    $rolePivots = array_map(fn ($id) => [
                        $roleColumn => $studentRole->id,
                        $modelColumn => $id,
                        'model_type' => $modelType,
                    ], $userIds);

                    if ($rolePivots) {
                        DB::table($pivotTable)->insertOrIgnore($rolePivots);
                    }

                    foreach ($newRecords as $record) {
                        $email = $record['nis'] . '@sikes.sch.id';
                        $user = $users->get($email);
                        if (! $user) {
                            $failed++;
                            $rowErrors[] = 'NIS ' . $record['nis'] . ': akun siswa gagal dibuat atau ditemukan.';
                            continue;
                        }

                        try {
                            DB::transaction(function () use ($record, $user) {
                                Student::create([
                                    'user_id' => $user->id,
                                    'nis' => $record['nis'],
                                    'full_name' => $record['full_name'],
                                    'address' => $record['address'],
                                    'classroom_id' => $record['classroom_id'],
                                    'birth_date' => null,
                                    'sipintu_last_synced_at' => now(),
                                ]);
                            });
                            $created++;
                        } catch (\Throwable $e) {
                            $failed++;
                            $rowErrors[] = 'NIS ' . $record['nis'] . ': gagal menyimpan data siswa.';
                            Log::warning('Penyimpanan siswa SiPintu gagal.', ['exception' => get_class($e)]);
                        }
                    }
                });

                $log->update([
                    'status' => 'running',
                    'total' => $total,
                    'processed' => $processed,
                    'created_count' => $created,
                    'updated_count' => $updated,
                    'skipped_count' => $skipped,
                    'failed_count' => $failed,
                    'warnings' => array_values($unmatchedClassrooms),
                    'error_message' => 'Sinkronisasi sedang berjalan...',
                ]);
            }

            $processedSuccessfully = $created + $updated;
            if ($processedSuccessfully === 0) {
                $status = 'failed';
                $errorMessage = $skipped === $total
                    ? 'Semua data dilewati. Periksa apakah NIS tersedia dan apakah siswa lokal sudah dihapus.'
                    : 'Semua data gagal diproses. Periksa format data SiPintu dan riwayat teknis.';
                if ($skipped === $total && $total > 0 && count(array_filter($students, fn ($row) => empty($row['nis'] ?? null))) === $total) {
                    $errorMessage = 'Semua data dilewati karena NIS tidak ditemukan pada data SiPintu.';
                }
            } elseif ($failed > 0 || ! empty($unmatchedClassrooms)) {
                $status = 'partial';
                $errorMessage = 'Sinkronisasi selesai sebagian: ' . $failed . ' data gagal diproses.';
                if ($unmatchedClassrooms) {
                    $errorMessage .= ' Kelas belum cocok: ' . implode(', ', array_slice(array_keys($unmatchedClassrooms), 0, 20)) . '.';
                }
            } else {
                $status = 'success';
                $errorMessage = 'Sinkronisasi berhasil: ' . $created . ' siswa baru, ' . $updated . ' diperbarui, ' . $skipped . ' dilewati.';
            }

            if ($rowErrors && $status !== 'success') {
                $errorMessage .= ' Detail: ' . implode(' | ', array_slice(array_unique($rowErrors), 0, 20));
            }

            $log->update([
                'status' => $status,
                'total' => $total,
                'processed' => $processed,
                'created_count' => $created,
                'updated_count' => $updated,
                'skipped_count' => $skipped,
                'failed_count' => $failed,
                'error_message' => $errorMessage,
                'warnings' => array_values($unmatchedClassrooms),
                'finished_at' => now(),
            ]);
        } catch (\Throwable $e) {
            $message = $this->messageForException($e);
            $log->update([
                'status' => 'failed',
                'total' => $log->total ?? 0,
                'processed' => $log->processed ?? 0,
                'error_message' => $message,
                'finished_at' => now(),
            ]);

            Log::error('Sinkronisasi SiPintu gagal.', ['exception' => get_class($e), 'code' => $e->getCode()]);
        } finally {
            $lock->release();
        }
    }

    protected function resolveClassroomId(?string $className, array &$classCache, ?ClassRoom &$classTemplate, array &$warnings): ?int
    {
        if (! $className) {
            return null;
        }

        $key = $this->normalizeClassName($className);
        if (array_key_exists($key, $classCache)) {
            return $classCache[$key];
        }

        try {
            if (! $classTemplate) {
                $classCache[$key] = null;
                $warnings[$className] = $className;
                return null;
            }

            $row = (array) DB::table('classrooms')->where('id', $classTemplate->id)->first();
            unset($row['id'], $row['created_at'], $row['updated_at'], $row['deleted_at']);
            $row['name'] = trim(preg_replace('/\s+/', ' ', $className));
            $baseCode = substr(preg_replace('/[^A-Za-z0-9]/', '_', strtoupper($row['name'])), 0, 12);
            $suffix = now()->format('His');
            $row['code'] = substr($baseCode . '_' . $suffix, 0, 20);
            $attempt = 0;
            while (DB::table('classrooms')->where('code', $row['code'])->exists()) {
                $attempt++;
                $row['code'] = substr($baseCode, 0, 11) . '_' . substr((string) (time() + $attempt), -8);
            }
            $row['created_at'] = now();
            $row['updated_at'] = now();
            $id = DB::table('classrooms')->insertGetId($row);
            $classCache[$key] = (int) $id;
            $classTemplate = ClassRoom::find($id);

            return (int) $id;
        } catch (\Throwable $e) {
            $classCache[$key] = null;
            $warnings[$className] = $className;
            Log::warning('Kelas SiPintu tidak dapat dibuat dari template lokal.', ['exception' => get_class($e)]);

            return null;
        }
    }

    protected function normalizeClassText(mixed $value): ?string
    {
        if ($value === null || trim((string) $value) === '') {
            return null;
        }

        return preg_replace('/\s+/u', ' ', trim((string) $value));
    }

    protected function normalizeClassName(string $value): string
    {
        return mb_strtoupper($this->normalizeClassText($value) ?? '');
    }

    protected function markLogFailedAfterShutdown(int $logId, ?array $error = null): void
    {
        try {
            $error ??= error_get_last();
            $current = SipintuSyncLog::find($logId);
            if (! $current || $current->status !== 'running') {
                return;
            }

            $message = $error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR], true)
                ? 'Proses terhenti: batas waktu PHP terlampaui.'
                : 'Proses terhenti sebelum selesai.';

            $current->update(['status' => 'failed', 'error_message' => $message, 'finished_at' => now()]);
        } catch (\Throwable) {
            // Shutdown may run after the application container has been torn down.
        }
    }

    protected function messageForException(\Throwable $e): string
    {
        $message = $e->getMessage();
        $code = (int) $e->getCode();

        if ($code === 504 || str_contains(strtolower($message), 'timed out') || str_contains(strtolower($message), 'operation timed out')) {
            return 'SiPintu terlalu lama merespons (lebih dari ' . config('sipintu.timeout_fetch', 120) . ' detik). Server SiPintu sedang lambat. Coba lagi beberapa saat atau hubungi admin SiPintu.';
        }

        if (in_array($code, [401, 403], true) || str_contains(strtolower($message), 'unauthorized') || str_contains(strtolower($message), 'forbidden')) {
            return 'Kredensial SiPintu ditolak. Periksa SIPINTU_CLIENT_ID dan SIPINTU_CLIENT_SECRET di .env, lalu php artisan config:clear.';
        }

        if ($code === 404) {
            return 'Endpoint data siswa SiPintu tidak ditemukan. Periksa versi API atau URL gateway.';
        }

        if ($code === 429) {
            return 'Terlalu banyak permintaan ke SiPintu. Tunggu beberapa menit lalu coba lagi.';
        }

        if ($code >= 500 && $code <= 599) {
            return 'Server SiPintu sedang bermasalah (kode ' . $code . '). Coba lagi nanti.';
        }

        if (str_contains(strtolower($message), 'curl error') || str_contains(strtolower($message), 'connection refused') || str_contains(strtolower($message), 'could not resolve host') || str_contains(strtolower($message), 'tidak dapat terhubung')) {
            return 'Tidak dapat terhubung ke SiPintu. Periksa koneksi internet dan alamat SIPINTU_BASE_URL.';
        }

        if (empty($message)) {
            return 'Format data dari SiPintu tidak dikenali. Hubungi admin SiPintu.';
        }

        return $message;
    }

    protected function normalizeNis(mixed $value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        return trim((string) $value);
    }

    protected function normalizeText(mixed $value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        return trim((string) $value);
    }

}
