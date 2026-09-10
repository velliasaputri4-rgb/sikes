

<?php $__env->startSection('title', 'Dashboard Petugas'); ?>
<?php $__env->startSection('page-title', 'Dashboard Petugas UKS'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Statistik Cards -->
    <div class="row g-4 mb-4">
        <!-- Card 1: Kunjungan Hari Ini -->
        <div class="col-md-4">
            <div class="stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p>Kunjungan Hari Ini</p>
                        <h3 class="text-success"><?php echo e($exams_today ?? 0); ?></h3>
                        <small class="text-muted">Siswa diperiksa</small>
                    </div>
                    <div class="stat-icon" style="background: #dcfce7; color: #16a34a;">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Kunjungan Bulan Ini -->
        <div class="col-md-4">
            <div class="stat-card" style="border-left-color: #3b82f6;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p>Kunjungan Bulan Ini</p>
                        <h3 class="text-primary"><?php echo e($exams_month ?? 0); ?></h3>
                        <small class="text-muted">Total kunjungan</small>
                    </div>
                    <div class="stat-icon" style="background: #dbeafe; color: #2563eb;">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- ✅ Card 3: DIGANTI dari Stok Obat menjadi Total Siswa Aktif -->
        <div class="col-md-4">
            <div class="stat-card" style="border-left-color: #8b5cf6;">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <p>Total Siswa Aktif</p>
                        <?php
                            $totalSiswa = \App\Models\Student::count();
                        ?>
                        <h3 style="color: #8b5cf6 !important;"><?php echo e($totalSiswa ?? 0); ?></h3>
                        <small class="text-muted">Terdata di sistem</small>
                    </div>
                    <div class="stat-icon" style="background: #ede9fe; color: #8b5cf6;">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="content-card mb-4">
        <h5 class="fw-bold mb-3"><i class="fas fa-bolt text-warning me-2"></i>Aksi Cepat</h5>
        <div class="row g-3">
            <div class="col-md-4">
                <a href="<?php echo e(route('petugas.examinations.create')); ?>" class="text-decoration-none">
                    <div class="p-4 border rounded-3 text-center hover-shadow" style="transition: all 0.2s; border-color: #10b981 !important;">
                        <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-plus fa-lg"></i>
                        </div>
                        <h6 class="fw-bold mb-1">Input Kunjungan Baru</h6>
                        <small class="text-muted">Catat pemeriksaan siswa</small>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="<?php echo e(route('petugas.examinations.index')); ?>" class="text-decoration-none">
                    <div class="p-4 border rounded-3 text-center" style="transition: all 0.2s;">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-list fa-lg"></i>
                        </div>
                        <h6 class="fw-bold mb-1">Lihat Data Kunjungan</h6>
                        <small class="text-muted">Riwayat pemeriksaan</small>
                    </div>
                </a>
            </div>
            
            <!-- ✅ Quick Action 3: DIGANTI dari Kelola Stok Obat menjadi Data Siswa -->
            <div class="col-md-4">
                <a href="<?php echo e(route('petugas.students.index')); ?>" class="text-decoration-none">
                    <div class="p-4 border rounded-3 text-center" style="transition: all 0.2s;">
                        <div class="bg-info bg-opacity-10 text-info rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fas fa-users fa-lg"></i>
                        </div>
                        <h6 class="fw-bold mb-1">Data Siswa</h6>
                        <small class="text-muted">Kelola data siswa</small>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Kunjungan Hari Ini (TABEL) -->
    <div class="row">
        <div class="col-12">
            <div class="content-card">
                <h6 class="fw-bold mb-3"><i class="fas fa-clock text-primary me-2"></i>Kunjungan Hari Ini</h6>

                <?php
                    $todayExams = \App\Models\Examination::with(['student.class'])
                        ->whereDate('examination_date', \Carbon\Carbon::today())
                        ->latest('examination_date')
                        ->get();
                ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($todayExams->count() > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
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
                                            <div class="fw-bold text-uppercase" style="font-size: 0.95rem; letter-spacing: 0.3px;">
                                                <?php echo e($exam->student->full_name ?? '-'); ?>

                                            </div>
                                            <small class="text-muted"><?php echo e($exam->student->nis ?? '-'); ?></small>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border" style="font-weight: 500; padding: 6px 12px;">
                                                <?php echo e($exam->student->class->name ?? '-'); ?>

                                            </span>
                                        </td>
                                        <td class="text-capitalize"><?php echo e($exam->complaint ?? '-'); ?></td>
                                        <td>
                                            <?php
                                                $isSakit = in_array($exam->status, ['pulang', 'rawat_jalan', 'rujuk_puskesmas', 'rujuk_rs']);
                                            ?>
                                            <span class="badge <?php echo e($isSakit ? 'bg-danger' : 'bg-success'); ?> px-3 py-2">
                                                <?php echo e($isSakit ? 'Sakit' : 'Sehat'); ?>

                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo e(route('petugas.examinations.show', $exam->id)); ?>" 
                                               class="btn btn-sm btn-outline-primary" 
                                               title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <!-- Empty State -->
                    <div class="text-center py-5">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-calendar-day fa-2x text-muted"></i>
                        </div>
                        <h6 class="text-muted fw-semibold">Belum ada kunjungan hari ini</h6>
                        <p class="text-muted small mb-3">Data akan muncul otomatis ketika ada siswa yang diperiksa.</p>
                        <a href="<?php echo e(route('petugas.examinations.create')); ?>" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-plus me-1"></i> Input Kunjungan Pertama
                        </a>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.petugas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sikes\resources\views/petugas/dashboard.blade.php ENDPATH**/ ?>