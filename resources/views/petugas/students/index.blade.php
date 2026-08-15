@extends('layouts.petugas')

@section('title', 'Data Siswa')
@section('page-title', 'Data Siswa')

@section('content')
    <style>
        :root { --navy-900: #0f172a; }
        .page-head { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
        .page-head h5 { font-weight: 800; color: var(--navy-900); margin-bottom: 2px; display: flex; align-items: center; gap: 10px; }
        .page-head h5 .head-icon { width: 38px; height: 38px; border-radius: 10px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: white; display: inline-flex; align-items: center; justify-content: center; font-size: 15px; box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3); }
        .filter-card { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 16px; margin-bottom: 20px; }
        .filter-card .form-control:focus { border-color: #93c5fd; box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12); }
        .table thead th { background: #f8fafc; color: #475569; font-weight: 700; font-size: 11px; text-transform: uppercase; letter-spacing: 0.8px; border-bottom: 2px solid #e2e8f0; }
        .table-hover tbody tr:hover { background-color: #eff6ff; }
    </style>

    <div class="content-card">
        <div class="page-head">
            <div>
                <h5><span class="head-icon"><i class="fas fa-users"></i></span> Daftar Siswa</h5>
                <small class="text-muted">Data siswa yang terdaftar di sistem</small>
            </div>
            <a href="{{ route('petugas.students.create') }}" class="btn btn-primary-custom">
                <i class="fas fa-plus me-1"></i> Tambah Siswa
            </a>
        </div>

        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

        <form method="GET" action="{{ route('petugas.students.index') }}" class="filter-card">
            <input type="text" name="search" class="form-control" placeholder="Cari nama/NIS siswa... (tekan Enter)" value="{{ request('search') }}">
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th style="width: 45px;">No</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Tanggal Lahir</th>
                        <th style="width: 100px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $index => $student)
                        <tr>
                            <td class="text-muted">{{ ($students->currentPage() - 1) * $students->perPage() + $loop->iteration }}</td>
                            <td>{{ $student->nis }}</td>
                            <td class="fw-semibold">{{ $student->full_name }}</td>
                            <td><span class="badge bg-light text-dark border">{{ $student->class->name ?? '-' }}</span></td>
                            <td>
                                @if($student->birth_date) {{ \Carbon\Carbon::parse($student->birth_date)->format('d/m/Y') }}
                                @else <span class="text-muted">-</span> @endif
                            </td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('petugas.students.edit', $student->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('petugas.students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus {{ $student->full_name }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="fas fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fas fa-folder-open fa-3x mb-3 opacity-25"></i>
                                <p class="mb-0">Belum ada data siswa</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">{{ $students->links() }}</div>
    </div>
@endsection