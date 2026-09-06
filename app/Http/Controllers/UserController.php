<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * CEK APAKAH USER ADALAH MAIN ADMIN (admin@sikes.com) ATAU SUPER-ADMIN
     */
    private function isMainAdmin()
    {
        $user = auth()->user();
        if (!$user) return false;

        // Cek email (dibuat lowercase & di-trim agar aman dari spasi/typo)
        $isMainEmail = strtolower(trim($user->email)) === 'admin@sikes.com';
        
        // Atau cek apakah punya role super-admin
        $isSuperAdmin = $user->hasRole('super-admin');

        return $isMainEmail || $isSuperAdmin;
    }

    /**
     * Menampilkan daftar semua user (untuk dashboard Petugas)
     * TIDAK MENAMPILKAN SISWA
     */
    public function index()
    {
        // Hanya ambil user dengan role admin, super-admin, atau petugas (BUKAN siswa)
        $users = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['admin', 'super-admin', 'petugas']);
        })
        ->with('roles')
        ->latest()
        ->paginate(15);

        return view('petugas.users.index', compact('users'));
    }

    /**
     * Menampilkan form tambah user baru
     */
    public function create()
    {
        // Hanya Main Admin yang boleh menambah user baru
        if (!$this->isMainAdmin()) {
            abort(403, 'Hanya Administrator Utama yang dapat menambah akun baru.');
        }

        $roles = Role::whereIn('name', ['admin', 'super-admin', 'petugas'])->get();
        
        return view('petugas.users.create', compact('roles'));
    }

    /**
     * Menyimpan user baru ke database
     */
    public function store(Request $request)
    {
        if (!$this->isMainAdmin()) {
            abort(403, 'Hanya Administrator Utama yang dapat menambah akun baru.');
        }

        $allowedRoles = ['admin', 'super-admin', 'petugas'];

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:' . implode(',', $allowedRoles),
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->assignRole($validated['role']);

        return redirect()->route('petugas.users.index')
            ->with('success', 'Akun pengguna berhasil dibuat!');
    }

    /**
     * Menampilkan form edit user
     */
    public function edit(User $user)
    {
        // ️ PENGAMAN: Jika BUKAN Main Admin, DAN mencoba mengedit akun ORANG LAIN -> Blokir!
        if (!$this->isMainAdmin() && $user->id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit akun pengguna lain.');
        }

        $roles = Role::whereIn('name', ['admin', 'super-admin', 'petugas'])->get();
        
        return view('petugas.users.edit', compact('user', 'roles'));
    }

    /**
     * Memperbarui data user
     */
    public function update(Request $request, User $user)
    {
        // ️ PENGAMAN: Jika BUKAN Main Admin, DAN mencoba mengupdate akun ORANG LAIN -> Blokir!
        if (!$this->isMainAdmin() && $user->id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki izin untuk memperbarui akun pengguna lain.');
        }

        $allowedRoles = ['admin', 'super-admin', 'petugas'];

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role'     => 'required|in:' . implode(',', $allowedRoles),
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();
        $user->syncRoles([$validated['role']]);

        return redirect()->route('petugas.users.index')
            ->with('success', 'Data akun berhasil diperbarui!');
    }

    /**
     * Menghapus user
     */
    public function destroy(User $user)
    {
        // ️ PENGAMAN 1: Mencegah user menghapus akunnya sendiri (Mencegah Lockout)
        if ($user->id === auth()->id()) {
            return redirect()->route('petugas.users.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        // 🛡️ PENGAMAN 2: Hanya Main Admin yang boleh menghapus orang lain
        if (!$this->isMainAdmin()) {
            return redirect()->route('petugas.users.index')
                ->with('error', 'Hanya Administrator Utama (admin@sikes.com) yang dapat menghapus akun pengguna lain.');
        }

        // 🛡️ PENGAMAN 3: Mencegah penghapusan akun Super Admin oleh orang yang tidak berhak
        if ($user->hasRole('super-admin') && !$this->isMainAdmin()) {
            return redirect()->route('petugas.users.index')
                ->with('error', 'Akun Super Admin tidak dapat dihapus.');
        }

        $user->delete();
        
        return redirect()->route('petugas.users.index')
            ->with('success', 'Akun pengguna berhasil dihapus.');
    }
}