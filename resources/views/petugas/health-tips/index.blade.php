@extends('layouts.petugas')

@section('title', 'Kelola Tips Kesehatan')
@section('page-title', 'Kelola Tips Kesehatan')

@section('content')
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0 text-dark">
            <i class="fas fa-lightbulb text-warning me-2"></i>Daftar Tips Kesehatan
        </h5>
        <a href="{{ route('petugas.health-tips.create') }}" class="btn btn-primary-custom btn-sm">
            <i class="fas fa-plus me-1"></i> Tambah Tips Baru
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="25%">Judul</th>
                    <th width="15%">Kategori</th>
                    <th>Isi Ringkas</th>
                    <th width="15%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tips as $index => $tip)
                <tr>
                    <td class="text-center">{{ $tips->firstItem() + $index }}</td>
                    <td class="fw-semibold text-dark">{{ $tip->title }}</td>
                    <td>
                        <span class="badge bg-info text-dark">
                            {{ ucfirst(str_replace('_', ' ', $tip->category)) }}
                        </span>
                    </td>
                    <td class="text-muted small">{{ Str::limit(strip_tags($tip->content), 60) }}</td>
                    <td class="text-center">
                        <a href="{{ route('petugas.health-tips.edit', $tip->id) }}" class="btn btn-sm btn-warning text-white me-1" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('petugas.health-tips.destroy', $tip->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus tips ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                        Belum ada data tips kesehatan. Silakan tambah data baru.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($tips->hasPages())
    <div class="mt-3 d-flex justify-content-end">
        {{ $tips->links() }}
    </div>
    @endif
</div>
@endsection