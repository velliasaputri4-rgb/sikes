<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Obat - SIKES</title>
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/logo sikes navbar.png')); ?>">
    <link rel="apple-touch-icon" href="<?php echo e(asset('images/logo sikes navbar.png')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
    :root {
        /* ✅ TEMA MERAH (PMR/UKS) */
        --primary: #ef4444;
        --primary-dark: #991b1b;
        --secondary: #dc2626;
        --accent: #f43f5e;
        --emerald: #10b981;
        --rose: #f43f5e;
        --amber: #f59e0b;
        --ink: #0f172a;
        --slate: #475569;
        --light: #f8fafc;
        --pro: #991b1b;
        --pro-light: #ef4444;
        --gradient-primary: linear-gradient(135deg, #991b1b 0%, #ef4444 100%);
        --gradient-accent: linear-gradient(135deg, #f43f5e 0%, #ef4444 100%);
        --gradient-warm: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);
        --gradient-dark: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        --shadow-sm: 0 4px 20px rgba(153, 27, 27, 0.08);
        --shadow-md: 0 10px 40px rgba(153, 27, 27, 0.12);
        --shadow-lg: 0 25px 60px rgba(153, 27, 27, 0.18);
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

    /* ===== NAVBAR ===== */
    .navbar {
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        box-shadow: 0 4px 30px rgba(153, 27, 27, 0.06);
        border-bottom: 1px solid rgba(153, 27, 27, 0.08);
        padding: 12px 0;
        transition: all 0.4s ease;
    }
    .navbar.scrolled { padding: 8px 0; box-shadow: 0 8px 40px rgba(153, 27, 27, 0.1); }
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
        background: linear-gradient(135deg, rgba(153, 27, 27, 0.08), rgba(239, 68, 68, 0.08));
        transform: translateY(-1px);
    }
    .nav-link.active {
        color: white !important;
        background: var(--gradient-primary);
        box-shadow: 0 6px 20px rgba(153, 27, 27, 0.25);
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
        box-shadow: 0 6px 20px rgba(153, 27, 27, 0.3);
        transition: all 0.3s;
    }
    .user-btn:hover { transform: translateY(-2px) rotate(5deg); box-shadow: 0 10px 28px rgba(153, 27, 27, 0.4); }

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
        background: linear-gradient(135deg, rgba(153, 27, 27, 0.08), rgba(239, 68, 68, 0.08));
        transform: translateX(4px);
    }

    /* ============ PAGE HEADER (DIPERBAIKI: Background Foto + Overlay Gelap Netral) ============ */
    .page-header {
        position: relative;
        padding: 160px 0 100px;
        text-align: center;
        overflow: hidden;
        background-color: #0f172a; /* Fallback */
    }
    .page-header-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 18px;
        background: rgba(255, 255, 255, 0.15);
        color: #ffffff;
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 20px;
        backdrop-filter: blur(4px);
    }
    .page-title {
        font-family: 'Poppins', sans-serif;
        font-size: clamp(2rem, 4.5vw, 3.2rem);
        font-weight: 700;
        color: #ffffff;
        line-height: 1.2;
        margin-bottom: 16px;
        letter-spacing: -1px;
        text-shadow: 0 4px 20px rgba(0,0,0,0.3);
    }
    .page-title .gradient-text {
        background: linear-gradient(135deg, #ffffff 0%, #fca5a5 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .page-subtitle {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
        text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }

    /* ============ SECTION ============ */
    .section { padding: 60px 0 90px; }
    .section-label {
        display: inline-block;
        padding: 6px 16px;
        background: rgba(239, 68, 68, 0.1);
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
        box-shadow: 0 4px 20px rgba(153, 27, 27, 0.06);
        margin-bottom: 40px;
        border: 1px solid rgba(153, 27, 27, 0.08);
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
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.12);
    }

    /* ============ MEDICINE CARDS ============ */
    .medicine-card {
        background: white;
        border-radius: var(--radius);
        padding: 24px;
        box-shadow: 0 2px 15px rgba(153, 27, 27, 0.04);
        transition: all 0.3s ease;
        height: 100%;
        border: 1px solid rgba(153, 27, 27, 0.08);
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    .medicine-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
        border-color: rgba(239, 68, 68, 0.2);
    }

    .medicine-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
    }

    .medicine-name {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        font-size: 1.1rem;
        color: var(--ink);
        line-height: 1.3;
        margin: 0;
    }

    .stock-badge {
        padding: 5px 10px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        flex-shrink: 0;
    }
    .stock-badge.available { background: #dcfce7; color: #15803d; }
    .stock-badge.low { background: #fef9c3; color: #a16207; }
    .stock-badge.out { background: #fee2e2; color: #b91c1c; }
    
    .stock-badge .pulse-dot {
        width: 6px; height: 6px;
        border-radius: 50%;
        background: currentColor;
        animation: pulse 2s infinite;
    }
    @keyframes pulse { 0%,100% { opacity: 1; transform: scale(1); } 50% { opacity: 0.5; transform: scale(1.3); } }

    .medicine-indication {
        font-size: 0.85rem;
        color: var(--slate);
        line-height: 1.5;
        background: #f8fafc;
        padding: 12px;
        border-radius: 10px;
        border: 1px solid #f1f5f9;
        display: flex;
        gap: 10px;
        align-items: flex-start;
    }
    .medicine-indication i {
        color: var(--primary);
        margin-top: 3px;
        flex-shrink: 0;
    }

    .medicine-details {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        background: #fafbfc;
        padding: 16px;
        border-radius: 12px;
        border: 1px solid #f1f5f9;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .detail-item.full-width {
        grid-column: 1 / -1;
    }

    .detail-label {
        font-size: 0.75rem;
        color: var(--slate);
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .detail-label i { color: var(--primary); font-size: 0.8rem; }

    .detail-value {
        font-weight: 700;
        color: var(--ink);
        font-size: 1rem;
    }
    .detail-value small {
        font-weight: 500;
        font-size: 0.85em;
        color: var(--slate);
    }

    .detail-value.text-expired { color: var(--rose); }
    .detail-value.text-warning { color: var(--amber); }
    .detail-value.text-success { color: var(--emerald); }

    .stock-bar {
        margin-top: auto;
        padding-top: 16px;
        border-top: 1px dashed #e2e8f0;
    }
    .stock-bar-label {
        display: flex;
        justify-content: space-between;
        font-size: 0.75rem;
        color: var(--slate);
        margin-bottom: 6px;
        font-weight: 600;
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
        background: linear-gradient(135deg, #fef2f2, #fee2e2);
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
        background: rgba(239, 68, 68, 0.1);
        color: var(--pro);
        transform: translateY(-2px);
    }
    .pagination .page-item.active .page-link {
        background: var(--gradient-primary);
        color: white;
        box-shadow: 0 6px 20px rgba(153, 27, 27, 0.3);
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
        box-shadow: 0 10px 30px rgba(153, 27, 27, 0.35);
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transform: translateY(20px);
        transition: all 0.3s;
        z-index: 999;
    }
    .scroll-top.show { opacity: 1; visibility: visible; transform: translateY(0); }
    .scroll-top:hover { transform: translateY(-4px); box-shadow: 0 15px 40px rgba(239, 68, 68, 0.5); }

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
            radial-gradient(circle at 10% 20%, rgba(153, 27, 27, 0.25) 0%, transparent 40%),
            radial-gradient(circle at 90% 80%, rgba(239, 68, 68, 0.15) 0%, transparent 40%);
    }
    footer .container { position: relative; z-index: 1; }
    .footer-logo {
        display: inline-flex; align-items: center; gap: 12px;
        margin-bottom: 20px;
        font-family: 'Poppins', sans-serif;
        font-weight: 700; font-size: 1.4rem;
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
    .footer-menu a:hover { color: #fca5a5; transform: translateX(6px); }
    .footer-bottom {
        border-top: 1px solid rgba(255,255,255,0.1);
        margin-top: 50px;
        padding-top: 25px;
        text-align: center;
        color: rgba(255,255,255,0.5);
        font-size: 0.9rem;
    }

    /* ============ RESPONSIVE ============ */
    @media (max-width: 768px) {
        .page-header { padding: 120px 0 60px; }
        .section { padding: 60px 0; }
    }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(route('landing')); ?>">
                <img src="<?php echo e(asset('images/logo sikes navbar.png')); ?>" alt="Logo SIKES">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-1">
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('landing')); ?>">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('landing.about')); ?>">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('landing.services')); ?>">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('landing.docs')); ?>">Dokumentasi</a></li>
                   
                    <li class="nav-item ms-lg-3">
                        <div class="dropdown">
                            <button class="btn user-btn" type="button" data-bs-toggle="dropdown">
                                <i class="fas <?php echo e(auth()->check() ? 'fa-user-check' : 'fa-user'); ?>"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                                    <li class="dropdown-header text-center pb-2">
                                        <small class="text-muted d-block">Halo,</small>
                                        <strong class="text-dark"><?php echo e(auth()->user()->name ?? 'User'); ?></strong>
                                        <span class="badge mt-1" style="background: var(--primary); color: white;"><?php echo e(auth()->user()->getRoleNames()->first() ?? 'User'); ?></span>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo e(route('dashboard')); ?>">
                                            <i class="fas fa-tachometer-alt me-2" style="color: var(--primary);"></i> Dashboard
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                                            </button>
                                        </form>
                                    </li>
                                <?php else: ?>
                                    <li class="dropdown-header text-center">
                                        <small class="text-muted">Pilih Login</small>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item fw-semibold" href="<?php echo e(route('login')); ?>">
                                            <i class="fas fa-user-shield me-2" style="color: var(--primary);"></i> Admin
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo e(route('login.siswa')); ?>">
                                            <i class="fas fa-user-graduate me-2" style="color: var(--primary);"></i> Login Siswa
                                        </a>
                                    </li>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php
        // ✅ Fallback gambar background header (sama seperti halaman lain agar konsisten)
        $medicinesBgImage = asset('images/login.jpeg');
    ?>

    <!-- ✅ Page Header dengan Background Foto & Overlay Gelap Netral (TANPA MERAH) -->
    <section class="page-header text-center" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.85) 0%, rgba(15, 23, 42, 0.95) 100%), url('<?php echo e($medicinesBgImage); ?>'); background-size: cover; background-position: center; background-attachment: fixed;">
        <div class="container position-relative" style="z-index: 2;" data-aos="fade-up">
            <div class="page-header-badge">
                <i class="fas fa-database"></i>
                <span>Stok & Informasi UKS</span>
            </div>
            <h1 class="page-title">
                Informasi <span class="gradient-text">Obat</span>
            </h1>
            <p class="page-subtitle">
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
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $medicines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $med): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <?php
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
                                $expiredText = '(Kedaluwarsa)';
                            } elseif ($expDate->diffInDays(now()) <= 90) {
                                $expiredStatus = 'text-warning';
                                $expiredText = '(Segera)';
                            } else {
                                $expiredStatus = 'text-success';
                            }
                        }

                        // ✅ Ambil keterangan kegunaan dari berbagai kemungkinan nama kolom
                        $indication = $med->indication ?? $med->description ?? $med->kegunaan ?? 'Digunakan untuk pertolongan pertama dan pengobatan umum sesuai petunjuk petugas.';
                    ?>
                    <div class="col-md-6 col-lg-4 medicine-item"
                         data-aos="fade-up"
                         data-aos-delay="<?php echo e($loop->index * 50); ?>"
                         data-name="<?php echo e(strtolower($med->name)); ?>">
                        
                        <div class="medicine-card">
                            <div class="medicine-header">
                                <h3 class="medicine-name"><?php echo e($med->name); ?></h3>
                                <span class="stock-badge <?php echo e($statusClass); ?>">
                                    <span class="pulse-dot"></span>
                                    <?php echo e($statusText); ?>

                                </span>
                            </div>

                            <!-- ✅ Bagian Keterangan Kegunaan Obat -->
                            <div class="medicine-indication">
                                <i class="fas fa-info-circle"></i>
                                <span><?php echo e($indication); ?></span>
                            </div>

                            <div class="medicine-details">
                                <div class="detail-item">
                                    <span class="detail-label"><i class="fas fa-boxes"></i> Stok</span>
                                    <span class="detail-value <?php echo e($med->stock == 0 ? 'text-expired' : ($med->stock <= $minStock ? 'text-warning' : '')); ?>">
                                        <?php echo e($med->stock); ?> <small><?php echo e($med->unit); ?></small>
                                    </span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label"><i class="fas fa-cube"></i> Satuan</span>
                                    <span class="detail-value"><?php echo e($med->unit); ?></span>
                                </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($med->expired_date): ?>
                                <div class="detail-item full-width">
                                    <span class="detail-label"><i class="fas fa-calendar-alt"></i> Kedaluwarsa</span>
                                    <span class="detail-value <?php echo e($expiredStatus); ?>">
                                        <?php echo e(\Carbon\Carbon::parse($med->expired_date)->format('d M Y')); ?>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($expiredText): ?> <small style="color: inherit; font-weight: 600;"><?php echo e($expiredText); ?></small> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </span>
                                </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            <div class="stock-bar">
                                <div class="stock-bar-label">
                                    <span>Kapasitas Stok</span>
                                    <span><?php echo e(round($stockPercent)); ?>%</span>
                                </div>
                                <div class="stock-bar-track">
                                    <div class="stock-bar-fill <?php echo e($barClass); ?>" style="width: <?php echo e($stockPercent); ?>%"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <div class="col-12">
                        <div class="empty-state" data-aos="fade-up">
                            <div class="empty-icon-wrap">
                                <i class="fas fa-box-open"></i>
                            </div>
                            <h5>Belum Ada Data Obat</h5>
                            <p>Data obat akan segera ditambahkan oleh petugas UKS. Silakan cek kembali nanti.</p>
                        </div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($medicines) && method_exists($medicines, 'hasPages') && $medicines->hasPages()): ?>
                <div class="d-flex justify-content-center mt-5" data-aos="fade-up">
                    <nav>
                        <?php echo e($medicines->links()); ?>

                    </nav>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="footer-logo">
                        <span>SIKES</span>
                    </div>
                    <p style="color: rgba(255,255,255,0.7); line-height: 1.8; margin-bottom: 24px;">
                        <?php echo e(\App\Models\Setting::get('footer_desc', 'Sistem Informasi Unit Kesehatan Sekolah modern dan terpercaya untuk meningkatkan kualitas kesehatan seluruh warga sekolah.')); ?>

                    </p>
                </div>
                <div class="col-6 col-lg-2">
                    <h6>Navigasi</h6>
                    <ul class="footer-menu">
                        <li><a href="<?php echo e(route('landing')); ?>"><i class="fas fa-chevron-right fa-xs"></i> Beranda</a></li>
                        <li><a href="<?php echo e(route('landing.about')); ?>"><i class="fas fa-chevron-right fa-xs"></i> Tentang</a></li>
                        <li><a href="<?php echo e(route('landing.services')); ?>"><i class="fas fa-chevron-right fa-xs"></i> Layanan</a></li>
                        <li><a href="<?php echo e(route('landing.docs')); ?>"><i class="fas fa-chevron-right fa-xs"></i> Dokumentasi</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-3">
                    <h6>Layanan</h6>
                    <ul class="footer-menu">
                        <li><a href="<?php echo e(route('landing.medicines')); ?>"><i class="fas fa-chevron-right fa-xs"></i> Informasi Obat</a></li>
                        <li><a href="<?php echo e(route('landing.health-info')); ?>"><i class="fas fa-chevron-right fa-xs"></i> Informasi Kesehatan</a></li>
                        <li><a href="<?php echo e(route('landing.schedule')); ?>"><i class="fas fa-chevron-right fa-xs"></i> Jadwal Petugas</a></li>
                        <li><a href="<?php echo e(auth()->check() && auth()->user()->hasRole('siswa') ? route('siswa.history') : route('login.siswa')); ?>"><i class="fas fa-chevron-right fa-xs"></i> Riwayat</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h6>Kontak</h6>
                    <ul class="footer-menu">
                        <li><a href="#"><i class="fas fa-map-marker-alt"></i> Jl. KH. Achmad Fauzan No.17, Bangsri</a></li>
                        <li>
                            <a href="<?php echo e(\App\Models\Setting::get('contact_ig_link', '#')); ?>" target="_blank">
                                <i class="fab fa-instagram"></i> <?php echo e('@' . \App\Models\Setting::get('contact_ig_handle', 'pmrwira_eskasaba')); ?>

                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(\App\Models\Setting::get('contact_yt_link', '#')); ?>" target="_blank">
                                <i class="fab fa-youtube"></i> <?php echo e('@' . \App\Models\Setting::get('contact_yt_handle', 'wirasandyaadhimukti3463')); ?>

                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="mb-0"><?php echo \App\Models\Setting::get('footer_copyright', '&copy; ' . date('Y') . ' <strong>SIKES</strong> - Sistem Informasi UKS SMK Negeri 1 Bangsri. All rights reserved.'); ?></p>
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
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({ duration: 700, once: true, offset: 60 });

            // Navbar scroll effect
            window.addEventListener('scroll', function() {
                const navbar = document.querySelector('.navbar');
                const scrollTop = document.getElementById('scrollTop');
                
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
                
                if (window.scrollY > 300) {
                    scrollTop.classList.add('show');
                } else {
                    scrollTop.classList.remove('show');
                }
            }, { passive: true });

            document.getElementById('scrollTop').addEventListener('click', function() {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            // Search functionality
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
        });
    </script>
</body>
</html><?php /**PATH C:\laragon\www\sikes\resources\views/landing/medicines.blade.php ENDPATH**/ ?>