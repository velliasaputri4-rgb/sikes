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
            --warning: #f59e0b;
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
        
        /* Page Header (DIBUAT SOFT SEPERTI LANDING PAGE) */
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
        
        /* Info Cards */
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
        
        /* Schedule Cards */
        .schedule-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
            transition: all 0.3s ease;
            border-left: 5px solid var(--primary);
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
        .schedule-card.weekend {
            border-left-color: var(--warning);
        }
        .schedule-card.weekend::before {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.05), transparent);
        }
        
        .day-badge {
            display: inline-block;
            padding: 6px 16px;
            background: linear-gradient(135deg, var(--primary), var(--info));
            color: white;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 15px;
        }
        .day-badge.weekend {
            background: linear-gradient(135deg, var(--warning), #f97316);
        }
        
        .officer-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 15px;
        }
        
        .time-box {
            background: #f8fafc;
            border-radius: 10px;
            padding: 12px 15px;
            margin-top: 15px;
            border: 1px dashed #cbd5e1;
        }
        .time-box i {
            color: var(--success);
            margin-right: 8px;
        }
        .time-text {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
        }
        
        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-active {
            background: #dcfce7;
            color: #16a34a;
        }
        
        /* Section Title */
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
        
        /* Alert Box */
        .info-alert {
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
            border-left: 4px solid var(--primary);
            border-radius: 12px;
            padding: 20px 25px;
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
        
        @media (max-width: 768px) {
            .page-header h1 { font-size: 1.8rem; }
            .section-title { font-size: 1.5rem; }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
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
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing.medicines') }}">Informasi Obat</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('landing.schedule') }}">Jadwal Petugas</a></li>
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

    <!-- Page Header (Soft Blue) -->
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
                    <p class="text-muted small mb-0">Senin - Jumat: 07:00 - 15:00<br>Sabtu: 07:00 - 12:00</p>
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
                <p class="section-subtitle">Daftar petugas yang bertugas sesuai hari dan jam operasional</p>
            </div>

            <div class="row g-4">
                @forelse($schedules as $schedule)
                    @php
                        $isWeekend = str_contains(strtolower($schedule->day), 'sabtu') || str_contains(strtolower($schedule->day), 'minggu');
                        $initials = strtoupper(substr($schedule->officer_name, 0, 2));
                    @endphp
                    <div class="col-md-6 col-lg-4">
                        <div class="schedule-card {{ $isWeekend ? 'weekend' : '' }}">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <span class="day-badge {{ $isWeekend ? 'weekend' : '' }}">
                                    <i class="fas fa-calendar-day me-1"></i> {{ $schedule->day }}
                                </span>
                                <span class="status-badge status-active">
                                    <i class="fas fa-check-circle me-1"></i> Aktif
                                </span>
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <div class="officer-avatar me-3">{{ $initials }}</div>
                                <div>
                                    <h6 class="fw-bold mb-1">{{ $schedule->officer_name }}</h6>
                                    <small class="text-muted"><i class="fas fa-user-nurse me-1"></i> Petugas UKS</small>
                                </div>
                            </div>

                            <div class="time-box">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-clock fa-lg"></i>
                                    <div>
                                        <small class="text-muted d-block" style="font-size: 11px;">JAM TUGAS</small>
                                        <span class="time-text">{{ $schedule->time }}</span>
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
                    <h5 class="fw-bold mb-3 text-white"><i class="fas fa-heartbeat me-2 text-success"></i> SIKES</h5>
                    <p class="text-light opacity-75">Sistem Informasi Unit Kesehatan Sekolah yang modern dan terpercaya untuk meningkatkan kesehatan siswa.</p>
                </div>
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3 text-white">Menu Cepat</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('landing') }}" class="text-light opacity-75">Beranda</a></li>
                        <li class="mb-2"><a href="{{ route('landing.about') }}" class="text-light opacity-75">Tentang UKS</a></li>
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