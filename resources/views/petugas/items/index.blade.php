@extends('layouts.petugas')

@section('title', 'Data Inventaris')
@section('page-title', 'Data Inventaris UKS')

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
        .kondok-baik { background: #dcfce7 !important; color: #166534 !important; border-color: #86efac !important; }
        .kondok-rusak { background: #fee2e2 !important; color: #991b1b !important; border-color: #fca5a5 !important; }
    </style>

    <div class="content-card">
        <div class="page-head">
            <div>
                <h5><span class="head-icon"><i class="fas fa-boxes"></i></span> Daftar Inventaris</h5>
                <small class="text-muted">Kelola perlengkapan dan peralatan UKS</small>
            </div>
            <a href="{{ route('petugas.items.create') }}" class="btn btn-primary-custom">
                <i class="fas fa-plus me-1"></i> Tambah Barang
            </a>
        </div>

        @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

        <form method="GET" action="{{ route('petugas.items.index') }}" class="filter-card">
            <input type="text" name="search" class="form-control" placeholder="Cari nama/kode barang... (tekan Enter)" value="{{ request('search') }}">
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th style="width: 45px;">No</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Kondisi</th>
                        <th style="width: 100px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items ?? [] as $index => $item)
                        <tr>
                            <td class="text-muted">{{ $index + 1 }}</td>
                            <td><span class="fw-semibold">{{ $item->code ?? '-' }}</span></td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->category ?? '-' }}</td>
                            <td><span class="badge bg-primary bg-opacity-10 text-primary">{{ $item->quantity ?? 0 }}</span></td>
                            <td>
                                @php $kondisi = strtolower($item->condition ?? 'good'); @endphp
                                <span class="badge {{ $kondisi === 'good' ? 'kondok-baik' : 'kondok-rusak' }}">
                                    {{ $kondisi === 'good' ? 'Baik' : 'Rusak' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('petugas.items.edit', $item->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('petugas.items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus {{ $item->name }}?')">
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
                                <i class="fas fa-box-open fa-3x mb-3 opacity-25"></i>
                                <p class="mb-0">Belum ada data inventaris</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($items ?? collect(), 'links'))
            <div class="d-flex justify-content-end mt-3">{{ $items->links() }}</div>
        @endif
    </div>
@endsection