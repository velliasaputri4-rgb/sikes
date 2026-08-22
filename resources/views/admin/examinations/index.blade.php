@extends('layouts.admin')

@section('title', 'Data Kunjungan')
@section('page-title', 'Data Kunjungan Siswa')

@section('content')
    <style>
        /* ═══════════════════════════════════════
           PALET WARNA — SAMA DENGAN ADMIN (NAVY)
           ═══════════════════════════════════════ */
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --navy-900: #0f172a;
        }

        /* Header halaman dengan aksen navy */
        .page-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 20px;
        }
        .page-head h5 {
            font-weight: 800;
            color: var(--navy-900);
            margin-bottom: 2px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .page-head h5 .head-icon {
            width: 38px; height: 38px;
            border-radius: 10px;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3);
        }

        /* Filter card */
        .filter-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 20px;
        }
        .filter-card .form-control:focus {
            border-color: #93c5fd;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        /* Tabel */
        .table thead th {
            background: #f8fafc;
            color: #475569;
            font-weight: 700;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            border-bottom: 2px solid #e2e8f0;
        }
        .table-hover tbody tr:hover { background-color: #eff6ff; }

        /* ═══════════════════════════════════════
           TOMBOL AKSI (selaras palet navy)
           ═══════════════════════════════════════ */
        .aksi-group { display: inline-flex; gap: 8px; align-items: center; }

        .btn-aksi {
            width: 36px; height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            border: 1px solid transparent;
            font-size: 13px;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            position: relative;
            cursor: pointer;
        }
        .btn-aksi:hover { transform: translateY(-3px); }
        .btn-aksi:active { transform: translateY(-1px); }

        /* Detail - Biru navy */
        .btn-aksi.detail {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            color: #1e40af;
            border-color: #93c5fd;
        }
        .btn-aksi.detail:hover {
            background: linear-gradient(135deg, #bfdbfe 0%, #93c5fd 100%);
            box-shadow: 0 6px 14px rgba(37, 99, 235, 0.3);
        }

        /* Edit - Amber (kontras navy) */
        .btn-aksi.edit {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            color: #92400e;
            border-color: #fcd34d;
        }
        .btn-aksi.edit:hover {
            background: linear-gradient(135deg, #fde68a 0%, #fcd34d 100%);
            box-shadow: 0 6px 14px rgba(245, 158, 11, 0.3);
        }

        /* Hapus - Merah */
        .btn-aksi.hapus {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
            border-color: #fca5a5;
        }
        .btn-aksi.hapus:hover {
            background: linear-gradient(135deg, #fecaca 0%, #fca5a5 100%);
            box-shadow: 0 6px 14px rgba(220, 38, 38, 0.3);
        }

        /* Tooltip */
        .btn-aksi::after {
            content: attr(data-tip);
            position: absolute;
            bottom: calc(100% + 8px);
            left: 50%;
            transform: translateX(-50%) translateY(4px);
            background: #0f172a;
            color: white;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 500;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: all 0.2s ease;
            z-index: 10;
        }
        .btn-aksi::before {
            content: '';
            position: absolute;
            bottom: calc(100% + 4px);
            left: 50%;
            transform: translateX(-50%);
            border: 4px solid transparent;
            border-top-color: #0f172a;
            opacity: 0;
            pointer-events: none;
            transition: all 0.2s ease;
            z-index: 10;
        }
        .btn-aksi:hover::after, .btn-aksi:hover::before {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }
        .btn-aksi:hover::before { transform: translateX(-50%); }

        .form-hapus { display: inline-block; margin: 0; }
        .form-hapus button { padding: 0; margin: 0; }
    </style>

    <div class="content-card">
        {{-- ✅ Header dengan icon navy (gaya admin) --}}
        <div class="page-head">
            <div>
                <h5>
                    <span class="head-icon"><i class="fas fa-clipboard-list"></i></span>
                    Daftar Kunjungan
                </h5>
                <small class="text-muted">Kelola semua data pemeriksaan siswa</small>
            </div>
            <a href="{{ route('admin.examinations.create') }}" class="btn btn-primary-custom">
                <i class="fas fa-plus me-1"></i> Input Kunjungan Baru
            </a>
        </div>

        <!-- Pencarian -->
        <form method="GET" action="{{ route('admin.examinations.index') }}" class="filter-card">
            <input type="text" name="search" class="form-control" placeholder="Cari nama/NIS siswa... (tekan Enter untuk mencari)" value="{{ request('search') }}">
        </form>

        <!-- Tabel -->
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th style="width: 45px;">No</th>
                        <th style="min-width: 120px;">Tanggal & Jam</th>
                        <th style="min-width: 160px;">Siswa</th>
                        <th>Kelas</th>
                        <th style="min-width: 140px;">Keluhan</th>
                        <th style="min-width: 140px;">Diagnosa</th>
                        <th>Petugas</th>
                        <th>Status</th>
                        <th class="text-end" style="width: 140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($examinations as $index => $exam)
                        <tr>
                            <td class="text-muted">{{ $examinations->firstItem() + $index }}</td>
                            <td>
                                <div class="fw-semibold">{{ \Carbon\Carbon::parse($exam->examination_date)->format('d/m/Y') }}</div>
                                <small class="text-muted"><i class="far fa-clock me-1"></i>{{ \Carbon\Carbon::parse($exam->arrival_time)->format('H:i') }} WIB</small>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $exam->student->full_name ?? '-' }}</div>
                                <small class="text-muted">{{ $exam->student->nis ?? '-' }}</small>
                            </td>
                            <td><span class="badge bg-light text-dark border">{{ $exam->student->class->name ?? '-' }}</span></td>
                            <td><small>{{ Str::limit($exam->complaint, 35) }}</small></td>
                            <td><small>{{ Str::limit($exam->diagnosis, 35) }}</small></td>
                            <td>
                                <span class="badge bg-info bg-opacity-10 text-info">
                                    <i class="fas fa-user-nurse me-1"></i> {{ $exam->officer_name ?? 'UKS' }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $isPerluPerhatian = in_array($exam->status, ['istirahat_uks', 'rawat_jalan', 'rujuk_puskesmas', 'rujuk_rs', 'hubungi_ortu']);
                                    $statusText = match($exam->status) {
                                        'pulang' => 'Pulang (Sehat)',
                                        'istirahat_uks' => 'Istirahat UKS',
                                        'rawat_jalan' => 'Rawat Jalan',
                                        'rujuk_puskesmas' => 'Rujuk Puskesmas',
                                        'rujuk_rs' => 'Rujuk RS',
                                        'hubungi_ortu' => 'Hubungi Ortu',
                                        default => ucfirst(str_replace('_', ' ', $exam->status))
                                    };
                                @endphp
                                <span class="badge {{ $isPerluPerhatian ? 'bg-danger' : 'bg-success' }}">
                                    {{ $statusText }}
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="aksi-group">
                                    <a href="{{ route('admin.examinations.show', $exam->id) }}" class="btn-aksi detail" data-tip="Lihat Detail">
                                        <i class="fas fa-eye"></i></a>
                                    <a href="{{ route('admin.examinations.edit', $exam->id) }}" class="btn-aksi edit" data-tip="Edit Data">
                                        <i class="fas fa-pen-to-square"></i></a>
                                    <form action="{{ route('admin.examinations.destroy', $exam->id) }}" method="POST" class="form-hapus"
                                          onsubmit="return konfirmasiHapus(event, '{{ addslashes($exam->student->full_name ?? 'data ini') }}')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-aksi hapus" data-tip="Hapus Data">
                                            <i class="fas fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-5 text-muted">
                                <i class="fas fa-folder-open fa-3x mb-3 opacity-25"></i>
                                <p class="mb-0">Belum ada data kunjungan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">
            {{ $examinations->links() }}
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function konfirmasiHapus(event, namaSiswa) {
        event.preventDefault();
        const form = event.target;
        const konfirmasi = confirm(
            `⚠️ Konfirmasi Hapus Data\n\n` +
            `Apakah Anda yakin ingin menghapus data kunjungan siswa:\n` +
            `"${namaSiswa}"?\n\n` +
            `Data yang dihapus tidak dapat dikembalikan.`
        );
        if (konfirmasi) form.submit();
        return false;
    }
</script>
@endpush