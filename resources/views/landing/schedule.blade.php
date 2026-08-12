<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Petugas UKS - SIKES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #2563EB;
            --secondary: #1e40af;
            --success: #10b981;
            --info: #3b82f6;
        }
        
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
        
        .navbar { 
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
            background: white !important;
            padding: 5px 0;
        }
        .navbar-brand { 
            display: flex;
            align-items: center;
            padding: 0;
        }
        .navbar-brand img {
            max-height: 75px;
            width: auto;
            object-fit: contain;
        }
        
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
        
        .page-header {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            padding: 80px 0 100px;
            color: #1e293b;
            position: relative;
            overflow: hidden;
        }
        .page-header::before {
            content: '';
            position: absolute;
            top: -20%;
            right: -5%;
            width: 400px;
            height: 400px;
            background: rgba(37, 99, 235, 0.05);
            border-radius: 50%;
        }
        .page-header::after {
            content: '';
            position: absolute;
            bottom: -10%;
            left: -5%;
            width: 300px;
            height: 300px;
            background: rgba(37, 99, 235, 0.03);
            border-radius: 50%;
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
        .page-header .soft-badge {
            background: rgba(37, 99, 235, 0.1);
            color: var(--primary);
        }
        .page-header .icon-box {
            background: rgba(37, 99, 235, 0.1);
            color: var(--primary);
        }
        
        .info-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            margin-top: -50px;
            position: relative;
            z-index: 10;
        }
        .info-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 15px;
        }
        
        .schedule-card {
            background: white;
            border-radius: 16px;
            padding: 30px 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            transition: all 0.3s ease;
            border-top: 5px solid var(--primary); 
            height: 100%;
            position: relative;
            overflow: hidden;
        }
        .schedule-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.05), transparent);
            border-radius: 0 0 0 100%;
        }
        .schedule-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 35px rgba(37, 99, 235, 0.15);
        }
        
        .officer-avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 15px;
        }
        
        .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 10px;
        }
        .section-subtitle {
            color: #64748b;
            font-size: 1.05rem;
        }
        
        .info-alert {
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
            border-left: 4px solid var(--primary);
            border-radius: 12px;
            padding: 20px 25px;
        }
        
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

        /* Styling untuk anggota yang memiliki nomor telepon */
        .member-contact {
            color: #dc2626 !important;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .member-contact:hover {
            color: #991b1b !important;
            text-decoration: underline;
        }
        .member-phone-icon {
            color: #dc2626;
            margin-left: 8px;
        }
        
        @media (max-width: 768px) {
            .page-header h1 { font-size: 1.8rem; }
            .section-title { font-size: 1.5rem; }
            .navbar-brand img { max-height: 60px; }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('landing') }}">
                <img src="{{ asset('images/logo sikes navbar.png') }}" alt="Logo SIKES">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('landing') ? 'active' : '' }}" href="{{ route('landing') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link anchor-link" href="{{ route('landing') }}#tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link anchor-link" href="{{ route('landing') }}#layanan">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link anchor-link" href="{{ route('landing') }}#kontak">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('landing.medicines*') ? 'active' : '' }}" href="{{ route('landing.medicines') }}">Informasi Obat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('landing.schedule*') ? 'active' : '' }}" href="{{ route('landing.schedule') }}">Jadwal Petugas</a>
                    </li>
                    
                    <!-- ✅ Icon Login / Logout dengan Dropdown -->
                    <li class="nav-item ms-3">
                        <div class="dropdown">
                            <button class="btn btn-primary rounded-circle" type="button" data-bs-toggle="dropdown" style="width: 40px; height: 40px; padding: 0;">
                                <i class="fas {{ auth()->check() ? 'fa-user-check' : 'fa-user' }}"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                @auth
                                    {{-- ✅ SAAT SUDAH LOGIN --}}
                                    <li class="dropdown-header text-center">
                                        <small class="text-muted d-block">Halo,</small>
                                        <strong class="text-dark">{{ auth()->user()->name ?? 'User' }}</strong>
                                        <span class="badge bg-primary mt-1">{{ auth()->user()->getRoleNames()->first() ?? 'User' }}</span>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        {{-- ✅ PERBAIKAN 1: student.history → siswa.history --}}
                                        <a class="dropdown-item" href="{{ route(auth()->user()->hasRole(['super-admin', 'admin']) ? 'admin.dashboard' : (auth()->user()->hasRole('petugas') ? 'petugas.dashboard' : 'siswa.history')) }}">
                                            <i class="fas fa-tachometer-alt me-2 text-primary"></i> Dashboard Saya
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                                            </button>
                                        </form>
                                    </li>
                                @else
                                    {{-- ✅ PERBAIKAN 2: 2 PILIHAN LOGIN (Admin/Petugas digabung) --}}
                                    <li class="dropdown-header text-center">
                                        <small class="text-muted">Pilih Login</small>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item fw-semibold" href="{{ route('login') }}">
                                            <i class="fas fa-user-shield me-2 text-primary"></i> Login Admin / Petugas
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item text-center small" href="{{ route('login.siswa') }}">
                                            <i class="fas fa-user-graduate me-1 text-info"></i> Login Siswa
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

    <!-- Page Header -->
    <section class="page-header">
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="d-inline-block soft-badge px-3 py-1 rounded-pill mb-3">
                        <small class="fw-semibold"><i class="fas fa-calendar-alt me-2"></i>Informasi Jadwal</small>
                    </div>
                    <h1>Jadwal Petugas UKS</h1>
                    <p class="mb-0">Informasi lengkap jadwal petugas yang bertugas di UKS SMK Negeri 1 Bangsri</p>
                </div>
                <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                    <div class="d-inline-block icon-box rounded-3 p-3">
                        <i class="fas fa-user-nurse fa-3x"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Info Cards -->
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="info-card text-center">
                    <div class="info-icon mx-auto" style="background: #dbeafe; color: var(--primary);">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Jam Operasional</h5>
                    <p class="text-muted small mb-0">Senin - Kamis: 08:00 - 15:00<br>Jumat: 08:00 - 13:00</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-card text-center">
                    <div class="info-icon mx-auto" style="background: #dcfce7; color: var(--success);">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Petugas Terlatih</h5>
                    <p class="text-muted small mb-0">Petugas UKS kami memiliki pelatihan dasar kesehatan dan P3K</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-card text-center">
                    <div class="info-icon mx-auto" style="background: #fee2e2; color: #dc2626;">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h5 class="fw-bold mb-2">Darurat</h5>
                    <p class="text-muted small mb-0">Untuk keadaan darurat, hubungi guru piket atau petugas</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Schedule Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Jadwal Tugas Petugas</h2>
                <p class="section-subtitle">Klik tombol di bawah untuk melihat daftar anggota piket</p>
            </div>

            <div class="row g-4 justify-content-center">
                @forelse($schedules as $schedule)
                    @php
                        $members = $schedule->members ?? [];
                    @endphp
                    <div class="col-md-6 col-lg-4">
                        <div class="schedule-card text-center h-100 d-flex flex-column justify-content-center">
                            <div class="officer-avatar mx-auto mb-3">
                                <i class="fas fa-users"></i>
                            </div>
                            
                            <h5 class="fw-bold mb-1 text-dark">{{ $schedule->group_name }}</h5>
                            <p class="text-muted small mb-4">PMR Wira Sandya Adhimukti</p>
                            
                            <button class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalAnggota{{ $schedule->id }}">
                                <i class="fas fa-info-circle me-2"></i> Lihat Daftar Anggota
                            </button>
                        </div>
                    </div>

                    <!-- Modal Popup Daftar Anggota -->
                    <div class="modal fade" id="modalAnggota{{ $schedule->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $schedule->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content border-0 shadow">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title fw-bold" id="modalLabel{{ $schedule->id }}">
                                        <i class="fas fa-users me-2"></i> Anggota {{ $schedule->group_name }}
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-0">
                                    <ul class="list-group list-group-flush">
                                        @if(count($members) > 0)
                                            @foreach($members as $member)
                                                <li class="list-group-item d-flex align-items-center py-3">
                                                    <i class="fas fa-user-circle text-primary me-3 fa-lg"></i>
                                                    <div class="flex-grow-1">
                                                        @if(is_array($member))
                                                            <div class="fw-medium">
                                                                {{ $member['name'] ?? '-' }}
                                                            </div>
                                                            @if(!empty($member['phone']))
                                                                <a href="https://wa.me/{{ preg_replace('/\D/', '', $member['phone']) }}" 
                                                                   target="_blank" 
                                                                   class="member-contact small"
                                                                   title="Hubungi via WhatsApp">
                                                                    <i class="fab fa-whatsapp member-phone-icon"></i>
                                                                    {{ $member['phone'] }}
                                                                    <span class="badge bg-danger bg-opacity-10 text-danger ms-1">Kontak Darurat</span>
                                                                </a>
                                                            @endif
                                                        @else
                                                            <span class="fw-medium">{{ $member }}</span>
                                                        @endif
                                                    </div>
                                                </li>
                                            @endforeach
                                        @else
                                            <li class="list-group-item py-3 text-center text-muted">
                                                Data anggota belum tersedia.
                                            </li>
                                        @endif
                                    </ul>
                                    
                                    <div class="p-3">
                                        <div class="alert alert-warning d-flex align-items-start mb-0 small">
                                            <i class="fas fa-exclamation-triangle me-2 mt-1 text-danger"></i>
                                            <div>
                                                <strong>Catatan:</strong><br>
                                                Silahkan menghubungi nama yang diberi <span class="text-danger fw-bold">warna merah</span> pada jadwal piket, jika membutuhkan bantuan.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px;">
                                <i class="fas fa-calendar-times fa-3x text-muted opacity-25"></i>
                            </div>
                            <h5 class="text-muted fw-bold">Belum Ada Jadwal</h5>
                            <p class="text-muted">Jadwal petugas belum tersedia. Silakan hubungi admin UKS.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Info Alert -->
            <div class="info-alert mt-5">
                <div class="row align-items-center">
                    <div class="col-md-2 text-center mb-3 mb-md-0">
                        <i class="fas fa-info-circle fa-3x text-primary"></i>
                    </div>
                    <div class="col-md-10">
                        <h5 class="fw-bold mb-2">Informasi Penting</h5>
                        <ul class="mb-0 text-muted ps-3">
                            <li>UKS melayani siswa selama jam operasional sekolah</li>
                            <li>Untuk keadaan darurat di luar jam operasional, silakan hubungi guru piket</li>
                            <li>Petugas UKS siap memberikan pertolongan pertama dan rujukan jika diperlukan</li>
                        </ul>
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
                    <h5 class="fw-bold mb-3 text-white">SIKES</h5>
                    <p class="text-light opacity-75" style="line-height: 1.7;">
                        Sistem Informasi Unit Kesehatan Sekolah yang modern dan terpercaya untuk meningkatkan kesehatan siswa.
                    </p>
                </div>
                
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3 text-white">Menu Cepat</h5>
                    <ul class="list-unstyled footer-menu">
                        <li class="mb-2"><a href="{{ route('landing') }}" class="text-light opacity-75">Beranda</a></li>
                        <li class="mb-2"><a href="{{ route('landing') }}#tentang" class="text-light opacity-75">Tentang</a></li>
                        <li class="mb-2"><a href="{{ route('landing') }}#layanan" class="text-light opacity-75">Layanan</a></li>
                        <li class="mb-2"><a href="{{ route('landing') }}#kontak" class="text-light opacity-75">Kontak</a></li>
                        <li class="mb-2"><a href="{{ route('landing.medicines') }}" class="text-light opacity-75">Informasi Obat</a></li>
                        <li class="mb-2"><a href="{{ route('landing.schedule') }}" class="text-light opacity-75">Jadwal Petugas</a></li>
                    </ul>
                </div>
                
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
    
    <script>
        document.querySelectorAll('.anchor-link').forEach(link => {
            link.addEventListener('click', function() {
                document.querySelectorAll('.navbar-nav .nav-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>