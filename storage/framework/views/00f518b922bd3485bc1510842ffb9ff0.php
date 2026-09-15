

<?php $__env->startSection('title', 'Tambah Tips Kesehatan'); ?>
<?php $__env->startSection('page-title', 'Tambah Tips Kesehatan'); ?>

<?php $__env->startSection('content'); ?>
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h5 class="fw-bold mb-0">
            <i class="fas fa-plus-circle me-2" style="color: #ef4444;"></i>Form Tambah Tips Kesehatan
        </h5>
        <a href="<?php echo e(route('petugas.health-tips.index')); ?>" class="btn btn-sm" style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <form action="<?php echo e(route('petugas.health-tips.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="mb-3">
            <label for="title" class="form-label fw-semibold">Judul Tips <span style="color: #ef4444;">*</span></label>
            <input type="text" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                   id="title" name="title" value="<?php echo e(old('title')); ?>" required 
                   placeholder="Contoh: Cara Mencegah Demam Berdarah"
                   style="border-color: #fecaca;">
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
            <label for="category" class="form-label fw-semibold">Kategori <span style="color: #ef4444;">*</span></label>
            <select class="form-select <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="category" name="category" required style="border-color: #fecaca;">
                <option value="">-- Pilih Kategori --</option>
                <option value="gizi" <?php echo e(old('category') == 'gizi' ? 'selected' : ''); ?>>Gizi & Makanan</option>
                <option value="kebersihan" <?php echo e(old('category') == 'kebersihan' ? 'selected' : ''); ?>>Kebersihan Diri & Lingkungan</option>
                <option value="penyakit" <?php echo e(old('category') == 'penyakit' ? 'selected' : ''); ?>>Pencegahan Penyakit</option>
                <option value="kesehatan_mental" <?php echo e(old('category') == 'kesehatan_mental' ? 'selected' : ''); ?>>Kesehatan Mental</option>
                <option value="p3k" <?php echo e(old('category') == 'p3k' ? 'selected' : ''); ?>>Pertolongan Pertama (P3K)</option>
                <option value="umum" <?php echo e(old('category') == 'umum' ? 'selected' : ''); ?>>Kesehatan Umum</option>
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
            <label for="content" class="form-label fw-semibold">Isi Lengkap Tips <span style="color: #ef4444;">*</span></label>
            <textarea class="form-control <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                      id="content" name="content" rows="8" required 
                      placeholder="Tuliskan penjelasan, langkah-langkah, atau edukasi lengkap di sini..."
                      style="border-color: #fecaca;"><?php echo e(old('content')); ?></textarea>
            <div class="form-text mt-1" style="color: #64748b;">
                <i class="fas fa-lightbulb me-1" style="color: #f59e0b;"></i>
                Tips: Gunakan enter untuk membuat paragraf baru agar mudah dibaca.
            </div>
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

        <div class="d-flex gap-2 pt-3" style="border-top: 1px solid #fee2e2;">
            <button type="submit" class="btn btn-primary-custom">
                <i class="fas fa-save me-1"></i> Simpan Tips
            </button>
            <button type="reset" class="btn" style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;">
                <i class="fas fa-undo me-1"></i> Reset Form
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.petugas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sikes\resources\views/petugas/health-tips/create.blade.php ENDPATH**/ ?>