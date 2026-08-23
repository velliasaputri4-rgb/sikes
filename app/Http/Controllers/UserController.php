<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        // HANYA ambil user yang memiliki role 'admin' atau 'petugas'
        // Siswa dan Super-Admin tidak akan muncul di daftar ini
        $users = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['admin', 'petugas']);
        })->with('roles')->latest()->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        // HANYA tampilkan pilihan role 'admin' dan 'petugas'
        $roles = Role::whereIn('name', ['admin', 'petugas'])->get();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:admin,petugas', // Validasi ketat: hanya admin/petugas
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->assignRole($validated['role']);

        return redirect()->route('admin.users.index')->with('success', 'Akun Admin/Petugas berhasil dibuat!');
    }

    public function destroy(User $user)
    {
        // Cegah admin menghapus akun dirinya sendiri
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Akun pengguna berhasil dihapus.');
    }
}