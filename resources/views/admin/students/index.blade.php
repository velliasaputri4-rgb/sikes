@extends('layouts.admin')

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
        
        .btn-primary-custom {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3);
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            text-decoration: none;
        }
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(37, 99, 235, 0.4);
            color: white;
        }
        
        /* ✅ PAGINATION SUPER SIMPLE */
        .pagination-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #e2e8f0;
            font-size: 13px;
            color: #64748b;
        }
        .pagination-wrapper .pagination {
            display: flex;
            gap: 8px;
            margin: 0;
            list-style: none;
            padding: 0;
        }
        .pagination-wrapper .page-link {
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            color: #475569;
            padding: 6px 14px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            background: white;
            transition: all 0.2s;
        }
        .pagination-wrapper .page-link:hover {
            background: #eff6ff;
            border-color: #2563eb;
            color: #2563eb;
        }
        .pagination-wrapper .page-item.disabled .page-link {
            color: #cbd5e1;
            cursor: not-allowed;
            background: #f8fafc;
        }
    </style>

    <div class="content-card">
        <div class="page-head">
            <div>
                <h5><span class="head-icon"><i class="fas fa-users"></i></span> Daftar Siswa</h5>
                <small class="text-muted">Data siswa yang terdaftar di sistem</small>
            </div>
            <a href="{{ route('admin.students.create') }}" class="btn btn-primary-custom">
                <i class="fas fa-plus me-1"></i> Tambah Siswa
            </a>
        </div>

        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

        <form method="GET" action="{{ route('admin.students.index') }}" class="filter-card">
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
                                    <a href="{{ route('admin.students.edit', $student->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus {{ $student->full_name }}?')">
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

        {{-- ✅ PAGINATION SUPER SIMPLE (HANYA PREVIOUS/NEXT) --}}
        @if($students->hasPages())
            <div class="pagination-wrapper">
                <span>{{ $students->firstItem() }}-{{ $students->lastItem() }} dari {{ $students->total() }} data</span>
                <nav>
                    <ul class="pagination">
                        @if($students->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&laquo; Previous</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $students->previousPageUrl() }}">&laquo; Previous</a></li>
                        @endif

                        @if($students->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $students->nextPageUrl() }}">Next &raquo;</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">Next &raquo;</span></li>
                        @endif
                    </ul>
                </nav>
            </div>
        @endif
    </div>
@endsection