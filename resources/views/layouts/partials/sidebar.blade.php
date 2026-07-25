<aside class="sidebar bg-white shadow-sm" id="sidebar">
    <div class="sidebar-header p-3 border-bottom d-flex align-items-center">
        <i class="fas fa-heartbeat text-primary fa-2x me-2"></i>
        <h5 class="mb-0 fw-bold text-primary">SIKES</h5>
    </div>

    <nav class="sidebar-nav p-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </a>
            </li>

            @role('super-admin|admin|petugas')
            <li class="nav-title text-muted small fw-bold mt-3 mb-1 px-2">PELAYANAN</li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-stethoscope me-2"></i> Pemeriksaan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-pills me-2"></i> Manajemen Obat
                </a>
            </li>
            @endrole

            @role('super-admin|admin')
            <li class="nav-title text-muted small fw-bold mt-3 mb-1 px-2">DATA MASTER</li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-user-graduate me-2"></i> Data Siswa
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-user-nurse me-2"></i> Data Petugas
                </a>
            </li>
            @endrole

            @role('super-admin')
            <li class="nav-title text-muted small fw-bold mt-3 mb-1 px-2">SISTEM</li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-users-cog me-2"></i> Manajemen User
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-cogs me-2"></i> Pengaturan
                </a>
            </li>
            @endrole
        </ul>
    </nav>
</aside>