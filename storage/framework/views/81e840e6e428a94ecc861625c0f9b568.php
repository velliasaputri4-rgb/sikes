<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Kami - SIKES</title>
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
            --ink: #0f172a;
            --slate: #475569;
            --pro: #991b1b;
            --amber: #f59e0b;
            --gradient-primary: linear-gradient(135deg, #991b1b 0%, #ef4444 100%);
            --gradient-dark: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            --shadow-sm: 0 4px 20px rgba(153, 27, 27, 0.08);
            --shadow-md: 0 10px 40px rgba(153, 27, 27, 0.12);
            --shadow-lg: 0 25px 60px rgba(153, 27, 27, 0.18);
            --radius: 18px;
        }
        * { -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }
        html { scroll-behavior: smooth; scroll-padding-top: 90px; }
        body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; background: #fafbfc; color: var(--ink); line-height: 1.7; overflow-x: hidden; }

        /* Navbar */
        .navbar { background: rgba(255,255,255,0.95); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); box-shadow: 0 4px 30px rgba(153, 27, 27, 0.06); border-bottom: 1px solid rgba(153, 27, 27, 0.08); padding: 12px 0; transition: all 0.4s ease; }
        .navbar.scrolled { padding: 8px 0; box-shadow: 0 8px 40px rgba(153, 27, 27, 0.1); }
        .navbar-brand { display: flex; align-items: center; }
        .navbar-brand img { max-height: 55px; width: auto; transition: transform 0.3s; }
        .navbar-brand:hover img { transform: scale(1.05); }
        .nav-link { font-weight: 600; font-size: 0.95rem; color: var(--slate) !important; padding: 10px 18px !important; border-radius: 10px; transition: all 0.3s ease; letter-spacing: 0.2px; }
        .nav-link:hover { color: var(--primary-dark) !important; background: linear-gradient(135deg, rgba(153,27,27,0.08), rgba(239,68,68,0.08)); transform: translateY(-1px); }
        .nav-link.active { color: white !important; background: var(--gradient-primary); box-shadow: 0 6px 20px rgba(153, 27, 27, 0.25); }
        .user-btn { background: var(--gradient-primary); color: white !important; border: none; width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; box-shadow: 0 6px 20px rgba(153, 27, 27, 0.3); transition: all 0.3s; }
        .user-btn:hover { transform: translateY(-2px) rotate(5deg); box-shadow: 0 10px 28px rgba(153,27,27,0.4); }
        .dropdown-menu { border: none; border-radius: 14px; box-shadow: 0 20px 50px rgba(15,23,42,0.15); padding: 10px; margin-top: 10px; }
        .dropdown-item { border-radius: 8px; padding: 10px 14px; font-weight: 500; transition: all 0.2s; }
        .dropdown-item:hover { background: linear-gradient(135deg, rgba(153,27,27,0.08), rgba(239,68,68,0.08)); transform: translateX(4px); }

        /* Header & Layout */
        .page-header { background: linear-gradient(135deg, #f6f9fc 0%, #fef2f2 100%); padding: 140px 0 80px; text-align: center; position: relative; }
        .section { padding: 90px 0; position: relative; }
        .section-label { display: inline-block; padding: 6px 16px; background: rgba(239, 68, 68, 0.12); color: #991b1b; border-radius: 50px; font-size: 0.8rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 16px; }
        .section-title { font-family: 'Poppins', sans-serif; font-size: clamp(1.8rem, 4vw, 2.6rem); font-weight: 700; color: var(--ink); margin-bottom: 16px; line-height: 1.2; }
        .section-subtitle { color: var(--slate); font-size: 1.05rem; max-width: 600px; margin: 0 auto; }
        .gradient-text { background: var(--gradient-primary); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }

        /* Service Card */
        .service-card { background: white; border-radius: var(--radius); box-shadow: 0 4px 20px rgba(153,27,27,0.06); margin-bottom: 25px; text-align: left; height: 100%; border: 1px solid rgba(153,27,27,0.08); position: relative; overflow: hidden; display: flex; flex-direction: column; transition: all 0.3s ease; }
        .service-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-lg); border-color: transparent; }
        .service-image-wrapper { position: relative; overflow: hidden; border-radius: 12px; margin: 20px 24px 16px 24px; cursor: pointer; }
        .service-image { width: 100%; height: 160px; object-fit: cover; transition: transform 0.4s ease; }
        .service-image-wrapper:hover .service-image { transform: scale(1.05); }
        .service-image-wrapper::after { content: '\f00e'; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%) scale(0); font-family: "Font Awesome 6 Free"; font-weight: 900; font-size: 1.2rem; color: white; background: rgba(153, 27, 27, 0.7); width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease; z-index: 2; pointer-events: none; }
        .service-image-wrapper:hover::after { transform: translate(-50%, -50%) scale(1); }
        .service-icon { position: absolute; top: 16px; right: 16px; width: 40px; height: 40px; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(4px); color: var(--primary); border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; box-shadow: 0 4px 12px rgba(0,0,0,0.1); z-index: 3; transition: all 0.3s ease; }
        .service-card:hover .service-icon { transform: scale(1.1); background: white; box-shadow: 0 6px 16px rgba(0,0,0,0.15); }
        .service-content { padding: 0 24px 24px 24px; flex-grow: 1; display: flex; flex-direction: column; }
        .service-card h5 { font-weight: 700; color: var(--ink); margin-bottom: 8px; font-size: 1.1rem; }
        .service-card p { color: var(--slate); font-size: 0.92rem; margin-bottom: 0; line-height: 1.6; }

        /* Custom Accordion FAQ */
        .accordion-item { border: 1px solid rgba(153,27,27,0.08) !important; }
        .accordion-button { font-weight: 600; font-size: 1rem; color: var(--ink); background: white; box-shadow: none !important; padding: 20px 24px; }
        .accordion-button:not(.collapsed) { background: linear-gradient(135deg, rgba(153,27,27,0.04), rgba(239,68,68,0.04)); color: var(--primary-dark); }
        .accordion-button:focus { border-color: transparent; box-shadow: none; }
        .accordion-body { padding: 0 24px 24px 24px; color: var(--slate); line-height: 1.7; font-size: 0.95rem; }

        /* Footer & Button */
        .btn-doc-all { background: var(--gradient-primary); color: white; padding: 12px 32px; border-radius: 50px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 6px 20px rgba(153,27,27,0.25); transition: all 0.3s ease; }
        .btn-doc-all:hover { color: white; transform: translateY(-2px); box-shadow: 0 10px 30px rgba(153,27,27,0.35); }
        footer { background: var(--gradient-dark); color: white; padding: 80px 0 30px; position: relative; overflow: hidden; }
        footer::before { content: ''; position: absolute; inset: 0; background-image: radial-gradient(circle at 10% 20%, rgba(153,27,27,0.25) 0%, transparent 40%), radial-gradient(circle at 90% 80%, rgba(239,68,68,0.15) 0%, transparent 40%); }
        footer .container { position: relative; z-index: 1; }
        .footer-logo { display: inline-flex; align-items: center; gap: 12px; margin-bottom: 20px; font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 1.4rem; }
        footer h6 { font-weight: 700; margin-bottom: 22px; color: white; text-transform: uppercase; letter-spacing: 1px; font-size: 0.9rem; }
        .footer-menu { list-style: none; padding: 0; margin: 0; }
        .footer-menu li { margin-bottom: 12px; }
        .footer-menu a { color: rgba(255,255,255,0.7); text-decoration: none; font-weight: 500; font-size: 0.95rem; transition: all 0.3s; display: inline-flex; align-items: center; gap: 8px; }
        .footer-menu a:hover { color: #fca5a5; transform: translateX(6px); }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,0.1); margin-top: 50px; padding-top: 25px; text-align: center; color: rgba(255,255,255,0.5); font-size: 0.9rem; }

        @media (max-width: 768px) { 
            .section { padding: 60px 0; } 
            .page-header { padding: 120px 0 60px; } 
            .navbar-brand img { max-height: 42px; }
            .service-image { height: 120px; }
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
                    <li class="nav-item"><a class="nav-link active" href="<?php echo e(route('landing.services')); ?>">Layanan</a></li>
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
                                    <li><a class="dropdown-item" href="<?php echo e(route('dashboard')); ?>"><i class="fas fa-tachometer-alt me-2" style="color: var(--primary);"></i> Dashboard</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                                        </form>
                                    </li>
                                <?php else: ?>
                                    <li class="dropdown-header text-center"><small class="text-muted">Pilih Login</small></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item fw-semibold" href="<?php echo e(route('login')); ?>"><i class="fas fa-user-shield me-2" style="color: var(--primary);"></i> Admin</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="<?php echo e(route('login.siswa')); ?>"><i class="fas fa-user-graduate me-2" style="color: var(--primary);"></i> Login Siswa</a></li>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <header class="page-header">
        <div class="container position-relative" data-aos="fade-up">
            <span class="section-label">Layanan Kami</span>
            <h1 class="section-title mt-3"><?php echo \App\Models\Setting::get('services_title', 'Layanan Kesehatan <span class="gradient-text">Profesional</span>'); ?></h1>
            <p class="section-subtitle"><?php echo e(\App\Models\Setting::get('services_subtitle', 'Berbagai layanan kesehatan lengkap yang kami sediakan untuk mendukung kesejahteraan siswa SMK Negeri 1 Bangsri.')); ?></p>
        </div>
    </header>

    <!-- Services Content -->
    <section class="section">
        <div class="container">
            <div class="row g-4">
                <?php
                    $defaultServices = [
                        ['icon' => 'fa-stethoscope', 'title' => 'Pemeriksaan Kesehatan', 'desc' => 'Pemeriksaan rutin dan saat sakit dengan tenaga profesional.', 'image' => ''],
                        ['icon' => 'fa-pills', 'title' => 'Pelayanan Obat', 'desc' => 'Penyediaan obat lengkap dan terjamin kualitasnya.', 'image' => ''],
                        ['icon' => 'fa-heartbeat', 'title' => 'Pertolongan Pertama', 'desc' => 'Pertolongan pertama pada kecelakaan & keadaan darurat.', 'image' => ''],
                        ['icon' => 'fa-user-md', 'title' => 'Konsultasi Kesehatan', 'desc' => 'Konsultasi kesehatan fisik dan mental dengan petugas terlatih.', 'image' => ''],
                        ['icon' => 'fa-clipboard-check', 'title' => 'Pemeriksaan Berkala', 'desc' => 'Pemeriksaan berkala untuk memantau kondisi siswa.', 'image' => ''],
                        ['icon' => 'fa-graduation-cap', 'title' => 'Edukasi Kesehatan', 'desc' => 'Penyuluhan dan edukasi tentang pola hidup sehat.', 'image' => '']
                    ];
                    $servicesRaw = \App\Models\Setting::get('services_data', json_encode($defaultServices));
                    $servicesData = is_array($servicesRaw) ? $servicesRaw : json_decode($servicesRaw, true);
                ?>
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $servicesData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?php echo e($i * 80); ?>">
                    <div class="service-card">
                        <div class="service-image-wrapper" 
                             data-bs-toggle="modal" 
                             data-bs-target="#serviceImageModal"
                             data-image="<?php echo e(!empty($s['image']) ? asset('storage/' . $s['image']) : 'https://via.placeholder.com/400x200/ef4444/ffffff?text=Layanan+UKS'); ?>"
                             data-title="<?php echo e($s['title'] ?? 'Layanan'); ?>">
                            
                            <img src="<?php echo e(!empty($s['image']) ? asset('storage/' . $s['image']) : 'https://via.placeholder.com/400x200/ef4444/ffffff?text=Layanan+UKS'); ?>" 
                                 alt="<?php echo e($s['title']); ?>" 
                                 class="service-image"
                                 onerror="this.src='https://via.placeholder.com/400x200/ef4444/ffffff?text=Layanan+UKS'">
                        </div>
                        
                        <div class="service-icon">
                            <i class="fas <?php echo e($s['icon'] ?? 'fa-star'); ?>"></i>
                        </div>

                        <div class="service-content">
                            <h5 class="fw-bold"><?php echo e($s['title'] ?? 'Layanan'); ?></h5>
                            <p><?php echo e($s['desc'] ?? 'Deskripsi layanan'); ?></p>
                        </div>
                    </div>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </div>
    </section>

    <!-- ✅ FAQ Section DINAMIS (Mengambil dari Database) -->
    <section class="section" style="background: #f8fafc;">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-label"><?php echo e(\App\Models\Setting::get('faq_label', 'FAQ')); ?></span>
                <h2 class="section-title"><?php echo \App\Models\Setting::get('faq_title', 'Pertanyaan yang <span class="gradient-text">Sering Diajukan</span>'); ?></h2>
                <p class="section-subtitle mx-auto"><?php echo e(\App\Models\Setting::get('faq_subtitle', 'Temukan jawaban atas pertanyaan umum seputar layanan UKS dan penggunaan aplikasi SIKES di sekolah kita.')); ?></p>
            </div>
            
            <div class="row justify-content-center" data-aos="fade-up">
                <div class="col-lg-8">
                    <div class="accordion" id="faqAccordion">
                        <?php
                            $faqsRaw = \App\Models\Setting::get('faqs_data');
                            $faqsData = is_array($faqsRaw) ? $faqsRaw : json_decode($faqsRaw, true);
                            
                            // Fallback jika database masih kosong
                            if (empty($faqsData)) {
                                $faqsData = [
                                    ['question' => 'Apakah data rekam medis saya aman di SIKES?', 'answer' => 'Sangat aman. SIKES menggunakan sistem login terenkripsi dan hanya dapat diakses oleh siswa yang bersangkutan, petugas UKS, dan admin sekolah.'],
                                    ['question' => 'Bagaimana prosedur jika saya sakit saat jam pelajaran?', 'answer' => 'Mintalah izin kepada guru pengampu, lalu pergilah ke ruang UKS dengan didampingi teman atau ketua kelas.']
                                ];
                            }
                        ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $faqsData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($faq['question'])): ?>
                            <div class="accordion-item border-0 mb-3 rounded-4 overflow-hidden shadow-sm">
                                <h2 class="accordion-header">
                                    <button class="accordion-button <?php echo e($index === 0 ? '' : 'collapsed'); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#faq<?php echo e($index); ?>">
                                        <?php echo e($faq['question']); ?>

                                    </button>
                                </h2>
                                <div id="faq<?php echo e($index); ?>" class="accordion-collapse collapse <?php echo e($index === 0 ? 'show' : ''); ?>" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <?php echo e($faq['answer']); ?>

                                    </div>
                                </div>
                            </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
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
                    <div class="footer-logo"><span>SIKES</span></div>
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
                        <li><a href="<?php echo e(\App\Models\Setting::get('contact_ig_link', '#')); ?>" target="_blank"><i class="fab fa-instagram"></i> <?php echo e('@' . \App\Models\Setting::get('contact_ig_handle', 'pmrwira_eskasaba')); ?></a></li>
                        <li><a href="<?php echo e(\App\Models\Setting::get('contact_yt_link', '#')); ?>" target="_blank"><i class="fab fa-youtube"></i> <?php echo e('@' . \App\Models\Setting::get('contact_yt_handle', 'wirasandyaadhimukti3463')); ?></a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="mb-0"><?php echo \App\Models\Setting::get('footer_copyright', '&copy; ' . date('Y') . ' <strong>SIKES</strong> - Sistem Informasi UKS SMK Negeri 1 Bangsri. All rights reserved.'); ?></p>
            </div>
        </div>
    </footer>

    <!-- Modal Preview Gambar -->
    <div class="modal fade" id="serviceImageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="serviceImageModalLabel">Preview Gambar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-4">
                    <img src="" id="modalServiceImage" class="img-fluid rounded" style="max-height: 60vh; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({ duration: 800, once: true, offset: 80 });
            
            window.addEventListener('scroll', function() {
                const navbar = document.querySelector('.navbar');
                if (window.scrollY > 50) navbar.classList.add('scrolled');
                else navbar.classList.remove('scrolled');
            }, { passive: true });

            const serviceImageModal = document.getElementById('serviceImageModal');
            if (serviceImageModal) {
                serviceImageModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    const imageUrl = button.getAttribute('data-image');
                    const imageTitle = button.getAttribute('data-title');
                    serviceImageModal.querySelector('#modalServiceImage').src = imageUrl;
                    serviceImageModal.querySelector('#serviceImageModalLabel').textContent = imageTitle;
                });
            }
        });
    </script>
</body>
</html><?php /**PATH C:\laragon\www\sikes\resources\views/landing/services.blade.php ENDPATH**/ ?>