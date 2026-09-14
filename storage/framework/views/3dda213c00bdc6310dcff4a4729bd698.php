

<?php $__env->startSection('title', 'Rekapan Data Kunjungan'); ?>
<?php $__env->startSection('page-title', 'Rekapan & Statistik Kunjungan UKS'); ?>

<?php $__env->startSection('content'); ?>
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">
            <i class="fas fa-chart-bar text-primary me-2"></i>
            Rekapan Data Kunjungan
        </h5>
    </div>

    
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="<?php echo e(route('petugas.examinations.recap')); ?>" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Tahun</label>
                    <select name="year" class="form-select" required>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <option value="<?php echo e($y); ?>" <?php echo e($year == $y ? 'selected' : ''); ?>>
                                <?php echo e($y); ?>

                            </option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Bulan (Opsional)</label>
                    <select name="month" class="form-select">
                        <option value="">Semua Bulan</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php for($m = 1; $m <= 12; $m++): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <option value="<?php echo e($m); ?>" <?php echo e($month == $m ? 'selected' : ''); ?>>
                                <?php echo e(\Carbon\Carbon::createFromDate($year, $m, 1)->format('F')); ?>

                            </option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">&nbsp;</label>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-filter me-1"></i> Tampilkan
                    </button>
                </div>
            </form>
        </div>
    </div>

    
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Total Kunjungan</h6>
                            <h2 class="mb-0"><?php echo e($totalVisits); ?></h2>
                            <small>
                                Kunjungan di <?php echo e($year); ?>

                                <?php echo e($month ? ' - ' . \Carbon\Carbon::createFromDate($year, $month, 1)->format('F') : ''); ?>

                            </small>
                        </div>
                        <i class="fas fa-clipboard-list fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Jenis Penyakit</h6>
                            <h2 class="mb-0"><?php echo e($topDiagnoses->count()); ?></h2>
                            <small>Diagnosa berbeda</small>
                        </div>
                        <i class="fas fa-stethoscope fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-info text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Jenis Obat</h6>
                            <h2 class="mb-0"><?php echo e($topMedicines->count()); ?></h2>
                            <small>Obat yang diberikan</small>
                        </div>
                        <i class="fas fa-pills fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-warning text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-1">Siswa Terdaftar</h6>
                            <h2 class="mb-0"><?php echo e($topSickStudents->count()); ?></h2>
                            <small>Siswa yang berkunjung</small>
                        </div>
                        <i class="fas fa-users fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="card mb-4">
        <div class="card-header bg-white">
            <h6 class="mb-0 fw-bold">
                <i class="fas fa-chart-line me-2 text-primary"></i>
                Grafik Kunjungan per Bulan (<?php echo e($year); ?>)
            </h6>
        </div>
        <div class="card-body">
            <canvas id="monthlyChart" height="80"></canvas>
        </div>
    </div>

    <div class="row g-4">
        
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold">
                        <i class="fas fa-procedures me-2 text-danger"></i>
                        5 Penyakit Paling Sering
                    </h6>
                </div>
                <div class="card-body">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($topDiagnoses->count() > 0): ?>
                        <canvas id="diagnosisChart"></canvas>
                        <div class="mt-3">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $topDiagnoses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $diag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <div class="d-flex justify-content-between align-items-center mb-2 p-2 bg-light rounded">
                                    <span class="fw-semibold">
                                        <span class="badge bg-danger me-2"><?php echo e($index + 1); ?></span>
                                        <?php echo e(Str::limit($diag->diagnosis, 40)); ?>

                                    </span>
                                    <span class="badge bg-primary"><?php echo e($diag->count); ?> kali</span>
                                </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-muted text-center py-4">Belum ada data diagnosa</p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold">
                        <i class="fas fa-capsules me-2 text-success"></i>
                        5 Obat Paling Sering Diberikan
                    </h6>
                </div>
                <div class="card-body">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($topMedicines->count() > 0): ?>
                        <canvas id="medicineChart"></canvas>
                        <div class="mt-3">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $topMedicines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $med): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <div class="d-flex justify-content-between align-items-center mb-2 p-2 bg-light rounded">
                                    <span class="fw-semibold">
                                        <span class="badge bg-success me-2"><?php echo e($index + 1); ?></span>
                                        <?php echo e(Str::limit($med->medicine, 40)); ?>

                                    </span>
                                    <span class="badge bg-primary"><?php echo e($med->count); ?> kali</span>
                                </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-muted text-center py-4">Belum ada data obat</p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold">
                        <i class="fas fa-user-injured me-2 text-warning"></i>
                        5 Siswa Paling Sering Berkunjung
                    </h6>
                </div>
                <div class="card-body">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($topSickStudents->count() > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Kelas</th>
                                        <th class="text-center">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $topSickStudents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $studentStat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <?php
                                            $student = $studentStat->student;
                                        ?>
                                        <tr>
                                            <td><?php echo e($index + 1); ?></td>
                                            <td><?php echo e($student->full_name ?? 'N/A'); ?></td>
                                            <td><?php echo e($student->class->name ?? '-'); ?></td>
                                            <td class="text-center">
                                                <span class="badge bg-warning text-dark"><?php echo e($studentStat->count); ?></span>
                                            </td>
                                        </tr>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted text-center py-4">Belum ada data siswa</p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold">
                        <i class="fas fa-door-open me-2 text-info"></i>
                        Status Kepulangan Siswa
                    </h6>
                </div>
                <div class="card-body">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($statusStats->count() > 0): ?>
                        <canvas id="statusChart"></canvas>
                        <div class="mt-3">
                            <?php
                                $statusLabels = [
                                    'pulang' => 'Pulang',
                                    'istirahat_uks' => 'Istirahat di UKS',
                                    'rawat_jalan' => 'Rawat Jalan',
                                    'rujuk_puskesmas' => 'Rujuk Puskesmas',
                                    'rujuk_rs' => 'Rujuk RS',
                                    'hubungi_ortu' => 'Hubungi Orang Tua'
                                ];
                            ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $statusStats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <div class="d-flex justify-content-between align-items-center mb-2 p-2 bg-light rounded">
                                    <span class="fw-semibold"><?php echo e($statusLabels[$stat->status] ?? $stat->status); ?></span>
                                    <span class="badge bg-info"><?php echo e($stat->count); ?> siswa</span>
                                </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-muted text-center py-4">Belum ada data status</p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Warna untuk chart
    const colors = {
        primary: '#3b82f6',
        success: '#10b981',
        danger: '#ef4444',
        warning: '#f59e0b',
        info: '#06b6d4',
        purple: '#8b5cf6'
    };

    // 1. Grafik Kunjungan per Bulan
    <?php if(count($monthlyStats) > 0): ?>
    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode(array_column($monthlyStats, 'month')); ?>,
            datasets: [{
                label: 'Jumlah Kunjungan',
                data: <?php echo json_encode(array_column($monthlyStats, 'count')); ?>,
                borderColor: colors.primary,
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });
    <?php endif; ?>

    // 2. Grafik Top Diagnosa (Doughnut)
    <?php if($topDiagnoses->count() > 0): ?>
    const diagnosisCtx = document.getElementById('diagnosisChart').getContext('2d');
    new Chart(diagnosisCtx, {
        type: 'doughnut',
        data: {
            labels: <?php echo json_encode($topDiagnoses->pluck('diagnosis')->map(fn($d) => Str::limit($d, 20))); ?>,
            datasets: [{
                data: <?php echo json_encode($topDiagnoses->pluck('count')); ?>,
                backgroundColor: [colors.danger, colors.primary, colors.warning, colors.success, colors.info]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
    <?php endif; ?>

    // 3. Grafik Top Obat (Bar)
    <?php if($topMedicines->count() > 0): ?>
    const medicineCtx = document.getElementById('medicineChart').getContext('2d');
    new Chart(medicineCtx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($topMedicines->pluck('medicine')->map(fn($m) => Str::limit($m, 20))); ?>,
            datasets: [{
                label: 'Jumlah Pemberian',
                data: <?php echo json_encode($topMedicines->pluck('count')); ?>,
                backgroundColor: colors.success
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });
    <?php endif; ?>

    // 4. Grafik Status Kepulangan (Pie)
    <?php if($statusStats->count() > 0): ?>
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($statusStats->pluck('status')->map(fn($s) => [
                'pulang' => 'Pulang',
                'istirahat_uks' => 'Istirahat UKS',
                'rawat_jalan' => 'Rawat Jalan',
                'rujuk_puskesmas' => 'Rujuk Puskesmas',
                'rujuk_rs' => 'Rujuk RS',
                'hubungi_ortu' => 'Hubungi Ortu'
            ][$s] ?? $s)); ?>,
            datasets: [{
                data: <?php echo json_encode($statusStats->pluck('count')); ?>,
                backgroundColor: [colors.primary, colors.warning, colors.success, colors.danger, colors.info, colors.purple]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
    <?php endif; ?>
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.petugas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sikes\resources\views/petugas/examinations/recap.blade.php ENDPATH**/ ?>