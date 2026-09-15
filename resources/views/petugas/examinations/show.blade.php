@extends('layouts.petugas')

@section('title', 'Detail Kunjungan')
@section('page-title', 'Detail Kunjungan Siswa')

@section('content')
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h5 class="fw-bold mb-0">
            <i class="fas fa-file-medical me-2" style="color: #ef4444;"></i>Detail Kunjungan
        </h5>
        <div>
            <a href="{{ route('petugas.examinations.edit', $examination->id) }}" class="btn btn-sm me-2" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; border: none; box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);">
                <i class="fas fa-edit me-1"></i> Edit
            </a>
            <a href="{{ route('petugas.examinations.index') }}" class="btn btn-sm" style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Kolom Kiri: Informasi Dasar -->
        <div class="col-lg-5">
            <!-- Informasi Kunjungan -->
            <div class="p-4 rounded-3 mb-3" style="background: #ffffff; border: 1px solid #fee2e2; box-shadow: 0 2px 8px rgba(239, 68, 68, 0.04);">
                <h6 class="fw-bold mb-3" style="color: #991b1b;">
                    <i class="fas fa-info-circle me-2"></i>Informasi Kunjungan
                </h6>
                
                <div class="mb-3">
                    <label class="form-label small text-muted">Nomor Kunjungan</label>
                    <div class="fw-semibold" style="color: #0f172a;">{{ $examination->examination_number }}</div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-6">
                        <label class="form-label small text-muted">Tanggal</label>
                        <div class="fw-semibold" style="color: #0f172a;">{{ \Carbon\Carbon::parse($examination->examination_date)->format('d/m/Y') }}</div>
                    </div>
                    <div class="col-6">
                        <label class="form-label small text-muted">Jam Kedatangan</label>
                        <div class="fw-semibold" style="color: #0f172a;">{{ \Carbon\Carbon::parse($examination->arrival_time)->format('H:i') }} WIB</div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted">Status Kepulangan</label>
                    <div>
                        @php
                            $isPerluPerhatian = in_array($examination->status, ['istirahat_uks', 'rawat_jalan', 'rujuk_puskesmas', 'rujuk_rs', 'hubungi_ortu']);
                            
                            $statusText = match($examination->status) {
                                'pulang' => 'Pulang (Sehat)',
                                'istirahat_uks' => 'Istirahat di UKS',
                                'rawat_jalan' => 'Rawat Jalan',
                                'rujuk_puskesmas' => 'Rujuk ke Puskesmas',
                                'rujuk_rs' => 'Rujuk ke Rumah Sakit',
                                'hubungi_ortu' => 'Hubungi Orang Tua/Wali',
                                default => ucfirst(str_replace('_', ' ', $examination->status))
                            };
                        @endphp
                        @if($isPerluPerhatian)
                            <span class="badge px-3 py-2" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white;">
                                {{ $statusText }}
                            </span>
                        @else
                            <span class="badge px-3 py-2" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white;">
                                {{ $statusText }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Identitas Siswa -->
            <div class="p-4 rounded-3 mb-3" style="background: #ffffff; border: 1px solid #fee2e2; box-shadow: 0 2px 8px rgba(239, 68, 68, 0.04);">
                <h6 class="fw-bold mb-3" style="color: #0f172a;">
                    <i class="fas fa-user-graduate me-2"></i>Identitas Siswa
                </h6>
                
                <div class="mb-2">
                    <label class="form-label small text-muted">NIS</label>
                    <div class="fw-semibold" style="color: #0f172a;">{{ $examination->student->nis ?? '-' }}</div>
                </div>

                <div class="mb-2">
                    <label class="form-label small text-muted">Nama Lengkap</label>
                    <div class="fw-semibold" style="color: #0f172a;">{{ $examination->student->full_name ?? '-' }}</div>
                </div>

                <div class="mb-2">
                    <label class="form-label small text-muted">Kelas</label>
                    <div>
                        <span class="badge px-3 py-2" style="background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; font-weight: 500;">
                            {{ $examination->student->class->name ?? '-' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Informasi Petugas -->
            <div class="p-4 rounded-3 mb-3" style="background: #ffffff; border: 1px solid #fee2e2; box-shadow: 0 2px 8px rgba(239, 68, 68, 0.04);">
                <h6 class="fw-bold mb-3" style="color: #f43f5e;">
                    <i class="fas fa-user-nurse me-2"></i>Petugas Piket
                </h6>
                
                <div class="mb-2">
                    <label class="form-label small text-muted">Kelompok Piket</label>
                    <div class="fw-semibold" style="color: #0f172a;">{{ $examination->piket_group ?? '-' }}</div>
                </div>

                <div class="mb-2">
                    <label class="form-label small text-muted">Nama Petugas</label>
                    <div class="fw-semibold" style="color: #0f172a;">{{ $examination->officer_name ?? '-' }}</div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Diagnosa & Dokumentasi -->
        <div class="col-lg-7">
            <!-- Diagnosa & Pengobatan -->
            <div class="p-4 rounded-3 mb-3" style="background: #ffffff; border: 1px solid #fee2e2; box-shadow: 0 2px 8px rgba(239, 68, 68, 0.04);">
                <h6 class="fw-bold mb-3" style="color: #ef4444;">
                    <i class="fas fa-notes-medical me-2"></i>Diagnosa & Pengobatan
                </h6>
                
                <div class="mb-3">
                    <label class="form-label small text-muted">Keluhan Utama</label>
                    <div class="p-3 rounded" style="background: #fafbfc; border: 1px solid #e2e8f0; color: #334155;">
                        {{ $examination->complaint }}
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted">Diagnosa</label>
                    <div class="p-3 rounded" style="background: #fafbfc; border: 1px solid #e2e8f0; color: #334155;">
                        {{ $examination->diagnosis }}
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted">Obat yang Diberikan</label>
                    <div class="p-3 rounded" style="background: #fafbfc; border: 1px solid #e2e8f0; color: #334155;">
                        {{ $examination->medicine ?? '-' }}
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted">Catatan Tambahan</label>
                    <div class="p-3 rounded" style="background: #fafbfc; border: 1px solid #e2e8f0; color: #334155;">
                        {{ $examination->notes ?? '-' }}
                    </div>
                </div>
            </div>

            <!-- Dokumentasi Foto -->
            @if($examination->photo)
            <div class="p-4 rounded-3 mb-3" style="background: #ffffff; border: 1px solid #fee2e2; box-shadow: 0 2px 8px rgba(239, 68, 68, 0.04);">
                <h6 class="fw-bold mb-3" style="color: #f59e0b;">
                    <i class="fas fa-camera me-2"></i>Dokumentasi Foto
                </h6>
                <div class="text-center">
                    <img src="{{ asset('storage/' . $examination->photo) }}" alt="Foto Kunjungan" 
                         class="img-fluid rounded shadow-sm" style="max-height: 400px; border: 2px solid #fee2e2;">
                </div>
            </div>
            @endif

            <!-- Informasi Tambahan -->
            <div class="p-4 rounded-3" style="background: #ffffff; border: 1px solid #fee2e2; box-shadow: 0 2px 8px rgba(239, 68, 68, 0.04);">
                <h6 class="fw-bold mb-3" style="color: #475569;">
                    <i class="fas fa-clock me-2"></i>Informasi Sistem
                </h6>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small text-muted">Waktu Dibuat</label>
                        <div class="fw-semibold" style="color: #0f172a;">{{ $examination->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small text-muted">Terakhir Diubah</label>
                        <div class="fw-semibold" style="color: #0f172a;">{{ $examination->updated_at->format('d/m/Y H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection