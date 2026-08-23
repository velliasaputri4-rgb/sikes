@extends('layouts.admin')

@section('title', 'Pengaturan Website (CMS)')
@section('page-title', 'Pengaturan & CMS Website')

@section('content')
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0"><i class="fas fa-cog me-2 text-primary"></i>Pengaturan Konten Website</h5>
    </div>

    <div class="alert alert-info border-0" style="background-color: #eff6ff; color: #1e40af;">
        <i class="fas fa-info-circle me-2"></i>
        Ubah data di bawah ini untuk memperbarui tampilan <strong>Website Publik (Landing Page)</strong> secara real-time.
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Nav Tabs -->
        <ul class="nav nav-tabs mb-4" id="settingsTab" role="tablist">
            <li class="nav-item"><button class="nav-link active fw-semibold" data-bs-toggle="tab" data-bs-target="#tab-identitas" type="button"><i class="fas fa-school me-2"></i>Identitas Sekolah</button></li>
            <li class="nav-item"><button class="nav-link fw-semibold" data-bs-toggle="tab" data-bs-target="#tab-landing" type="button"><i class="fas fa-image me-2"></i>Halaman Utama (Hero)</button></li>
            <li class="nav-item"><button class="nav-link fw-semibold" data-bs-toggle="tab" data-bs-target="#tab-sambutan" type="button"><i class="fas fa-user-tie me-2"></i>Sambutan & Visi Misi</button></li>
            <li class="nav-item"><button class="nav-link fw-semibold" data-bs-toggle="tab" data-bs-target="#tab-footer" type="button"><i class="fas fa-map-marked-alt me-2"></i>Kontak & Footer</button></li>
        </ul>

        <div class="tab-content">
            <!-- TAB 1: Identitas Sekolah -->
            <div class="tab-pane fade show active" id="tab-identitas">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Sekolah <span class="text-danger">*</span></label>
                        <input type="text" name="school_name" class="form-control" value="{{ old('school_name', $settings['school_name'] ?? 'SMK NEGERI 1 BANGSRI') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Kepala Sekolah</label>
                        <input type="text" name="principal_name" class="form-control" value="{{ old('principal_name', $settings['principal_name'] ?? '') }}" placeholder="Contoh: Drs. Budi Santoso, M.Pd.">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Logo Sekolah</label>
                        <input type="file" name="school_logo" class="form-control" accept="image/png, image/jpeg">
                        @if(!empty($settings['school_logo']))
                            <img src="{{ asset('storage/' . $settings['school_logo']) }}" class="mt-2" style="max-height: 80px;">
                        @endif
                    </div>
                </div>
            </div>

            <!-- TAB 2: Halaman Utama (Hero) -->
            <div class="tab-pane fade" id="tab-landing">
                <div class="row g-4">
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Judul Utama Website (Hero Title)</label>
                        <input type="text" name="hero_title" class="form-control" value="{{ old('hero_title', $settings['hero_title'] ?? 'Sistem Informasi Kesehatan Sekolah') }}">
                        <small class="text-muted">Teks besar yang muncul di bagian paling atas website.</small>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Sub-Judul (Hero Subtitle)</label>
                        <textarea name="hero_subtitle" class="form-control" rows="2">{{ old('hero_subtitle', $settings['hero_subtitle'] ?? 'Mewujudkan siswa yang sehat, cerdas, dan berprestasi melalui layanan kesehatan sekolah yang terintegrasi.') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- TAB 3: Sambutan & Visi Misi -->
            <div class="tab-pane fade" id="tab-sambutan">
                <div class="row g-4">
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Kata Sambutan Kepala Sekolah</label>
                        <textarea name="welcome_message" class="form-control" rows="5">{{ old('welcome_message', $settings['welcome_message'] ?? 'Selamat datang di website resmi UKS...') }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Visi</label>
                        <textarea name="vision" class="form-control" rows="4">{{ old('vision', $settings['vision'] ?? 'Menjadi UKS teladan yang mendukung kesehatan holistik siswa.') }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Misi</label>
                        <textarea name="mission" class="form-control" rows="4">{{ old('mission', $settings['mission'] ?? '1. Memberikan pelayanan kesehatan prima.\n2. Edukasi kesehatan secara berkala.') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- TAB 4: Kontak & Footer -->
            <div class="tab-pane fade" id="tab-footer">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Alamat Lengkap</label>
                        <textarea name="school_address" class="form-control" rows="2">{{ old('school_address', $settings['school_address'] ?? 'Jl. Pendidikan No. 1, Bangsri, Jepara') }}</textarea>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Nomor Telepon / WA</label>
                        <input type="text" name="school_phone" class="form-control" value="{{ old('school_phone', $settings['school_phone'] ?? '0812-3456-7890') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Email Resmi</label>
                        <input type="email" name="school_email" class="form-control" value="{{ old('school_email', $settings['school_email'] ?? 'info@sikes.sch.id') }}">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Teks Footer (Copyright)</label>
                        <input type="text" name="footer_text" class="form-control" value="{{ old('footer_text', $settings['footer_text'] ?? '© 2024 UKS SMK Negeri 1 Bangsri. All rights reserved.') }}">
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Simpan -->
        <div class="d-flex justify-content-end mt-4 pt-3 border-top">
            <button type="submit" class="btn btn-primary px-4">
                <i class="fas fa-save me-2"></i> Simpan Semua Pengaturan
            </button>
        </div>
    </form>
</div>
@endsection