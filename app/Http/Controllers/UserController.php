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

    public function index()
    {
        $allowedRoles = $this->isMainAdmin() 
            ? ['super-admin', 'admin', 'petugas'] 
            : ['admin', 'petugas'];

        $users = User::whereHas('roles', function ($query) use ($allowedRoles) {
            $query->whereIn('name', $allowedRoles);
        })->with('roles')->latest()->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $allowedRoles = $this->isMainAdmin() 
            ? ['super-admin', 'admin', 'petugas'] 
            : ['admin', 'petugas'];
            
        $roles = Role::whereIn('name', $allowedRoles)->get();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $allowedRoles = $this->isMainAdmin() 
            ? ['super-admin', 'admin', 'petugas'] 
            : ['admin', 'petugas'];

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

        return redirect()->route('admin.users.index')->with('success', 'Akun berhasil dibuat!');
    }

    public function edit(User $user)
    {
        // 🛡️ PENGAMAN BACKEND: Jika BUKAN Main Admin, DAN mencoba mengedit akun ORANG LAIN -> Blokir!
        if (!$this->isMainAdmin() && $user->id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit akun pengguna lain.');
        }

        $allowedRoles = $this->isMainAdmin() 
            ? ['super-admin', 'admin', 'petugas'] 
            : ['admin', 'petugas'];
            
        $roles = Role::whereIn('name', $allowedRoles)->get();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        // 🛡️ PENGAMAN BACKEND: Jika BUKAN Main Admin, DAN mencoba mengupdate akun ORANG LAIN -> Blokir!
        if (!$this->isMainAdmin() && $user->id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki izin untuk memperbarui akun pengguna lain.');
        }

        $allowedRoles = $this->isMainAdmin() 
            ? ['super-admin', 'admin', 'petugas'] 
            : ['admin', 'petugas'];

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

        return redirect()->route('admin.users.index')->with('success', 'Akun berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        if (!$this->isMainAdmin() && $user->hasRole('super-admin')) {
            return redirect()->route('admin.users.index')->with('error', 'Anda tidak memiliki izin untuk menghapus akun Super Admin.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Akun pengguna berhasil dihapus.');
    }

    /* ==========================================================
       FITUR: EDIT PROFIL SENDIRI (TIDAK BISA UBAH ROLE)
       ========================================================== */
    public function editSelf()
    {
        $user = auth()->user();
        return view('admin.users.edit-self', compact('user'));
    }

    public function updateSelf(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil Anda berhasil diperbarui!');
    }
}