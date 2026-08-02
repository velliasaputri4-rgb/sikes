@extends('layouts.petugas')

@section('title', 'Dashboard Petugas')
@section('page-title', 'Dashboard Petugas UKS')

@section('content')
    <!-- 🔥 PERUBAHAN: TOMBOL KEMBALI KE BERANDA 🔥 -->
    <div class="mb-4">
        <a href="{{ route('landing') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-home me-1"></i> Kembali ke Beranda
        </a>
    </div>
    <!-- 🔥 AKHIR PERUBAHAN 🔥 -->

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
    <div class="content-card">
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

    <!-- Kunjungan Terbaru & Obat Menipis -->
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0"><i class="fas fa-clock text-primary me-2"></i>Kunjungan Terbaru</h6>
                    <a href="{{ route('petugas.examinations.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>Siswa</th>
                                <th>Kelas</th>
                                <th>Keluhan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $recentExams = \App\Models\Examination::with(['student.class'])
                                    ->latest('examination_date')
                                    ->limit(5)
                                    ->get();
                            @endphp
                            @forelse($recentExams as $exam)
                                <tr>
                                    <td>
                                        <div class="fw-semibold">{{ $exam->student->full_name ?? '-' }}</div>
                                        <small class="text-muted">{{ $exam->student->nis ?? '-' }}</small>
                                    </td>
                                    <td><span class="badge bg-light text-dark">{{ $exam->student->class->name ?? '-' }}</span></td>
                                    <td>{{ Str::limit($exam->complaint, 30) }}</td>
                                    <td>
                                        @php
                                            $isSakit = in_array($exam->status, ['pulang', 'rawat_jalan', 'rujuk_puskesmas', 'rujuk_rs']);
                                        @endphp
                                        <span class="badge {{ $isSakit ? 'bg-danger' : 'bg-success' }}">
                                            {{ $isSakit ? 'Sakit' : 'Sehat' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">Belum ada kunjungan hari ini</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card">
                <h6 class="fw-bold mb-3"><i class="fas fa-exclamation-triangle text-danger me-2"></i>Obat Menipis</h6>
                @php
                    $lowStockMeds = \App\Models\Medicine::whereColumn('stock', '<=', 'minimum_stock')
                        ->limit(5)
                        ->get();
                @endphp
                @forelse($lowStockMeds as $med)
                    <div class="d-flex justify-content-between align-items-center p-2 border-bottom">
                        <div>
                            <div class="fw-semibold small">{{ $med->name }}</div>
                            <small class="text-muted">{{ $med->category->name ?? '-' }}</small>
                        </div>
                        <span class="badge bg-danger rounded-pill">{{ $med->stock }} {{ $med->unit }}</span>
                    </div>
                @empty
                    <div class="text-center py-4 text-muted">
                        <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                        <p class="small mb-0">Semua stok aman</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection