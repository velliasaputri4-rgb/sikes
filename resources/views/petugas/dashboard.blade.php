@extends('layouts.petugas')

@section('title', 'Dashboard Petugas')
@section('page-title', 'Dashboard Petugas UKS')

@section('content')
    <!-- TOMBOL KEMBALI KE BERANDA -->
    <div class="mb-4">
        <a href="{{ route('landing') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-home me-1"></i> Kembali ke Beranda
        </a>
    </div>

    <!-- Statistik Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p>Kunjungan Hari Ini</p>
                        <h3 class="text-success">{{ $exams_today ?? 0 }}</h3>
                        <small class="text-muted">Siswa diperiksa</small>
                    </div>
                    <div class="stat-icon" style="background: #dcfce7; color: #16a34a;">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card" style="border-left-color: #3b82f6;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p>Kunjungan Bulan Ini</p>
                        <h3 class="text-primary">{{ $exams_month ?? 0 }}</h3>
                        <small class="text-muted">Total kunjungan</small>
                    </div>
                    <div class="stat-icon" style="background: #dbeafe; color: #2563EB;">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card" style="border-left-color: #ef4444;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p>Stok Obat Menipis</p>
                        <h3 class="text-danger">{{ $low_stock ?? 0 }}</h3>
                        <small class="text-muted">Perlu restock</small>
                    </div>
                    <div class="stat-icon" style="background: #fee2e2; color: #dc2626;">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="content-card mb-4">
        <h5 class="fw-bold mb-3"><i class="fas fa-bolt text-warning me-2"></i>Aksi Cepat</h5>
        <div class="row g-3">
            <div class="col-md-4">
                <a href="{{ route('petugas.examinations.create') }}" class="text-decoration-none">
                    <div class="p-4 border rounded-3 text-center hover-shadow" style="transition: all 0.2s; border-color: #10b981 !important;">
                        <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-plus fa-lg"></i>
                        </div>
                        <h6 class="fw-bold mb-1">Input Kunjungan Baru</h6>
                        <small class="text-muted">Catat pemeriksaan siswa</small>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('petugas.examinations.index') }}" class="text-decoration-none">
                    <div class="p-4 border rounded-3 text-center" style="transition: all 0.2s;">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-list fa-lg"></i>
                        </div>
                        <h6 class="fw-bold mb-1">Lihat Data Kunjungan</h6>
                        <small class="text-muted">Riwayat pemeriksaan</small>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('petugas.medicines.index') }}" class="text-decoration-none">
                    <div class="p-4 border rounded-3 text-center" style="transition: all 0.2s;">
                        <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-pills fa-lg"></i>
                        </div>
                        <h6 class="fw-bold mb-1">Kelola Stok Obat</h6>
                        <small class="text-muted">Cek & update stok</small>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Kunjungan Hari Ini (TABEL) -->
    <div class="row">
        <div class="col-12">
            <div class="content-card">
                <h6 class="fw-bold mb-3"><i class="fas fa-clock text-primary me-2"></i>Kunjungan Hari Ini</h6>

                @php
                    $todayExams = \App\Models\Examination::with(['student.class'])
                        ->whereDate('examination_date', \Carbon\Carbon::today())
                        ->latest('examination_date')
                        ->get();
                @endphp

                @if($todayExams->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th style="width: 30%;">SISWA</th>
                                    <th style="width: 20%;">KELAS</th>
                                    <th style="width: 30%;">KELUHAN</th>
                                    <th style="width: 10%;">STATUS</th>
                                    <th style="width: 10%;" class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($todayExams as $exam)
                                    <tr>
                                        <td>
                                            <div class="fw-bold text-uppercase" style="font-size: 0.95rem; letter-spacing: 0.3px;">
                                                {{ $exam->student->full_name ?? '-' }}
                                            </div>
                                            <small class="text-muted">{{ $exam->student->nis ?? '-' }}</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border" style="font-weight: 500; padding: 6px 12px;">
                                                {{ $exam->student->class->name ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="text-capitalize">{{ $exam->complaint ?? '-' }}</td>
                                        <td>
                                            @php
                                                $isSakit = in_array($exam->status, ['pulang', 'rawat_jalan', 'rujuk_puskesmas', 'rujuk_rs']);
                                            @endphp
                                            <span class="badge {{ $isSakit ? 'bg-danger' : 'bg-success' }} px-3 py-2">
                                                {{ $isSakit ? 'Sakit' : 'Sehat' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('petugas.examinations.show', $exam->id) }}" 
                                               class="btn btn-sm btn-outline-primary" 
                                               title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-5">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-calendar-day fa-2x text-muted"></i>
                        </div>
                        <h6 class="text-muted fw-semibold">Belum ada kunjungan hari ini</h6>
                        <p class="text-muted small mb-3">Data akan muncul otomatis ketika ada siswa yang diperiksa.</p>
                        <a href="{{ route('petugas.examinations.create') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-plus me-1"></i> Input Kunjungan Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection