<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang UKS - SIKES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', sans-serif; }
        .navbar { box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .navbar-brand { font-weight: bold; color: #2563EB !important; }
        .page-header { background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); padding: 60px 0; }
        .section { padding: 60px 0; }
        .feature-box { padding: 30px; background: #f8fafc; border-radius: 12px; margin-bottom: 20px; }
        .feature-icon { width: 60px; height: 60px; background: #2563EB; color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px; margin-bottom: 15px; }
        footer { background: #0f172a; color: white; padding: 40px 0 20px; }
        footer a { color: #cbd5e1; text-decoration: none; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('landing') }}"><i class="fas fa-heartbeat me-2"></i> SIKES</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('landing.about') }}">Tentang UKS</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing.medicines') }}">Informasi Obat</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing.schedule') }}">Jadwal Petugas</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing.contact') }}">Kontak</a></li>
                    <li class="nav-item ms-2"><a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-4">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <section class="page-header text-center">
        <div class="container">
            <h1 class="fw-bold">Tentang UKS</h1>
            <p class="text-muted mb-0">Mengenal lebih dekat Unit Kesehatan Sekolah kami</p>
        </div>
    </section>

    <!-- Content -->
    <section class="section">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6">
                    <img src="https://img.freepik.com/free-vector/healthcare-concept-illustration_23-2148939760.jpg" class="img-fluid rounded-4">
                </div>
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-3">Apa itu UKS?</h2>
                    <p class="text-muted">Unit Kesehatan Sekolah (UKS) adalah wahana untuk meningkatkan kemampuan hidup sehat dan selanjutnya membentuk perilaku hidup sehat peserta didik yang berada di sekolah. UKS merupakan usaha kesehatan masyarakat yang dijalankan di sekolah-sekolah.</p>
                    <p class="text-muted">Dengan adanya UKS, diharapkan siswa dapat memperoleh pelayanan kesehatan dasar, pendidikan kesehatan, dan pembinaan lingkungan sekolah sehat.</p>
                </div>
            </div>

            <div class="row g-4 mt-4">
                <div class="col-md-6">
                    <div class="feature-box">
                        <div class="feature-icon"><i class="fas fa-bullseye"></i></div>
                        <h4 class="fw-bold">Visi</h4>
                        <p class="mb-0">Menjadikan UKS sebagai pusat layanan kesehatan sekolah yang unggul, profesional, dan berorientasi pada kepuasan siswa serta mendukung terciptanya lingkungan belajar yang sehat.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature-box">
                        <div class="feature-icon"><i class="fas fa-tasks"></i></div>
                        <h4 class="fw-bold">Misi</h4>
                        <ul class="mb-0">
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
                        <h5 class="fw-bold">Petugas Terlatih</h5>
                        <p class="mb-0 small">Petugas UKS kami memiliki pelatihan dasar kesehatan dan P3K.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box text-center">
                        <div class="feature-icon mx-auto"><i class="fas fa-pills"></i></div>
                        <h5 class="fw-bold">Obat Lengkap</h5>
                        <p class="mb-0 small">Tersedia berbagai obat umum dan P3K yang terjamin kualitasnya.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box text-center">
                        <div class="feature-icon mx-auto"><i class="fas fa-clock"></i></div>
                        <h5 class="fw-bold">Siaga Setiap Hari</h5>
                        <p class="mb-0 small">UKS buka setiap hari sekolah untuk melayani kebutuhan siswa.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} SIKES - Sistem Informasi UKS. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>