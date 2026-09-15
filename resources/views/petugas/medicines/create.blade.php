@extends('layouts.petugas')

@section('title', 'Tambah Obat Baru')
@section('page-title', 'Tambah Obat Baru')

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
            padding: 24px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.04);
        }
        
        .form-section-title {
            font-weight: 700;
            font-size: 0.95rem;
            color: #991b1b;
            margin-bottom: 16px;
            padding-bottom: 10px;
            border-bottom: 1px solid #fee2e2;
            display: flex;
            align-items: center;
            gap: 8px;
        }
    </style>

    <div class="content-card">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <h5 class="fw-bold mb-0">
                <i class="fas fa-plus-circle me-2" style="color: #ef4444;"></i>Form Tambah Obat
            </h5>
            <a href="{{ route('petugas.medicines.index') }}" class="btn btn-sm" style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
            </a>
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

        <form action="{{ route('petugas.medicines.store') }}" method="POST">
            @csrf

            <div class="row g-4">
                {{-- Section: Informasi Dasar Obat --}}
                <div class="col-12">
                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="fas fa-pills"></i> Informasi Dasar Obat
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Kode Obat <span style="color: #ef4444;">*</span></label>
                                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}" placeholder="Contoh: OBT-001" required>
                                @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Obat <span style="color: #ef4444;">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Contoh: Paracetamol 500mg" required>
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Kolom Kegunaan / Keterangan Obat -->
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Kegunaan / Keterangan Obat</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Contoh: Untuk meredakan demam, sakit kepala, dan nyeri ringan">{{ old('description') }}</textarea>
                                <small class="text-muted mt-1 d-block">
                                    <i class="fas fa-info-circle me-1" style="color: #f59e0b;"></i>
                                    Jelaskan secara singkat kegunaan atau manfaat obat ini.
                                </small>
                                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Section: Stok & Satuan --}}
                <div class="col-12">
                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="fas fa-boxes-stacked"></i> Stok & Satuan
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Stok Awal <span style="color: #ef4444;">*</span></label>
                                <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', 0) }}" min="0" required>
                                @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Stok Minimum</label>
                                <input type="number" name="minimum_stock" class="form-control @error('minimum_stock') is-invalid @enderror" value="{{ old('minimum_stock', 5) }}" min="0">
                                <small class="text-muted mt-1 d-block">
                                    <i class="fas fa-bell me-1" style="color: #f59e0b;"></i>
                                    Peringatan jika stok ≤ angka ini
                                </small>
                                @error('minimum_stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Satuan <span style="color: #ef4444;">*</span></label>
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
                        </div>
                    </div>
                </div>

                {{-- Section: Tanggal Kedaluwarsa --}}
                <div class="col-12">
                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="fas fa-calendar-alt"></i> Masa Berlaku
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tanggal Kedaluwarsa</label>
                                <input type="date" name="expired_date" class="form-control @error('expired_date') is-invalid @enderror" value="{{ old('expired_date') }}">
                                <small class="text-muted mt-1 d-block">
                                    <i class="fas fa-exclamation-circle me-1" style="color: #ef4444;"></i>
                                    Obat yang sudah kedaluwarsa tidak boleh digunakan.
                                </small>
                                @error('expired_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4 pt-3" style="border-top: 1px solid #fee2e2;">
                <a href="{{ route('petugas.medicines.index') }}" class="btn" style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;">
                    <i class="fas fa-times me-1"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary-custom px-4">
                    <i class="fas fa-save me-2"></i> Simpan Obat
                </button>
            </div>
        </form>
    </div>
@endsection