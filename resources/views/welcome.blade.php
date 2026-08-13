<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIKES - Sistem Informasi UKS Modern</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
    :root {
        --primary: #0ea5e9;
        --primary-dark: #0284c7;
        --secondary: #14b8a6;
        --accent: #8b5cf6;
        --emerald: #10b981;
        --rose: #f43f5e;
        --amber: #f59e0b;
        --ink: #0f172a;
        --slate: #475569;
        --light: #f8fafc;
        --gradient-primary: linear-gradient(135deg, #0ea5e9 0%, #14b8a6 100%);
        --gradient-accent: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
        --gradient-dark: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        --shadow-sm: 0 4px 20px rgba(14, 165, 233, 0.08);
        --shadow-md: 0 10px 40px rgba(14, 165, 233, 0.12);
        --shadow-lg: 0 25px 60px rgba(14, 165, 233, 0.18);
        --radius: 18px;
    }

    * { -webkit-font-smoothing: antialiased; }

    html {
        scroll-behavior: smooth;
        scroll-padding-top: 90px;
    }

    body {
        font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
        background: #fafbfc;
        color: var(--ink);
        line-height: 1.7;
        overflow-x: hidden;
    }

    /* ============ NAVBAR ============ */
    .navbar {
        background: rgba(255,255,255,0.85);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        box-shadow: 0 4px 30px rgba(14, 165, 233, 0.06);
        border-bottom: 1px solid rgba(14, 165, 233, 0.08);
        padding: 12px 0;
        transition: all 0.4s ease;
    }
    .navbar.scrolled { padding: 8px 0; box-shadow: 0 8px 40px rgba(14, 165, 233, 0.1); }
    .navbar-brand { display: flex; align-items: center; }
    .navbar-brand img { max-height: 55px; width: auto; transition: transform 0.3s; }
    .navbar-brand:hover img { transform: scale(1.05); }
    .nav-link {
        font-weight: 600;
        font-size: 0.95rem;
        color: var(--slate) !important;
        padding: 10px 18px !important;
        border-radius: 10px;
        transition: all 0.3s ease;
        letter-spacing: 0.2px;
    }
    .nav-link:hover {
        color: var(--primary) !important;
        background: linear-gradient(135deg, rgba(14,165,233,0.1), rgba(20,184,166,0.1));
        transform: translateY(-1px);
    }
    .nav-link.active {
        color: white !important;
        background: var(--gradient-primary);
        box-shadow: 0 6px 20px rgba(14, 165, 233, 0.3);
    }

    .user-btn {
        background: var(--gradient-primary);
        color: white !important;
        border: none;
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 6px 20px rgba(14, 165, 233, 0.35);
        transition: all 0.3s;
    }
    .user-btn:hover { transform: translateY(-2px) rotate(5deg); box-shadow: 0 10px 28px rgba(14,165,233,0.45); }

    .dropdown-menu {
        border: none;
        border-radius: 14px;
        box-shadow: 0 20px 50px rgba(15,23,42,0.15);
        padding: 10px;
        margin-top: 10px;
    }
    .dropdown-item {
        border-radius: 8px;
        padding: 10px 14px;
        font-weight: 500;
        transition: all 0.2s;
    }
    .dropdown-item:hover {
        background: linear-gradient(135deg, rgba(14,165,233,0.1), rgba(20,184,166,0.1));
        transform: translateX(4px);
    }

    /* ============ HERO (SIMPLE) ============ */
    .hero-section {
        position: relative;
        padding: 90px 0 70px;
        background: linear-gradient(135deg, #f0f9ff 0%, #ecfeff 50%, #f0fdfa 100%);
        overflow: hidden;
    }
    .hero-title {
        font-family: 'Poppins', sans-serif;
        font-size: clamp(2rem, 4.5vw, 3.2rem);
        font-weight: 700;
        color: var(--ink);
        line-height: 1.2;
        margin-bottom: 20px;
        letter-spacing: -1px;
    }
    .gradient-text {
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .hero-subtitle {
        color: var(--slate);
        font-size: 1.05rem;
        margin-bottom: 30px;
        max-width: 540px;
    }
    .hero-img {
        max-height: 380px;
        filter: drop-shadow(0 20px 40px rgba(14,165,233,0.2));
    }

    /* ============ BUTTONS ============ */
    .btn-primary-custom {
        background: var(--gradient-primary);
        color: white;
        padding: 13px 30px;
        border-radius: 12px;
        border: none;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 10px 30px rgba(14,165,233,0.35);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        position: relative;
        overflow: hidden;
    }
    .btn-primary-custom::before {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s;
    }
    .btn-primary-custom:hover::before { left: 100%; }
    .btn-primary-custom:hover {
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(14,165,233,0.5);
    }

    .btn-outline-custom {
        background: white;
        color: var(--ink);
        padding: 13px 30px;
        border-radius: 12px;
        border: 2px solid #e2e8f0;
        font-weight: 600;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-outline-custom:hover {
        border-color: var(--primary);
        color: var(--primary);
        transform: translateY(-3px);
        box-shadow: var(--shadow-md);
    }

    /* ============ MENU CARDS (UNIFIED COLOR) ============ */
    .menu-card {
        background: white;
        border-radius: var(--radius);
        padding: 32px 26px;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid rgba(14,165,233,0.08);
        height: 100%;
        position: relative;
        text-decoration: none;
        display: block;
        color: inherit;
        overflow: hidden;
    }
    .menu-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 4px;
        background: var(--gradient-primary);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }
    .menu-card:hover {
        transform: translateY(-12px);
        box-shadow: var(--shadow-lg);
        border-color: transparent;
    }
    .menu-card:hover::before { transform: scaleX(1); }

    .menu-icon {
        width: 76px; height: 76px;
        border-radius: 20px;
        margin: 0 auto 20px;
        display: flex; align-items: center; justify-content: center;
        font-size: 30px;
        color: white;
        background: var(--gradient-primary);
        box-shadow: 0 12px 30px rgba(14,165,233,0.25);
        transition: all 0.4s;
    }
    .menu-card:hover .menu-icon {
        transform: scale(1.1) rotate(-8deg);
        box-shadow: 0 18px 40px rgba(14,165,233,0.4);
    }
    .menu-card h5 { font-weight: 700; color: var(--ink); margin-bottom: 8px; }
    .menu-card .card-tag {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: 0.75rem; font-weight: 600;
        padding: 4px 10px; border-radius: 50px;
        margin-top: 10px;
    }
    .tag-public { background: #d1fae5; color: #047857; }
    .tag-login { background: #dbeafe; color: #1d4ed8; }

    /* ============ SECTIONS ============ */
    .section { padding: 90px 0; position: relative; }
    .section-label {
        display: inline-block;
        padding: 6px 16px;
        background: rgba(14,165,233,0.1);
        color: var(--primary);
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 16px;
    }
    .section-title {
        font-family: 'Poppins', sans-serif;
        font-size: clamp(1.8rem, 4vw, 2.6rem);
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 16px;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }
    .section-subtitle {
        color: var(--slate);
        font-size: 1.05rem;
        max-width: 600px;
    }

    /* ============ ABOUT (SIMPLE) ============ */
    .about-section { background: white; }
    .about-img-wrap {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
    }
    .about-img-wrap::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(14,165,233,0.15), transparent 60%);
        z-index: 1;
    }
    .about-img-wrap img { width: 100%; height: auto; display: block; }

    .about-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: linear-gradient(135deg, #f0f9ff, #ecfeff);
        border: 1px solid rgba(14,165,233,0.15);
        color: var(--primary-dark);
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s;
    }
    .about-pill:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-sm);
        border-color: rgba(14,165,233,0.3);
    }
    .about-pill i { color: var(--primary); }

    /* ============ SERVICES ============ */
    .services-section {
        background: linear-gradient(135deg, #f0f9ff 0%, #ecfeff 50%, #f0fdfa 100%);
    }
    .service-card {
        background: white;
        padding: 36px 28px;
        border-radius: var(--radius);
        box-shadow: 0 4px 20px rgba(14,165,233,0.06);
        margin-bottom: 25px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        text-align: left;
        height: 100%;
        border: 1px solid rgba(14,165,233,0.08);
        position: relative;
        overflow: hidden;
    }
    .service-card::before {
        content: '';
        position: absolute;
        top: -2px; right: -2px;
        width: 80px; height: 80px;
        background: var(--gradient-primary);
        border-radius: 0 var(--radius) 0 80px;
        opacity: 0.1;
        transition: all 0.4s;
    }
    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
        border-color: transparent;
    }
    .service-card:hover::before { width: 140px; height: 140px; opacity: 0.15; }
    .service-num {
        position: absolute;
        top: 20px; right: 24px;
        font-family: 'Poppins', sans-serif;
        font-size: 3rem;
        font-weight: 700;
        color: rgba(14,165,233,0.08);
        line-height: 1;
    }
    .service-icon {
        width: 64px; height: 64px;
        background: var(--gradient-primary);
        color: white;
        border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.6rem;
        margin-bottom: 22px;
        box-shadow: 0 10px 25px rgba(14,165,233,0.3);
        transition: all 0.3s;
    }
    .service-card:hover .service-icon { transform: rotate(-8deg) scale(1.1); }
    .service-card h5 { font-weight: 700; color: var(--ink); margin-bottom: 10px; }
    .service-card p { color: var(--slate); font-size: 0.92rem; margin-bottom: 0; }

    /* ============ CONTACT ============ */
    .contact-section { background: white; }
    .info-card {
        background: linear-gradient(135deg, #f0f9ff, #f0fdfa);
        border-radius: var(--radius);
        padding: 40px 30px;
        height: 100%;
        border: 1px solid rgba(14,165,233,0.1);
        transition: all 0.3s;
    }
    .info-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-md); }
    .info-icon {
        width: 60px; height: 60px;
        background: var(--gradient-primary);
        color: white;
        border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 20px;
        box-shadow: 0 10px 25px rgba(14,165,233,0.3);
    }

    .form-card {
        background: white;
        border-radius: var(--radius);
        padding: 40px;
        box-shadow: var(--shadow-md);
        border: 1px solid rgba(14,165,233,0.08);
    }
    .form-control {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px 18px;
        transition: all 0.3s;
        font-size: 0.95rem;
    }
    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(14,165,233,0.1);
    }
    .form-label { font-weight: 600; color: var(--ink); margin-bottom: 8px; }

    .schedule-card {
        background: linear-gradient(135deg, #f8fafc, #f0f9ff);
        border-radius: var(--radius);
        padding: 40px;
        height: 100%;
        border: 1px solid rgba(14,165,233,0.1);
    }
    .schedule-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 0;
        border-bottom: 1px dashed #cbd5e1;
    }
    .schedule-row:last-child { border-bottom: none; }
    .schedule-day { font-weight: 600; color: var(--ink); }
    .schedule-time { font-weight: 700; color: var(--primary); }
    .schedule-time.closed { color: var(--rose); }

    .alert-warning-custom {
        background: linear-gradient(135deg, #fef3c7, #fed7aa);
        border: none;
        border-radius: 12px;
        padding: 16px 20px;
        color: #92400e;
        display: flex; align-items: flex-start; gap: 12px;
    }
    .alert-warning-custom i { color: #f59e0b; font-size: 1.1rem; }

    /* ============ FOOTER ============ */
    footer {
        background: var(--gradient-dark);
        color: white;
        padding: 80px 0 30px;
        position: relative;
        overflow: hidden;
    }
    footer::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            radial-gradient(circle at 10% 20%, rgba(14,165,233,0.15) 0%, transparent 40%),
            radial-gradient(circle at 90% 80%, rgba(139,92,246,0.15) 0%, transparent 40%);
    }
    footer .container { position: relative; z-index: 1; }
    .footer-logo {
        display: inline-flex; align-items: center; gap: 12px;
        margin-bottom: 20px;
        font-family: 'Poppins', sans-serif;
        font-weight: 700; font-size: 1.4rem;
    }
    .footer-logo-icon {
        width: 46px; height: 46px;
        background: var(--gradient-primary);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        color: white;
        font-size: 1.2rem;
    }
    footer h6 { font-weight: 700; margin-bottom: 22px; color: white; text-transform: uppercase; letter-spacing: 1px; font-size: 0.9rem; }
    .footer-menu { list-style: none; padding: 0; margin: 0; }
    .footer-menu li { margin-bottom: 12px; }
    .footer-menu a {
        color: rgba(255,255,255,0.7);
        text-decoration: none;
        font-weight: 500;
        font-size: 0.95rem;
        transition: all 0.3s;
        display: inline-flex; align-items: center; gap: 8px;
    }
    .footer-menu a:hover { color: var(--primary); transform: translateX(6px); }

    .social-links { display: flex; gap: 10px; margin-top: 20px; }
    .social-links a {
        width: 42px; height: 42px;
        border-radius: 12px;
        background: rgba(255,255,255,0.08);
        display: flex; align-items: center; justify-content: center;
        color: white;
        transition: all 0.3s;
        text-decoration: none;
    }
    .social-links a:hover {
        background: var(--gradient-primary);
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(14,165,233,0.4);
    }

    .footer-bottom {
        border-top: 1px solid rgba(255,255,255,0.1);
        margin-top: 50px;
        padding-top: 25px;
        text-align: center;
        color: rgba(255,255,255,0.5);
        font-size: 0.9rem;
    }

    /* ============ SCROLL TO TOP ============ */
    .scroll-top {
        position: fixed;
        bottom: 30px; right: 30px;
        width: 50px; height: 50px;
        background: var(--gradient-primary);
        color: white;
        border: none;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 10px 30px rgba(14,165,233,0.4);
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transform: translateY(20px);
        transition: all 0.3s;
        z-index: 999;
    }
    .scroll-top.show { opacity: 1; visibility: visible; transform: translateY(0); }
    .scroll-top:hover { transform: translateY(-4px); box-shadow: 0 15px 40px rgba(14,165,233,0.55); }

    /* ============ RESPONSIVE ============ */
    @media (max-width: 768px) {
        .hero-section { padding: 60px 0; }
        .section { padding: 60px 0; }
        .navbar-brand img { max-height: 45px; }
    }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('landing') }}">
                <img src="{{ asset('images/logo sikes navbar.png') }}" alt="Logo SIKES">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-1">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('landing') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#layanan">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing.medicines') }}">Obat</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing.schedule') }}">Jadwal</a></li>

                    <li class="nav-item ms-lg-3">
                        <div class="dropdown">
                            <button class="btn user-btn" type="button" data-bs-toggle="dropdown">
                                <i class="fas {{ auth()->check() ? 'fa-user-check' : 'fa-user' }}"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                @auth
                                    <li class="dropdown-header text-center pb-2">
                                        <small class="text-muted d-block">Halo,</small>
                                        <strong class="text-dark">{{ auth()->user()->name ?? 'User' }}</strong>
                                        <span class="badge bg-primary mt-1">{{ auth()->user()->getRoleNames()->first() ?? 'User' }}</span>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route(auth()->user()->hasRole(['super-admin', 'admin']) ? 'admin.dashboard' : (auth()->user()->hasRole('petugas') ? 'petugas.dashboard' : 'siswa.history')) }}">
                                            <i class="fas fa-tachometer-alt me-2 text-primary"></i> Dashboard
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                                            </button>
                                        </form>
                                    </li>
                                @else
                                    <li class="dropdown-header text-center">
                                        <small class="text-muted">Pilih Login</small>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item fw-semibold" href="{{ route('login') }}">
                                            <i class="fas fa-user-shield me-2 text-primary"></i> Admin / Petugas
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('login.siswa') }}">
                                            <i class="fas fa-user-graduate me-2 text-info"></i> Login Siswa
                                        </a>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero (Simple) -->
    <section class="hero-section" id="beranda">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right" data-aos-duration="700">
                    <h1 class="hero-title">Selamat Datang di <span class="gradient-text">SIKES</span><br>SMK Negeri 1 Bangsri</h1>
                    <p class="hero-subtitle">Layanan kesehatan sekolah yang digital, cepat, dan terpercaya untuk seluruh warga sekolah.</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ auth()->check() && auth()->user()->hasRole('siswa') ? route('siswa.history') : route('login.siswa') }}" class="btn btn-primary-custom">
                            <i class="fas fa-history"></i> Riwayat Kunjungan
                        </a>
                        <a href="#tentang" class="btn btn-outline-custom">
                            <i class="fas fa-info-circle"></i> Pelajari Lebih
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center" data-aos="fade-left" data-aos-duration="700">
                    <img src="https://img.freepik.com/free-vector/doctor-character-background_1270-84.jpg" alt="Ilustrasi UKS" class="img-fluid hero-img">
                </div>
            </div>

            <!-- Menu Cards (3 cards, unified icon color) -->
            <div class="row g-4 mt-5 justify-content-center">
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
                    <a href="{{ auth()->check() && auth()->user()->hasRole('siswa') ? route('siswa.history') : route('login.siswa') }}" class="menu-card">
                        <div class="menu-icon"><i class="fas fa-history"></i></div>
                        <h5 class="fw-bold mb-2">Riwayat Kunjungan</h5>
                        <p class="text-muted small mb-0">Cek riwayat rekam medis Anda</p>
                        @if(!auth()->check() || !auth()->user()->hasRole('siswa'))
                            <span class="card-tag tag-login"><i class="fas fa-lock"></i> Login Siswa</span>
                        @endif
                    </a>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <a href="{{ route('landing.medicines') }}" class="menu-card">
                        <div class="menu-icon"><i class="fas fa-pills"></i></div>
                        <h5 class="fw-bold mb-2">Informasi Obat</h5>
                        <p class="text-muted small mb-0">Daftar lengkap obat UKS</p>
                        <span class="card-tag tag-public"><i class="fas fa-globe"></i> Publik</span>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('landing.schedule') }}" class="menu-card">
                        <div class="menu-icon"><i class="fas fa-user-nurse"></i></div>
                        <h5 class="fw-bold mb-2">Jadwal Petugas</h5>
                        <p class="text-muted small mb-0">Jadwal bertugas petugas UKS</p>
                        <span class="card-tag tag-public"><i class="fas fa-globe"></i> Publik</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About (Simple) -->
    <section class="section about-section" id="tentang">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-5" data-aos="fade-right">
                    <div class="about-img-wrap">
                        <img src="{{ asset('images/logo sikes.png') }}" alt="Tentang UKS">
                    </div>
                </div>
                <div class="col-lg-7" data-aos="fade-left">
                    <span class="section-label">Tentang Kami</span>
                    <h2 class="section-title">Mengenal Lebih Dekat <span class="gradient-text">SIKES</span></h2>
                    <p style="color: var(--slate); margin-bottom: 28px;">SIKES adalah sistem informasi berbasis web yang membantu Unit Kesehatan Sekolah (UKS) mengelola data kesehatan siswa secara digital, terintegrasi, dan efisien — mulai dari pencatatan pemeriksaan, pengelolaan stok obat, hingga pembuatan laporan.</p>

                    <div class="d-flex flex-wrap gap-3">
                        <span class="about-pill"><i class="fas fa-database"></i> Data Digital</span>
                        <span class="about-pill"><i class="fas fa-link"></i> Terintegrasi</span>
                        <span class="about-pill"><i class="fas fa-bolt"></i> Efisien</span>
                        <span class="about-pill"><i class="fas fa-shield-alt"></i> Terpercaya</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services -->
    <section class="section services-section" id="layanan">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-label">Layanan Kami</span>
                <h2 class="section-title">Layanan Kesehatan <span class="gradient-text">Profesional</span></h2>
                <p class="section-subtitle mx-auto">Berbagai layanan kesehatan lengkap yang kami sediakan untuk siswa</p>
            </div>
            <div class="row g-4">
                @php
                    $services = [
                        ['stethoscope', 'Pemeriksaan Kesehatan', 'Pemeriksaan rutin dan saat sakit dengan tenaga profesional.'],
                        ['pills', 'Pelayanan Obat', 'Penyediaan obat lengkap dan terjamin kualitasnya.'],
                        ['heartbeat', 'Pertolongan Pertama', 'Pertolongan pertama pada kecelakaan & keadaan darurat.'],
                        ['user-md', 'Konsultasi Kesehatan', 'Konsultasi kesehatan fisik dan mental dengan petugas terlatih.'],
                        ['clipboard-check', 'Pemeriksaan Berkala', 'Pemeriksaan berkala untuk memantau kondisi siswa.'],
                        ['graduation-cap', 'Edukasi Kesehatan', 'Penyuluhan dan edukasi tentang pola hidup sehat.']
                    ];
                @endphp
                @foreach($services as $i => $s)
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                    <div class="service-card">
                        <span class="service-num">0{{ $i+1 }}</span>
                        <div class="service-icon"><i class="fas fa-{{ $s[0] }}"></i></div>
                        <h5 class="fw-bold">{{ $s[1] }}</h5>
                        <p>{{ $s[2] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact -->
    <section class="section contact-section" id="kontak">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-label">Hubungi Kami</span>
                <h2 class="section-title">Siap Melayani <span class="gradient-text">Anda</span></h2>
                <p class="section-subtitle mx-auto">Hubungi kami untuk informasi lebih lanjut tentang layanan UKS</p>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="0">
                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <h5 class="fw-bold mb-3">Alamat Kami</h5>
                        <p style="color: var(--slate); line-height: 1.8; margin-bottom: 0;">
                            Komplek SMK Negeri 1 Bangsri<br>
                            Jalan KH. Achmad Fauzan No.17, Bangsri, Jepara<br>
                            Jawa Tengah, 59453
                        </p>
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="info-card">
                        <div class="info-icon"><i class="fab fa-instagram"></i></div>
                        <h5 class="fw-bold mb-3">Sosial Media</h5>
                        <p style="color: var(--slate); line-height: 2; margin-bottom: 0;">
                            <i class="fab fa-instagram me-2 text-danger"></i>
                            <a href="https://instagram.com/pmrwira_eskasaba" target="_blank" style="color: var(--ink); text-decoration: none; font-weight: 600;">@pmrwira_eskasaba</a><br>
                            <i class="fab fa-youtube me-2 text-danger"></i>
                            <a href="https://youtube.com/@wirasandyaadhimukti3463" target="_blank" style="color: var(--ink); text-decoration: none; font-weight: 600;">@wirasandyaadhimukti3463</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="form-card">
                        <h5 class="fw-bold mb-4"><i class="fas fa-paper-plane me-2 text-primary"></i>Kirim Pesan</h5>
                        <form>
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" placeholder="Masukkan nama Anda">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="Masukkan email Anda">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pesan</label>
                                <textarea class="form-control" rows="4" placeholder="Tulis pesan Anda..." style="resize: none;"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary-custom w-100 py-3">
                                <i class="fas fa-paper-plane"></i> Kirim Pesan Sekarang
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="schedule-card">
                        <h5 class="fw-bold mb-4"><i class="fas fa-clock me-2 text-primary"></i>Jam Operasional</h5>
                        <div class="schedule-row">
                            <span class="schedule-day">Senin - Kamis</span>
                            <span class="schedule-time">08:00 - 15:00</span>
                        </div>
                        <div class="schedule-row">
                            <span class="schedule-day">Jumat</span>
                            <span class="schedule-time">08:00 - 13:00</span>
                        </div>
                        <div class="schedule-row">
                            <span class="schedule-day">Sabtu - Minggu</span>
                            <span class="schedule-time closed">Tutup</span>
                        </div>
                        <div class="alert-warning-custom mt-4">
                            <i class="fas fa-exclamation-triangle"></i>
                            <small class="mb-0">Untuk keadaan darurat di luar jam operasional, silakan hubungi guru piket atau langsung ke IGD terdekat.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="footer-logo">
                        <div class="footer-logo-icon"><i class="fas fa-heartbeat"></i></div>
                        <span>SIKES</span>
                    </div>
                    <p style="color: rgba(255,255,255,0.7); line-height: 1.8; margin-bottom: 24px;">
                        Sistem Informasi Unit Kesehatan Sekolah modern dan terpercaya untuk meningkatkan kualitas kesehatan seluruh warga sekolah.
                    </p>
                    <div class="social-links">
                        <a href="https://instagram.com/pmrwira_eskasaba" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://youtube.com/@wirasandyaadhimukti3463" target="_blank"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                        <a href="#"><i class="fas fa-envelope"></i></a>
                    </div>
                </div>

                <div class="col-6 col-lg-2">
                    <h6>Navigasi</h6>
                    <ul class="footer-menu">
                        <li><a href="{{ route('landing') }}"><i class="fas fa-chevron-right fa-xs"></i> Beranda</a></li>
                        <li><a href="{{ route('landing') }}#tentang"><i class="fas fa-chevron-right fa-xs"></i> Tentang</a></li>
                        <li><a href="{{ route('landing') }}#layanan"><i class="fas fa-chevron-right fa-xs"></i> Layanan</a></li>
                        <li><a href="{{ route('landing') }}#kontak"><i class="fas fa-chevron-right fa-xs"></i> Kontak</a></li>
                    </ul>
                </div>

                <div class="col-6 col-lg-3">
                    <h6>Layanan</h6>
                    <ul class="footer-menu">
                        <li><a href="{{ route('landing.medicines') }}"><i class="fas fa-chevron-right fa-xs"></i> Informasi Obat</a></li>
                        <li><a href="{{ route('landing.schedule') }}"><i class="fas fa-chevron-right fa-xs"></i> Jadwal Petugas</a></li>
                        <li><a href="{{ auth()->check() && auth()->user()->hasRole('siswa') ? route('siswa.history') : route('login.siswa') }}"><i class="fas fa-chevron-right fa-xs"></i> Riwayat</a></li>
                    </ul>
                </div>

                <div class="col-lg-3">
                    <h6>Kontak</h6>
                    <ul class="footer-menu">
                        <li><a href="#"><i class="fas fa-map-marker-alt"></i> Jl. KH. Achmad Fauzan No.17, Bangsri</a></li>
                        <li><a href="https://instagram.com/pmrwira_eskasaba" target="_blank"><i class="fab fa-instagram"></i> @pmrwira_eskasaba</a></li>
                        <li><a href="https://youtube.com/@wirasandyaadhimukti3463" target="_blank"><i class="fab fa-youtube"></i> @wirasandyaadhimukti3463</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p class="mb-0">&copy; {{ date('Y') }} <strong>SIKES</strong> - Sistem Informasi UKS SMK Negeri 1 Bangsri. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top -->
    <button class="scroll-top" id="scrollTop">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init({ duration: 800, once: true, offset: 80 });

        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            const scrollTop = document.getElementById('scrollTop');
            if (window.scrollY > 50) navbar.classList.add('scrolled');
            else navbar.classList.remove('scrolled');
            if (window.scrollY > 300) scrollTop.classList.add('show');
            else scrollTop.classList.remove('show');
        });

        document.getElementById('scrollTop').addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const sections = document.querySelectorAll("section[id]");
            const navLinks = document.querySelectorAll(".nav-link");

            window.addEventListener("scroll", () => {
                let current = "";
                sections.forEach((section) => {
                    const sectionTop = section.offsetTop;
                    if (pageYOffset >= (sectionTop - 150)) {
                        current = section.getAttribute("id");
                    }
                });

                navLinks.forEach((link) => {
                    link.classList.remove("active");
                    if (link.getAttribute("href") === "#" + current) {
                        link.classList.add("active");
                    } else if (current === "" && (link.getAttribute("href") === "{{ route('landing') }}" || link.getAttribute("href") === "#beranda")) {
                        link.classList.add("active");
                    }
                });
            });
        });
    </script>
</body>
</html>