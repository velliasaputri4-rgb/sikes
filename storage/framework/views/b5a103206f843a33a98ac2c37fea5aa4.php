
<?php $__env->startSection('title', 'Tambah Siswa'); ?>
<?php $__env->startSection('page-title', 'Tambah Siswa'); ?>

<?php $__env->startSection('content'); ?>
    <style>
        :root { --navy-900: #0f172a; }
        .page-head { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 20px; }
        .page-head h5 { font-weight: 800; color: var(--navy-900); margin-bottom: 2px; display: flex; align-items: center; gap: 10px; }
        .page-head h5 .head-icon { width: 38px; height: 38px; border-radius: 10px; background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: white; display: inline-flex; align-items: center; justify-content: center; font-size: 15px; box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3); }
        .form-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 24px; max-width: 640px; }
        .form-control:focus, .form-select:focus { border-color: #93c5fd; box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12); }
    </style>

    <div class="content-card">
        <div class="page-head">
            <div>
                <h5><span class="head-icon"><i class="fas fa-user-plus"></i></span> Tambah Siswa Baru</h5>
                <small class="text-muted">Data akan langsung tersimpan ke database</small>
            </div>
            <a href="<?php echo e(route('petugas.students.index')); ?>" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <li><?php echo e($error); ?></li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </ul>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <form method="POST" action="<?php echo e(route('petugas.students.store')); ?>" class="form-card">
            <?php echo csrf_field(); ?>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">NIS <span class="text-danger">*</span></label>
                    <input type="text" name="nis" class="form-control" value="<?php echo e(old('nis')); ?>" required>
                </div>
                <div class="col-md-8 mb-3">
                    <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="full_name" class="form-control" value="<?php echo e(old('full_name')); ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Kelas <span class="text-danger">*</span></label>
                <input type="text" name="class_name" list="daftar-kelas" class="form-control" value="<?php echo e(old('class_name')); ?>" placeholder="Pilih atau ketik kelas baru..." required>
                <datalist id="daftar-kelas">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <option value="<?php echo e($class->name); ?>"></option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </datalist>
                <small class="text-muted">Pilih dari daftar atau ketik nama kelas baru (otomatis dibuat).</small>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                <input type="date" name="birth_date" class="form-control" value="<?php echo e(old('birth_date')); ?>" required>
            </div>

            <!-- Field No. HP Wali (Opsional) -->
            <div class="mb-4">
                <label class="form-label fw-semibold">No. HP Wali <small class="text-muted fw-normal">(Opsional)</small></label>
                <input type="tel" name="parent_phone" class="form-control" value="<?php echo e(old('parent_phone')); ?>" placeholder="08xxxxxxxxxx" inputmode="tel">
                <small class="text-muted">Nomor telepon orang tua/wali yang dapat dihubungi.</small>
            </div>

            <button type="submit" class="btn btn-primary-custom"><i class="fas fa-save me-1"></i> Simpan Siswa</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.petugas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sikes\resources\views/petugas/students/create.blade.php ENDPATH**/ ?>