<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> - Petugas UKS</title>
    
    
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/logo sikes navbar.png')); ?>">
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
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
            --shadow-sm: 0 4px 20px rgba(153, 27, 27, 0.08);
            --shadow-md: 0 10px 40px rgba(153, 27, 27, 0.12);
            --radius: 18px;

            --sidebar-bg: #0f172a;
            --sidebar-hover: rgba(239, 68, 68, 0.12);
            --sidebar-text: #94a3b8;
            --sidebar-text-active: #ffffff;
        }
        
        body { 
            background-color: #fafbfc; 
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            overflow-x: hidden;
            color: var(--ink);
            line-height: 1.7;
        }
        
        .sidebar { 
            width: 260px; 
            background: linear-gradient(180deg, #111111 0%, #0a0a0a 100%);
            height: 100vh;
            position: fixed; 
            left: 0; 
            top: 0; 
            color: white; 
            z-index: 1000;
            transition: all 0.3s;
            overflow-y: auto; 
            overflow-x: hidden;
            padding-bottom: 30px;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
        }

        .sidebar::-webkit-scrollbar { width: 6px; }
        .sidebar::-webkit-scrollbar-track { background: rgba(255,255,255,0.03); }
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(239, 68, 68, 0.3);
            border-radius: 10px;
        }
        .sidebar::-webkit-scrollbar-thumb:hover { background: rgba(239, 68, 68, 0.6); }

        .sidebar-brand {
            padding: 22px 20px;
            border-bottom: 1px solid rgba(239, 68, 68, 0.2);
            background: rgba(239, 68, 68, 0.05);
        }
        .sidebar-brand h4 {
            margin: 0;
            font-weight: 800;
            font-size: 1.4rem;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #ffffff !important;
        }
        .sidebar-brand h4 i {
            color: #ef4444 !important;
            font-size: 1.5rem;
        }
        .sidebar-brand small {
            font-size: 10px !important;
            letter-spacing: 2px !important;
            text-transform: uppercase !important;
            margin-top: 4px !important;
            display: block !important;
            color: #ef4444 !important;
            font-weight: 600 !important;
            opacity: 1 !important;
        }

        .sidebar-section {
            padding: 18px 20px 8px 32px;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1.8px;
            opacity: 0.5;
            font-weight: 700;
            color: #64748b;
        }
        
        .sidebar .nav-link { 
            color: var(--sidebar-text) !important; 
            text-decoration: none !important;
            padding: 11px 18px; 
            border-radius: 8px; 
            margin: 2px 12px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            position: relative;
            border: 1px solid transparent !important;
        }
        .sidebar .nav-link:hover { 
            background-color: var(--sidebar-hover) !important;
            color: #ffffff !important;
            border-color: rgba(239, 68, 68, 0.3) !important;
            transform: translateX(3px);
        }
        
        .sidebar .nav-link.active { 
            background: linear-gradient(90deg, rgba(239, 68, 68, 0.2) 0%, rgba(239, 68, 68, 0.05) 100%) !important;
            color: #ffffff !important;
            font-weight: 600;
            border-left: 3px solid #ef4444 !important;
            border-right: 1px solid rgba(239, 68, 68, 0.15) !important;
            box-shadow: none !important;
        }
        
        .sidebar .nav-link i { 
            width: 22px;
            margin-right: 12px;
            font-size: 15px;
            color: var(--sidebar-text) !important;
            transition: all 0.2s;
        }
        .sidebar .nav-link:hover i {
            color: #ffffff !important;
        }
        .sidebar .nav-link.active i { 
            color: #fca5a5 !important;
        }

        .sidebar .nav-link.text-danger { color: #f87171 !important; }
        .sidebar .nav-link.text-danger:hover {
            background: rgba(239, 68, 68, 0.15) !important;
            color: #fca5a5 !important;
        }
        
        .sidebar-profile {
            margin-top: auto;
            padding: 20px;
            border-top: 1px solid rgba(239, 68, 68, 0.2);
            background: rgba(239, 68, 68, 0.05);
        }
        .sidebar-profile-content {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .sidebar-profile-img {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(239, 68, 68, 0.3);
        }
        .sidebar-profile-info {
            flex: 1;
            min-width: 0;
        }
        .sidebar-profile-name {
            font-weight: 600;
            font-size: 14px;
            color: #ffffff;
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .sidebar-profile-role {
            font-size: 11px;
            color: #94a3b8;
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .sidebar-profile-logout {
            margin-top: 12px;
        }
        .sidebar-profile-logout button {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid rgba(239, 68, 68, 0.3);
            background: rgba(239, 68, 68, 0.1);
            color: #f87171;
            font-weight: 500;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .sidebar-profile-logout button:hover {
            background: rgba(239, 68, 68, 0.2);
            border-color: rgba(239, 68, 68, 0.5);
            color: #fca5a5;
        }
        
        .main-content { 
            margin-left: 260px; 
            min-height: 100vh;
        }
        
        .topbar { 
            background: rgba(255,255,255,0.98);
            backdrop-filter: blur(20px);
            padding: 14px 28px; 
            box-shadow: 0 4px 30px rgba(153, 27, 27, 0.08);
            border-bottom: 2px solid #fee2e2;
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .role-badge {
            background: var(--gradient-primary);
            color: white !important;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-left: 10px;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
        }
        
        .stat-card { 
            background: white; 
            border-radius: 16px; 
            padding: 25px; 
            box-shadow: var(--shadow-sm);
            border: 1px solid #fee2e2;
            border-left: 4px solid #ef4444;
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
            border-color: #ef4444;
        }
        .stat-card h3 { 
            font-family: 'Poppins', sans-serif;
            font-size: 32px; 
            font-weight: 700; 
            margin: 10px 0 5px;
            color: var(--ink);
        }
        .stat-card p { 
            color: var(--slate); 
            margin: 0; 
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }
        .stat-card .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(220, 38, 38, 0.1));
            color: #ef4444;
        }
        
        .content-card { 
            background: white; 
            border-radius: var(--radius); 
            padding: 28px; 
            box-shadow: var(--shadow-sm);
            margin-bottom: 20px;
            border: 1px solid rgba(239, 68, 68, 0.1);
        }
        
        .btn-primary-custom {
            background: var(--gradient-primary);
            border: none;
            color: white !important;
            font-weight: 600;
            padding: 9px 20px;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.3);
            transition: all 0.3s;
        }
        .btn-primary-custom:hover {
            color: white !important;
            transform: translateY(-3px);
            box-shadow: 0 10px 28px rgba(239, 68, 68, 0.4);
            filter: brightness(1.1);
        }

        .table thead th {
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
            font-weight: 700;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: var(--pro);
            border-bottom: 2px solid #fecaca;
            padding: 14px 12px;
        }
        .table tbody td {
            padding: 14px 12px;
            vertical-align: middle;
            color: var(--slate);
            font-size: 14px;
        }
        .table-hover tbody tr:hover { background-color: #fef2f2 !important; }

        .dropdown-item {
            color: var(--slate) !important;
            transition: all 0.2s;
        }
        .dropdown-item:hover {
            background-color: #fef2f2 !important;
            color: #ef4444 !important;
        }
        .dropdown-item.text-danger:hover {
            background-color: #fef2f2 !important;
            color: #dc2626 !important;
        }

        .badge {
            font-weight: 600;
            padding: 6px 10px;
            font-size: 11px;
            letter-spacing: 0.3px;
        }
        
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
            .topbar { padding: 12px 16px; }
            .topbar h5 { font-size: 1rem !important; }
            .role-badge { padding: 3px 8px; font-size: 9px; }
        }
        
        @media (max-width: 480px) {
            .topbar { padding: 10px 12px; }
            .topbar h5 { font-size: 0.95rem !important; }
            .role-badge { padding: 2px 6px; font-size: 8px; }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <h4><i class="fas fa-heartbeat"></i> SIKES</h4>
            <small>Dashboard Petugas UKS</small>
        </div>
        
        <div class="sidebar-section">Menu Utama</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('petugas.dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('petugas.dashboard')); ?>">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
        </ul>
        
        <div class="sidebar-section">Pelayanan</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('petugas.examinations.create') ? 'active' : ''); ?>" href="<?php echo e(route('petugas.examinations.create')); ?>">
                    <i class="fas fa-plus-circle"></i> Input Kunjungan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('petugas.examinations.index') ? 'active' : ''); ?>" href="<?php echo e(route('petugas.examinations.index')); ?>">
                    <i class="fas fa-clipboard-list"></i> Data Kunjungan
                </a>
            </li>
        </ul>

        <div class="sidebar-section">Laporan & Statistik</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('petugas.examinations.recap') ? 'active' : ''); ?>" href="<?php echo e(route('petugas.examinations.recap')); ?>">
                    <i class="fas fa-chart-bar"></i> Rekapan Kunjungan
                </a>
            </li>
        </ul>
        
        <div class="sidebar-section">Manajemen</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('petugas.users.*') ? 'active' : ''); ?>" href="<?php echo e(route('petugas.users.index')); ?>">
                    <i class="fas fa-users-cog"></i> Kelola User
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('petugas.medicines.*') ? 'active' : ''); ?>" href="<?php echo e(route('petugas.medicines.index')); ?>">
                    <i class="fas fa-pills"></i> Data Obat
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('petugas.students.index') ? 'active' : ''); ?>" href="<?php echo e(route('petugas.students.index')); ?>">
                    <i class="fas fa-user-graduate"></i> Data Siswa
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('petugas.piket.*') ? 'active' : ''); ?>" href="<?php echo e(route('petugas.piket.index')); ?>">
                    <i class="fas fa-calendar-alt"></i> Jadwal Piket
                </a>
            </li>
        </ul>

        <div class="sidebar-section">Inventaris</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('petugas.items.*') ? 'active' : ''); ?>" href="<?php echo e(route('petugas.items.index')); ?>">
                    <i class="fas fa-boxes"></i> Data Barang
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('petugas.borrowings.*') ? 'active' : ''); ?>" href="<?php echo e(route('petugas.borrowings.index')); ?>">
                    <i class="fas fa-hand-holding-medical"></i> Peminjaman
                </a>
            </li>
        </ul>

        <div class="sidebar-section">Edukasi & Informasi</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('petugas.health-tips.*') ? 'active' : ''); ?>" href="<?php echo e(route('petugas.health-tips.index')); ?>">
                    <i class="fas fa-lightbulb"></i> Tips Kesehatan
                </a>
            </li>
        </ul>

        <div class="sidebar-section">Sistem</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?php echo e(request()->routeIs('petugas.settings.*') ? 'active' : ''); ?>" href="<?php echo e(route('petugas.settings.index')); ?>">
                    <i class="fas fa-cog"></i> Pengaturan
                </a>
            </li>
        </ul>
        
        <div class="sidebar-profile">
            <div class="sidebar-profile-content">
                <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode(auth()->user()->name)); ?>&background=ef4444&color=ffffff&bold=true" 
                     alt="<?php echo e(auth()->user()->name); ?>" 
                     class="sidebar-profile-img">
                <div class="sidebar-profile-info">
                    <p class="sidebar-profile-name"><?php echo e(auth()->user()->name); ?></p>
                    <p class="sidebar-profile-role">Petugas UKS</p>
                </div>
            </div>
            <div class="sidebar-profile-logout">
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <div class="topbar">
            <div class="d-flex align-items-center flex-grow-1">
                
                <button class="btn btn-light d-md-none me-3" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                
                <h5 class="mb-0 fw-bold text-dark">
                    <?php echo $__env->yieldContent('page-title', 'Dashboard'); ?>
                    <span class="role-badge">Petugas</span>
                </h5>
            </div>

            
            <div>
                <a href="<?php echo e(route('landing')); ?>" class="btn btn-sm btn-light border text-danger fw-semibold" title="Kembali ke Beranda" style="border-color: #fecaca !important;">
                    <i class="fas fa-home"></i> 
                    <span class="d-none d-md-inline ms-1">Beranda</span>
                </a>
            </div>
        </div>

        <div class="p-3 p-md-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert" style="background: #ecfdf5; color: #065f46; border-left: 4px solid #10b981 !important;">
                    <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert" style="background: #fef2f2; color: #991b1b; border-left: 4px solid #ef4444 !important;">
                    <i class="fas fa-exclamation-circle me-2"></i><?php echo e(session('error')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const sidebarLinks = document.querySelectorAll('.sidebar .nav-link');
            
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 768) {
                        setTimeout(() => {
                            sidebar.classList.remove('show');
                        }, 150);
                    }
                });
            });
            
            mainContent.addEventListener('click', function(e) {
                if (window.innerWidth <= 768 && sidebar.classList.contains('show')) {
                    if (!e.target.closest('.dropdown') && !e.target.closest('.btn')) {
                        sidebar.classList.remove('show');
                    }
                }
            });
        });
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH /home/zephyr/Downloads/sikes-main/resources/views/layouts/petugas.blade.php ENDPATH**/ ?>