@extends('layouts.petugas')
@section('title', 'Tambah Siswa')
@section('page-title', 'Tambah Siswa')

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

        /* Section divider */
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
        <div class="page-head">
            <div>
                <h5>
                    <span class="head-icon"><i class="fas fa-user-plus"></i></span> 
                    Tambah Siswa Baru
                </h5>
                <small class="text-muted">Data akan langsung tersimpan ke database</small>
            </div>
            <a href="{{ route('petugas.students.index') }}" class="btn btn-sm" style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;">
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

        <form method="POST" action="{{ route('petugas.students.store') }}" class="form-card">
            @csrf
            
            {{-- Section: Data Pribadi Siswa --}}
            <div class="mb-4">
                <div class="form-section-title">
                    <i class="fas fa-user-graduate"></i> Data Pribadi Siswa
                </div>
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">NIS <span style="color: #ef4444;">*</span></label>
                        <input type="text" name="nis" class="form-control" value="{{ old('nis') }}" placeholder="Contoh: 12345" required>
                    </div>
                    <div class="col-md-8 mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap <span style="color: #ef4444;">*</span></label>
                        <input type="text" name="full_name" class="form-control" value="{{ old('full_name') }}" placeholder="Nama lengkap sesuai ijazah" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Kelas <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="class_name" list="daftar-kelas" class="form-control" value="{{ old('class_name') }}" placeholder="Pilih atau ketik kelas baru..." required>
                    <datalist id="daftar-kelas">
                        @foreach($classes as $class)
                            <option value="{{ $class->name }}"></option>
                        @endforeach
                    </datalist>
                    <div class="datalist-hint">
                        <i class="fas fa-lightbulb"></i>
                        <span>Pilih dari daftar atau ketik nama kelas baru (otomatis dibuat).</span>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Tanggal Lahir <span style="color: #ef4444;">*</span></label>
                    <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date') }}" required>
                </div>
            </div>

            {{-- Section: Data Wali --}}
            <div class="mb-4">
                <div class="form-section-title">
                    <i class="fas fa-users"></i> Data Wali / Orang Tua
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">No. HP Wali <span class="text-muted fw-normal" style="font-size: 0.85rem;">(Opsional)</span></label>
                    <input type="tel" name="parent_phone" class="form-control" value="{{ old('parent_phone') }}" placeholder="08xxxxxxxxxx" inputmode="tel">
                    <div class="datalist-hint">
                        <i class="fas fa-phone"></i>
                        <span>Nomor telepon orang tua/wali yang dapat dihubungi saat darurat.</span>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 pt-3" style="border-top: 1px solid #fee2e2;">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fas fa-save me-1"></i> Simpan Siswa
                </button>
                <button type="reset" class="btn" style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;">
                    <i class="fas fa-undo me-1"></i> Reset Form
                </button>
            </div>
        </form>
    </div>
@endsection