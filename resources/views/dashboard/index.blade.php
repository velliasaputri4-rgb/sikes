@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('content')
    <!-- Statistik Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stat-card" style="border-left-color: #2563EB;">
                <p>Total Kunjungan Hari Ini</p>
                <h3 class="text-primary">{{ $exams_today ?? 23 }}</h3>
                <small class="text-muted">Siswa</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="border-left-color: #10b981;">
                <p>Total Kunjungan Bulan Ini</p>
                <h3 class="text-success">{{ $exams_month ?? 145 }}</h3>
                <small class="text-muted">Kunjungan</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="border-left-color: #f59e0b;">
                <p>Total Siswa</p>
                <h3 class="text-warning">{{ $total_siswa ?? 350 }}</h3>
                <small class="text-muted">Siswa</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="border-left-color: #ef4444;">
                <p>Stok Obat Menipis</p>
                <h3 class="text-danger">{{ $low_stock ?? 7 }}</h3>
                <small class="text-muted">Obat</small>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Grafik -->
        <div class="col-lg-8">
            <div class="content-card">
                <h6 class="fw-bold mb-3">Grafik Kunjungan 6 Bulan Terakhir</h6>
                <canvas id="visitsChart" height="100"></canvas>
            </div>
        </div>

        <!-- Kunjungan Terbaru -->
        <div class="col-lg-4">
            <div class="content-card">
                <h6 class="fw-bold mb-3">Kunjungan Terbaru</h6>
                <div class="table-responsive">
                    <table class="table table-sm align-middle mb-0">
                        <tbody>
                            <tr>
                                <td>Natasya Meylani</td>
                                <td>Pusing</td>
                                <td>09:35</td>
                                <td><span class="badge bg-danger">Sakit</span></td>
                            </tr>
                            <tr>
                                <td>Dinda Putri</td>
                                <td>Demam</td>
                                <td>09:20</td>
                                <td><span class="badge bg-danger">Sakit</span></td>
                            </tr>
                            <tr>
                                <td>Raka Aditya</td>
                                <td>Sakit Perut</td>
                                <td>10:05</td>
                                <td><span class="badge bg-danger">Sakit</span></td>
                            </tr>
                            <tr>
                                <td>Andi Saputra</td>
                                <td>Batuk & Pilek</td>
                                <td>10:30</td>
                                <td><span class="badge bg-success">Tidak Sakit</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const ctx = document.getElementById('visitsChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [{
                label: 'Kunjungan',
                data: [20, 45, 30, 60, 50, 80],
                borderColor: '#2563EB',
                backgroundColor: 'rgba(37, 99, 235, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } } }
    });
</script>
@endpush