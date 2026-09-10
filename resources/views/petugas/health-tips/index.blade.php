@extends('layouts.petugas')

@section('title', 'Kelola Tips Kesehatan')
@section('page-title', 'Kelola Tips Kesehatan')

@section('content')
<style>
    /* Mobile Responsive Styles */
    @media (max-width: 768px) {
        .table-responsive {
            border: 0;
            box-shadow: none;
        }
        
        .table thead {
            display: none;
        }
        
        .table tbody tr {
            display: block;
            margin-bottom: 16px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px;
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        
        .table tbody td {
            display: block;
            padding: 8px 0;
            border: none;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .table tbody td:last-child {
            border-bottom: none;
        }
        
        .table tbody td::before {
            content: attr(data-label);
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            color: #64748b;
            display: block;
            margin-bottom: 4px;
            letter-spacing: 0.5px;
        }
        
        .mobile-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 2px solid #f1f5f9;
        }
        
        .mobile-title {
            font-weight: 700;
            font-size: 0.95rem;
            color: #0f172a;
            flex: 1;
            margin-right: 8px;
            line-height: 1.4;
        }
        
        .mobile-badge {
            white-space: nowrap;
        }
        
        .mobile-actions {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
        }
        
        .mobile-actions .btn {
            padding: 8px 12px;
            font-size: 0.85rem;
        }
        
        .content-card {
            padding: 16px;
        }
        
        .page-header-mobile {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 12px;
        }
        
        .page-header-mobile h5 {
            font-size: 1.1rem;
        }
        
        .btn-primary-custom {
            width: 100%;
            justify-content: center;
        }
    }
    
    /* Desktop Styles */
    @media (min-width: 769px) {
        .mobile-card-header,
        .mobile-title,
        .mobile-badge,
        .mobile-actions {
            display: none !important;
        }
    }
    
    /* Hide mobile elements on desktop */
    .mobile-only {
        display: none;
    }
    
    @media (max-width: 768px) {
        .mobile-only {
            display: block;
        }
        .desktop-only {
            display: none;
        }
    }
</style>

<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4 page-header-mobile">
        <h5 class="fw-bold mb-0 text-dark">
            <i class="fas fa-lightbulb text-warning me-2"></i>Daftar Tips Kesehatan
        </h5>
        <a href="{{ route('petugas.health-tips.create') }}" class="btn btn-primary-custom btn-sm">
            <i class="fas fa-plus me-1"></i> <span class="d-none d-sm-inline">Tambah Tips Baru</span><span class="d-sm-none">Tambah</span>
        </a>
    </div>

    <!-- Desktop Table View -->
    <div class="table-responsive desktop-only">
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

    <!-- Mobile Card View -->
    <div class="mobile-only">
        @forelse($tips as $index => $tip)
        <div class="mb-3 p-3 border rounded-3 bg-white shadow-sm">
            <div class="mobile-card-header">
                <div class="mobile-title">{{ $tip->title }}</div>
                <span class="badge bg-info text-dark mobile-badge">
                    {{ ucfirst(str_replace('_', ' ', $tip->category)) }}
                </span>
            </div>
            <div class="mb-3">
                <small class="text-muted d-block">{{ Str::limit(strip_tags($tip->content), 80) }}</small>
            </div>
            <div class="mobile-actions">
                <a href="{{ route('petugas.health-tips.edit', $tip->id) }}" class="btn btn-sm btn-warning text-white flex-fill">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
                <form action="{{ route('petugas.health-tips.destroy', $tip->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tips ini?')" class="flex-fill">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger w-100">
                        <i class="fas fa-trash me-1"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="text-center text-muted py-5">
            <i class="fas fa-inbox fa-3x mb-3 d-block opacity-25"></i>
            <p class="mb-0">Belum ada data tips kesehatan.</p>
            <small>Silakan tambah data baru.</small>
        </div>
        @endforelse
    </div>
    
    @if($tips->hasPages())
    <div class="mt-3 d-flex justify-content-center">
        {{ $tips->links() }}
    </div>
    @endif
</div>
@endsection