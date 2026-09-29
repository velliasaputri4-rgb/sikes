<?php

namespace App\Http\Controllers;

use App\Jobs\SyncSipintuStudentsJob;
use App\Models\SipintuSyncLog;
use App\Services\SipintuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SipintuSyncController extends Controller
{
    public function index(SipintuService $service)
    {
        $this->repairStaleRuns();
        $lastLog = SipintuSyncLog::with('user')->latest()->first();
        $logs = SipintuSyncLog::with('user')->latest()->paginate(10);
        $gateway = [
            'state' => 'unavailable',
            'label' => 'Tidak Terhubung',
            'message' => 'Tidak dapat terhubung ke SiPintu.',
            'latency_ms' => null,
            'host' => parse_url(config('sipintu.base_url'), PHP_URL_HOST),
        ];

        try {
            $ping = $service->ping();
            $latency = $ping['latency_ms'];
            $gateway = array_merge($gateway, [
                'state' => $latency > 5000 ? 'slow' : 'connected',
                'label' => $latency > 5000 ? 'Terhubung lambat' : 'Terhubung',
                'message' => $latency > 5000 ? 'Gateway merespons lambat.' : 'Koneksi SiPintu aktif.',
                'latency_ms' => $latency,
            ]);
        } catch (\Throwable $e) {
            if (in_array((int) $e->getCode(), [401, 403], true)) {
                $gateway['state'] = 'rejected';
                $gateway['label'] = 'Kredensial Ditolak';
                $gateway['message'] = $e->getMessage();
            } else {
                $gateway['message'] = $e->getMessage();
            }
        }

        return view('petugas.sipintu-sync.index', compact('lastLog', 'logs', 'gateway'));
    }

    public function run(Request $request, SipintuService $service)
    {
        $this->repairStaleRuns();
        $running = SipintuSyncLog::whereIn('status', ['running'])
            ->exists();

        if ($running) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Sinkronisasi sedang berjalan.',
                'log_id' => null,
            ], 409);
        }

        $log = SipintuSyncLog::create([
            'user_id' => auth()->id(),
            'status' => 'running',
            'total' => 0,
            'processed' => 0,
            'created_count' => 0,
            'updated_count' => 0,
            'skipped_count' => 0,
            'failed_count' => 0,
            'error_message' => 'Menunggu respons SiPintu (bisa sampai 1-2 menit)...',
            'started_at' => now(),
        ]);

        try {
            $job = new SyncSipintuStudentsJob($log->id, auth()->id(), $request->boolean('force'));
            if (config('sipintu.sync_mode') === 'sync') {
                set_time_limit(0);
                $job->handle($service);
            } else {
                dispatch($job);
            }
        } catch (\Throwable $e) {
            $log->update([
                'status' => 'failed',
                'error_message' => $e->getMessage() ?: 'Sinkronisasi gagal dimulai.',
                'finished_at' => now(),
            ]);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'status' => $log->fresh()->status,
                'message' => $log->fresh()->error_message,
                'log_id' => $log->id,
            ]);
        }

        return redirect()->route('petugas.sync.index')->with('success', 'Sinkronisasi data siswa SiPintu telah dimulai.');
    }

    public function status(SipintuSyncLog $log)
    {
        $this->repairStaleRuns();
        $log->refresh();
        $log->load('user');

        $processed = (int) ($log->processed ?? 0);
        $total = (int) ($log->total ?? 0);
        $percent = $total > 0 ? min(100, round(($processed / $total) * 100)) : 0;
        $stalled = $log->status === 'running'
            && $log->started_at
            && $log->started_at->diffInSeconds(now()) > 120;

        $message = match ($log->status) {
            'running' => $processed === 0
                ? 'Menunggu respons SiPintu (bisa sampai 1-2 menit)...'
                : 'Sinkronisasi sedang berjalan...',
            'success' => 'Sinkronisasi berhasil: ' . $log->created_count . ' siswa baru, ' . $log->updated_count . ' diperbarui, ' . $log->skipped_count . ' dilewati.',
            'partial' => $log->error_message ?: 'Sinkronisasi selesai sebagian: ' . $log->failed_count . ' data gagal diproses.',
            'failed' => $log->error_message ?: 'Sinkronisasi gagal.',
            default => $log->error_message ?: 'Status tidak diketahui.',
        };

        return response()->json([
            'id' => $log->id,
            'status' => $log->status,
            'total' => $total,
            'processed' => $processed,
            'percent' => $percent,
            'created_count' => $log->created_count,
            'updated_count' => $log->updated_count,
            'skipped_count' => $log->skipped_count,
            'failed_count' => $log->failed_count,
            'error_message' => $log->error_message,
            'warnings' => $log->warnings ?? [],
            'message' => $message,
            'stalled' => $stalled,
            'worker_command' => 'php artisan queue:work --timeout=900 --tries=1',
            'started_at' => $log->started_at?->toIso8601String(),
            'finished_at' => $log->finished_at?->toIso8601String(),
            'user_name' => $log->user?->name,
        ]);
    }

    public function test(SipintuService $service)
    {
        try {
            $result = $service->ping();
            $latency = $result['latency_ms'] ?? 0;

            return response()->json([
                'status' => $latency > 5000 ? 'slow' : 'ok',
                'connected' => true,
                'latency_ms' => $latency,
                'message' => $latency > 5000 ? 'Gateway SiPintu terhubung tetapi merespons lambat.' : 'Koneksi SiPintu aktif.',
                'host' => parse_url(config('sipintu.base_url'), PHP_URL_HOST),
            ]);
        } catch (\Throwable $e) {
            $rejected = in_array((int) $e->getCode(), [401, 403], true);
            return response()->json([
                'status' => $rejected ? 'rejected' : 'error',
                'connected' => false,
                'message' => $e->getMessage(),
                'host' => parse_url(config('sipintu.base_url'), PHP_URL_HOST),
            ], 502);
        }
    }

    protected function repairStaleRuns(): void
    {
        $runningLogs = SipintuSyncLog::where('status', 'running')->get();
        foreach ($runningLogs as $runningLog) {
            if ($runningLog->started_at && $runningLog->started_at->lt(now()->subMinutes(20))) {
                $runningLog->update([
                    'status' => 'failed',
                    'error_message' => 'Proses terhenti sebelum selesai.',
                    'finished_at' => now(),
                ]);
                continue;
            }

            if (config('sipintu.sync_mode') === 'queue'
                && config('queue.default') === 'database'
                && Schema::hasTable('jobs')
                && ! $this->hasDatabaseJobFor($runningLog->id)) {
                $runningLog->update([
                    'status' => 'failed',
                    'error_message' => 'Proses terhenti sebelum selesai.',
                    'finished_at' => now(),
                ]);
            }
        }
    }

    protected function hasDatabaseJobFor(int $logId): bool
    {
        $needle = '/"logId";i:' . preg_quote((string) $logId, '/') . ';/';

        foreach (DB::table('jobs')->pluck('payload') as $payload) {
            $decoded = json_decode($payload, true);
            $command = $decoded['data']['command'] ?? '';
            $serialized = is_string($command) && str_starts_with($command, 'O:')
                ? $command
                : base64_decode($command, true);
            if (is_string($serialized) && preg_match($needle, $serialized)) {
                return true;
            }
        }

        return false;
    }
}
