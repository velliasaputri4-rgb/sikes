<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang UKS - SIKES</title>
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
        
        .feature-box { 
            padding: 30px; 
            background: white; 
            border-radius: 16px; 
            margin-bottom: 20px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            transition: transform 0.3s;
            border-left: 4px solid var(--primary);
        }
        .feature-box:hover {
            transform: translateY(-5px);
        }
        .feature-icon { 
            width: 60px; 
            height: 60px; 
            background: linear-gradient(135deg, var(--primary), var(--info)); 
            color: white; 
            border-radius: 12px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 24px; 
            margin-bottom: 15px; 
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

    <!-- Navbar (Sama dengan halaman lain) -->
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
                    <li class="nav-item"><a class="nav-link active" href="{{ route('landing.about') }}">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing.medicines') }}">Informasi Obat</a></li>
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

    <!-- Header -->
    <section class="page-header text-center">
        <div class="container position-relative">
            <div class="d-inline-block bg-white bg-opacity-50 px-3 py-1 rounded-pill mb-3">
                <small class="text-primary fw-semibold"><i class="fas fa-info-circle me-2"></i>Profil UKS</small>
            </div>
            <h1 class="fw-bold">Tentang SIKES</h1>
            <p class="mb-0">Mengenal lebih dekat Unit Kesehatan Sekolah kami</p>
        </div>
    </section>

    <!-- Content -->
    <section class="section">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <img src="https://img.freepik.com/free-vector/healthcare-concept-illustration_23-2148939760.jpg" class="img-fluid rounded-4 shadow-sm">
                </div>
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-3" style="color: #0f172a;">Apa itu SIKES?</h2>
                    <p class="text-muted mb-3">Unit Kesehatan Sekolah (UKS) adalah wahana untuk meningkatkan kemampuan hidup sehat dan selanjutnya membentuk perilaku hidup sehat peserta didik yang berada di sekolah. UKS merupakan usaha kesehatan masyarakat yang dijalankan di sekolah-sekolah.</p>
                    <p class="text-muted">Dengan adanya UKS, diharapkan siswa dapat memperoleh pelayanan kesehatan dasar, pendidikan kesehatan, dan pembinaan lingkungan sekolah sehat.</p>
                </div>
            </div>

            <div class="row g-4 mt-4">
                <div class="col-md-6">
                    <div class="feature-box">
                        <div class="feature-icon"><i class="fas fa-bullseye"></i></div>
                        <h4 class="fw-bold mb-2">Visi</h4>
                        <p class="mb-0 text-muted">Menjadikan UKS sebagai pusat layanan kesehatan sekolah yang unggul, profesional, dan berorientasi pada kepuasan siswa serta mendukung terciptanya lingkungan belajar yang sehat.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature-box">
                        <div class="feature-icon"><i class="fas fa-tasks"></i></div>
                        <h4 class="fw-bold mb-2">Misi</h4>
                        <ul class="mb-0 text-muted ps-3">
                            <li>Memberikan pelayanan kesehatan yang prima dan cepat tanggap</li>
                            <li>Meningkatkan kesadaran hidup sehat siswa</li>
                            <li>Menjaga ketersediaan obat dan alat kesehatan</li>
                            <li>Melakukan pencegahan dan penanganan dini</li>
                            <li>Membangun kerjasama dengan orang tua dan tenaga kesehatan</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row g-4 mt-4">
                <div class="col-md-4">
                    <div class="feature-box text-center">
                        <div class="feature-icon mx-auto"><i class="fas fa-user-md"></i></div>
                        <h5 class="fw-bold mb-2">Petugas Terlatih</h5>
                        <p class="mb-0 text-muted small">Petugas UKS kami memiliki pelatihan dasar kesehatan dan P3K.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box text-center">
                        <div class="feature-icon mx-auto"><i class="fas fa-pills"></i></div>
                        <h5 class="fw-bold mb-2">Obat Lengkap</h5>
                        <p class="mb-0 text-muted small">Tersedia berbagai obat umum dan P3K yang terjamin kualitasnya.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box text-center">
                        <div class="feature-icon mx-auto"><i class="fas fa-clock"></i></div>
                        <h5 class="fw-bold mb-2">Siaga Setiap Hari</h5>
                        <p class="mb-0 text-muted small">UKS buka setiap hari sekolah untuk melayani kebutuhan siswa.</p>
                    </div>
                </div>
            </div>
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