@extends('layouts.app')

@section('page-title', 'Manajemen Data Obat')

@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0"><i class="fas fa-pills me-2 text-primary"></i>Data Obat UKS</h5>
            <a href="{{ route('medicines.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah Obat
            </a>
        </div>

        <!-- Filter & Search -->
        <form method="GET" action="{{ route('medicines.index') }}" class="row g-3 mb-4">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Cari nama atau kode obat..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                    <option value="low_stock" {{ request('status') == 'low_stock' ? 'selected' : '' }}>Stok Menipis</option>
                    <option value="empty" {{ request('status') == 'empty' ? 'selected' : '' }}>Habis</option>
                    <option value="near_expired" {{ request('status') == 'near_expired' ? 'selected' : '' }}>Hampir Kedaluwarsa</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search me-1"></i> Filter</button>
            </div>
            <div class="col-md-3">
                <a href="{{ route('medicines.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
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
                        <th>Stok</th>
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
                            <td>{{ $med->category->name ?? 'Umum' }}</td>
                            <td>
                                <span class="fw-bold {{ $med->stock <= $med->minimum_stock ? 'text-danger' : 'text-dark' }}">
                                    {{ $med->stock }}
                                </span>
                                <small class="text-muted">/ Min: {{ $med->minimum_stock }}</small>
                            </td>
                            <td>{{ $med->unit }}</td>
                            <td>{{ $med->expired_date ? \Carbon\Carbon::parse($med->expired_date)->format('d M Y') : '-' }}</td>
                            <td>
                                @php
                                    $statusMap = [
                                        'available' => ['class' => 'bg-success', 'text' => 'Tersedia'],
                                        'low_stock' => ['class' => 'bg-warning text-dark', 'text' => 'Menipis'],
                                        'empty' => ['class' => 'bg-danger', 'text' => 'Habis'],
                                        'near_expired' => ['class' => 'bg-info text-dark', 'text' => 'Segera Exp'],
                                        'expired' => ['class' => 'bg-secondary', 'text' => 'Kedaluwarsa'],
                                    ];
                                    $status = $statusMap[$med->status] ?? $statusMap['available'];
                                @endphp
                                <span class="badge {{ $status['class'] }} rounded-pill">{{ $status['text'] }}</span>
                            </td>
                            <td class="text-end pe-3">
                                <div class="btn-group btn-group-sm">
                                    <a href="#" class="btn btn-outline-primary" title="Edit"><i class="fas fa-edit"></i></a>
                                    <form action="#" method="POST" class="d-inline" onsubmit="return confirm('Hapus data obat ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Hapus"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fas fa-box-open fa-2x mb-2 opacity-50"></i>
                                <p class="mb-0">Belum ada data obat</p>
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