

<?php $__env->startSection('title', 'Input Kunjungan'); ?>
<?php $__env->startSection('page-title', 'Input Kunjungan Siswa'); ?>

<?php $__env->startSection('content'); ?>
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0"><i class="fas fa-plus-circle text-success me-2"></i>Form Pemeriksaan Baru</h5>
        <a href="<?php echo e(route('petugas.examinations.index')); ?>" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>

    <form action="<?php echo e(route('petugas.examinations.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
            <div class="alert alert-danger mb-3">
                <strong><i class="fas fa-exclamation-triangle"></i> Gagal Menyimpan:</strong>
                <ul class="mb-0 mt-1">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <li><?php echo e($error); ?></li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </ul>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="row g-4">
            <!-- Kolom Kiri: Data Siswa & Petugas -->
            <div class="col-lg-5">
                <!-- Identitas Siswa -->
                <div class="p-3 bg-light rounded-3 mb-3">
                    <h6 class="fw-bold text-success mb-3"><i class="fas fa-user-graduate me-2"></i>Identitas Siswa</h6>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Ketik NIS <span class="text-danger">*</span></label>
                        <input type="text" name="nis" id="nisInput" class="form-control <?php $__errorArgs = ['nis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               value="<?php echo e(old('nis')); ?>" placeholder="Masukkan NIS siswa..." required autocomplete="off">
                        <div id="nisFeedback" class="form-text mt-1"></div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['nis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="mb-2">
                        <label class="form-label small text-muted">Nama Lengkap</label>
                        <input type="text" id="studentName" class="form-control bg-white fw-semibold" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small text-muted">Kelas</label>
                        <input type="text" id="studentClass" class="form-control bg-white fw-semibold" readonly>
                    </div>

                    <!-- Form Siswa Baru (Muncul jika NIS tidak ditemukan) -->
                    <div id="newStudentBox" class="d-none border border-danger rounded-3 p-3 bg-white mt-3">
                        <small class="fw-bold text-danger d-block mb-2"><i class="fas fa-exclamation-triangle me-1"></i>Siswa belum terdaftar. Lengkapi data di bawah untuk mendaftarkan siswa baru:</small>
                        
                        <div class="mb-2">
                            <label class="form-label small">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="full_name" class="form-control <?php $__errorArgs = ['full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Nama Lengkap" value="<?php echo e(old('full_name')); ?>">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="mb-2">
                            <label class="form-label small">Kelas <span class="text-danger">*</span></label>
                            <input type="text" name="class_name" class="form-control <?php $__errorArgs = ['class_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="cth: XII PPLG 2" value="<?php echo e(old('class_name')); ?>">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['class_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Informasi Petugas Piket -->
                <div class="p-3 bg-light rounded-3 mb-3">
                    <h6 class="fw-bold text-primary mb-3"><i class="fas fa-user-nurse me-2"></i>Informasi Petugas Piket</h6>
                    
                    <div class="row g-2">
                        <div class="col-6 mb-2">
                            <label class="form-label fw-semibold">Kelompok Piket <span class="text-danger">*</span></label>
                            <select id="piketGroup" name="piket_group" class="form-select" required>
                                <option value="">-- Pilih Kelompok --</option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = array_keys($jadwalPiket ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <option value="<?php echo e($group); ?>" <?php echo e(old('piket_group') == $group ? 'selected' : ''); ?>><?php echo e($group); ?></option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </select>
                        </div>
                        <div class="col-6 mb-2">
                            <label class="form-label fw-semibold">Nama Petugas <span class="text-danger">*</span></label>
                            <select name="officer_name" id="officerName" class="form-select <?php $__errorArgs = ['officer_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required disabled>
                                <option value="">-- Pilih Kelompok Dulu --</option>
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
                    </div>

                    <div class="row g-2">
                        <div class="col-6">
                            <label class="form-label fw-semibold">Tanggal</label>
                            <input type="date" name="examination_date" class="form-control" value="<?php echo e(old('examination_date', date('Y-m-d'))); ?>" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold">Jam</label>
                            <input type="time" name="arrival_time" class="form-control" value="<?php echo e(old('arrival_time', date('H:i'))); ?>" required>
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
unset($__errorArgs, $__bag); ?>" rows="2" placeholder="Contoh: Demam, pusing, mual, sakit perut..." required><?php echo e(old('complaint')); ?></textarea>
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
unset($__errorArgs, $__bag); ?>" rows="2" required><?php echo e(old('diagnosis')); ?></textarea>
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
                        <input type="text" name="medicine" class="form-control" placeholder="Contoh: Paracetamol 500mg (2 tablet), Vitamin C (1 tablet)" value="<?php echo e(old('medicine')); ?>">
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
                                <option value="pulang" <?php echo e(old('status') == 'pulang' ? 'selected' : ''); ?>>Pulang</option>
                                <option value="istirahat_uks" <?php echo e(old('status') == 'istirahat_uks' ? 'selected' : ''); ?>>Istirahat di UKS</option>
                                <option value="rawat_jalan" <?php echo e(old('status') == 'rawat_jalan' ? 'selected' : ''); ?>>Rawat Jalan (kasih obat kembali ke kelas)</option>
                                <option value="rujuk_puskesmas" <?php echo e(old('status') == 'rujuk_puskesmas' ? 'selected' : ''); ?>>Rujuk ke Puskesmas</option>
                                <option value="rujuk_rs" <?php echo e(old('status') == 'rujuk_rs' ? 'selected' : ''); ?>>Rujuk ke Rumah Sakit</option>
                                <option value="hubungi_ortu" <?php echo e(old('status') == 'hubungi_ortu' ? 'selected' : ''); ?>>Hubungi Orang Tua/Wali</option>
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
                            <input type="text" name="notes" class="form-control" placeholder="Catatan untuk orang tua/wali (opsional)" value="<?php echo e(old('notes')); ?>">
                        </div>
                    </div>
                </div>

                <!-- ✅ DOKUMENTASI DENGAN KAMERA REALTIME -->
                <div class="p-3 bg-light rounded-3">
                    <h6 class="fw-bold text-info mb-3"><i class="fas fa-camera me-2"></i>Dokumentasi</h6>
                    <div class="mb-2">
                        <label class="form-label fw-semibold">Foto Kondisi/Fisik</label>

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
                            "Buka Kamera" = foto realtime, "Pilih dari File" = upload dari galeri.
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
                <button type="submit" id="btnSubmit" class="btn btn-success px-4">
                    <i class="fas fa-save me-2"></i> Simpan Data Kunjungan
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
    const searchUrl = "<?php echo e(url('petugas/examinations/cari-siswa')); ?>";

    // 2. Auto-fill data siswa via AJAX saat ketik NIS
    const nisInput = document.getElementById('nisInput');
    const nisFeedback = document.getElementById('nisFeedback');
    const newStudentBox = document.getElementById('newStudentBox');
    let searchTimer;

    nisInput.addEventListener('input', function() {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(() => {
            cariSiswa(this.value.trim());
        }, 400);
    });

    async function cariSiswa(nis) {
        if (!nis) {
            resetFormSiswa();
            nisFeedback.innerHTML = '';
            newStudentBox.classList.add('d-none');
            return;
        }

        try {
            const response = await fetch(`${searchUrl}/${nis}`);
            const student = await response.json();

            if (student && student.id) {
                document.getElementById('studentName').value = student.full_name || '';
                document.getElementById('studentClass').value = student.class ? student.class.name : '';
                newStudentBox.classList.add('d-none');
                nisFeedback.innerHTML = '<span class="text-success fw-bold"><i class="fas fa-check-circle"></i> Siswa ditemukan</span>';
            } else {
                resetFormSiswa();
                newStudentBox.classList.remove('d-none');
                nisFeedback.innerHTML = '<span class="text-danger fw-bold"><i class="fas fa-times-circle"></i> Siswa belum terdaftar. Lengkapi data siswa baru.</span>';
            }
        } catch (error) {
            console.error('Error:', error);
            resetFormSiswa();
            nisFeedback.innerHTML = '<span class="text-danger fw-bold">Gagal mencari siswa</span>';
        }
    }

    function resetFormSiswa() {
        document.getElementById('studentName').value = '';
        document.getElementById('studentClass').value = '';
    }

    document.addEventListener('DOMContentLoaded', function() {
        if (nisInput.value.trim()) {
            cariSiswa(nisInput.value.trim());
        }
    });

    // 3. Petugas Piket
    function populateOfficerNames(selectedGroup, selectedOfficer = null) {
        const officerSelect = document.getElementById('officerName');
        officerSelect.innerHTML = '<option value="">-- Pilih Nama Petugas --</option>';

        if (selectedGroup && jadwalPiket[selectedGroup]) {
            officerSelect.disabled = false;
            jadwalPiket[selectedGroup].forEach(name => {
                const option = document.createElement('option');
                option.value = name;
                option.textContent = name;
                if (selectedOfficer && name === selectedOfficer) option.selected = true;
                officerSelect.appendChild(option);
            });
        } else {
            officerSelect.disabled = true;
            officerSelect.innerHTML = '<option value="">-- Pilih Kelompok Terlebih Dahulu --</option>';
        }
    }

    document.getElementById('piketGroup').addEventListener('change', function() {
        populateOfficerNames(this.value);
    });

    document.addEventListener('DOMContentLoaded', function() {
        const initialGroup = document.getElementById('piketGroup').value;
        const initialOfficer = "<?php echo e(old('officer_name')); ?>";
        if (initialGroup) populateOfficerNames(initialGroup, initialOfficer);
    });

    // 4. WATERMARK
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

        ctx.fillStyle = 'rgba(0, 0, 0, 0.55)';
        ctx.fillRect(0, canvas.height - barHeight, canvas.width, barHeight);

        ctx.fillStyle = '#ffffff';
        ctx.font = 'bold ' + fontSize + 'px Arial';
        ctx.textBaseline = 'middle';
        ctx.fillText('UKS SMK NEGERI 1 BANGSRI', padding, canvas.height - barHeight + fontSize);

        ctx.font = (fontSize * 0.85) + 'px Arial';
        ctx.fillText(dateStr + '  |  ' + timeStr, padding, canvas.height - barHeight + fontSize * 2.3);
    }

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

    // 5. KAMERA REALTIME
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

    document.addEventListener('DOMContentLoaded', function () {
        const modalEl = document.getElementById('cameraModal');
        if (modalEl) modalEl.addEventListener('hidden.bs.modal', stopCamera);
    });

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

    // 6. Upload dari file/galeri
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

    // 7. ✅ PENCEGAHAN DOUBLE SUBMIT (VERSI AMAN DENGAN VALIDASI)
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form'); 
        const btnSubmit = document.getElementById('btnSubmit');

        if (form && btnSubmit) {
            form.addEventListener('submit', function (e) {
                // ✅ PENTING: Cek apakah form valid (tidak ada kolom required yang kosong)
                if (!form.checkValidity()) {
                    return; // Jika ada yang kosong, JANGAN disable tombol. Biarkan browser menampilkan error.
                }

                // Jika form valid, baru disable tombol dan ubah teks
                btnSubmit.disabled = true;
                btnSubmit.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Menyimpan...';
            });
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.petugas', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\sikes\resources\views/petugas/examinations/create.blade.php ENDPATH**/ ?>