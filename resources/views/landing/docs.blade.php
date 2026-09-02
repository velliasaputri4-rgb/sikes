<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumentasi & Berita - SIKES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #1e3a8a;
            --secondary: #2563eb;
            --accent: #8b5cf6;
            --emerald: #10b981;
            --rose: #f43f5e;
            --amber: #f59e0b;
            --ink: #0f172a;
            --slate: #475569;
            --light: #f8fafc;
            --pro: #1e3a8a;
            --pro-dark: #172c6e;
            --pro-light: #3b82f6;
            --gradient-pro: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            --gradient-primary: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            --shadow-sm: 0 4px 20px rgba(30, 58, 138, 0.08);
            --shadow-lg: 0 25px 60px rgba(30, 58, 138, 0.18);
            --radius: 18px;
        }
        body {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            background: #fafbfc;
            color: var(--ink);
            line-height: 1.7;
        }
        .section { padding: 80px 0; }
        .section-label {
            display: inline-block; padding: 6px 16px; background: rgba(59,130,246,0.12); color: var(--pro);
            border-radius: 50px; font-size: 0.8rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 16px;
        }
        .section-title { font-family: 'Poppins', sans-serif; font-size: clamp(1.8rem, 4vw, 2.6rem); font-weight: 700; color: var(--ink); margin-bottom: 16px; }
        .section-subtitle { color: var(--slate); font-size: 1.05rem; max-width: 600px; margin: 0 auto; }
        .gradient-text { background: var(--gradient-primary); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }

        /* Doc Card Styling */
        .doc-card {
            background: white; border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow-sm);
            transition: all 0.3s ease; height: 100%; border: 1px solid rgba(30,58,138,0.08); display: flex; flex-direction: column;
        }
        .doc-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-lg); }
        .doc-image { width: 100%; height: 240px; overflow: hidden; position: relative; }
        .doc-image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; }
        .doc-card:hover .doc-image img { transform: scale(1.05); }
        
        /* ✅ PERBAIKAN: Tambahkan text-decoration: none dan cursor: pointer agar bisa diklik */
        .video-overlay {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.4);
            display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease; z-index: 2;
            text-decoration: none;
            cursor: pointer;
        }
        .doc-card:hover .video-overlay { opacity: 1; }
        .video-overlay i { font-size: 3.5rem; color: #ffffff; filter: drop-shadow(0 4px 10px rgba(0,0,0,0.4)); transition: transform 0.3s; }
        .doc-card:hover .video-overlay i { transform: scale(1.15); }

        .doc-content { padding: 24px; flex-grow: 1; display: flex; flex-direction: column; }
        .doc-meta { display: flex; gap: 20px; margin-bottom: 12px; font-size: 0.85rem; color: var(--slate); flex-wrap: wrap; }
        .doc-meta span { display: inline-flex; align-items: center; gap: 6px; }
        .doc-meta i { color: var(--primary); }
        .badge-video { background: rgba(244, 63, 94, 0.1); color: var(--rose); padding: 3px 10px; border-radius: 6px; font-weight: 700; font-size: 0.75rem; display: inline-flex; align-items: center; gap: 5px; }
        
        .doc-title { font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 1.1rem; line-height: 1.4; margin-bottom: 8px; }
        .doc-title a { color: var(--ink); text-decoration: none; transition: color 0.3s ease; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .doc-title a:hover { color: var(--primary); }
        .doc-excerpt { color: var(--slate); font-size: 0.9rem; line-height: 1.6; margin-top: auto; }

        /* Footer Simple */
        footer { background: var(--pro-dark); color: white; padding: 40px 0; text-align: center; margin-top: auto; }
        footer a { color: rgba(255,255,255,0.7); text-decoration: none; }
        footer a:hover { color: white; }

        @media (max-width: 768px) {
            .doc-image { height: 200px; }
            .section { padding: 60px 0; }
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Header & Content Section -->
    <section class="section flex-grow-1" style="background: linear-gradient(180deg, #fafbfc 0%, #f0f4f8 100%);">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-label">{{ \App\Models\Setting::get('docs_label', 'Dokumentasi') }}</span>
                <h1 class="section-title">{!! \App\Models\Setting::get('docs_title', 'Berita & <span class="gradient-text">Kegiatan</span>') !!}</h1>
                <p class="section-subtitle">{{ \App\Models\Setting::get('docs_subtitle', 'Informasi terbaru seputar kegiatan dan program UKS di sekolah kami') }}</p>
            </div>

            <div class="row g-4">
                @forelse($documentations as $index => $doc)
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                        <div class="doc-card">
                            <div class="doc-image">
                                <img src="{{ $doc->image ? asset('storage/' . $doc->image) : 'https://via.placeholder.com/600x400/3b82f6/ffffff?text=Dokumentasi+UKS' }}" 
                                     alt="{{ $doc->title }}" 
                                     onerror="this.src='https://via.placeholder.com/600x400/3b82f6/ffffff?text=Dokumentasi+UKS'">
                                
                                {{-- ✅ PERBAIKAN: Ubah div menjadi tag <a> agar bisa diklik --}}
                                @if(!empty($doc->video_link))
                                    <a href="{{ $doc->video_link }}" target="_blank" class="video-overlay" title="Putar Video">
                                        <i class="fas fa-play-circle"></i>
                                    </a>
                                @endif
                            </div>
                            <div class="doc-content">
                                <div class="doc-meta">
                                    <span><i class="far fa-calendar"></i> {{ \Carbon\Carbon::parse($doc->published_at)->format('d F Y') }}</span>
                                    @if(!empty($doc->video_link))
                                        <span class="badge-video"><i class="fas fa-video"></i> Video</span>
                                    @endif
                                </div>
                                <h5 class="doc-title">
                                    <a href="{{ !empty($doc->video_link) ? $doc->video_link : route('landing.docs-detail', \Illuminate\Support\Str::slug($doc->title)) }}" 
                                       target="{{ !empty($doc->video_link) ? '_blank' : '_self' }}">
                                        {{ $doc->title }}
                                    </a>
                                </h5>
                                @if(!empty($doc->excerpt))
                                    <p class="doc-excerpt">{{ \Illuminate\Support\Str::limit($doc->excerpt, 100) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5" data-aos="fade-up">
                        <i class="far fa-folder-open fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">Belum ada dokumentasi atau berita yang dipublikasikan.</h4>
                        <a href="{{ route('landing') }}" class="btn btn-primary mt-3">Kembali ke Beranda</a>
                    </div>
                @endforelse
            </div>

            @if(isset($documentations) && $documentations->isNotEmpty())
                <div class="text-center mt-5" data-aos="fade-up">
                    <a href="{{ route('landing') }}#dokumentasi" class="btn btn-outline-primary px-4 py-2 rounded-pill fw-bold">
                        <i class="fas fa-arrow-left me-2"></i> Kembali ke Beranda
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Footer Simple -->
    <footer>
        <div class="container">
            <p class="mb-0">{!! \App\Models\Setting::get('footer_copyright', '&copy; ' . date('Y') . ' <strong>SIKES</strong> - Sistem Informasi UKS. All rights reserved.') !!}</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true, offset: 80 });
    </script>
</body>
</html>