@extends('layouts.admin')

@section('page-title', 'Dashboard Admin')

@section('content')
<style>
    .welcome-banner {
        background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 55%, #2563eb 100%);
        border-radius: 16px;
        padding: 26px 30px;
        color: white;
        position: relative;
        overflow: hidden;
        margin-bottom: 24px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.25);
    }
    .welcome-banner::after {
        content: '';
        position: absolute;
        right: -50px; top: -50px;
        width: 220px; height: 220px;
        background: rgba(245, 158, 11, 0.18);
        border-radius: 50%;
    }
    .welcome-banner h4 { font-weight: 800; }
    .welcome-banner .date-chip {
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.25);
        padding: 7px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-home {
        background: rgba(255,255,255,0.15);
        border: 1px solid rgba(255,255,255,0.3);
        color: white;
        padding: 8px 18px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
    }
    .btn-home:hover {
        background: rgba(255,255,255,0.25);
        color: white;
        transform: translateY(-2px);
    }

    .stat-card {
        border-radius: 14px;
        padding: 22px;
    }
    .stat-card .stat-icon {
        width: 46px;
        height: 46px;
        font-size: 19px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }
    .stat-card h3 {
        font-size: 30px;
        font-weight: 800;
        margin-bottom: 2px;
    }
    .stat-card p {
        white-space: normal;
        margin-bottom: 4px;
    }

    .menu-cepat-card {
        background: white;
        border-radius: 12px;
        padding: 24px 15px;
        text-align: center;
        text-decoration: none;
        color: #334155;
        border: 2px solid #f1f5f9;
        transition: all 0.3s ease;
        display: block;
        height: 100%;
    }
    .menu-cepat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.1);
        border-color: #f59e0b;
        color: #1e293b;
    }
    .menu-cepat-card .icon-wrap {
        width: 58px; height: 58px;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 12px;
        font-size: 23px;
    }
    .menu-cepat-card .label { font-weight: 700; font-size: 14px; }
    .menu-cepat-card small { color: #94a3b8; }
</style>

<!-- Banner Sambutan -->
<div class="welcome-banner">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 position-relative" style="z-index: 2;">
        <div>
            <h4 class="mb-1">Selamat Datang, {{ auth()->user()->name }}!</h4>
            <p class="mb-0 opacity-75">Berikut ringkasan aktivitas UKS SMK Negeri 1 Bangsri.</p>
        </div>
        <div class="d-flex gap-2 align-items-center">
            <span class="date-chip">
                <i class="fas fa-calendar-day"></i>
                {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
            </span>
            {{-- ✅ PERBAIKAN: tanpa target="_blank" --}}
            <a href="{{ route('landing') }}" class="btn-home">
                <i class="fas fa-home"></i> Beranda
            </a>
        </div>
    </div>
</div>

<!-- STAT CARDS VERTIKAL -->
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="stat-card h-100" style="border-left-color: #2563eb;">
            <div class="stat-icon" style="background: linear-gradient(135deg, #dbeafe, #bfdbfe); color: #2563eb;">
                <i class="fas fa-stethoscope"></i>
            </div>
            <h3 style="color: #2563eb;">{{ $exams_today ?? 0 }}</h3>
            <p>Kunjungan Hari Ini</p>
            <small class="text-muted">Siswa dilayani</small>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card h-100" style="border-left-color: #10b981;">
            <div class="stat-icon" style="background: linear-gradient(135deg, #d1fae5, #a7f3d0); color: #059669;">
                <i class="fas fa-calendar-check"></i>
            </div>
            <h3 style="color: #059669;">{{ $exams_month ?? 0 }}</h3>
            <p>Kunjungan Bulan Ini</p>
            <small class="text-muted">Total kunjungan</small>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card h-100" style="border-left-color: #f59e0b;">
            <div class="stat-icon" style="background: linear-gradient(135deg, #fef3c7, #fde68a); color: #d97706;">
                <i class="fas fa-users"></i>
            </div>
            <h3 style="color: #d97706;">{{ $total_siswa ?? 0 }}</h3>
            <p>Total Siswa</p>
            <small class="text-muted">Siswa terdaftar</small>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card h-100" style="border-left-color: #ef4444;">
            <div class="stat-icon" style="background: linear-gradient(135deg, #fee2e2, #fecaca); color: #dc2626;">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h3 style="color: #dc2626;">{{ $low_stock ?? 0 }}</h3>
            <p>Stok Obat Menipis</p>
            <small class="text-muted">Perlu restock</small>
        </div>
    </div>
</div>

<!-- Menu Cepat -->
<div class="content-card">
    <h5 class="fw-bold mb-1">Menu Cepat</h5>
    <small class="text-muted d-block mb-4">Akses cepat ke fitur utama sistem</small>
    
    <div class="row g-3">
        <div class="col-xl-3 col-md-6">
            <a href="{{ route('admin.students.index') }}" class="menu-cepat-card">
                <div class="icon-wrap" style="background: linear-gradient(135deg, #dbeafe, #bfdbfe); color: #2563eb;">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="label">Data Siswa</div>
                <small>Kelola data siswa</small>
            </a>
        </div>
        <div class="col-xl-3 col-md-6">
            <a href="{{ route('admin.examinations.index') }}" class="menu-cepat-card">
                <div class="icon-wrap" style="background: linear-gradient(135deg, #d1fae5, #a7f3d0); color: #059669;">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="label">Data Kunjungan</div>
                <small>Lihat semua kunjungan</small>
            </a>
        </div>
        <div class="col-xl-3 col-md-6">
            <a href="{{ route('admin.medicines.index') }}" class="menu-cepat-card">
                <div class="icon-wrap" style="background: linear-gradient(135deg, #fef3c7, #fde68a); color: #d97706;">
                    <i class="fas fa-pills"></i>
                </div>
                <div class="label">Data Obat</div>
                <small>Stok & inventaris obat</small>
            </a>
        </div>
        <div class="col-xl-3 col-md-6">
            <a href="{{ route('admin.cms.index') }}" class="menu-cepat-card">
                <div class="icon-wrap" style="background: linear-gradient(135deg, #cffafe, #a5f3fc); color: #0891b2;">
                    <i class="fas fa-globe"></i>
                </div>
                <div class="label">CMS Website</div>
                <small>Kelola konten website</small>
            </a>
        </div>
    </div>
</div>

<!-- Manajemen Sistem -->
<div class="content-card">
    <h5 class="fw-bold mb-1">Manajemen Sistem</h5>
    <small class="text-muted d-block mb-4">Kelola pengguna dan pengaturan sistem</small>
    
    <div class="row g-3">
        <div class="col-md-4">
            <a href="{{ route('admin.users.index') }}" class="menu-cepat-card">
                <div class="icon-wrap" style="background: linear-gradient(135deg, #e0e7ff, #c7d2fe); color: #4f46e5;">
                    <i class="fas fa-users-cog"></i>
                </div>
                <div class="label">Kelola User</div>
                <small>Admin & petugas</small>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.settings.index') }}" class="menu-cepat-card">
                <div class="icon-wrap" style="background: linear-gradient(135deg, #f3e8ff, #e9d5ff); color: #7c3aed;">
                    <i class="fas fa-cog"></i>
                </div>
                <div class="label">Pengaturan</div>
                <small>Konfigurasi sistem</small>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('landing') }}" class="menu-cepat-card" target="_blank">
                <div class="icon-wrap" style="background: linear-gradient(135deg, #fce7f3, #fbcfe8); color: #db2777;">
                    <i class="fas fa-external-link-alt"></i>
                </div>
                <div class="label">Lihat Website</div>
                <small>Buka halaman publik</small>
            </a>
        </div>
    </div>
</div>
@endsection