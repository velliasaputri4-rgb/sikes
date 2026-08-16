@extends('layouts.petugas')
@section('title', 'Pinjam Barang')
@section('page-title', 'Form Peminjaman Barang')

@section('content')
    <style>
        :root { --navy-900: #0f172a; }
        .page-head { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
        .page-head h5 { font-weight: 800; color: var(--navy-900); margin-bottom: 2px; display: flex; align-items: center; gap: 10px; }
        .page-head h5 .head-icon { width: 38px; height: 38px; border-radius: 10px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: white; display: inline-flex; align-items: center; justify-content: center; font-size: 15px; box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3); }
        .form-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; max-width: 640px; }
        .form-control:focus { border-color: #93c5fd; box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12); }
    </style>

    <div class="content-card">
        <div class="page-head">
            <div>
                <h5><span class="head-icon"><i class="fas fa-hand-holding-medical"></i></span> Pinjam Barang Baru</h5>
                <small class="text-muted">Ketik manual — sistem mencocokkan otomatis</small>
            </div>
            <a href="{{ route('petugas.borrowings.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
        @endif

        <form method="POST" action="{{ route('petugas.borrowings.store') }}" class="form-card">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Peminjam — NIS / Nama Siswa <span class="text-danger">*</span></label>
                <input type="text" name="student_input" list="daftar-siswa" class="form-control" value="{{ old('student_input') }}" placeholder="Ketik NIS atau nama siswa..." required>
                <datalist id="daftar-siswa">
                    @foreach($students ?? [] as $s)
                        <option value="{{ $s->nis }}">{{ $s->full_name }}</option>
                    @endforeach
                </datalist>
                <small class="text-muted">Ketik manual atau pilih saran. Siswa harus sudah terdaftar.</small>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Barang yang Dipinjam <span class="text-danger">*</span></label>
                <input type="text" name="item_input" list="daftar-barang" class="form-control" value="{{ old('item_input') }}" placeholder="Ketik nama barang..." required>
                <datalist id="daftar-barang">
                    @foreach($items ?? [] as $item)
                        <option value="{{ $item->name }}">Tersedia: {{ $item->available ?? 0 }}</option>
                    @endforeach
                </datalist>
                <small class="text-muted">Barang yang belum ada akan otomatis ditambahkan ke inventaris.</small>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tanggal Pinjam <span class="text-danger">*</span></label>
                    <input type="date" name="borrow_date" class="form-control" value="{{ old('borrow_date', date('Y-m-d')) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Rencana Kembali</label>
                    <input type="date" name="expected_return_date" class="form-control" value="{{ old('expected_return_date') }}">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Keterangan</label>
                <textarea name="notes" class="form-control" rows="3" placeholder="Catatan tambahan (opsional)">{{ old('notes') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary-custom"><i class="fas fa-save me-1"></i> Simpan Peminjaman</button>
        </form>
    </div>
@endsection