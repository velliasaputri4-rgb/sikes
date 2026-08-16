@extends('layouts.petugas')

@section('title', 'Data Peminjaman')
@section('page-title', 'Peminjaman Inventaris UKS')

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
        .st-borrowed { background: #fef3c7 !important; color: #92400e !important; border-color: #fcd34d !important; }
        .st-returned { background: #dcfce7 !important; color: #166534 !important; border-color: #86efac !important; }
        .st-overdue { background: #fee2e2 !important; color: #991b1b !important; border-color: #fca5a5 !important; }
        .st-lost { background: #e2e8f0 !important; color: #334155 !important; border-color: #94a3b8 !important; }
    </style>

    <div class="content-card">
        <div class="page-head">
            <div>
                <h5><span class="head-icon"><i class="fas fa-handshake"></i></span> Daftar Peminjaman</h5>
                <small class="text-muted">Kelola peminjaman dan pengembalian inventaris</small>
            </div>
            <a href="{{ route('petugas.borrowings.create') }}" class="btn btn-primary-custom">
                <i class="fas fa-plus me-1"></i> Pinjam Barang
            </a>
        </div>

        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

        <form method="GET" action="{{ route('petugas.borrowings.index') }}" class="filter-card">
            <input type="text" name="search" class="form-control" placeholder="Cari nama peminjam/barang... (tekan Enter)" value="{{ request('search') }}">
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th style="width: 45px;">No</th>
                        <th>Peminjam</th>
                        <th>Barang</th>
                        <th>Tgl Pinjam</th>
                        <th>Rencana Kembali</th>
                        <th>Status</th>
                        <th style="width: 130px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($borrowings as $index => $borrow)
                        @php
                            $stu = $students[$borrow->student_id] ?? null;
                            $itm = $items[$borrow->item_id] ?? null;
                            $status = strtolower($borrow->status ?? 'borrowed');
                            $label = ['borrowed' => 'Dipinjam', 'returned' => 'Kembali', 'overdue' => 'Terlambat', 'lost' => 'Hilang'][$status] ?? ucfirst($status);
                        @endphp
                        <tr>
                            <td class="text-muted">{{ ($borrowings->currentPage() - 1) * $borrowings->perPage() + $loop->iteration }}</td>
                            <td>
                                <div class="fw-semibold">{{ $stu->full_name ?? '-' }}</div>
                                <small class="text-muted">{{ $stu->nis ?? '' }}</small>
                            </td>
                            <td>{{ $itm->name ?? '-' }}</td>
                            <td>{{ $borrow->borrow_date ? \Carbon\Carbon::parse($borrow->borrow_date)->format('d/m/Y') : '-' }}</td>
                            <td>{{ $borrow->expected_return_date ? \Carbon\Carbon::parse($borrow->expected_return_date)->format('d/m/Y') : '-' }}</td>
                            <td><span class="badge st-{{ $status }}">{{ $label }}</span></td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-1">
                                    @if(in_array($status, ['borrowed', 'overdue']))
                                        <form action="{{ route('petugas.borrowings.return', $borrow->id) }}" method="POST" onsubmit="return confirm('Konfirmasi barang sudah dikembalikan?')">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-outline-success" title="Kembalikan">
                                                <i class="fas fa-undo"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('petugas.borrowings.edit', $borrow->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('petugas.borrowings.destroy', $borrow->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data peminjaman ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-inbox fa-3x mb-3 opacity-25"></i>
                                <p class="mb-0">Belum ada data peminjaman</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">{{ $borrowings->links() }}</div>
    </div>
@endsection