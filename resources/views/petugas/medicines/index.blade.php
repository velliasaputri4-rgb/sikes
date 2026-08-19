@extends('layouts.petugas')

@section('title', 'Data Obat')
@section('page-title', 'Manajemen Data Obat')

@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h5 class="fw-bold mb-1"><i class="fas fa-pills me-2 text-success"></i>Data Obat UKS</h5>
                <small class="text-muted">Kelola stok dan informasi obat-obatan</small>
            </div>
            <a href="{{ route('petugas.medicines.create') }}" class="btn btn-primary-custom">
                <i class="fas fa-plus me-1"></i> Tambah Obat Baru
            </a>
        </div>

        <!-- Search -->
        <form method="GET" action="{{ route('petugas.medicines.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari nama atau kode obat..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fas fa-search me-1"></i> Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('petugas.medicines.index') }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </div>
        </form>

        <!-- Tabel Data -->
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-3">Kode</th>
                        <th>Nama Obat</th>
                        <th>Kategori</th>
                        <th class="text-center">Stok</th>
                        <th>Satuan</th>
                        <th>Kedaluwarsa</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($medicines as $med)
                        <tr>
                            <td class="ps-3 fw-semibold">{{ $med->code }}</td>
                            <td>{{ $med->name }}</td>
                            <td><span class="badge bg-light text-dark border">{{ $med->category->name ?? 'Umum' }}</span></td>
                            <td class="text-center">
                                <span class="fw-bold {{ $med->stock <= ($med->minimum_stock ?? 5) ? 'text-danger' : 'text-dark' }}">
                                    {{ $med->stock }}
                                </span>
                            </td>
                            <td>{{ $med->unit }}</td>
                            <td>{{ $med->expired_date ? \Carbon\Carbon::parse($med->expired_date)->format('d M Y') : '-' }}</td>
                            <td>
                                @php
                                    $statusClass = match($med->status) {
                                        'available' => 'bg-success',
                                        'low_stock' => 'bg-warning text-dark',
                                        'empty' => 'bg-danger',
                                        'near_expired' => 'bg-info text-dark',
                                        'expired' => 'bg-dark',
                                        default => 'bg-secondary'
                                    };
                                    $statusText = match($med->status) {
                                        'available' => 'Tersedia',
                                        'low_stock' => 'Menipis',
                                        'empty' => 'Habis',
                                        'near_expired' => 'Hampir Exp',
                                        'expired' => 'Kedaluwarsa',
                                        default => 'Tidak Diketahui'
                                    };
                                @endphp
                                <span class="badge {{ $statusClass }} rounded-pill">{{ $statusText }}</span>
                            </td>
                            <td class="text-end pe-3">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('petugas.medicines.edit', $med->id) }}" class="btn btn-outline-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('petugas.medicines.destroy', $med->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus obat ini?')">
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
                                <i class="fas fa-box-open fa-3x mb-3 opacity-25"></i>
                                <p class="mb-0">Belum ada data obat</p>
                                <a href="{{ route('petugas.medicines.create') }}" class="btn btn-sm btn-outline-primary mt-2">Tambah Obat Pertama</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-4">
            {{ $medicines->links() }}
        </div>
    </div>
@endsection