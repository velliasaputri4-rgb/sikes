@extends('layouts.app')

@section('title', 'Data Siswa')
@section('page-title', 'Manajemen Data Siswa')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Daftar Siswa</h4>
        <a href="{{ route('students.create') }}" class="btn btn-primary rounded-pill shadow-sm">
            <i class="fas fa-plus me-2"></i> Tambah Siswa
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <!-- Filter & Search -->
            <form method="GET" action="{{ route('students.index') }}" class="row g-3 mb-4">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari NIS atau Nama..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="class_id" class="form-select">
                        <option value="">Semua Kelas</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search me-1"></i> Cari</button>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
                </div>
            </form>

            <!-- Tabel Data -->
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Foto</th>
                            <th>NIS</th>
                            <th>Nama Lengkap</th>
                            <th>Kelas</th>
                            <th>JK</th>
                            <th>No. Ortu</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                            <tr>
                                <td class="ps-4">
                                    <img src="{{ $student->user->photo ? asset('storage/' . $student->user->photo) : asset('images/avatar.png') }}" 
                                         class="rounded-circle border" width="40" height="40" style="object-fit: cover;">
                                </td>
                                <td><span class="fw-semibold">{{ $student->nis }}</span></td>
                                <td>{{ $student->full_name }}</td>
                                <td>
                                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill">
                                        {{ $student->class->name ?? '-' }}
                                    </span>
                                </td>
                                <td>{{ $student->gender }}</td>
                                <td>{{ $student->parent_phone ?? '-' }}</td>
                                <td class="text-end pe-4">
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-sm btn-outline-primary" title="Detail"><i class="fas fa-eye"></i></a>
                                        <a href="#" class="btn btn-sm btn-outline-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                        <form action="#" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini? Tindakan ini akan menghapus akun login siswa.')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus"><i class="fas fa-trash"></i></button>
        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fas fa-user-slash fa-2x mb-2 opacity-50"></i>
                                    <p class="mb-0">Belum ada data siswa</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-end mt-4">
                {{ $students->links() }}
            </div>
        </div>
    </div>
@endsection