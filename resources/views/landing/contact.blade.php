<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - SIKES</title>
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
        
        /* Contact Cards */
        .contact-card { 
            background: white; 
            border-radius: 16px; 
            padding: 30px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.06); 
            height: 100%;
            transition: transform 0.3s;
        }
        .contact-card:hover {
            transform: translateY(-5px);
        }
        .contact-icon { 
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
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('landing') }}">
                SIKES
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing.about') }}">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing.medicines') }}">Informasi Obat</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing.schedule') }}">Jadwal Petugas</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('landing.contact') }}">Kontak</a></li>
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
                <small class="text-primary fw-semibold"><i class="fas fa-headset me-2"></i>Butuh Bantuan?</small>
            </div>
            <h1 class="fw-bold">Hubungi Kami</h1>
            <p class="mb-0">Kami siap membantu kebutuhan kesehatan Anda</p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="section">
        <div class="container">
            <!-- Info Cards -->
            <div class="row g-4 mb-5 justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="contact-card text-center">
                        <div class="contact-icon mx-auto"><i class="fas fa-map-marker-alt"></i></div>
                        <h5 class="fw-bold mb-2">Alamat</h5>
                        <p class="text-muted mb-0">Komplek SMK Negeri 1 Bangsri<br>Jalan KH. Achmad Fauzan No.17, Bangsri, Jepara<br>Jawa Tengah, 59453</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="contact-card text-center">
                        <div class="contact-icon mx-auto"><i class="fab fa-instagram"></i></div>
                        <h5 class="fw-bold mb-2">Sosial Media</h5>
                        <p class="text-muted mb-0">
                            Instagram: <span class="fw-semibold text-dark">@pmrwira_eskasaba</span><br>
                            Youtube: <span class="fw-semibold text-dark">@wirasandyaadhimukti3463</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Form & Hours -->
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="contact-card">
                        <h4 class="fw-bold mb-4 text-dark">Kirim Pesan</h4>
                        <form>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Lengkap</label>
                                <input type="text" class="form-control" placeholder="Masukkan nama Anda">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control" placeholder="Masukkan email Anda">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Pesan</label>
                                <textarea class="form-control" rows="4" placeholder="Tulis pesan Anda..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                                <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-card">
                        <h4 class="fw-bold mb-4 text-dark">Jam Operasional</h4>
                        <table class="table table-borderless mb-3">
                            <tbody>
                                <tr class="border-bottom">
                                    <td class="py-3 ps-0">Senin - Kamis</td>
                                    <td class="text-end py-3 fw-semibold text-dark">08:00 - 15:00</td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="py-3 ps-0">Jumat</td>
                                    <td class="text-end py-3 fw-semibold text-dark">08:00 - 13:00</td>
                                </tr>
                                <tr>
                                    <td class="py-3 ps-0">Sabtu - Minggu</td>
                                    <td class="text-end py-3 fw-semibold text-danger">Tutup</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="alert alert-warning d-flex align-items-center mb-0" role="alert">
                            <i class="fas fa-exclamation-triangle fa-lg me-3"></i>
                            <div>
                                Untuk keadaan darurat di luar jam operasional, silakan hubungi guru piket atau langsung ke IGD terdekat.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row g-4">
                <!-- Kolom 1: Tentang (LOGO DIHAPUS) -->
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
                        <li class="mb-2"><a href="{{ route('landing') }}" class="text-light opacity-75">Beranda</a></li>
                        <li class="mb-2"><a href="{{ route('landing.about') }}" class="text-light opacity-75">Tentang UKS</a></li>
                        <li class="mb-2"><a href="{{ route('landing.medicines') }}" class="text-light opacity-75">Informasi Obat</a></li>
                        <li class="mb-2"><a href="{{ route('landing.schedule') }}" class="text-light opacity-75">Jadwal Petugas</a></li>
                        <li class="mb-2"><a href="{{ route('landing.contact') }}" class="text-light opacity-75">Kontak</a></li>
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
</body>
</html>