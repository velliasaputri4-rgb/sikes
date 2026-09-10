

<?php $__env->startSection('title', 'Edit Tips Kesehatan'); ?>
<?php $__env->startSection('page-title', 'Edit Tips Kesehatan'); ?>

<?php $__env->startSection('content'); ?>
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0 text-dark">
            <i class="fas fa-edit text-warning me-2"></i>Edit Informasi Tips Kesehatan
        </h5>
        <a href="<?php echo e(route('petugas.health-tips.index')); ?>" class="btn btn-sm btn-light border">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <form action="<?php echo e(route('petugas.health-tips.update', $healthTip->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-3">
            <label for="title" class="form-label fw-semibold text-dark">Judul Tips <span class="text-danger">*</span></label>
            <input type="text" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                   id="title" name="title" value="<?php echo e(old('title', $healthTip->title)); ?>" required>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label fw-semibold text-dark">Kategori <span class="text-danger">*</span></label>
            <select class="form-select <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="category" name="category" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="gizi" <?php echo e(old('category', $healthTip->category) == 'gizi' ? 'selected' : ''); ?>>Gizi & Makanan</option>
                <option value="kebersihan" <?php echo e(old('category', $healthTip->category) == 'kebersihan' ? 'selected' : ''); ?>>Kebersihan Diri & Lingkungan</option>
                <option value="penyakit" <?php echo e(old('category', $healthTip->category) == 'penyakit' ? 'selected' : ''); ?>>Pencegahan Penyakit</option>
                <option value="kesehatan_mental" <?php echo e(old('category', $healthTip->category) == 'kesehatan_mental' ? 'selected' : ''); ?>>Kesehatan Mental</option>
                <option value="p3k" <?php echo e(old('category', $healthTip->category) == 'p3k' ? 'selected' : ''); ?>>Pertolongan Pertama (P3K)</option>
                <option value="umum" <?php echo e(old('category', $healthTip->category) == 'umum' ? 'selected' : ''); ?>>Kesehatan Umum</option>
            </select>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="mb-4">
            <label for="content" class="form-label fw-semibold text-dark">Isi Lengkap Tips <span class="text-danger">*</span></label>
            <textarea class="form-control <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                      id="content" name="content" rows="8" required><?php echo e(old('content', $healthTip->content)); ?></textarea>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary-custom">
                <i class="fas fa-save me-1"></i> Simpan Perubahan
            </button>
            <a href="<?php echo e(route('petugas.health-tips.index')); ?>" class="btn btn-light border">
                <i class="fas fa-times me-1"></i> Batal
            </a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.petugas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sikes\resources\views/petugas/health-tips/edit.blade.php ENDPATH**/ ?>