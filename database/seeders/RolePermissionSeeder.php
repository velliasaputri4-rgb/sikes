<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Buat Permissions
        Permission::firstOrCreate(['name' => 'manage-users']);
        Permission::firstOrCreate(['name' => 'manage-cms']);
        Permission::firstOrCreate(['name' => 'manage-examinations']);
        Permission::firstOrCreate(['name' => 'manage-medicines']);
        Permission::firstOrCreate(['name' => 'view-reports']);

        // 2. Buat Roles
        Role::firstOrCreate(['name' => 'super-admin']);
        $adminRole   = Role::firstOrCreate(['name' => 'admin']);
        $petugasRole = Role::firstOrCreate(['name' => 'petugas']);
        Role::firstOrCreate(['name' => 'siswa']);

        // 3. Assign Permissions
        $adminRole->syncPermissions(Permission::all());
        $petugasRole->syncPermissions(['manage-examinations', 'manage-medicines', 'view-reports']);

        // 4. ✅ Buat akun Admin dengan password admin123
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@sikes.com'],
            [
                'name'              => 'Administrator',
                'password'          => Hash::make('admin123'), // ✅ Password baru
                'status'            => 'active',
                'email_verified_at' => now(),
            ]
        );
        $adminUser->syncRoles(['admin']);

        // 5. ✅ Buat akun Petugas dengan password petugas123
        $petugasUser = User::firstOrCreate(
            ['email' => 'petugas@sikes.com'],
            [
                'name'              => 'Petugas UKS',
                'password'          => Hash::make('petugas123'), // ✅ Password baru
                'status'            => 'active',
                'email_verified_at' => now(),
            ]
        );
        $petugasUser->syncRoles(['petugas']);

        $this->command->info('✅ Akun Admin & Petugas berhasil dibuat!');
        $this->command->info('📧 admin@sikes.com → admin123');
        $this->command->info('📧 petugas@sikes.com → petugas123');
    }
}