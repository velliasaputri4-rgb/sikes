

<?php $__env->startSection('title', 'Edit Kunjungan'); ?>
<?php $__env->startSection('page-title', 'Edit Data Kunjungan Siswa'); ?>

<?php $__env->startSection('content'); ?>
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0"><i class="fas fa-edit text-warning me-2"></i>Edit Data Kunjungan</h5>
        <a href="<?php echo e(route('petugas.examinations.index')); ?>" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>

    <form action="<?php echo e(route('petugas.examinations.update', $examination->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="row g-4">
            <!-- Kolom Kiri: Data Siswa & Petugas -->
            <div class="col-lg-5">
                <!-- Identitas Siswa -->
                <div class="p-3 bg-light rounded-3 mb-3">
                    <h6 class="fw-bold text-success mb-3"><i class="fas fa-user-graduate me-2"></i>Identitas Siswa</h6>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Pilih Siswa <span class="text-danger">*</span></label>
                        <select name="student_id" id="studentSelect" class="form-select <?php $__errorArgs = ['student_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="">-- Cari Nama atau NIS Siswa --</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <option value="<?php echo e($student->id); ?>" 
                                    data-nis="<?php echo e($student->nis); ?>" 
                                    data-name="<?php echo e($student->full_name); ?>"
                                    data-class="<?php echo e($student->class->name ?? '-'); ?>"
                                    <?php echo e(old('student_id', $examination->student_id) == $student->id ? 'selected' : ''); ?>>
                                    <?php echo e($student->nis); ?> - <?php echo e($student->full_name); ?> (<?php echo e($student->class->name ?? '-'); ?>)
                                </option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['student_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="mb-2">
                        <label class="form-label small text-muted">NIS</label>
                        <input type="text" id="studentNis" class="form-control bg-white fw-semibold" value="<?php echo e($examination->student->nis ?? '-'); ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small text-muted">Kelas</label>
                        <input type="text" id="studentClass" class="form-control bg-white fw-semibold" value="<?php echo e($examination->student->class->name ?? '-'); ?>" readonly>
                    </div>
                </div>

                <!-- Informasi Petugas Piket -->
                <div class="p-3 bg-light rounded-3 mb-3">
                    <h6 class="fw-bold text-primary mb-3"><i class="fas fa-user-nurse me-2"></i>Informasi Petugas Piket</h6>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kelompok Piket <span class="text-danger">*</span></label>
                        <select id="piketGroup" class="form-select" required>
                            <option value="">-- Pilih Kelompok --</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = array_keys($jadwalPiket ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <option value="<?php echo e($group); ?>"><?php echo e($group); ?></option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Petugas <span class="text-danger">*</span></label>
                        <select name="officer_name" id="officerName" class="form-select <?php $__errorArgs = ['officer_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required disabled>
                            <option value="">-- Pilih Kelompok Terlebih Dahulu --</option>
                        </select>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['officer_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="row g-2">
                        <div class="col-6">
                            <label class="form-label fw-semibold">Tanggal</label>
                            <input type="date" name="examination_date" class="form-control" value="<?php echo e(old('examination_date', \Carbon\Carbon::parse($examination->examination_date)->format('Y-m-d'))); ?>">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold">Jam</label>
                            <input type="time" name="arrival_time" class="form-control" value="<?php echo e(old('arrival_time', \Carbon\Carbon::parse($examination->arrival_time)->format('H:i'))); ?>">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Pemeriksaan -->
            <div class="col-lg-7">
                <div class="p-3 bg-light rounded-3 mb-3">
                    <h6 class="fw-bold text-danger mb-3"><i class="fas fa-notes-medical me-2"></i>Diagnosa</h6>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Keluhan Utama <span class="text-danger">*</span></label>
                        <textarea name="complaint" class="form-control <?php $__errorArgs = ['complaint'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="2" placeholder="Contoh: Demam, pusing, mual, sakit perut..." required><?php echo e(old('complaint', $examination->complaint)); ?></textarea>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['complaint'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Diagnosa <span class="text-danger">*</span></label>
                        <textarea name="diagnosis" class="form-control <?php $__errorArgs = ['diagnosis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" rows="2" required><?php echo e(old('diagnosis', $examination->diagnosis)); ?></textarea>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['diagnosis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Obat yang Diberikan</label>
                        <input type="text" name="medicine" class="form-control <?php $__errorArgs = ['medicine'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               list="medicineList" placeholder="Ketik nama obat atau pilih dari daftar..." value="<?php echo e(old('medicine', $examination->medicine)); ?>">
                        
                        <!-- Daftar saran dari database -->
                        <datalist id="medicineList">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($medicines)): ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $medicines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $med): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <!-- value: yang akan masuk ke form, label: teks petunjuk di sebelah kanan dropdown -->
                                    <option value="<?php echo e($med->name); ?>" label="Sisa Stok: <?php echo e($med->stock); ?> <?php echo e($med->unit); ?>">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </datalist>
                        
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Ketik nama obat untuk melihat saran & sisa stok, atau ketik manual untuk memasukkan dosis spesifik.
                        </small>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['medicine'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status Kepulangan <span class="text-danger">*</span></label>
                            <select name="status" class="form-select <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <option value="">Pilih Status</option>
                                <option value="pulang" <?php echo e(old('status', $examination->status) == 'pulang' ? 'selected' : ''); ?>>Pulang</option>
                                <option value="istirahat_uks" <?php echo e(old('status', $examination->status) == 'istirahat_uks' ? 'selected' : ''); ?>>Istirahat di UKS</option>
                                <option value="rawat_jalan" <?php echo e(old('status', $examination->status) == 'rawat_jalan' ? 'selected' : ''); ?>>Rawat Jalan (kasih obat kembali ke kelas)</option>
                                <option value="rujuk_puskesmas" <?php echo e(old('status', $examination->status) == 'rujuk_puskesmas' ? 'selected' : ''); ?>>Rujuk ke Puskesmas</option>
                                <option value="rujuk_rs" <?php echo e(old('status', $examination->status) == 'rujuk_rs' ? 'selected' : ''); ?>>Rujuk ke Rumah Sakit</option>
                                <option value="hubungi_ortu" <?php echo e(old('status', $examination->status) == 'hubungi_ortu' ? 'selected' : ''); ?>>Hubungi Orang Tua/Wali</option>
                            </select>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Catatan Tambahan</label>
                            <input type="text" name="notes" class="form-control" placeholder="Catatan untuk orang tua/wali (opsional)" value="<?php echo e(old('notes', $examination->notes)); ?>">
                        </div>
                    </div>
                </div>

                <!-- ✅ DOKUMENTASI DENGAN KAMERA REALTIME -->
                <div class="p-3 bg-light rounded-3">
                    <h6 class="fw-bold text-info mb-3"><i class="fas fa-camera me-2"></i>Dokumentasi</h6>
                    <div class="mb-2">
                        <label class="form-label fw-semibold">Foto Kondisi/Fisik</label>
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($examination->photo): ?>
                            <div class="mb-3">
                                <small class="text-muted d-block mb-2">Foto saat ini:</small>
                                <img src="<?php echo e(asset('storage/' . $examination->photo)); ?>" alt="Foto Lama" class="img-thumbnail" style="max-height: 200px;">
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        
                        <div class="d-flex gap-2 mb-2">
                            <button type="button" class="btn btn-primary flex-fill" onclick="openCamera()">
                                <i class="fas fa-video me-1"></i> Buka Kamera
                            </button>
                            <label class="btn btn-outline-secondary flex-fill mb-0">
                                <i class="fas fa-image me-1"></i> Pilih dari File
                                <input type="file" id="photoInput" name="photo" accept="image/*" class="d-none" 
                                       onchange="processPhotoWithWatermark(this)">
                            </label>
                        </div>
                        <small class="text-muted">
                            <i class="fas fa-magic me-1"></i>Foto otomatis diberi watermark tanggal & jam.
                            Kosongkan jika tidak ingin mengganti foto.
                        </small>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback d-block"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <div class="mt-3">
                            <img id="imagePreview" src="#" alt="Preview" style="display: none; max-width: 280px; border-radius: 8px;" class="img-thumbnail border">
                            <div id="watermarkInfo" class="d-none mt-2">
                                <span class="badge bg-success px-3 py-2">
                                    <i class="fas fa-check-circle me-1"></i> Watermark tanggal & jam berhasil ditambahkan
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="col-12 text-end mt-4 pt-3 border-top">
                <a href="<?php echo e(route('petugas.examinations.index')); ?>" class="btn btn-outline-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-warning px-4 text-white">
                    <i class="fas fa-save me-2"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>


<div class="modal fade" id="cameraModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold"><i class="fas fa-camera me-2 text-primary"></i>Kamera Realtime</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-2">
                <video id="cameraVideo" autoplay playsinline class="w-100 rounded" style="background:#000; min-height:250px; object-fit:cover;"></video>
            </div>
            <div class="modal-footer justify-content-center border-0 pt-0">
                <button type="button" class="btn btn-success px-4" onclick="capturePhoto()">
                    <i class="fas fa-camera me-2"></i>Ambil Foto
                </button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // 1. Data Jadwal Piket dari Controller
    const jadwalPiket = <?php echo json_encode($jadwalPiket ?? [], 15, 512) ?>;
    const currentOfficerName = "<?php echo e(old('officer_name', $examination->officer_name)); ?>";

    // Fungsi pintar untuk mencari kelompok berdasarkan nama petugas yang sudah tersimpan
    function findGroupByOfficerName(name) {
        if (!name) return '';
        for (const [group, members] of Object.entries(jadwalPiket)) {
            if (members.includes(name)) {
                return group;
            }
        }
        return '';
    }

    // Fungsi untuk mengisi dropdown nama berdasarkan kelompok
    function populateOfficerNames(selectedGroup, selectedOfficer = null) {
        const officerSelect = document.getElementById('officerName');
        officerSelect.innerHTML = '<option value="">-- Pilih Nama Petugas --</option>';

        if (selectedGroup && jadwalPiket[selectedGroup]) {
            officerSelect.disabled = false;
            jadwalPiket[selectedGroup].forEach(name => {
                const option = document.createElement('option');
                option.value = name;
                option.textContent = name;
                
                if (selectedOfficer && name === selectedOfficer) {
                    option.selected = true;
                }
                
                officerSelect.appendChild(option);
            });
        } else {
            officerSelect.disabled = true;
            officerSelect.innerHTML = '<option value="">-- Pilih Kelompok Terlebih Dahulu --</option>';
        }
    }

    // Event listener saat kelompok diubah manual
    document.getElementById('piketGroup').addEventListener('change', function() {
        populateOfficerNames(this.value);
    });

    // Jalankan saat halaman dimuat untuk auto-fill semua data
    document.addEventListener('DOMContentLoaded', function() {
        // A. Auto-fill data siswa
        const studentSelect = document.getElementById('studentSelect');
        if (studentSelect.value) {
            const selectedOption = studentSelect.options[studentSelect.selectedIndex];
            document.getElementById('studentNis').value = selectedOption.dataset.nis || '';
            document.getElementById('studentClass').value = selectedOption.dataset.class || '';
        }

        // B. Auto-select kelompok dan nama petugas berdasarkan data lama
        const initialGroup = findGroupByOfficerName(currentOfficerName) || "<?php echo e(old('piket_group')); ?>";
        if (initialGroup) {
            document.getElementById('piketGroup').value = initialGroup;
            populateOfficerNames(initialGroup, currentOfficerName);
        }
    });

    // 2. Auto-fill data siswa saat dropdown siswa diubah
    document.getElementById('studentSelect').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        document.getElementById('studentNis').value = selectedOption.dataset.nis || '';
        document.getElementById('studentClass').value = selectedOption.dataset.class || '';
    });

    // 3. ✅ WATERMARK (dipakai oleh kamera & upload file)
    function drawWatermark(ctx, canvas) {
        const now = new Date();
        const dateStr = now.toLocaleDateString('id-ID', {
            weekday: 'long', day: 'numeric', month: 'long', year: 'numeric'
        });
        const timeStr = now.toLocaleTimeString('id-ID', {
            hour: '2-digit', minute: '2-digit'
        }).replace('.', ':') + ' WIB';

        const fontSize = Math.max(canvas.width * 0.03, 22);
        const padding = fontSize * 0.8;
        const barHeight = fontSize * 3.4;

        // Bar hitam transparan
        ctx.fillStyle = 'rgba(0, 0, 0, 0.55)';
        ctx.fillRect(0, canvas.height - barHeight, canvas.width, barHeight);

        // Baris 1: nama sekolah
        ctx.fillStyle = '#ffffff';
        ctx.font = 'bold ' + fontSize + 'px Arial';
        ctx.textBaseline = 'middle';
        ctx.fillText('UKS SMK NEGERI 1 BANGSRI', padding, canvas.height - barHeight + fontSize);

        // Baris 2: tanggal & jam realtime
        ctx.font = (fontSize * 0.85) + 'px Arial';
        ctx.fillText(dateStr + '  |  ' + timeStr, padding, canvas.height - barHeight + fontSize * 2.3);
    }

    // Terapkan foto ber-watermark ke input form + preview
    function applyWatermarkedPhoto(blob) {
        const newFile = new File([blob], 'foto-kunjungan.jpg', { type: 'image/jpeg' });
        const dt = new DataTransfer();
        dt.items.add(newFile);
        document.getElementById('photoInput').files = dt.files;

        const preview = document.getElementById('imagePreview');
        preview.src = URL.createObjectURL(blob);
        preview.style.display = 'block';
        document.getElementById('watermarkInfo').classList.remove('d-none');
    }

    // 4. ✅ KAMERA REALTIME (Desktop & HP)
    let cameraStream = null;
    let cameraModal = null;

    async function openCamera() {
        if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
            alert('Browser tidak mendukung akses kamera. Gunakan "Pilih dari File".');
            return;
        }

        cameraModal = new bootstrap.Modal(document.getElementById('cameraModal'));
        cameraModal.show();

        try {
            cameraStream = await navigator.mediaDevices.getUserMedia({
                video: { facingMode: 'environment' },
                audio: false
            });
            document.getElementById('cameraVideo').srcObject = cameraStream;
        } catch (err) {
            alert('Gagal mengakses kamera: ' + err.message + '\nGunakan "Pilih dari File" sebagai alternatif.');
            cameraModal.hide();
        }
    }

    function stopCamera() {
        if (cameraStream) {
            cameraStream.getTracks().forEach(t => t.stop());
            cameraStream = null;
        }
    }

    // Matikan kamera otomatis saat modal ditutup
    document.addEventListener('DOMContentLoaded', function () {
        const modalEl = document.getElementById('cameraModal');
        if (modalEl) modalEl.addEventListener('hidden.bs.modal', stopCamera);
    });

    // Ambil foto dari video → tambah watermark → masuk ke form
    function capturePhoto() {
        const video = document.getElementById('cameraVideo');
        if (!video.videoWidth) {
            alert('Kamera belum siap, tunggu sebentar lagi.');
            return;
        }

        const canvas = document.createElement('canvas');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        const ctx = canvas.getContext('2d');
        ctx.drawImage(video, 0, 0);

        drawWatermark(ctx, canvas);

        canvas.toBlob(function (blob) {
            applyWatermarkedPhoto(blob);
            stopCamera();
            cameraModal.hide();
        }, 'image/jpeg', 0.9);
    }

    // 5. Upload dari file/galeri → tambah watermark
    function processPhotoWithWatermark(input) {
        const file = input.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function (e) {
            const img = new Image();
            img.onload = function () {
                const canvas = document.createElement('canvas');
                canvas.width = img.width;
                canvas.height = img.height;
                const ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0);

                drawWatermark(ctx, canvas);

                canvas.toBlob(function (blob) {
                    applyWatermarkedPhoto(blob);
                }, 'image/jpeg', 0.9);
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.petugas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sikes\resources\views/petugas/examinations/edit.blade.php ENDPATH**/ ?>