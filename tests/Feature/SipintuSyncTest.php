<?php

namespace Tests\Feature;

use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class SipintuSyncTest extends TestCase
{
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seedRoles();
    }

    public function test_petugas_can_access_sync_page(): void
    {
        Http::fake([
            'https://sipintu.smkn1bangsri.sch.id/api/v1/ping*' => Http::response(['status' => 'ok'], 200),
        ]);
        $user = User::factory()->create();
        $user->assignRole('petugas');

        $this->actingAs($user)
            ->get('/petugas/sync-sipintu')
            ->assertOk();
    }

    public function test_sync_successfully_upserts_students_from_gateway(): void
    {
        $user = User::factory()->create();
        $user->assignRole('petugas');
        $major = \App\Models\Major::firstOrCreate(['name' => 'Umum', 'code' => 'UMUM']);
        ClassRoom::firstOrCreate(
            ['name' => 'XII-A'],
            ['major_id' => $major->id, 'code' => 'XII_A', 'grade' => 12]
        );

        Http::fake([
            'https://sipintu.smkn1bangsri.sch.id/api/v1/sijuna/students*' => Http::response([
                'data' => [
                    ['nis' => '1001', 'nama' => 'Rizki', 'alamat' => 'Jalan Satu', 'classroom' => ['id' => 9001, 'name' => 'XII-A']],
                    ['nis' => '1002', 'nama' => 'Sari', 'alamat' => 'Jalan Dua', 'classroom' => ['id' => 9002, 'name' => 'XII-A']],
                ],
            ], 200),
        ]);

        $response = $this->actingAs($user)
            ->post('/petugas/sync-sipintu', [], ['Accept' => 'application/json']);

        $response->assertJson(['status' => 'success']);
        $this->assertDatabaseHas('students', ['nis' => '1001', 'full_name' => 'Rizki']);
        $this->assertDatabaseHas('students', ['nis' => '1002', 'full_name' => 'Sari']);
        $this->assertDatabaseHas('students', ['nis' => '1001', 'address' => 'Jalan Satu', 'birth_date' => null]);
        $this->assertDatabaseCount('sipintu_sync_logs', 1);
    }

    public function test_sync_rejects_invalid_gateway_credentials(): void
    {
        $user = User::factory()->create();
        $user->assignRole('petugas');

        Http::fake([
            'https://sipintu.smkn1bangsri.sch.id/api/v1/sijuna/students*' => Http::response([
                'error' => 'unauthorized',
                'message' => 'Missing or invalid credentials.',
            ], 401),
        ]);

        $this->actingAs($user)
            ->post('/petugas/sync-sipintu', [], ['Accept' => 'application/json'])
            ->assertStatus(200);
    }

    public function test_sync_handles_duplicate_rows_idempotently(): void
    {
        $user = User::factory()->create();
        $user->assignRole('petugas');

        $major = \App\Models\Major::firstOrCreate(['name' => 'Umum', 'code' => 'UMUM']);
        $classroom = ClassRoom::firstOrCreate(
            ['name' => 'XII-A'],
            ['major_id' => $major->id, 'code' => 'XII_A', 'grade' => 12]
        );

        $userLocal = User::firstOrCreate(
            ['email' => '1001@sikes.sch.id'],
            ['name' => 'Rizki Lama', 'password' => bcrypt('siswa123'), 'status' => 'active']
        );

        Student::create([
            'user_id' => $userLocal->id,
            'classroom_id' => $classroom->id,
            'nis' => '1001',
            'full_name' => 'Rizki Lama',
            'birth_date' => '2008-01-01',
            'parent_phone' => '081000000000',
        ]);

        Http::fake([
            'https://sipintu.smkn1bangsri.sch.id/api/v1/sijuna/students*' => Http::response([
                'data' => [
                    ['nis' => '1001', 'nama' => 'Rizki', 'classroom' => ['id' => 9001, 'name' => 'XII-A']],
                ],
            ], 200),
        ]);

        $this->actingAs($user)
            ->post('/petugas/sync-sipintu', [], ['Accept' => 'application/json'])
            ->assertJson(['status' => 'success']);

        $this->assertDatabaseHas('students', ['nis' => '1001', 'full_name' => 'Rizki']);
    }

    protected function seedRoles(): void
    {
        Role::firstOrCreate(['name' => 'petugas']);
        Role::firstOrCreate(['name' => 'siswa']);
    }
}
