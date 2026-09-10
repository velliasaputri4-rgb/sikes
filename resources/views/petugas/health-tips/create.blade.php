@extends('layouts.petugas')

@section('title', 'Tambah Tips Kesehatan')
@section('page-title', 'Tambah Tips Kesehatan')

@section('content')
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0 text-dark">
            <i class="fas fa-plus-circle text-primary me-2"></i>Form Tambah Tips Kesehatan
        </h5>
        <a href="{{ route('petugas.health-tips.index') }}" class="btn btn-sm btn-light border">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <form action="{{ route('petugas.health-tips.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label fw-semibold text-dark">Judul Tips <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                   id="title" name="title" value="{{ old('title') }}" required 
                   placeholder="Contoh: Cara Mencegah Demam Berdarah">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category" class="form-label fw-semibold text-dark">Kategori <span class="text-danger">*</span></label>
            <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="gizi" {{ old('category') == 'gizi' ? 'selected' : '' }}>Gizi & Makanan</option>
                <option value="kebersihan" {{ old('category') == 'kebersihan' ? 'selected' : '' }}>Kebersihan Diri & Lingkungan</option>
                <option value="penyakit" {{ old('category') == 'penyakit' ? 'selected' : '' }}>Pencegahan Penyakit</option>
                <option value="kesehatan_mental" {{ old('category') == 'kesehatan_mental' ? 'selected' : '' }}>Kesehatan Mental</option>
                <option value="p3k" {{ old('category') == 'p3k' ? 'selected' : '' }}>Pertolongan Pertama (P3K)</option>
                <option value="umum" {{ old('category') == 'umum' ? 'selected' : '' }}>Kesehatan Umum</option>
            </select>
            @error('category')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="content" class="form-label fw-semibold text-dark">Isi Lengkap Tips <span class="text-danger">*</span></label>
            <textarea class="form-control @error('content') is-invalid @enderror" 
                      id="content" name="content" rows="8" required 
                      placeholder="Tuliskan penjelasan, langkah-langkah, atau edukasi lengkap di sini...">{{ old('content') }}</textarea>
            <div class="form-text text-muted">Tips: Gunakan enter untuk membuat paragraf baru agar mudah dibaca.</div>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary-custom">
                <i class="fas fa-save me-1"></i> Simpan Tips
            </button>
            <button type="reset" class="btn btn-light border">
                <i class="fas fa-undo me-1"></i> Reset Form
            </button>
        </div>
    </form>
</div>
@endsection