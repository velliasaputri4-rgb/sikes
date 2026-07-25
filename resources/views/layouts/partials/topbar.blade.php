<header class="topbar bg-white shadow-sm py-2 px-4 d-flex justify-content-between align-items-center">
    <button class="btn btn-light d-md-none" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <div class="user-profile dropdown">
        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark" data-bs-toggle="dropdown">
            <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                <i class="fas fa-user"></i>
            </div>
            <div>
                <div class="fw-semibold small">{{ auth()->user()->name }}</div>
                <div class="text-muted" style="font-size: 11px;">{{ auth()->user()->roles->first()->name ?? 'User' }}</div>
            </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end shadow">
            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profil</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</button>
                </form>
            </li>
        </ul>
    </div>
</header>