<!-- Navbar SIKES -->
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
                <!-- ✅ Menggunakan request()->routeIs() agar menu 'active' otomatis menyala sesuai halaman -->
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('landing') ? 'active' : ''); ?>" href="<?php echo e(route('landing')); ?>">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('landing.about') ? 'active' : ''); ?>" href="<?php echo e(route('landing.about')); ?>">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('landing')); ?>#layanan">Layanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('landing')); ?>#dokumentasi">Dokumentasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('landing')); ?>#kontak">Kontak</a>
                </li>

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
</nav><?php /**PATH C:\laragon\www\sikes\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>