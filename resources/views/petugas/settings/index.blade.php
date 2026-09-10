@extends('layouts.petugas')

@section('title', 'Pengaturan Website')
@section('page-title', 'Pengaturan Teks Landing Page')

@section('content')
<style>
    /* ✅ PERBAIKAN Z-INDEX: Pastikan modal muncul di atas sidebar & sticky bottom */
    .modal {
        z-index: 1060 !important;
    }
    .modal-backdrop {
        z-index: 1050 !important;
    }
    .sticky-bottom {
        z-index: 100 !important; /* Di bawah modal, tapi di atas konten biasa */
    }

    /* CSS KHUSUS UNTUK TAB NAVIGASI BERGAYA CARD */
    .settings-tab-wrapper {
        background: #f8fafc;
        padding: 12px;
        border-radius: 14px;
        margin-bottom: 24px;
        border: 1px solid #e2e8f0;
        position: relative;
        z-index: 1;
    }
    .settings-tab-wrapper .nav-pills {
        gap: 8px;
        flex-wrap: wrap;
    }
    .settings-tab-wrapper .nav-link {
        background: #ffffff;
        color: #475569;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 10px 18px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.25s ease;
        box-shadow: 0 1px 2px rgba(0,0,0,0.04);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .settings-tab-wrapper .nav-link:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        color: #1e293b;
    }
    .settings-tab-wrapper .nav-link.active {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        color: #ffffff;
        border-color: #2563eb;
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.35);
        transform: translateY(-2px);
    }
    .settings-tab-wrapper .nav-link.active i {
        color: #ffffff;
    }
    .settings-tab-wrapper .nav-link i {
        color: #64748b;
        font-size: 1rem;
        transition: color 0.25s ease;
    }
    .settings-tab-wrapper .nav-link:hover i {
        color: #2563eb;
    }

    /* ✅ OPTIMASI MOBILE: Tab scroll horizontal & form rapi */
    @media (max-width: 768px) {
        .settings-tab-wrapper {
            padding: 10px;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE and Edge */
        }
        .settings-tab-wrapper::-webkit-scrollbar {
            display: none; /* Chrome, Safari, Opera */
        }
        .settings-tab-wrapper .nav-pills {
            flex-wrap: nowrap;
            width: max-content;
            gap: 10px;
        }
        .settings-tab-wrapper .nav-link {
            padding: 10px 16px;
            font-size: 0.85rem;
            white-space: nowrap;
            flex-shrink: 0;
        }
        .settings-tab-wrapper .nav-link i {
            font-size: 0.9rem;
        }
        
        /* Form adjustments for mobile */
        .content-card {
            padding: 16px;
        }
        .card-body {
            padding: 16px;
        }
        .form-label {
            font-size: 0.85rem;
            margin-bottom: 6px;
        }
        .form-control, .form-select {
            font-size: 0.95rem; /* Mencegah auto-zoom di iOS */
            padding: 10px 12px;
        }
    }
</style>

<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h5 class="fw-bold mb-0"><i class="fas fa-cog me-2 text-primary"></i>Pengaturan Teks Website</h5>
            <small class="text-muted">Ubah semua teks, judul, deskripsi, gambar layanan, dan dokumentasi yang muncul di halaman depan (Landing Page) SIKES.</small>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('petugas.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- ✅ Tabs Navigasi dengan Card Tipis -->
        <div class="settings-tab-wrapper">
            <ul class="nav nav-pills" id="settingsTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="hero-tab" data-bs-toggle="pill" data-bs-target="#hero" type="button">
                        <i class="fas fa-home"></i> Hero (Beranda)
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="about-tab" data-bs-toggle="pill" data-bs-target="#about" type="button">
                        <i class="fas fa-info-circle"></i> Tentang
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="services-tab" data-bs-toggle="pill" data-bs-target="#services" type="button">
                        <i class="fas fa-concierge-bell"></i> Layanan
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="docs-tab" data-bs-toggle="pill" data-bs-target="#docs" type="button">
                        <i class="fas fa-newspaper"></i> Dokumentasi
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="health-info-tab" data-bs-toggle="pill" data-bs-target="#health-info" type="button">
                        <i class="fas fa-heartbeat"></i> Info Kesehatan
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="pill" data-bs-target="#contact" type="button">
                        <i class="fas fa-address-book"></i> Kontak
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="footer-tab" data-bs-toggle="pill" data-bs-target="#footer" type="button">
                        <i class="fas fa-shoe-prints"></i> Footer
                    </button>
                </li>
            </ul>
        </div>

        <div class="tab-content" id="settingsTabContent">
            
            <!-- 1. HERO SECTION -->
            <div class="tab-pane fade show active" id="hero" role="tabpanel">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light fw-bold">Bagian Hero (Tampilan Utama Atas)</div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-semibold">Judul Utama</label>
                                @php
                                    $rawHero = $settings['hero_title'] ?? "Selamat Datang di\nSistem Informasi UKS\nSMK Negeri 1 Bangsri";
                                    $cleanHero = str_replace(['<br>', '<br/>', '<br />', '&lt;br&gt;', '&lt;br/&gt;', '&lt;br /&gt;'], "\n", strip_tags($rawHero));
                                @endphp
                                <textarea name="hero_title" class="form-control" rows="3" placeholder="Tekan Enter untuk baris baru">{{ $cleanHero }}</textarea>
                                <small class="text-muted">Tekan Enter pada keyboard untuk membuat baris baru.</small>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Subjudul</label>
                                <textarea name="hero_subtitle" class="form-control" rows="2">{{ $settings['hero_subtitle'] ?? 'Layanan kesehatan sekolah yang modern, cepat, dan terpercaya. Kami siap melayani kebutuhan kesehatan siswa dengan profesional.' }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Teks Tombol 1 (Kiri)</label>
                                <input type="text" name="hero_btn_1_text" class="form-control" value="{{ $settings['hero_btn_1_text'] ?? 'Riwayat Kunjungan' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Teks Tombol 2 (Kanan)</label>
                                <input type="text" name="hero_btn_2_text" class="form-control" value="{{ $settings['hero_btn_2_text'] ?? 'Pelajari Lebih Lanjut' }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. ABOUT SECTION -->
            <div class="tab-pane fade" id="about" role="tabpanel">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light fw-bold">Bagian Tentang Kami</div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Label Kecil di Atas</label>
                                <input type="text" name="about_label" class="form-control" value="{{ $settings['about_label'] ?? 'Tentang Kami' }}">
                            </div>
                            <div class="col-md-8">
                                <label class="form-label fw-semibold">Judul Section</label>
                                <input type="text" name="about_title" class="form-control" value="{{ strip_tags($settings['about_title'] ?? 'Mengenal Lebih Dekat SIKES') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Deskripsi Panjang</label>
                                <textarea name="about_desc" class="form-control" rows="4">{{ $settings['about_desc'] ?? 'SIKES adalah sistem informasi berbasis web yang membantu Unit Kesehatan Sekolah (UKS) mengelola data kesehatan siswa secara digital, terintegrasi, dan efisien.' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. SERVICES SECTION -->
            <div class="tab-pane fade" id="services" role="tabpanel">
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-header bg-light fw-bold">Header Bagian Layanan</div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Label Kecil</label>
                                <input type="text" name="services_label" class="form-control" value="{{ $settings['services_label'] ?? 'Layanan Kami' }}">
                            </div>
                            <div class="col-md-8">
                                <label class="form-label fw-semibold">Judul Section</label>
                                <input type="text" name="services_title" class="form-control" value="{{ strip_tags($settings['services_title'] ?? 'Layanan Kesehatan Profesional') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Subjudul / Deskripsi Section</label>
                                <input type="text" name="services_subtitle" class="form-control" value="{{ $settings['services_subtitle'] ?? 'Berbagai layanan kesehatan lengkap yang kami sediakan untuk siswa' }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light fw-bold">Daftar Layanan</div>
                    <div class="card-body">
                        @php
                            $defaultServices = [
                                ['icon' => 'fa-stethoscope', 'title' => 'Pemeriksaan Kesehatan', 'desc' => 'Pemeriksaan rutin dan saat sakit dengan tenaga profesional.', 'image' => ''],
                                ['icon' => 'fa-pills', 'title' => 'Pelayanan Obat', 'desc' => 'Penyediaan obat lengkap dan terjamin kualitasnya.', 'image' => ''],
                                ['icon' => 'fa-heartbeat', 'title' => 'Pertolongan Pertama', 'desc' => 'Pertolongan pertama pada kecelakaan & keadaan darurat.', 'image' => ''],
                                ['icon' => 'fa-user-md', 'title' => 'Konsultasi Kesehatan', 'desc' => 'Konsultasi kesehatan fisik dan mental dengan petugas terlatih.', 'image' => ''],
                                ['icon' => 'fa-clipboard-check', 'title' => 'Pemeriksaan Berkala', 'desc' => 'Pemeriksaan berkala untuk memantau kondisi siswa.', 'image' => ''],
                                ['icon' => 'fa-graduation-cap', 'title' => 'Edukasi Kesehatan', 'desc' => 'Penyuluhan dan edukasi tentang pola hidup sehat.', 'image' => '']
                            ];
                            $servicesRaw = $settings['services_data'] ?? json_encode($defaultServices);
                            $servicesData = is_array($servicesRaw) ? $servicesRaw : json_decode($servicesRaw, true);
                        @endphp

                        @foreach($servicesData as $index => $service)
                            <div class="service-row border rounded p-3 mb-3 bg-light position-relative">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">Gambar Layanan</label>
                                        @if(!empty($service['image']))
                                            <input type="hidden" name="services[{{ $index }}][existing_image]" value="{{ $service['image'] }}">
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $service['image']) }}" class="img-thumbnail" style="max-height: 80px; width: 100%; object-fit: cover;">
                                            </div>
                                        @endif
                                        <input type="file" name="services[{{ $index }}][image]" class="form-control form-control-sm" accept="image/*">
                                        <small class="text-muted" style="font-size: 0.75rem;">Upload baru untuk mengganti.</small>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label small fw-bold">Icon (FontAwesome)</label>
                                                <input type="text" name="services[{{ $index }}][icon]" class="form-control" value="{{ $service['icon'] ?? 'fa-star' }}" placeholder="fa-stethoscope">
                                            </div>
                                            <div class="col-md-8">
                                                <label class="form-label small fw-bold">Judul Layanan</label>
                                                <input type="text" name="services[{{ $index }}][title]" class="form-control" value="{{ $service['title'] ?? '' }}">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label small fw-bold">Deskripsi Layanan</label>
                                                <input type="text" name="services[{{ $index }}][desc]" class="form-control" value="{{ $service['desc'] ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- 4. DOKUMENTASI SECTION -->
            <div class="tab-pane fade" id="docs" role="tabpanel">
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-header bg-light fw-bold">Header Bagian Dokumentasi</div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Label Kecil</label>
                                <input type="text" name="docs_label" class="form-control" value="{{ $settings['docs_label'] ?? 'Dokumentasi' }}">
                            </div>
                            <div class="col-md-8">
                                <label class="form-label fw-semibold">Judul Section</label>
                                <input type="text" name="docs_title" class="form-control" value="{{ strip_tags($settings['docs_title'] ?? 'Berita & Kegiatan') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Subjudul / Deskripsi Section</label>
                                <input type="text" name="docs_subtitle" class="form-control" value="{{ $settings['docs_subtitle'] ?? 'Informasi terbaru seputar kegiatan dan program UKS di sekolah kami' }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light fw-bold d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <span><i class="fas fa-newspaper me-2 text-primary"></i>Daftar Item Berita/Kegiatan</span>
                        <button type="button" class="btn btn-sm btn-success w-100 w-md-auto" onclick="addDocumentationRow()">
                            <i class="fas fa-plus"></i> <span class="d-none d-sm-inline">Tambah Item</span><span class="d-sm-none">Tambah</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">Kelola item berita/kegiatan yang muncul di halaman depan. Kosongkan judul untuk menghapus item saat disimpan.</p>
                        
                        <div id="documentations-container">
                            @php
                                $docsRaw = $settings['documentations_data'] ?? '[]';
                                $docsData = is_array($docsRaw) ? $docsRaw : json_decode($docsRaw, true);
                                
                                if (empty($docsData) || !is_array($docsData)) {
                                    $docsData = [['title' => '', 'excerpt' => '', 'video_link' => '', 'published_at' => date('Y-m-d'), 'image' => '']];
                                }
                                $initialDocCount = count($docsData);
                            @endphp

                            @foreach($docsData as $index => $doc)
                                <div class="documentation-row border rounded p-3 mb-3 bg-light position-relative">
                                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2" onclick="removeDocumentationRow(this)" title="Hapus Baris">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    
                                    <div class="row g-3">
                                        <div class="col-md-5">
                                            <label class="form-label small fw-bold">Judul Berita/Kegiatan *</label>
                                            <input type="text" name="documentations[{{ $index }}][title]" class="form-control" value="{{ $doc['title'] ?? '' }}" placeholder="Contoh: Pembinaan UKS">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label small fw-bold">Tanggal</label>
                                            <input type="date" name="documentations[{{ $index }}][published_at]" class="form-control" value="{{ $doc['published_at'] ?? date('Y-m-d') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label small fw-bold">Link Video (Opsional)</label>
                                            <input type="url" name="documentations[{{ $index }}][video_link]" class="form-control" value="{{ $doc['video_link'] ?? '' }}" placeholder="https://youtube.com/...">
                                            <small class="text-muted" style="font-size: 0.75rem;">Jika diisi, akan muncul ikon "Play" di halaman depan.</small>
                                        </div>
                                        
                                        <div class="col-md-8">
                                            <label class="form-label small fw-bold">Ringkasan (Excerpt)</label>
                                            <textarea name="documentations[{{ $index }}][excerpt]" class="form-control" rows="2" placeholder="Deskripsi singkat...">{{ $doc['excerpt'] ?? '' }}</textarea>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label class="form-label small fw-bold">Gambar Thumbnail</label>
                                            @if(!empty($doc['image']))
                                                <input type="hidden" name="documentations[{{ $index }}][existing_image]" value="{{ $doc['image'] }}">
                                                <div class="mb-2">
                                                    <img src="{{ asset('storage/' . $doc['image']) }}" class="img-thumbnail" style="max-height: 80px;">
                                                </div>
                                            @endif
                                            <input type="file" name="documentations[{{ $index }}][image]" class="form-control form-control-sm" accept="image/*">
                                            <small class="text-muted" style="font-size: 0.75rem;">Upload baru untuk mengganti gambar.</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- ✅ 4.5. HEALTH INFO SECTION -->
            <div class="tab-pane fade" id="health-info" role="tabpanel">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light fw-bold">Bagian Informasi Kesehatan (Landing Page)</div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Label Kecil (Badge)</label>
                                <input type="text" name="health_info_label" class="form-control" value="{{ strip_tags($settings['health_info_label'] ?? 'Pusat Informasi Kesehatan') }}">
                                <small class="text-muted">Contoh: Pusat Informasi Kesehatan</small>
                            </div>
                            <div class="col-md-8">
                                <label class="form-label fw-semibold">Judul Utama Halaman</label>
                                <input type="text" name="health_info_title" class="form-control" value="{{ strip_tags($settings['health_info_title'] ?? 'Informasi Kesehatan & Gaya Hidup Sehat') }}">
                                <small class="text-muted">Judul yang muncul di halaman Informasi Kesehatan.</small>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Subjudul / Deskripsi Halaman</label>
                                <textarea name="health_info_subtitle" class="form-control" rows="3">{{ strip_tags($settings['health_info_subtitle'] ?? 'Artikel edukasi lengkap untuk mendukung kesejahteraan dan gaya hidup sehat siswa SMK Negeri 1 Bangsri.') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 5. CONTACT SECTION -->
            <div class="tab-pane fade" id="contact" role="tabpanel">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light fw-bold">Bagian Kontak & Alamat</div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Label Kecil</label>
                                <input type="text" name="contact_label" class="form-control" value="{{ $settings['contact_label'] ?? 'Hubungi Kami' }}">
                            </div>
                            <div class="col-md-8">
                                <label class="form-label fw-semibold">Judul Section</label>
                                <input type="text" name="contact_title" class="form-control" value="{{ strip_tags($settings['contact_title'] ?? 'Siap Melayani Anda') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Subjudul</label>
                                <input type="text" name="contact_subtitle" class="form-control" value="{{ $settings['contact_subtitle'] ?? 'Hubungi kami untuk informasi lebih lanjut tentang layanan UKS' }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Alamat Lengkap</label>
                                @php
                                    $rawAddress = $settings['contact_address'] ?? "Komplek SMK Negeri 1 Bangsri\nJalan KH. Achmad Fauzan No.17, Bangsri, Jepara\nJawa Tengah, 59453";
                                    $cleanAddress = str_replace(['<br>', '<br/>', '<br />', '&lt;br&gt;', '&lt;br/&gt;', '&lt;br /&gt;'], "\n", strip_tags($rawAddress));
                                @endphp
                                <textarea name="contact_address" class="form-control" rows="3">{{ $cleanAddress }}</textarea>
                                <small class="text-muted">Tekan Enter pada keyboard untuk baris baru.</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Username Instagram</label>
                                <div class="input-group">
                                    <span class="input-group-text">@</span>
                                    <input type="text" name="contact_ig_handle" class="form-control" value="{{ $settings['contact_ig_handle'] ?? 'pmrwira_eskasaba' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Link Instagram</label>
                                <input type="url" name="contact_ig_link" class="form-control" value="{{ $settings['contact_ig_link'] ?? 'https://instagram.com/pmrwira_eskasaba' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Username YouTube</label>
                                <div class="input-group">
                                    <span class="input-group-text">@</span>
                                    <input type="text" name="contact_yt_handle" class="form-control" value="{{ $settings['contact_yt_handle'] ?? 'wirasandyaadhimukti3463' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Link YouTube</label>
                                <input type="url" name="contact_yt_link" class="form-control" value="{{ $settings['contact_yt_link'] ?? 'https://youtube.com/@wirasandyaadhimukti3463' }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 6. FOOTER SECTION -->
            <div class="tab-pane fade" id="footer" role="tabpanel">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light fw-bold">Bagian Footer (Bawah)</div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label fw-semibold">Deskripsi Singkat Footer</label>
                                <textarea name="footer_desc" class="form-control" rows="2">{{ $settings['footer_desc'] ?? 'Sistem Informasi Unit Kesehatan Sekolah modern dan terpercaya untuk meningkatkan kualitas kesehatan seluruh warga sekolah.' }}</textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Teks Hak Cipta (Copyright)</label>
                                <input type="text" name="footer_copyright" class="form-control" value="{{ strip_tags($settings['footer_copyright'] ?? '© ' . date('Y') . ' SIKES - Sistem Informasi UKS SMK Negeri 1 Bangsri. All rights reserved.') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Tombol Simpan -->
        <div class="d-flex justify-content-end mt-4 pt-3 border-top sticky-bottom bg-white pb-3">
            <a href="{{ route('petugas.dashboard') }}" class="btn btn-outline-secondary me-2">Batal</a>
            <button type="submit" class="btn btn-primary-custom px-4">
                <i class="fas fa-save me-2"></i> Simpan Semua Perubahan
            </button>
        </div>
    </form>
</div>

<!-- JavaScript untuk Tambah/Hapus Baris Dokumentasi -->
<script>
    let docIndex = {{ $initialDocCount ?? 1 }};

    function addDocumentationRow() {
        const container = document.getElementById('documentations-container');
        const today = new Date().toISOString().split('T')[0];
        
        const newRow = document.createElement('div');
        newRow.className = 'documentation-row border rounded p-3 mb-3 bg-light position-relative';
        newRow.innerHTML = `
            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2" onclick="removeDocumentationRow(this)" title="Hapus Baris">
                <i class="fas fa-trash"></i>
            </button>
            <div class="row g-3">
                <div class="col-md-5">
                    <label class="form-label small fw-bold">Judul Berita/Kegiatan *</label>
                    <input type="text" name="documentations[${docIndex}][title]" class="form-control" placeholder="Contoh: Pembinaan UKS">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold">Tanggal</label>
                    <input type="date" name="documentations[${docIndex}][published_at]" class="form-control" value="${today}">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Link Video (Opsional)</label>
                    <input type="url" name="documentations[${docIndex}][video_link]" class="form-control" placeholder="https://youtube.com/...">
                </div>
                <div class="col-md-8">
                    <label class="form-label small fw-bold">Ringkasan (Excerpt)</label>
                    <textarea name="documentations[${docIndex}][excerpt]" class="form-control" rows="2" placeholder="Deskripsi singkat..."></textarea>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Gambar Thumbnail</label>
                    <input type="file" name="documentations[${docIndex}][image]" class="form-control form-control-sm" accept="image/*">
                </div>
            </div>
        `;
        container.appendChild(newRow);
        docIndex++;
    }

    function removeDocumentationRow(button) {
        const row = button.closest('.documentation-row');
        row.remove();
    }
</script>
@endsection