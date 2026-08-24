<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>SIKES - Sistem Informasi UKS Modern</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
    :root {
        --primary: #3b82f6;
        --primary-dark: #1e3a8a;
        --secondary: #2563eb;
        --accent: #8b5cf6;
        --emerald: #10b981;
        --rose: #f43f5e;
        --amber: #f59e0b;
        --ink: #0f172a;
        --slate: #475569;
        --light: #f8fafc;
        --pro: #1e3a8a;
        --pro-dark: #172c6e;
        --pro-light: #3b82f6;
        --gradient-pro: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        --gradient-primary: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        --gradient-accent: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
        --gradient-dark: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        --shadow-sm: 0 4px 20px rgba(30, 58, 138, 0.08);
        --shadow-md: 0 10px 40px rgba(30, 58, 138, 0.12);
        --shadow-lg: 0 25px 60px rgba(30, 58, 138, 0.18);
        --radius: 18px;
    }

    * { -webkit-font-smoothing: antialiased; -webkit-tap-highlight-color: transparent; }

    html {
        scroll-behavior: smooth;
        scroll-padding-top: 80px;
    }

    body {
        font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
        background: #fafbfc;
        color: var(--ink);
        line-height: 1.6;
        overflow-x: hidden;
    }

    /* ============ NAVBAR ============ */
    .navbar {
        background: rgba(255,255,255,0.92);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        box-shadow: 0 4px 30px rgba(30, 58, 138, 0.06);
        border-bottom: 1px solid rgba(30, 58, 138, 0.08);
        padding: 12px 0;
        transition: all 0.4s ease;
    }
    .navbar.scrolled { padding: 8px 0; box-shadow: 0 8px 40px rgba(30, 58, 138, 0.1); }
    .navbar-brand { display: flex; align-items: center; }
    .navbar-brand img { max-height: 50px; width: auto; transition: transform 0.3s; }
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
        color: var(--primary-dark) !important;
        background: linear-gradient(135deg, rgba(30,58,138,0.08), rgba(59,130,246,0.08));
    }
    .nav-link.active {
        color: white !important;
        background: var(--gradient-primary);
        box-shadow: 0 6px 20px rgba(30, 58, 138, 0.25);
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
        box-shadow: 0 6px 20px rgba(30, 58, 138, 0.3);
        transition: all 0.3s;
    }
    .user-btn:active { transform: scale(0.95); }

    .dropdown-menu {
        border: none;
        border-radius: 14px;
        box-shadow: 0 20px 50px rgba(15,23,42,0.15);
        padding: 10px;
        margin-top: 10px;
        animation: fadeInDrop 0.3s ease;
    }
    @keyframes fadeInDrop {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .dropdown-item {
        border-radius: 8px;
        padding: 10px 14px;
        font-weight: 500;
        transition: all 0.2s;
    }
    .dropdown-item:active {
        background: linear-gradient(135deg, rgba(30,58,138,0.08), rgba(59,130,246,0.08));
        transform: translateX(4px);
    }

    /* ============ HERO ============ */
    .hero-section {
        position: relative;
        padding: 100px 0 80px;
        background: linear-gradient(180deg, #f7fafc 0%, #edf2fa 100%);
        overflow: hidden;
    }
    .hero-decor { position: absolute; inset: 0; pointer-events: none; }
    .decor-dots {
        position: absolute;
        width: 140px; height: 95px;
        background-image: radial-gradient(circle, rgba(30,58,138,0.22) 2px, transparent 2.6px);
        background-size: 16px 16px;
    }
    .dots-1 { top: 55px; right: 55px; }
    .dots-2 { bottom: 55px; left: 35px; }
    .decor-plus { position: absolute; color: rgba(30,58,138,0.18); }
    .plus-1 { top: 42%; left: 3%; font-size: 22px; color: rgba(59,130,246,0.3); }
    .plus-2 { top: 16%; right: 24%; font-size: 15px; }
    .plus-3 { bottom: 20%; right: 6%; font-size: 20px; color: rgba(59,130,246,0.28); }
    .plus-4 { top: 12%; left: 22%; font-size: 14px; }
    .decor-circle { position: absolute; border-radius: 50%; background: rgba(30,58,138,0.05); }
    .circle-1 { width: 240px; height: 240px; right: -90px; bottom: -70px; }
    .circle-2 { width: 150px; height: 150px; left: -70px; top: -50px; background: rgba(59,130,246,0.07); }

    .hero-title {
        font-family: 'Poppins', sans-serif;
        font-size: clamp(1.8rem, 5vw, 2.8rem);
        font-weight: 700;
        color: var(--ink);
        line-height: 1.25;
        margin-bottom: 20px;
        letter-spacing: -0.5px;
    }
    .hero-accent {
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .hero-subtitle {
        color: var(--slate);
        font-size: 1rem;
        margin-bottom: 30px;
        max-width: 470px;
    }

    .btn-hero-primary, .btn-hero-outline {
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s;
        text-decoration: none;
        font-size: 0.95rem;
    }
    .btn-hero-primary {
        background: var(--gradient-primary);
        color: white;
        border: none;
        box-shadow: 0 6px 20px rgba(30,58,138,0.25);
    }
    .btn-hero-primary:active { transform: scale(0.97); }
    
    .btn-hero-outline {
        background: white;
        color: var(--pro);
        border: 1px solid #d5e0ec;
        box-shadow: 0 3px 12px rgba(30,58,138,0.06);
    }
    .btn-hero-outline:active { transform: scale(0.97); }

    /* ============ STAT CARDS ============ */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 20px 18px;
        display: flex;
        align-items: flex-start;
        gap: 14px;
        border: 1px solid #e4ebf5;
        box-shadow: 0 6px 20px rgba(30,58,138,0.06);
        transition: all 0.3s;
    }
    .stat-icon {
        flex: 0 0 48px;
        width: 48px; height: 48px;
        border-radius: 12px;
        background: linear-gradient(135deg, rgba(30,58,138,0.1), rgba(59,130,246,0.12));
        color: var(--pro);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.15rem;
    }
    .stat-card h3 {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        font-size: 1.4rem;
        color: var(--ink);
        line-height: 1.2;
        margin-bottom: 2px;
    }
    .stat-label { font-weight: 700; font-size: 0.8rem; color: #334155; margin-bottom: 2px; }
    .stat-note { color: #8a94a6; font-size: 0.7rem; line-height: 1.3; }

    /* ============ MENU CARDS ============ */
    .menu-card {
        background: white;
        border-radius: var(--radius);
        padding: 28px 20px;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid #e4ebf5;
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
        background: var(--gradient-pro);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }
    .menu-card:active { transform: scale(0.98); }
    .menu-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 60px rgba(30,58,138,0.12);
        border-color: transparent;
    }
    .menu-card:hover::before { transform: scaleX(1); }

    .menu-icon {
        width: 68px; height: 68px;
        border-radius: 18px;
        margin: 0 auto 18px;
        display: flex; align-items: center; justify-content: center;
        font-size: 26px;
        color: white;
        background: var(--gradient-pro);
        box-shadow: 0 12px 30px rgba(30,58,138,0.25);
        transition: all 0.4s;
    }
    .menu-card h5 { font-weight: 700; color: var(--ink); margin-bottom: 6px; font-size: 1.05rem; }
    .menu-card .card-tag {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: 0.72rem; font-weight: 600;
        padding: 5px 12px; border-radius: 50px;
        margin-top: 12px;
    }
    .tag-public { background: #e4f4ec; color: #1e7a55; }
    .tag-login { background: #e6eef8; color: #1e3a8a; }

    /* ============ SECTIONS ============ */
    .section { padding: 80px 0; position: relative; }
    .section-label {
        display: inline-block;
        padding: 6px 16px;
        background: rgba(59,130,246,0.12);
        color: var(--pro);
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 14px;
    }
    .section-title {
        font-family: 'Poppins', sans-serif;
        font-size: clamp(1.6rem, 5vw, 2.4rem);
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 14px;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }
    .section-subtitle {
        color: var(--slate);
        font-size: 0.95rem;
        max-width: 600px;
    }
    .gradient-text {
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* ============ ABOUT ============ */
    .about-section { background: white; }
    .about-img-wrap {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        max-width: 100%;
    }
    .about-img-wrap::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(30,58,138,0.15), transparent 60%);
        z-index: 1;
    }
    .about-img-wrap img { width: 100%; height: auto; display: block; }

    .about-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        background: linear-gradient(135deg, #f6f9fc, #eef3fb);
        border: 1px solid rgba(30,58,138,0.15);
        color: var(--primary-dark);
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s;
    }

    /* ============ SERVICES ============ */
    .services-section {
        background: linear-gradient(135deg, #f6f9fc 0%, #eef3fb 50%, #f3f7fc 100%);
    }
    .service-card {
        background: white;
        padding: 32px 24px;
        border-radius: var(--radius);
        box-shadow: 0 4px 20px rgba(30,58,138,0.06);
        margin-bottom: 20px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        text-align: left;
        height: 100%;
        border: 1px solid rgba(30,58,138,0.08);
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
    .service-card:active { transform: scale(0.98); }
    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
        border-color: transparent;
    }
    .service-card:hover::before { width: 140px; height: 140px; opacity: 0.15; }
    .service-num {
        position: absolute;
        top: 16px; right: 20px;
        font-family: 'Poppins', sans-serif;
        font-size: 2.8rem;
        font-weight: 700;
        color: rgba(30,58,138,0.06);
        line-height: 1;
        pointer-events: none;
    }
    .service-icon {
        width: 58px; height: 58px;
        background: var(--gradient-primary);
        color: white;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem;
        margin-bottom: 18px;
        box-shadow: 0 10px 25px rgba(30,58,138,0.25);
    }
    .service-card h5 { font-weight: 700; color: var(--ink); margin-bottom: 8px; font-size: 1.05rem; }
    .service-card p { color: var(--slate); font-size: 0.9rem; margin-bottom: 0; line-height: 1.6; }

    /* ============ CONTACT ============ */
    .contact-section { background: white; }
    .info-card {
        background: linear-gradient(135deg, #f6f9fc, #f3f7fc);
        border-radius: var(--radius);
        padding: 32px 24px;
        height: 100%;
        border: 1px solid rgba(30,58,138,0.1);
        transition: all 0.3s;
    }
    .info-card:active { transform: scale(0.98); }
    .info-icon {
        width: 54px; height: 54px;
        background: var(--gradient-primary);
        color: white;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.3rem;
        margin-bottom: 18px;
        box-shadow: 0 10px 25px rgba(30,58,138,0.25);
    }

    /* ============ FOOTER ============ */
    footer {
        background: var(--gradient-dark);
        color: white;
        padding: 60px 0 30px;
        position: relative;
        overflow: hidden;
    }
    footer::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            radial-gradient(circle at 10% 20%, rgba(30,58,138,0.25) 0%, transparent 40%),
            radial-gradient(circle at 90% 80%, rgba(59,130,246,0.15) 0%, transparent 40%);
    }
    footer .container { position: relative; z-index: 1; }
    .footer-logo {
        display: inline-flex; align-items: center; gap: 12px;
        margin-bottom: 18px;
        font-family: 'Poppins', sans-serif;
        font-weight: 700; font-size: 1.3rem;
    }
    footer h6 { font-weight: 700; margin-bottom: 20px; color: white; text-transform: uppercase; letter-spacing: 1px; font-size: 0.85rem; }
    .footer-menu { list-style: none; padding: 0; margin: 0; }
    .footer-menu li { margin-bottom: 10px; }
    .footer-menu a {
        color: rgba(255,255,255,0.7);
        text-decoration: none;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.3s;
        display: inline-flex; align-items: center; gap: 8px;
    }
    .footer-menu a:active { color: #93c5fd; transform: translateX(6px); }

    .footer-bottom {
        border-top: 1px solid rgba(255,255,255,0.1);
        margin-top: 40px;
        padding-top: 20px;
        text-align: center;
        color: rgba(255,255,255,0.5);
        font-size: 0.85rem;
    }

    /* ============ SCROLL TO TOP ============ */
    .scroll-top {
        position: fixed;
        bottom: 24px; right: 24px;
        width: 48px; height: 48px;
        background: var(--gradient-primary);
        color: white;
        border: none;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 10px 30px rgba(30,58,138,0.35);
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transform: translateY(20px);
        transition: all 0.3s;
        z-index: 999;
    }
    .scroll-top.show { opacity: 1; visibility: visible; transform: translateY(0); }
    .scroll-top:active { transform: scale(0.9); }

    /* ==========================================================================
       ============ RESPONSIVE MOBILE IMPROVEMENTS (OPTIMIZED) ============
       ========================================================================== */
    
    /* Tablet & Mobile Landscape */
    @media (max-width: 991px) {
        .navbar-collapse {
            background: white;
            padding: 20px;
            border-radius: 16px;
            margin-top: 15px;
            box-shadow: 0 15px 40px rgba(15,23,42,0.1);
            border: 1px solid rgba(30, 58, 138, 0.08);
        }
        .nav-link {
            padding: 12px 16px !important;
            border-bottom: 1px solid #f1f5f9;
        }
        .nav-link:last-child { border-bottom: none; }
        .nav-link.active { margin-bottom: 5px; }
        
        .dropdown-menu {
            box-shadow: none;
            padding: 5px 0 5px 15px;
            margin-top: 5px;
            border-left: 2px solid var(--primary);
            border-radius: 0 8px 8px 0;
        }
        .user-btn { margin: 10px auto 0; display: flex; }
    }

    /* Mobile Phones */
    @media (max-width: 768px) {
        .hero-section { padding: 70px 0 50px; }
        .section { padding: 50px 0; }
        .navbar-brand img { max-height: 42px; }
        
        /* Sembunyikan dekorasi background di HP agar tidak berantakan & ringan */
        .hero-decor { display: none; }
        
        .hero-title { font-size: 1.75rem; text-align: center; }
        .hero-subtitle { text-align: center; margin: 0 auto 25px; font-size: 0.95rem; }
        .hero-section .d-flex { justify-content: center; }
        .btn-hero-primary, .btn-hero-outline { width: 100%; max-width: 300px; }

        .about-img-wrap { margin-bottom: 30px; }
        .about-section .text-lg-start { text-align: center !important; }
        .about-section .d-flex { justify-content: center; }
        
        .section-title { text-align: center; }
        .section-subtitle { text-align: center; }
        
        .footer-logo { justify-content: center; display: flex; }
        footer { text-align: center; }
        .footer-menu { text-align: center; }
        .footer-menu a { justify-content: center; }
        .footer-menu a i { font-size: 0.7rem; }
    }

    /* Small Mobile Phones */
    @media (max-width: 576px) {
        .stats-grid { grid-template-columns: 1fr; gap: 14px; }
        .stat-card { padding: 16px; }
        .stat-icon { width: 44px; height: 44px; font-size: 1.1rem; }
        .stat-card h3 { font-size: 1.3rem; }
        
        .menu-card { padding: 24px 18px; }
        .menu-icon { width: 60px; height: 60px; font-size: 24px; }
        
        .service-card { padding: 24px 20px; }
        .service-num { font-size: 2.2rem; top: 12px; right: 15px; }
        .service-icon { width: 50px; height: 50px; font-size: 1.25rem; }
        
        .info-card { padding: 24px 20px; text-align: center; }
        .info-icon { margin: 0 auto 16px; }
        
        .scroll-top { bottom: 20px; right: 20px; width: 44px; height: 44px; }
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
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-1">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('landing') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#layanan">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>

                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <div class="dropdown">
                            <button class="btn user-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                                            <button type="submit" class="dropdown-item text-danger w-100 text-start">
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

    <!-- Hero -->
    <section class="hero-section" id="beranda">
        <div class="hero-decor">
            <span class="decor-dots dots-1"></span>
            <span class="decor-dots dots-2"></span>
            <i class="fas fa-plus decor-plus plus-1"></i>
            <i class="fas fa-plus decor-plus plus-2"></i>
            <i class="fas fa-plus decor-plus plus-3"></i>
            <i class="fas fa-plus decor-plus plus-4"></i>
            <span class="decor-circle circle-1"></span>
            <span class="decor-circle circle-2"></span>
        </div>
        <div class="container position-relative">
            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-lg-6 text-lg-start text-center" data-aos="fade-right" data-aos-duration="700">
                    <h1 class="hero-title">Selamat Datang di<br><span class="hero-accent">Sistem Informasi UKS</span><br>SMK Negeri 1 Bangsri</h1>
                    <p class="hero-subtitle">Layanan kesehatan sekolah yang modern, cepat, dan terpercaya. Kami siap melayani kebutuhan kesehatan siswa dengan profesional.</p>
                    <div class="d-flex gap-3 flex-wrap justify-content-lg-start justify-content-center">
                        <a href="{{ auth()->check() && auth()->user()->hasRole('siswa') ? route('siswa.history') : route('login.siswa') }}" class="btn-hero-primary">
                            <i class="fas fa-history"></i> Riwayat Kunjungan
                        </a>
                        <a href="#tentang" class="btn-hero-outline">
                            <i class="fas fa-info-circle"></i> Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-duration="700">
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fas fa-users"></i></div>
                            <div>
                                <h3>{{ number_format($totalStudents) }}</h3>
                                <div class="stat-label">Siswa Terdaftar</div>
                                <div class="stat-note">Tahun Ajaran 2025/2026</div>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fas fa-clipboard-check"></i></div>
                            <div>
                                <h3>{{ $examsToday }}</h3>
                                <div class="stat-label">Kunjungan Hari Ini</div>
                                <div class="stat-note">Update: Hari Ini</div>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fas fa-heart-pulse"></i></div>
                            <div>
                                <h3>{{ $examsMonth }}</h3>
                                <div class="stat-label">Total Kunjungan</div>
                                <div class="stat-note">Bulan Ini</div>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fas fa-shield-alt"></i></div>
                            <div>
                                <h3>{{ $optimalPercentage }}%</h3>
                                <div class="stat-label">Layanan Optimal</div>
                                <div class="stat-note">Kami Siap Melayani</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu Cards -->
            <div class="row g-3 g-md-4 mt-2 mt-md-5 justify-content-center">
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

    <!-- About -->
    <section class="section about-section" id="tentang">
        <div class="container">
            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-lg-5" data-aos="fade-right">
                    <div class="about-img-wrap">
                        <img src="{{ asset('images/logo sikes.png') }}" alt="Tentang UKS">
                    </div>
                </div>
                <div class="col-lg-7 text-lg-start text-center" data-aos="fade-left">
                    <span class="section-label">Tentang Kami</span>
                    <h2 class="section-title">Mengenal Lebih Dekat <span class="gradient-text">SIKES</span></h2>
                    <p style="color: var(--slate); margin-bottom: 24px; font-size: 0.95rem;">SIKES adalah sistem informasi berbasis web yang membantu Unit Kesehatan Sekolah (UKS) mengelola data kesehatan siswa secara digital, terintegrasi, dan efisien — mulai dari pencatatan pemeriksaan, pengelolaan stok obat, hingga pembuatan laporan.</p>

                    <div class="d-flex flex-wrap gap-2 justify-content-lg-start justify-content-center">
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
            <div class="text-center mb-4 mb-md-5" data-aos="fade-up">
                <span class="section-label">Layanan Kami</span>
                <h2 class="section-title">Layanan Kesehatan <span class="gradient-text">Profesional</span></h2>
                <p class="section-subtitle mx-auto">Berbagai layanan kesehatan lengkap yang kami sediakan untuk siswa</p>
            </div>
            <div class="row g-3 g-md-4">
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
            <div class="text-center mb-4 mb-md-5" data-aos="fade-up">
                <span class="section-label">Hubungi Kami</span>
                <h2 class="section-title">Siap Melayani <span class="gradient-text">Anda</span></h2>
                <p class="section-subtitle mx-auto">Hubungi kami untuk informasi lebih lanjut tentang layanan UKS</p>
            </div>

            <div class="row g-3 g-md-4">
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="0">
                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <h5 class="fw-bold mb-3">Alamat Kami</h5>
                        <p style="color: var(--slate); line-height: 1.7; margin-bottom: 0; font-size: 0.95rem;">
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
                        <p style="color: var(--slate); line-height: 1.8; margin-bottom: 0; font-size: 0.95rem;">
                            <i class="fab fa-instagram me-2 text-danger"></i>
                            <a href="https://instagram.com/pmrwira_eskasaba" target="_blank" style="color: var(--ink); text-decoration: none; font-weight: 600;">@pmrwira_eskasaba</a><br>
                            <i class="fab fa-youtube me-2 text-danger"></i>
                            <a href="https://youtube.com/@wirasandyaadhimukti3463" target="_blank" style="color: var(--ink); text-decoration: none; font-weight: 600;">@wirasandyaadhimukti3463</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row g-4 g-lg-5">
                <div class="col-lg-4">
                    <div class="footer-logo">
                        <span>SIKES</span>
                    </div>
                    <p style="color: rgba(255,255,255,0.7); line-height: 1.7; margin-bottom: 20px; font-size: 0.9rem;">
                        Sistem Informasi Unit Kesehatan Sekolah modern dan terpercaya untuk meningkatkan kualitas kesehatan seluruh warga sekolah.
                    </p>
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
    <button class="scroll-top" id="scrollTop" aria-label="Scroll to top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init({ duration: 800, once: true, offset: 50 });

        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            const scrollTop = document.getElementById('scrollTop');
            if (window.scrollY > 30) navbar.classList.add('scrolled');
            else navbar.classList.remove('scrolled');
            
            if (window.scrollY > 400) scrollTop.classList.add('show');
            else scrollTop.classList.remove('show');
        });

        document.getElementById('scrollTop').addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Menutup navbar mobile secara otomatis saat link diklik
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                const navbarCollapse = document.getElementById('navbarNav');
                if (navbarCollapse.classList.contains('show')) {
                    new bootstrap.Collapse(navbarCollapse).hide();
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const sections = document.querySelectorAll("section[id]");
            const navLinks = document.querySelectorAll(".nav-link");

            window.addEventListener("scroll", () => {
                let current = "";
                sections.forEach((section) => {
                    const sectionTop = section.offsetTop;
                    if (pageYOffset >= (sectionTop - 120)) {
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