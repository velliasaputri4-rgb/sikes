<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Kesehatan - SIKES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
    :root {
        --primary: #3b82f6;
        --primary-dark: #1e3a8a;
        --secondary: #2563eb;
        --pro: #1e3a8a;
        --pro-light: #3b82f6;
        --emerald: #10b981;
        --rose: #f43f5e;
        --amber: #f59e0b;
        --ink: #0f172a;
        --slate: #475569;
        --muted: #94a3b8;
        --gradient-primary: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        --gradient-dark: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        --shadow-sm: 0 4px 20px rgba(30, 58, 138, 0.08);
        --shadow-md: 0 10px 40px rgba(30, 58, 138, 0.12);
        --shadow-lg: 0 25px 60px rgba(30, 58, 138, 0.18);
        --radius: 18px;
    }

    * { -webkit-font-smoothing: antialiased; }
    html { scroll-behavior: smooth; scroll-padding-top: 20px; }
    body {
        font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
        background: #fafbfc;
        color: var(--ink);
        line-height: 1.7;
        overflow-x: hidden;
    }

    .btn-back-home {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 8px 18px; background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px); color: var(--pro);
        border-radius: 50px; font-weight: 600; font-size: 0.85rem;
        text-decoration: none; box-shadow: var(--shadow-sm);
        border: 1px solid rgba(30,58,138,0.15);
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .btn-back-home:hover {
        background: var(--gradient-primary); color: white;
        border-color: transparent; transform: translateX(-4px);
        box-shadow: var(--shadow-md);
    }
    .btn-back-home i { transition: transform 0.3s ease; }
    .btn-back-home:hover i { transform: translateX(-3px); }

    .blob-bg {
        position: absolute; border-radius: 50%; filter: blur(80px);
        opacity: 0.4; z-index: 0; pointer-events: none;
    }
    .blob-1 { width: 400px; height: 400px; background: #1e3a8a; top: -100px; left: -100px; animation: float1 20s ease-in-out infinite; opacity: 0.25; }
    .blob-2 { width: 350px; height: 350px; background: #3b82f6; top: 100px; right: -80px; animation: float2 25s ease-in-out infinite; opacity: 0.2; }
    @keyframes float1 { 0%,100% { transform: translate(0,0) scale(1); } 50% { transform: translate(60px,-40px) scale(1.1); } }
    @keyframes float2 { 0%,100% { transform: translate(0,0) scale(1); } 50% { transform: translate(-50px,50px) scale(0.9); } }

    .page-header {
        position: relative; padding: 80px 0 70px;
        background: linear-gradient(180deg, #f7fafc 0%, #edf2fa 100%);
        overflow: hidden;
    }
    .page-header-badge {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 8px 18px; background: rgba(59,130,246,0.1);
        color: var(--pro); border-radius: 50px; font-size: 0.85rem;
        font-weight: 600; margin-bottom: 0; border: 1px solid rgba(30,58,138,0.15);
    }
    .page-title {
        font-family: 'Poppins', sans-serif; font-size: clamp(2rem, 4.5vw, 3rem);
        font-weight: 700; color: var(--ink); line-height: 1.2;
        margin-bottom: 14px; letter-spacing: -1px;
    }
    .gradient-text {
        background: var(--gradient-primary); -webkit-background-clip: text;
        -webkit-text-fill-color: transparent; background-clip: text;
    }
    .page-subtitle { color: var(--slate); font-size: 1.05rem; max-width: 580px; margin-bottom: 0; }

    .header-icon-wrap {
        width: 120px; height: 120px; background: var(--gradient-primary);
        border-radius: 30px; display: flex; align-items: center; justify-content: center;
        color: white; font-size: 3rem; box-shadow: 0 20px 50px rgba(30,58,138,0.3);
        margin-left: auto; animation: iconFloat 5s ease-in-out infinite; position: relative;
    }
    .header-icon-wrap::before {
        content: ''; position: absolute; inset: -10px; border-radius: 34px;
        background: var(--gradient-primary); opacity: 0.2; z-index: -1;
    }
    @keyframes iconFloat { 0%,100% { transform: translateY(0) rotate(0); } 50% { transform: translateY(-10px) rotate(3deg); } }

    .section { padding: 70px 0 90px; }
    .section-label {
        display: inline-block; padding: 6px 16px; background: rgba(59,130,246,0.1);
        color: var(--pro); border-radius: 50px; font-size: 0.8rem; font-weight: 700;
        letter-spacing: 1px; text-transform: uppercase; margin-bottom: 12px;
    }
    .section-title {
        font-family: 'Poppins', sans-serif; font-size: clamp(1.6rem, 3.5vw, 2.2rem);
        font-weight: 700; color: var(--ink); margin-bottom: 12px; letter-spacing: -0.5px; line-height: 1.2;
    }
    .section-subtitle { color: var(--slate); font-size: 1rem; max-width: 550px; }

    /* Health Cards */
    .health-card {
        background: white; border-radius: var(--radius); padding: 24px;
        box-shadow: 0 4px 20px rgba(30,58,138,0.06); transition: all 0.3s ease;
        height: 100%; border: 1px solid rgba(30,58,138,0.08); display: flex; flex-direction: column;
    }
    .health-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); border-color: rgba(30,58,138,0.15); }
    .health-icon {
        width: 56px; height: 56px; background: linear-gradient(135deg, #f6f9fc, #edf2fa);
        border-radius: 14px; display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem; color: var(--pro); margin-bottom: 16px;
    }
    .health-card h5 { font-family: 'Poppins', sans-serif; font-weight: 700; color: var(--ink); margin-bottom: 8px; }
    .health-card p { color: var(--slate); font-size: 0.9rem; flex: 1; }
    
    /* Badge Kategori Disamakan Menjadi Biru */
    .badge-cat {
        display: inline-block; padding: 4px 10px; border-radius: 50px;
        font-size: 0.75rem; font-weight: 600; margin-bottom: 12px;
        background: #dbeafe !important;
        color: #1e40af !important;
    }
    .badge-gizi, .badge-penyakit, .badge-mental, .badge-olahraga, .badge-umum {
        background: #dbeafe !important;
        color: #1e40af !important;
    }

    .btn-read {
        background: var(--gradient-primary); color: white; border: none;
        border-radius: 10px; padding: 10px 16px; font-weight: 600; font-size: 0.85rem;
        transition: all 0.3s; display: inline-flex; align-items: center; gap: 6px;
        box-shadow: 0 4px 12px rgba(30,58,138,0.25); width: 100%; justify-content: center;
    }
    .btn-read:hover { color: white; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(30,58,138,0.4); }

    /* Calculator Cards */
    .calc-card {
        background: white; border-radius: var(--radius); padding: 28px;
        box-shadow: 0 4px 20px rgba(30,58,138,0.06); border: 1px solid rgba(30,58,138,0.08); height: 100%;
    }
    .calc-input {
        border: 1px solid #e2e8f0; border-radius: 10px; padding: 10px 14px;
        font-size: 0.9rem; transition: all 0.3s; width: 100%; margin-bottom: 16px;
    }
    .calc-input:focus { border-color: var(--pro-light); box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); outline: none; }
    .calc-label { font-weight: 600; color: var(--ink); font-size: 0.9rem; margin-bottom: 6px; display: block; }
    .btn-calc {
        background: var(--gradient-primary); color: white; border: none;
        border-radius: 10px; padding: 12px; font-weight: 600; width: 100%;
        transition: all 0.3s; margin-top: 8px;
    }
    .btn-calc:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(30,58,138,0.3); }
    .result-box {
        background: #f0f9ff; border-left: 4px solid var(--pro-light);
        padding: 16px; border-radius: 10px; margin-top: 16px; display: none;
    }
    .result-box.show { display: block; animation: slideIn 0.4s ease; }
    @keyframes slideIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    .result-value { font-size: 1.8rem; font-weight: 700; color: var(--pro); font-family: 'Poppins', sans-serif; }

    .scroll-top {
        position: fixed; bottom: 30px; right: 30px; width: 50px; height: 50px;
        background: var(--gradient-primary); color: white; border: none;
        border-radius: 14px; display: flex; align-items: center; justify-content: center;
        box-shadow: 0 10px 30px rgba(30,58,138,0.35); cursor: pointer;
        opacity: 0; visibility: hidden; transform: translateY(20px); transition: all 0.3s; z-index: 999;
    }
    .scroll-top.show { opacity: 1; visibility: visible; transform: translateY(0); }
    .scroll-top:hover { transform: translateY(-4px); box-shadow: 0 15px 40px rgba(59,130,246,0.5); }

    @media (max-width: 768px) {
        .page-header { padding: 60px 0; }
        .header-icon-wrap { width: 90px; height: 90px; font-size: 2.3rem; margin: 20px auto 0; }
        .btn-back-home span { display: none; }
        .btn-back-home i { margin: 0; }
    }
    </style>
</head>
<body>

    <!-- Page Header -->
    <section class="page-header">
        <div class="blob-bg blob-1"></div>
        <div class="blob-bg blob-2"></div>
        <div class="container position-relative" style="z-index: 2;">
            <div class="row align-items-center g-4">
                <div class="col-lg-8" data-aos="fade-right">
                    <div class="d-flex align-items-center gap-3 flex-wrap" style="margin-bottom: 18px;">
                        <div class="page-header-badge mb-0">
                            <span style="width: 8px; height: 8px; background: var(--emerald); border-radius: 50%; display: inline-block;"></span>
                            <span>Pusat Informasi Kesehatan</span>
                        </div>
                        <a href="{{ route('landing') }}" class="btn-back-home" data-aos="fade-right" data-aos-delay="100">
                            <i class="fas fa-arrow-left"></i>
                            <span>Kembali ke Beranda</span>
                        </a>
                    </div>
                    <h1 class="page-title">
                        Informasi <span class="gradient-text">Kesehatan</span><br>
                        & Gaya Hidup Sehat
                    </h1>
                    <p class="page-subtitle">Artikel edukasi lengkap dan kalkulator kesehatan untuk mendukung kesejahteraan siswa SMK Negeri 1 Bangsri.</p>
                </div>
                <div class="col-lg-4 text-lg-end" data-aos="fade-left" data-aos-delay="200">
                    <div class="header-icon-wrap">
                        <i class="fas fa-heart-pulse"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 1. Artikel Kesehatan -->
    <section class="section" id="artikel">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-label">Edukasi</span>
                <h2 class="section-title">Artikel & <span class="gradient-text">Tips Kesehatan</span></h2>
                <p class="section-subtitle mx-auto">Pelajari cara menjaga kesehatan fisik dan mental Anda sehari-hari.</p>
            </div>

            <div class="row g-4">
                <!-- Card 1 -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up">
                    <div class="health-card">
                        <div class="health-icon"><i class="fas fa-apple-alt"></i></div>
                        <span class="badge-cat badge-gizi">Gizi & Nutrisi</span>
                        <h5>Pola Makan Sehat untuk Remaja</h5>
                        <p>Panduan lengkap pola makan bergizi seimbang untuk mendukung pertumbuhan dan perkembangan remaja di masa sekolah.</p>
                        <button class="btn-read" data-bs-toggle="modal" data-bs-target="#modalArtikel1">Baca Selengkapnya <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="health-card">
                        <div class="health-icon"><i class="fas fa-shield-virus"></i></div>
                        <span class="badge-cat badge-penyakit">Pencegahan</span>
                        <h5>Cara Mencegah Demam Berdarah</h5>
                        <p>Langkah-langkah pencegahan DBD yang efektif di lingkungan sekolah dan rumah dengan metode 3M Plus.</p>
                        <button class="btn-read" data-bs-toggle="modal" data-bs-target="#modalArtikel2">Baca Selengkapnya <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="health-card">
                        <div class="health-icon"><i class="fas fa-brain"></i></div>
                        <span class="badge-cat badge-mental">Kesehatan Mental</span>
                        <h5>Mengatasi Stres Saat Ujian</h5>
                        <p>Tips dan teknik relaksasi sederhana untuk mengatasi kecemasan dan menjaga fokus saat menghadapi ujian.</p>
                        <button class="btn-read" data-bs-toggle="modal" data-bs-target="#modalArtikel3">Baca Selengkapnya <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
                <!-- Card 4 -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up">
                    <div class="health-card">
                        <div class="health-icon"><i class="fas fa-tint"></i></div>
                        <span class="badge-cat badge-penyakit">Penyakit</span>
                        <h5>Mengenali dan Mencegah Anemia</h5>
                        <p>Gejala anemia seperti pusing dan lemas sering dialami remaja. Ketahui cara pencegahan dengan konsumsi zat besi.</p>
                        <button class="btn-read" data-bs-toggle="modal" data-bs-target="#modalArtikel4">Baca Selengkapnya <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
                <!-- Card 5 -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="health-card">
                        <div class="health-icon"><i class="fas fa-tooth"></i></div>
                        <span class="badge-cat badge-gizi">Kesehatan Gigi</span>
                        <h5>Pentingnya Menjaga Kesehatan Gigi</h5>
                        <p>Sikat gigi 2x sehari dan kurangi makanan manis untuk mencegah gigi berlubang dan radang gusi.</p>
                        <button class="btn-read" data-bs-toggle="modal" data-bs-target="#modalArtikel5">Baca Selengkapnya <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
                <!-- Card 6 -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="health-card">
                        <div class="health-icon"><i class="fas fa-head-side-cough"></i></div>
                        <span class="badge-cat badge-penyakit">Penyakit Menular</span>
                        <h5>Mencegah Penyebaran Flu dan ISPA</h5>
                        <p>Gunakan masker, cuci tangan, dan jaga jarak jika sedang sakit untuk melindungi teman sekelas.</p>
                        <button class="btn-read" data-bs-toggle="modal" data-bs-target="#modalArtikel6">Baca Selengkapnya <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
                <!-- Card 7 -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up">
                    <div class="health-card">
                        <div class="health-icon"><i class="fas fa-eye"></i></div>
                        <span class="badge-cat badge-mental">Kesehatan Mata</span>
                        <h5>Menjaga Kesehatan Mata di Era Digital</h5>
                        <p>Terapkan aturan 20-20-20 saat menggunakan gadget untuk mengurangi ketegangan dan mata kering.</p>
                        <button class="btn-read" data-bs-toggle="modal" data-bs-target="#modalArtikel7">Baca Selengkapnya <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
                <!-- Card 8 -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="health-card">
                        <div class="health-icon"><i class="fas fa-ban"></i></div>
                        <span class="badge-cat badge-penyakit">Pencegahan</span>
                        <h5>Bahaya Rokok dan Vape bagi Pelajar</h5>
                        <p>Dampak negatif nikotin terhadap perkembangan otak remaja dan cara menolak tawaran merokok.</p>
                        <button class="btn-read" data-bs-toggle="modal" data-bs-target="#modalArtikel8">Baca Selengkapnya <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
                <!-- Card 9 -->
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="health-card">
                        <div class="health-icon"><i class="fas fa-kit-medical"></i></div>
                        <span class="badge-cat badge-olahraga">P3K</span>
                        <h5>Dasar-Dasar Pertolongan Pertama</h5>
                        <p>Langkah awal menangani luka ringan, memar, atau pingsan di sekolah sebelum ditangani petugas UKS.</p>
                        <button class="btn-read" data-bs-toggle="modal" data-bs-target="#modalArtikel9">Baca Selengkapnya <i class="fas fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Kalkulator Kesehatan -->
    <section class="section" style="background: linear-gradient(180deg, #edf2fa 0%, #fafbfc 100%);" id="kalkulator">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-label">Tools</span>
                <h2 class="section-title">Kalkulator <span class="gradient-text">Kesehatan</span></h2>
                <p class="section-subtitle mx-auto">Hitung indeks kesehatan Anda dengan mudah dan cepat.</p>
            </div>

            <div class="row g-4">
                <!-- BMI -->
                <div class="col-lg-4" data-aos="fade-up">
                    <div class="calc-card">
                        <h5 class="fw-bold mb-3"><i class="fas fa-weight me-2 text-primary"></i>BMI Calculator</h5>
                        <form id="bmiForm">
                            <label class="calc-label">Tinggi Badan (cm)</label>
                            <input type="number" class="calc-input" id="bmiHeight" placeholder="Contoh: 165" required>
                            <label class="calc-label">Berat Badan (kg)</label>
                            <input type="number" class="calc-input" id="bmiWeight" placeholder="Contoh: 55" required>
                            <button type="submit" class="btn-calc">Hitung BMI</button>
                        </form>
                        <div id="bmiResult" class="result-box">
                            <small class="text-muted">Hasil BMI Anda:</small>
                            <div class="result-value" id="bmiValue">0</div>
                            <div id="bmiDesc" class="fw-semibold">-</div>
                        </div>
                    </div>
                </div>

                <!-- Kalori -->
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="calc-card">
                        <h5 class="fw-bold mb-3"><i class="fas fa-fire me-2 text-danger"></i>Kebutuhan Kalori</h5>
                        <form id="calorieForm">
                            <label class="calc-label">Jenis Kelamin</label>
                            <select class="calc-input" id="calorieGender" required>
                                <option value="">Pilih...</option>
                                <option value="male">Laki-laki</option>
                                <option value="female">Perempuan</option>
                            </select>
                            <div class="row g-2">
                                <div class="col-6">
                                    <label class="calc-label">Usia</label>
                                    <input type="number" class="calc-input" id="calorieAge" placeholder="17" required>
                                </div>
                                <div class="col-6">
                                    <label class="calc-label">Berat (kg)</label>
                                    <input type="number" class="calc-input" id="calorieWeight" placeholder="55" required>
                                </div>
                            </div>
                            <label class="calc-label">Tinggi (cm)</label>
                            <input type="number" class="calc-input" id="calorieHeight" placeholder="165" required>
                            <button type="submit" class="btn-calc">Hitung Kalori</button>
                        </form>
                        <div id="calorieResult" class="result-box">
                            <small class="text-muted">Kebutuhan Harian:</small>
                            <div class="result-value" id="calorieValue">0</div>
                            <div class="fw-semibold">kkal/hari</div>
                        </div>
                    </div>
                </div>

                <!-- Kalkulator Air Minum -->
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="calc-card">
                        <h5 class="fw-bold mb-3"><i class="fas fa-glass-water me-2" style="color: #0ea5e9;"></i>Kebutuhan Air Minum</h5>
                        <form id="waterForm">
                            <label class="calc-label">Berat Badan (kg)</label>
                            <input type="number" class="calc-input" id="waterWeight" placeholder="Contoh: 55" required>
                            <label class="calc-label">Tingkat Aktivitas</label>
                            <select class="calc-input" id="waterActivity" required>
                                <option value="">Pilih...</option>
                                <option value="30">Rendah (Jarang Olahraga)</option>
                                <option value="35">Sedang (Olahraga 1-3x/minggu)</option>
                                <option value="40">Tinggi (Olahraga >3x/minggu)</option>
                            </select>
                            <button type="submit" class="btn-calc" style="background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);">Hitung Kebutuhan</button>
                        </form>
                        <div id="waterResult" class="result-box" style="background: #f0f9ff; border-left-color: #0ea5e9;">
                            <small class="text-muted">Kebutuhan Air Harian:</small>
                            <div class="result-value" id="waterValue" style="color: #0284c7; font-size: 1.6rem;">0</div>
                            <div class="fw-semibold" id="waterDesc" style="color: #0369a1;">liter / hari</div>
                            <small class="text-muted mt-2 d-block" style="font-size: 0.75rem;">*Disarankan minum secara bertahap sepanjang hari.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modals Artikel -->
    <div class="modal fade" id="modalArtikel1" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius: var(--radius); border: none;">
                <div class="modal-header" style="border-bottom: 1px solid #f1f5f9;">
                    <h5 class="modal-title fw-bold">Pola Makan Sehat untuk Remaja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <p>Masa remaja adalah periode penting pertumbuhan dan perkembangan. Pola makan yang sehat sangat penting untuk mendukung proses ini.</p>
                    <h6 class="fw-bold mt-3">Prinsip Gizi Seimbang:</h6>
                    <ul>
                        <li>Konsumsi makanan pokok sebagai sumber karbohidrat</li>
                        <li>Perbanyak sayur dan buah (minimal 5 porsi sehari)</li>
                        <li>Konsumsi lauk pauk sumber protein</li>
                        <li>Batasi gula, garam, dan lemak</li>
                        <li>Minum air putih minimal 8 gelas sehari</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalArtikel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius: var(--radius); border: none;">
                <div class="modal-header" style="border-bottom: 1px solid #f1f5f9;">
                    <h5 class="modal-title fw-bold">Cara Mencegah Demam Berdarah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <p>Demam Berdarah Dengue (DBD) ditularkan melalui gigitan nyamuk Aedes aegypti.</p>
                    <h6 class="fw-bold mt-3">Pencegahan 3M Plus:</h6>
                    <ul>
                        <li><strong>Menguras</strong> tempat penampungan air</li>
                        <li><strong>Menutup</strong> rapat tempat penampungan air</li>
                        <li><strong>Mengubur</strong> barang bekas</li>
                        <li><strong>Plus:</strong> Menggunakan lotion anti nyamuk, menanam tanaman pengusir nyamuk</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalArtikel3" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius: var(--radius); border: none;">
                <div class="modal-header" style="border-bottom: 1px solid #f1f5f9;">
                    <h5 class="modal-title fw-bold">Mengatasi Stres Saat Ujian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <p>Stres adalah respons alami tubuh terhadap tekanan. Wajar merasa cemas sebelum ujian, tapi stres berlebihan bisa mengganggu kesehatan.</p>
                    <h6 class="fw-bold mt-3">Teknik Relaksasi:</h6>
                    <ul>
                        <li><strong>Pernapasan Dalam:</strong> Tarik napas 4 detik, tahan 4 detik, buang 4 detik</li>
                        <li><strong>Tidur Cukup:</strong> Minimal 7-8 jam per hari</li>
                        <li><strong>Olahraga:</strong> Aktivitas fisik membantu mengurangi hormon stres</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalArtikel4" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius: var(--radius); border: none;">
                <div class="modal-header" style="border-bottom: 1px solid #f1f5f9;">
                    <h5 class="modal-title fw-bold">Mengenali dan Mencegah Anemia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <p>Anemia adalah kondisi ketika tubuh kekurangan sel darah merah sehat. Gejala umum meliputi pusing, lemas, pucat, dan sulit berkonsentrasi.</p>
                    <h6 class="fw-bold mt-3">Cara Pencegahan:</h6>
                    <ul>
                        <li>Konsumsi makanan kaya zat besi (daging merah, bayam, kacang-kacangan)</li>
                        <li>Kombinasikan dengan vitamin C (jeruk, tomat) untuk penyerapan maksimal</li>
                        <li>Hindari minum teh atau kopi bersamaan dengan makan</li>
                        <li>Rutin cek kadar hemoglobin (Hb) di UKS</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalArtikel5" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius: var(--radius); border: none;">
                <div class="modal-header" style="border-bottom: 1px solid #f1f5f9;">
                    <h5 class="modal-title fw-bold">Pentingnya Menjaga Kesehatan Gigi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <p>Kesehatan gigi dan mulut sangat berpengaruh pada kesehatan tubuh secara keseluruhan dan kepercayaan diri.</p>
                    <h6 class="fw-bold mt-3">Tips Menjaga Kesehatan Gigi:</h6>
                    <ul>
                        <li>Sikat gigi minimal 2 kali sehari (pagi setelah sarapan dan malam sebelum tidur)</li>
                        <li>Gunakan pasta gigi mengandung fluoride</li>
                        <li>Kurangi konsumsi makanan dan minuman manis atau asam</li>
                        <li>Ganti sikat gigi setiap 3 bulan sekali</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalArtikel6" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius: var(--radius); border: none;">
                <div class="modal-header" style="border-bottom: 1px solid #f1f5f9;">
                    <h5 class="modal-title fw-bold">Mencegah Penyebaran Flu dan ISPA</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <p>Influenza dan Infeksi Saluran Pernapasan Akut (ISPA) sangat mudah menular di lingkungan sekolah yang padat.</p>
                    <h6 class="fw-bold mt-3">Langkah Pencegahan:</h6>
                    <ul>
                        <li>Cuci tangan dengan sabun dan air mengalir secara rutin</li>
                        <li>Gunakan masker jika sedang batuk atau pilek</li>
                        <li>Tutup mulut dan hidung dengan siku bagian dalam saat bersin</li>
                        <li>Istirahat di rumah jika gejala demam tinggi</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalArtikel7" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius: var(--radius); border: none;">
                <div class="modal-header" style="border-bottom: 1px solid #f1f5f9;">
                    <h5 class="modal-title fw-bold">Menjaga Kesehatan Mata di Era Digital</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <p>Penggunaan gadget yang berlebihan dapat menyebabkan Computer Vision Syndrome (mata lelah, kering, dan blur).</p>
                    <h6 class="fw-bold mt-3">Aturan 20-20-20:</h6>
                    <ul>
                        <li>Setiap <strong>20 menit</strong> menatap layar, alihkan pandangan</li>
                        <li>Lihat objek yang berjarak <strong>20 kaki</strong> (sekitar 6 meter)</li>
                        <li>Lakukan selama <strong>20 detik</strong></li>
                        <li>Pastikan pencahayaan ruangan cukup saat belajar</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalArtikel8" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius: var(--radius); border: none;">
                <div class="modal-header" style="border-bottom: 1px solid #f1f5f9;">
                    <h5 class="modal-title fw-bold">Bahaya Rokok dan Vape bagi Pelajar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <p>Rokok dan vape mengandung nikotin dan zat kimia berbahaya yang dapat mengganggu perkembangan otak remaja.</p>
                    <h6 class="fw-bold mt-3">Dampak Negatif:</h6>
                    <ul>
                        <li>Gangguan konsentrasi dan daya ingat</li>
                        <li>Kerusakan paru-paru dan peningkatan risiko penyakit jantung</li>
                        <li>Kecanduan yang sulit dihentikan</li>
                    </ul>
                    <h6 class="fw-bold mt-3">Cara Menolak:</h6>
                    <ul>
                        <li>Katakan "Tidak, terima kasih" dengan tegas</li>
                        <li>Cari alasan (misal: "Saya atlet", "Saya alergi")</li>
                        <li>Hindari pergaulan yang mendorong perilaku merokok</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalArtikel9" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius: var(--radius); border: none;">
                <div class="modal-header" style="border-bottom: 1px solid #f1f5f9;">
                    <h5 class="modal-title fw-bold">Dasar-Dasar Pertolongan Pertama (P3K)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <p>Pertolongan Pertama pada Kecelakaan (P3K) adalah tindakan awal yang penting sebelum mendapatkan penanganan medis lanjutan.</p>
                    <h6 class="fw-bold mt-3">Langkah Dasar:</h6>
                    <ul>
                        <li><strong>Luka Ringan:</strong> Bersihkan dengan air mengalir, beri antiseptik, dan tutup dengan plester.</li>
                        <li><strong>Memar:</strong> Kompres dingin selama 15-20 menit untuk mengurangi bengkak.</li>
                        <li><strong>Pingsan:</strong> Baringkan, tinggikan kaki, longgarkan pakaian, dan pastikan jalan napas terbuka.</li>
                        <li>Segera laporkan ke petugas UKS atau guru.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <button class="scroll-top" id="scrollTop">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init({ duration: 700, once: true, offset: 60 });

        window.addEventListener('scroll', () => {
            const scrollTop = document.getElementById('scrollTop');
            if (window.scrollY > 300) scrollTop.classList.add('show');
            else scrollTop.classList.remove('show');
        });

        document.getElementById('scrollTop').addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // BMI Calculator
        document.getElementById('bmiForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const height = parseFloat(document.getElementById('bmiHeight').value) / 100;
            const weight = parseFloat(document.getElementById('bmiWeight').value);
            if (height > 0 && weight > 0) {
                const bmi = (weight / (height * height)).toFixed(1);
                let category = bmi < 18.5 ? 'Kurus' : (bmi <= 24.9 ? 'Normal' : (bmi <= 29.9 ? 'Gemuk' : 'Obesitas'));
                let color = bmi < 18.5 ? '#f59e0b' : (bmi <= 24.9 ? '#10b981' : (bmi <= 29.9 ? '#f97316' : '#ef4444'));
                document.getElementById('bmiValue').textContent = bmi;
                document.getElementById('bmiValue').style.color = color;
                document.getElementById('bmiDesc').innerHTML = `<span style="color: ${color}">${category}</span>`;
                document.getElementById('bmiResult').classList.add('show');
            }
        });

        // Calorie Calculator
        document.getElementById('calorieForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const gender = document.getElementById('calorieGender').value;
            const age = parseFloat(document.getElementById('calorieAge').value);
            const weight = parseFloat(document.getElementById('calorieWeight').value);
            const height = parseFloat(document.getElementById('calorieHeight').value);
            if (gender && age > 0 && weight > 0 && height > 0) {
                let bmr = gender === 'male' ? (10 * weight + 6.25 * height - 5 * age + 5) : (10 * weight + 6.25 * height - 5 * age - 161);
                const tdee = Math.round(bmr * 1.375); // Asumsi aktivitas ringan
                document.getElementById('calorieValue').textContent = tdee.toLocaleString();
                document.getElementById('calorieResult').classList.add('show');
            }
        });

        // Water Intake Calculator
        document.getElementById('waterForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const weight = parseFloat(document.getElementById('waterWeight').value);
            const multiplier = parseInt(document.getElementById('waterActivity').value);
            
            if (weight > 0 && multiplier > 0) {
                const totalMl = weight * multiplier;
                const totalLiters = (totalMl / 1000).toFixed(1);
                const glasses = Math.round(totalMl / 250);
                
                document.getElementById('waterValue').textContent = totalLiters + ' L';
                document.getElementById('waterDesc').textContent = `atau sekitar ${glasses} gelas (250ml)`;
                document.getElementById('waterResult').classList.add('show');
            }
        });
    </script>
</body>
</html>