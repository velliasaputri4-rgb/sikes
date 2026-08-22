@extends('layouts.admin')

@section('title', 'Detail Kunjungan')
@section('page-title', 'Detail Kunjungan Siswa')

@section('content')
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0"><i class="fas fa-file-medical text-primary me-2"></i>Detail Kunjungan</h5>
        <div>
            <a href="{{ route('admin.examinations.edit', $examination->id) }}" class="btn btn-primary btn-sm me-2" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border: none;">
                <i class="fas fa-edit me-1"></i> Edit
            </a>
            <a href="{{ route('admin.examinations.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Kolom Kiri: Informasi Dasar -->
        <div class="col-lg-5">
            <!-- Informasi Kunjungan -->
            <div class="p-3 bg-light rounded-3 mb-3">
                <h6 class="fw-bold text-primary mb-3"><i class="fas fa-info-circle me-2"></i>Informasi Kunjungan</h6>
                
                <div class="mb-3">
                    <label class="form-label small text-muted">Nomor Kunjungan</label>
                    <div class="fw-semibold">{{ $examination->examination_number }}</div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-6">
                        <label class="form-label small text-muted">Tanggal</label>
                        <div class="fw-semibold">{{ \Carbon\Carbon::parse($examination->examination_date)->format('d/m/Y') }}</div>
                    </div>
                    <div class="col-6">
                        <label class="form-label small text-muted">Jam Kedatangan</label>
                        <div class="fw-semibold">{{ \Carbon\Carbon::parse($examination->arrival_time)->format('H:i') }} WIB</div>
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
                        <span class="badge {{ $isPerluPerhatian ? 'bg-danger' : 'bg-success' }} px-3 py-2">
                            {{ $statusText }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Identitas Siswa -->
            <div class="p-3 bg-light rounded-3 mb-3">
                <h6 class="fw-bold text-primary mb-3"><i class="fas fa-user-graduate me-2"></i>Identitas Siswa</h6>
                
                <div class="mb-2">
                    <label class="form-label small text-muted">NIS</label>
                    <div class="fw-semibold">{{ $examination->student->nis ?? '-' }}</div>
                </div>

                <div class="mb-2">
                    <label class="form-label small text-muted">Nama Lengkap</label>
                    <div class="fw-semibold">{{ $examination->student->full_name ?? '-' }}</div>
                </div>

                <div class="mb-2">
                    <label class="form-label small text-muted">Kelas</label>
                    <div>
                        <span class="badge bg-light text-dark border px-3 py-2">
                            {{ $examination->student->class->name ?? '-' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Informasi Petugas -->
            <div class="p-3 bg-light rounded-3 mb-3">
                <h6 class="fw-bold text-primary mb-3"><i class="fas fa-user-nurse me-2"></i>Petugas Piket</h6>
                
                <div class="mb-2">
                    <label class="form-label small text-muted">Kelompok Piket</label>
                    <div class="fw-semibold">{{ $examination->piket_group ?? '-' }}</div>
                </div>

                <div class="mb-2">
                    <label class="form-label small text-muted">Nama Petugas</label>
                    <div class="fw-semibold">{{ $examination->officer_name ?? '-' }}</div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Diagnosa & Dokumentasi -->
        <div class="col-lg-7">
            <!-- Diagnosa & Pengobatan -->
            <div class="p-3 bg-light rounded-3 mb-3">
                <h6 class="fw-bold text-primary mb-3"><i class="fas fa-notes-medical me-2"></i>Diagnosa & Pengobatan</h6>
                
                <div class="mb-3">
                    <label class="form-label small text-muted">Keluhan Utama</label>
                    <div class="p-3 bg-white rounded border">
                        {{ $examination->complaint }}
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted">Diagnosa</label>
                    <div class="p-3 bg-white rounded border">
                        {{ $examination->diagnosis }}
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted">Obat yang Diberikan</label>
                    <div class="p-3 bg-white rounded border">
                        {{ $examination->medicine ?? '-' }}
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted">Catatan Tambahan</label>
                    <div class="p-3 bg-white rounded border">
                        {{ $examination->notes ?? '-' }}
                    </div>
                </div>
            </div>

            <!-- Dokumentasi Foto -->
            @if($examination->photo)
            <div class="p-3 bg-light rounded-3 mb-3">
                <h6 class="fw-bold text-primary mb-3"><i class="fas fa-camera me-2"></i>Dokumentasi Foto</h6>
                <div class="text-center">
                    <img src="{{ asset('storage/' . $examination->photo) }}" alt="Foto Kunjungan" 
                         class="img-fluid rounded shadow-sm" style="max-height: 400px;">
                </div>
            </div>
            @endif

            <!-- Informasi Tambahan -->
            <div class="p-3 bg-light rounded-3">
                <h6 class="fw-bold text-primary mb-3"><i class="fas fa-clock me-2"></i>Informasi Sistem</h6>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small text-muted">Waktu Dibuat</label>
                        <div class="fw-semibold">{{ $examination->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small text-muted">Terakhir Diubah</label>
                        <div class="fw-semibold">{{ $examination->updated_at->format('d/m/Y H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection