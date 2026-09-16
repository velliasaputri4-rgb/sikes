<?php $__env->startSection('title', 'Dashboard Petugas'); ?>
<?php $__env->startSection('page-title', 'Dashboard Petugas UKS'); ?>

<?php $__env->startSection('content'); ?>
    
    <?php
        $todayExams = \App\Models\Examination::with(['student.class'])
            ->whereDate('examination_date', \Carbon\Carbon::today())
            ->latest('examination_date')
            ->paginate(5);
    ?>

    <!-- Statistik Cards -->
    <div class="row g-4 mb-4">
        <!-- Card 1: Kunjungan Hari Ini (MERAH - Tema Utama) -->
        <div class="col-md-4">
            <div class="stat-card" style="border-left-color: #ef4444;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p>Kunjungan Hari Ini</p>
                        <h3 style="color: #ef4444 !important;"><?php echo e($exams_today ?? 0); ?></h3>
                        <small class="text-muted">Siswa diperiksa</small>
                    </div>
                    <div class="stat-icon" style="background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(220, 38, 38, 0.1)); color: #ef4444;">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Kunjungan Bulan Ini (ROSE - Variasi Estetik) -->
        <div class="col-md-4">
            <div class="stat-card" style="border-left-color: #f43f5e;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p>Kunjungan Bulan Ini</p>
                        <h3 style="color: #f43f5e !important;"><?php echo e($exams_month ?? 0); ?></h3>
                        <small class="text-muted">Total kunjungan</small>
                    </div>
                    <div class="stat-icon" style="background: linear-gradient(135deg, rgba(244, 63, 94, 0.15), rgba(225, 29, 72, 0.1)); color: #f43f5e;">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 3: Total Siswa Aktif (AMBER - Variasi Estetik) -->
        <div class="col-md-4">
            <div class="stat-card" style="border-left-color: #f59e0b;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p>Total Siswa Aktif</p>
                        <?php
                            $totalSiswa = \App\Models\Student::count();
                        ?>
                        <h3 style="color: #d97706 !important;"><?php echo e($totalSiswa ?? 0); ?></h3>
                        <small class="text-muted">Terdata di sistem</small>
                    </div>
                    <div class="stat-icon" style="background: linear-gradient(135deg, rgba(245, 158, 11, 0.15), rgba(217, 119, 6, 0.1)); color: #d97706;">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="content-card mb-4">
        <h5 class="fw-bold mb-3"><i class="fas fa-bolt me-2" style="color: #ef4444;"></i>Aksi Cepat</h5>
        <div class="row g-3">
            <div class="col-md-4">
                <a href="<?php echo e(route('petugas.examinations.create')); ?>" class="text-decoration-none">
                    <div class="p-4 border rounded-3 text-center hover-shadow" style="transition: all 0.3s; border-color: #fecaca !important; background: linear-gradient(135deg, #fef2f2 0%, #ffffff 100%);">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; box-shadow: 0 6px 20px rgba(239, 68, 68, 0.3);">
                            <i class="fas fa-plus fa-lg"></i>
                        </div>
                        <h6 class="fw-bold mb-1" style="color: #0f172a;">Input Kunjungan Baru</h6>
                        <small class="text-muted">Catat pemeriksaan siswa</small>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="<?php echo e(route('petugas.examinations.index')); ?>" class="text-decoration-none">
                    <div class="p-4 border rounded-3 text-center" style="transition: all 0.3s; border-color: #fecaca !important; background: linear-gradient(135deg, #fef2f2 0%, #ffffff 100%);">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; background: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%); color: white; box-shadow: 0 6px 20px rgba(244, 63, 94, 0.3);">
                            <i class="fas fa-list fa-lg"></i>
                        </div>
                        <h6 class="fw-bold mb-1" style="color: #0f172a;">Lihat Data Kunjungan</h6>
                        <small class="text-muted">Riwayat pemeriksaan</small>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="<?php echo e(route('petugas.students.index')); ?>" class="text-decoration-none">
                    <div class="p-4 border rounded-3 text-center" style="transition: all 0.3s; border-color: #fde68a !important; background: linear-gradient(135deg, #fffbeb 0%, #ffffff 100%);">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; box-shadow: 0 6px 20px rgba(245, 158, 11, 0.3);">
                            <i class="fas fa-users fa-lg"></i>
                        </div>
                        <h6 class="fw-bold mb-1" style="color: #0f172a;">Data Siswa</h6>
                        <small class="text-muted">Kelola data siswa</small>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Kunjungan Hari Ini (TABEL DENGAN PAGINATION) -->
    <div class="row">
        <div class="col-12">
            <div class="content-card">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <h6 class="fw-bold mb-0"><i class="fas fa-clock me-2" style="color: #ef4444;"></i>Kunjungan Hari Ini</h6>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($todayExams->hasPages()): ?>
                        <span class="badge border" style="background: #fef2f2; color: #991b1b;">
                            Halaman <?php echo e($todayExams->currentPage()); ?> dari <?php echo e($todayExams->lastPage()); ?>

                        </span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($todayExams->count() > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 30%;">SISWA</th>
                                    <th style="width: 20%;">KELAS</th>
                                    <th style="width: 30%;">KELUHAN</th>
                                    <th style="width: 10%;">STATUS</th>
                                    <th style="width: 10%;" class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $todayExams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <tr>
                                        <td>
                                            <div class="fw-bold text-uppercase" style="font-size: 0.95rem; letter-spacing: 0.3px; color: #0f172a;">
                                                <?php echo e($exam->student->full_name ?? '-'); ?>

                                            </div>
                                            <small class="text-muted"><?php echo e($exam->student->nis ?? '-'); ?></small>
                                        </td>
                                        <td>
                                            <span class="badge border" style="background: #fef2f2; color: #991b1b; font-weight: 500; padding: 6px 12px;">
                                                <?php echo e($exam->student->class->name ?? '-'); ?>

                                            </span>
                                        </td>
                                        <td class="text-capitalize" style="color: #475569;"><?php echo e($exam->complaint ?? '-'); ?></td>
                                        <td>
                                            <?php
                                                $isSakit = in_array($exam->status, ['pulang', 'rawat_jalan', 'rujuk_puskesmas', 'rujuk_rs']);
                                            ?>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isSakit): ?>
                                                <span class="badge px-3 py-2" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white;">
                                                    Sakit
                                                </span>
                                            <?php else: ?>
                                                <span class="badge px-3 py-2" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white;">
                                                    Sehat
                                                </span>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo e(route('petugas.examinations.show', $exam->id)); ?>" 
                                               class="btn btn-sm" 
                                               style="background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid #fecaca;"
                                               title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- ✅ PAGINATION CONTROLS -->
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($todayExams->hasPages()): ?>
                        <div class="mt-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <small class="text-muted">
                                Menampilkan <?php echo e($todayExams->firstItem()); ?> - <?php echo e($todayExams->lastItem()); ?> dari <?php echo e($todayExams->total()); ?> kunjungan
                            </small>
                            <nav>
                                <ul class="pagination pagination-sm mb-0">
                                    
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($todayExams->onFirstPage()): ?>
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="fas fa-chevron-left"></i> Sebelumnya</span>
                                        </li>
                                    <?php else: ?>
                                        <li class="page-item">
                                            <a class="page-link" href="<?php echo e($todayExams->previousPageUrl()); ?>">
                                                <i class="fas fa-chevron-left"></i> Sebelumnya
                                            </a>
                                        </li>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $todayExams->getUrlRange(1, $todayExams->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($page == $todayExams->currentPage()): ?>
                                            <li class="page-item active">
                                                <span class="page-link"><?php echo e($page); ?></span>
                                            </li>
                                        <?php else: ?>
                                            <li class="page-item">
                                                <a class="page-link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                                            </li>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                                    
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($todayExams->hasMorePages()): ?>
                                        <li class="page-item">
                                            <a class="page-link" href="<?php echo e($todayExams->nextPageUrl()); ?>">
                                                Selanjutnya <i class="fas fa-chevron-right"></i>
                                            </a>
                                        </li>
                                    <?php else: ?>
                                        <li class="page-item disabled">
                                            <span class="page-link">Selanjutnya <i class="fas fa-chevron-right"></i></span>
                                        </li>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php else: ?>
                    <!-- Empty State -->
                    <div class="text-center py-5">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);">
                            <i class="fas fa-calendar-day fa-2x" style="color: #ef4444;"></i>
                        </div>
                        <h6 class="fw-semibold" style="color: #475569;">Belum ada kunjungan hari ini</h6>
                        <p class="text-muted small mb-3">Data akan muncul otomatis ketika ada siswa yang diperiksa.</p>
                        <a href="<?php echo e(route('petugas.examinations.create')); ?>" class="btn btn-sm" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; border: none;">
                            <i class="fas fa-plus me-1"></i> Input Kunjungan Pertama
                        </a>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.petugas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/zephyr/Downloads/sikes-main/resources/views/petugas/dashboard.blade.php ENDPATH**/ ?>