@extends('layouts.petugas')

@section('title', 'Riwayat Kunjungan - ' . $student->full_name)
@section('page-title', 'Riwayat Kunjungan: ' . $student->full_name)

@section('content')
<style>
    :root { --primary: #ef4444; --secondary: #991b1b; --success: #10b981; --info: #f43f5e; }
    
    .header-profile { 
        background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%); 
        color: #1e293b; padding: 30px 0 40px; border-radius: 0 0 30px 30px; margin-bottom: 30px;
        position: relative; overflow: hidden;
    }
    .header-profile::before {
        content: ''; position: absolute; top: -20%; right: -5%; width: 300px; height: 300px;
        background: rgba(239, 68, 68, 0.05); border-radius: 50%;
    }
    .avatar-box {
        background: white; padding: 6px; border-radius: 50%;
        box-shadow: 0 8px 25px rgba(239, 68, 68, 0.15);
        display: inline-block; margin-bottom: 15px;
    }
    .avatar-initials {
        width: 90px; height: 90px;
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white; display: flex; align-items: center; justify-content: center;
        font-size: 36px; font-weight: 800; border-radius: 50%;
        letter-spacing: 2px; box-shadow: inset 0 -4px 12px rgba(0,0,0,0.1);
        border: 3px solid #fef2f2;
    }

    .custom-accordion-item {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.06);
        margin-bottom: 16px;
        border-left: 5px solid var(--primary);
        overflow: hidden;
    }
    .custom-accordion-item.stats-item { border-left-color: var(--success); }

    .custom-accordion-trigger {
        width: 100%; text-align: left; padding: 18px 24px; background: white;
        border: none; cursor: pointer; transition: all 0.3s ease; outline: none;
        display: flex; align-items: center; justify-content: space-between;
    }
    .custom-accordion-trigger:hover { background: #fef2f2; }
    .custom-accordion-trigger:not(.collapsed) { background: #fef2f2; border-bottom: 1px solid #fee2e2; }
    .custom-accordion-trigger:not(.collapsed) .toggle-icon { transform: rotate(180deg) !important; }

    .toggle-icon { 
        transition: transform 0.3s ease; 
        font-size: 14px;
    }
    .btn-detail-look .toggle-icon {
        color: #ffffff !important;
    }

    .trigger-content { pointer-events: none; width: 100%; }
    
    .badge-sakit { background-color: #fee2e2; color: #991b1b; border: 1px solid #fecaca; font-size: 13px; padding: 6px 14px; }
    .badge-sehat { background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; font-size: 13px; padding: 6px 14px; }
    
    .exam-number-badge {
        background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%); color: #991b1b; 
        padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 700; 
        letter-spacing: 0.5px; border: 1px solid #fecaca; display: inline-flex;
        align-items: center; gap: 6px; margin-bottom: 8px;
    }
    
    .detail-section { padding: 24px; background: #fafafa; }
    .detail-label {
        font-size: 12px; letter-spacing: 0.5px; text-transform: uppercase;
        font-weight: 700; color: #64748b; margin-bottom: 6px; display: flex; align-items: center;
    }
    
    .detail-label i {
        width: 20px; text-align: center; margin-right: 8px; font-size: 14px;
    }
    .detail-label .fa-user-nurse, .detail-label .fa-comment-medical, .detail-label .fa-clipboard-check { color: #ef4444 !important; } 
    .detail-label .fa-stethoscope, .detail-label .fa-camera { color: #f43f5e !important; } 
    .detail-label .fa-pills { color: #10b981 !important; } 
    .detail-label .fa-sticky-note { color: #64748b !important; } 

    .detail-value {
        font-size: 15px; color: #1e293b; margin-bottom: 16px;
        padding: 12px 16px; background: white; border-radius: 10px; border: 1px solid #e2e8f0;
        line-height: 1.6;
    }
    
    .btn-detail-look {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white !important; border: none; padding: 8px 20px;
        border-radius: 25px; font-weight: 700; font-size: 13px;
        letter-spacing: 0.3px; transition: all 0.3s;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        display: inline-flex; align-items: center; gap: 6px;
    }
    .btn-detail-look:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(239, 68, 68, 0.4);
        color: white !important;
    }
    
    .btn-soft-outline {
        background: rgba(255, 255, 255, 0.9); color: var(--primary);
        border: 1.5px solid rgba(239, 68, 68, 0.3); font-weight: 600; font-size: 14px;
        padding: 8px 20px; transition: all 0.3s;
    }
    .btn-soft-outline:hover { background: #ef4444; color: white; border-color: #ef4444; }

    .custom-collapse { max-height: 0; overflow: hidden; transition: max-height 0.4s ease-out; }
    .custom-collapse.show { max-height: 2000px; transition: max-height 0.5s ease-in; }

    /* Responsive adjustments for larger base sizes */
    @media (max-width: 576px) {
        .avatar-initials { width: 70px; height: 70px; font-size: 28px; }
        .header-profile h3 { font-size: 1.4rem !important; }
        .custom-accordion-trigger { padding: 14px 16px; }
        .detail-section { padding: 16px; }
        .detail-value { font-size: 14px; padding: 10px 12px; }
    }
</style>

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm" role="alert" style="font-size: 14px; padding: 14px 20px;">
        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="header-profile text-center">
    <div class="container position-relative" style="z-index: 2;">
        <div class="avatar-box mb-3">
            @php
                $nameParts = explode(' ', trim($student->full_name));
                $initials = count($nameParts) >= 2 ? strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1)) : strtoupper(substr($nameParts[0], 0, 2));
            @endphp
            <div class="avatar-initials">{{ $initials }}</div>
        </div>
        
        <h3 class="fw-bold mb-3 text-dark" style="font-size: 2rem;">{{ $student->full_name }}</h3>
        
        <div class="d-flex justify-content-center gap-3 mb-4 flex-wrap">
            <div class="bg-white bg-opacity-75 px-4 py-2 rounded-4 shadow-sm">
                <small class="text-muted d-block" style="font-size: 12px; letter-spacing: 0.5px; font-weight: 600;">NIS</small>
                <strong class="text-primary" style="font-size: 16px;">{{ $student->nis }}</strong>
            </div>
            <div class="bg-white bg-opacity-75 px-4 py-2 rounded-4 shadow-sm">
                <small class="text-muted d-block" style="font-size: 12px; letter-spacing: 0.5px; font-weight: 600;">KELAS</small>
                <strong class="text-primary" style="font-size: 16px;">{{ $student->class->name ?? '-' }}</strong>
            </div>
        </div>
        
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('petugas.dashboard') }}" class="btn btn-soft-outline rounded-pill">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
            <a href="{{ route('petugas.examinations.create') }}?nis={{ $student->nis }}" class="btn btn-detail-look">
                <i class="fas fa-plus me-2"></i> Input Kunjungan Baru
            </a>
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <h4 class="fw-bold text-dark mb-0" style="font-size: 1.4rem;">
            <i class="fas fa-file-medical me-2 text-primary"></i>
            Riwayat Kunjungan UKS
        </h4>
        <button onclick="window.print()" class="btn btn-soft-outline rounded-pill">
            <i class="fas fa-print me-2"></i> Cetak Riwayat
        </button>
    </div>

    <!-- KARTU STATISTIK -->
    <div class="custom-accordion-item stats-item">
        <button type="button" class="custom-accordion-trigger collapsed" data-target="#statsDetail" aria-expanded="false">
            <div class="trigger-content">
                <h5 class="fw-bold mb-2 text-dark" style="font-size: 16px;">
                    <i class="fas fa-chart-bar me-2 text-success"></i>Statistik Kunjungan
                </h5>
                <small class="text-muted" style="font-size: 13px;">
                    Total: <strong class="text-dark">{{ $totalVisitsAllTime ?? 0 }}</strong> kali &nbsp;|&nbsp; 
                    Rata-rata: <strong class="text-dark">{{ $averagePerMonth ?? 0 }}</strong> kali/bulan
                </small>
            </div>
            <span class="btn-detail-look">
                <i class="fas fa-chevron-down toggle-icon"></i>
                <span>Detail</span>
            </span>
        </button>
        
        <div id="statsDetail" class="custom-collapse">
            <div class="detail-section">
                @if(isset($monthlyStats) && count($monthlyStats) > 0)
                    <div class="row g-3">
                        @foreach($monthlyStats as $stat)
                            <div class="col-6 col-md-4 col-lg-3">
                                <div class="d-flex align-items-center p-3 bg-white rounded-4 border h-100" style="border-color: #fee2e2 !important; transition: all 0.2s;">
                                    <div class="flex-grow-1">
                                        <div class="text-muted small text-uppercase fw-bold" style="font-size: 11px; letter-spacing: 0.5px;">
                                            {{ $stat['period'] }}
                                        </div>
                                        <div class="d-flex align-items-baseline gap-2 mt-2">
                                            <span class="fw-bold text-dark" style="font-size: 24px;">{{ $stat['count'] }}</span>
                                            <span class="text-muted" style="font-size: 12px;">kali</span>
                                        </div>
                                    </div>
                                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px; background: #fef2f2;">
                                        <i class="fas fa-calendar-check text-primary" style="font-size: 16px;"></i>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4 text-muted">
                        <i class="fas fa-chart-line fa-2x mb-3 opacity-25 text-primary"></i>
                        <p class="mb-0" style="font-size: 14px;">Belum ada data statistik kunjungan.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- LIST RIWAYAT KUNJUNGAN -->
    @forelse($examinations as $exam)
        <div class="custom-accordion-item">
            <button type="button" class="custom-accordion-trigger collapsed" data-target="#detail{{ $exam->id }}" aria-expanded="false">
                <div class="trigger-content w-100">
                    <div class="exam-number-badge">
                        <i class="fas fa-hashtag"></i>
                        <span>{{ $exam->examination_number ?? 'EXM-' . $exam->id }}</span>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-start w-100 flex-wrap gap-2">
                        <div>
                            <h5 class="fw-bold mb-1 text-dark" style="font-size: 16px;">{{ \Carbon\Carbon::parse($exam->examination_date)->translatedFormat('d F Y') }}</h5>
                            <small class="text-muted" style="font-size: 13px;"><i class="far fa-clock me-1"></i> {{ \Carbon\Carbon::parse($exam->arrival_time ?? $exam->created_at)->format('H:i') }} WIB</small>
                        </div>
                        @php
                            $isSakit = in_array($exam->status, ['pulang', 'rawat_jalan', 'rujuk_puskesmas', 'rujuk_rs', 'hubungi_ortu']);
                        @endphp
                        <span class="badge {{ $isSakit ? 'badge-sakit' : 'badge-sehat' }} rounded-pill fw-semibold">
                            <i class="fas {{ $isSakit ? 'fa-notes-medical' : 'fa-check-circle' }} me-1" style="font-size: 12px;"></i>
                            {{ $isSakit ? 'Sakit / Perlu Tindakan' : 'Sehat / Konsultasi' }}
                        </span>
                    </div>
                    
                    <div class="mt-3 d-flex justify-content-between align-items-center w-100 border-top pt-3" style="border-color: #f1f5f9 !important;">
                        <div>
                            <small class="text-muted" style="font-size: 13px;"><strong class="text-dark">Keluhan:</strong> {{ Str::limit($exam->complaint, 60) }}</small>
                        </div>
                        <span class="btn-detail-look">
                            <i class="fas fa-chevron-down toggle-icon"></i>
                            <span>Detail</span>
                        </span>
                    </div>
                </div>
            </button>

            <div id="detail{{ $exam->id }}" class="custom-collapse">
                <div class="detail-section">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="detail-label"><i class="fas fa-user-nurse"></i> Petugas Penangani</div>
                            <div class="detail-value">{{ $exam->officer_name ?? 'Petugas UKS' }}</div>

                            <div class="detail-label"><i class="fas fa-comment-medical"></i> Keluhan Utama</div>
                            <div class="detail-value">{{ $exam->complaint }}</div>

                            <div class="detail-label"><i class="fas fa-stethoscope"></i> Diagnosa / Tindakan</div>
                            <div class="detail-value">{{ $exam->diagnosis ?? '-' }}</div>
                        </div>

                        <div class="col-md-6">
                            <div class="detail-label"><i class="fas fa-pills"></i> Obat yang Diberikan</div>
                            <div class="detail-value">{{ $exam->medicine ?: '-' }}</div>

                            <div class="detail-label"><i class="fas fa-clipboard-check"></i> Status Kepulangan</div>
                            <div class="detail-value">
                                @php
                                    $statusLabels = [
                                        'pulang' => '🏠 Pulang',
                                        'istirahat_uks' => '🛏️ Istirahat di UKS',
                                        'rawat_jalan' => '🏫 Rawat Jalan (kembali ke kelas)',
                                        'rujuk_puskesmas' => '🏥 Rujuk ke Puskesmas',
                                        'rujuk_rs' => '🏥 Rujuk ke Rumah Sakit',
                                        'hubungi_ortu' => '📞 Hubungi Orang Tua/Wali'
                                    ];
                                @endphp
                                {{ $statusLabels[$exam->status] ?? ucfirst($exam->status) }}
                            </div>

                            @if($exam->notes)
                                <div class="detail-label"><i class="fas fa-sticky-note"></i> Catatan Tambahan</div>
                                <div class="detail-value fst-italic" style="background: #fffbeb; border-color: #fde68a; color: #92400e;">"{{ $exam->notes }}"</div>
                            @endif
                        </div>
                    </div>

                    @if($exam->photo)
                        <div class="mt-4 pt-3 border-top" style="border-color: #e2e8f0 !important;">
                            <div class="detail-label"><i class="fas fa-camera"></i> Dokumentasi Foto</div>
                            <div class="bg-white p-3 rounded-4 border text-center" style="border-color: #e2e8f0 !important;">
                                <img src="{{ asset('storage/' . $exam->photo) }}" alt="Foto Dokumentasi" class="img-fluid rounded-3 shadow-sm mb-3" style="max-height: 250px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#lightboxModal{{ $exam->id }}">
                                <div>
                                    <button type="button" class="btn btn-detail-look" data-bs-toggle="modal" data-bs-target="#lightboxModal{{ $exam->id }}">
                                        <i class="fas fa-search-plus me-2"></i> Perbesar Foto
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="lightboxModal{{ $exam->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl">
                                <div class="modal-content bg-transparent border-0">
                                    <div class="modal-header border-0 justify-content-end">
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" style="filter: invert(1);"></button>
                                    </div>
                                    <div class="modal-body text-center p-0">
                                        <img src="{{ asset('storage/' . $exam->photo) }}" alt="Foto Dokumentasi" class="img-fluid rounded-4 shadow-lg">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-5 bg-white rounded-4 shadow-sm border" style="border-color: #fee2e2 !important;">
            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px; background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);">
                <i class="fas fa-folder-open fa-3x text-primary" style="opacity: 0.4;"></i>
            </div>
            <h5 class="text-muted fw-bold mb-2" style="font-size: 18px;">Belum ada riwayat kunjungan</h5>
            <p class="text-muted mb-0" style="font-size: 14px;">Siswa ini belum pernah tercatat mengunjungi UKS.</p>
        </div>
    @endforelse

    @if($examinations->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $examinations->links() }}
        </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const triggers = document.querySelectorAll('.custom-accordion-trigger');
        
        triggers.forEach(trigger => {
            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('data-target');
                const targetElement = document.querySelector(targetId);
                const isExpanded = this.getAttribute('aria-expanded') === 'true';

                if (isExpanded) {
                    targetElement.classList.remove('show');
                    this.classList.add('collapsed');
                    this.setAttribute('aria-expanded', 'false');
                } else {
                    targetElement.classList.add('show');
                    this.classList.remove('collapsed');
                    this.setAttribute('aria-expanded', 'true');
                }
            });
        });
    });
</script>
@endsection