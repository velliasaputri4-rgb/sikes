<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Kesehatan - SIKES</title>
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
    html { scroll-behavior: smooth; scroll-padding-top: 20px; }
    body {
        font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
        background: #fafbfc;
        color: var(--ink);
        line-height: 1.7;
        overflow-x: hidden;
    }

    .btn-back-home {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 8px 18px; background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px); color: var(--pro);
        border-radius: 50px; font-weight: 600; font-size: 0.85rem;
        text-decoration: none; box-shadow: var(--shadow-sm);
        border: 1px solid rgba(30,58,138,0.15);
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .btn-back-home:hover {
        background: var(--gradient-primary); color: white;
        border-color: transparent; transform: translateX(-4px);
        box-shadow: var(--shadow-md);
    }
    .btn-back-home i { transition: transform 0.3s ease; }
    .btn-back-home:hover i { transform: translateX(-3px); }

    .blob-bg {
        position: absolute; border-radius: 50%; filter: blur(80px);
        opacity: 0.4; z-index: 0; pointer-events: none;
    }
    .blob-1 { width: 400px; height: 400px; background: #1e3a8a; top: -100px; left: -100px; animation: float1 20s ease-in-out infinite; opacity: 0.25; }
    .blob-2 { width: 350px; height: 350px; background: #3b82f6; top: 100px; right: -80px; animation: float2 25s ease-in-out infinite; opacity: 0.2; }
    @keyframes float1 { 0%,100% { transform: translate(0,0) scale(1); } 50% { transform: translate(60px,-40px) scale(1.1); } }
    @keyframes float2 { 0%,100% { transform: translate(0,0) scale(1); } 50% { transform: translate(-50px,50px) scale(0.9); } }

    .page-header {
        position: relative; padding: 80px 0 70px;
        background: linear-gradient(180deg, #f7fafc 0%, #edf2fa 100%);
        overflow: hidden;
    }
    .page-header-badge {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 8px 18px; background: rgba(59,130,246,0.1);
        color: var(--pro); border-radius: 50px; font-size: 0.85rem;
        font-weight: 600; margin-bottom: 0; border: 1px solid rgba(30,58,138,0.15);
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

    .header-icon-wrap {
        width: 120px; height: 120px; background: var(--gradient-primary);
        border-radius: 30px; display: flex; align-items: center; justify-content: center;
        color: white; font-size: 3rem; box-shadow: 0 20px 50px rgba(30,58,138,0.3);
        margin-left: auto; animation: iconFloat 5s ease-in-out infinite; position: relative;
    }
    .header-icon-wrap::before {
        content: ''; position: absolute; inset: -10px; border-radius: 34px;
        background: var(--gradient-primary); opacity: 0.2; z-index: -1;
    }
    @keyframes iconFloat { 0%,100% { transform: translateY(0) rotate(0); } 50% { transform: translateY(-10px) rotate(3deg); } }

    .section { padding: 70px 0 90px; }
    .section-label {
        display: inline-block; padding: 6px 16px; background: rgba(59,130,246,0.1);
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
        box-shadow: 0 4px 20px rgba(30,58,138,0.06); transition: all 0.3s ease;
        height: 100%; border: 1px solid rgba(30,58,138,0.08); display: flex; flex-direction: column;
    }
    .health-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); border-color: rgba(30,58,138,0.15); }
    .health-icon {
        width: 56px; height: 56px; background: linear-gradient(135deg, #f6f9fc, #edf2fa);
        border-radius: 14px; display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem; color: var(--pro); margin-bottom: 16px;
    }
    .health-card h5 { font-family: 'Poppins', sans-serif; font-weight: 700; color: var(--ink); margin-bottom: 8px; }
    .health-card p { color: var(--slate); font-size: 0.9rem; flex: 1; }
    
    .badge-cat {
        display: inline-block; padding: 4px 10px; border-radius: 50px;
        font-size: 0.75rem; font-weight: 600; margin-bottom: 12px;
        background: #dbeafe !important;
        color: #1e40af !important;
        text-transform: capitalize;
    }

    .btn-read {
        background: var(--gradient-primary); color: white; border: none;
        border-radius: 10px; padding: 10px 16px; font-weight: 600; font-size: 0.85rem;
        transition: all 0.3s; display: inline-flex; align-items: center; gap: 6px;
        box-shadow: 0 4px 12px rgba(30,58,138,0.25); width: 100%; justify-content: center;
    }
    .btn-read:hover { color: white; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(30,58,138,0.4); }

    .scroll-top {
        position: fixed; bottom: 30px; right: 30px; width: 50px; height: 50px;
        background: var(--gradient-primary); color: white; border: none;
        border-radius: 14px; display: flex; align-items: center; justify-content: center;
        box-shadow: 0 10px 30px rgba(30,58,138,0.35); cursor: pointer;
        opacity: 0; visibility: hidden; transform: translateY(20px); transition: all 0.3s; z-index: 999;
    }
    .scroll-top.show { opacity: 1; visibility: visible; transform: translateY(0); }
    .scroll-top:hover { transform: translateY(-4px); box-shadow: 0 15px 40px rgba(59,130,246,0.5); }

    @media (max-width: 768px) {
        .page-header { padding: 60px 0; }
        .header-icon-wrap { width: 90px; height: 90px; font-size: 2.3rem; margin: 20px auto 0; }
        .btn-back-home span { display: none; }
        .btn-back-home i { margin: 0; }
    }
    </style>
</head>
<body>

    <!-- Page Header (DINAMIS DARI PENGATURAN) -->
    <section class="page-header">
        <div class="blob-bg blob-1"></div>
        <div class="blob-bg blob-2"></div>
        <div class="container position-relative" style="z-index: 2;">
            <div class="row align-items-center g-4">
                <div class="col-lg-8" data-aos="fade-right">
                    <div class="d-flex align-items-center gap-3 flex-wrap" style="margin-bottom: 18px;">
                        <div class="page-header-badge mb-0">
                            <span style="width: 8px; height: 8px; background: var(--emerald); border-radius: 50%; display: inline-block;"></span>
                            <span><?php echo e($settings['health_info_label'] ?? 'Pusat Informasi Kesehatan'); ?></span>
                        </div>
                        <a href="<?php echo e(route('landing')); ?>" class="btn-back-home" data-aos="fade-right" data-aos-delay="100">
                            <i class="fas fa-arrow-left"></i>
                            <span>Kembali ke Beranda</span>
                        </a>
                    </div>
                    
                    <h1 class="page-title">
                        <?php echo $settings['health_info_title'] ?? 'Informasi <span class="gradient-text">Kesehatan</span><br>& Gaya Hidup Sehat'; ?>

                    </h1>
                    
                    <p class="page-subtitle"><?php echo e($settings['health_info_subtitle'] ?? 'Artikel edukasi lengkap untuk mendukung kesejahteraan dan gaya hidup sehat siswa SMK Negeri 1 Bangsri.'); ?></p>
                </div>
                <div class="col-lg-4 text-lg-end" data-aos="fade-left" data-aos-delay="200">
                    <div class="header-icon-wrap">
                        <i class="fas fa-heart-pulse"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tips Kesehatan (DINAMIS DARI DATABASE) -->
    <section class="section" id="artikel">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">Tips <span class="gradient-text">Kesehatan</span></h2>
            </div>
            
            <div class="row g-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $healthTips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <?php
                        // Mapping ikon yang AMAN dan BEBAS ERROR sintaks
                        $categoryLower = strtolower($tip->category ?? '');
                        $icons = [
                            'gizi' => 'fa-apple-alt',
                            'makan' => 'fa-apple-alt',
                            'penyakit' => 'fa-shield-virus',
                            'dbd' => 'fa-shield-virus',
                            'flu' => 'fa-shield-virus',
                            'mental' => 'fa-brain',
                            'stres' => 'fa-brain',
                            'gigi' => 'fa-tooth',
                            'mata' => 'fa-eye',
                            'p3k' => 'fa-kit-medical',
                            'pertolongan' => 'fa-kit-medical',
                            'kebersihan' => 'fa-hand-sparkles',
                            'olahraga' => 'fa-running',
                        ];
                        
                        $icon = 'fa-heart-pulse'; // Default
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
                        <a href="<?php echo e(route('landing')); ?>" class="btn btn-outline-primary mt-2">Kembali ke Beranda</a>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <!-- Pagination -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($healthTips) && $healthTips->hasPages()): ?>
                <div class="d-flex justify-content-center mt-5">
                    <?php echo e($healthTips->links('pagination::bootstrap-5')); ?>

                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>

    <!-- Modals Artikel (DINAMIS) -->
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
                        <span><i class="fas fa-calendar-alt me-1"></i> <?php echo e($tip->created_at->format('d M Y')); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

    <button class="scroll-top" id="scrollTop" aria-label="Kembali ke atas">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init({ duration: 700, once: true, offset: 60 });

        window.addEventListener('scroll', function() {
            const scrollTop = document.getElementById('scrollTop');
            if (window.scrollY > 300) {
                scrollTop.classList.add('show');
            } else {
                scrollTop.classList.remove('show');
            }
        });

        document.getElementById('scrollTop').addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>
</body>
</html><?php /**PATH C:\laragon\www\sikes\resources\views/landing/health-info.blade.php ENDPATH**/ ?>