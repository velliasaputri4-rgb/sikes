<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Rekam Medis - SIKES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        .header-profile { background: linear-gradient(135deg, #2563EB 0%, #1d4ed8 100%); color: white; padding: 30px 0; border-radius: 0 0 20px 20px; margin-bottom: 30px; }
        .record-card { background: white; border-radius: 12px; padding: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); margin-bottom: 20px; border-left: 4px solid #2563EB; transition: 0.3s; }
        .record-card:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .badge-sakit { background-color: #fee2e2; color: #dc2626; }
        .badge-sehat { background-color: #dcfce7; color: #16a34a; }
    </style>
</head>
<body>

    <!-- Header Profil Siswa -->
    <div class="header-profile text-center">
        <div class="container">
            <img src="{{ $student->user->photo ? asset('storage/' . $student->user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($student->full_name) . '&background=fff&color=2563EB&size=128' }}" 
                 class="rounded-circle border border-3 border-white mb-3" width="100" height="100" style="object-fit: cover;">
            <h3 class="fw-bold mb-1">{{ $student->full_name }}</h3>
            <p class="mb-0 opacity-75">NIS: {{ $student->nis }} | Kelas: {{ $student->class->name ?? '-' }}</p>
            
            <div class="mt-3">
                <a href="{{ route('landing') }}" class="btn btn-outline-light btn-sm rounded-pill px-3">
                    <i class="fas fa-home me-1"></i> Kembali ke Beranda
                </a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-light btn-sm rounded-pill px-3 text-primary fw-semibold">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Konten Riwayat -->
    <div class="container pb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-dark mb-0"><i class="fas fa-file-medical text-primary me-2"></i>Riwayat Rekam Medis</h4>
            <button onclick="window.print()" class="btn btn-outline-primary btn-sm rounded-pill">
                <i class="fas fa-print me-1"></i> Cetak Riwayat
            </button>
        </div>

        @forelse($examinations as $exam)
            <div class="record-card">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h5 class="fw-bold mb-1">{{ $exam->examination_date->format('d F Y') }}</h5>
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
                            <small class="text-muted text-uppercase fw-semibold" style="font-size: 11px;">Keluhan</small>
                            <p class="mb-0 fw-semibold text-dark">{{ $exam->complaint }}</p>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted text-uppercase fw-semibold" style="font-size: 11px;">Diagnosa</small>
                            <p class="mb-0 text-dark">{{ $exam->diagnosis }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <small class="text-muted text-uppercase fw-semibold" style="font-size: 11px;">Tindakan / Pengobatan</small>
                            <p class="mb-0 text-dark">{{ $exam->treatment ?: '-' }}</p>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted text-uppercase fw-semibold" style="font-size: 11px;">Petugas Penangani</small>
                            <p class="mb-0 text-dark">
                                <i class="fas fa-user-nurse me-1 text-primary"></i> 
                                {{ $exam->officer->user->name ?? 'Petugas UKS' }}
                            </p>
                        </div>
                    </div>
                </div>

                @if($exam->notes)
                    <div class="mt-3 pt-3 border-top">
                        <small class="text-muted text-uppercase fw-semibold" style="font-size: 11px;">Catatan Tambahan</small>
                        <p class="mb-0 fst-italic text-secondary">"{{ $exam->notes }}"</p>
                    </div>
                @endif
            </div>
        @empty
            <div class="text-center py-5">
                <i class="fas fa-folder-open fa-3x text-muted mb-3 opacity-25"></i>
                <h5 class="text-muted">Belum ada riwayat pemeriksaan</h5>
                <p class="text-muted small">Data kunjungan Anda akan muncul di sini setelah Anda mengunjungi UKS.</p>
            </div>
        @endforelse

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $examinations->links() }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>