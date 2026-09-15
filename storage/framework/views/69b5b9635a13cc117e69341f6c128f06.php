

<?php $__env->startSection('title', 'Data Obat'); ?>
<?php $__env->startSection('page-title', 'Manajemen Data Obat'); ?>

<?php $__env->startSection('content'); ?>
    <style>
        /* Filter/Search card tema merah */
        .search-card {
            background: #ffffff;
            border: 1px solid #fee2e2;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.04);
        }
        .search-card .form-control:focus {
            border-color: #fca5a5 !important;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.12) !important;
        }
        .search-card .form-control {
            border-color: #fecaca;
        }

        /* Tabel tema merah */
        .table thead th {
            background: #fef2f2;
            color: #991b1b;
            font-weight: 700;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            border-bottom: 2px solid #fecaca;
            padding: 14px 12px;
        }
        .table-hover tbody tr:hover {
            background-color: #fef2f2 !important;
        }

        /* Badge stok */
        .badge-stok-normal {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
            font-weight: 600;
            padding: 6px 10px;
        }
        .badge-stok-rendah {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            font-weight: 600;
            padding: 6px 10px;
            box-shadow: 0 2px 6px rgba(239, 68, 68, 0.3);
        }

        /* Tombol Aksi */
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
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h5 class="fw-bold mb-1">
                    <i class="fas fa-pills me-2" style="color: #ef4444;"></i>Data Obat UKS
                </h5>
                <small class="text-muted">Kelola stok dan informasi obat-obatan</small>
            </div>
            <a href="<?php echo e(route('petugas.medicines.create')); ?>" class="btn btn-primary-custom">
                <i class="fas fa-plus me-1"></i> Tambah Obat Baru
            </a>
        </div>

        <!-- Search -->
        <form method="GET" action="<?php echo e(route('petugas.medicines.index')); ?>" class="search-card">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari nama atau kode obat..." value="<?php echo e(request('search')); ?>">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fas fa-search me-1"></i> Cari
                </button>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('search')): ?>
                    <a href="<?php echo e(route('petugas.medicines.index')); ?>" class="btn" style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;">
                        <i class="fas fa-undo me-1"></i> Reset
                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </form>

        <!-- Tabel Data -->
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-3">Kode</th>
                        <th>Nama Obat</th>
                        <th>Keterangan</th>
                        <th class="text-center">Stok</th>
                        <th>Satuan</th>
                        <th>Kedaluwarsa</th>
                        <th class="text-end pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $medicines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $med): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <tr>
                            <td class="ps-3 fw-semibold" style="color: #0f172a;"><?php echo e($med->code); ?></td>
                            <td>
                                <strong style="color: #0f172a;"><?php echo e($med->name); ?></strong>
                            </td>
                            <!-- Kolom Keterangan -->
                            <td>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($med->description)): ?>
                                    <span class="text-muted" title="<?php echo e($med->description); ?>">
                                        <i class="fas fa-info-circle me-1" style="color: #f59e0b;"></i>
                                        <?php echo e(\Illuminate\Support\Str::limit($med->description, 50)); ?>

                                    </span>
                                <?php else: ?>
                                    <span class="text-muted fst-italic">
                                        <i class="fas fa-minus me-1"></i> Belum diisi
                                    </span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php
                                    $isLowStock = $med->stock <= ($med->minimum_stock ?? 5);
                                ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isLowStock): ?>
                                    <span class="badge badge-stok-rendah">
                                        <i class="fas fa-exclamation-triangle me-1"></i> <?php echo e($med->stock); ?>

                                    </span>
                                <?php else: ?>
                                    <span class="badge badge-stok-normal">
                                        <?php echo e($med->stock); ?>

                                    </span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td>
                                <span class="badge" style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; font-weight: 500;">
                                    <?php echo e($med->unit); ?>

                                </span>
                            </td>
                            <td>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($med->expired_date): ?>
                                    <?php
                                        $isExpired = \Carbon\Carbon::parse($med->expired_date)->isPast();
                                        $isNearExpiry = \Carbon\Carbon::parse($med->expired_date)->diffInDays(now()) <= 30 && !$isExpired;
                                    ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isExpired): ?>
                                        <span class="badge" style="background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; font-weight: 500;">
                                            <i class="fas fa-times-circle me-1"></i> <?php echo e(\Carbon\Carbon::parse($med->expired_date)->format('d M Y')); ?>

                                        </span>
                                    <?php elseif($isNearExpiry): ?>
                                        <span class="badge" style="background: #fffbeb; color: #92400e; border: 1px solid #fde68a; font-weight: 500;">
                                            <i class="fas fa-clock me-1"></i> <?php echo e(\Carbon\Carbon::parse($med->expired_date)->format('d M Y')); ?>

                                        </span>
                                    <?php else: ?>
                                        <span style="color: #475569;">
                                            <?php echo e(\Carbon\Carbon::parse($med->expired_date)->format('d M Y')); ?>

                                        </span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td class="text-end pe-3">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="<?php echo e(route('petugas.medicines.edit', $med->id)); ?>" 
                                       class="btn btn-aksi-edit d-inline-flex align-items-center justify-content-center" 
                                       style="width: 36px; height: 36px; border-radius: 10px;" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="<?php echo e(route('petugas.medicines.destroy', $med->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus obat ini?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="submit" 
                                                class="btn btn-aksi-hapus d-inline-flex align-items-center justify-content-center" 
                                                style="width: 36px; height: 36px; border-radius: 10px;" 
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);">
                                    <i class="fas fa-box-open fa-2x" style="color: #ef4444;"></i>
                                </div>
                                <p class="mb-0 fw-semibold" style="color: #475569;">Belum ada data obat</p>
                                <small class="text-muted mb-3 d-block">Silakan tambah obat pertama untuk memulai.</small>
                                <a href="<?php echo e(route('petugas.medicines.create')); ?>" class="btn btn-primary-custom btn-sm mt-2">
                                    <i class="fas fa-plus me-1"></i> Tambah Obat Pertama
                                </a>
                            </td>
                        </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <?php echo e($medicines->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.petugas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sikes\resources\views/petugas/medicines/index.blade.php ENDPATH**/ ?>