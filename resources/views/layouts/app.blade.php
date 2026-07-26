<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - SIKES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f3f4f6; font-family: 'Segoe UI', sans-serif; }
        .sidebar { 
            width: 260px; background-color: #1e293b; min-height: 100vh; 
            position: fixed; left: 0; top: 0; color: white; z-index: 1000;
        }
        .sidebar .nav-link { color: #cbd5e1; padding: 12px 20px; border-radius: 8px; margin: 4px 10px; }
        .sidebar .nav-link:hover { background-color: #334155; color: white; }
        .sidebar .nav-link.active { background-color: #2563EB; color: white; }
        .sidebar .nav-link i { width: 25px; }
        .main-content { margin-left: 260px; padding: 20px; }
        .topbar { background: white; padding: 15px 25px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .stat-card { background: white; border-radius: 12px; padding: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); border-left: 4px solid #2563EB; }
        .stat-card h3 { font-size: 28px; font-weight: bold; margin: 0; }
        .stat-card p { color: #64748b; margin: 0; font-size: 14px; }
        .content-card { background: white; border-radius: 12px; padding: 25px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar p-3">
        <h4 class="text-white fw-bold mb-4 px-2">
            <i class="fas fa-heartbeat me-2"></i> SIKES
        </h4>
        
        @if(auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin'))
            <!-- Menu Admin -->
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.students.*') ? 'active' : '' }}" href="{{ route('admin.students.index') }}"><i class="fas fa-user-graduate"></i> Data Siswa</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.examinations.*') ? 'active' : '' }}" href="{{ route('admin.examinations.index') }}"><i class="fas fa-clipboard-list"></i> Data Kunjungan</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.medicines.*') ? 'active' : '' }}" href="{{ route('admin.medicines.index') }}"><i class="fas fa-pills"></i> Data Obat</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.cms.*') ? 'active' : '' }}" href="{{ route('admin.cms.index') }}"><i class="fas fa-globe"></i> CMS Website</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}"><i class="fas fa-cog"></i> Pengaturan</a></li>
            </ul>
        @elseif(auth()->user()->hasRole('petugas'))
            <!-- Menu Petugas -->
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}" href="{{ route('petugas.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('petugas.examinations.create') ? 'active' : '' }}" href="{{ route('petugas.examinations.create') }}"><i class="fas fa-plus-circle"></i> Input Kunjungan</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('petugas.examinations.index') ? 'active' : '' }}" href="{{ route('petugas.examinations.index') }}"><i class="fas fa-clipboard-list"></i> Data Kunjungan</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('petugas.medicines.*') ? 'active' : '' }}" href="{{ route('petugas.medicines.index') }}"><i class="fas fa-pills"></i> Data Obat</a></li>
            </ul>
        @endif

        <ul class="nav flex-column mt-4">
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
            <h5 class="mb-0 fw-bold">@yield('page-title', 'Dashboard')</h5>
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=2563EB&color=fff" class="rounded-circle me-2" width="35">
                    {{ auth()->user()->name }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Profil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
</body>
</html>