@extends('layouts.petugas')

@section('title', 'Kelola User')
@section('page-title', 'Manajemen User')

@section('content')
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-0"><i class="fas fa-users-cog me-2 text-primary"></i>Daftar User</h5>
            <small class="text-muted">Kelola akun login untuk staf UKS. Data siswa dikelola di menu "Data Siswa".</small>
        </div>
        @php $isMainAdmin = auth()->user()->email === 'admin@sikes.com' || auth()->user()->hasRole('super-admin'); @endphp
        
        {{-- Tombol Tambah Hanya Muncul untuk Main Admin --}}
        @if($isMainAdmin)
            <a href="{{ route('petugas.users.create') }}" class="btn btn-primary-custom">
                <i class="fas fa-plus me-1"></i> Tambah Akun Baru
            </a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="bg-light">
                <tr>
                    <th class="ps-3">Nama Lengkap</th>
                    <th>Email Login</th>
                    <th>Role / Peran</th>
                    <th class="text-end pe-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td class="ps-3 fw-semibold">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach($user->roles as $role)
                                @php
                                    $badgeClass = 'bg-secondary';
                                    if ($role->name === 'super-admin') $badgeClass = 'bg-danger';
                                    elseif ($role->name === 'admin') $badgeClass = 'bg-primary';
                                    elseif ($role->name === 'petugas') $badgeClass = 'bg-success';
                                @endphp
                                <span class="badge {{ $badgeClass }}">
                                    {{ ucfirst(str_replace('-', ' ', $role->name)) }}
                                </span>
                            @endforeach

                            @if($user->roles->isEmpty() && isset($user->role))
                                @php
                                    $badgeClass = 'bg-secondary';
                                    if ($user->role === 'super-admin') $badgeClass = 'bg-danger';
                                    elseif ($user->role === 'admin') $badgeClass = 'bg-primary';
                                    elseif ($user->role === 'petugas') $badgeClass = 'bg-success';
                                @endphp
                                <span class="badge {{ $badgeClass }}">
                                    {{ ucfirst(str_replace('-', ' ', $user->role)) }}
                                </span>
                            @endif
                        </td>
                        <td class="text-end pe-3">
                            @php
                                $currentUser = auth()->user();
                                // Cek apakah yang login adalah admin@sikes.com atau super-admin
                                $isMainAdmin = strtolower(trim($currentUser->email)) === 'admin@sikes.com' || $currentUser->hasRole('super-admin');
                                // Cek apakah user di tabel adalah akun sendiri
                                $isSelf = $user->id === $currentUser->id;
                            @endphp

                            {{-- TOMBOL EDIT: Muncul jika Main Admin ATAU jika itu adalah akun sendiri --}}
                            @if($isMainAdmin || $isSelf)
                                <a href="{{ route('petugas.users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endif

                            {{-- TOMBOL HAPUS: HANYA muncul jika Main Admin DAN BUKAN akun sendiri --}}
                            @if($isMainAdmin && !$isSelf)
                                <form action="{{ route('petugas.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user {{ $user->name }}? Tindakan ini tidak dapat dibatalkan.')">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @elseif($isSelf)
                                {{-- Badge untuk akun sendiri (Tidak bisa dihapus untuk mencegah lockout) --}}
                                <span class="badge bg-secondary" title="Anda tidak dapat menghapus akun Anda sendiri dari halaman ini">
                                    <i class="fas fa-lock me-1"></i> Akun Anda
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">
                            <i class="fas fa-users-slash fa-2x mb-2 d-block opacity-50"></i>
                            Belum ada data user.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-3">
        {{ $users->links() }}
    </div>
</div>
@endsection