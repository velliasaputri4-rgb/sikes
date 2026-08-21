@extends('layouts.admin')
@section('title', 'Edit Siswa')
@section('page-title', 'Edit Data Siswa')

@section('content')
    <style>
        :root { --navy-900: #0f172a; }
        .page-head { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
        .page-head h5 { font-weight: 800; color: var(--navy-900); margin-bottom: 2px; display: flex; align-items: center; gap: 10px; }
        .page-head h5 .head-icon { width: 38px; height: 38px; border-radius: 10px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; display: inline-flex; align-items: center; justify-content: center; font-size: 15px; box-shadow: 0 4px 10px rgba(245, 158, 11, 0.3); }
        .form-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; max-width: 640px; }
        .form-control:focus, .form-select:focus { border-color: #93c5fd; box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12); }
    </style>

    <div class="content-card">
        <div class="page-head">
            <div>
                <h5><span class="head-icon"><i class="fas fa-user-edit"></i></span> Edit Data Siswa</h5>
                <small class="text-muted">Perbarui informasi siswa</small>
            </div>
            <a href="{{ route('admin.students.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
        @endif

        <form method="POST" action="{{ route('admin.students.update', $student->id) }}" class="form-card">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">NIS <span class="text-danger">*</span></label>
                    <input type="text" name="nis" class="form-control" value="{{ old('nis', $student->nis) }}" required>
                </div>
                <div class="col-md-8 mb-3">
                    <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $student->full_name) }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Kelas <span class="text-danger">*</span></label>
                <input type="text" name="class_name" list="daftar-kelas" class="form-control" value="{{ old('class_name', $student->class->name ?? '') }}" placeholder="Pilih atau ketik kelas baru..." required>
                <datalist id="daftar-kelas">
                    @foreach($classes as $class)<option value="{{ $class->name }}"></option>@endforeach
                </datalist>
                <small class="text-muted"> Pilih dari daftar atau ketik nama kelas baru (otomatis dibuat).</small>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date', $student->birth_date) }}" required>
            </div>

            <button type="submit" class="btn btn-warning" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border: none; color: white;">
                <i class="fas fa-save me-1"></i> Update Data
            </button>
        </form>
    </div>
@endsection