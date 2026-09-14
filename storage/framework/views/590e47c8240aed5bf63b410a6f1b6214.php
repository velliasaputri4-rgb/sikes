<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumentasi & Berita - SIKES</title>
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
            --pro-dark: #7f1d1d;
            --pro-light: #ef4444;
            --gradient-pro: linear-gradient(135deg, #991b1b 0%, #ef4444 100%);
            --gradient-primary: linear-gradient(135deg, #991b1b 0%, #ef4444 100%);
            --gradient-dark: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            --shadow-sm: 0 4px 20px rgba(153, 58, 27, 0.08);
            --shadow-md: 0 10px 40px rgba(153, 58, 27, 0.12);
            --shadow-lg: 0 25px 60px rgba(153, 58, 27, 0.18);
            --radius: 18px;
        }
        
        * { -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }
        
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

        .section { padding: 80px 0; position: relative; }
        .section-label {
            display: inline-block; padding: 6px 16px; background: rgba(239, 68, 68, 0.12); color: var(--pro);
            border-radius: 50px; font-size: 0.8rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 16px;
        }
        .section-title { font-family: 'Poppins', sans-serif; font-size: clamp(1.8rem, 4vw, 2.6rem); font-weight: 700; color: var(--ink); margin-bottom: 16px; }
        .section-subtitle { color: var(--slate); font-size: 1.05rem; max-width: 600px; margin: 0 auto; }
        .gradient-text { background: var(--gradient-primary); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }

        /* Doc Card Styling */
        .doc-card {
            background: white; border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow-sm);
            transition: all 0.3s ease; height: 100%; border: 1px solid rgba(153, 27, 27, 0.08); display: flex; flex-direction: column;
        }
        .doc-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-lg); }
        .doc-image { width: 100%; height: 240px; overflow: hidden; position: relative; }
        .doc-image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
        .doc-card:hover .doc-image img { transform: scale(1.05); }
        
        .video-overlay {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.4);
            display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease; z-index: 2;
            text-decoration: none; cursor: pointer;
        }
        .doc-card:hover .video-overlay { opacity: 1; }
        .video-overlay i { font-size: 3.5rem; color: #ffffff; filter: drop-shadow(0 4px 10px rgba(0,0,0,0.4)); transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        .doc-card:hover .video-overlay i { transform: scale(1.15); }

        .doc-content { padding: 24px; flex-grow: 1; display: flex; flex-direction: column; }
        .doc-meta { display: flex; gap: 20px; margin-bottom: 12px; font-size: 0.85rem; color: var(--slate); flex-wrap: wrap; }
        .doc-meta span { display: inline-flex; align-items: center; gap: 6px; }
        .doc-meta i { color: var(--primary); font-size: 0.9rem; }
        .badge-video { background: rgba(244, 63, 94, 0.1); color: var(--rose); padding: 3px 10px; border-radius: 6px; font-weight: 700; font-size: 0.75rem; display: inline-flex; align-items: center; gap: 5px; }
        
        .doc-title { font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 1.1rem; line-height: 1.4; margin-bottom: 8px; }
        .doc-title a { color: var(--ink); text-decoration: none; transition: color 0.3s ease; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
        .doc-title a:hover { color: var(--primary); }
        .doc-excerpt { color: var(--slate); font-size: 0.9rem; line-height: 1.6; margin-top: 8px; margin-bottom: 0; }

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
            .doc-image { height: 200px; }
            .section { padding: 60px 0; }
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

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
                    <li class="nav-item"><a class="nav-link active" href="<?php echo e(route('landing.docs')); ?>">Dokumentasi</a></li>
                   
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

    <!-- Header & Content Section -->
    <section class="section flex-grow-1" style="background: linear-gradient(180deg, #fafbfc 0%, #fef2f2 100%);">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-label"><?php echo e(\App\Models\Setting::get('docs_label', 'Dokumentasi')); ?></span>
                <h1 class="section-title"><?php echo \App\Models\Setting::get('docs_title', 'Berita & <span class="gradient-text">Kegiatan</span>'); ?></h1>
                <p class="section-subtitle"><?php echo e(\App\Models\Setting::get('docs_subtitle', 'Informasi terbaru seputar kegiatan dan program UKS di sekolah kami')); ?></p>
            </div>

            <div class="row g-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $documentations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?php echo e(($index % 3) * 100); ?>">
                        <div class="doc-card">
                            <div class="doc-image">
                                <img src="<?php echo e($doc->image ? asset('storage/' . $doc->image) : 'https://via.placeholder.com/600x400/ef4444/ffffff?text=Dokumentasi+UKS'); ?>" 
                                     alt="<?php echo e($doc->title); ?>" 
                                     onerror="this.src='https://via.placeholder.com/600x400/ef4444/ffffff?text=Dokumentasi+UKS'">
                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($doc->video_link)): ?>
                                    <a href="<?php echo e($doc->video_link); ?>" target="_blank" class="video-overlay" title="Putar Video">
                                        <i class="fas fa-play-circle"></i>
                                    </a>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <div class="doc-content">
                                <div class="doc-meta">
                                    <span><i class="far fa-calendar"></i> <?php echo e(\Carbon\Carbon::parse($doc->published_at)->format('d F Y')); ?></span>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($doc->video_link)): ?>
                                        <span class="badge-video"><i class="fas fa-video"></i> Video</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <h5 class="doc-title">
                                    <a href="<?php echo e(!empty($doc->video_link) ? $doc->video_link : route('landing.docs-detail', \Illuminate\Support\Str::slug($doc->title))); ?>" 
                                       target="<?php echo e(!empty($doc->video_link) ? '_blank' : '_self'); ?>">
                                        <?php echo e($doc->title); ?>

                                    </a>
                                </h5>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($doc->excerpt)): ?>
                                    <p class="doc-excerpt"><?php echo e(\Illuminate\Support\Str::limit($doc->excerpt, 100)); ?></p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <div class="col-12 text-center py-5" data-aos="fade-up">
                        <i class="far fa-folder-open fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">Belum ada dokumentasi atau berita yang dipublikasikan.</h4>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({ duration: 800, once: true, offset: 80 });

            // Navbar scroll effect
            window.addEventListener('scroll', function() {
                const navbar = document.querySelector('.navbar');
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            }, { passive: true });
        });
    </script>
</body>
</html><?php /**PATH C:\laragon\www\sikes\resources\views/landing/docs.blade.php ENDPATH**/ ?>