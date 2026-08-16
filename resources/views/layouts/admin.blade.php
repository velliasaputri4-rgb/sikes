<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Admin SIKES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        :root {
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
            font-family: 'Segoe UI', system-ui, sans-serif;
            overflow-x: hidden;
        }
        .sidebar { 
            width: 260px; 
            background: linear-gradient(180deg, var(--sidebar-bg) 0%, #111827 100%);
            height: 100vh;
            position: fixed; 
            left: 0; top: 0; 
            color: white; z-index: 1000;
            overflow-y: auto; padding-bottom: 30px;
            box-shadow: 4px 0 20px rgba(15, 23, 42, 0.2);
        }
        .sidebar::-webkit-scrollbar { width: 6px; }
        .sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.15); border-radius: 10px; }
        
        .sidebar-brand {
            padding: 22px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            background: rgba(0, 0, 0, 0.2);
        }
        .sidebar-brand h4 { margin: 0; font-weight: 800; display: flex; align-items: center; gap: 10px; }
        .sidebar-brand h4 i { color: #f59e0b; }
        .sidebar-brand small { opacity: 0.6; font-size: 10px; letter-spacing: 2px; color: #f59e0b; display: block; margin-top: 4px; }

        .sidebar-section {
            padding: 18px 20px 8px 32px;
            font-size: 10px; text-transform: uppercase; letter-spacing: 1.8px;
            opacity: 0.45; font-weight: 700; color: #94a3b8;
        }
        .sidebar .nav-link { 
            color: var(--sidebar-text); padding: 11px 18px; border-radius: 8px; 
            margin: 2px 12px; font-size: 14px; font-weight: 500;
            transition: all 0.2s ease; display: flex; align-items: center;
        }
        .sidebar .nav-link:hover { background-color: var(--sidebar-hover); color: white; transform: translateX(3px); }
        .sidebar .nav-link.active { 
            background: linear-gradient(90deg, #1e293b 0%, #334155 100%);
            color: white; font-weight: 600; box-shadow: 0 4px 12px rgba(0,0,0,0.25);
            border-left: 3px solid #f59e0b;
        }
        .sidebar .nav-link i { width: 22px; margin-right: 12px; }
        .sidebar .nav-link.active i { color: #f59e0b; }
        .sidebar .nav-link.text-danger { color: #f87171 !important; }

        .main-content { margin-left: 260px; min-height: 100vh; }
        .topbar { 
            background: white; padding: 14px 28px; 
            box-shadow: 0 1px 3px rgba(15,23,42,0.06);
            display: flex; justify-content: space-between; align-items: center;
            position: sticky; top: 0; z-index: 100;
            border-bottom: 2px solid #f59e0b;
        }
        .admin-badge {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white; padding: 4px 10px; border-radius: 20px;
            font-size: 10px; font-weight: 700; letter-spacing: 1px; margin-left: 10px;
        }

        .stat-card { 
            background: white; border-radius: 12px; padding: 25px; 
            box-shadow: 0 1px 3px rgba(15,23,42,0.05);
            border-left: 4px solid var(--primary); transition: all 0.25s ease;
        }
        .stat-card:hover { transform: translateY(-4px); box-shadow: 0 10px 25px rgba(15,23,42,0.1); }
        .stat-card h3 { font-size: 32px; font-weight: 700; margin: 10px 0 5px; color: var(--navy-900); }
        .stat-card p { color: #64748b; margin: 0; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; }
        .stat-card .stat-icon {
            width: 50px; height: 50px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center; font-size: 22px;
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); color: var(--primary);
        }
        
        .content-card { 
            background: white; border-radius: 12px; padding: 28px; 
            box-shadow: 0 1px 3px rgba(15,23,42,0.05); margin-bottom: 20px; border: 1px solid #f1f5f9;
        }
        
        .menu-cepat-card {
            background: white; border-radius: 12px; padding: 25px 15px; text-align: center;
            text-decoration: none; color: #334155; border: 2px solid #f1f5f9;
            transition: all 0.3s ease; display: block; height: 100%;
        }
        .menu-cepat-card:hover {
            transform: translateY(-5px); box-shadow: 0 10px 25px rgba(15,23,42,0.1);
            border-color: #f59e0b; color: #1e293b;
        }
        .menu-cepat-card .icon-wrap {
            width: 60px; height: 60px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 12px; font-size: 24px;
        }
        .menu-cepat-card .label { font-weight: 600; font-size: 14px; }

        .table thead th {
            background: #f8fafc; font-weight: 700; font-size: 11px;
            text-transform: uppercase; letter-spacing: 0.8px; color: #475569;
            border-bottom: 2px solid #e2e8f0; padding: 14px 12px;
        }
        .table-hover tbody tr:hover { background-color: #fffbeb; }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
    </style>
</head>
<body>

    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <h4><i class="fas fa-shield-alt"></i> SIKES</h4>
            <small>Admin Panel</small>
        </div>
        
        <div class="sidebar-section">Menu Utama</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
        </ul>
        
        <div class="sidebar-section">Master Data</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.students.*') ? 'active' : '' }}" href="{{ route('admin.students.index') }}">
                    <i class="fas fa-user-graduate"></i> Data Siswa
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.examinations.*') ? 'active' : '' }}" href="{{ route('admin.examinations.index') }}">
                    <i class="fas fa-clipboard-list"></i> Data Kunjungan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.medicines.*') ? 'active' : '' }}" href="{{ route('admin.medicines.index') }}">
                    <i class="fas fa-pills"></i> Data Obat
                </a>
            </li>
        </ul>

        <div class="sidebar-section">Manajemen</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                    <i class="fas fa-users-cog"></i> Kelola User
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.cms*') ? 'active' : '' }}" href="{{ route('admin.cms.index') }}">
                    <i class="fas fa-globe"></i> CMS Website
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
                    <i class="fas fa-cog"></i> Pengaturan
                </a>
            </li>
        </ul>
        
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

    <div class="main-content">
        <div class="topbar">
            <div class="d-flex align-items-center">
                <button class="btn btn-light d-md-none me-3" onclick="document.getElementById('sidebar').classList.toggle('show')">
                    <i class="fas fa-bars"></i>
                </button>
                <h5 class="mb-0 fw-bold text-dark">
                    @yield('page-title', 'Dashboard')
                    <span class="admin-badge">Admin</span>
                </h5>
            </div>
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle d-flex align-items-center border-0" type="button" data-bs-toggle="dropdown">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=f59e0b&color=ffffff&bold=true" 
                         class="rounded-circle me-2" width="38" height="38">
                    <div class="text-start d-none d-md-block">
                        <div class="fw-semibold small text-dark">{{ auth()->user()->name }}</div>
                        <div class="text-muted" style="font-size: 11px;">Administrator</div>
                    </div>
                </button>
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