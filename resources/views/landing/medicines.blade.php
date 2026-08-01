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
        
        /* ✅ SMOOTH SCROLL & OFFSET UNTUK NAVBAR STICKY */
        html {
            scroll-behavior: smooth;
            scroll-padding-top: 80px;
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
            padding: 5px 0; /* ✅ DIKURANGI agar tinggi total navbar tetap sama saat logo membesar */
        }
        .navbar-brand { 
            display: flex;
            align-items: center;
            padding: 0; /* ✅ DIKURANGI agar logo bisa maksimal tanpa mendorong batas navbar */
        }
        .navbar-brand img {
            max-height: 75px; /* ✅ LOGO DIPERBESAR */
            width: auto;
            object-fit: contain;
        }
        
        /* ✅ PENTING: Tambahkan position: relative agar garis bawah bisa diposisikan */
        .nav-link {
            font-weight: 500;
            color: #475569 !important;
            padding: 8px 16px !important;
            transition: all 0.3s;
            position: relative;
        }
        .nav-link:hover, .nav-link.active {
            color: var(--primary) !important;
            background: rgba(37, 99, 235, 0.1);
            border-radius: 8px;
        }
        
        /* ✅ GARIS BAWAH BIRU UNTUK MENU AKTIF */
        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0px;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 3px;
            background-color: var(--primary);
            border-radius: 2px;
            transition: all 0.3s ease;
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
        .footer-bottom { 
            border-top: 1px solid #334155; 
            margin-top: 40px; 
            padding-top: 25px;
            text-align: center;
            color: #94a3b8;
        }

        /* ✅ EFEK HOVER UNTUK MENU CEPAT DI FOOTER */
        .footer-menu a {
            transition: all 0.3s ease;
            display: inline-block;
            text-decoration: none;
        }
        .footer-menu a:hover {
            color: var(--info) !important;
            opacity: 1 !important;
            transform: translateX(8px);
        }
        
        /* ✅ PERBAIKAN SIMETRI & WARNA ICON SERAGAM */
        .footer-contact-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .footer-contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
            gap: 15px;
        }
        .footer-contact-item i {
            font-size: 1.25rem;
            width: 24px;
            text-align: center;
            flex-shrink: 0;
            margin-top: 3px;
            color: #60a5fa !important;
        }
        .footer-contact-item span, 
        .footer-contact-item a {
            color: #cbd5e1;
            opacity: 0.75;
            text-decoration: none;
            transition: all 0.3s ease;
            line-height: 1.6;
        }
        .footer-contact-item a:hover {
            opacity: 1;
            color: var(--info) !important;
        }

        /* ✅ RESPONSIVE UNTUK MOBILE */
        @media (max-width: 768px) {
            .page-header h1 { font-size: 1.8rem; }
            .navbar-brand img { max-height: 60px; } /* ✅ LOGO TETAP PROPORSIONAL DI HP */
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <!-- ✅ HANYA LOGO, UKURAN DIPERBESAR, TANPA TEKS -->
            <a class="navbar-brand" href="{{ route('landing') }}">
                <img src="{{ asset('images/logo sikes navbar.png') }}" alt="Logo SIKES">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <!-- ✅ DINAMIS: Active hanya jika route saat ini adalah 'landing' -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('landing') ? 'active' : '' }}" href="{{ route('landing') }}">Beranda</a>
                    </li>
                    
                    <!-- ✅ Anchor links: Akan di-handle oleh JS di bawah untuk efek active saat diklik -->
                    <li class="nav-item">
                        <a class="nav-link anchor-link" href="{{ route('landing') }}#tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link anchor-link" href="{{ route('landing') }}#layanan">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link anchor-link" href="{{ route('landing') }}#kontak">Kontak</a>
                    </li>
                    
                    <!-- ✅ DINAMIS: Active jika route mengandung 'landing.medicines' -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('landing.medicines*') ? 'active' : '' }}" href="{{ route('landing.medicines') }}">Informasi Obat</a>
                    </li>
                    
                    <!-- ✅ DINAMIS: Active jika route mengandung 'landing.schedule' -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('landing.schedule*') ? 'active' : '' }}" href="{{ route('landing.schedule') }}">Jadwal Petugas</a>
                    </li>

                    <!-- Icon Login dengan Dropdown -->
                    <li class="nav-item ms-3">
                        <div class="dropdown">
                            <button class="btn btn-primary rounded-circle" type="button" data-bs-toggle="dropdown" style="width: 40px; height: 40px; padding: 0;">
                                <i class="fas fa-user"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                <li class="dropdown-header text-center">
                                    <small class="text-muted">Pilih Login</small>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('login.admin') }}">
                                        <i class="fas fa-user-shield me-2 text-primary"></i> Login Admin
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('login.petugas') }}">
                                        <i class="fas fa-user-nurse me-2 text-success"></i> Login Petugas
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-center small" href="{{ route('login.siswa') }}">
                                        <i class="fas fa-user-graduate me-1 text-info"></i> Login Siswa
                                    </a>
                                </li>
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
                                    $stockText = $med->stock <= ($med->minimum_stock ?? 5) ? 'Stok Menipis' : 'Tersedia';
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
            @if(isset($medicines) && method_exists($medicines, 'hasPages') && $medicines->hasPages())
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
                <!-- Kolom 1: Tentang -->
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3 text-white">SIKES</h5>
                    <p class="text-light opacity-75" style="line-height: 1.7;">
                        Sistem Informasi Unit Kesehatan Sekolah yang modern dan terpercaya untuk meningkatkan kesehatan siswa.
                    </p>
                </div>
                
                <!-- Kolom 2: Menu Cepat -->
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3 text-white">Menu Cepat</h5>
                    <ul class="list-unstyled footer-menu">
                        <!-- ✅ DIPERBAIKI: Link anchor sekarang menggunakan route('landing') agar berfungsi dari halaman mana pun -->
                        <li class="mb-2"><a href="{{ route('landing') }}" class="text-light opacity-75">Beranda</a></li>
                        <li class="mb-2"><a href="{{ route('landing') }}#tentang" class="text-light opacity-75">Tentang</a></li>
                        <li class="mb-2"><a href="{{ route('landing') }}#layanan" class="text-light opacity-75">Layanan</a></li>
                        <li class="mb-2"><a href="{{ route('landing') }}#kontak" class="text-light opacity-75">Kontak</a></li>
                        <li class="mb-2"><a href="{{ route('landing.medicines') }}" class="text-light opacity-75">Informasi Obat</a></li>
                        <li class="mb-2"><a href="{{ route('landing.schedule') }}" class="text-light opacity-75">Jadwal Petugas</a></li>
                    </ul>
                </div>
                
                <!-- Kolom 3: Kontak Kami -->
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3 text-white">Kontak Kami</h5>
                    <ul class="footer-contact-list">
                        <li class="footer-contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Komplek SMK Negeri 1 Bangsri<br>Jalan KH. Achmad Fauzan No.17, Bangsri, Jepara<br>Jawa Tengah, 59453</span>
                        </li>
                        <li class="footer-contact-item">
                            <i class="fab fa-instagram"></i>
                            <a href="https://instagram.com/pmrwira_eskasaba" target="_blank">@pmrwira_eskasaba</a>
                        </li>
                        <li class="footer-contact-item">
                            <i class="fab fa-youtube"></i>
                            <a href="https://youtube.com/@wirasandyaadhimukti3463" target="_blank">@wirasandyaadhimukti3463</a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p class="mb-0 text-light opacity-50">&copy; {{ date('Y') }} SIKES - Sistem Informasi UKS. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- ✅ SCRIPT TAMBAHAN: Agar link anchor di navbar juga mendapat efek active saat diklik -->
    <script>
        document.querySelectorAll('.anchor-link').forEach(link => {
            link.addEventListener('click', function() {
                // Hapus class active dari semua nav-link
                document.querySelectorAll('.navbar-nav .nav-link').forEach(l => l.classList.remove('active'));
                // Tambahkan class active ke link yang baru saja diklik
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>