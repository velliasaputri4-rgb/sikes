<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Kunjungan - {{ $student->full_name }} - SIKES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #2563EB;
            --secondary: #1e40af;
            --success: #10b981;
            --info: #3b82f6;
        }
        body { 
            font-family: 'Segoe UI', 'Inter', system-ui, sans-serif;
            background: linear-gradient(135deg, #f0f7ff 0%, #e0f2fe 100%);
            min-height: 100vh;
            color: #1e293b;
        }
        
        /* Header Profil */
        .header-profile { 
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); 
            color: #1e293b; 
            padding: 50px 0 70px; 
            border-radius: 0 0 40px 40px; 
            margin-bottom: 50px;
            position: relative;
            overflow: hidden;
        }
        .header-profile::before {
            content: '';
            position: absolute;
            top: -20%;
            right: -5%;
            width: 400px;
            height: 400px;
            background: rgba(37, 99, 235, 0.05);
            border-radius: 50%;
        }
        .header-profile::after {
            content: '';
            position: absolute;
            bottom: -10%;
            left: -5%;
            width: 300px;
            height: 300px;
            background: rgba(37, 99, 235, 0.03);
            border-radius: 50%;
        }
        .header-profile h3 {
            color: #0f172a;
            font-weight: 800;
            font-size: 2rem;
        }
        .avatar-box {
            background: white;
            padding: 8px;
            border-radius: 50%;
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.15);
            display: inline-block;
            margin-bottom: 20px;
        }
        .avatar-box img {
            border: 3px solid #eff6ff;
        }
        
        /* Record Card */
        .record-card { 
            background: white; 
            border-radius: 16px; 
            padding: 25px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.06); 
            margin-bottom: 20px; 
            border-left: 5px solid var(--primary);
            transition: transform 0.2s;
        }
        .record-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.1);
        }
        
        /* Badges */
        .badge-sakit { background-color: #fee2e2; color: #dc2626; }
        .badge-sehat { background-color: #dcfce7; color: #16a34a; }
        
        /* Buttons */
        .btn-soft-outline {
            background: rgba(255, 255, 255, 0.6);
            color: var(--primary);
            border: 1px solid rgba(37, 99, 235, 0.2);
            font-weight: 600;
        }
        .btn-soft-outline:hover {
            background: rgba(37, 99, 235, 0.1);
            color: var(--primary);
            border-color: var(--primary);
        }
        .btn-soft-white {
            background: white;
            color: var(--primary);
            border: none;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .btn-soft-white:hover {
            background: #f8fafc;
            color: var(--secondary);
        }
    </style>
</head>
<body>

    <!-- Header Profil Siswa -->
    <div class="header-profile text-center">
        <div class="container position-relative" style="z-index: 2;">
            
            <!-- Avatar -->
            <div class="avatar-box mb-3">
                <img src="{{ $student->user->photo ? asset('storage/' . $student->user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($student->full_name) . '&background=eff6ff&color=2563EB&size=128' }}" 
                     class="rounded-circle" width="110" height="110" style="object-fit: cover;">
            </div>
            
            <!-- Nama Siswa -->
            <h3 class="fw-bold mb-3 text-dark">{{ $student->full_name }}</h3>
            
            <!-- Info NIS & Kelas -->
            <div class="d-flex justify-content-center gap-3 mb-4">
                <div class="bg-white bg-opacity-75 px-4 py-2 rounded-3 shadow-sm">
                    <small class="text-muted d-block" style="font-size: 11px; letter-spacing: 0.5px;">NIS</small>
                    <strong class="text-primary fs-6">{{ $student->nis }}</strong>
                </div>
                <div class="bg-white bg-opacity-75 px-4 py-2 rounded-3 shadow-sm">
                    <small class="text-muted d-block" style="font-size: 11px; letter-spacing: 0.5px;">KELAS</small>
                    <strong class="text-primary fs-6">{{ $student->class->name ?? '-' }}</strong>
                </div>
            </div>
            
            <!-- Tombol -->
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('landing') }}" class="btn btn-soft-outline rounded-pill px-4 py-2">
                    <i class="fas fa-home me-2"></i>Kembali ke Beranda
                </a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-soft-white rounded-pill px-4 py-2">
                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Konten Riwayat -->
    <div class="container pb-5">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <h4 class="fw-bold text-dark mb-0">
                <i class="fas fa-file-medical text-primary me-2"></i>
                Riwayat Kunjungan UKS Saya
            </h4>
            <button onclick="window.print()" class="btn btn-soft-outline btn-sm rounded-pill px-3">
                <i class="fas fa-print me-1"></i> Cetak Riwayat
            </button>
        </div>

        @forelse($examinations as $exam)
            <div class="record-card">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h5 class="fw-bold mb-1 text-dark">{{ $exam->examination_date->format('d F Y') }}</h5>
                        <small class="text-muted"><i class="far fa-clock me-1"></i> {{ $exam->examination_date->format('H:i') }} WIB</small>
                    </div>
                    @php
                        $isSakit = in_array($exam->status, ['pulang', 'rawat_jalan', 'rujuk_puskesmas', 'rujuk_rs']);
                    @endphp
                    <span class="badge {{ $isSakit ? 'badge-sakit' : 'badge-sehat' }} px-3 py-2 rounded-pill fw-semibold">
                        <i class="fas {{ $isSakit ? 'fa-notes-medical' : 'fa-check-circle' }} me-1"></i>
                        {{ $isSakit ? 'Sakit' : 'Tidak Sakit / Sehat' }}
                    </span>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <small class="text-muted text-uppercase fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">Keluhan</small>
                            <p class="mb-0 fw-semibold text-dark">{{ $exam->complaint }}</p>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted text-uppercase fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">Diagnosa</small>
                            <p class="mb-0 text-dark">{{ $exam->diagnosis }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <small class="text-muted text-uppercase fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">Tindakan / Pengobatan</small>
                            <p class="mb-0 text-dark">{{ $exam->treatment ?: '-' }}</p>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted text-uppercase fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">Petugas Penangani</small>
                            <p class="mb-0 text-dark">
                                <i class="fas fa-user-nurse me-1 text-primary"></i> 
                                {{ $exam->officer->user->name ?? 'Petugas UKS' }}
                            </p>
                        </div>
                    </div>
                </div>

                @if($exam->notes)
                    <div class="mt-3 pt-3 border-top">
                        <small class="text-muted text-uppercase fw-semibold" style="font-size: 11px; letter-spacing: 0.5px;">Catatan Tambahan</small>
                        <p class="mb-0 fst-italic text-secondary">"{{ $exam->notes }}"</p>
                    </div>
                @endif
            </div>
        @empty
            <div class="text-center py-5 bg-white rounded-4 shadow-sm">
                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px;">
                    <i class="fas fa-folder-open fa-3x text-muted opacity-25"></i>
                </div>
                <h5 class="text-muted fw-bold">Belum ada riwayat kunjungan</h5>
                <p class="text-muted small mb-0">Anda belum pernah mengunjungi UKS. Silakan kunjungi UKS jika merasa tidak sehat.</p>
            </div>
        @endforelse

        <!-- Pagination -->
        @if(isset($examinations) && $examinations->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $examinations->links() }}
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>