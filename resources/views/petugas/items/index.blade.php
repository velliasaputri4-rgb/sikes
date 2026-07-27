@extends('layouts.petugas')

@section('title', 'Data Barang Inventaris')
@section('page-title', 'Data Barang Inventaris')

@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h5 class="fw-bold mb-1"><i class="fas fa-boxes me-2 text-success"></i>Daftar Barang Inventaris</h5>
                <small class="text-muted">Kelola semua barang dan alat yang dimiliki UKS</small>
            </div>
            <a href="{{ route('petugas.items.create') }}" class="btn btn-primary-custom">
                <i class="fas fa-plus me-1"></i> Tambah Barang Baru
            </a>
        </div>

        <!-- Tabel Data -->
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-3">Kode</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Tersedia</th>
                        <th>Kondisi</th>
                        <th class="text-end pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td class="ps-3"><span class="badge bg-secondary">{{ $item->code }}</span></td>
                            <td>
                                <div class="fw-semibold">{{ $item->name }}</div>
                                @if($item->description)
                                    <small class="text-muted">{{ Str::limit($item->description, 40) }}</small>
                                @endif
                            </td>
                            <td><span class="badge bg-light text-dark border">{{ $item->category ?: 'Umum' }}</span></td>
                            <td class="text-center fw-bold">{{ $item->quantity }}</td>
                            <td class="text-center">
                                @if($item->available > 0)
                                    <span class="badge bg-success">{{ $item->available }}</span>
                                @else
                                    <span class="badge bg-danger">0</span>
                                @endif
                            </td>
                            <td>
                                @php
                                    $conditionClass = match($item->condition) {
                                        'good' => 'bg-success',
                                        'damaged' => 'bg-warning text-dark',
                                        'lost' => 'bg-danger',
                                        default => 'bg-secondary'
                                    };
                                    $conditionText = match($item->condition) {
                                        'good' => 'Baik',
                                        'damaged' => 'Rusak',
                                        'lost' => 'Hilang',
                                        default => 'Tidak Diketahui'
                                    };
                                @endphp
                                <span class="badge {{ $conditionClass }}">{{ $conditionText }}</span>
                            </td>
                            <td class="text-end pe-3">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('petugas.items.edit', $item->id) }}" class="btn btn-outline-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('petugas.items.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
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
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-box-open fa-3x mb-3 opacity-25"></i>
                                <p class="mb-0">Belum ada data barang inventaris</p>
                                <a href="{{ route('petugas.items.create') }}" class="btn btn-sm btn-outline-primary mt-2">Tambah Barang Pertama</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-end mt-3">
            {{ $items->links() }}
        </div>
    </div>
@endsection