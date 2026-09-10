

<?php $__env->startSection('title', 'Kelola Tips Kesehatan'); ?>
<?php $__env->startSection('page-title', 'Kelola Tips Kesehatan'); ?>

<?php $__env->startSection('content'); ?>
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0 text-dark">
            <i class="fas fa-lightbulb text-warning me-2"></i>Daftar Tips Kesehatan
        </h5>
        <a href="<?php echo e(route('petugas.health-tips.create')); ?>" class="btn btn-primary-custom btn-sm">
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
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $tips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $tip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <tr>
                    <td class="text-center"><?php echo e($tips->firstItem() + $index); ?></td>
                    <td class="fw-semibold text-dark"><?php echo e($tip->title); ?></td>
                    <td>
                        <span class="badge bg-info text-dark">
                            <?php echo e(ucfirst(str_replace('_', ' ', $tip->category))); ?>

                        </span>
                    </td>
                    <td class="text-muted small"><?php echo e(Str::limit(strip_tags($tip->content), 60)); ?></td>
                    <td class="text-center">
                        <a href="<?php echo e(route('petugas.health-tips.edit', $tip->id)); ?>" class="btn btn-sm btn-warning text-white me-1" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="<?php echo e(route('petugas.health-tips.destroy', $tip->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus tips ini?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                        Belum ada data tips kesehatan. Silakan tambah data baru.
                    </td>
                </tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tips->hasPages()): ?>
    <div class="mt-3 d-flex justify-content-end">
        <?php echo e($tips->links()); ?>

    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.petugas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sikes\resources\views/petugas/health-tips/index.blade.php ENDPATH**/ ?>