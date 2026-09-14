@extends('layouts.petugas')

@section('title', 'Rekapan Data Kunjungan')
@section('page-title', 'Rekapan & Statistik Kunjungan UKS')

@section('content')
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">
            <i class="fas fa-chart-bar text-primary me-2"></i>
            Rekapan Data Kunjungan
        </h5>
    </div>

    {{-- Filter Tahun dan Bulan --}}
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('petugas.examinations.recap') }}" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Tahun</label>
                    <select name="year" class="form-select" required>
                        @foreach($years as $y)
                            <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Bulan (Opsional)</label>
                    <select name="month" class="form-select">
                        <option value="">Semua Bulan</option>
                        @for($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::createFromDate($year, $m, 1)->format('F') }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">&nbsp;</label>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-filter me-1"></i> Tampilkan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Kartu Statistik Utama --}}
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Total Kunjungan</h6>
                            <h2 class="mb-0">{{ $totalVisits }}</h2>
                            <small>
                                Kunjungan di {{ $year }}
                                {{ $month ? ' - ' . \Carbon\Carbon::createFromDate($year, $month, 1)->format('F') : '' }}
                            </small>
                        </div>
                        <i class="fas fa-clipboard-list fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Jenis Penyakit</h6>
                            <h2 class="mb-0">{{ $topDiagnoses->count() }}</h2>
                            <small>Diagnosa berbeda</small>
                        </div>
                        <i class="fas fa-stethoscope fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Jenis Obat</h6>
                            <h2 class="mb-0">{{ $topMedicines->count() }}</h2>
                            <small>Obat yang diberikan</small>
                        </div>
                        <i class="fas fa-pills fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-warning text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Siswa Terdaftar</h6>
                            <h2 class="mb-0">{{ $topSickStudents->count() }}</h2>
                            <small>Siswa yang berkunjung</small>
                        </div>
                        <i class="fas fa-users fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Grafik Kunjungan per Bulan --}}
    <div class="card mb-4">
        <div class="card-header bg-white">
            <h6 class="mb-0 fw-bold">
                <i class="fas fa-chart-line me-2 text-primary"></i>
                Grafik Kunjungan per Bulan ({{ $year }})
            </h6>
        </div>
        <div class="card-body">
            <canvas id="monthlyChart" height="80"></canvas>
        </div>
    </div>

    <div class="row g-4">
        {{-- Top 5 Diagnosa --}}
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold">
                        <i class="fas fa-procedures me-2 text-danger"></i>
                        5 Penyakit Paling Sering
                    </h6>
                </div>
                <div class="card-body">
                    @if($topDiagnoses->count() > 0)
                        <canvas id="diagnosisChart"></canvas>
                        <div class="mt-3">
                            @foreach($topDiagnoses as $index => $diag)
                                <div class="d-flex justify-content-between align-items-center mb-2 p-2 bg-light rounded">
                                    <span class="fw-semibold">
                                        <span class="badge bg-danger me-2">{{ $index + 1 }}</span>
                                        {{ Str::limit($diag->diagnosis, 40) }}
                                    </span>
                                    <span class="badge bg-primary">{{ $diag->count }} kali</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center py-4">Belum ada data diagnosa</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Top 5 Obat --}}
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold">
                        <i class="fas fa-capsules me-2 text-success"></i>
                        5 Obat Paling Sering Diberikan
                    </h6>
                </div>
                <div class="card-body">
                    @if($topMedicines->count() > 0)
                        <canvas id="medicineChart"></canvas>
                        <div class="mt-3">
                            @foreach($topMedicines as $index => $med)
                                <div class="d-flex justify-content-between align-items-center mb-2 p-2 bg-light rounded">
                                    <span class="fw-semibold">
                                        <span class="badge bg-success me-2">{{ $index + 1 }}</span>
                                        {{ Str::limit($med->medicine, 40) }}
                                    </span>
                                    <span class="badge bg-primary">{{ $med->count }} kali</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center py-4">Belum ada data obat</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Siswa Paling Sering Sakit --}}
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold">
                        <i class="fas fa-user-injured me-2 text-warning"></i>
                        5 Siswa Paling Sering Berkunjung
                    </h6>
                </div>
                <div class="card-body">
                    @if($topSickStudents->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Kelas</th>
                                        <th class="text-center">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($topSickStudents as $index => $studentStat)
                                        @php
                                            $student = $studentStat->student;
                                        @endphp
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $student->full_name ?? 'N/A' }}</td>
                                            <td>{{ $student->class->name ?? '-' }}</td>
                                            <td class="text-center">
                                                <span class="badge bg-warning text-dark">{{ $studentStat->count }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted text-center py-4">Belum ada data siswa</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Status Kepulangan --}}
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold">
                        <i class="fas fa-door-open me-2 text-info"></i>
                        Status Kepulangan Siswa
                    </h6>
                </div>
                <div class="card-body">
                    @if($statusStats->count() > 0)
                        <canvas id="statusChart"></canvas>
                        <div class="mt-3">
                            @php
                                $statusLabels = [
                                    'pulang' => 'Pulang',
                                    'istirahat_uks' => 'Istirahat di UKS',
                                    'rawat_jalan' => 'Rawat Jalan',
                                    'rujuk_puskesmas' => 'Rujuk Puskesmas',
                                    'rujuk_rs' => 'Rujuk RS',
                                    'hubungi_ortu' => 'Hubungi Orang Tua'
                                ];
                            @endphp
                            @foreach($statusStats as $stat)
                                <div class="d-flex justify-content-between align-items-center mb-2 p-2 bg-light rounded">
                                    <span class="fw-semibold">{{ $statusLabels[$stat->status] ?? $stat->status }}</span>
                                    <span class="badge bg-info">{{ $stat->count }} siswa</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center py-4">Belum ada data status</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Warna untuk chart
    const colors = {
        primary: '#3b82f6',
        success: '#10b981',
        danger: '#ef4444',
        warning: '#f59e0b',
        info: '#06b6d4',
        purple: '#8b5cf6'
    };

    // 1. Grafik Kunjungan per Bulan
    @if(count($monthlyStats) > 0)
    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_column($monthlyStats, 'month')) !!},
            datasets: [{
                label: 'Jumlah Kunjungan',
                data: {!! json_encode(array_column($monthlyStats, 'count')) !!},
                borderColor: colors.primary,
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });
    @endif

    // 2. Grafik Top Diagnosa (Doughnut)
    @if($topDiagnoses->count() > 0)
    const diagnosisCtx = document.getElementById('diagnosisChart').getContext('2d');
    new Chart(diagnosisCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($topDiagnoses->pluck('diagnosis')->map(fn($d) => Str::limit($d, 20))) !!},
            datasets: [{
                data: {!! json_encode($topDiagnoses->pluck('count')) !!},
                backgroundColor: [colors.danger, colors.primary, colors.warning, colors.success, colors.info]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
    @endif

    // 3. Grafik Top Obat (Bar)
    @if($topMedicines->count() > 0)
    const medicineCtx = document.getElementById('medicineChart').getContext('2d');
    new Chart(medicineCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($topMedicines->pluck('medicine')->map(fn($m) => Str::limit($m, 20))) !!},
            datasets: [{
                label: 'Jumlah Pemberian',
                data: {!! json_encode($topMedicines->pluck('count')) !!},
                backgroundColor: colors.success
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });
    @endif

    // 4. Grafik Status Kepulangan (Pie)
    @if($statusStats->count() > 0)
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($statusStats->pluck('status')->map(fn($s) => [
                'pulang' => 'Pulang',
                'istirahat_uks' => 'Istirahat UKS',
                'rawat_jalan' => 'Rawat Jalan',
                'rujuk_puskesmas' => 'Rujuk Puskesmas',
                'rujuk_rs' => 'Rujuk RS',
                'hubungi_ortu' => 'Hubungi Ortu'
            ][$s] ?? $s)) !!},
            datasets: [{
                data: {!! json_encode($statusStats->pluck('count')) !!},
                backgroundColor: [colors.primary, colors.warning, colors.success, colors.danger, colors.info, colors.purple]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
    @endif
});
</script>
@endsection