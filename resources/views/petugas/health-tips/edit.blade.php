@extends('layouts.petugas')

@section('title', 'Edit Tips Kesehatan')
@section('page-title', 'Edit Tips Kesehatan')

@section('content')
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0 text-dark">
            <i class="fas fa-edit text-warning me-2"></i>Edit Informasi Tips Kesehatan
        </h5>
        <a href="{{ route('petugas.health-tips.index') }}" class="btn btn-sm btn-light border">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <form action="{{ route('petugas.health-tips.update', $healthTip->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label fw-semibold text-dark">Judul Tips <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                   id="title" name="title" value="{{ old('title', $healthTip->title) }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category" class="form-label fw-semibold text-dark">Kategori <span class="text-danger">*</span></label>
            <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="gizi" {{ old('category', $healthTip->category) == 'gizi' ? 'selected' : '' }}>Gizi & Makanan</option>
                <option value="kebersihan" {{ old('category', $healthTip->category) == 'kebersihan' ? 'selected' : '' }}>Kebersihan Diri & Lingkungan</option>
                <option value="penyakit" {{ old('category', $healthTip->category) == 'penyakit' ? 'selected' : '' }}>Pencegahan Penyakit</option>
                <option value="kesehatan_mental" {{ old('category', $healthTip->category) == 'kesehatan_mental' ? 'selected' : '' }}>Kesehatan Mental</option>
                <option value="p3k" {{ old('category', $healthTip->category) == 'p3k' ? 'selected' : '' }}>Pertolongan Pertama (P3K)</option>
                <option value="umum" {{ old('category', $healthTip->category) == 'umum' ? 'selected' : '' }}>Kesehatan Umum</option>
            </select>
            @error('category')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="content" class="form-label fw-semibold text-dark">Isi Lengkap Tips <span class="text-danger">*</span></label>
            <textarea class="form-control @error('content') is-invalid @enderror" 
                      id="content" name="content" rows="8" required>{{ old('content', $healthTip->content) }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary-custom">
                <i class="fas fa-save me-1"></i> Simpan Perubahan
            </button>
            <a href="{{ route('petugas.health-tips.index') }}" class="btn btn-light border">
                <i class="fas fa-times me-1"></i> Batal
            </a>
        </div>
    </form>
</div>
@endsection