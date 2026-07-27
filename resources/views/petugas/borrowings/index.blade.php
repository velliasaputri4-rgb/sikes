@extends('layouts.petugas')

@section('title', 'Data Peminjaman')
@section('page-title', 'Data Peminjaman Barang')

@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h5 class="fw-bold mb-1"><i class="fas fa-hand-holding-medical me-2 text-success"></i>Daftar Peminjaman</h5>
                <small class="text-muted">Catatan barang yang dipinjam oleh siswa</small>
            </div>
            <a href="{{ route('petugas.borrowings.create') }}" class="btn btn-primary-custom">
                <i class="fas fa-plus me-1"></i> Catat Peminjaman Baru
            </a>
        </div>

        <!-- Tabel Data -->
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-3">Tanggal Pinjam</th>
                        <th>Barang</th>
                        <th>Peminjam (Siswa)</th>
                        <th>Petugas</th>
                        <th class="text-center">Status</th>
                        <th>Tgl. Kembali</th>
                        <th class="text-end pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($borrowings as $borrowing)
                        <tr>
                            <td class="ps-3">
                                <div class="fw-semibold">{{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('d/m/Y') }}</div>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $borrowing->item->name ?? 'Barang Dihapus' }}</div>
                                <small class="text-muted">{{ $borrowing->item->code ?? '-' }}</small>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $borrowing->student->full_name ?? 'Siswa Dihapus' }}</div>
                                <small class="text-muted">{{ $borrowing->student->nis ?? '-' }}</small>
                            </td>
                            <td>
                                <small class="text-muted"><i class="fas fa-user-nurse me-1"></i> {{ $borrowing->borrowedBy->name ?? '-' }}</small>
                            </td>
                            <td class="text-center">
                                @php
                                    $statusClass = match($borrowing->status) {
                                        'borrowed' => 'bg-primary',
                                        'overdue' => 'bg-danger',
                                        'returned' => 'bg-success',
                                        'lost' => 'bg-dark',
                                        default => 'bg-secondary'
                                    };
                                    $statusText = match($borrowing->status) {
                                        'borrowed' => 'Dipinjam',
                                        'overdue' => 'Terlambat',
                                        'returned' => 'Dikembalikan',
                                        'lost' => 'Hilang',
                                        default => 'Tidak Diketahui'
                                    };
                                @endphp
                                <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
                            </td>
                            <td>
                                @if($borrowing->return_date)
                                    <span class="text-success fw-semibold"><i class="fas fa-check-circle me-1"></i> {{ \Carbon\Carbon::parse($borrowing->return_date)->format('d/m/Y') }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-end pe-3">
                                <div class="btn-group btn-group-sm">
                                    @if(in_array($borrowing->status, ['borrowed', 'overdue']))
                                        <form action="{{ route('petugas.borrowings.return', $borrowing->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Konfirmasi pengembalian barang ini?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-outline-success" title="Kembalikan">
                                                <i class="fas fa-undo"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('petugas.borrowings.destroy', $borrowing->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data peminjaman ini? Stok barang akan dikembalikan jika belum dikembalikan.')">
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
                                <i class="fas fa-clipboard-list fa-3x mb-3 opacity-25"></i>
                                <p class="mb-0">Belum ada data peminjaman</p>
                                <a href="{{ route('petugas.borrowings.create') }}" class="btn btn-sm btn-outline-primary mt-2">Catat Peminjaman Pertama</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-end mt-3">
            {{ $borrowings->links() }}
        </div>
    </div>
@endsection