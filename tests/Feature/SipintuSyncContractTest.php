<?php

namespace Tests\Feature;

use App\Jobs\SyncSipintuStudentsJob;
use App\Models\ClassRoom;
use App\Models\Major;
use App\Models\SipintuSyncLog;
use App\Models\Student;
use App\Models\User;
use App\Services\SipintuService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class SipintuSyncContractTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Role::firstOrCreate(['name' => 'petugas', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'siswa', 'guard_name' => 'web']);
        config(['sipintu.sync_mode' => 'queue']);
        config(['sipintu.client_id' => 'test-client', 'sipintu.client_secret' => 'test-secret']);
        Cache::flush();
    }

    public function test_real_payload_maps_three_local_classes_and_never_copies_gateway_ids(): void
    {
        $officer = User::factory()->create();
        $officer->assignRole('petugas');
        $classrooms = [
            $this->createClassroom('X IPA 1'),
            $this->createClassroom('XI IPA 2'),
            $this->createClassroom('XII IPS 3'),
        ];
        $rows = [
            $this->studentRow('00001', 'Siswa Satu', 'x   ipa 1', 98001),
            $this->studentRow('00002', 'Siswa Dua', 'XI IPA 2', 98002),
            $this->studentRow('00003', 'Siswa Tiga', 'XII IPS 3', 98003),
        ];
        $this->fakeGateway($rows);

        $response = $this->actingAs($officer)->postJson('/petugas/sync-sipintu');

        $response->assertOk();
        $this->assertSame('success', $response->json('status'), $response->json('message'));
        foreach ($rows as $index => $row) {
            $student = Student::where('nis', $row['nis'])->firstOrFail();
            $this->assertSame($classrooms[$index]->id, $student->classroom_id);
            $this->assertNotSame($row['classroom_id'], $student->classroom_id);
            $this->assertNotSame($row['user_id'], $student->user_id);
            $this->assertSame('Jalan Contoh', $student->address);
            $this->assertNull($student->birth_date);
            $this->assertNull($student->parent_phone);
            $this->assertSame($row['nama'], $student->user->name);
            $this->assertTrue($student->user->hasRole('siswa'));
            $this->assertSame('active', $student->user->status);
        }

        $this->assertCount(3, Student::query()->distinct('classroom_id')->pluck('classroom_id'));
    }

    public function test_1160_new_students_use_one_password_hash_and_bulk_role_assignment(): void
    {
        $officer = User::factory()->create();
        $officer->assignRole('petugas');
        $this->createClassroom('X IPA 1');
        $rows = [];
        for ($index = 1; $index <= 1160; $index++) {
            $rows[] = $this->studentRow(sprintf('%05d', $index), 'Siswa ' . $index, 'X IPA 1', 900000 + $index);
        }
        $this->fakeGateway($rows);
        Hash::shouldReceive('make')->once()->with('password')->andReturn('single-test-hash');

        $response = $this->actingAs($officer)->postJson('/petugas/sync-sipintu');

        $response->assertOk()->assertJsonPath('status', 'success');
        $this->assertSame(1160, Student::count());
        $this->assertSame(1160, DB::table('users')->where('email', 'like', '%@sikes.sch.id')->count());
        $this->assertSame(1160, DB::table('model_has_roles')->where('role_id', Role::findByName('siswa')->id)->count());
        $this->assertSame(1, DB::table('users')->where('email', 'like', '%@sikes.sch.id')->distinct()->count('password'));
        $this->assertSame(0, Student::whereNull('user_id')->count());
    }

    public function test_fetch_uses_one_large_request_cache_and_force_refresh_with_auth_headers(): void
    {
        $requestUrls = [];
        $authHeadersPresent = [];
        Http::fake(function ($request) use (&$requestUrls, &$authHeadersPresent) {
            $requestUrls[] = $request->url();
            $authHeadersPresent[] = $request->hasHeader('X-Client-ID')
                && $request->hasHeader('X-Client-Secret')
                && $request->hasHeader('Accept');
            $count = count($requestUrls);
            $rows = [$this->studentRow('00500', 'Cache ' . $count, 'X IPA 1')];
            if ($count === 2) {
                $rows[] = $this->studentRow('00501', 'Cache Refresh', 'X IPA 1');
            }

            return Http::response(['status' => 'ok', 'source' => 'SIJUNA', 'count' => count($rows), 'data' => $rows], 200);
        });

        $service = app(SipintuService::class);
        $first = $service->fetchStudents();
        $cached = $service->fetchStudents();
        $refreshed = $service->fetchStudents(true);

        $this->assertCount(1, $first);
        $this->assertCount(1, $cached);
        $this->assertCount(2, $refreshed);
        $this->assertCount(2, $requestUrls);
        $this->assertSame([true, true], $authHeadersPresent);
        foreach ($requestUrls as $url) {
            parse_str((string) parse_url($url, PHP_URL_QUERY), $query);
            $this->assertSame('5000', $query['limit'] ?? null);
            $this->assertSame('1', $query['page'] ?? null);
        }
    }

    public function test_resync_updates_by_nis_without_duplicate_student_or_user_or_overwriting_local_fields(): void
    {
        $officer = User::factory()->create();
        $officer->assignRole('petugas');
        $classroom = $this->createClassroom('X IPA 1');
        $otherClassroom = $this->createClassroom('XI IPA 2');
        $localUser = User::factory()->create(['email' => '00100@sikes.sch.id', 'password' => Hash::make('local-secret')]);
        $localUser->assignRole('siswa');
        $student = Student::create([
            'user_id' => $localUser->id,
            'classroom_id' => $classroom->id,
            'nis' => '00100',
            'full_name' => 'Nama Lama',
            'birth_date' => '2008-03-04',
            'birth_place' => 'Kota Lokal',
            'address' => 'Alamat Lama',
            'parent_name' => 'Orang Tua',
            'parent_phone' => '081234567890',
            'blood_type' => 'O',
            'allergy_history' => 'Debu',
        ]);
        $row = $this->studentRow('00100', 'Nama Baru', 'XI IPA 2', 77123, 88123);
        $row['alamat'] = 'Alamat Baru';
        $this->fakeGateway([$row]);

        $this->actingAs($officer)->postJson('/petugas/sync-sipintu')->assertJsonPath('status', 'success');
        $this->actingAs($officer)->postJson('/petugas/sync-sipintu')->assertJsonPath('status', 'success');

        $student->refresh();
        $this->assertSame(1, Student::withTrashed()->where('nis', '00100')->count());
        $this->assertSame($localUser->id, $student->user_id);
        $this->assertSame($otherClassroom->id, $student->classroom_id);
        $this->assertSame('Nama Baru', $student->full_name);
        $this->assertSame('Alamat Baru', $student->address);
        $this->assertSame('2008-03-04', $student->birth_date->format('Y-m-d'));
        $this->assertSame('Kota Lokal', $student->birth_place);
        $this->assertSame('Orang Tua', $student->parent_name);
        $this->assertSame('081234567890', $student->parent_phone);
        $this->assertSame('O', $student->blood_type);
        $this->assertSame('Debu', $student->allergy_history);
        $this->assertTrue(Hash::check('local-secret', $localUser->fresh()->password));
        $this->assertSame(1, DB::table('users')->where('email', '00100@sikes.sch.id')->count());
        $this->assertNotNull($student->sipintu_last_synced_at);
    }

    public function test_remote_deleted_rows_missing_nis_and_local_soft_deleted_rows_are_skipped(): void
    {
        $officer = User::factory()->create();
        $officer->assignRole('petugas');
        $classroom = $this->createClassroom('X IPA 1');
        $localUser = User::factory()->create(['email' => '00200@sikes.sch.id']);
        $localStudent = Student::create([
            'user_id' => $localUser->id,
            'classroom_id' => $classroom->id,
            'nis' => '00200',
            'full_name' => 'Soft Deleted',
            'birth_date' => '2007-01-01',
        ]);
        $localStudent->delete();
        $rows = [
            $this->studentRow('00200', 'Jangan Restore', 'X IPA 1'),
            array_merge($this->studentRow('00201', 'Sudah Dihapus', 'X IPA 1'), ['deleted_at' => '2026-01-01 00:00:00']),
            ['nama' => 'Tanpa NIS', 'alamat' => 'Alamat', 'classroom' => ['name' => 'X IPA 1']],
        ];
        $this->fakeGateway($rows);

        $response = $this->actingAs($officer)->postJson('/petugas/sync-sipintu');

        $response->assertOk()->assertJsonPath('status', 'failed');
        $this->assertSame(0, Student::count());
        $this->assertSame(1, Student::withTrashed()->where('nis', '00200')->count());
        $this->assertSame(0, Student::withTrashed()->where('nis', '00201')->count());
        $log = SipintuSyncLog::latest()->firstOrFail();
        $this->assertSame(3, $log->skipped_count);
        $this->assertStringContainsString('dilewati', $log->error_message);
    }

    public function test_missing_local_class_is_null_and_reported_as_partial_warning(): void
    {
        $officer = User::factory()->create();
        $officer->assignRole('petugas');
        $this->fakeGateway([$this->studentRow('00300', 'Tanpa Kelas Lokal', 'KELAS BARU')]);

        $response = $this->actingAs($officer)->postJson('/petugas/sync-sipintu');

        $response->assertOk()->assertJsonPath('status', 'partial');
        $student = Student::where('nis', '00300')->firstOrFail();
        $this->assertNull($student->classroom_id);
        $this->assertDatabaseHas('sipintu_sync_logs', ['id' => SipintuSyncLog::latest()->value('id')]);
        $this->assertContains('KELAS BARU', SipintuSyncLog::latest()->firstOrFail()->warnings);
    }

    public function test_login_is_rejected_when_birth_date_is_null(): void
    {
        $this->createStudent('00400', 'Tanggal Kosong', null);

        $this->from('/login')->post('/login', [
            'nis' => '00400',
            'birth_date' => '2000-01-01',
        ])->assertRedirect('/login')->assertSessionHasErrors([
            'birth_date' => 'Tanggal lahir belum diisi. Hubungi petugas UKS.',
        ]);
    }

    public function test_alternate_student_login_route_rejects_a_missing_birth_date(): void
    {
        $this->createStudent('00403', 'Tanggal Kosong Alternatif', null);

        $this->from('/login-siswa')->post('/login-siswa', [
            'nis' => '00403',
            'birth_date' => '2000-01-01',
        ])->assertRedirect('/login-siswa')->assertSessionHasErrors([
            'birth_date' => 'Tanggal lahir belum diisi. Hubungi petugas UKS.',
        ]);
    }

    public function test_data_siswa_can_filter_students_with_missing_birth_date(): void
    {
        $officer = User::factory()->create();
        $officer->assignRole('petugas');
        $this->createStudent('00401', 'Perlu Tanggal', null);
        $this->createStudent('00402', 'Sudah Lengkap', '2008-05-01');

        $this->actingAs($officer)->get('/petugas/students?birth_date_missing=1')
            ->assertOk()
            ->assertSee('Perlu Tanggal')
            ->assertDontSee('Sudah Lengkap')
            ->assertSee('Tanggal lahir kosong');
    }

    public function test_petugas_students_page_renders_varied_names_and_local_classes(): void
    {
        $officer = User::factory()->create();
        $officer->assignRole('petugas');
        $this->createStudent('00410', 'Nama Contoh Satu', '2008-01-01');
        $this->createStudent('00411', 'Nama Contoh Dua', '2008-02-01');
        $this->createStudent('00412', 'Nama Contoh Tiga', '2008-03-01');

        $this->actingAs($officer)->get('/petugas/students')
            ->assertOk()
            ->assertSee('Nama Contoh Satu')
            ->assertSee('Nama Contoh Dua')
            ->assertSee('Nama Contoh Tiga')
            ->assertSee('X-00410')
            ->assertSee('X-00411')
            ->assertSee('X-00412');
    }

    public function test_unauthorized_gateway_credentials_are_not_retried(): void
    {
        $log = $this->performGatewayFailure(401);
        $this->assertStringContainsString('Kredensial SiPintu ditolak.', $log->error_message);
        $this->assertSame(1, $this->gatewayRequestCount);
    }

    public function test_forbidden_gateway_credentials_are_not_retried(): void
    {
        $log = $this->performGatewayFailure(403);
        $this->assertStringContainsString('Kredensial SiPintu ditolak.', $log->error_message);
        $this->assertSame(1, $this->gatewayRequestCount);
    }

    public function test_missing_gateway_endpoint_is_reported_without_retry(): void
    {
        $log = $this->performGatewayFailure(404);
        $this->assertStringContainsString('Endpoint data siswa SiPintu tidak ditemukan.', $log->error_message);
        $this->assertSame(1, $this->gatewayRequestCount);
    }

    public function test_rate_limited_gateway_request_is_not_retried(): void
    {
        $log = $this->performGatewayFailure(429);
        $this->assertStringContainsString('Terlalu banyak permintaan ke SiPintu.', $log->error_message);
        $this->assertSame(1, $this->gatewayRequestCount);
    }

    public function test_unprocessable_gateway_response_is_not_retried(): void
    {
        $log = $this->performGatewayFailure(422);
        $this->assertStringContainsString('Format data siswa SiPintu tidak dikenali.', $log->error_message);
        $this->assertSame(1, $this->gatewayRequestCount);
    }

    public function test_server_error_is_retried_once_and_reported(): void
    {
        $log = $this->performGatewayFailure(500);
        $this->assertStringContainsString('kode 500', $log->error_message);
        $this->assertSame(2, $this->gatewayRequestCount);
    }

    public function test_timeout_is_not_retried(): void
    {
        $officer = User::factory()->create();
        $officer->assignRole('petugas');
        $requests = 0;
        Http::fake(function ($request) use (&$requests) {
            if (str_contains($request->url(), '/sijuna/students')) {
                $requests++;
                throw new ConnectionException('cURL error 28: Operation timed out');
            }
            return Http::response(['status' => 'ok'], 200);
        });

        $this->actingAs($officer)->postJson('/petugas/sync-sipintu')->assertJsonPath('status', 'failed');
        $this->assertStringContainsString('lebih dari 120 detik', SipintuSyncLog::latest()->firstOrFail()->error_message);
        $this->assertSame(1, $requests);
    }

    public function test_connection_failure_is_retried_once_then_succeeds(): void
    {
        $requests = 0;
        Http::fake(function () use (&$requests) {
            $requests++;
            if ($requests === 1) {
                throw new ConnectionException('Could not resolve host');
            }

            return Http::response([
                'status' => 'ok',
                'source' => 'SIJUNA',
                'count' => 1,
                'data' => [$this->studentRow('00510', 'Koneksi Pulih', 'X IPA 1')],
            ], 200);
        });

        $rows = app(SipintuService::class)->fetchStudents(true);

        $this->assertCount(1, $rows);
        $this->assertSame(2, $requests);
    }

    public function test_exhausted_connection_retries_show_a_clear_connection_message(): void
    {
        $officer = User::factory()->create();
        $officer->assignRole('petugas');
        $requests = 0;
        Http::fake(function () use (&$requests) {
            $requests++;
            throw new ConnectionException('Could not resolve host');
        });

        $this->actingAs($officer)->postJson('/petugas/sync-sipintu')->assertJsonPath('status', 'failed');

        $this->assertSame(2, $requests);
        $this->assertStringContainsString('Tidak dapat terhubung ke SiPintu.', SipintuSyncLog::latest()->firstOrFail()->error_message);
    }

    public function test_a_bad_row_does_not_stop_later_rows_in_the_chunk(): void
    {
        $officer = User::factory()->create();
        $officer->assignRole('petugas');
        $this->createClassroom('X IPA 1');
        $longName = $this->studentRow('00520', str_repeat('N', 101), 'X IPA 1');
        $validRow = $this->studentRow('00521', 'Baris Valid', 'X IPA 1');
        $this->fakeGateway([$longName, $validRow]);

        $response = $this->actingAs($officer)->postJson('/petugas/sync-sipintu');

        $response->assertJsonPath('status', 'partial');
        $this->assertSame(1, Student::where('nis', '00521')->count());
        $this->assertSame(0, Student::where('nis', '00520')->count());
        $log = SipintuSyncLog::latest()->firstOrFail();
        $this->assertSame(1, $log->failed_count);
        $this->assertSame(1, $log->created_count);
    }

    public function test_gateway_card_renders_a_measured_ping_and_host_only(): void
    {
        $officer = User::factory()->create();
        $officer->assignRole('petugas');
        Http::fake(function ($request) {
            if (str_contains($request->url(), '/api/v1/ping')) {
                usleep(7000);
            }
            return Http::response(['status' => 'ok', 'latency_ms' => 0], 200);
        });

        $this->actingAs($officer)->get('/petugas/sync-sipintu')
            ->assertOk()
            ->assertSee(parse_url(config('sipintu.base_url'), PHP_URL_HOST))
            ->assertSee('Terhubung')
            ->assertDontSee('0 ms');
    }

    public function test_stalled_status_keeps_real_progress_and_includes_worker_command(): void
    {
        $officer = User::factory()->create();
        $officer->assignRole('petugas');
        $log = SipintuSyncLog::create([
            'user_id' => $officer->id,
            'status' => 'running',
            'total' => 100,
            'processed' => 25,
            'started_at' => now()->subMinutes(3),
        ]);

        $this->actingAs($officer)->getJson('/petugas/sync-sipintu/status/' . $log->id)
            ->assertOk()
            ->assertJsonPath('status', 'running')
            ->assertJsonPath('percent', 25)
            ->assertJsonPath('processed', 25)
            ->assertJsonPath('stalled', true)
            ->assertJsonPath('worker_command', 'php artisan queue:work --timeout=900 --tries=1');
    }

    public function test_connection_test_reports_rejected_credentials_without_exposing_headers(): void
    {
        $officer = User::factory()->create();
        $officer->assignRole('petugas');
        Http::fake(['*api/v1/ping*' => Http::response(['message' => 'Denied'], 403)]);

        $this->actingAs($officer)->postJson('/petugas/sync-sipintu/test')
            ->assertStatus(502)
            ->assertJsonPath('status', 'rejected')
            ->assertJsonPath('connected', false)
            ->assertJsonMissingPath('headers');
    }

    public function test_empty_gateway_data_fails_with_clear_message(): void
    {
        $officer = User::factory()->create();
        $officer->assignRole('petugas');
        $this->fakeGateway([]);
        $this->actingAs($officer)->postJson('/petugas/sync-sipintu')->assertJsonPath('status', 'failed');
        $this->assertStringContainsString('tidak mengembalikan data siswa', SipintuSyncLog::latest()->firstOrFail()->error_message);
    }

    public function test_unknown_gateway_payload_format_fails_clearly(): void
    {
        $officer = User::factory()->create();
        $officer->assignRole('petugas');
        $this->fakeGateway(['unexpected' => []]);
        $this->actingAs($officer)->postJson('/petugas/sync-sipintu')->assertJsonPath('status', 'failed');
        $this->assertStringContainsString('Format data siswa SiPintu tidak dikenali', SipintuSyncLog::latest()->firstOrFail()->error_message);
    }

    public function test_duplicate_sync_is_rejected_and_stale_logs_are_failed_when_page_opens(): void
    {
        $officer = User::factory()->create();
        $officer->assignRole('petugas');
        $running = SipintuSyncLog::create(['user_id' => $officer->id, 'status' => 'running', 'started_at' => now()]);
        $this->fakeGateway([]);
        $this->actingAs($officer)->postJson('/petugas/sync-sipintu')->assertStatus(409);

        $running->update(['started_at' => now()->subMinutes(21)]);
        $this->actingAs($officer)->get('/petugas/sync-sipintu')->assertOk();
        $this->assertSame('failed', $running->fresh()->status);
        $this->assertSame('Proses terhenti sebelum selesai.', $running->fresh()->error_message);
    }

    public function test_missing_queued_job_marks_log_failed_on_page_open(): void
    {
        $officer = User::factory()->create();
        $officer->assignRole('petugas');
        config(['queue.default' => 'database', 'sipintu.sync_mode' => 'queue']);
        $log = SipintuSyncLog::create(['user_id' => $officer->id, 'status' => 'running', 'started_at' => now()]);
        $this->fakeGateway([]);

        $this->actingAs($officer)->get('/petugas/sync-sipintu')->assertOk();

        $this->assertSame('failed', $log->fresh()->status);
        $this->assertSame('Proses terhenti sebelum selesai.', $log->fresh()->error_message);
    }

    public function test_queued_database_job_keeps_its_running_log_active(): void
    {
        $officer = User::factory()->create();
        $officer->assignRole('petugas');
        config(['queue.default' => 'database', 'sipintu.sync_mode' => 'queue']);
        $log = SipintuSyncLog::create(['user_id' => $officer->id, 'status' => 'running', 'started_at' => now()]);
        dispatch(new SyncSipintuStudentsJob($log->id, $officer->id));
        $this->fakeGateway([]);

        $this->actingAs($officer)->get('/petugas/sync-sipintu')->assertOk();

        $this->assertSame('running', $log->fresh()->status, DB::table('jobs')->value('payload'));
        $this->assertDatabaseCount('jobs', 1);
    }

    public function test_shutdown_handler_marks_a_running_log_failed(): void
    {
        $log = SipintuSyncLog::create(['status' => 'running', 'started_at' => now()]);
        $job = new SyncSipintuStudentsJob($log->id);
        $handler = new \ReflectionMethod($job, 'markLogFailedAfterShutdown');
        $handler->invoke($job, $log->id, ['type' => E_ERROR]);

        $this->assertSame('failed', $log->fresh()->status);
        $this->assertSame('Proses terhenti: batas waktu PHP terlampaui.', $log->fresh()->error_message);
    }

    protected function fakeGateway(array $data, int $status = 200): void
    {
        $payload = array_is_list($data)
            ? ['status' => 'ok', 'source' => 'SIJUNA', 'count' => count($data), 'data' => $data]
            : $data;

        Http::fake([
            '*api/v1/ping*' => Http::response(['status' => 'ok'], 200),
            '*api/v1/sijuna/students*' => Http::response($payload, $status),
        ]);
    }

    protected int $gatewayRequestCount = 0;

    protected function performGatewayFailure(int $status): SipintuSyncLog
    {
        $officer = User::factory()->create();
        $officer->assignRole('petugas');
        $this->gatewayRequestCount = 0;
        Http::fake(function () use ($status) {
            $this->gatewayRequestCount++;
            return Http::response(['message' => 'Gateway error'], $status);
        });

        $this->actingAs($officer)->postJson('/petugas/sync-sipintu')->assertJsonPath('status', 'failed');

        return SipintuSyncLog::latest()->firstOrFail();
    }

    protected function studentRow(string $nis, string $name, string $classroomName, int $classroomId = 777777, int $userId = 888888): array
    {
        return [
            'id' => 999999,
            'user_id' => $userId,
            'classroom_id' => $classroomId,
            'school_id' => 666666,
            'nis' => $nis,
            'nisn' => 'IGNORED',
            'nama' => $name,
            'jk' => 'L',
            'hp' => '08123456789',
            'alamat' => 'Jalan Contoh',
            'created_at' => '2026-01-01 00:00:00',
            'updated_at' => '2026-01-01 00:00:00',
            'deleted_at' => null,
            'user' => ['id' => $userId],
            'classroom' => ['id' => $classroomId, 'name' => $classroomName],
            'tahun_masuk' => 2024,
            'tahun_lulus' => 2027,
        ];
    }

    protected function createClassroom(string $name): ClassRoom
    {
        $major = Major::firstOrCreate(['name' => 'Umum', 'code' => 'UMUM']);

        return ClassRoom::create([
            'major_id' => $major->id,
            'name' => $name,
            'code' => strtoupper(str_replace(' ', '_', $name)) . '_' . random_int(100, 999),
            'grade' => 10,
        ]);
    }

    protected function createStudent(string $nis, string $name, ?string $birthDate): Student
    {
        $user = User::factory()->create();
        $classroom = $this->createClassroom('X-' . $nis);

        return Student::create([
            'user_id' => $user->id,
            'classroom_id' => $classroom->id,
            'nis' => $nis,
            'full_name' => $name,
            'birth_date' => $birthDate,
        ]);
    }
}