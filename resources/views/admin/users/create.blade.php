@extends('layouts.admin')

@section('title', 'Tambah User')
@section('page-title', 'Tambah Akun Admin/Petugas')

@section('content')
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0"><i class="fas fa-user-plus me-2 text-primary"></i>Form Tambah Akun</h5>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="alert alert-info">
        <i class="fas fa-info-circle me-2"></i> Gunakan form ini hanya untuk membuat akun login <strong>Admin</strong> atau <strong>Petugas</strong>. Untuk mendaftarkan siswa, silakan gunakan menu <strong>Data Siswa</strong>.
    </div>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Email (untuk Login) <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="cth: petugas@sikes.com" required>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Minimal 8 karakter" required>
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Konfirmasi Password <span class="text-danger">*</span></label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Berikan Role <span class="text-danger">*</span></label>
                <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                    <option value="">-- Pilih Peran --</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
                @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        <div class="d-flex justify-content-end mt-4 pt-3 border-top">
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary me-2">Batal</a>
            <button type="submit" class="btn btn-primary px-4">
                <i class="fas fa-save me-2"></i> Simpan Akun
            </button>
        </div>
    </form>
</div>
@endsection