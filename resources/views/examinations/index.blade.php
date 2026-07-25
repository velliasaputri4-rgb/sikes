@extends('layouts.app')

@section('page-title', 'Data Kunjungan')

@section('content')
    <div class="content-card">
        <!-- Header Halaman -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0">Data Kunjungan Siswa</h5>
            <div class="d-flex gap-2">
                <div class="input-group" style="width: 250px;">
                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" class="form-control border-start-0 ps-0" placeholder="Cari nama/NIS..." id="searchInput">
                </div>
                <a href="{{ route('examinations.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Tambah Data
                </a>
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-3">Foto</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Tanggal</th>
                        <th>Keluhan</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($examinations as $exam)
                        <tr>
                            <td class="ps-3">
                                @php
                                    $photoUrl = $exam->student->user->photo ? asset('storage/' . $exam->student->user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($exam->student->full_name) . '&background=random';
                                @endphp
                                <img src="{{ $photoUrl }}" class="rounded-circle border" width="40" height="40" style="object-fit: cover;">
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $exam->student->full_name }}</div>
                                <small class="text-muted">{{ $exam->student->nis }}</small>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">{{ $exam->student->class->name ?? '-' }}</span>
                            </td>
                            <td>{{ $exam->examination_date->format('d/m/Y') }}</td>
                            <td>{{ Str::limit($exam->complaint, 30) }}</td>
                            <td>
                                @if($exam->status === 'pulang' || $exam->status === 'rawat_jalan')
                                    <span class="badge bg-danger">Sakit</span>
                                @else
                                    <span class="badge bg-success">Tidak Sakit</span>
                                @endif
                            </td>
                            <td class="text-end pe-3">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('examinations.show', $exam->id) }}" class="btn btn-outline-primary" title="Detail"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('examinations.edit', $exam->id) }}" class="btn btn-outline-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('examinations.destroy', $exam->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Hapus"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-folder-open fa-2x mb-2 opacity-50"></i>
                                <p class="mb-0">Belum ada data kunjungan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-end mt-4">
            {{ $examinations->links() }}
        </div>
    </div>
@endsection