@extends('layouts.petugas')

@section('title', 'Tambah User')
@section('page-title', 'Tambah Akun Petugas')

@section('content')
<style>
    /* Border input default merah muda */
    .form-control, .form-select {
        border-color: #fecaca;
    }
    
    /* Focus state MERAH, bukan biru */
    .form-control:focus, .form-select:focus { 
        border-color: #fca5a5 !important; 
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.12) !important; 
    }
    
    /* Alert info tema amber (untuk pesan panduan) */
    .alert-info-custom {
        background: #fffbeb;
        color: #92400e;
        border: 1px solid #fde68a;
        border-left: 4px solid #f59e0b;
        border-radius: 10px;
        padding: 14px 18px;
        margin-bottom: 20px;
    }
    
    /* Alert error tema merah */
    .alert-danger-custom {
        background: #fef2f2;
        color: #991b1b;
        border: 1px solid #fecaca;
        border-left: 4px solid #ef4444;
        border-radius: 10px;
        padding: 14px 18px;
        margin-bottom: 20px;
    }
    .alert-danger-custom ul {
        margin: 6px 0 0 0;
        padding-left: 20px;
    }

    /* Form section card */
    .form-section {
        background: #ffffff;
        border: 1px solid #fee2e2;
        border-radius: 16px;
        padding: 28px;
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.04);
    }
</style>

<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h5 class="fw-bold mb-0">
            <i class="fas fa-user-plus me-2" style="color: #ef4444;"></i>Form Tambah Akun
        </h5>
        <a href="{{ route('petugas.users.index') }}" class="btn btn-sm" style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="alert-info-custom">
        <i class="fas fa-info-circle me-2"></i> Gunakan form ini untuk membuat akun login <strong>Petugas</strong>. Untuk mendaftarkan data siswa, silakan gunakan menu <strong>Data Siswa</strong>.
    </div>

    @if ($errors->any())
        <div class="alert-danger-custom">
            <strong><i class="fas fa-exclamation-triangle me-1"></i> Gagal Menyimpan:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('petugas.users.store') }}" method="POST" class="form-section">
        @csrf
        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label fw-semibold">Nama Lengkap <span style="color: #ef4444;">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            
            <div class="col-md-6">
                <label class="form-label fw-semibold">Email (untuk Login) <span style="color: #ef4444;">*</span></label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="cth: petugas@sikes.com" required>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            
            <div class="col-md-6">
                <label class="form-label fw-semibold">Password <span style="color: #ef4444;">*</span></label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Minimal 8 karakter" required>
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            
            <div class="col-md-6">
                <label class="form-label fw-semibold">Konfirmasi Password <span style="color: #ef4444;">*</span></label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
            </div>
            
            <div class="col-md-6">
                <label class="form-label fw-semibold">Berikan Role <span style="color: #ef4444;">*</span></label>
                <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                    <option value="">-- Pilih Peran --</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{ old('role', 'petugas') == $role->name ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
                @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
        
        <div class="d-flex gap-2 pt-3 mt-4" style="border-top: 1px solid #fee2e2;">
            <a href="{{ route('petugas.users.index') }}" class="btn" style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;">
                <i class="fas fa-times me-1"></i> Batal
            </a>
            <button type="submit" class="btn btn-primary-custom">
                <i class="fas fa-save me-1"></i> Simpan Akun
            </button>
        </div>
    </form>
</div>
@endsection