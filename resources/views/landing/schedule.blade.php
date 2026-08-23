<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Petugas UKS - SIKES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
    :root {
        /* Palet "Biru Profesional": Tegas, Profesional, Terpercaya */
        --primary: #3b82f6;
        --primary-dark: #1e3a8a;
        --secondary: #2563eb;
        --pro: #1e3a8a;
        --pro-light: #3b82f6;
        --emerald: #10b981;
        --rose: #f43f5e;
        --amber: #f59e0b;
        --ink: #0f172a;
        --slate: #475569;
        --muted: #94a3b8;
        --gradient-primary: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        --gradient-dark: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        --shadow-sm: 0 4px 20px rgba(30, 58, 138, 0.08);
        --shadow-md: 0 10px 40px rgba(30, 58, 138, 0.12);
        --shadow-lg: 0 25px 60px rgba(30, 58, 138, 0.18);
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

    .blob-bg {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.4;
        z-index: 0;
        pointer-events: none;
    }
    .blob-1 { width: 400px; height: 400px; background: #1e3a8a; top: -100px; left: -100px; animation: float1 20s ease-in-out infinite; opacity: 0.25; }
    .blob-2 { width: 350px; height: 350px; background: #3b82f6; top: 100px; right: -80px; animation: float2 25s ease-in-out infinite; opacity: 0.2; }
    @keyframes float1 { 0%,100% { transform: translate(0,0) scale(1); } 50% { transform: translate(60px,-40px) scale(1.1); } }
    @keyframes float2 { 0%,100% { transform: translate(0,0) scale(1); } 50% { transform: translate(-50px,50px) scale(0.9); } }

    /* ============ NAVBAR ============ */
    .navbar {
        background: rgba(255,255,255,0.9);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        box-shadow: 0 4px 30px rgba(30, 58, 138, 0.06);
        border-bottom: 1px solid rgba(30, 58, 138, 0.08);
        padding: 12px 0;
        transition: all 0.4s ease;
    }
    .navbar.scrolled { padding: 8px 0; box-shadow: 0 8px 40px rgba(30, 58, 138, 0.1); }
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
        color: var(--primary-dark) !important;
        background: linear-gradient(135deg, rgba(30,58,138,0.08), rgba(59,130,246,0.08));
        transform: translateY(-1px);
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
    .user-btn:hover { transform: translateY(-2px) rotate(5deg); box-shadow: 0 10px 28px rgba(30,58,138,0.4); }

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
        background: linear-gradient(135deg, rgba(30,58,138,0.08), rgba(59,130,246,0.08));
        transform: translateX(4px);
    }

    /* ============ PAGE HEADER ============ */
    .page-header {
        position: relative;
        padding: 80px 0 70px;
        background: linear-gradient(180deg, #f7fafc 0%, #edf2fa 100%);
        overflow: hidden;
    }
    .page-header-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 18px;
        background: rgba(59,130,246,0.1);
        color: var(--pro);
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 18px;
        border: 1px solid rgba(30,58,138,0.15);
    }
    .page-header-badge .pulse-dot {
        width: 8px; height: 8px;
        background: var(--emerald);
        border-radius: 50%;
        animation: pulse 2s infinite;
    }
    @keyframes pulse { 0%,100% { opacity: 1; transform: scale(1); } 50% { opacity: 0.6; transform: scale(1.4); } }

    .page-title {
        font-family: 'Poppins', sans-serif;
        font-size: clamp(2rem, 4.5vw, 3rem);
        font-weight: 700;
        color: var(--ink);
        line-height: 1.2;
        margin-bottom: 14px;
        letter-spacing: -1px;
    }
    .gradient-text {
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .page-subtitle {
        color: var(--slate);
        font-size: 1.05rem;
        max-width: 580px;
        margin-bottom: 0;
    }

    .header-icon-wrap {
        width: 120px; height: 120px;
        background: var(--gradient-primary);
        border-radius: 30px;
        display: flex; align-items: center; justify-content: center;
        color: white;
        font-size: 3rem;
        box-shadow: 0 20px 50px rgba(30,58,138,0.3);
        margin-left: auto;
        animation: iconFloat 5s ease-in-out infinite;
        position: relative;
    }
    .header-icon-wrap::before {
        content: '';
        position: absolute;
        inset: -10px;
        border-radius: 34px;
        background: var(--gradient-primary);
        opacity: 0.2;
        z-index: -1;
    }
    @keyframes iconFloat {
        0%,100% { transform: translateY(0) rotate(0); }
        50% { transform: translateY(-10px) rotate(3deg); }
    }

    /* ============ SECTION ============ */
    .section { padding: 70px 0 90px; }
    .section-label {
        display: inline-block;
        padding: 6px 16px;
        background: rgba(59,130,246,0.1);
        color: var(--pro);
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 12px;
    }
    .section-title {
        font-family: 'Poppins', sans-serif;
        font-size: clamp(1.6rem, 3.5vw, 2.2rem);
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 12px;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }
    .section-subtitle {
        color: var(--slate);
        font-size: 1rem;
        max-width: 550px;
    }

    /* ============ SIMPLE SCHEDULE CARD ============ */
    .schedule-card {
        background: white;
        border-radius: var(--radius);
        padding: 22px;
        box-shadow: 0 4px 20px rgba(30,58,138,0.06);
        transition: all 0.3s ease;
        height: 100%;
        border: 1px solid rgba(30,58,138,0.08);
        display: flex;
        align-items: center;
        gap: 18px;
    }
    .schedule-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
        border-color: rgba(30,58,138,0.15);
    }

    .schedule-num {
        width: 56px; height: 56px;
        background: linear-gradient(135deg, #f6f9fc, #edf2fa);
        border: 2px solid rgba(30,58,138,0.15);
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-family: 'Poppins', sans-serif;
        font-weight: 800;
        font-size: 1.4rem;
        color: var(--pro);
        flex-shrink: 0;
    }

    .schedule-info {
        flex: 1;
        min-width: 0;
    }
    .schedule-info h5 {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 4px;
        font-size: 1.05rem;
        line-height: 1.3;
    }
    .schedule-meta {
        display: flex;
        align-items: center;
        gap: 12px;
        color: var(--slate);
        font-size: 0.82rem;
        font-weight: 500;
    }
    .schedule-meta span {
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .schedule-meta i {
        color: var(--pro);
        font-size: 0.75rem;
    }
    .meta-divider {
        width: 3px; height: 3px;
        background: #cbd5e1;
        border-radius: 50%;
    }

    .btn-view {
        background: var(--gradient-primary);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 10px 16px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 4px 12px rgba(30,58,138,0.25);
        flex-shrink: 0;
    }
    .btn-view:hover {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(30,58,138,0.4);
        filter: brightness(1.08);
    }

    /* ============ SIMPLE MODAL ============ */
    .modal-content {
        border: none;
        border-radius: var(--radius);
        box-shadow: 0 30px 80px rgba(15,23,42,0.2);
        overflow: hidden;
    }
    .modal-header-simple {
        background: white;
        padding: 20px 24px;
        border-bottom: 1px solid #f1f5f9;
    }
    .modal-title-simple {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        color: var(--ink);
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .modal-title-simple .title-icon {
        width: 36px; height: 36px;
        background: var(--gradient-primary);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        color: white;
        font-size: 0.95rem;
    }
    .modal-title-simple small {
        color: var(--muted);
        font-weight: 500;
        font-size: 0.78rem;
        display: block;
        margin-top: 2px;
    }
    .btn-close-simple {
        background: #f1f5f9;
        border: none;
        width: 36px; height: 36px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        color: var(--slate);
        transition: all 0.2s;
    }
    .btn-close-simple:hover {
        background: #fee2e2;
        color: var(--rose);
    }

    .modal-body { padding: 0; }
    .members-list {
        max-height: 500px;
        overflow-y: auto;
    }
    .member-row {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 24px;
        border-bottom: 1px solid #f8fafc;
        transition: background 0.2s;
    }
    .member-row:last-child { border-bottom: none; }
    .member-row:hover { background: #fafbfc; }

    .member-num {
        width: 32px; height: 32px;
        background: #f1f5f9;
        color: var(--slate);
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-weight: 700;
        font-size: 0.8rem;
        flex-shrink: 0;
        font-family: 'Poppins', sans-serif;
    }
    .member-row.has-phone .member-num {
        background: var(--gradient-primary);
        color: white;
    }
    .member-name {
        flex: 1;
        font-weight: 600;
        color: var(--ink);
        font-size: 0.95rem;
        min-width: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .member-name .phone-label {
        display: block;
        color: var(--muted);
        font-size: 0.78rem;
        font-weight: 500;
        margin-top: 2px;
    }
    .wa-btn {
        background: #d1fae5;
        color: #047857;
        border: none;
        border-radius: 8px;
        padding: 7px 12px;
        font-size: 0.8rem;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.2s;
        flex-shrink: 0;
    }
    .wa-btn:hover {
        background: #10b981;
        color: white;
        transform: translateY(-1px);
    }

    .modal-note {
        padding: 14px 24px;
        background: linear-gradient(135deg, #fef3c7, #fed7aa);
        border-top: none;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-size: 0.82rem;
        color: #92400e;
    }
    .modal-note i {
        color: var(--amber);
        margin-top: 2px;
        flex-shrink: 0;
    }
    .modal-note strong { color: var(--rose); }

    /* ============ EMPTY STATE ============ */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: white;
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
    }
    .empty-icon-wrap {
        width: 100px; height: 100px;
        background: linear-gradient(135deg, #f6f9fc, #edf2fa);
        border-radius: 26px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        position: relative;
    }
    .empty-icon-wrap i {
        font-size: 2.8rem;
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .empty-state h5 {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 8px;
    }
    .empty-state p {
        color: var(--slate);
        max-width: 400px;
        margin: 0 auto;
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
        box-shadow: 0 10px 30px rgba(30,58,138,0.35);
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transform: translateY(20px);
        transition: all 0.3s;
        z-index: 999;
    }
    .scroll-top.show { opacity: 1; visibility: visible; transform: translateY(0); }
    .scroll-top:hover { transform: translateY(-4px); box-shadow: 0 15px 40px rgba(59,130,246,0.5); }

    /* ============ RESPONSIVE ============ */
    @media (max-width: 768px) {
        .page-header { padding: 60px 0; }
        .header-icon-wrap {
            width: 90px; height: 90px;
            font-size: 2.3rem;
            margin: 20px auto 0;
        }
        .navbar-brand img { max-height: 45px; }
        .schedule-card { padding: 18px; flex-wrap: wrap; }
        .schedule-num { width: 48px; height: 48px; font-size: 1.2rem; }
        .btn-view { width: 100%; justify-content: center; margin-top: 8px; }
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
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('landing') && !request()->is('*#*') ? 'active' : '' }}" href="{{ route('landing') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link anchor-link" href="{{ route('landing') }}#tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link anchor-link" href="{{ route('landing') }}#layanan">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link anchor-link" href="{{ route('landing') }}#kontak">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('landing.medicines*') ? 'active' : '' }}" href="{{ route('landing.medicines') }}">Obat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('landing.schedule*') ? 'active' : '' }}" href="{{ route('landing.schedule') }}">Jadwal</a>
                    </li>

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

    <!-- Page Header -->
    <section class="page-header">
        <div class="blob-bg blob-1"></div>
        <div class="blob-bg blob-2"></div>
        <div class="container position-relative" style="z-index: 2;">
            <div class="row align-items-center g-4">
                <div class="col-lg-8" data-aos="fade-right">
                    <div class="page-header-badge">
                        <span class="pulse-dot"></span>
                        <span>Jadwal Petugas UKS Aktif</span>
                    </div>
                    <h1 class="page-title">
                        Jadwal <span class="gradient-text">Petugas</span><br>
                        UKS SMK Negeri 1 Bangsri
                    </h1>
                    <p class="page-subtitle">Informasi lengkap jadwal petugas yang bertugas di Unit Kesehatan Sekolah.</p>
                </div>
                <div class="col-lg-4 text-lg-end" data-aos="fade-left" data-aos-delay="200">
                    <div class="header-icon-wrap">
                        <i class="fas fa-user-nurse"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Schedule Section -->
    <section class="section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-label">Grup Piket</span>
                <h2 class="section-title">Daftar <span class="gradient-text">Petugas</span> Piket</h2>
                <p class="section-subtitle mx-auto">Pilih grup untuk melihat daftar anggota piket</p>
            </div>

            <div class="row g-3">
                @forelse($schedules as $schedule)
                    @php
                        // ✅ PERBAIKAN: Cek apakah members sudah berupa array, jika belum (masih string JSON), baru di-decode
                        $members = is_string($schedule->members) ? json_decode($schedule->members, true) : ($schedule->members ?? []);
                        $members = is_array($members) ? $members : [];
                        
                        $membersCount = count($members);
                        $emergencyCount = 0;
                        foreach($members as $m) {
                            if (is_array($m) && !empty($m['phone'])) $emergencyCount++;
                        }
                    @endphp
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 60 }}">
                        <div class="schedule-card">
                            <div class="schedule-num">{{ $loop->iteration }}</div>
                            <div class="schedule-info">
                                <h5>{{ $schedule->group_name ?? 'Grup ' . $loop->iteration }}</h5>
                                <div class="schedule-meta">
                                    <span><i class="fas fa-users"></i> {{ $membersCount }} anggota</span>
                                    <span class="meta-divider"></span>
                                    <span>
                                        <i class="fas fa-phone"></i>
                                        {{ $emergencyCount }} kontak
                                    </span>
                                </div>
                            </div>
                            <button class="btn btn-view"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalAnggota{{ $schedule->id }}">
                                Lihat <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Simple Modal -->
                    <div class="modal fade" id="modalAnggota{{ $schedule->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header-simple">
                                    <div class="modal-title-simple">
                                        <div class="title-icon"><i class="fas fa-users"></i></div>
                                        <div>
                                            {{ $schedule->group_name ?? 'Grup' }}
                                            <small>{{ $membersCount }} anggota piket</small>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close-simple" data-bs-dismiss="modal">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="members-list">
                                        @if($membersCount > 0)
                                            @foreach($members as $idx => $member)
                                                @php
                                                    $name = $member['name'] ?? '-';
                                                    $phone = $member['phone'] ?? '';
                                                @endphp
                                                <div class="member-row {{ !empty($phone) ? 'has-phone' : '' }}">
                                                    <div class="member-num">{{ $idx + 1 }}</div>
                                                    <div class="member-name">
                                                        {{ $name }}
                                                        @if(!empty($phone))
                                                            <span class="phone-label">Kontak darurat</span>
                                                        @endif
                                                    </div>
                                                    @if(!empty($phone))
                                                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $phone) }}"
                                                           target="_blank"
                                                           class="wa-btn">
                                                            <i class="fab fa-whatsapp"></i> Chat
                                                        </a>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="text-center py-5">
                                                <i class="fas fa-user-slash text-muted" style="font-size: 2rem;"></i>
                                                <p class="text-muted mt-2 mb-0">Data anggota belum tersedia</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="modal-note">
                                    <i class="fas fa-info-circle"></i>
                                    <div>
                                        Anggota dengan <strong>kontak darurat</strong> dapat dihubungi via WhatsApp jika membutuhkan bantuan di luar jam operasional.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state" data-aos="fade-up">
                            <div class="empty-icon-wrap">
                                <i class="fas fa-calendar-times"></i>
                            </div>
                            <h5>Belum Ada Jadwal</h5>
                            <p>Jadwal petugas belum tersedia. Silakan hubungi admin UKS.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <button class="scroll-top" id="scrollTop">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init({ duration: 700, once: true, offset: 60 });

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

        document.querySelectorAll('.anchor-link').forEach(link => {
            link.addEventListener('click', function() {
                document.querySelectorAll('.navbar-nav .nav-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>