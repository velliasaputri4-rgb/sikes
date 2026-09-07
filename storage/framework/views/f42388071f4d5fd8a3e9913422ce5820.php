

<?php $__env->startSection('title', 'Dashboard Test'); ?>
<?php $__env->startSection('page-title', 'Dashboard Test'); ?>

<?php $__env->startSection('content'); ?>
<div class="content-card">
    <h3 class="fw-bold mb-3">✅ Dashboard Berhasil Dimuat!</h3>
    <p class="text-muted">Jika Anda melihat ini, berarti layout dan controller bekerja dengan baik.</p>
    
    <div class="row g-4 mt-3">
        <div class="col-md-3">
            <div class="p-3 bg-light rounded">
                <small class="text-muted d-block">Total Siswa</small>
                <h4 class="mb-0 text-success"><?php echo e($totalStudents ?? 0); ?></h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 bg-light rounded">
                <small class="text-muted d-block">Kunjungan Hari Ini</small>
                <h4 class="mb-0 text-primary"><?php echo e($examsToday ?? 0); ?></h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 bg-light rounded">
                <small class="text-muted d-block">Kunjungan Bulan Ini</small>
                <h4 class="mb-0 text-info"><?php echo e($examsMonth ?? 0); ?></h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 bg-light rounded">
                <small class="text-muted d-block">Stok Menipis</small>
                <h4 class="mb-0 text-warning"><?php echo e($lowStock ?? 0); ?></h4>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.petugas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sikes\resources\views/petugas/dashboard-simple.blade.php ENDPATH**/ ?>