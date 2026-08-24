@extends('layouts.admin')

@section('title', 'Edit Profil Saya')
@section('page-title', 'Edit Profil Akun')

@section('content')
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0"><i class="fas fa-user-cog me-2 text-primary"></i>Edit Profil Saya</h5>
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="alert alert-warning">
        <i class="fas fa-exclamation-triangle me-2"></i> Anda sedang mengedit data akun Anda sendiri (<strong>{{ $user->name }}</strong>). Anda tidak dapat mengubah role/peran akun dari halaman ini.
    </div>

    <form action="{{ route('admin.profile.update.self') }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            
            <div class="col-md-6">
                <label class="form-label fw-semibold">Email (untuk Login) <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Password Baru <span class="text-muted fw-normal">(Opsional)</span></label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Kosongkan jika tidak ingin mengubah">
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                <small class="text-muted">Minimal 8 karakter. Isi hanya jika perlu direset/diubah.</small>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
            </div>

            {{-- PERHATIAN: Tidak ada dropdown Role di sini agar user tidak bisa promosi diri sendiri --}}
            <div class="col-md-6">
                <label class="form-label fw-semibold">Role Saat Ini</label>
                <input type="text" class="form-control" value="{{ $user->roles->isNotEmpty() ? ucfirst($user->roles->first()->name) : 'Tidak ada' }}" disabled>
                <small class="text-muted">Hubungi Super Admin jika perlu perubahan role.</small>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4 pt-3 border-top">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary me-2">Batal</a>
            <button type="submit" class="btn btn-primary px-4">
                <i class="fas fa-save me-2"></i> Simpan Perubahan
            </button>
        </div.
    </form>
</div>
@endsection