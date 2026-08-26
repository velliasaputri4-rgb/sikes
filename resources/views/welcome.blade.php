@extends('layouts.admin')

@section('title', 'Pengaturan Website')
@section('page-title', 'Pengaturan Teks Landing Page')

@section('content')
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-0"><i class="fas fa-cog me-2 text-primary"></i>Pengaturan Teks Website</h5>
            <small class="text-muted">Ubah semua teks, judul, dan deskripsi yang muncul di halaman depan (Landing Page) SIKES.</small>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- Tabs Navigasi Cepat -->
        <ul class="nav nav-pills mb-4" id="settingsTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="hero-tab" data-bs-toggle="pill" data-bs-target="#hero" type="button"><i class="fas fa-home me-2"></i>Hero (Beranda)</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="about-tab" data-bs-toggle="pill" data-bs-target="#about" type="button"><i class="fas fa-info-circle me-2"></i>Tentang</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="services-tab" data-bs-toggle="pill" data-bs-target="#services" type="button"><i class="fas fa-concierge-bell me-2"></i>Layanan</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="pill" data-bs-target="#contact" type="button"><i class="fas fa-address-book me-2"></i>Kontak</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="footer-tab" data-bs-toggle="pill" data-bs-target="#footer" type="button"><i class="fas fa-shoe-prints me-2"></i>Footer</button>
            </li>
        </ul>

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
                                    $heroTitle = $settings['hero_title'] ?? "Selamat Datang di\nSistem Informasi UKS\nSMK Negeri 1 Bangsri";
                                    $cleanHeroTitle = str_replace(['<br>', '<br/>', '<br />'], "\n", strip_tags($heroTitle));
                                @endphp
                                <textarea name="hero_title" class="form-control" rows="3" placeholder="Tekan Enter untuk baris baru">{{ $cleanHeroTitle }}</textarea>
                                <small class="text-muted">Tekan Enter untuk membuat baris baru. Teks akan diformat otomatis di website.</small>
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
                                <textarea name="about_desc" class="form-control" rows="4">{{ $settings['about_desc'] ?? 'SIKES adalah sistem informasi berbasis web yang membantu Unit Kesehatan Sekolah (UKS) mengelola data kesehatan siswa secara digital, terintegrasi, dan efisien — mulai dari pencatatan pemeriksaan, pengelolaan stok obat, hingga pembuatan laporan.' }}</textarea>
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
                    <div class="card-header bg-light fw-bold">Daftar 6 Layanan</div>
                    <div class="card-body">
                        @php
                            $defaultServices = [
                                ['icon' => 'fa-stethoscope', 'title' => 'Pemeriksaan Kesehatan', 'desc' => 'Pemeriksaan rutin dan saat sakit dengan tenaga profesional.'],
                                ['icon' => 'fa-pills', 'title' => 'Pelayanan Obat', 'desc' => 'Penyediaan obat lengkap dan terjamin kualitasnya.'],
                                ['icon' => 'fa-heartbeat', 'title' => 'Pertolongan Pertama', 'desc' => 'Pertolongan pertama pada kecelakaan & keadaan darurat.'],
                                ['icon' => 'fa-user-md', 'title' => 'Konsultasi Kesehatan', 'desc' => 'Konsultasi kesehatan fisik dan mental dengan petugas terlatih.'],
                                ['icon' => 'fa-clipboard-check', 'title' => 'Pemeriksaan Berkala', 'desc' => 'Pemeriksaan berkala untuk memantau kondisi siswa.'],
                                ['icon' => 'fa-graduation-cap', 'title' => 'Edukasi Kesehatan', 'desc' => 'Penyuluhan dan edukasi tentang pola hidup sehat.']
                            ];
                            $servicesData = json_decode($settings['services_data'] ?? json_encode($defaultServices), true);
                        @endphp

                        @foreach($servicesData as $index => $service)
                            <div class="row g-3 mb-3 pb-3 border-bottom">
                                <div class="col-12"><h6 class="text-primary mb-2">Layanan {{ $index + 1 }}</h6></div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Icon (Class FontAwesome)</label>
                                    <input type="text" name="services[{{ $index }}][icon]" class="form-control" value="{{ $service['icon'] ?? 'fa-star' }}" placeholder="fa-stethoscope">
                                    <small class="text-muted">Contoh: fa-stethoscope, fa-pills</small>
                                </div>
                                <div class="col-md-9">
                                    <label class="form-label fw-semibold">Judul Layanan</label>
                                    <input type="text" name="services[{{ $index }}][title]" class="form-control" value="{{ $service['title'] ?? '' }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Deskripsi Layanan</label>
                                    <input type="text" name="services[{{ $index }}][desc]" class="form-control" value="{{ $service['desc'] ?? '' }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- 4. CONTACT SECTION -->
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
                                    $contactAddress = $settings['contact_address'] ?? "Komplek SMK Negeri 1 Bangsri\nJalan KH. Achmad Fauzan No.17, Bangsri, Jepara\nJawa Tengah, 59453";
                                    $cleanAddress = str_replace(['<br>', '<br/>', '<br />'], "\n", strip_tags($contactAddress));
                                @endphp
                                <textarea name="contact_address" class="form-control" rows="3">{{ $cleanAddress }}</textarea>
                                <small class="text-muted">Tekan Enter untuk baris baru</small>
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

            <!-- 5. FOOTER SECTION -->
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

        </div> <!-- End Tab Content -->

        <!-- Tombol Simpan -->
        <div class="d-flex justify-content-end mt-4 pt-3 border-top sticky-bottom bg-white pb-3">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary me-2">Batal</a>
            <button type="submit" class="btn btn-primary px-4">
                <i class="fas fa-save me-2"></i> Simpan Semua Perubahan
            </button>
        </div>
    </form>
</div>
@endsection