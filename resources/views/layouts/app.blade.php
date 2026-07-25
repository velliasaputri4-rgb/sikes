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
        <h4 class="text-white fw-bold mb-4 px-2"><i class="fas fa-heartbeat me-2"></i> SIKES</h4>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('examinations.*') ? 'active' : '' }}" href="{{ route('examinations.index') }}">
        <i class="fas fa-clipboard-list"></i> Data Kunjungan
    </a>
</li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-user-nurse"></i> Data Petugas</a></li>
               <li class="nav-item">
       <a class="nav-link {{ request()->routeIs('medicines.*') ? 'active' : '' }}" href="{{ route('medicines.index') }}">
           <i class="fas fa-pills"></i> Data Obat
       </a>
   </li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-file-medical"></i> Rekam Medis</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-boxes"></i> Inventaris</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-chart-bar"></i> Rekapan Bulanan</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-file-export"></i> Laporan</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-cog"></i> Setting</a></li>
            <li class="nav-item mt-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start"><i class="fas fa-sign-out-alt"></i> Logout</button>
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