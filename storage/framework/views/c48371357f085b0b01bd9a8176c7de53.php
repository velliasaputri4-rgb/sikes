<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Kesehatan - SIKES</title>
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
        --pro: #991b1b;
        --pro-light: #ef4444;
        --emerald: #10b981;
        --rose: #f43f5e;
        --amber: #f59e0b;
        --ink: #0f172a;
        --slate: #475569;
        --muted: #94a3b8;
        --gradient-primary: linear-gradient(135deg, #991b1b 0%, #ef4444 100%);
        --gradient-dark: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        --shadow-sm: 0 4px 20px rgba(153, 27, 27, 0.08);
        --shadow-md: 0 10px 40px rgba(153, 27, 27, 0.12);
        --shadow-lg: 0 25px 60px rgba(153, 27, 27, 0.18);
        --radius: 18px;
    }

    * { -webkit-font-smoothing: antialiased; }
    html { scroll-behavior: smooth; scroll-padding-top: 90px; }
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

    .blob-bg {
        position: absolute; border-radius: 50%; filter: blur(80px);
        opacity: 0.4; z-index: 0; pointer-events: none;
    }
    .blob-1 { width: 400px; height: 400px; background: #991b1b; top: -100px; left: -100px; animation: float1 20s ease-in-out infinite; opacity: 0.25; }
    .blob-2 { width: 350px; height: 350px; background: #ef4444; top: 100px; right: -80px; animation: float2 25s ease-in-out infinite; opacity: 0.2; }
    @keyframes float1 { 0%,100% { transform: translate(0,0) scale(1); } 50% { transform: translate(60px,-40px) scale(1.1); } }
    @keyframes float2 { 0%,100% { transform: translate(0,0) scale(1); } 50% { transform: translate(-50px,50px) scale(0.9); } }

    .page-header {
        position: relative; padding: 140px 0 80px;
        background: linear-gradient(180deg, #f7fafc 0%, #fef2f2 100%);
        overflow: hidden;
    }
    .page-header-badge {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 8px 18px; background: rgba(239, 68, 68, 0.1);
        color: var(--pro); border-radius: 50px; font-size: 0.85rem;
        font-weight: 600; margin-bottom: 0; border: 1px solid rgba(153, 27, 27, 0.15);
    }
    .page-title {
        font-family: 'Poppins', sans-serif; font-size: clamp(2rem, 4.5vw, 3rem);
        font-weight: 700; color: var(--ink); line-height: 1.2;
        margin-bottom: 14px; letter-spacing: -1px;
    }
    .gradient-text {
        background: var(--gradient-primary); -webkit-background-clip: text;
        -webkit-text-fill-color: transparent; background-clip: text;
    }
    .page-subtitle { color: var(--slate); font-size: 1.05rem; max-width: 580px; margin-bottom: 0; }

    .section { padding: 70px 0 90px; }
    .section-label {
        display: inline-block; padding: 6px 16px; background: rgba(239, 68, 68, 0.1);
        color: var(--pro); border-radius: 50px; font-size: 0.8rem; font-weight: 700;
        letter-spacing: 1px; text-transform: uppercase; margin-bottom: 12px;
    }
    .section-title {
        font-family: 'Poppins', sans-serif; font-size: clamp(1.6rem, 3.5vw, 2.2rem);
        font-weight: 700; color: var(--ink); margin-bottom: 12px; letter-spacing: -0.5px; line-height: 1.2;
    }
    .section-subtitle { color: var(--slate); font-size: 1rem; max-width: 550px; }

    .health-card {
        background: white; border-radius: var(--radius); padding: 24px;
        box-shadow: 0 4px 20px rgba(153, 27, 27, 0.06); transition: all 0.3s ease;
        height: 100%; border: 1px solid rgba(153, 27, 27, 0.08); display: flex; flex-direction: column;
    }
    .health-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); border-color: rgba(153, 27, 27, 0.15); }
    .health-icon {
        width: 56px; height: 56px; background: linear-gradient(135deg, #fef2f2, #fee2e2);
        border-radius: 14px; display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem; color: var(--pro); margin-bottom: 16px;
    }
    .health-card h5 { font-family: 'Poppins', sans-serif; font-weight: 700; color: var(--ink); margin-bottom: 8px; }
    .health-card p { color: var(--slate); font-size: 0.9rem; flex: 1; }
    
    .badge-cat {
        display: inline-block; padding: 4px 10px; border-radius: 50px;
        font-size: 0.75rem; font-weight: 600; margin-bottom: 12px;
        background: #fee2e2 !important;
        color: #991b1b !important;
        text-transform: capitalize;
    }

    .btn-read {
        background: var(--gradient-primary); color: white; border: none;
        border-radius: 10px; padding: 10px 16px; font-weight: 600; font-size: 0.85rem;
        transition: all 0.3s; display: inline-flex; align-items: center; gap: 6px;
        box-shadow: 0 4px 12px rgba(153, 27, 27, 0.25); width: 100%; justify-content: center;
    }
    .btn-read:hover { color: white; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(153, 27, 27, 0.4); }

    .scroll-top {
        position: fixed; bottom: 30px; right: 30px; width: 50px; height: 50px;
        background: var(--gradient-primary); color: white; border: none;
        border-radius: 14px; display: flex; align-items: center; justify-content: center;
        box-shadow: 0 10px 30px rgba(153, 27, 27, 0.35); cursor: pointer;
        opacity: 0; visibility: hidden; transform: translateY(20px); transition: all 0.3s; z-index: 999;
    }
    .scroll-top.show { opacity: 1; visibility: visible; transform: translateY(0); }
    .scroll-top:hover { transform: translateY(-4px); box-shadow: 0 15px 40px rgba(239, 68, 68, 0.5); }

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

    <!-- Page Header -->
    <section class="page-header">
        <div class="blob-bg blob-1"></div>
        <div class="blob-bg blob-2"></div>
        <div class="container position-relative" style="z-index: 2;">
            <div class="row align-items-center">
                <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                    <div class="page-header-badge mb-3 d-inline-flex">
                        <span style="width: 8px; height: 8px; background: var(--emerald); border-radius: 50%; display: inline-block;"></span>
                        <span><?php echo e($settings['health_info_label'] ?? 'Pusat Informasi Kesehatan'); ?></span>
                    </div>
                    
                    <h1 class="page-title">
                        <?php echo $settings['health_info_title'] ?? 'Informasi <span class="gradient-text">Kesehatan</span><br>& Gaya Hidup Sehat'; ?>

                    </h1>
                    
                    <p class="page-subtitle mx-auto"><?php echo e($settings['health_info_subtitle'] ?? 'Artikel edukasi lengkap untuk mendukung kesejahteraan dan gaya hidup sehat siswa SMK Negeri 1 Bangsri.'); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tips Kesehatan -->
    <section class="section" id="artikel">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">Tips <span class="gradient-text">Kesehatan</span></h2>
            </div>
            
            <div class="row g-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $healthTips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <?php
                        $categoryLower = strtolower($tip->category ?? '');
                        $icons = [
                            'gizi' => 'fa-apple-alt', 'makan' => 'fa-apple-alt',
                            'penyakit' => 'fa-shield-virus', 'dbd' => 'fa-shield-virus', 'flu' => 'fa-shield-virus',
                            'mental' => 'fa-brain', 'stres' => 'fa-brain',
                            'gigi' => 'fa-tooth', 'mata' => 'fa-eye',
                            'p3k' => 'fa-kit-medical', 'pertolongan' => 'fa-kit-medical',
                            'kebersihan' => 'fa-hand-sparkles', 'olahraga' => 'fa-running',
                        ];
                        
                        $icon = 'fa-heart-pulse';
                        foreach ($icons as $key => $value) {
                            if (str_contains($categoryLower, $key)) {
                                $icon = $value;
                                break;
                            }
                        }
                    ?>

                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?php echo e($loop->index * 100); ?>">
                        <div class="health-card">
                            <div class="health-icon"><i class="fas <?php echo e($icon); ?>"></i></div>
                            <span class="badge-cat"><?php echo e(str_replace('_', ' ', ucfirst($tip->category ?? 'Umum'))); ?></span>
                            <h5><?php echo e($tip->title); ?></h5>
                            <p><?php echo e(Str::limit(strip_tags($tip->content), 100, '...')); ?></p>
                            <button class="btn-read" data-bs-toggle="modal" data-bs-target="#modalTip<?php echo e($tip->id); ?>">
                                Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <div class="col-12 text-center py-5" data-aos="fade-up">
                        <i class="fas fa-info-circle fa-3x text-muted mb-3"></i>
                        <p class="text-muted fs-5">Belum ada informasi kesehatan yang tersedia saat ini.</p>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($healthTips) && method_exists($healthTips, 'hasPages') && $healthTips->hasPages()): ?>
                <div class="d-flex justify-content-center mt-5" data-aos="fade-up">
                    <?php echo e($healthTips->links('pagination::bootstrap-5')); ?>

                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>

    <!-- Modals Artikel -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $healthTips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
    <div class="modal fade" id="modalTip<?php echo e($tip->id); ?>" tabindex="-1" aria-labelledby="modalLabel<?php echo e($tip->id); ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius: var(--radius); border: none;">
                <div class="modal-header" style="border-bottom: 1px solid #f1f5f9;">
                    <h5 class="modal-title fw-bold" id="modalLabel<?php echo e($tip->id); ?>"><?php echo e($tip->title); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p style="white-space: pre-wrap; line-height: 1.8;"><?php echo e($tip->content); ?></p>
                    
                    <hr class="my-4">
                    <div class="d-flex justify-content-between align-items-center text-muted small">
                        <span><i class="fas fa-tag me-1"></i> <?php echo e(str_replace('_', ' ', ucfirst($tip->category ?? 'Umum'))); ?></span>
                        <span><i class="fas fa-calendar-alt me-1"></i> <?php echo e(\Carbon\Carbon::parse($tip->created_at)->format('d M Y')); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

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
    <button class="scroll-top" id="scrollTop" aria-label="Kembali ke atas">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({ duration: 700, once: true, offset: 60 });

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
</html><?php /**PATH C:\laragon\www\sikes\resources\views/landing/health-info.blade.php ENDPATH**/ ?>