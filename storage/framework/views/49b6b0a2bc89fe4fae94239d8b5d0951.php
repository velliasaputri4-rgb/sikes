

<?php $__env->startSection('title', 'Data Peminjaman'); ?>
<?php $__env->startSection('page-title', 'Peminjaman Inventaris UKS'); ?>

<?php $__env->startSection('content'); ?>
    <style>
        :root { 
            --ink: #0f172a;
            --primary: #ef4444;
            --primary-dark: #991b1b;
        }
        
        .page-head { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            flex-wrap: wrap; 
            gap: 12px; 
            margin-bottom: 20px; 
        }
        .page-head h5 { 
            font-weight: 800; 
            color: var(--ink); 
            margin-bottom: 2px; 
            display: flex; 
            align-items: center; 
            gap: 10px; 
        }
        /* ✅ PERUBAHAN: Gradient MERAH, bukan biru */
        .page-head h5 .head-icon { 
            width: 38px; 
            height: 38px; 
            border-radius: 10px; 
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); 
            color: white; 
            display: inline-flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 15px; 
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3); 
        }
        
        /* ✅ PERUBAHAN: Filter card dengan tema merah */
        .filter-card { 
            background: #ffffff; 
            border: 1px solid #fee2e2; 
            border-radius: 12px; 
            padding: 16px; 
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.04);
        }
        .filter-card .form-control:focus { 
            border-color: #fca5a5 !important; 
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.12) !important; 
        }
        .filter-card .form-control {
            border-color: #fecaca;
        }
        
        /* ✅ PERUBAHAN: Tabel dengan tema merah */
        .table thead th { 
            background: #fef2f2; 
            color: #991b1b; 
            font-weight: 700; 
            font-size: 11px; 
            text-transform: uppercase; 
            letter-spacing: 0.8px; 
            border-bottom: 2px solid #fecaca; 
        }
        .table-hover tbody tr:hover { 
            background-color: #fef2f2 !important; 
        }
        
        /* Badge Status - dipertahankan semantiknya, diperhalus */
        .st-borrowed { 
            background: #fffbeb !important; 
            color: #92400e !important; 
            border: 1px solid #fde68a !important; 
            font-weight: 500;
        }
        .st-returned { 
            background: #ecfdf5 !important; 
            color: #065f46 !important; 
            border: 1px solid #a7f3d0 !important; 
            font-weight: 500;
        }
        .st-overdue { 
            background: #fef2f2 !important; 
            color: #991b1b !important; 
            border: 1px solid #fecaca !important; 
            font-weight: 500;
        }
        .st-lost { 
            background: #f1f5f9 !important; 
            color: #475569 !important; 
            border: 1px solid #cbd5e1 !important; 
            font-weight: 500;
        }

        /* Tombol Aksi */
        .btn-aksi-return {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
            transition: all 0.2s;
        }
        .btn-aksi-return:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
            color: white;
        }

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

        /* Alert custom */
        .alert-success-custom {
            background: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
            border-left: 4px solid #10b981;
            border-radius: 10px;
            padding: 14px 18px;
            margin-bottom: 16px;
        }
        .alert-danger-custom {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
            border-left: 4px solid #ef4444;
            border-radius: 10px;
            padding: 14px 18px;
            margin-bottom: 16px;
        }
    </style>

    <div class="content-card">
        <div class="page-head">
            <div>
                <h5>
                    <span class="head-icon"><i class="fas fa-handshake"></i></span> 
                    Daftar Peminjaman
                </h5>
                <small class="text-muted">Kelola peminjaman dan pengembalian inventaris</small>
            </div>
            <a href="<?php echo e(route('petugas.borrowings.create')); ?>" class="btn btn-primary-custom">
                <i class="fas fa-plus me-1"></i> Pinjam Barang
            </a>
        </div>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?> 
            <div class="alert-success-custom">
                <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

            </div> 
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?> 
            <div class="alert-danger-custom">
                <i class="fas fa-exclamation-circle me-2"></i><?php echo e(session('error')); ?>

            </div> 
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <form method="GET" action="<?php echo e(route('petugas.borrowings.index')); ?>" class="filter-card">
            <input type="text" name="search" class="form-control" placeholder="Cari nama peminjam/barang... (tekan Enter)" value="<?php echo e(request('search')); ?>">
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
                        <th style="width: 140px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $borrowings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $borrow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <?php
                            $stu = $students[$borrow->student_id] ?? null;
                            $itm = $items[$borrow->item_id] ?? null;
                            $status = strtolower($borrow->status ?? 'borrowed');
                            $label = ['borrowed' => 'Dipinjam', 'returned' => 'Kembali', 'overdue' => 'Terlambat', 'lost' => 'Hilang'][$status] ?? ucfirst($status);
                        ?>
                        <tr>
                            <td class="text-muted"><?php echo e(($borrowings->currentPage() - 1) * $borrowings->perPage() + $loop->iteration); ?></td>
                            <td>
                                <div class="fw-semibold" style="color: #0f172a;"><?php echo e($stu->full_name ?? '-'); ?></div>
                                <small class="text-muted"><?php echo e($stu->nis ?? ''); ?></small>
                            </td>
                            <td class="fw-semibold" style="color: #0f172a;"><?php echo e($itm->name ?? '-'); ?></td>
                            <td>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($borrow->borrow_date): ?>
                                    <?php echo e(\Carbon\Carbon::parse($borrow->borrow_date)->format('d/m/Y')); ?>

                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($borrow->expected_return_date): ?>
                                    <?php
                                        $isOverdue = \Carbon\Carbon::parse($borrow->expected_return_date)->isPast() && $status !== 'returned';
                                    ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isOverdue): ?>
                                        <span class="badge st-overdue">
                                            <i class="fas fa-exclamation-circle me-1"></i>
                                            <?php echo e(\Carbon\Carbon::parse($borrow->expected_return_date)->format('d/m/Y')); ?>

                                        </span>
                                    <?php else: ?>
                                        <?php echo e(\Carbon\Carbon::parse($borrow->expected_return_date)->format('d/m/Y')); ?>

                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td>
                                <span class="badge st-<?php echo e($status); ?> px-3 py-2">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($status === 'borrowed'): ?>
                                        <i class="fas fa-clock me-1"></i>
                                    <?php elseif($status === 'returned'): ?>
                                        <i class="fas fa-check-circle me-1"></i>
                                    <?php elseif($status === 'overdue'): ?>
                                        <i class="fas fa-exclamation-triangle me-1"></i>
                                    <?php elseif($status === 'lost'): ?>
                                        <i class="fas fa-times-circle me-1"></i>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php echo e($label); ?>

                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-1">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(in_array($status, ['borrowed', 'overdue'])): ?>
                                        <form action="<?php echo e(route('petugas.borrowings.return', $borrow->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Konfirmasi barang sudah dikembalikan?')">
                                            <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                            <button type="submit" class="btn btn-sm btn-aksi-return" style="width: 34px; height: 34px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;" title="Kembalikan">
                                                <i class="fas fa-undo"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <a href="<?php echo e(route('petugas.borrowings.edit', $borrow->id)); ?>" class="btn btn-sm btn-aksi-edit" style="width: 34px; height: 34px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="<?php echo e(route('petugas.borrowings.destroy', $borrow->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data peminjaman ini?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-aksi-hapus" style="width: 34px; height: 34px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;" title="Hapus">
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
                                    <i class="fas fa-inbox fa-2x" style="color: #ef4444;"></i>
                                </div>
                                <p class="mb-0 fw-semibold" style="color: #475569;">Belum ada data peminjaman</p>
                                <small class="text-muted">Silakan tambah peminjaman baru.</small>
                            </td>
                        </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3"><?php echo e($borrowings->links()); ?></div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.petugas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sikes\resources\views/petugas/borrowings/index.blade.php ENDPATH**/ ?>