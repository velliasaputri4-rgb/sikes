@extends('layouts.admin')

@section('title', 'Edit User')
@section('page-title', 'Edit Data Pengguna')

@section('content')
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">
            <i class="fas fa-user-edit me-2 text-primary"></i>
            Edit Data: {{ $user->name }}
        </h5>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>

    {{-- ⚠️ INI KUNCINYA: Pastikan route-nya admin.users.update dan mengirim $user->id --}}
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
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
                <small class="text-muted">Minimal 8 karakter. Isi hanya jika perlu direset.</small>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru">
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Role / Peran <span class="text-danger">*</span></label>
                <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
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
                <i class="fas fa-save me-2"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection