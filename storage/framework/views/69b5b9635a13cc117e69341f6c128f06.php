

<?php $__env->startSection('title', 'Data Obat'); ?>
<?php $__env->startSection('page-title', 'Manajemen Data Obat'); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h5 class="fw-bold mb-1"><i class="fas fa-pills me-2 text-success"></i>Data Obat UKS</h5>
                <small class="text-muted">Kelola stok dan informasi obat-obatan</small>
            </div>
            <a href="<?php echo e(route('petugas.medicines.create')); ?>" class="btn btn-primary-custom">
                <i class="fas fa-plus me-1"></i> Tambah Obat Baru
            </a>
        </div>

        <!-- Search -->
        <form method="GET" action="<?php echo e(route('petugas.medicines.index')); ?>" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari nama atau kode obat..." value="<?php echo e(request('search')); ?>">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fas fa-search me-1"></i> Cari
                </button>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('search')): ?>
                    <a href="<?php echo e(route('petugas.medicines.index')); ?>" class="btn btn-outline-secondary">Reset</a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </form>

        <!-- Tabel Data -->
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-3">Kode</th>
                        <th>Nama Obat</th>
                        <th class="text-center">Stok</th>
                        <th>Satuan</th>
                        <th>Kedaluwarsa</th>
                        <th class="text-end pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $medicines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $med): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <tr>
                            <td class="ps-3 fw-semibold"><?php echo e($med->code); ?></td>
                            <td><?php echo e($med->name); ?></td>
                            <td class="text-center">
                                <span class="fw-bold <?php echo e($med->stock <= ($med->minimum_stock ?? 5) ? 'text-danger' : 'text-dark'); ?>">
                                    <?php echo e($med->stock); ?>

                                </span>
                            </td>
                            <td><?php echo e($med->unit); ?></td>
                            <td><?php echo e($med->expired_date ? \Carbon\Carbon::parse($med->expired_date)->format('d M Y') : '-'); ?></td>
                            <td class="text-end pe-3">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="<?php echo e(route('petugas.medicines.edit', $med->id)); ?>" 
                                       class="btn btn-outline-warning btn-sm d-inline-flex align-items-center justify-content-center" 
                                       style="width: 36px; height: 36px;" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="<?php echo e(route('petugas.medicines.destroy', $med->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus obat ini?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="submit" 
                                                class="btn btn-outline-danger btn-sm d-inline-flex align-items-center justify-content-center" 
                                                style="width: 36px; height: 36px;" 
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fas fa-box-open fa-3x mb-3 opacity-25"></i>
                                <p class="mb-0">Belum ada data obat</p>
                                <a href="<?php echo e(route('petugas.medicines.create')); ?>" class="btn btn-sm btn-outline-primary mt-2">Tambah Obat Pertama</a>
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