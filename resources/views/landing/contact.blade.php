<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - SIKES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f8fafc; }
        .navbar { box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .navbar-brand { font-weight: bold; color: #2563EB !important; }
        .page-header { background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); padding: 60px 0; }
        .section { padding: 60px 0; }
        .contact-card { background: white; border-radius: 12px; padding: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); height: 100%; }
        .contact-icon { width: 60px; height: 60px; background: #2563EB; color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px; margin-bottom: 15px; }
        footer { background: #0f172a; color: white; padding: 40px 0 20px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('landing') }}"><i class="fas fa-heartbeat me-2"></i> SIKES</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing.about') }}">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing.medicines') }}">Informasi Obat</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('landing.schedule') }}">Jadwal Petugas</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('landing.contact') }}">Kontak</a></li>
                    <li class="nav-item ms-2"><a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-4">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="page-header text-center">
        <div class="container">
            <h1 class="fw-bold">Hubungi Kami</h1>
            <p class="text-muted mb-0">Kami siap membantu kebutuhan kesehatan Anda</p>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="contact-card text-center">
                        <div class="contact-icon mx-auto"><i class="fas fa-map-marker-alt"></i></div>
                        <h5 class="fw-bold">Alamat</h5>
                        <p class="text-muted mb-0">Jl. Pendidikan No. 123<br>Kota Anda, 12345</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-card text-center">
                        <div class="contact-icon mx-auto"><i class="fas fa-phone"></i></div>
                        <h5 class="fw-bold">Telepon</h5>
                        <p class="text-muted mb-0">(021) 1234567<br>0812-3456-7890</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-card text-center">
                        <div class="contact-icon mx-auto"><i class="fas fa-envelope"></i></div>
                        <h5 class="fw-bold">Email</h5>
                        <p class="text-muted mb-0">uks@sekolah.sch.id<br>info@sikes.sch.id</p>
                    </div>
                </div>
            </div>

            <div class="row g-4 mt-4">
                <div class="col-lg-6">
                    <div class="contact-card">
                        <h4 class="fw-bold mb-3">Kirim Pesan</h4>
                        <form>
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" placeholder="Masukkan nama Anda">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="Masukkan email Anda">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pesan</label>
                                <textarea class="form-control" rows="4" placeholder="Tulis pesan Anda..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Kirim Pesan</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-card">
                        <h4 class="fw-bold mb-3">Jam Operasional</h4>
                        <table class="table">
                            <tbody>
                                <tr><td>Senin - Jumat</td><td class="text-end fw-semibold">07:00 - 15:00</td></tr>
                                <tr><td>Sabtu</td><td class="text-end fw-semibold">07:00 - 12:00</td></tr>
                                <tr><td>Minggu</td><td class="text-end fw-semibold text-danger">Tutup</td></tr>
                            </tbody>
                        </table>
                        <div class="alert alert-warning mt-3 mb-0">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Untuk keadaan darurat di luar jam operasional, silakan hubungi guru piket atau langsung ke IGD terdekat.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} SIKES - Sistem Informasi UKS. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>