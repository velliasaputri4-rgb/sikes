<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Obat - SIKES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f8fafc; }
        .navbar { box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .navbar-brand { font-weight: bold; color: #2563EB !important; }
        .page-header { background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); padding: 60px 0; }
        .section { padding: 60px 0; }
        .medicine-card { background: white; border-radius: 12px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); transition: 0.3s; height: 100%; }
        .medicine-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        footer { background: #0f172a; color: white; padding: 40px 0 20px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('landing') }}"><i class="fas fa-heartbeat me-2"></i> SIKES</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing.about') }}">Tentang UKS</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('landing.medicines') }}">Informasi Obat</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing.schedule') }}">Jadwal Petugas</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing.contact') }}">Kontak</a></li>
                    <li class="nav-item ms-2"><a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-4">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="page-header text-center">
        <div class="container">
            <h1 class="fw-bold">Informasi Obat</h1>
            <p class="text-muted mb-0">Daftar obat-obatan yang tersedia di UKS</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row g-4">
                @forelse($medicines as $med)
                    <div class="col-md-6 col-lg-4">
                        <div class="medicine-card">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="fw-bold mb-0">{{ $med->name }}</h5>
                                <span class="badge bg-success">Tersedia</span>
                            </div>
                            <p class="text-muted small mb-1"><i class="fas fa-tag me-1"></i> {{ $med->category->name ?? 'Umum' }}</p>
                            <p class="text-muted small mb-1"><i class="fas fa-cube me-1"></i> Satuan: {{ $med->unit }}</p>
                            <p class="text-muted small mb-1"><i class="fas fa-boxes me-1"></i> Stok: {{ $med->stock }} {{ $med->unit }}</p>
                            @if($med->expired_date)
                                <p class="text-muted small mb-0"><i class="fas fa-calendar me-1"></i> Exp: {{ \Carbon\Carbon::parse($med->expired_date)->format('d M Y') }}</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-box-open fa-3x text-muted mb-3 opacity-25"></i>
                        <h5 class="text-muted">Belum ada data obat</h5>
                    </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $medicines->links() }}
            </div>
        </div>
    </section>

    <footer>
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} SIKES - Sistem Informasi UKS. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>