@extends('layouts.petugas')

@section('title', 'Data Siswa')
@section('page-title', 'Data Siswa')

@section('content')
    <style>
        :root { 
            --ink: #0f172a;
            --primary: #ef4444;
            --primary-dark: #991b1b;
        }
        
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
            color: var(--ink); 
            margin-bottom: 2px; 
            display: flex; 
            align-items: center; 
            gap: 10px; 
        }
        .page-head h5 .head-icon { 
            width: 38px; 
            height: 38px; 
            border-radius: 10px; 
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); 
            color: white; 
            display: inline-flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 15px; 
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3); 
        }
        
        .filter-card { 
            background: #ffffff; 
            border: 1px solid #fee2e2; 
            border-radius: 12px; 
            padding: 16px; 
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.04);
        }
        .filter-card .form-control:focus,
        .filter-card .form-select:focus { 
            border-color: #fca5a5 !important; 
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.12) !important; 
        }
        .filter-card .form-control,
        .filter-card .form-select {
            border-color: #fecaca;
        }
        
        .table thead th { 
            background: #fef2f2; 
            color: #991b1b; 
            font-weight: 700; 
            font-size: 11px; 
            text-transform: uppercase; 
            letter-spacing: 0.8px; 
            border-bottom: 2px solid #fecaca; 
        }
        .table-hover tbody tr:hover { 
            background-color: #fef2f2 !important; 
        }
        
        .badge-kelas {
            background: #fef2f2 !important;
            color: #991b1b !important;
            border: 1px solid #fecaca !important;
            font-weight: 500;
            padding: 6px 10px;
        }

        .phone-cell { 
            font-family: 'SF Mono', 'Consolas', monospace; 
            font-size: 13px; 
            color: #334155; 
            letter-spacing: 0.3px; 
        }
        .phone-cell a {
            color: #991b1b;
            transition: all 0.2s;
        }
        .phone-cell a:hover {
            color: #ef4444;
            text-decoration: underline !important;
        }

        .btn-aksi-edit {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            border: none;
            box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
            transition: all 0.2s;
        }
        .btn-aksi-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
            color: white;
        }

        .btn-aksi-hapus {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            border: none;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
            transition: all 0.2s;
        }
        .btn-aksi-hapus:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
            color: white;
        }

        .alert-success-custom {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
            border-left: 4px solid #10b981;
            border-radius: 10px;
            padding: 14px 18px;
            margin-bottom: 16px;
        }
        .alert-danger-custom {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
            border-left: 4px solid #ef4444;
            border-radius: 10px;
            padding: 14px 18px;
            margin-bottom: 16px;
        }
    </style>

    <div class="content-card">
        <div class="page-head">
            <div>
                <h5>
                    <span class="head-icon"><i class="fas fa-users"></i></span> 
                    Daftar Siswa
                </h5>
                <small class="text-muted">Data siswa yang terdaftar di sistem</small>
            </div>
            <a href="{{ route('petugas.students.create') }}" class="btn btn-primary-custom">
                <i class="fas fa-plus me-1"></i> Tambah Siswa
            </a>
        </div>

        @if(session('success')) 
            <div class="alert-success-custom">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div> 
        @endif
        @if(session('error')) 
            <div class="alert-danger-custom">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            </div> 
        @endif

        {{-- ✅ FORM FILTER LENGKAP & DATAR (TANPA KATEGORI) --}}
        <form method="GET" action="{{ route('petugas.students.index') }}" class="filter-card">
            <div class="row g-2 align-items-center">
                <!-- 1. Input Pencarian -->
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama/NIS siswa..." value="{{ request('search') }}">
                </div>
                
                <!-- 2. ✅ DROPDOWN KELAS DATAR (Langsung dari database, urut abjad, tanpa optgroup) -->
                <div class="col-md-3">
                    <select name="class" class="form-select">
                        <option value="">Semua Kelas</option>
                        @foreach($classes ?? [] as $class)
                            <option value="{{ $class->name }}" @selected(request('class') == $class->name)>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- 3. Checkbox Tanggal Lahir Kosong -->
                <div class="col-md-auto">
                    <label class="form-check d-flex align-items-center gap-2 mb-0">
                        <input class="form-check-input" type="checkbox" name="birth_date_missing" value="1" @checked(request('birth_date_missing') == '1')>
                        <span class="form-check-label">Tanggal lahir kosong</span>
                    </label>
                </div>

                <!-- 4. Tombol Aksi -->
                <div class="col-md-auto">
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                    <a href="{{ route('petugas.students.index') }}" class="btn btn-outline-secondary ms-1" title="Reset Filter">
                        <i class="fas fa-rotate-left"></i>
                    </a>
                </div>
            </div>
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
                        <th>No. HP Wali</th>
                        <th style="width: 120px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $index => $student)
                        <tr>
                            <td class="text-muted">{{ ($students->currentPage() - 1) * $students->perPage() + $loop->iteration }}</td>
                            <td class="fw-semibold" style="color: #0f172a;">{{ $student->nis }}</td>
                            <td class="fw-semibold" style="color: #0f172a;">{{ $student->full_name }}</td>
                            <td>
                                <span class="badge badge-kelas">
                                    {{ $student->class->name ?? '-' }}
                                </span>
                            </td>
                            <td>
                                @if($student->birth_date) 
                                    {{ \Carbon\Carbon::parse($student->birth_date)->format('d/m/Y') }}
                                @else 
                                    <span class="badge bg-warning text-dark" style="font-size: 11px;">Kosong</span>
                                @endif
                            </td>
                            <td class="phone-cell">
                                @if($student->parent_phone)
                                    <a href="tel:{{ $student->parent_phone }}" class="text-decoration-none" title="Klik untuk menelepon">
                                        <i class="fas fa-phone me-1" style="font-size: 11px; color: #ef4444;"></i>{{ $student->parent_phone }}
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('petugas.students.edit', $student->id) }}" class="btn btn-sm btn-aksi-edit" style="width: 34px; height: 34px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;" title="Edit">
                                        <i class="fas fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('petugas.students.destroy', $student->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus {{ $student->full_name }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-aksi-hapus" style="width: 34px; height: 34px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;" title="Hapus">
                                            <i class="fas fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);">
                                    <i class="fas fa-folder-open fa-2x" style="color: #ef4444;"></i>
                                </div>
                                <p class="mb-0 fw-semibold" style="color: #475569;">Belum ada data siswa</p>
                                <small class="text-muted">Silakan tambah siswa baru atau ubah filter pencarian.</small>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">{{ $students->links() }}</div>
    </div>
@endsection