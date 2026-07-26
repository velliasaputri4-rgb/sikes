@extends('layouts.app')

@section('page-title', 'Dashboard Petugas')

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card" style="border-left-color: #2563EB;">
                <p>Kunjungan Hari Ini</p>
                <h3 class="text-primary">{{ $exams_today ?? 0 }}</h3>
                <small class="text-muted">Siswa</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card" style="border-left-color: #10b981;">
                <p>Kunjungan Bulan Ini</p>
                <h3 class="text-success">{{ $exams_month ?? 0 }}</h3>
                <small class="text-muted">Kunjungan</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card" style="border-left-color: #ef4444;">
                <p>Stok Obat Menipis</p>
                <h3 class="text-danger">{{ $low_stock ?? 0 }}</h3>
                <small class="text-muted">Obat</small>
            </div>
        </div>
    </div>

    <div class="content-card">
        <h5 class="fw-bold mb-3">Menu Input Data</h5>
        <div class="row g-3">
            <div class="col-md-4">
                <a href="{{ route('petugas.examinations.create') }}" class="btn btn-primary w-100 p-4">
                    <i class="fas fa-plus-circle fa-2x mb-2"></i>
                    <div class="fw-bold">Input Kunjungan</div>
                    <small>Catat pemeriksaan siswa</small>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('petugas.examinations.index') }}" class="btn btn-outline-primary w-100 p-4">
                    <i class="fas fa-list fa-2x mb-2"></i>
                    <div class="fw-bold">Data Kunjungan</div>
                    <small>Lihat riwayat pemeriksaan</small>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('petugas.medicines.index') }}" class="btn btn-outline-warning w-100 p-4">
                    <i class="fas fa-pills fa-2x mb-2"></i>
                    <div class="fw-bold">Data Obat</div>
                    <small>Kelola stok obat</small>
                </a>
            </div>
        </div>
    </div>
@endsection