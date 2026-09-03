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
            content: ''; position: absolute; top: -20%; right: -5%; width: 400px; height: 400px;
            background: rgba(37, 99, 235, 0.05); border-radius: 50%;
        }
        .header-profile::after {
            content: ''; position: absolute; bottom: -10%; left: -5%; width: 300px; height: 300px;
            background: rgba(37, 99, 235, 0.03); border-radius: 50%;
        }
        .header-profile h3 { color: #0f172a; font-weight: 800; font-size: 2rem; }
        .avatar-box {
            background: white; padding: 8px; border-radius: 50%;
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.15);
            display: inline-block; margin-bottom: 20px;
        }
        .avatar-initials {
            width: 110px; height: 110px;
            background: linear-gradient(135deg, #2563EB 0%, #1e40af 100%);
            color: white; display: flex; align-items: center; justify-content: center;
            font-size: 44px; font-weight: 800; border-radius: 50%;
            letter-spacing: 2px; box-shadow: inset 0 -4px 12px rgba(0,0,0,0.1);
            border: 3px solid #eff6ff;
        }
        .record-card { 
            background: white; border-radius: 16px; padding: 0; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.06); margin-bottom: 20px; 
            border-left: 5px solid var(--primary); overflow: hidden;
        }
        .card-header-summary {
            padding: 25px; cursor: pointer; background: white;
            border-bottom: 1px solid transparent; transition: background 0.3s;
        }
        .card-header-summary:hover { background: #f8fafc; }
        .card-header-summary.expanded { border-bottom: 1px solid #e2e8f0; background: #f0f9ff; }
        .badge-sakit { background-color: #fee2e2; color: #dc2626; }
        .badge-sehat { background-color: #dcfce7; color: #16a34a; }
        .exam-number-badge {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            color: #1e40af; padding: 6px 14px; border-radius: 20px;
            font-size: 12px; font-weight: 700; letter-spacing: 0.5px;
            border: 1px solid #bfdbfe; display: inline-flex;
            align-items: center; gap: 6px; margin-bottom: 10px;
        }
        .detail-section { padding: 25px; background: #fafafa; }
        .detail-label {
            font-size: 11px; letter-spacing: 0.5px; text-transform: uppercase;
            font-weight: 600; color: #64748b; margin-bottom: 5px;
        }
        .detail-value {
            font-size: 14px; color: #1e293b; margin-bottom: 15px;
            padding: 10px; background: white; border-radius: 8px; border: 1px solid #e2e8f0;
        }
        .photo-container {
            background: white; border-radius: 12px; padding: 15px;
            border: 2px dashed #cbd5e1; text-align: center;
            display: flex; flex-direction: column; align-items: center;
        }
        .photo-container img {
            max-width: 100%; max-height: 220px; width: auto; height: auto;
            object-fit: contain; border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1); cursor: pointer;
        }
        .toggle-icon { transition: transform 0.3s; color: white; }
        .toggle-icon.rotated { transform: rotate(180deg); }
        .btn-soft-outline {
            background: rgba(255, 255, 255, 0.6); color: var(--primary);
            border: 1px solid rgba(37, 99, 235, 0.2); font-weight: 600;
        }
        .btn-soft-outline:hover {
            background: rgba(37, 99, 235, 0.1); color: var(--primary);
            border-color: var(--primary);
        }
        .btn-soft-white {
            background: white; color: var(--primary); border: none;
            font-weight: 600; box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .btn-soft-white:hover { background: #f8fafc; color: var(--secondary); }
        .btn-detail {
            background: linear-gradient(135deg, #2563EB 0%, #1e40af 100%);
            color: white !important; border: none; padding: 11px 26px;
            border-radius: 30px; font-weight: 700; font-size: 14px;
            letter-spacing: 0.3px; transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.35);
            display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-detail:hover {
            background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
            color: white !important; transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.5);
        }
        .lightbox-modal .modal-body {
            background: #0f172a; padding: 20px;
            display: flex; justify-content: center; align-items: center; min-height: 400px;
        }
        .lightbox-modal img {
            max-width: 100%; max-height: 80vh; border-radius: 8px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.5);
        }
        .lightbox-modal .btn-close { filter: invert(1); }
    </style>
</head>
<body>

    <div class="header-profile text-center">
        <div class="container position-relative" style="z-index: 2;">
            <div class="avatar-box mb-3">
                @php
                    $nameParts = explode(' ', trim($student->full_name));
                    if (count($nameParts) >= 2) {
                        $initials = strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1));
                    } else {
                        $initials = strtoupper(substr($nameParts[0], 0, 2));
                    }
                @endphp
                <div class="avatar-initials">{{ $initials }}</div>
            </div>
            
            <h3 class="fw-bold mb-3 text-dark">{{ $student->full_name }}</h3>
            
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

        <!-- Statistik Frekuensi Kunjungan (3 Tahun) -->
        <div class="record-card mb-4" style="border-left-color: var(--success);">
            <div class="card-header-summary" data-bs-toggle="collapse" data-bs-target="#statsDetail" aria-expanded="false" onclick="toggleIcon(this)">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <div>
                        <h5 class="fw-bold mb-1 text-dark">
                            <i class="fas fa-chart-bar text-success me-2"></i>Statistik Frekuensi Kunjungan (3 Tahun Terakhir)
                        </h5>
                        <small class="text-muted">
                            Total: <strong class="text-dark">{{ $totalVisits3Years ?? 0 }}</strong> kali &nbsp;|&nbsp; 
                            Rata-rata: <strong class="text-dark">{{ $averagePerMonth ?? 0 }}</strong> kali/bulan
                        </small>
                    </div>
                    <button class="btn-detail" style="padding: 8px 16px; font-size: 13px;">
                        <i class="fas fa-chevron-down toggle-icon"></i>
                        <span>Lihat Detail</span>
                    </button>
                </div>
            </div>
            
            <div id="statsDetail" class="collapse">
                <div class="detail-section">
                    @if(isset($visitStats) && count($visitStats) > 0)
                        <div class="row g-3">
                            @foreach($visitStats as $stat)
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="d-flex align-items-center p-3 bg-white rounded-3 border h-100" style="border-color: #e2e8f0 !important;">
                                        <div class="flex-grow-1">
                                            <div class="text-muted small text-uppercase fw-bold" style="font-size: 11px; letter-spacing: 0.5px;">
                                                {{ $stat['period'] }}
                                            </div>
                                            <div class="d-flex align-items-baseline gap-2 mt-1">
                                                <span class="fw-bold text-dark fs-4">{{ $stat['count'] }}</span>
                                                <span class="text-muted small">kali</span>
                                            </div>
                                        </div>
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 42px; height: 42px;">
                                            <i class="fas fa-calendar-check text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-chart-line fa-2x mb-2 opacity-25"></i>
                            <p class="mb-0 small">Belum ada data kunjungan dalam 3 tahun terakhir.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @forelse($examinations as $exam)
            <div class="record-card">
                <div class="card-header-summary" data-bs-toggle="collapse" data-bs-target="#detail{{ $exam->id }}" aria-expanded="false" onclick="toggleIcon(this)">
                    <div class="exam-number-badge">
                        <i class="fas fa-hashtag"></i>
                        <span>{{ $exam->examination_number }}</span>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="fw-bold mb-1 text-dark">{{ \Carbon\Carbon::parse($exam->examination_date)->format('d F Y') }}</h5>
                            <small class="text-muted"><i class="far fa-clock me-1"></i> {{ \Carbon\Carbon::parse($exam->arrival_time)->format('H:i') }} WIB</small>
                        </div>
                        @php
                            $isSakit = in_array($exam->status, ['pulang', 'rawat_jalan', 'rujuk_puskesmas', 'rujuk_rs']);
                        @endphp
                        <span class="badge {{ $isSakit ? 'badge-sakit' : 'badge-sehat' }} px-3 py-2 rounded-pill fw-semibold">
                            <i class="fas {{ $isSakit ? 'fa-notes-medical' : 'fa-check-circle' }} me-1"></i>
                            {{ $isSakit ? 'Sakit' : 'Tidak Sakit / Sehat' }}
                        </span>
                    </div>
                    
                    <div class="mt-3 d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted"><strong>Keluhan:</strong> {{ Str::limit($exam->complaint, 50) }}</small>
                        </div>
                        <button class="btn-detail">
                            <i class="fas fa-chevron-down toggle-icon"></i>
                            <span>Lihat Detail</span>
                        </button>
                    </div>
                </div>

                <div id="detail{{ $exam->id }}" class="collapse">
                    <div class="detail-section">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="detail-label"><i class="fas fa-user-nurse me-1 text-primary"></i> Petugas Penangani</div>
                                <div class="detail-value">{{ $exam->officer_name ?? 'Petugas UKS' }}</div>

                                <div class="detail-label"><i class="fas fa-comment-medical me-1 text-danger"></i> Keluhan Utama</div>
                                <div class="detail-value">{{ $exam->complaint }}</div>

                                <div class="detail-label"><i class="fas fa-stethoscope me-1 text-info"></i> Diagnosa</div>
                                <div class="detail-value">{{ $exam->diagnosis }}</div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-label"><i class="fas fa-pills me-1 text-success"></i> Obat yang Diberikan</div>
                                <div class="detail-value">{{ $exam->medicine ?: '-' }}</div>

                                <div class="detail-label"><i class="fas fa-clipboard-check me-1 text-primary"></i> Status Kepulangan</div>
                                <div class="detail-value">
                                    @php
                                        $statusLabels = [
                                            'pulang' => 'Pulang',
                                            'istirahat_uks' => 'Istirahat di UKS',
                                            'rawat_jalan' => 'Rawat Jalan (kasih obat kembali ke kelas)',
                                            'rujuk_puskesmas' => 'Rujuk ke Puskesmas',
                                            'rujuk_rs' => 'Rujuk ke Rumah Sakit',
                                            'hubungi_ortu' => 'Hubungi Orang Tua/Wali'
                                        ];
                                    @endphp
                                    {{ $statusLabels[$exam->status] ?? $exam->status }}
                                </div>

                                @if($exam->notes)
                                    <div class="detail-label"><i class="fas fa-sticky-note me-1 text-secondary"></i> Catatan Tambahan</div>
                                    <div class="detail-value fst-italic">"{{ $exam->notes }}"</div>
                                @endif
                            </div>
                        </div>

                        @if($exam->photo)
                            <div class="mt-4">
                                <div class="detail-label"><i class="fas fa-camera me-1 text-info"></i> Dokumentasi Foto</div>
                                <div class="photo-container">
                                    <img src="{{ asset('storage/' . $exam->photo) }}" 
                                         alt="Foto Dokumentasi"
                                         data-bs-toggle="modal" 
                                         data-bs-target="#lightboxModal{{ $exam->id }}"
                                         title="Klik untuk lihat ukuran penuh">
                                    <div class="mt-3 d-flex gap-2 justify-content-center flex-wrap">
                                        <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3" 
                                                data-bs-toggle="modal" data-bs-target="#lightboxModal{{ $exam->id }}">
                                            <i class="fas fa-search-plus me-1"></i> Perbesar
                                        </button>
                                        <a href="{{ asset('storage/' . $exam->photo) }}" target="_blank" 
                                           class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                            <i class="fas fa-external-link-alt me-1"></i> Tab Baru
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade lightbox-modal" id="lightboxModal{{ $exam->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                    <div class="modal-content bg-transparent border-0">
                                        <div class="modal-header border-0 justify-content-end">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ asset('storage/' . $exam->photo) }}" alt="Foto Dokumentasi">
                                        </div>
                                        <div class="modal-footer border-0 justify-content-center text-white">
                                            <small class="opacity-75">
                                                <i class="fas fa-info-circle me-1"></i>
                                                {{ \Carbon\Carbon::parse($exam->examination_date)->format('d F Y') }}
                                                pukul {{ \Carbon\Carbon::parse($exam->arrival_time)->format('H:i') }} WIB
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
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

        @if(isset($examinations) && $examinations->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $examinations->links() }}
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleIcon(element) {
            const icon = element.querySelector('.toggle-icon');
            const isExpanded = element.getAttribute('aria-expanded') === 'true';
            
            if (isExpanded) {
                icon.classList.add('rotated');
                element.classList.add('expanded');
            } else {
                icon.classList.remove('rotated');
                element.classList.remove('expanded');
            }
        }
    </script>
</body>
</html>