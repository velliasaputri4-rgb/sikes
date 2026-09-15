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
            border: 1px solid #fee2e2;
            border-radius: 12px;
            padding: 16px;
            background: white;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.08);
        }
        
        .table tbody td {
            display: block;
            padding: 8px 0;
            border: none;
            border-bottom: 1px solid #fef2f2;
        }
        
        .table tbody td:last-child {
            border-bottom: none;
        }
        
        .table tbody td::before {
            content: attr(data-label);
            font-weight: 700;
            font-size: 0.75rem;
            text-transform: uppercase;
            color: #991b1b;
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
            border-bottom: 2px solid #fef2f2;
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

    /* Custom Badge Categories */
    .badge-gizi { background: #fef3c7; color: #92400e; border: 1px solid #fde68a; }
    .badge-kebersihan { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }
    .badge-penyakit { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }
    .badge-kesehatan_mental { background: #f5f3ff; color: #5b21b6; border: 1px solid #ddd6fe; }
    .badge-p3k { background: #fff7ed; color: #9a3412; border: 1px solid #fed7aa; }
    .badge-umum { background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; }

    /* Action Buttons */
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
</style>

<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4 page-header-mobile">
        <h5 class="fw-bold mb-0">
            <i class="fas fa-lightbulb me-2" style="color: #ef4444;"></i>Daftar Tips Kesehatan
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
                    <td class="text-muted">{{ $tips->firstItem() + $index }}</td>
                    <td class="fw-semibold" style="color: #0f172a;">{{ $tip->title }}</td>
                    <td>
                        @php
                            $badgeClass = match($tip->category) {
                                'gizi' => 'badge-gizi',
                                'kebersihan' => 'badge-kebersihan',
                                'penyakit' => 'badge-penyakit',
                                'kesehatan_mental' => 'badge-kesehatan_mental',
                                'p3k' => 'badge-p3k',
                                'umum' => 'badge-umum',
                                default => 'badge-umum'
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }}">
                            {{ ucfirst(str_replace('_', ' ', $tip->category)) }}
                        </span>
                    </td>
                    <td class="text-muted small">{{ Str::limit(strip_tags($tip->content), 60) }}</td>
                    <td class="text-center">
                        <a href="{{ route('petugas.health-tips.edit', $tip->id) }}" class="btn btn-sm btn-aksi-edit me-1" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('petugas.health-tips.destroy', $tip->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus tips ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-aksi-hapus" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);">
                            <i class="fas fa-inbox fa-2x" style="color: #ef4444;"></i>
                        </div>
                        <p class="mb-0 fw-semibold" style="color: #475569;">Belum ada data tips kesehatan</p>
                        <small class="text-muted">Silakan tambah data baru.</small>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mobile Card View -->
    <div class="mobile-only">
        @forelse($tips as $index => $tip)
        <div class="mb-3 p-3 rounded-3" style="border: 1px solid #fee2e2; background: white; box-shadow: 0 2px 8px rgba(239, 68, 68, 0.08);">
            <div class="mobile-card-header">
                <div class="mobile-title">{{ $tip->title }}</div>
                @php
                    $badgeClass = match($tip->category) {
                        'gizi' => 'badge-gizi',
                        'kebersihan' => 'badge-kebersihan',
                        'penyakit' => 'badge-penyakit',
                        'kesehatan_mental' => 'badge-kesehatan_mental',
                        'p3k' => 'badge-p3k',
                        'umum' => 'badge-umum',
                        default => 'badge-umum'
                    };
                @endphp
                <span class="badge {{ $badgeClass }} mobile-badge">
                    {{ ucfirst(str_replace('_', ' ', $tip->category)) }}
                </span>
            </div>
            <div class="mb-3">
                <small class="text-muted d-block">{{ Str::limit(strip_tags($tip->content), 80) }}</small>
            </div>
            <div class="mobile-actions">
                <a href="{{ route('petugas.health-tips.edit', $tip->id) }}" class="btn btn-sm btn-aksi-edit flex-fill">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
                <form action="{{ route('petugas.health-tips.destroy', $tip->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tips ini?')" class="flex-fill">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-aksi-hapus w-100">
                        <i class="fas fa-trash me-1"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="text-center py-5">
            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);">
                <i class="fas fa-inbox fa-2x" style="color: #ef4444;"></i>
            </div>
            <p class="mb-0 fw-semibold" style="color: #475569;">Belum ada data tips kesehatan.</p>
            <small class="text-muted">Silakan tambah data baru.</small>
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