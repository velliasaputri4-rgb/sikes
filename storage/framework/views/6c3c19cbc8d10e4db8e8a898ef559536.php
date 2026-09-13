<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Petugas UKS - SIKES</title>
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/logo sikes navbar.png')); ?>">
    <link rel="apple-touch-icon" href="<?php echo e(asset('images/logo sikes navbar.png')); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
    :root {
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

    /* ===== NAVBAR (SAMA PERSIS DENGAN LANDING PAGE) ===== */
    .navbar {
        background: rgba(255,255,255,0.95);
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

    .page-header {
        position: relative;
        padding: 140px 0 80px;
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
        margin-bottom: 0;
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

    /* Modal Styles */
    .modal-content {
        border: none;
        border-radius: var(--radius);
        box-shadow: 0 30px 80px rgba(15,23,42,0.2);
        overflow: hidden;
        max-height: 85vh;
        display: flex;
        flex-direction: column;
    }
    
    .modal-header-simple {
        background: white;
        padding: 20px 24px;
        border-bottom: 1px solid #f1f5f9;
        flex-shrink: 0;
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

    .modal-body { 
        padding: 0; 
        overflow: hidden;
        flex: 1;
    }
    
    .members-list {
        max-height: calc(85vh - 140px);
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
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
        border-top: 1px solid #f1f5f9;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-size: 0.82rem;
        color: #92400e;
        flex-shrink: 0;
    }
    .modal-note i {
        color: var(--amber);
        margin-top: 2px;
        flex-shrink: 0;
    }
    .modal-note strong { color: var(--rose); }

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

    /* ===== FOOTER ===== */
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
            radial-gradient(circle at 10% 20%, rgba(30,58,138,0.25) 0%, transparent 40%),
            radial-gradient(circle at 90% 80%, rgba(59,130,246,0.15) 0%, transparent 40%);
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
    .footer-menu a:hover { color: #93c5fd; transform: translateX(6px); }
    .footer-bottom {
        border-top: 1px solid rgba(255,255,255,0.1);
        margin-top: 50px;
        padding-top: 25px;
        text-align: center;
        color: rgba(255,255,255,0.5);
        font-size: 0.9rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-header { padding: 120px 0 60px; }
        .section { padding: 60px 0; }
        
        .schedule-card { padding: 18px; flex-wrap: wrap; }
        .schedule-num { width: 48px; height: 48px; font-size: 1.2rem; }
        .btn-view { width: 100%; justify-content: center; margin-top: 8px; }

        /* PERBAIKAN MODAL MOBILE: LENGKUNG DI SEMUA SISI */
        .modal-dialog {
            margin-bottom: 16px;
        }
        .modal-content {
            max-height: 90vh;
            border-radius: 24px !important;
        }
        .members-list {
            max-height: calc(90vh - 150px);
        }
        .member-row {
            padding: 12px 16px;
        }
        .modal-note {
            padding: 12px 16px;
            font-size: 0.75rem;
            border-radius: 0 0 24px 24px;
        }
        .modal-header-simple {
            padding: 16px 20px;
        }
    }
    
    @media (max-width: 576px) {
        .schedule-card { padding: 16px; }
        .schedule-info h5 { font-size: 0.95rem; }
        .schedule-meta { font-size: 0.75rem; flex-wrap: wrap; }
        
        .modal-content { 
            border-radius: 20px !important;
        }
        .members-list { max-height: calc(90vh - 140px); }
        .modal-note { border-radius: 0 0 20px 20px; }
    }
    </style>
</head>
<body>

    <!-- Navbar (SAMA PERSIS DENGAN LANDING PAGE) -->
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
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('landing')); ?>#layanan">Layanan</a></li>
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
                                        <span class="badge bg-primary mt-1"><?php echo e(auth()->user()->getRoleNames()->first() ?? 'User'); ?></span>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo e(route('dashboard')); ?>">
                                            <i class="fas fa-tachometer-alt me-2 text-primary"></i> Dashboard
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
                                            <i class="fas fa-user-shield me-2 text-primary"></i> Admin
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="<?php echo e(route('login.siswa')); ?>">
                                            <i class="fas fa-user-graduate me-2 text-info"></i> Login Siswa
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

    <!-- Page Header -->
    <section class="page-header text-center">
        <div class="blob-bg blob-1"></div>
        <div class="blob-bg blob-2"></div>
        <div class="container position-relative" style="z-index: 2;">
            <div class="page-header-badge mb-3 d-inline-flex" data-aos="fade-down">
                <span class="pulse-dot"></span>
                <span>Jadwal Petugas UKS Aktif</span>
            </div>
            <h1 class="page-title" data-aos="fade-up" data-aos-delay="100">
                Jadwal <span class="gradient-text">Petugas</span><br>
                UKS SMK Negeri 1 Bangsri
            </h1>
            <p class="page-subtitle mx-auto" data-aos="fade-up" data-aos-delay="200">
                Informasi lengkap jadwal petugas yang bertugas di Unit Kesehatan Sekolah.
            </p>
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
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <?php
                        $members = is_string($schedule->members) ? json_decode($schedule->members, true) : ($schedule->members ?? []);
                        $members = is_array($members) ? $members : [];
                        
                        $membersCount = count($members);
                        $emergencyCount = 0;
                        foreach($members as $m) {
                            if (is_array($m) && !empty($m['phone'])) $emergencyCount++;
                        }
                    ?>
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="<?php echo e($loop->index * 60); ?>">
                        <div class="schedule-card">
                            <div class="schedule-num"><?php echo e($loop->iteration); ?></div>
                            <div class="schedule-info">
                                <h5><?php echo e($schedule->group_name ?? 'Grup ' . $loop->iteration); ?></h5>
                                <div class="schedule-meta">
                                    <span><i class="fas fa-users"></i> <?php echo e($membersCount); ?> anggota</span>
                                    <span class="meta-divider"></span>
                                    <span>
                                        <i class="fas fa-phone"></i>
                                        <?php echo e($emergencyCount); ?> kontak
                                    </span>
                                </div>
                            </div>
                            <button class="btn btn-view"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalAnggota<?php echo e($schedule->id); ?>">
                                Lihat <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Simple Modal -->
                    <div class="modal fade" id="modalAnggota<?php echo e($schedule->id); ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header-simple">
                                    <div class="modal-title-simple">
                                        <div class="title-icon"><i class="fas fa-users"></i></div>
                                        <div>
                                            <?php echo e($schedule->group_name ?? 'Grup'); ?>

                                            <small><?php echo e($membersCount); ?> anggota piket</small>
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close-simple" data-bs-dismiss="modal">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="members-list">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($membersCount > 0): ?>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                                <?php
                                                    $name = $member['name'] ?? '-';
                                                    $phone = $member['phone'] ?? '';
                                                ?>
                                                <div class="member-row <?php echo e(!empty($phone) ? 'has-phone' : ''); ?>">
                                                    <div class="member-num"><?php echo e($idx + 1); ?></div>
                                                    <div class="member-name">
                                                        <?php echo e($name); ?>

                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($phone)): ?>
                                                            <span class="phone-label">Kontak darurat</span>
                                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                    </div>
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($phone)): ?>
                                                        <a href="https://wa.me/<?php echo e(preg_replace('/\D/', '', $phone)); ?>"
                                                           target="_blank"
                                                           class="wa-btn">
                                                            <i class="fab fa-whatsapp"></i> Chat
                                                        </a>
                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                </div>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                        <?php else: ?>
                                            <div class="text-center py-5">
                                                <i class="fas fa-user-slash text-muted" style="font-size: 2rem;"></i>
                                                <p class="text-muted mt-2 mb-0">Data anggota belum tersedia</p>
                                            </div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <div class="col-12">
                        <div class="empty-state" data-aos="fade-up">
                            <div class="empty-icon-wrap">
                                <i class="fas fa-calendar-times"></i>
                            </div>
                            <h5>Belum Ada Jadwal</h5>
                            <p>Jadwal petugas belum tersedia. Silakan hubungi admin UKS.</p>
                        </div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
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
                        <li><a href="<?php echo e(route('landing')); ?>#layanan"><i class="fas fa-chevron-right fa-xs"></i> Layanan</a></li>
                        <li><a href="<?php echo e(route('landing.docs')); ?>" class="btn-doc-all"><i class="fas fa-chevron-right fa-xs"></i> Dokumentasi</a></li>
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

            // Navbar scroll effect & Scroll to top
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
        });
    </script>
</body>
</html><?php /**PATH C:\laragon\www\sikes\resources\views/landing/schedule.blade.php ENDPATH**/ ?>