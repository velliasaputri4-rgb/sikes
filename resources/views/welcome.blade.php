<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi UKS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f8f9fa; }
        .navbar-brand { font-weight: bold; color: #2563EB !important; }
        .hero-section { padding: 60px 0; background: white; }
        .menu-card { 
            background: white; border: 1px solid #e5e7eb; border-radius: 12px; 
            padding: 30px 20px; text-align: center; transition: 0.3s; cursor: pointer;
        }
        .menu-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); border-color: #2563EB; }
        .menu-icon { 
            width: 70px; height: 70px; border-radius: 50%; margin: 0 auto 15px; 
            display: flex; align-items: center; justify-content: center; font-size: 28px;
        }
        .bg-icon-1 { background: #dcfce7; color: #16a34a; }
        .bg-icon-2 { background: #dbeafe; color: #2563EB; }
        .bg-icon-3 { background: #ffedd5; color: #ea580c; }
        .bg-icon-4 { background: #fee2e2; color: #dc2626; }
        .illustration { max-height: 350px; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-heartbeat me-2"></i> UKS <span class="text-dark fs-6">Sistem Informasi UKS</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Form Kunjungan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Riwayat Kunjungan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Informasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Kontak</a></li>
                    <li class="nav-item ms-2">
                        <a href="{{ route('login') }}" class="btn btn-primary px-4 rounded-pill">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold text-dark mb-3">Selamat Datang di<br><span class="text-primary">Sistem Informasi UKS</span></h1>
                    <p class="lead text-muted mb-4">Silakan gunakan menu di bawah untuk mengisi form kunjungan atau melihat riwayat kunjungan Anda.</p>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="https://img.freepik.com/free-vector/doctor-character-background_1270-84.jpg" alt="Ilustrasi UKS" class="illustration img-fluid">
                </div>
            </div>

            <!-- 4 Menu Cards -->
            <div class="row g-4 mt-4">
                <div class="col-md-6 col-lg-3">
                    <div class="menu-card">
                        <div class="menu-icon bg-icon-1"><i class="fas fa-clipboard-list"></i></div>
                        <h5 class="fw-bold">Form Kunjungan</h5>
                        <p class="text-muted small mb-0">Isi form kunjungan ke UKS</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="menu-card">
                        <div class="menu-icon bg-icon-2"><i class="fas fa-history"></i></div>
                        <h5 class="fw-bold">Riwayat Kunjungan</h5>
                        <p class="text-muted small mb-0">Lihat riwayat kunjungan Anda</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="menu-card">
                        <div class="menu-icon bg-icon-3"><i class="fas fa-pills"></i></div>
                        <h5 class="fw-bold">Informasi Obat</h5>
                        <p class="text-muted small mb-0">Lihat informasi obat yang tersedia</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="menu-card">
                        <div class="menu-icon bg-icon-4"><i class="fas fa-user-nurse"></i></div>
                        <h5 class="fw-bold">Jadwal Petugas</h5>
                        <p class="text-muted small mb-0">Lihat jadwal petugas UKS</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>