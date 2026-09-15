

<?php $__env->startSection('title', 'Data Peminjaman'); ?>
<?php $__env->startSection('page-title', 'Peminjaman Inventaris UKS'); ?>

<?php $__env->startSection('content'); ?>
    <style>
        :root { --navy-900: #0f172a; }
        .page-head { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
        .page-head h5 { font-weight: 800; color: var(--navy-900); margin-bottom: 2px; display: flex; align-items: center; gap: 10px; }
        .page-head h5 .head-icon { width: 38px; height: 38px; border-radius: 10px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: white; display: inline-flex; align-items: center; justify-content: center; font-size: 15px; box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3); }
        .filter-card { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 16px; margin-bottom: 20px; }
        .filter-card .form-control:focus { border-color: #93c5fd; box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12); }
        .table thead th { background: #f8fafc; color: #475569; font-weight: 700; font-size: 11px; text-transform: uppercase; letter-spacing: 0.8px; border-bottom: 2px solid #e2e8f0; }
        .table-hover tbody tr:hover { background-color: #eff6ff; }
        .st-borrowed { background: #fef3c7 !important; color: #92400e !important; border-color: #fcd34d !important; }
        .st-returned { background: #dcfce7 !important; color: #166534 !important; border-color: #86efac !important; }
        .st-overdue { background: #fee2e2 !important; color: #991b1b !important; border-color: #fca5a5 !important; }
        .st-lost { background: #e2e8f0 !important; color: #334155 !important; border-color: #94a3b8 !important; }
    </style>

    <div class="content-card">
        <div class="page-head">
            <div>
                <h5><span class="head-icon"><i class="fas fa-handshake"></i></span> Daftar Peminjaman</h5>
                <small class="text-muted">Kelola peminjaman dan pengembalian inventaris</small>
            </div>
            <a href="<?php echo e(route('petugas.borrowings.create')); ?>" class="btn btn-primary-custom">
                <i class="fas fa-plus me-1"></i> Pinjam Barang
            </a>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?> <div class="alert alert-success"><?php echo e(session('success')); ?></div> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?> <div class="alert alert-danger"><?php echo e(session('error')); ?></div> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

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
                        <th style="width: 130px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $borrowings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $borrow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <?php
                            $stu = $students[$borrow->student_id] ?? null;
                            $itm = $items[$borrow->item_id] ?? null;
                            $status = strtolower($borrow->status ?? 'borrowed');
                            $label = ['borrowed' => 'Dipinjam', 'returned' => 'Kembali', 'overdue' => 'Terlambat', 'lost' => 'Hilang'][$status] ?? ucfirst($status);
                        ?>
                        <tr>
                            <td class="text-muted"><?php echo e(($borrowings->currentPage() - 1) * $borrowings->perPage() + $loop->iteration); ?></td>
                            <td>
                                <div class="fw-semibold"><?php echo e($stu->full_name ?? '-'); ?></div>
                                <small class="text-muted"><?php echo e($stu->nis ?? ''); ?></small>
                            </td>
                            <td><?php echo e($itm->name ?? '-'); ?></td>
                            <td><?php echo e($borrow->borrow_date ? \Carbon\Carbon::parse($borrow->borrow_date)->format('d/m/Y') : '-'); ?></td>
                            <td><?php echo e($borrow->expected_return_date ? \Carbon\Carbon::parse($borrow->expected_return_date)->format('d/m/Y') : '-'); ?></td>
                            <td><span class="badge st-<?php echo e($status); ?>"><?php echo e($label); ?></span></td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-1">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(in_array($status, ['borrowed', 'overdue'])): ?>
                                        <form action="<?php echo e(route('petugas.borrowings.return', $borrow->id)); ?>" method="POST" onsubmit="return confirm('Konfirmasi barang sudah dikembalikan?')">
                                            <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                            <button type="submit" class="btn btn-sm btn-outline-success" title="Kembalikan">
                                                <i class="fas fa-undo"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <a href="<?php echo e(route('petugas.borrowings.edit', $borrow->id)); ?>" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="<?php echo e(route('petugas.borrowings.destroy', $borrow->id)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus data peminjaman ini?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-inbox fa-3x mb-3 opacity-25"></i>
                                <p class="mb-0">Belum ada data peminjaman</p>
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