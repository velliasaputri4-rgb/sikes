<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Obat - SIKES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #2563EB;
            --secondary: #1e40af;
            --success: #10b981;
            --info: #3b82f6;
        }
        body { 
            font-family: 'Segoe UI', 'Inter', system-ui, sans-serif;
            background: linear-gradient(135deg, #f0f7ff 0%, #e0f2fe 100%);
            min-height: 100vh;
            color: #1e293b;
        }
        
        /* Navbar */
        .navbar { 
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
            background: white !important;
            padding: 15px 0;
        }
        .navbar-brand { 
            font-weight: 700; 
            color: var(--primary) !important;
            font-size: 1.5rem;
        }
        .nav-link {
            font-weight: 500;
            color: #475569 !important;
            padding: 8px 16px !important;
            transition: all 0.3s;
        }
        .nav-link:hover, .nav-link.active {
            color: var(--primary) !important;
            background: rgba(37, 99, 235, 0.1);
            border-radius: 8px;
        }

        /* Page Header */
        .page-header { 
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); 
            padding: 80px 0 100px;
            color: #1e293b;
        }
        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 10px;
        }
        .page-header p {
            color: #64748b;
            font-size: 1.1rem;
        }
        
        .section { padding: 60px 0; }
        
        /* Medicine Cards */
        .medicine-card { 
            background: white; 
            border-radius: 16px; 
            padding: 25px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.06); 
            transition: all 0.3s ease; 
            height: 100%;
            border-left: 4px solid var(--success);
        }
        .medicine-card:hover { 
            transform: translateY(-5px); 
            box-shadow: 0 12px 35px rgba(16, 185, 129, 0.15); 
        }
        
        /* Footer */
        footer { 
            background: linear-gradient(135deg, #0f172a, #1e293b); 
            color: white; 
            padding: 60px 0 30px;
            margin-top: 80px;
        }
        footer a { color: #cbd5e1; text-decoration: none; transition: color 0.3s; }
        footer a:hover { color: white; }
        .footer-bottom { 
            border-top: 1px solid #334155; 
            margin-top: 40px; 
            padding-top: 25px;
            text-align: center;
            color: #94a3b8;
        }
    </style>
</head>
<body>

    <!-- Navbar (Konsisten dengan halaman lain) -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('landing') }}">
                <i class="fas fa-heartbeat me-2"></i> SIKES
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing.about') }}">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('landing.medicines') }}">Informasi Obat</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing.schedule') }}">Jadwal Petugas</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing.contact') }}">Kontak</a></li>
                    <li class="nav-item ms-3">
                        <div class="dropdown">
                            <button class="btn btn-primary rounded-circle" type="button" data-bs-toggle="dropdown" style="width: 40px; height: 40px; padding: 0;">
                                <i class="fas fa-user"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                <li><a class="dropdown-item" href="{{ route('login.admin') }}"><i class="fas fa-user-shield me-2 text-primary"></i>Login Admin</a></li>
                                <li><a class="dropdown-item" href="{{ route('login.petugas') }}"><i class="fas fa-user-nurse me-2 text-success"></i>Login Petugas</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-center small" href="{{ route('login.siswa') }}"><i class="fas fa-user-graduate me-1 text-info"></i>Login Siswa</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <section class="page-header text-center">
        <div class="container position-relative">
            <div class="d-inline-block bg-white bg-opacity-50 px-3 py-1 rounded-pill mb-3">
                <small class="text-primary fw-semibold"><i class="fas fa-pills me-2"></i>Stok & Informasi</small>
            </div>
            <h1 class="fw-bold">Informasi Obat</h1>
            <p class="mb-0">Daftar obat-obatan dan alat kesehatan yang tersedia di UKS</p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="section">
        <div class="container">
            <div class="row g-4">
                @forelse($medicines as $med)
                    <div class="col-md-6 col-lg-4">
                        <div class="medicine-card">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h5 class="fw-bold mb-0 text-dark">{{ $med->name }}</h5>
                                @php
                                    $stockStatus = $med->stock <= ($med->minimum_stock ?? 5) ? 'bg-warning text-dark' : 'bg-success';
                                    $stockText = $med->stock <= ($med->minimum_stock ?? 5) ? 'Menipis' : 'Tersedia';
                                @endphp
                                <span class="badge {{ $stockStatus }} rounded-pill">{{ $stockText }}</span>
                            </div>
                            
                            <div class="mb-2">
                                <span class="text-muted small"><i class="fas fa-tag me-1 text-primary"></i> {{ $med->category->name ?? 'Umum' }}</span>
                            </div>
                            
                            <hr class="my-3 opacity-10">
                            
                            <div class="row g-2 text-muted small">
                                <div class="col-6">
                                    <i class="fas fa-cube me-1"></i> Satuan: <strong class="text-dark">{{ $med->unit }}</strong>
                                </div>
                                <div class="col-6">
                                    <i class="fas fa-boxes me-1"></i> Stok: <strong class="text-dark">{{ $med->stock }}</strong>
                                </div>
                                @if($med->expired_date)
                                    <div class="col-12 mt-1">
                                        <i class="fas fa-calendar-alt me-1"></i> Exp: <strong class="text-dark">{{ \Carbon\Carbon::parse($med->expired_date)->format('d M Y') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px; box-shadow: 0 4px 15px rgba(0,0,0,0.06);">
                            <i class="fas fa-box-open fa-3x text-muted opacity-25"></i>
                        </div>
                        <h5 class="text-muted fw-bold">Belum ada data obat</h5>
                        <p class="text-muted">Data obat akan segera ditambahkan oleh petugas UKS.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($medicines->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $medicines->links() }}
                </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3 text-white"><i class="fas fa-heartbeat me-2 text-success"></i> SIKES</h5>
                    <p class="text-light opacity-75">Sistem Informasi Unit Kesehatan Sekolah yang modern dan terpercaya untuk meningkatkan kesehatan siswa.</p>
                </div>
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3 text-white">Menu Cepat</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('landing') }}" class="text-light opacity-75">Beranda</a></li>
                        <li class="mb-2"><a href="{{ route('landing.about') }}" class="text-light opacity-75">Tentang</a></li>
                        <li class="mb-2"><a href="{{ route('landing.medicines') }}" class="text-light opacity-75">Informasi Obat</a></li>
                        <li class="mb-2"><a href="{{ route('landing.schedule') }}" class="text-light opacity-75">Jadwal Petugas</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3 text-white">Kontak</h5>
                    <ul class="list-unstyled text-light opacity-75">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2 text-success"></i> Jl. Pendidikan No. 123</li>
                        <li class="mb-2"><i class="fas fa-phone me-2 text-success"></i> (021) 1234567</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2 text-success"></i> uks@sekolah.sch.id</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="mb-0 text-light opacity-50">&copy; {{ date('Y') }} SIKES - Sistem Informasi UKS. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>