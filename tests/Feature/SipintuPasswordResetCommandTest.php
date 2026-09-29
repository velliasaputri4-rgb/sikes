<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class SipintuPasswordResetCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        foreach (['admin', 'super-admin', 'petugas', 'siswa'] as $roleName) {
            Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        }
    }

    public function test_simulation_reports_non_admin_targets_without_changing_passwords(): void
    {
        $studentAccount = $this->createUser('target@sikes.sch.id', 'siswa', 'siswa123');
        $adminAccount = $this->createUser('admin@example.test', 'admin', 'siswa123');
        $studentHash = $studentAccount->password;
        $adminHash = $adminAccount->password;

        $this->artisan('sipintu:reset-default-passwords')
            ->expectsOutputToContain('Mode: SIMULASI')
            ->expectsOutputToContain('Jumlah target sebelum: 1')
            ->expectsOutputToContain('"siswa":1')
            ->expectsOutputToContain('Jumlah target sesudah simulasi: 1')
            ->expectsOutputToContain('Akun yatim email @sikes.sch.id tanpa baris siswa: 1')
            ->assertExitCode(0);

        $this->assertSame($studentHash, $studentAccount->fresh()->password);
        $this->assertSame($adminHash, $adminAccount->fresh()->password);
        $this->assertTrue(Hash::check('siswa123', $studentAccount->fresh()->password));
    }

    public function test_go_changes_only_non_admin_accounts_with_the_default_password(): void
    {
        $studentAccount = $this->createUser('target@sikes.sch.id', 'siswa', 'siswa123');
        $adminAccount = $this->createUser('admin@example.test', 'admin', 'siswa123');
        $superAdmin = $this->createUser('super@example.test', 'super-admin', 'siswa123');
        $otherPassword = $this->createUser('other@sikes.sch.id', 'petugas', 'another-secret');

        $this->artisan('sipintu:reset-default-passwords', ['--go' => true])
            ->expectsOutputToContain('Mode: EKSEKUSI')
            ->expectsOutputToContain('Jumlah target sebelum: 1')
            ->expectsOutputToContain('Jumlah target sesudah: 0')
            ->assertExitCode(0);

        $this->assertTrue(Hash::check('password', $studentAccount->fresh()->password));
        $this->assertTrue(Hash::check('siswa123', $adminAccount->fresh()->password));
        $this->assertTrue(Hash::check('siswa123', $superAdmin->fresh()->password));
        $this->assertTrue(Hash::check('another-secret', $otherPassword->fresh()->password));
    }

    protected function createUser(string $email, string $roleName, string $password): User
    {
        $user = User::factory()->create(['email' => $email, 'password' => $password]);
        $user->assignRole($roleName);

        return $user;
    }
}