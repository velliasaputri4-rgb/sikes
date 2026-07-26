@extends('layouts.app')

@section('page-title', 'Dashboard Admin')

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card" style="border-left-color: #2563EB;">
                <p>Total Kunjungan Hari Ini</p>
                <h3 class="text-primary">{{ $exams_today ?? 0 }}</h3>
                <small class="text-muted">Siswa</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="border-left-color: #10b981;">
                <p>Total Kunjungan Bulan Ini</p>
                <h3 class="text-success">{{ $exams_month ?? 0 }}</h3>
                <small class="text-muted">Kunjungan</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="border-left-color: #f59e0b;">
                <p>Total Siswa</p>
                <h3 class="text-warning">{{ $total_siswa ?? 0 }}</h3>
                <small class="text-muted">Siswa</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="border-left-color: #ef4444;">
                <p>Stok Obat Menipis</p>
                <h3 class="text-danger">{{ $low_stock ?? 0 }}</h3>
                <small class="text-muted">Obat</small>
            </div>
        </div>
    </div>

    <div class="content-card">
        <h5 class="fw-bold mb-3">Menu Cepat Admin</h5>
        <div class="row g-3">
            <div class="col-md-3">
                <a href="{{ route('admin.students.index') }}" class="btn btn-outline-primary w-100 p-3">
                    <i class="fas fa-user-graduate fa-2x mb-2"></i>
                    <div>Data Siswa</div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('admin.examinations.index') }}" class="btn btn-outline-success w-100 p-3">
                    <i class="fas fa-clipboard-list fa-2x mb-2"></i>
                    <div>Data Kunjungan</div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('admin.medicines.index') }}" class="btn btn-outline-warning w-100 p-3">
                    <i class="fas fa-pills fa-2x mb-2"></i>
                    <div>Data Obat</div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{ route('admin.cms.index') }}" class="btn btn-outline-info w-100 p-3">
                    <i class="fas fa-globe fa-2x mb-2"></i>
                    <div>CMS Website</div>
                </a>
            </div>
        </div>
    </div>
@endsection