<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Obat - SIKES</title>
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
        --accent: #8b5cf6;
        --emerald: #10b981;
        --rose: #f43f5e;
        --amber: #f59e0b;
        --ink: #0f172a;
        --slate: #475569;
        --light: #f8fafc;
        --pro: #1e3a8a;
        --pro-light: #3b82f6;
        --gradient-primary: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        --gradient-accent: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
        --gradient-warm: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);
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

    /* ============ ANIMATED BLOBS ============ */
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
        padding: 90px 0 70px;
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
        margin-bottom: 20px;
        border: 1px solid rgba(30,58,138,0.15);
    }
    .page-title {
        font-family: 'Poppins', sans-serif;
        font-size: clamp(2rem, 4.5vw, 3.2rem);
        font-weight: 700;
        color: var(--ink);
        line-height: 1.2;
        margin-bottom: 16px;
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
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
    }
    .header-icon-wrap {
        width: 120px; height: 120px;
        background: var(--gradient-primary);
        border-radius: 30px;
        display: flex; align-items: center; justify-content: center;
        color: white;
        font-size: 3rem;
        box-shadow: 0 20px 50px rgba(30,58,138,0.3);
        margin: 0 auto 20px;
        animation: iconFloat 4s ease-in-out infinite;
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
        animation: iconPulse 2.5s ease-in-out infinite;
    }
    @keyframes iconFloat { 0%,100% { transform: translateY(0) rotate(0); } 50% { transform: translateY(-10px) rotate(3deg); } }
    @keyframes iconPulse { 0%,100% { transform: scale(1); opacity: 0.2; } 50% { transform: scale(1.15); opacity: 0.1; } }

    /* ============ SECTION ============ */
    .section { padding: 60px 0 90px; }
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
        margin-bottom: 14px;
    }

    /* ============ FILTER BAR ============ */
    .filter-bar {
        background: white;
        padding: 20px;
        border-radius: var(--radius);
        box-shadow: 0 4px 20px rgba(30,58,138,0.06);
        margin-bottom: 40px;
        border: 1px solid rgba(30,58,138,0.08);
    }
    .search-input-wrap {
        position: relative;
    }
    .search-input-wrap i {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--slate);
    }
    .search-input {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px 18px 12px 48px;
        width: 100%;
        transition: all 0.3s;
        font-size: 0.95rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .search-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(59,130,246,0.12);
    }

    /* ============ MEDICINE CARDS ============ */
    .medicine-card {
        background: white;
        border-radius: var(--radius);
        padding: 0;
        box-shadow: 0 4px 20px rgba(30,58,138,0.06);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        height: 100%;
        border: 1px solid rgba(30,58,138,0.08);
        overflow: hidden;
        position: relative;
    }
    .medicine-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
        border-color: transparent;
    }
    .medicine-card-header {
        position: relative;
        padding: 30px 24px 20px;
        background: linear-gradient(135deg, #f6f9fc 0%, #edf2fa 100%);
        border-bottom: 1px dashed #d5e0ec;
    }
    .medicine-icon {
        width: 70px; height: 70px;
        background: var(--gradient-primary);
        border-radius: 18px;
        display: flex; align-items: center; justify-content: center;
        color: white;
        font-size: 1.8rem;
        box-shadow: 0 12px 30px rgba(30,58,138,0.25);
        margin-bottom: 16px;
        transition: all 0.4s;
    }
    .medicine-card:hover .medicine-icon {
        transform: scale(1.08) rotate(-6deg);
        box-shadow: 0 16px 40px rgba(30,58,138,0.35);
    }
    .stock-badge {
        position: absolute;
        top: 20px; right: 20px;
        padding: 6px 12px;
        border-radius: 50px;
        font-size: 0.72rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .stock-badge.available {
        background: #d1fae5;
        color: #047857;
    }
    .stock-badge.low {
        background: #fef3c7;
        color: #b45309;
    }
    .stock-badge.out {
        background: #fee2e2;
        color: #b91c1c;
    }
    .stock-badge .pulse-dot {
        width: 7px; height: 7px;
        border-radius: 50%;
        background: currentColor;
        animation: pulse 2s infinite;
    }
    @keyframes pulse { 0%,100% { opacity: 1; transform: scale(1); } 50% { opacity: 0.5; transform: scale(1.4); } }

    .medicine-name {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        font-size: 1.15rem;
        color: var(--ink);
        margin-bottom: 8px;
        line-height: 1.3;
    }

    .medicine-card-body {
        padding: 24px;
    }
    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .info-row:last-child { border-bottom: none; }
    .info-label {
        color: var(--slate);
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .info-label i {
        color: var(--pro);
        font-size: 0.9rem;
        width: 16px;
    }
    .info-value {
        font-weight: 700;
        color: var(--ink);
        font-size: 0.95rem;
    }
    .info-value.text-expired { color: var(--rose); }
    .info-value.text-warning { color: var(--amber); }
    .info-value.text-success { color: var(--emerald); }

    .stock-bar {
        margin-top: 14px;
        padding-top: 14px;
        border-top: 1px dashed #e2e8f0;
    }
    .stock-bar-label {
        display: flex;
        justify-content: space-between;
        font-size: 0.8rem;
        color: var(--slate);
        margin-bottom: 6px;
    }
    .stock-bar-track {
        height: 6px;
        background: #f1f5f9;
        border-radius: 50px;
        overflow: hidden;
    }
    .stock-bar-fill {
        height: 100%;
        border-radius: 50px;
        transition: width 1s ease;
    }
    .stock-bar-fill.bar-available { background: linear-gradient(90deg, #10b981, #059669); }
    .stock-bar-fill.bar-low { background: var(--gradient-warm); }
    .stock-bar-fill.bar-out { background: linear-gradient(90deg, #ef4444, #dc2626); }

    /* ============ EMPTY STATE ============ */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: white;
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
    }
    .empty-icon-wrap {
        width: 120px; height: 120px;
        background: linear-gradient(135deg, #f6f9fc, #edf2fa);
        border-radius: 30px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 24px;
        position: relative;
    }
    .empty-icon-wrap i {
        font-size: 3.5rem;
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .empty-icon-wrap::before {
        content: '';
        position: absolute;
        inset: -8px;
        border-radius: 34px;
        background: var(--gradient-primary);
        opacity: 0.15;
        z-index: -1;
    }
    .empty-state h5 {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 10px;
    }
    .empty-state p {
        color: var(--slate);
        max-width: 400px;
        margin: 0 auto;
    }

    /* ============ PAGINATION ============ */
    .pagination .page-link {
        border: none;
        color: var(--slate);
        font-weight: 600;
        padding: 10px 16px;
        margin: 0 3px;
        border-radius: 10px !important;
        transition: all 0.3s;
    }
    .pagination .page-link:hover {
        background: rgba(59,130,246,0.1);
        color: var(--pro);
        transform: translateY(-2px);
    }
    .pagination .page-item.active .page-link {
        background: var(--gradient-primary);
        color: white;
        box-shadow: 0 6px 20px rgba(30,58,138,0.3);
    }
    .pagination .page-item.disabled .page-link {
        opacity: 0.4;
        cursor: not-allowed;
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

    /* ============ NO RESULTS ============ */
    .no-results {
        display: none;
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
    }
    .no-results.show { display: block; }

    /* ============ RESPONSIVE ============ */
    @media (max-width: 768px) {
        .page-header { padding: 70px 0 60px; }
        .navbar-brand img { max-height: 45px; }
        .header-icon-wrap { width: 90px; height: 90px; font-size: 2.2rem; }
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
    <section class="page-header text-center">
        <div class="blob-bg blob-1"></div>
        <div class="blob-bg blob-2"></div>
        <div class="container position-relative" style="z-index: 2;">
            <div class="header-icon-wrap" data-aos="zoom-in">
                <i class="fas fa-capsules"></i>
            </div>
            <div class="page-header-badge" data-aos="fade-down">
                <i class="fas fa-database"></i>
                <span>Stok & Informasi UKS</span>
            </div>
            <h1 class="page-title" data-aos="fade-up" data-aos-delay="100">
                Informasi <span class="gradient-text">Obat</span>
            </h1>
            <p class="page-subtitle" data-aos="fade-up" data-aos-delay="200">
                Daftar lengkap obat-obatan dan alat kesehatan yang tersedia di UKS SMK Negeri 1 Bangsri
            </p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="section">
        <div class="container">
            <!-- Filter Bar (Search Only) -->
            <div class="filter-bar" data-aos="fade-up" data-aos-delay="100">
                <div class="search-input-wrap">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" class="search-input" placeholder="Cari nama obat...">
                </div>
            </div>

            <!-- Medicine Grid -->
            <div class="row g-4" id="medicineGrid">
                @forelse($medicines as $med)
                    @php
                        $minStock = $med->minimum_stock ?? 5;
                        $maxStock = max($minStock * 5, 50);
                        $stockPercent = min(100, ($med->stock / $maxStock) * 100);

                        if ($med->stock == 0) {
                            $statusClass = 'out';
                            $statusText = 'Habis';
                            $barClass = 'bar-out';
                        } elseif ($med->stock <= $minStock) {
                            $statusClass = 'low';
                            $statusText = 'Stok Menipis';
                            $barClass = 'bar-low';
                        } else {
                            $statusClass = 'available';
                            $statusText = 'Tersedia';
                            $barClass = 'bar-available';
                        }

                        // Expired status
                        $expiredStatus = '';
                        $expiredText = '';
                        if ($med->expired_date) {
                            $expDate = \Carbon\Carbon::parse($med->expired_date);
                            if ($expDate->isPast()) {
                                $expiredStatus = 'text-expired';
                                $expiredText = ' (Kedaluwarsa)';
                            } elseif ($expDate->diffInDays(now()) <= 90) {
                                $expiredStatus = 'text-warning';
                                $expiredText = ' (Segera)';
                            } else {
                                $expiredStatus = 'text-success';
                            }
                        }
                    @endphp
                    <div class="col-md-6 col-lg-4 medicine-item"
                         data-aos="fade-up"
                         data-aos-delay="{{ $loop->index * 50 }}"
                         data-name="{{ strtolower($med->name) }}">
                        <div class="medicine-card">
                            <div class="medicine-card-header">
                                <span class="stock-badge {{ $statusClass }}">
                                    <span class="pulse-dot"></span>
                                    {{ $statusText }}
                                </span>
                                <div class="medicine-icon">
                                    <i class="fas fa-capsules"></i>
                                </div>
                                <h3 class="medicine-name">{{ $med->name }}</h3>
                            </div>

                            <div class="medicine-card-body">
                                <div class="info-row">
                                    <span class="info-label">
                                        <i class="fas fa-cube"></i> Satuan
                                    </span>
                                    <span class="info-value">{{ $med->unit }}</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">
                                        <i class="fas fa-boxes"></i> Stok
                                    </span>
                                    <span class="info-value {{ $med->stock == 0 ? 'text-expired' : ($med->stock <= ($med->minimum_stock ?? 5) ? 'text-warning' : '') }}">
                                        {{ $med->stock }} {{ $med->unit }}
                                    </span>
                                </div>
                                @if($med->expired_date)
                                <div class="info-row">
                                    <span class="info-label">
                                        <i class="fas fa-calendar-alt"></i> Kedaluwarsa
                                    </span>
                                    <span class="info-value {{ $expiredStatus }}">
                                        {{ \Carbon\Carbon::parse($med->expired_date)->format('d M Y') }}
                                        <small>{{ $expiredText }}</small>
                                    </span>
                                </div>
                                @endif

                                <div class="stock-bar">
                                    <div class="stock-bar-label">
                                        <span>Level Stok</span>
                                        <span>{{ round($stockPercent) }}%</span>
                                    </div>
                                    <div class="stock-bar-track">
                                        <div class="stock-bar-fill {{ $barClass }}" style="width: {{ $stockPercent }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state" data-aos="fade-up">
                            <div class="empty-icon-wrap">
                                <i class="fas fa-box-open"></i>
                            </div>
                            <h5>Belum Ada Data Obat</h5>
                            <p>Data obat akan segera ditambahkan oleh petugas UKS. Silakan cek kembali nanti.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- No Results (hidden by default) -->
            <div class="no-results" id="noResults">
                <div class="empty-icon-wrap">
                    <i class="fas fa-search"></i>
                </div>
                <h5>Tidak Ditemukan</h5>
                <p>Obat yang Anda cari tidak ditemukan. Coba kata kunci lain.</p>
            </div>

            <!-- Pagination -->
            @if(isset($medicines) && method_exists($medicines, 'hasPages') && $medicines->hasPages())
                <div class="d-flex justify-content-center mt-5" data-aos="fade-up">
                    <nav>
                        {{ $medicines->links() }}
                    </nav>
                </div>
            @endif
        </div>
    </section>

    <!-- Scroll to Top -->
    <button class="scroll-top" id="scrollTop">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init({ duration: 700, once: true, offset: 60 });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            const scrollTop = document.getElementById('scrollTop');
            if (window.scrollY > 50) navbar.classList.add('scrolled');
            else navbar.classList.remove('scrolled');
            if (window.scrollY > 300) scrollTop.classList.add('show');
            else scrollTop.classList.remove('show');
        });

        // Scroll to top
        document.getElementById('scrollTop').addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Anchor link active state
        document.querySelectorAll('.anchor-link').forEach(link => {
            link.addEventListener('click', function() {
                document.querySelectorAll('.navbar-nav .nav-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Search functionality (name only)
        const searchInput = document.getElementById('searchInput');
        const medicineItems = document.querySelectorAll('.medicine-item');
        const noResults = document.getElementById('noResults');

        function filterMedicines() {
            const searchValue = searchInput.value.toLowerCase().trim();
            let visibleCount = 0;

            medicineItems.forEach(item => {
                const name = item.dataset.name || '';
                const matchSearch = !searchValue || name.includes(searchValue);

                if (matchSearch) {
                    item.style.display = '';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            if (visibleCount === 0 && medicineItems.length > 0) {
                noResults.classList.add('show');
            } else {
                noResults.classList.remove('show');
            }
        }

        if (searchInput) searchInput.addEventListener('input', filterMedicines);
    </script>
</body>
</html>