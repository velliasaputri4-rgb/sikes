@extends('layouts.admin')

@section('title', 'Edit Obat')
@section('page-title', 'Edit Data Obat')

@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0"><i class="fas fa-edit me-2 text-primary"></i>Edit Data Obat</h5>
            <a href="{{ route('admin.medicines.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
            </a>
        </div>

        <form action="{{ route('admin.medicines.update', $medicine->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Kode Obat <span class="text-danger">*</span></label>
                    <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code', $medicine->code) }}" placeholder="Contoh: OBT-001" required>
                    @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nama Obat <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $medicine->name) }}" placeholder="Contoh: Paracetamol 500mg" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Stok <span class="text-danger">*</span></label>
                    <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $medicine->stock) }}" min="0" required>
                    @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Stok Minimum</label>
                    <input type="number" name="minimum_stock" class="form-control @error('minimum_stock') is-invalid @enderror" value="{{ old('minimum_stock', $medicine->minimum_stock) }}" min="0">
                    <small class="text-muted">Peringatan jika stok ≤ angka ini</small>
                    @error('minimum_stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Satuan <span class="text-danger">*</span></label>
                    <select name="unit" class="form-select @error('unit') is-invalid @enderror" required>
                        <option value="">-- Pilih Satuan --</option>
                        @php
                            $units = ['Tablet', 'Kapsul', 'Botol', 'Sachet', 'Tube', 'Pcs', 'Strip'];
                        @endphp
                        @foreach($units as $unit)
                            <option value="{{ $unit }}" {{ old('unit', $medicine->unit) == $unit ? 'selected' : '' }}>
                                {{ $unit }}
                            </option>
                        @endforeach
                    </select>
                    @error('unit') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-12">
                    <label class="form-label fw-semibold">Tanggal Kedaluwarsa</label>
                    <input type="date" name="expired_date" class="form-control @error('expired_date') is-invalid @enderror" value="{{ old('expired_date', $medicine->expired_date ? \Carbon\Carbon::parse($medicine->expired_date)->format('Y-m-d') : '') }}">
                    @error('expired_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                <a href="{{ route('admin.medicines.index') }}" class="btn btn-outline-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save me-2"></i> Perbarui Obat
                </button>
            </div>
        </form>
    </div>
@endsection