<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Petugas UKS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #10b981;
            --primary-dark: #059669;
            --sidebar-bg: #064e3b;
        }
        body { 
            background-color: #f1f5f9; 
            font-family: 'Segoe UI', sans-serif;
            overflow-x: hidden;
        }
        
        /* Sidebar */
        .sidebar { 
            width: 260px; 
            background: linear-gradient(180deg, var(--sidebar-bg) 0%, #065f46 100%);
            height: 100vh; /* Tinggi pas dengan layar */
            position: fixed; 
            left: 0; 
            top: 0; 
            color: white; 
            z-index: 1000;
            transition: all 0.3s;
            
            /* FITUR SCROLL */
            overflow-y: auto; 
            overflow-x: hidden;
            padding-bottom: 30px;
        }

        /* Custom Scrollbar untuk Sidebar agar rapi */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.4);
        }

        .sidebar-brand {
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar-brand h4 {
            margin: 0;
            font-weight: 700;
        }
        .sidebar-brand small {
            opacity: 0.7;
            font-size: 11px;
        }
        .sidebar .nav-link { 
            color: #d1fae5; 
            padding: 12px 20px; 
            border-radius: 8px; 
            margin: 4px 12px;
            font-size: 14px;
            transition: all 0.2s;
        }
        .sidebar .nav-link:hover { 
            background-color: rgba(255,255,255,0.1); 
            color: white;
            transform: translateX(3px);
        }
        .sidebar .nav-link.active { 
            background-color: var(--primary); 
            color: white;
            font-weight: 600;
        }
        .sidebar .nav-link i { 
            width: 22px;
            margin-right: 10px;
        }
        .sidebar-section {
            padding: 15px 20px 8px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.5;
            font-weight: 600;
        }
        
        /* Main Content */
        .main-content { 
            margin-left: 260px; 
            min-height: 100vh;
        }
        
        /* Topbar */
        .topbar { 
            background: white; 
            padding: 15px 25px; 
            box-shadow: 0 2px 5px rgba(0,0,0,0.05); 
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        /* Cards */
        .stat-card { 
            background: white; 
            border-radius: 12px; 
            padding: 25px; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.04);
            border-left: 4px solid var(--primary);
            transition: transform 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-3px);
        }
        .stat-card h3 { 
            font-size: 32px; 
            font-weight: 700; 
            margin: 10px 0 5px;
        }
        .stat-card p { 
            color: #64748b; 
            margin: 0; 
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .stat-card .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }
        
        .content-card { 
            background: white; 
            border-radius: 12px; 
            padding: 25px; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.04);
            margin-bottom: 20px;
        }
        
        /* Buttons */
        .btn-primary-custom {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }
        .btn-primary-custom:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
            color: white;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <h4><i class="fas fa-heartbeat me-2"></i> SIKES</h4>
            <small>Dashboard Petugas UKS</small>
        </div>
        
        <div class="sidebar-section">Menu Utama</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}" href="{{ route('petugas.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
        </ul>
        
        <div class="sidebar-section">Pelayanan</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('petugas.examinations.create') ? 'active' : '' }}" href="{{ route('petugas.examinations.create') }}">
                    <i class="fas fa-plus-circle"></i> Input Kunjungan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('petugas.examinations.index') ? 'active' : '' }}" href="{{ route('petugas.examinations.index') }}">
                    <i class="fas fa-clipboard-list"></i> Data Kunjungan
                </a>
            </li>
        </ul>
        
        <div class="sidebar-section">Manajemen</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('petugas.medicines.*') ? 'active' : '' }}" href="{{ route('petugas.medicines.index') }}">
                    <i class="fas fa-pills"></i> Data Obat
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('petugas.students.index') ? 'active' : '' }}" href="{{ route('petugas.students.index') }}">
                    <i class="fas fa-user-graduate"></i> Data Siswa
                </a>
            </li>
        </ul>

        <!-- ✅ BAGIAN INVENTARIS DIPISAHKAN DENGAN BENAR -->
        <div class="sidebar-section">Inventaris</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('petugas.items.*') ? 'active' : '' }}" href="{{ route('petugas.items.index') }}">
                    <i class="fas fa-boxes"></i> Data Barang
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('petugas.borrowings.*') ? 'active' : '' }}" href="{{ route('petugas.borrowings.index') }}">
                    <i class="fas fa-hand-holding-medical"></i> Peminjaman
                </a>
            </li>
        </ul>
        
        <div class="sidebar-section">Akun</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('petugas.profile.edit') }}">
                    <i class="fas fa-user-circle"></i> Profil Saya
                </a>
            </li>
            <li class="nav-item mt-3">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <div class="d-flex align-items-center">
                <button class="btn btn-light d-md-none me-3" onclick="document.getElementById('sidebar').classList.toggle('show')">
                    <i class="fas fa-bars"></i>
                </button>
                <h5 class="mb-0 fw-bold text-dark">@yield('page-title', 'Dashboard')</h5>
            </div>
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=10b981&color=fff" class="rounded-circle me-2" width="35">
                    <div class="text-start d-none d-md-block">
                        <div class="fw-semibold small">{{ auth()->user()->name }}</div>
                        <div class="text-muted" style="font-size: 11px;">Petugas UKS</div>
                    </div>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li><a class="dropdown-item" href="{{ route('petugas.profile.edit') }}"><i class="fas fa-user me-2"></i>Profil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Content -->
        <div class="p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
</body>
</html>