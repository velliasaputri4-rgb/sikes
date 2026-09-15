@extends('layouts.petugas')
@section('title', 'Pinjam Barang')
@section('page-title', 'Form Peminjaman Barang')

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
                    <span class="head-icon"><i class="fas fa-hand-holding-medical"></i></span> 
                    Pinjam Barang Baru
                </h5>
                <small class="text-muted">Ketik manual — sistem mencocokkan otomatis</small>
            </div>
            <a href="{{ route('petugas.borrowings.index') }}" class="btn btn-sm" style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;">
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

        <form method="POST" action="{{ route('petugas.borrowings.store') }}" class="form-card">
            @csrf
            
            {{-- Section: Data Peminjaman --}}
            <div class="mb-4">
                <div class="form-section-title">
                    <i class="fas fa-user-graduate"></i> Data Peminjaman
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Peminjam — NIS / Nama Siswa <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="student_input" list="daftar-siswa" class="form-control" value="{{ old('student_input') }}" placeholder="Ketik NIS atau nama siswa..." required>
                    <datalist id="daftar-siswa">
                        @foreach($students ?? [] as $s)
                            <option value="{{ $s->nis }}">{{ $s->full_name }}</option>
                        @endforeach
                    </datalist>
                    <div class="datalist-hint">
                        <i class="fas fa-info-circle"></i>
                        <span>Ketik manual atau pilih saran. Siswa harus sudah terdaftar.</span>
                    </div>
                </div>
            </div>

            {{-- Section: Data Barang --}}
            <div class="mb-4">
                <div class="form-section-title">
                    <i class="fas fa-box"></i> Data Barang
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-semibold">Barang yang Dipinjam <span style="color: #ef4444;">*</span></label>
                    <input type="text" name="item_input" list="daftar-barang" class="form-control" value="{{ old('item_input') }}" placeholder="Ketik nama barang..." required>
                    <datalist id="daftar-barang">
                        @foreach($items ?? [] as $item)
                            <option value="{{ $item->name }}">Tersedia: {{ $item->available ?? 0 }}</option>
                        @endforeach
                    </datalist>
                    <div class="datalist-hint">
                        <i class="fas fa-lightbulb"></i>
                        <span>Barang yang belum ada akan otomatis ditambahkan ke inventaris.</span>
                    </div>
                </div>
            </div>

            {{-- Section: Jadwal Peminjaman --}}
            <div class="mb-4">
                <div class="form-section-title">
                    <i class="fas fa-calendar-alt"></i> Jadwal Peminjaman
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Tanggal Pinjam <span style="color: #ef4444;">*</span></label>
                        <input type="date" name="borrow_date" class="form-control" value="{{ old('borrow_date', date('Y-m-d')) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Rencana Kembali</label>
                        <input type="date" name="expected_return_date" class="form-control" value="{{ old('expected_return_date') }}">
                        <div class="datalist-hint">
                            <i class="fas fa-clock"></i>
                            <span>Kosongkan jika tidak ada jadwal pasti</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Section: Keterangan --}}
            <div class="mb-4">
                <div class="form-section-title">
                    <i class="fas fa-sticky-note"></i> Keterangan
                </div>
                
                <textarea name="notes" class="form-control" rows="3" placeholder="Catatan tambahan (opsional)">{{ old('notes') }}</textarea>
            </div>

            <div class="d-flex gap-2 pt-3" style="border-top: 1px solid #fee2e2;">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fas fa-save me-1"></i> Simpan Peminjaman
                </button>
                <button type="reset" class="btn" style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;">
                    <i class="fas fa-undo me-1"></i> Reset Form
                </button>
            </div>
        </form>
    </div>
@endsection