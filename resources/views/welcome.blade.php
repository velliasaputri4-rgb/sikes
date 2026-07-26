<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIKES - Sistem Informasi UKS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
    :root {
        --primary: #2563EB;
        --secondary: #1e40af;
        --success: #10b981;
        --info: #3b82f6;
        --warning: #f59e0b;
    }
    body { 
        font-family: 'Segoe UI', 'Inter', system-ui, sans-serif;
        background: linear-gradient(135deg, #f0f7ff 0%, #e0f2fe 100%);
        color: #1e293b;
        line-height: 1.6;
    }
    
    /* Navbar */
    .navbar { 
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        background: white !important;
        padding: 15px 0;
    }
    .navbar-brand { 
        font-weight: 700; 
        color: var(--primary) !important;
        font-size: 1.5rem;
    }
    .nav-link {
        font-weight: 500;
        color: #475569 !important;
        padding: 8px 16px !important;
        transition: all 0.3s;
    }
    .nav-link:hover, .nav-link.active {
        color: var(--primary) !important;
        background: rgba(37, 99, 235, 0.1);
        border-radius: 8px;
    }
    
    /* Hero Section */
    .hero-section { 
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); 
        padding: 80px 0 60px;
        margin-bottom: 40px;
    }
    .hero-title { 
        font-size: 2.8rem; 
        font-weight: 800; 
        color: #0f172a;
        line-height: 1.2;
        margin-bottom: 1rem;
    }
    .hero-subtitle { 
        color: #64748b; 
        font-size: 1.15rem;
        margin-bottom: 2rem;
    }
    
    /* Menu Cards */
    .menu-card { 
        background: white; 
        border-radius: 16px; 
        padding: 35px 25px; 
        text-align: center; 
        box-shadow: 0 4px 15px rgba(0,0,0,0.06);
        transition: all 0.3s ease;
        border: none;
        height: 100%;
        position: relative;
        overflow: hidden;
    }
    .menu-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary), var(--info));
        transform: scaleX(0);
        transition: transform 0.3s;
    }
    .menu-card:hover { 
        transform: translateY(-8px); 
        box-shadow: 0 12px 35px rgba(37, 99, 235, 0.15);
    }
    .menu-card:hover::before {
        transform: scaleX(1);
    }
    .menu-icon { 
        width: 75px; 
        height: 75px; 
        border-radius: 50%; 
        margin: 0 auto 20px; 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        font-size: 28px;
        transition: transform 0.3s;
    }
    .menu-card:hover .menu-icon {
        transform: scale(1.1);
    }
    .bg-icon-1 { background: linear-gradient(135deg, #dcfce7, #86efac); color: #16a34a; }
    .bg-icon-2 { background: linear-gradient(135deg, #dbeafe, #93c5fd); color: #2563EB; }
    .bg-icon-3 { background: linear-gradient(135deg, #ffedd5, #fdba74); color: #ea580c; }
    .bg-icon-4 { background: linear-gradient(135deg, #fee2e2, #fca5a5); color: #dc2626; }
    
    /* Section Styling */
    .section { 
        padding: 60px 0;
    }
    .section-title { 
        font-size: 2.2rem; 
        font-weight: 700; 
        color: #0f172a;
        margin-bottom: 1rem;
        position: relative;
        display: inline-block;
    }
    .section-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 60px;
        height: 4px;
        background: var(--primary);
        border-radius: 2px;
    }
    .section-subtitle { 
        color: #64748b;
        font-size: 1.05rem;
        margin-bottom: 3rem;
    }
    
    /* About Section */
    .about-section { 
        background: white;
        padding: 80px 0;
    }
    .about-img {
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    .feature-box {
        padding: 30px;
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        border-radius: 16px;
        margin-bottom: 25px;
        border-left: 4px solid var(--primary);
        transition: transform 0.3s;
    }
    .feature-box:hover {
        transform: translateX(5px);
    }
    .feature-icon {
        width: 55px;
        height: 55px;
        background: linear-gradient(135deg, var(--primary), var(--info));
        color: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        margin-bottom: 15px;
    }
    
    /* Services */
    .service-card {
        background: white;
        padding: 35px 25px;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.06);
        margin-bottom: 25px;
        transition: all 0.3s;
        text-align: center;
        height: 100%;
    }
    .service-card:hover { 
        box-shadow: 0 12px 35px rgba(0,0,0,0.1);
        transform: translateY(-5px);
    }
    .service-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, var(--primary), var(--info));
        color: white;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin: 0 auto 20px;
    }
    
    /* Buttons */
    .btn-primary-custom {
        background: linear-gradient(135deg, var(--primary), var(--info));
        color: white;
        padding: 12px 32px;
        border-radius: 10px;
        border: none;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
    }
    .btn-primary-custom:hover {
        background: linear-gradient(135deg, var(--secondary), var(--primary));
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
    }
    
    /* Footer */
    footer { 
        background: linear-gradient(135deg, #0f172a, #1e293b); 
        color: white; 
        padding: 60px 0 30px;
        margin-top: 80px;
    }
    footer a { color: #cbd5e1; text-decoration: none; transition: color 0.3s; }
    footer a:hover { color: white; }
    .footer-bottom { 
        border-top: 1px solid #334155; 
        margin-top: 40px; 
        padding-top: 25px;
        text-align: center;
        color: #94a3b8;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .hero-title { font-size: 2rem; }
        .section-title { font-size: 1.75rem; }
        .menu-card { padding: 25px 20px; }
    }
</style>
</head>
<body>

       <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('landing') }}">
                <i class="fas fa-heartbeat me-2"></i> SIKES
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('landing') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing.about') }}">Tentang UKS</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing.medicines') }}">Informasi Obat</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing.schedule') }}">Jadwal Petugas</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing.contact') }}">Kontak</a></li>
                    
                                       <!-- Icon Login dengan Dropdown -->
                    <li class="nav-item ms-3">
                        <div class="dropdown">
                            <button class="btn btn-primary rounded-circle" type="button" data-bs-toggle="dropdown" style="width: 40px; height: 40px; padding: 0;">
                                <i class="fas fa-user"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                <li class="dropdown-header text-center">
                                    <small class="text-muted">Pilih Login</small>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('login.admin') }}">
                                        <i class="fas fa-user-shield me-2 text-primary"></i> Login Admin
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('login.petugas') }}">
                                        <i class="fas fa-user-nurse me-2 text-success"></i> Login Petugas
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-center small" href="{{ route('login.siswa') }}">
                                        <i class="fas fa-user-graduate me-1 text-info"></i> Login Siswa
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                            </ul>
                        </div>
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
                <h1 class="hero-title">Selamat Datang di<br><span class="text-primary">Sistem Informasi UKS</span></h1>
                <p class="hero-subtitle">Layanan kesehatan sekolah yang modern, cepat, dan terpercaya. Kami siap melayani kebutuhan kesehatan siswa dengan profesional.</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="#layanan" class="btn btn-primary-custom btn-lg">
                        <i class="fas fa-clipboard-list me-2"></i> Form Kunjungan
                    </a>
                    <a href="{{ route('landing.about') }}" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-info-circle me-2"></i> Pelajari Lebih
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center mt-4 mt-lg-0">
                <img src="https://img.freepik.com/free-vector/doctor-character-background_1270-84.jpg" alt="Ilustrasi UKS" class="img-fluid" style="max-height: 400px;">
            </div>
        </div>

        <!-- 4 Menu Cards -->
        <div class="row g-4 mt-2">
            <div class="col-md-6 col-lg-3">
                <a href="{{ auth()->check() && auth()->user()->hasRole(['super-admin', 'admin', 'petugas']) ? route('petugas.examinations.create') : route('login.petugas') }}" class="text-decoration-none">
                    <div class="menu-card">
                        <div class="menu-icon bg-icon-1"><i class="fas fa-clipboard-list"></i></div>
                        <h5 class="fw-bold mb-2">Form Kunjungan</h5>
                        <p class="text-muted small mb-0">Isi form kunjungan ke UKS dengan mudah dan cepat</p>
                        @if(!auth()->check())
                            <small class="text-primary mt-2 d-block"><i class="fas fa-lock me-1"></i>Login diperlukan</small>
                        @endif
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="{{ auth()->check() && auth()->user()->hasRole('siswa') ? route('student.history') : route('login.siswa') }}" class="text-decoration-none">
                    <div class="menu-card">
                        <div class="menu-icon bg-icon-2"><i class="fas fa-history"></i></div>
                        <h5 class="fw-bold mb-2">Riwayat Kunjungan</h5>
                        <p class="text-muted small mb-0">Lihat riwayat kunjungan dan rekam medis Anda</p>
                        @if(!auth()->check())
                            <small class="text-primary mt-2 d-block"><i class="fas fa-user me-1"></i>Login siswa diperlukan</small>
                        @endif
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('landing.medicines') }}" class="text-decoration-none">
                    <div class="menu-card">
                        <div class="menu-icon bg-icon-3"><i class="fas fa-pills"></i></div>
                        <h5 class="fw-bold mb-2">Informasi Obat</h5>
                        <p class="text-muted small mb-0">Informasi lengkap obat yang tersedia di UKS</p>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="{{ route('landing.schedule') }}" class="text-decoration-none">
                    <div class="menu-card">
                        <div class="menu-icon bg-icon-4"><i class="fas fa-user-nurse"></i></div>
                        <h5 class="fw-bold mb-2">Jadwal Petugas</h5>
                        <p class="text-muted small mb-0">Lihat jadwal petugas UKS yang bertugas</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
    <!-- About Section -->
<section class="section about-section" id="tentang">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <img src="https://img.freepik.com/free-vector/healthcare-concept-illustration_23-2148939760.jpg" alt="Tentang UKS" class="img-fluid about-img">
            </div>
            <div class="col-lg-6">
                <h2 class="section-title">Tentang UKS</h2>
                <p class="text-muted mb-4">Unit Kesehatan Sekolah (UKS) adalah wadah untuk meningkatkan kesehatan peserta didik di sekolah. Kami menyediakan layanan kesehatan yang komprehensif untuk mendukung proses belajar mengajar.</p>
                
                <div class="feature-box">
                    <div class="feature-icon"><i class="fas fa-bullseye"></i></div>
                    <h5 class="fw-bold mb-2">Visi</h5>
                    <p class="mb-0 text-muted">Menjadikan UKS sebagai pusat layanan kesehatan sekolah yang unggul, profesional, dan berorientasi pada kepuasan siswa.</p>
                </div>

                <div class="feature-box">
                    <div class="feature-icon"><i class="fas fa-tasks"></i></div>
                    <h5 class="fw-bold mb-2">Misi</h5>
                    <ul class="mb-0 ps-3 text-muted">
                        <li>Memberikan pelayanan kesehatan yang prima</li>
                        <li>Meningkatkan kesadaran kesehatan siswa</li>
                        <li>Menjaga ketersediaan obat dan alat kesehatan</li>
                        <li>Melakukan pencegahan dan penanganan dini</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Services Section -->
<section class="section bg-light" id="layanan">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title mx-auto">Layanan UKS</h2>
            <p class="section-subtitle">Berbagai layanan kesehatan yang kami sediakan untuk siswa</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-stethoscope"></i></div>
                    <h5 class="fw-bold mb-2">Pemeriksaan Kesehatan</h5>
                    <p class="text-muted mb-0">Pemeriksaan kesehatan rutin dan pemeriksaan saat sakit dengan tenaga profesional.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-pills"></i></div>
                    <h5 class="fw-bold mb-2">Pelayanan Obat</h5>
                    <p class="text-muted mb-0">Penyediaan obat-obatan yang lengkap dan terjamin kualitasnya.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-heartbeat"></i></div>
                    <h5 class="fw-bold mb-2">Pertolongan Pertama</h5>
                    <p class="text-muted mb-0">Pertolongan pertama pada kecelakaan dan keadaan darurat.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-user-md"></i></div>
                    <h5 class="fw-bold mb-2">Konsultasi Kesehatan</h5>
                    <p class="text-muted mb-0">Konsultasi kesehatan fisik dan mental dengan petugas terlatih.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-clipboard-check"></i></div>
                    <h5 class="fw-bold mb-2">Pemeriksaan Berkala</h5>
                    <p class="text-muted mb-0">Pemeriksaan kesehatan berkala untuk memantau kondisi siswa.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-graduation-cap"></i></div>
                    <h5 class="fw-bold mb-2">Edukasi Kesehatan</h5>
                    <p class="text-muted mb-0">Penyuluhan dan edukasi tentang pola hidup sehat.</p>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- Medicines Preview -->
    <section class="section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Informasi Obat</h2>
                <p class="section-subtitle">Obat-obatan yang tersedia di UKS</p>
            </div>
            <div class="row g-4">
                @forelse($medicines ?? [] as $med)
                    <div class="col-md-4 col-lg-3">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <h6 class="fw-bold">{{ $med->name }}</h6>
                                <p class="text-muted small mb-2">{{ $med->category->name ?? 'Umum' }}</p>
                                <span class="badge bg-success">Tersedia</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">
                        <p>Belum ada data obat</p>
                    </div>
                @endforelse
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('landing.medicines') }}" class="btn btn-outline-primary rounded-pill">Lihat Semua Obat</a>
            </div>
        </div>
    </section>

        <!-- Schedule Preview -->
    <section class="section bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Jadwal Petugas</h2>
                <p class="section-subtitle">Jadwal petugas UKS yang bertugas</p>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered bg-white shadow-sm">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Hari</th>
                            <th>Petugas</th>
                            <th>Jam Tugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($schedules as $schedule)
                            <tr>
                                <td>{{ $schedule->day }}</td>
                                <td>{{ $schedule->officer_name }}</td>
                                <td>{{ $schedule->time }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">Belum ada jadwal</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('landing.schedule') }}" class="btn btn-outline-primary rounded-pill">Lihat Jadwal Lengkap</a>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3"><i class="fas fa-heartbeat me-2"></i> SIKES</h5>
                    <p class="text-muted">Sistem Informasi Unit Kesehatan Sekolah yang modern dan terpercaya untuk meningkatkan kesehatan siswa.</p>
                </div>
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3">Menu Cepat</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('landing') }}">Beranda</a></li>
                        <li class="mb-2"><a href="{{ route('landing.about') }}">Tentang UKS</a></li>
                        <li class="mb-2"><a href="{{ route('landing.medicines') }}">Informasi Obat</a></li>
                        <li class="mb-2"><a href="{{ route('landing.schedule') }}">Jadwal Petugas</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3">Kontak</h5>
                    <ul class="list-unstyled text-muted">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> Jl. Pendidikan No. 123</li>
                        <li class="mb-2"><i class="fas fa-phone me-2"></i> (021) 1234567</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i> uks@sekolah.sch.id</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom text-center">
                <p class="mb-0">&copy; {{ date('Y') }} SIKES - Sistem Informasi UKS. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>