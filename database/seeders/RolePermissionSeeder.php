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

        // 2. Buat Roles (Tetap dibuat semua untuk jaga-jaga jika ada middleware yang mengeceknya)
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin']);
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $petugasRole = Role::firstOrCreate(['name' => 'petugas']);
        $siswaRole = Role::firstOrCreate(['name' => 'siswa']);

        // 3. Assign Permissions ke Role
        $superAdminRole->syncPermissions(Permission::all());
        $adminRole->syncPermissions(Permission::where('name', '!=', 'manage-users')->get());
        $petugasRole->syncPermissions(['manage-examinations', 'manage-medicines', 'view-reports']);
        $siswaRole->syncPermissions([]);

        // 4. Buat Akun Super Admin (Untuk Login Dashboard Admin)
        $superAdminUser = User::firstOrCreate(
            ['email' => 'superadmin@sikes.com'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('password'), 
                'status' => 'active',
            ]
        );
        $superAdminUser->assignRole('super-admin');

        // 5. Buat Akun Petugas (Untuk Login Dashboard Petugas)
        $petugasUser = User::firstOrCreate(
            ['email' => 'petugas@sikes.com'],
            [
                'name' => 'Petugas UKS',
                'password' => Hash::make('password'), 
                'status' => 'active',
            ]
        );
        $petugasUser->assignRole('petugas');

        $this->command->info('✅ Akun Super Admin dan Petugas berhasil dibuat!');
    }
}