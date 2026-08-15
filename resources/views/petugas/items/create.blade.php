@extends('layouts.petugas')
@section('title', 'Tambah Barang')
@section('page-title', 'Tambah Barang Inventaris')

@section('content')
    <style>
        :root { --navy-900: #0f172a; }
        .page-head { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
        .page-head h5 { font-weight: 800; color: var(--navy-900); margin-bottom: 2px; display: flex; align-items: center; gap: 10px; }
        .page-head h5 .head-icon { width: 38px; height: 38px; border-radius: 10px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: white; display: inline-flex; align-items: center; justify-content: center; font-size: 15px; box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3); }
        .form-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; max-width: 640px; }
        .form-control:focus, .form-select:focus { border-color: #93c5fd; box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12); }
    </style>

    <div class="content-card">
        <div class="page-head">
            <div>
                <h5><span class="head-icon"><i class="fas fa-medkit"></i></span> Tambah Barang Baru</h5>
                <small class="text-muted">Tambahkan perlengkapan atau peralatan UKS</small>
            </div>
            <a href="{{ route('petugas.items.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
        @endif

        <form method="POST" action="{{ route('petugas.items.store') }}" class="form-card">
            @csrf
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Kode Barang <span class="text-danger">*</span></label>
                    <input type="text" name="code" class="form-control" value="{{ old('code') }}" placeholder="Contoh: UKS-001" required>
                </div>
                <div class="col-md-8 mb-3">
                    <label class="form-label fw-semibold">Nama Barang <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Contoh: Tandu" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Stok <span class="text-danger">*</span></label>
                    <input type="number" name="quantity" class="form-control" value="{{ old('quantity', 1) }}" min="0" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Kategori</label>
                    <input type="text" name="category" class="form-control" value="{{ old('category') }}" placeholder="Contoh: Alat Medis">
                </div>
                {{-- ✅ NILAI DATABASE: good / damaged --}}
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Kondisi</label>
                    <select name="condition" class="form-select">
                        <option value="good" {{ old('condition', 'good') == 'good' ? 'selected' : '' }}>Baik</option>
                        <option value="damaged" {{ old('condition') == 'damaged' ? 'selected' : '' }}>Rusak</option>
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Keterangan</label>
                <textarea name="description" class="form-control" rows="3" placeholder="Catatan tambahan (opsional)">{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary-custom"><i class="fas fa-save me-1"></i> Simpan Barang</button>
        </form>
    </div>
@endsection