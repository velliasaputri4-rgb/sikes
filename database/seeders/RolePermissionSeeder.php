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

        // 1. Buat Permissions (Contoh)
        Permission::firstOrCreate(['name' => 'manage-users']);
        Permission::firstOrCreate(['name' => 'manage-cms']);
        Permission::firstOrCreate(['name' => 'manage-examinations']);
        Permission::firstOrCreate(['name' => 'manage-medicines']);
        Permission::firstOrCreate(['name' => 'view-reports']);

        // 2. Buat Roles
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $petugas = Role::firstOrCreate(['name' => 'petugas']);
        $siswa = Role::firstOrCreate(['name' => 'siswa']);

        // 3. Assign Permissions ke Role
        $superAdmin->syncPermissions(Permission::all());
        $admin->syncPermissions(Permission::where('name', '!=', 'manage-users')->get()); // Admin tidak bisa atur user super admin
        $petugas->syncPermissions(['manage-examinations', 'manage-medicines', 'view-reports']);
        $siswa->syncPermissions([]); // Siswa hanya bisa lihat dashboard & riwayat

        // 4. Buat Akun Super Admin Default
        $superAdminUser = User::firstOrCreate(
            ['email' => 'superadmin@sikes.com'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('password'), // Password default
                'status' => 'active',
            ]
        );
        $superAdminUser->assignRole('super-admin');

        $this->command->info('✅ Roles, Permissions, and Super Admin seeded successfully!');
    }
}