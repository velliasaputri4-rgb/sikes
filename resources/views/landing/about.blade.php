<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - SIKES</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo sikes navbar.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo sikes navbar.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { 
            /* ✅ TEMA MERAH (PMR/UKS) */
            --primary: #ef4444; 
            --primary-dark: #991b1b; 
            --secondary: #dc2626;
            --accent: #f43f5e;
            --emerald: #10b981;
            --rose: #f43f5e;
            --amber: #f59e0b;
            --ink: #0f172a; 
            --slate: #475569; 
            --light: #f8fafc;
            --pro: #991b1b;
            --pro-dark: #7f1d1d;
            --pro-light: #ef4444;
            --gradient-pro: linear-gradient(135deg, #991b1b 0%, #ef4444 100%);
            --gradient-primary: linear-gradient(135deg, #991b1b 0%, #ef4444 100%); 
            --gradient-accent: linear-gradient(135deg, #f43f5e 0%, #ef4444 100%);
            --gradient-dark: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); 
            --shadow-sm: 0 4px 20px rgba(153, 27, 27, 0.08); 
            --shadow-md: 0 10px 40px rgba(153, 27, 27, 0.12);
            --shadow-lg: 0 25px 60px rgba(153, 27, 27, 0.18); 
            --radius: 18px; 
        }
        * { -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }
        html { scroll-behavior: smooth; scroll-padding-top: 90px; }
        body { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; background: #fafbfc; color: var(--ink); line-height: 1.7; overflow-x: hidden; }

        /* ===== NAVBAR ===== */
        .navbar {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 0 4px 30px rgba(153, 27, 27, 0.06);
            border-bottom: 1px solid rgba(153, 27, 27, 0.08);
            padding: 12px 0;
            transition: all 0.4s ease;
        }
        .navbar.scrolled { padding: 8px 0; box-shadow: 0 8px 40px rgba(153, 27, 27, 0.1); }
        .navbar-brand { display: flex; align-items: center; }
        .navbar-brand img { max-height: 55px; width: auto; transition: transform 0.3s; }
        .navbar-brand:hover img { transform: scale(1.05); }
        .nav-link {
            font-weight: 600;
            font-size: 0.95rem;
            color: var(--slate) !important;
            padding: 10px 18px !important;
            border-radius: 10px;
            transition: all 0.3s ease;
            letter-spacing: 0.2px;
        }
        .nav-link:hover {
            color: var(--primary-dark) !important;
            background: linear-gradient(135deg, rgba(153, 27, 27, 0.08), rgba(239, 68, 68, 0.08));
            transform: translateY(-1px);
        }
        .nav-link.active {
            color: white !important;
            background: var(--gradient-primary);
            box-shadow: 0 6px 20px rgba(153, 27, 27, 0.25);
        }

        .user-btn {
            background: var(--gradient-primary);
            color: white !important;
            border: none;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 20px rgba(153, 27, 27, 0.3);
            transition: all 0.3s;
        }
        .user-btn:hover { transform: translateY(-2px) rotate(5deg); box-shadow: 0 10px 28px rgba(153, 27, 27, 0.4); }

        .dropdown-menu {
            border: none;
            border-radius: 14px;
            box-shadow: 0 20px 50px rgba(15,23,42,0.15);
            padding: 10px;
            margin-top: 10px;
        }
        .dropdown-item {
            border-radius: 8px;
            padding: 10px 14px;
            font-weight: 500;
            transition: all 0.2s;
        }
        .dropdown-item:hover {
            background: linear-gradient(135deg, rgba(153, 27, 27, 0.08), rgba(239, 68, 68, 0.08));
            transform: translateX(4px);
        }

        .section { padding: 90px 0; position: relative; }
        .section-label { display: inline-block; padding: 6px 16px; background: rgba(239, 68, 68, 0.12); color: #991b1b; border-radius: 50px; font-size: 0.8rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 16px; }
        .section-title { font-family: 'Poppins', sans-serif; font-size: clamp(1.8rem, 4vw, 2.6rem); font-weight: 700; color: var(--ink); margin-bottom: 16px; line-height: 1.2; }
        .section-subtitle { color: var(--slate); font-size: 1.05rem; max-width: 600px; }
        .gradient-text { background: var(--gradient-primary); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        
        .btn-hero-primary { background: var(--gradient-primary); color: white; padding: 12px 26px; border-radius: 10px; border: none; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 6px 20px rgba(153, 27, 27, 0.25); transition: all 0.3s; text-decoration: none; }
        .btn-hero-primary:hover { color: white; transform: translateY(-3px); box-shadow: 0 10px 28px rgba(153, 27, 27, 0.35); }
        
        .page-header { background: linear-gradient(135deg, #f6f9fc 0%, #fef2f2 100%); padding: 140px 0 80px; text-align: center; position: relative; }
        
        .value-card { background: white; border-radius: var(--radius); padding: 32px; height: 100%; border: 1px solid rgba(153, 27, 27, 0.08); transition: all 0.3s ease; }
        .value-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-lg); border-color: transparent; }
        .value-icon { width: 60px; height: 60px; background: var(--gradient-primary); color: white; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 20px; box-shadow: 0 10px 25px rgba(153, 27, 27, 0.25); }
        
        .vm-card { background: white; border-radius: var(--radius); padding: 40px; height: 100%; box-shadow: var(--shadow-sm); border-left: 5px solid var(--primary); }
        .vm-card h4 { font-family: 'Poppins', sans-serif; font-weight: 700; color: var(--ink); margin-bottom: 16px; }

        footer {
            background: var(--gradient-dark);
            color: white;
            padding: 80px 0 30px;
            position: relative;
            overflow: hidden;
        }
        footer::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(circle at 10% 20%, rgba(153, 27, 27, 0.25) 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, rgba(239, 68, 68, 0.15) 0%, transparent 40%);
        }
        footer .container { position: relative; z-index: 1; }
        .footer-logo {
            display: inline-flex; align-items: center; gap: 12px;
            margin-bottom: 20px;
            font-family: 'Poppins', sans-serif;
            font-weight: 700; font-size: 1.4rem;
        }
        footer h6 { font-weight: 700; margin-bottom: 22px; color: white; text-transform: uppercase; letter-spacing: 1px; font-size: 0.9rem; }
        .footer-menu { list-style: none; padding: 0; margin: 0; }
        .footer-menu li { margin-bottom: 12px; }
        .footer-menu a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.3s;
            display: inline-flex; align-items: center; gap: 8px;
        }
        .footer-menu a:hover { color: #fca5a5; transform: translateX(6px); }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,0.1); margin-top: 50px; padding-top: 25px; text-align: center; color: rgba(255,255,255,0.5); font-size: 0.9rem; }

        @media (max-width: 768px) { 
            .section { padding: 60px 0; } 
            .page-header { padding: 120px 0 60px; } 
            .navbar-brand img { max-height: 42px; }
        }
    </style>
</head>
<body>

    <!-- ===== NAVBAR ===== -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('landing') }}">
                <img src="{{ asset('images/logo sikes navbar.png') }}" alt="Logo SIKES">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-1">
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('landing.about') }}">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing.services') }}">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing.docs') }}">Dokumentasi</a></li>

                    <li class="nav-item ms-lg-3">
                        <div class="dropdown">
                            <button class="btn user-btn" type="button" data-bs-toggle="dropdown">
                                <i class="fas {{ auth()->check() ? 'fa-user-check' : 'fa-user' }}"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                @auth
                                    <li class="dropdown-header text-center pb-2">
                                        <small class="text-muted d-block">Halo,</small>
                                        <strong class="text-dark">{{ auth()->user()->name ?? 'User' }}</strong>
                                        <span class="badge mt-1" style="background: var(--primary); color: white;">{{ auth()->user()->getRoleNames()->first() ?? 'User' }}</span>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('dashboard') }}">
                                            <i class="fas fa-tachometer-alt me-2" style="color: var(--primary);"></i> Dashboard
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                                            </button>
                                        </form>
                                    </li>
                                @else
                                    <li class="dropdown-header text-center">
                                        <small class="text-muted">Pilih Login</small>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item fw-semibold" href="{{ route('login') }}">
                                            <i class="fas fa-user-shield me-2" style="color: var(--primary);"></i> Admin
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('login.siswa') }}">
                                            <i class="fas fa-user-graduate me-2" style="color: var(--primary);"></i> Login Siswa
                                        </a>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @php
        // ✅ Mengambil data dari database pengaturan
        $headerTitle = \App\Models\Setting::get('about_page_header_title', 'Membangun Sekolah yang Lebih Sehat');
        $headerSubtitle = \App\Models\Setting::get('about_page_header_subtitle', 'Mengenal lebih dalam filosofi, visi, dan komitmen SIKES dalam mendukung kesehatan seluruh warga SMK Negeri 1 Bangsri.');
        
        $storyTitle = \App\Models\Setting::get('about_page_story_title', 'Dedikasi untuk Kesehatan Siswa');
        $storyP1 = \App\Models\Setting::get('about_page_story_p1', 'SIKES (Sistem Informasi UKS) lahir dari kebutuhan nyata akan pengelolaan kesehatan sekolah yang modern. Kami menyadari bahwa pencatatan manual sering kali rentan terhadap kehilangan data, sulit dilacak, dan tidak efisien.');
        $storyP2 = \App\Models\Setting::get('about_page_story_p2', 'Oleh karena itu, kami mengembangkan platform yang tidak hanya mencatat riwayat kunjungan, tetapi juga mengelola inventaris obat, menjadwalkan petugas, dan memberikan edukasi kesehatan secara terpusat. Semua dirancang agar petugas UKS bisa fokus pada hal yang paling penting: merawat siswa.');
        
        $vision = \App\Models\Setting::get('about_page_vision', 'Menjadi sistem informasi kesehatan sekolah terdepan yang menciptakan lingkungan pendidikan sehat, sigap, dan berbasis data untuk mendukung prestasi dan kesejahteraan seluruh siswa.');
        
        // ✅ PERBAIKAN: Menangani format <br> atau \n dari database agar list misi terpecah dengan rapi
        $missionRaw = \App\Models\Setting::get('about_page_mission', "Mendigitalisasi seluruh rekam medis dan inventaris UKS.\nMempercepat respon penanganan kesehatan siswa melalui data yang terintegrasi.\nMenyediakan informasi kesehatan yang akurat dan mudah diakses oleh siswa dan guru.");
        $missionClean = str_replace(['<br>', '<br/>', '<br />', '&lt;br&gt;', '&lt;br/&gt;'], "\n", strip_tags($missionRaw));
        $missions = array_filter(array_map('trim', explode("\n", $missionClean)));
        
        $ctaTitle = \App\Models\Setting::get('about_page_cta_title', 'Siap Meningkatkan Kesehatan Sekolah?');
        $ctaDesc = \App\Models\Setting::get('about_page_cta_desc', 'Bergabunglah dengan sistem yang telah dipercaya untuk menangani ratusan kunjungan siswa setiap bulannya dengan lebih profesional.');
        $ctaBtn = \App\Models\Setting::get('about_page_cta_btn', 'Lihat Layanan Kami');
    @endphp

    <header class="page-header">
        <div class="container position-relative" data-aos="fade-up">
            <span class="section-label">Tentang Kami</span>
            <h1 class="section-title mt-3">{{ $headerTitle }}</h1>
            <p class="section-subtitle mx-auto">{{ $headerSubtitle }}</p>
        </div>
    </header>

    <section class="section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right">
                    @php
                        $aboutImg = \App\Models\Setting::get('about_image');
                        $imgSrc = $aboutImg ? asset('storage/' . $aboutImg) : asset('images/logo sikes.png');
                    @endphp
                    <img src="{{ $imgSrc }}" alt="Tentang SIKES" class="img-fluid rounded-4 shadow-lg" style="width: 100%; object-fit: cover;">
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <span class="section-label">Cerita Kami</span>
                    <h2 class="section-title">{{ $storyTitle }}</h2>
                    <p style="color: var(--slate); line-height: 1.8; margin-bottom: 20px;">{{ $storyP1 }}</p>
                    <p style="color: var(--slate); line-height: 1.8; margin-bottom: 20px;">{{ $storyP2 }}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section" style="background: linear-gradient(180deg, #fafbfc 0%, #fef2f2 100%);">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-label">Arah & Tujuan</span>
                <h2 class="section-title">Visi & Misi Kami</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="vm-card">
                        <h4><i class="fas fa-eye me-2" style="color: var(--primary);"></i> Visi</h4>
                        <p style="color: var(--slate); line-height: 1.8;">{{ $vision }}</p>
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="vm-card">
                        <h4><i class="fas fa-bullseye me-2" style="color: var(--primary);"></i> Misi</h4>
                        <ul class="list-unstyled">
                            @foreach($missions as $mission)
                                <li class="mb-2" style="line-height: 1.6; color: var(--slate);">
                                    <i class="fas fa-check-circle me-2" style="color: var(--primary);"></i> {{ $mission }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" style="background: var(--gradient-primary); color: white; text-align: center;">
        <div class="container" data-aos="zoom-in">
            <h2 class="fw-bold mb-3" style="font-family: 'Poppins', sans-serif;">{{ $ctaTitle }}</h2>
            <p class="mb-4" style="max-width: 600px; margin: 0 auto 30px; opacity: 0.9;">{{ $ctaDesc }}</p>
            <a href="{{ route('landing.services') }}" class="btn btn-light fw-bold px-4 py-3 rounded-3 shadow-lg" style="text-decoration: none; color: var(--primary-dark);">
                <i class="fas fa-arrow-right me-2"></i> {{ $ctaBtn }}
            </a>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="footer-logo">
                        <span>SIKES</span>
                    </div>
                    <p style="color: rgba(255,255,255,0.7); line-height: 1.8; margin-bottom: 24px;">
                        {{ \App\Models\Setting::get('footer_desc', 'Sistem Informasi Unit Kesehatan Sekolah modern dan terpercaya untuk meningkatkan kualitas kesehatan seluruh warga sekolah.') }}
                    </p>
                </div>
                <div class="col-6 col-lg-2">
                    <h6>Navigasi</h6>
                    <ul class="footer-menu">
                        <li><a href="{{ route('landing') }}"><i class="fas fa-chevron-right fa-xs"></i> Beranda</a></li>
                        <li><a href="{{ route('landing.about') }}"><i class="fas fa-chevron-right fa-xs"></i> Tentang</a></li>
                        <li><a href="{{ route('landing.services') }}"><i class="fas fa-chevron-right fa-xs"></i> Layanan</a></li>
                        <li><a href="{{ route('landing.docs') }}"><i class="fas fa-chevron-right fa-xs"></i> Dokumentasi</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-3">
                    <h6>Layanan</h6>
                    <ul class="footer-menu">
                        <li><a href="{{ route('landing.medicines') }}"><i class="fas fa-chevron-right fa-xs"></i> Informasi Obat</a></li>
                        <li><a href="{{ route('landing.health-info') }}"><i class="fas fa-chevron-right fa-xs"></i> Informasi Kesehatan</a></li>
                        <li><a href="{{ route('landing.schedule') }}"><i class="fas fa-chevron-right fa-xs"></i> Jadwal Petugas</a></li>
                        <li><a href="{{ auth()->check() && auth()->user()->hasRole('siswa') ? route('siswa.history') : route('login.siswa') }}"><i class="fas fa-chevron-right fa-xs"></i> Riwayat</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h6>Kontak</h6>
                    <ul class="footer-menu">
                        <li><a href="#"><i class="fas fa-map-marker-alt"></i> Jl. KH. Achmad Fauzan No.17, Bangsri</a></li>
                        <li>
                            <a href="{{ \App\Models\Setting::get('contact_ig_link', '#') }}" target="_blank">
                                <i class="fab fa-instagram"></i> {{ '@' . \App\Models\Setting::get('contact_ig_handle', 'pmrwira_eskasaba') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ \App\Models\Setting::get('contact_yt_link', '#') }}" target="_blank">
                                <i class="fab fa-youtube"></i> {{ '@' . \App\Models\Setting::get('contact_yt_handle', 'wirasandyaadhimukti3463') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="mb-0">{!! \App\Models\Setting::get('footer_copyright', '&copy; ' . date('Y') . ' <strong>SIKES</strong> - Sistem Informasi UKS SMK Negeri 1 Bangsri. All rights reserved.') !!}</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            try {
                AOS.init({ 
                    duration: 800, 
                    once: true, 
                    offset: 80,
                    disable: function() {
                        return window.innerWidth < 768;
                    }
                });
            } catch(e) {
                console.error('AOS error:', e);
            }

            // Navbar scroll effect
            window.addEventListener('scroll', function() {
                const navbar = document.querySelector('.navbar');
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            }, { passive: true });
        });
    </script>
</body>
</html>