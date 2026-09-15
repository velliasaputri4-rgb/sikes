@extends('layouts.petugas')

@section('title', 'Edit Obat')
@section('page-title', 'Edit Data Obat')

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
                <i class="fas fa-edit me-2" style="color: #ef4444;"></i>Edit Data Obat
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

        <form action="{{ route('petugas.medicines.update', $medicine->id) }}" method="POST">
            @csrf
            @method('PUT')

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
                                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code', $medicine->code) }}" placeholder="Contoh: OBT-001" required>
                                @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Obat <span style="color: #ef4444;">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $medicine->name) }}" placeholder="Contoh: Paracetamol 500mg" required>
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <!-- Kolom Kegunaan / Keterangan Obat -->
                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Kegunaan / Keterangan Obat</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Contoh: Untuk meredakan demam, sakit kepala, dan nyeri ringan">{{ old('description', $medicine->description) }}</textarea>
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
                                <label class="form-label fw-semibold">Stok <span style="color: #ef4444;">*</span></label>
                                <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $medicine->stock) }}" min="0" required>
                                @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Stok Minimum</label>
                                <input type="number" name="minimum_stock" class="form-control @error('minimum_stock') is-invalid @enderror" value="{{ old('minimum_stock', $medicine->minimum_stock) }}" min="0">
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
                                <input type="date" name="expired_date" class="form-control @error('expired_date') is-invalid @enderror" value="{{ old('expired_date', $medicine->expired_date ? \Carbon\Carbon::parse($medicine->expired_date)->format('Y-m-d') : '') }}">
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
                    <i class="fas fa-save me-2"></i> Perbarui Obat
                </button>
            </div>
        </form>
    </div>
@endsection