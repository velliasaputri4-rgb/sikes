@extends('layouts.petugas')
@section('title', 'Edit Barang')
@section('page-title', 'Edit Barang Inventaris')

@section('content')
    <style>
        :root { 
            --ink: #0f172a;
            --primary: #ef4444;
            --primary-dark: #991b1b;
        }
        
        .page-head { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            flex-wrap: wrap; 
            gap: 12px; 
            margin-bottom: 20px; 
        }
        .page-head h5 { 
            font-weight: 800; 
            color: var(--ink); 
            margin-bottom: 2px; 
            display: flex; 
            align-items: center; 
            gap: 10px; 
        }
        /* ✅ PERUBAHAN: Gradient MERAH, bukan biru */
        .page-head h5 .head-icon { 
            width: 38px; 
            height: 38px; 
            border-radius: 10px; 
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); 
            color: white; 
            display: inline-flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 15px; 
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3); 
        }
        
        .form-card { 
            background: #ffffff; 
            border: 1px solid #fee2e2; 
            border-radius: 16px; 
            padding: 28px; 
            max-width: 720px;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.04);
        }
        
        /* ✅ PERUBAHAN: Focus state MERAH, bukan biru */
        .form-control:focus, .form-select:focus { 
            border-color: #fca5a5 !important; 
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.12) !important; 
        }
        
        /* Border input default merah muda */
        .form-control, .form-select {
            border-color: #fecaca;
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
    </style>

    <div class="content-card">
        <div class="page-head">
            <div>
                <h5>
                    <span class="head-icon"><i class="fas fa-edit"></i></span> 
                    Edit Barang
                </h5>
                <small class="text-muted">Perbarui data barang inventaris</small>
            </div>
            <a href="{{ route('petugas.items.index') }}" class="btn btn-sm" style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

        {{-- ✅ Alert error dengan tema merah --}}
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

        <form method="POST" action="{{ route('petugas.items.update', $item->id) }}" class="form-card">
            @csrf @method('PUT')
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Kode Barang <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="code" class="form-control" value="{{ old('code', $item->code) }}" required>
                </div>
                <div class="col-md-8 mb-3">
                    <label class="form-label fw-semibold">Nama Barang <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $item->name) }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Stok <span style="color: #ef4444;">*</span></label>
                    <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $item->quantity) }}" min="0" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Kategori</label>
                    <input type="text" name="category" class="form-control" value="{{ old('category', $item->category) }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Kondisi</label>
                    <select name="condition" class="form-select">
                        <option value="good" {{ old('condition', $item->condition) == 'good' ? 'selected' : '' }}>Baik</option>
                        <option value="damaged" {{ old('condition', $item->condition) == 'damaged' ? 'selected' : '' }}>Rusak</option>
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Keterangan</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $item->description) }}</textarea>
            </div>

            <div class="d-flex gap-2 pt-3" style="border-top: 1px solid #fee2e2;">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fas fa-save me-1"></i> Simpan Perubahan
                </button>
                <a href="{{ route('petugas.items.index') }}" class="btn" style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;">
                    <i class="fas fa-times me-1"></i> Batal
                </a>
            </div>
        </form>
    </div>
@endsection