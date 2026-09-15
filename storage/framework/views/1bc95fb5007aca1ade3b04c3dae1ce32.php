

<?php $__env->startSection('title', 'Data Siswa'); ?>
<?php $__env->startSection('page-title', 'Data Siswa'); ?>

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
        
        /* Badge Kelas - tema merah */
        .badge-kelas {
            background: #fef2f2 !important;
            color: #991b1b !important;
            border: 1px solid #fecaca !important;
            font-weight: 500;
            padding: 6px 10px;
        }

        /* Phone cell styling */
        .phone-cell { 
            font-family: 'SF Mono', 'Consolas', monospace; 
            font-size: 13px; 
            color: #334155; 
            letter-spacing: 0.3px; 
        }
        .phone-cell a {
            color: #991b1b;
            transition: all 0.2s;
        }
        .phone-cell a:hover {
            color: #ef4444;
            text-decoration: underline !important;
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
                    <span class="head-icon"><i class="fas fa-users"></i></span> 
                    Daftar Siswa
                </h5>
                <small class="text-muted">Data siswa yang terdaftar di sistem</small>
            </div>
            <a href="<?php echo e(route('petugas.students.create')); ?>" class="btn btn-primary-custom">
                <i class="fas fa-plus me-1"></i> Tambah Siswa
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

        <form method="GET" action="<?php echo e(route('petugas.students.index')); ?>" class="filter-card">
            <input type="text" name="search" class="form-control" placeholder="Cari nama/NIS siswa... (tekan Enter)" value="<?php echo e(request('search')); ?>">
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th style="width: 45px;">No</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Tanggal Lahir</th>
                        <th>No. HP Wali</th>
                        <th style="width: 120px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <tr>
                            <td class="text-muted"><?php echo e(($students->currentPage() - 1) * $students->perPage() + $loop->iteration); ?></td>
                            <td class="fw-semibold" style="color: #0f172a;"><?php echo e($student->nis); ?></td>
                            <td class="fw-semibold" style="color: #0f172a;"><?php echo e($student->full_name); ?></td>
                            <td>
                                <span class="badge badge-kelas">
                                    <?php echo e($student->class->name ?? '-'); ?>

                                </span>
                            </td>
                            <td>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($student->birth_date): ?> 
                                    <?php echo e(\Carbon\Carbon::parse($student->birth_date)->format('d/m/Y')); ?>

                                <?php else: ?> 
                                    <span class="text-muted">-</span> 
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td class="phone-cell">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($student->parent_phone): ?>
                                    <a href="tel:<?php echo e($student->parent_phone); ?>" class="text-decoration-none" title="Klik untuk menelepon">
                                        <i class="fas fa-phone me-1" style="font-size: 11px; color: #ef4444;"></i><?php echo e($student->parent_phone); ?>

                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="d-inline-flex gap-1">
                                    <a href="<?php echo e(route('petugas.students.edit', $student->id)); ?>" class="btn btn-sm btn-aksi-edit" style="width: 34px; height: 34px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;" title="Edit">
                                        <i class="fas fa-pen-to-square"></i>
                                    </a>
                                    <form action="<?php echo e(route('petugas.students.destroy', $student->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus <?php echo e($student->full_name); ?>?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-aksi-hapus" style="width: 34px; height: 34px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center;" title="Hapus">
                                            <i class="fas fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);">
                                    <i class="fas fa-folder-open fa-2x" style="color: #ef4444;"></i>
                                </div>
                                <p class="mb-0 fw-semibold" style="color: #475569;">Belum ada data siswa</p>
                                <small class="text-muted">Silakan tambah siswa baru.</small>
                            </td>
                        </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3"><?php echo e($students->links()); ?></div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.petugas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sikes\resources\views/petugas/students/index.blade.php ENDPATH**/ ?>