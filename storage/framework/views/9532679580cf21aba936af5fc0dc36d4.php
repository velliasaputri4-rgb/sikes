

<?php $__env->startSection('title', 'Kelola User'); ?>
<?php $__env->startSection('page-title', 'Manajemen User'); ?>

<?php $__env->startSection('content'); ?>
<style>
    /* Custom Alerts */
    .alert-success-custom {
        background: #ecfdf5;
        color: #065f46;
        border: 1px solid #a7f3d0;
        border-left: 4px solid #10b981;
        border-radius: 10px;
        padding: 14px 18px;
    }
    .alert-danger-custom {
        background: #fef2f2;
        color: #991b1b;
        border: 1px solid #fecaca;
        border-left: 4px solid #ef4444;
        border-radius: 10px;
        padding: 14px 18px;
    }

    /* Tombol Aksi */
    .btn-aksi-edit {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white; border: none; box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
        transition: all 0.2s;
    }
    .btn-aksi-edit:hover { 
        transform: translateY(-2px); 
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4); 
        color: white; 
    }

    .btn-aksi-hapus {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white; border: none; box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
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
            <h5 class="fw-bold mb-0">
                <i class="fas fa-users-cog me-2" style="color: #ef4444;"></i>Daftar User
            </h5>
            <small class="text-muted">Kelola akun login untuk staf UKS. Data siswa dikelola di menu "Data Siswa".</small>
        </div>
        <?php $isMainAdmin = auth()->user()->email === 'admin@sikes.com' || auth()->user()->hasRole('super-admin'); ?>
        
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isMainAdmin): ?>
            <a href="<?php echo e(route('petugas.users.create')); ?>" class="btn btn-primary-custom">
                <i class="fas fa-plus me-1"></i> Tambah Akun Baru
            </a>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="alert-success-custom alert-dismissible fade show border-0 shadow-sm mb-3">
            <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
        <div class="alert-danger-custom alert-dismissible fade show border-0 shadow-sm mb-3">
            <i class="fas fa-exclamation-circle me-2"></i><?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th class="ps-3">Nama Lengkap</th>
                    <th>Email Login</th>
                    <th>Role / Peran</th>
                    <th class="text-end pe-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <tr>
                        <td class="ps-3 fw-semibold" style="color: #0f172a;"><?php echo e($user->name); ?></td>
                        <td style="color: #475569;"><?php echo e($user->email); ?></td>
                        <td>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <?php
                                    $badgeStyle = 'background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;';
                                    if ($role->name === 'super-admin') $badgeStyle = 'background: #fef2f2; color: #991b1b; border: 1px solid #fecaca;';
                                    elseif ($role->name === 'admin') $badgeStyle = 'background: #fffbeb; color: #92400e; border: 1px solid #fde68a;';
                                    elseif ($role->name === 'petugas') $badgeStyle = 'background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;';
                                ?>
                                <span class="badge" style="<?php echo e($badgeStyle); ?> font-weight: 500; padding: 6px 10px;">
                                    <?php echo e(ucfirst(str_replace('-', ' ', $role->name))); ?>

                                </span>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->roles->isEmpty() && isset($user->role)): ?>
                                <?php
                                    $badgeStyle = 'background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;';
                                    if ($user->role === 'super-admin') $badgeStyle = 'background: #fef2f2; color: #991b1b; border: 1px solid #fecaca;';
                                    elseif ($user->role === 'admin') $badgeStyle = 'background: #fffbeb; color: #92400e; border: 1px solid #fde68a;';
                                    elseif ($user->role === 'petugas') $badgeStyle = 'background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;';
                                ?>
                                <span class="badge" style="<?php echo e($badgeStyle); ?> font-weight: 500; padding: 6px 10px;">
                                    <?php echo e(ucfirst(str_replace('-', ' ', $user->role))); ?>

                                </span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </td>
                        <td class="text-end pe-3">
                            <?php
                                $currentUser = auth()->user();
                                $isMainAdmin = strtolower(trim($currentUser->email)) === 'admin@sikes.com' || $currentUser->hasRole('super-admin');
                                $isSelf = $user->id === $currentUser->id;
                            ?>

                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isMainAdmin || $isSelf): ?>
                                <a href="<?php echo e(route('petugas.users.edit', $user->id)); ?>" class="btn btn-sm btn-aksi-edit me-1" style="width: 34px; height: 34px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isMainAdmin && !$isSelf): ?>
                                <form action="<?php echo e(route('petugas.users.destroy', $user->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user <?php echo e($user->name); ?>? Tindakan ini tidak dapat dibatalkan.')">
                                    <?php echo csrf_field(); ?> 
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-aksi-hapus" style="width: 34px; height: 34px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            <?php elseif($isSelf): ?>
                                
                                <span class="badge" style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; font-weight: 500; padding: 6px 10px;" title="Anda tidak dapat menghapus akun Anda sendiri dari halaman ini">
                                    <i class="fas fa-lock me-1"></i> Akun Anda
                                </span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </td>
                    </tr>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <tr>
                        <td colspan="4" class="text-center py-5">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);">
                                <i class="fas fa-users-slash fa-2x" style="color: #ef4444;"></i>
                            </div>
                            <p class="mb-0 fw-semibold" style="color: #475569;">Belum ada data user</p>
                            <small class="text-muted">Silakan hubungi administrator jika diperlukan.</small>
                        </td>
                    </tr>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <div class="d-flex justify-content-end mt-3">
        <?php echo e($users->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.petugas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sikes\resources\views/petugas/users/index.blade.php ENDPATH**/ ?>