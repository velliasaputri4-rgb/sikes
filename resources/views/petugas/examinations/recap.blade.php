@extends('layouts.petugas')

@section('title', 'Rekapan Data Kunjungan')
@section('page-title', 'Rekapan & Statistik Kunjungan UKS')

@section('content')
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h5 class="fw-bold mb-0">
            <i class="fas fa-chart-bar me-2" style="color: #ef4444;"></i>
            Rekapan Data Kunjungan
        </h5>
    </div>

    {{-- Filter Tahun dan Bulan --}}
    <div class="card mb-4" style="border: 1px solid #fee2e2; box-shadow: 0 2px 8px rgba(239, 68, 68, 0.04); border-radius: 16px;">
        <div class="card-body">
            <form method="GET" action="{{ route('petugas.examinations.recap') }}" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Tahun <span style="color: #ef4444;">*</span></label>
                    <input type="number" name="year" class="form-control" value="{{ old('year', $year) }}" 
                           min="2020" max="{{ date('Y') + 1 }}" required style="border-color: #fecaca;"
                           placeholder="Contoh: 2024">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Bulan (Opsional)</label>
                    <select name="month" class="form-select" style="border-color: #fecaca;">
                        <option value="">Semua Bulan</option>
                        @for($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}" {{ (int)$month == (int)$m ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::createFromDate($year, $m, 1)->format('F') }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">&nbsp;</label>
                    <button type="submit" class="btn w-100" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; border: none; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);">
                        <i class="fas fa-filter me-1"></i> Tampilkan Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ✅ CEK APAKAH ADA DATA ATAU TIDAK --}}
    @if($totalVisits > 0)
        
        {{-- Kartu Statistik Utama --}}
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="stat-card" style="border-left-color: #ef4444;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p style="font-size: 12px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; color: #475569;">Total Kunjungan</p>
                            <h3 style="color: #ef4444 !important; font-family: 'Poppins', sans-serif;">{{ number_format($totalVisits) }}</h3>
                            <small class="text-muted">
                                <i class="fas fa-calendar-alt me-1"></i>
                                Periode: Tahun {{ $year }} {{ $month ? '- ' . \Carbon\Carbon::createFromDate($year, $month, 1)->format('F') : '(Semua Bulan)' }}
                            </small>
                        </div>
                        <div class="stat-icon" style="background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(220, 38, 38, 0.1)); color: #ef4444;">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="stat-card" style="border-left-color: #f43f5e;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p style="font-size: 12px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; color: #475569;">Jenis Penyakit</p>
                            <h3 style="color: #f43f5e !important; font-family: 'Poppins', sans-serif;">{{ $topDiagnoses->count() }}</h3>
                            <small class="text-muted">Diagnosa berbeda</small>
                        </div>
                        <div class="stat-icon" style="background: linear-gradient(135deg, rgba(244, 63, 94, 0.15), rgba(225, 29, 72, 0.1)); color: #f43f5e;">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card" style="border-left-color: #f59e0b;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p style="font-size: 12px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; color: #475569;">Jenis Obat</p>
                            <h3 style="color: #d97706 !important; font-family: 'Poppins', sans-serif;">{{ $topMedicines->count() }}</h3>
                            <small class="text-muted">Obat yang diberikan</small>
                        </div>
                        <div class="stat-icon" style="background: linear-gradient(135deg, rgba(245, 158, 11, 0.15), rgba(217, 119, 6, 0.1)); color: #d97706;">
                            <i class="fas fa-pills"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card" style="border-left-color: #0f172a;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p style="font-size: 12px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; color: #475569;">Siswa Berkunjung</p>
                            <h3 style="color: #0f172a !important; font-family: 'Poppins', sans-serif;">{{ $topSickStudents->count() }}</h3>
                            <small class="text-muted">Siswa unik</small>
                        </div>
                        <div class="stat-icon" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.1), rgba(30, 41, 59, 0.1)); color: #0f172a;">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Grafik Kunjungan per Bulan --}}
        <div class="card mb-4" style="border: 1px solid #fee2e2; border-radius: 16px;">
            <div class="card-header bg-white border-0 pt-3 pb-0">
                <h6 class="mb-0 fw-bold" style="color: #991b1b;">
                    <i class="fas fa-chart-line me-2"></i>
                    Grafik Kunjungan per Bulan (Tahun {{ $year }})
                </h6>
            </div>
            <div class="card-body">
                <canvas id="monthlyChart" height="80"></canvas>
            </div>
        </div>

        <div class="row g-4">
            {{-- Top 5 Diagnosa --}}
            <div class="col-lg-6">
                <div class="card h-100" style="border: 1px solid #fee2e2; border-radius: 16px;">
                    <div class="card-header bg-white border-0 pt-3 pb-0">
                        <h6 class="mb-0 fw-bold" style="color: #ef4444;">
                            <i class="fas fa-procedures me-2"></i>
                            5 Penyakit Paling Sering
                        </h6>
                    </div>
                    <div class="card-body">
                        @if($topDiagnoses->count() > 0)
                            <canvas id="diagnosisChart"></canvas>
                            <div class="mt-3">
                                @foreach($topDiagnoses as $index => $diag)
                                    <div class="d-flex justify-content-between align-items-center mb-2 p-2 rounded" style="background: #fef2f2;">
                                        <span class="fw-semibold" style="color: #0f172a;">
                                            <span class="badge me-2" style="background: #ef4444; color: white;">{{ $index + 1 }}</span>
                                            {{ Str::limit($diag->diagnosis, 40) }}
                                        </span>
                                        <span class="badge" style="background: #ef4444; color: white;">{{ $diag->count }} kali</span>
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
                <div class="card h-100" style="border: 1px solid #fee2e2; border-radius: 16px;">
                    <div class="card-header bg-white border-0 pt-3 pb-0">
                        <h6 class="mb-0 fw-bold" style="color: #f59e0b;">
                            <i class="fas fa-capsules me-2"></i>
                            5 Obat Paling Sering Diberikan
                        </h6>
                    </div>
                    <div class="card-body">
                        @if($topMedicines->count() > 0)
                            <canvas id="medicineChart"></canvas>
                            <div class="mt-3">
                                @foreach($topMedicines as $index => $med)
                                    <div class="d-flex justify-content-between align-items-center mb-2 p-2 rounded" style="background: #fffbeb;">
                                        <span class="fw-semibold" style="color: #0f172a;">
                                            <span class="badge me-2" style="background: #f59e0b; color: white;">{{ $index + 1 }}</span>
                                            {{ Str::limit($med->medicine, 40) }}
                                        </span>
                                        <span class="badge" style="background: #f59e0b; color: white;">{{ $med->count }} kali</span>
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
                <div class="card h-100" style="border: 1px solid #fee2e2; border-radius: 16px;">
                    <div class="card-header bg-white border-0 pt-3 pb-0">
                        <h6 class="mb-0 fw-bold" style="color: #f43f5e;">
                            <i class="fas fa-user-injured me-2"></i>
                            5 Siswa Paling Sering Berkunjung
                        </h6>
                    </div>
                    <div class="card-body">
                        @if($topSickStudents->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-sm align-middle">
                                    <thead style="background: #fef2f2;">
                                        <tr>
                                            <th style="color: #991b1b;">No</th>
                                            <th style="color: #991b1b;">Nama Siswa</th>
                                            <th style="color: #991b1b;">Kelas</th>
                                            <th class="text-center" style="color: #991b1b;">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($topSickStudents as $index => $studentStat)
                                            @php
                                                $student = $studentStat->student;
                                            @endphp
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td class="fw-semibold">{{ $student->full_name ?? 'N/A' }}</td>
                                                <td>{{ $student->class->name ?? '-' }}</td>
                                                <td class="text-center">
                                                    <span class="badge" style="background: #fff1f2; color: #be123c;">{{ $studentStat->count }}</span>
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
                <div class="card h-100" style="border: 1px solid #fee2e2; border-radius: 16px;">
                    <div class="card-header bg-white border-0 pt-3 pb-0">
                        <h6 class="mb-0 fw-bold" style="color: #0f172a;">
                            <i class="fas fa-door-open me-2"></i>
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
                                    <div class="d-flex justify-content-between align-items-center mb-2 p-2 rounded" style="background: #f8fafc;">
                                        <span class="fw-semibold" style="color: #0f172a;">{{ $statusLabels[$stat->status] ?? $stat->status }}</span>
                                        <span class="badge" style="background: #f1f5f9; color: #475569;">{{ $stat->count }} siswa</span>
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

    @else
        {{-- ✅ PESAN JIKA TIDAK ADA DATA UNTUK TAHUN TERSEBUT --}}
        <div class="text-center py-5">
            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 100px; height: 100px; background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);">
                <i class="fas fa-folder-open fa-3x" style="color: #ef4444;"></i>
            </div>
            <h5 class="fw-bold mb-2" style="color: #0f172a;">Tidak Ada Data Kunjungan</h5>
            <p class="text-muted mb-0" style="max-width: 500px; margin: 0 auto; line-height: 1.6;">
                Belum ada data kunjungan untuk tahun <strong>{{ $year }}</strong> {{ $month ? 'pada bulan <strong>' . \Carbon\Carbon::createFromDate($year, $month, 1)->format('F') . '</strong>' : '' }}.
                <br>Silakan ubah filter tahun atau bulan untuk melihat data lainnya.
            </p>
        </div>
    @endif
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ✅ WARNA TEMA MERAH PMR/UKS (TANPA BIRU)
    const colors = {
        primary: '#ef4444',   // Merah Utama
        rose: '#f43f5e',      // Rose
        amber: '#f59e0b',     // Amber
        slate: '#475569',     // Slate
        emerald: '#10b981',   // Emerald (untuk variasi sehat/sukses)
        dark: '#0f172a'       // Dark Slate
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
                backgroundColor: 'rgba(239, 68, 68, 0.1)',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: colors.primary,
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: colors.primary
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
                backgroundColor: [colors.primary, colors.rose, colors.amber, colors.slate, colors.emerald],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20 } }
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
                backgroundColor: colors.amber,
                borderRadius: 6
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
                backgroundColor: [colors.primary, colors.rose, colors.amber, colors.dark, colors.emerald, colors.slate],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20 } }
            }
        }
    });
    @endif
});
</script>
@endsection