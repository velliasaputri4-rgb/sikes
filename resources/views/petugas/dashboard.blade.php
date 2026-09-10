@extends('layouts.petugas')

@section('title', 'Dashboard Petugas')
@section('page-title', 'Dashboard Petugas UKS')

@section('content')
    {{-- ✅ DEFINISIKAN $todayExams DI AWAL AGAR BISA DIGUNAKAN DI SELURUH HALAMAN --}}
    @php
        $todayExams = \App\Models\Examination::with(['student.class'])
            ->whereDate('examination_date', \Carbon\Carbon::today())
            ->latest('examination_date')
            ->paginate(5);
    @endphp

    <!-- Statistik Cards -->
    <div class="row g-4 mb-4">
        <!-- Card 1: Kunjungan Hari Ini -->
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

        <!-- Card 2: Kunjungan Bulan Ini -->
        <div class="col-md-4">
            <div class="stat-card" style="border-left-color: #3b82f6;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p>Kunjungan Bulan Ini</p>
                        <h3 class="text-primary">{{ $exams_month ?? 0 }}</h3>
                        <small class="text-muted">Total kunjungan</small>
                    </div>
                    <div class="stat-icon" style="background: #dbeafe; color: #2563eb;">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: Total Siswa Aktif -->
        <div class="col-md-4">
            <div class="stat-card" style="border-left-color: #8b5cf6;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p>Total Siswa Aktif</p>
                        @php
                            $totalSiswa = \App\Models\Student::count();
                        @endphp
                        <h3 style="color: #8b5cf6 !important;">{{ $totalSiswa ?? 0 }}</h3>
                        <small class="text-muted">Terdata di sistem</small>
                    </div>
                    <div class="stat-icon" style="background: #ede9fe; color: #8b5cf6;">
                        <i class="fas fa-user-graduate"></i>
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
                <a href="{{ route('petugas.students.index') }}" class="text-decoration-none">
                    <div class="p-4 border rounded-3 text-center" style="transition: all 0.2s;">
                        <div class="bg-info bg-opacity-10 text-info rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-users fa-lg"></i>
                        </div>
                        <h6 class="fw-bold mb-1">Data Siswa</h6>
                        <small class="text-muted">Kelola data siswa</small>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Kunjungan Hari Ini (TABEL DENGAN PAGINATION) -->
    <div class="row">
        <div class="col-12">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <h6 class="fw-bold mb-0"><i class="fas fa-clock text-primary me-2"></i>Kunjungan Hari Ini</h6>
                    @if($todayExams->hasPages())
                        <span class="badge bg-light text-dark border">
                            Halaman {{ $todayExams->currentPage() }} dari {{ $todayExams->lastPage() }}
                        </span>
                    @endif
                </div>

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

                    <!-- ✅ PAGINATION CONTROLS -->
                    @if($todayExams->hasPages())
                        <div class="mt-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <small class="text-muted">
                                Menampilkan {{ $todayExams->firstItem() }} - {{ $todayExams->lastItem() }} dari {{ $todayExams->total() }} kunjungan
                            </small>
                            <nav>
                                <ul class="pagination pagination-sm mb-0">
                                    {{-- Previous Button --}}
                                    @if($todayExams->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="fas fa-chevron-left"></i> Sebelumnya</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $todayExams->previousPageUrl() }}">
                                                <i class="fas fa-chevron-left"></i> Sebelumnya
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Pagination Numbers --}}
                                    @foreach($todayExams->getUrlRange(1, $todayExams->lastPage()) as $page => $url)
                                        @if($page == $todayExams->currentPage())
                                            <li class="page-item active">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    {{-- Next Button --}}
                                    @if($todayExams->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $todayExams->nextPageUrl() }}">
                                                Selanjutnya <i class="fas fa-chevron-right"></i>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link">Selanjutnya <i class="fas fa-chevron-right"></i></span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    @endif
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