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
            /* TEMA NAVY + GOLD (sama persis dengan admin) */
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --accent-gold: #f59e0b;
            --navy-900: #0f172a;
            --navy-800: #1e293b;
            --navy-700: #334155;
            --sidebar-bg: #0c1324;
            --sidebar-hover: rgba(245, 158, 11, 0.12);
            --sidebar-text: #cbd5e1;
            --sidebar-text-active: #ffffff;
        }
        
        body { 
            background-color: #f1f5f9; 
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            overflow-x: hidden;
            color: #1e293b;
        }
        
        /* SIDEBAR NAVY GELAP + AKSEN GOLD */
        .sidebar { 
            width: 260px; 
            background: linear-gradient(180deg, var(--sidebar-bg) 0%, #111827 100%);
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
            box-shadow: 4px 0 20px rgba(15, 23, 42, 0.2);
        }

        .sidebar::-webkit-scrollbar { width: 6px; }
        .sidebar::-webkit-scrollbar-track { background: rgba(255,255,255,0.03); }
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.15);
            border-radius: 10px;
        }
        .sidebar::-webkit-scrollbar-thumb:hover { background: rgba(245, 158, 11, 0.4); }

        /* Brand dengan aksen GOLD */
        .sidebar-brand {
            padding: 22px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            background: rgba(0, 0, 0, 0.2);
        }
        .sidebar-brand h4 {
            margin: 0;
            font-weight: 800;
            font-size: 1.4rem;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .sidebar-brand h4 i {
            color: #f59e0b;
            font-size: 1.5rem;
        }
        .sidebar-brand small {
            font-size: 10px;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: 4px;
            display: block;
            color: #f59e0b;
            opacity: 0.9;
        }

        .sidebar-section {
            padding: 18px 20px 8px 32px;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1.8px;
            opacity: 0.45;
            font-weight: 700;
            color: #94a3b8;
        }
        
        .sidebar .nav-link { 
            color: var(--sidebar-text); 
            padding: 11px 18px; 
            border-radius: 8px; 
            margin: 2px 12px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            position: relative;
        }
        .sidebar .nav-link:hover { 
            background-color: var(--sidebar-hover);
            color: var(--sidebar-text-active);
            transform: translateX(3px);
        }
        /* Menu aktif: gradient slate + border kiri GOLD + icon GOLD */
        .sidebar .nav-link.active { 
            background: linear-gradient(90deg, #1e293b 0%, #334155 100%);
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
            border-left: 3px solid #f59e0b;
        }
        .sidebar .nav-link i { 
            width: 22px;
            margin-right: 12px;
            font-size: 15px;
        }
        .sidebar .nav-link.active i { color: #f59e0b; }

        .sidebar .nav-link.text-danger { color: #f87171 !important; }
        .sidebar .nav-link.text-danger:hover {
            background: rgba(239, 68, 68, 0.15) !important;
            color: #fca5a5 !important;
        }
        
        /* MAIN CONTENT */
        .main-content { 
            margin-left: 260px; 
            min-height: 100vh;
        }
        
        /* Topbar dengan garis bawah GOLD */
        .topbar { 
            background: white; 
            padding: 14px 28px; 
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.06); 
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 2px solid #f59e0b;
        }

        /* Badge role GOLD */
        .role-badge {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-left: 10px;
        }
        
        /* STAT CARDS */
        .stat-card { 
            background: white; 
            border-radius: 12px; 
            padding: 25px; 
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.05);
            border-left: 4px solid var(--primary);
            transition: all 0.25s ease;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(15, 23, 42, 0.1);
        }
        .stat-card h3 { 
            font-size: 32px; 
            font-weight: 700; 
            margin: 10px 0 5px;
            color: var(--navy-900);
        }
        .stat-card p { 
            color: #64748b; 
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
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            color: var(--primary);
        }
        
        .content-card { 
            background: white; 
            border-radius: 12px; 
            padding: 28px; 
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.05);
            margin-bottom: 20px;
            border: 1px solid #f1f5f9;
        }
        
        /* Buttons */
        .btn-primary-custom {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            border: none;
            color: white;
            font-weight: 600;
            padding: 9px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
            transition: all 0.2s ease;
        }
        .btn-primary-custom:hover {
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(37, 99, 235, 0.4);
        }

        /* Table */
        .table thead th {
            background: #f8fafc;
            font-weight: 700;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #475569;
            border-bottom: 2px solid #e2e8f0;
            padding: 14px 12px;
        }
        .table tbody td {
            padding: 14px 12px;
            vertical-align: middle;
            color: #334155;
            font-size: 14px;
        }
        .table-hover tbody tr:hover { background-color: #fffbeb; }

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
        
        {{-- HAPUS BAGIAN AKUN (PROFIL SAYA) --}}
        <div class="sidebar-section">Akun</div>
        <ul class="nav flex-column">
            <li class="nav-item">
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
                <h5 class="mb-0 fw-bold text-dark">
                    @yield('page-title', 'Dashboard')
                    <span class="role-badge">Petugas</span>
                </h5>
            </div>
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle d-flex align-items-center border-0" type="button" data-bs-toggle="dropdown">
                    {{-- Avatar GOLD --}}
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=f59e0b&color=ffffff&bold=true" 
                         class="rounded-circle me-2" width="38" height="38">
                    <div class="text-start d-none d-md-block">
                        <div class="fw-semibold small text-dark">{{ auth()->user()->name }}</div>
                        <div class="text-muted" style="font-size: 11px;">Petugas UKS</div>
                    </div>
                </button>
                {{-- DROPDOWN: HAPUS MENU PROFIL, TINGGAL LOGOUT --}}
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
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
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
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