@extends('layouts.petugas')

@section('title', 'Tambah Obat Baru')
@section('page-title', 'Tambah Obat Baru')

@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0"><i class="fas fa-plus-circle me-2 text-success"></i>Form Tambah Obat</h5>
            <a href="{{ route('petugas.medicines.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
            </a>
        </div>

        <form action="{{ route('petugas.medicines.store') }}" method="POST">
            @csrf

            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Kode Obat <span class="text-danger">*</span></label>
                    <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}" placeholder="Contoh: OBT-001" required>
                    @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nama Obat <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Contoh: Paracetamol 500mg" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Kategori</label>
                    <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Stok Awal <span class="text-danger">*</span></label>
                    <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', 0) }}" min="0" required>
                    @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Stok Minimum</label>
                    <input type="number" name="minimum_stock" class="form-control @error('minimum_stock') is-invalid @enderror" value="{{ old('minimum_stock', 5) }}" min="0">
                    <small class="text-muted">Peringatan jika stok ≤ angka ini</small>
                    @error('minimum_stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Satuan <span class="text-danger">*</span></label>
                    <select name="unit" class="form-select @error('unit') is-invalid @enderror" required>
                        <option value="">-- Pilih Satuan --</option>
                        <option value="Tablet" {{ old('unit') == 'Tablet' ? 'selected' : '' }}>Tablet</option>
                        <option value="Kapsul" {{ old('unit') == 'Kapsul' ? 'selected' : '' }}>Kapsul</option>
                        <option value="Botol" {{ old('unit') == 'Botol' ? 'selected' : '' }}>Botol</option>
                        <option value="Sachet" {{ old('unit') == 'Sachet' ? 'selected' : '' }}>Sachet</option>
                        <option value="Tube" {{ old('unit') == 'Tube' ? 'selected' : '' }}>Tube</option>
                        <option value="Pcs" {{ old('unit') == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                    </select>
                    @error('unit') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tanggal Kedaluwarsa</label>
                    <input type="date" name="expired_date" class="form-control @error('expired_date') is-invalid @enderror" value="{{ old('expired_date') }}">
                    @error('expired_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                <a href="{{ route('petugas.medicines.index') }}" class="btn btn-outline-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary-custom px-4">
                    <i class="fas fa-save me-2"></i> Simpan Obat
                </button>
            </div>
        </form>
    </div>
@endsection