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

    /* ✅ SMOOTH SCROLL & OFFSET UNTUK NAVBAR STICKY */
    html {
        scroll-behavior: smooth;
        scroll-padding-top: 80px;
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
        position: relative;
    }
    .nav-link:hover, .nav-link.active {
        color: var(--primary) !important;
        background: rgba(37, 99, 235, 0.1);
        border-radius: 8px;
    }
    .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: 2px;
        left: 50%;
        transform: translateX(-50%);
        width: 60%;
        height: 3px;
        background-color: var(--primary);
        border-radius: 2px;
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
        text-decoration: none;
        display: block;
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
        color: inherit;
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
    
    /* Services & Contact Cards */
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
    .footer-bottom { 
        border-top: 1px solid #334155; 
        margin-top: 40px; 
        padding-top: 25px;
        text-align: center;
        color: #94a3b8;
    }

    /* ✅ EFEK HOVER UNTUK MENU CEPAT DI FOOTER */
    .footer-menu a {
        transition: all 0.3s ease;
        display: inline-block;
        text-decoration: none;
    }
    .footer-menu a:hover {
        color: var(--info) !important;
        opacity: 1 !important;
        transform: translateX(8px);
    }
    
    /* ✅ PERBAIKAN SIMETRI & WARNA ICON SERAGAM */
    .footer-contact-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .footer-contact-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 20px;
        gap: 15px;
    }
    .footer-contact-item i {
        font-size: 1.25rem;
        width: 24px;
        text-align: center;
        flex-shrink: 0;
        margin-top: 3px;
        color: #60a5fa !important; /* WARNA BIRU SOFT SERAGAM */
    }
    .footer-contact-item span, 
    .footer-contact-item a {
        color: #cbd5e1;
        opacity: 0.75;
        text-decoration: none;
        transition: all 0.3s ease;
        line-height: 1.6;
    }
    .footer-contact-item a:hover {
        opacity: 1;
        color: var(--info) !important;
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
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#layanan">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing.medicines') }}">Informasi Obat</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing.schedule') }}">Jadwal Petugas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                    
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
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" id="beranda">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-title">Selamat Datang di<br><span class="text-primary">Sistem Informasi UKS <br> SMK Negeri 1 Bangsri</span></h1>
                    <p class="hero-subtitle">Layanan kesehatan sekolah yang modern, cepat, dan terpercaya. Kami siap melayani kebutuhan kesehatan siswa dengan profesional.</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <!-- ✅ DIUBAH: Tombol CTA utama sekarang mengarah ke Riwayat Kunjungan -->
                        <a href="{{ auth()->check() && auth()->user()->hasRole('siswa') ? route('student.history') : route('login.siswa') }}" class="btn btn-primary-custom btn-lg">
                            <i class="fas fa-history me-2"></i> Riwayat Kunjungan
                        </a>
                        <a href="#tentang" class="btn btn-outline-primary btn-lg">
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
                    <a href="{{ auth()->check() && auth()->user()->hasRole(['super-admin', 'admin', 'petugas']) ? route('petugas.examinations.create') : route('login.petugas') }}" class="menu-card">
                        <div class="menu-icon bg-icon-1"><i class="fas fa-clipboard-list"></i></div>
                        <h5 class="fw-bold mb-2">Form Kunjungan</h5>
                        <p class="text-muted small mb-0">Isi form kunjungan ke UKS dengan mudah dan cepat</p>
                        @if(!auth()->check())
                            <small class="text-primary mt-2 d-block"><i class="fas fa-lock me-1"></i>Login diperlukan</small>
                        @endif
                    </a>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <a href="{{ auth()->check() && auth()->user()->hasRole('siswa') ? route('student.history') : route('login.siswa') }}" class="menu-card">
                        <div class="menu-icon bg-icon-2"><i class="fas fa-history"></i></div>
                        <h5 class="fw-bold mb-2">Riwayat Kunjungan</h5>
                        <p class="text-muted small mb-0">Lihat riwayat kunjungan dan rekam medis Anda</p>
                        @if(!auth()->check())
                            <small class="text-primary mt-2 d-block"><i class="fas fa-user me-1"></i>Login siswa diperlukan</small>
                        @endif
                    </a>
                </div>

                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('landing.medicines') }}" class="menu-card">
                        <div class="menu-icon bg-icon-3"><i class="fas fa-pills"></i></div>
                        <h5 class="fw-bold mb-2">Informasi Obat</h5>
                        <p class="text-muted small mb-0">Informasi lengkap obat yang tersedia di UKS</p>
                    </a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('landing.schedule') }}" class="menu-card">
                        <div class="menu-icon bg-icon-4"><i class="fas fa-user-nurse"></i></div>
                        <h5 class="fw-bold mb-2">Jadwal Petugas</h5>
                        <p class="text-muted small mb-0">Lihat jadwal petugas UKS yang bertugas</p>
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
                    <img src="{{ asset('images/logo sikes.png') }}" alt="Tentang UKS" class="img-fluid about-img">
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

    <!-- ✅ SECTION KONTAK -->
    <section class="section" id="kontak" style="background: linear-gradient(135deg, #f0f7ff 0%, #e0f2fe 100%);">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title mx-auto">Kontak</h2>
                <p class="section-subtitle">Hubungi kami untuk informasi lebih lanjut</p>
            </div>
            
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; padding: 40px 30px;">
                        <div class="text-center">
                            <div class="mb-3">
                                <i class="fas fa-map-marker-alt fa-2x" style="color: #2563EB;"></i>
                            </div>
                            <h5 class="fw-bold mb-3">Alamat</h5>
                            <p class="text-muted mb-0" style="line-height: 1.8;">
                                Komplek SMK Negeri 1 Bangsri<br>
                                Jalan KH. Achmad Fauzan No.17, Bangsri, Jepara<br>
                                Jawa Tengah, 59453
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; padding: 40px 30px;">
                        <div class="text-center">
                            <div class="mb-3">
                                <i class="fab fa-instagram fa-2x" style="color: #2563EB;"></i>
                            </div>
                            <h5 class="fw-bold mb-3">Sosial Media</h5>
                            <p class="text-muted mb-0" style="line-height: 1.8;">
                                Instagram: <a href="https://instagram.com/pmrwira_eskasaba" target="_blank" class="text-decoration-none fw-semibold text-dark">@pmrwira_eskasaba</a><br>
                                Youtube: <a href="https://youtube.com/@wirasandyaadhimukti3463" target="_blank" class="text-decoration-none fw-semibold text-dark">@wirasandyaadhimukti3463</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm" style="border-radius: 16px; padding: 35px;">
                        <h5 class="fw-bold mb-4">Kirim Pesan</h5>
                        <form>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Lengkap</label>
                                <input type="text" class="form-control" placeholder="Masukkan nama Anda" style="border-radius: 8px;">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control" placeholder="Masukkan email Anda" style="border-radius: 8px;">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Pesan</label>
                                <textarea class="form-control" rows="4" placeholder="Tulis pesan Anda..." style="border-radius: 8px; resize: none;"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2" style="background: #2563EB; border: none; border-radius: 8px; font-weight: 600;">
                                <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100" style="border-radius: 16px; padding: 35px;">
                        <h5 class="fw-bold mb-4">Jam Operasional</h5>
                        
                        <div class="mb-3 pb-3" style="border-bottom: 1px solid #e2e8f0;">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">Senin - Kamis</span>
                                <span class="fw-semibold">08:00 - 15:00</span>
                            </div>
                        </div>
                        
                        <div class="mb-3 pb-3" style="border-bottom: 1px solid #e2e8f0;">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">Jumat</span>
                                <span class="fw-semibold">08:00 - 13:00</span>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">Sabtu - Minggu</span>
                                <span class="fw-semibold text-danger">Tutup</span>
                            </div>
                        </div>
                        
                        <div class="alert" style="background: #fef3c7; border: none; border-radius: 8px; color: #92400e;">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-exclamation-triangle me-2 mt-1" style="color: #f59e0b;"></i>
                                <small class="mb-0">Untuk keadaan darurat di luar jam operasional, silakan hubungi guru piket atau langsung ke IGD terdekat.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
   
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3 text-white">SIKES</h5>
                    <p class="text-light opacity-75" style="line-height: 1.7;">
                        Sistem Informasi Unit Kesehatan Sekolah yang modern dan terpercaya untuk meningkatkan kesehatan siswa.
                    </p>
                </div>
                
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3 text-white">Menu Cepat</h5>
                    <ul class="list-unstyled footer-menu">
                        <li class="mb-2"><a href="{{ route('landing') }}" class="text-light opacity-75">Beranda</a></li>
                        <li class="mb-2"><a href="#tentang" class="text-light opacity-75">Tentang UKS</a></li>
                        <li class="mb-2"><a href="#layanan" class="text-light opacity-75">Layanan UKS</a></li>
                        <li class="mb-2"><a href="{{ route('landing.medicines') }}" class="text-light opacity-75">Informasi Obat</a></li>
                        <li class="mb-2"><a href="{{ route('landing.schedule') }}" class="text-light opacity-75">Jadwal Petugas</a></li>
                        <li class="mb-2"><a href="#kontak" class="text-light opacity-75">Kontak</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3 text-white">Kontak Kami</h5>
                    <ul class="footer-contact-list">
                        <li class="footer-contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Komplek SMK Negeri 1 Bangsri<br>Jalan KH. Achmad Fauzan No.17, Bangsri, Jepara<br>Jawa Tengah, 59453</span>
                        </li>
                        <li class="footer-contact-item">
                            <i class="fab fa-instagram"></i>
                            <a href="https://instagram.com/pmrwira_eskasaba" target="_blank">@pmrwira_eskasaba</a>
                        </li>
                        <li class="footer-contact-item">
                            <i class="fab fa-youtube"></i>
                            <a href="https://youtube.com/@wirasandyaadhimukti3463" target="_blank">@wirasandyaadhimukti3463</a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p class="mb-0 text-light opacity-50">&copy; {{ date('Y') }} SIKES - Sistem Informasi UKS. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script untuk Active State Navbar saat Scroll -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sections = document.querySelectorAll("section[id]");
            const navLinks = document.querySelectorAll(".nav-link");

            window.addEventListener("scroll", () => {
                let current = "";
                sections.forEach((section) => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.clientHeight;
                    if (pageYOffset >= (sectionTop - 100)) {
                        current = section.getAttribute("id");
                    }
                });

                navLinks.forEach((link) => {
                    link.classList.remove("active");
                    if (link.getAttribute("href") === "#" + current) {
                        link.classList.add("active");
                    } else if (current === "" && link.getAttribute("href") === "{{ route('landing') }}") {
                        link.classList.add("active");
                    }
                });
            });
        });
    </script>
</body>
</html>