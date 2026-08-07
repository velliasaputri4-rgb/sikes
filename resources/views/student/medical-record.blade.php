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
            padding: 0; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.06); 
            margin-bottom: 20px; 
            border-left: 5px solid var(--primary);
            transition: transform 0.2s;
            overflow: hidden;
        }
        .record-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.1);
        }
        
        /* Card Header (Summary) */
        .card-header-summary {
            padding: 25px;
            cursor: pointer;
            background: white;
            border-bottom: 1px solid transparent;
            transition: all 0.3s;
        }
        .card-header-summary:hover {
            background: #f8fafc;
        }
        .card-header-summary.expanded {
            border-bottom: 1px solid #e2e8f0;
            background: #f0f9ff;
        }
        
        /* Badges */
        .badge-sakit { background-color: #fee2e2; color: #dc2626; }
        .badge-sehat { background-color: #dcfce7; color: #16a34a; }
        
        /* Detail Section */
        .detail-section {
            padding: 25px;
            background: #fafafa;
        }
        .detail-label {
            font-size: 11px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 5px;
        }
        .detail-value {
            font-size: 14px;
            color: #1e293b;
            margin-bottom: 15px;
            padding: 10px;
            background: white;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }
        
        /* Photo Container */
        .photo-container {
            background: white;
            border-radius: 12px;
            padding: 15px;
            border: 2px dashed #cbd5e1;
            text-align: center;
        }
        .photo-container img {
            max-width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        /* Toggle Icon */
        .toggle-icon {
            transition: transform 0.3s;
            color: var(--primary);
        }
        .toggle-icon.rotated {
            transform: rotate(180deg);
        }
        
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
        .btn-expand {
            background: var(--primary);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.3s;
        }
        .btn-expand:hover {
            background: var(--secondary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
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
                <!-- Summary Header (Clickable) -->
                <div class="card-header-summary" data-bs-toggle="collapse" data-bs-target="#detail{{ $exam->id }}" aria-expanded="false" onclick="toggleIcon(this)">
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
                        <button class="btn-expand">
                            <i class="fas fa-chevron-down toggle-icon me-1"></i> Lihat Detail
                        </button>
                    </div>
                </div>

                <!-- Collapsible Detail Section -->
                <div id="detail{{ $exam->id }}" class="collapse">
                    <div class="detail-section">
                        <div class="row g-3">
                            <!-- Kolom Kiri -->
                            <div class="col-md-6">
                                <div class="detail-label"><i class="fas fa-user-nurse me-1 text-primary"></i> Petugas Penangani</div>
                                <div class="detail-value">{{ $exam->officer_name ?? 'Petugas UKS' }}</div>

                                <div class="detail-label"><i class="fas fa-comment-medical me-1 text-danger"></i> Keluhan Utama</div>
                                <div class="detail-value">{{ $exam->complaint }}</div>

                                <div class="detail-label"><i class="fas fa-stethoscope me-1 text-info"></i> Diagnosa</div>
                                <div class="detail-value">{{ $exam->diagnosis }}</div>

                                <div class="detail-label"><i class="fas fa-pills me-1 text-success"></i> Obat yang Diberikan</div>
                                <div class="detail-value">{{ $exam->medicine ?: '-' }}</div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <div class="detail-label"><i class="fas fa-procedures me-1 text-warning"></i> Tindakan / Pengobatan</div>
                                <div class="detail-value">{{ $exam->treatment ?: '-' }}</div>

                                <div class="detail-label"><i class="fas fa-clipboard-check me-1 text-primary"></i> Status Kepulangan</div>
                                <div class="detail-value">
                                    @php
                                        $statusLabels = [
                                            'pulang' => 'Pulang (Sehat/Sembuh)',
                                            'istirahat_uks' => 'Istirahat di UKS',
                                            'rawat_jalan' => 'Rawat Jalan',
                                            'rujuk_puskesmas' => 'Rujuk ke Puskesmas',
                                            'rujuk_rs' => 'Rujuk ke Rumah Sakit'
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

                        <!-- Foto Dokumentasi -->
                        @if($exam->photo)
                            <div class="mt-4">
                                <div class="detail-label"><i class="fas fa-camera me-1 text-info"></i> Dokumentasi Foto</div>
                                <div class="photo-container">
                                    <img src="{{ asset('storage/' . $exam->photo) }}" alt="Foto Dokumentasi" class="img-fluid">
                                    <div class="mt-2">
                                        <a href="{{ asset('storage/' . $exam->photo) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-expand me-1"></i> Lihat Full Size
                                        </a>
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

        <!-- Pagination -->
        @if(isset($examinations) && $examinations->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $examinations->links() }}
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle icon rotation
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