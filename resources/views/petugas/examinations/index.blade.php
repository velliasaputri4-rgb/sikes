@extends('layouts.petugas')

@section('title', 'Data Kunjungan')
@section('page-title', 'Data Kunjungan Siswa')

@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h5 class="fw-bold mb-1">Daftar Kunjungan</h5>
                <small class="text-muted">Kelola semua data pemeriksaan siswa</small>
            </div>
            <a href="{{ route('petugas.examinations.create') }}" class="btn btn-primary-custom">
                <i class="fas fa-plus me-1"></i> Input Kunjungan Baru
            </a>
        </div>

        <!-- Filter -->
        <form method="GET" action="{{ route('petugas.examinations.index') }}" class="row g-3 mb-4 p-3 bg-light rounded">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control" placeholder="Cari nama/NIS siswa..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <input type="date" name="date" class="form-control" value="{{ request('date') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary-custom w-100">
                    <i class="fas fa-search"></i> Filter
                </button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('petugas.examinations.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
            </div>
        </form>

        <!-- Tabel -->
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Siswa</th>
                        <th>Kelas</th>
                        <th>Keluhan</th>
                        <th>Diagnosa</th>
                        <th>Status</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($examinations as $index => $exam)
                        <tr>
                            <td>{{ $examinations->firstItem() + $index }}</td>
                            <td>
                                <div class="fw-semibold">{{ $exam->examination_date->format('d/m/Y') }}</div>
                                <small class="text-muted">{{ $exam->examination_date->format('H:i') }}</small>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $exam->student->full_name ?? '-' }}</div>
                                <small class="text-muted">{{ $exam->student->nis ?? '-' }}</small>
                            </td>
                            <td><span class="badge bg-light text-dark">{{ $exam->student->class->name ?? '-' }}</span></td>
                            <td>{{ Str::limit($exam->complaint, 25) }}</td>
                            <td>{{ Str::limit($exam->diagnosis, 25) }}</td>
                            <td>
                                @php
                                    $isSakit = in_array($exam->status, ['pulang', 'rawat_jalan', 'rujuk_puskesmas', 'rujuk_rs']);
                                @endphp
                                <span class="badge {{ $isSakit ? 'bg-danger' : 'bg-success' }}">
                                    {{ $isSakit ? 'Sakit' : 'Sehat' }}
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('petugas.examinations.show', $exam->id) }}" class="btn btn-outline-primary" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('petugas.examinations.edit', $exam->id) }}" class="btn btn-outline-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('petugas.examinations.destroy', $exam->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
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