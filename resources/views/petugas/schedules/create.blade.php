@extends('layouts.petugas')

@section('title', 'Input Jadwal Petugas')
@section('page-title', 'Input Jadwal Petugas')

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
            padding: 28px;
            max-width: 720px;
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

        /* Datalist helper */
        .datalist-hint {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            color: #64748b;
            margin-top: 4px;
        }
        .datalist-hint i {
            color: #f59e0b;
        }
    </style>

    <div class="content-card">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <h5 class="fw-bold mb-0">
                <i class="fas fa-calendar-alt me-2" style="color: #ef4444;"></i>Input Jadwal Petugas
            </h5>
            <a href="{{ route('petugas.schedules.index') }}" class="btn btn-sm" style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;">
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

        <form action="{{ route('petugas.schedules.store') }}" method="POST" class="form-section">
            @csrf
            
            {{-- Section: Informasi Jadwal --}}
            <div class="mb-4">
                <div class="form-section-title">
                    <i class="fas fa-clock"></i> Informasi Jadwal
                </div>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Hari <span style="color: #ef4444;">*</span></label>
                        <input type="text" name="day" class="form-control" placeholder="Contoh: Senin - Jumat" value="{{ old('day') }}" required>
                        <div class="datalist-hint">
                            <i class="fas fa-calendar-day"></i>
                            <span>Masukkan rentang hari tugas petugas</span>
                        </div>
                        @error('day') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Jam Tugas <span style="color: #ef4444;">*</span></label>
                        <input type="text" name="time" class="form-control" placeholder="Contoh: 07:00 - 15:00" value="{{ old('time') }}" required>
                        <div class="datalist-hint">
                            <i class="fas fa-clock"></i>
                            <span>Format: HH:MM - HH:MM</span>
                        </div>
                        @error('time') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            {{-- Section: Data Petugas --}}
            <div class="mb-4">
                <div class="form-section-title">
                    <i class="fas fa-user-nurse"></i> Data Petugas
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Petugas <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="officer_name" class="form-control" placeholder="Masukkan nama petugas" value="{{ old('officer_name') }}" required>
                    <div class="datalist-hint">
                        <i class="fas fa-user"></i>
                        <span>Nama lengkap petugas yang bertugas</span>
                    </div>
                    @error('officer_name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="d-flex gap-2 pt-3" style="border-top: 1px solid #fee2e2;">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fas fa-save me-1"></i> Simpan Jadwal
                </button>
                <button type="reset" class="btn" style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;">
                    <i class="fas fa-undo me-1"></i> Reset Form
                </button>
            </div>
        </form>
    </div>
@endsection