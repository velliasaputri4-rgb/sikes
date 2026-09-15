@extends('layouts.petugas')

@section('title', 'Edit Kunjungan')
@section('page-title', 'Edit Data Kunjungan Siswa')

@section('content')
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h5 class="fw-bold mb-0">
            <i class="fas fa-edit me-2" style="color: #ef4444;"></i>Edit Data Kunjungan
        </h5>
        <a href="{{ route('petugas.examinations.index') }}" class="btn btn-sm" style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>

    <form action="{{ route('petugas.examinations.update', $examination->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            <!-- Kolom Kiri: Data Siswa & Petugas -->
            <div class="col-lg-5">
                <!-- Identitas Siswa -->
                <div class="p-4 rounded-3 mb-3" style="background: #ffffff; border: 1px solid #fee2e2; box-shadow: 0 2px 8px rgba(239, 68, 68, 0.04);">
                    <h6 class="fw-bold mb-3" style="color: #991b1b;">
                        <i class="fas fa-user-graduate me-2"></i>Identitas Siswa
                    </h6>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Pilih Siswa <span style="color: #ef4444;">*</span></label>
                        <select name="student_id" id="studentSelect" class="form-select @error('student_id') is-invalid @enderror" required style="border-color: #fecaca;">
                            <option value="">-- Cari Nama atau NIS Siswa --</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}" 
                                    data-nis="{{ $student->nis }}" 
                                    data-name="{{ $student->full_name }}"
                                    data-class="{{ $student->class->name ?? '-' }}"
                                    {{ old('student_id', $examination->student_id) == $student->id ? 'selected' : '' }}>
                                    {{ $student->nis }} - {{ $student->full_name }} ({{ $student->class->name ?? '-' }})
                                </option>
                            @endforeach
                        </select>
                        @error('student_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-2">
                        <label class="form-label small text-muted">NIS</label>
                        <input type="text" id="studentNis" class="form-control fw-semibold" value="{{ $examination->student->nis ?? '-' }}" readonly style="background-color: #fafbfc; border-color: #e2e8f0;">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small text-muted">Kelas</label>
                        <input type="text" id="studentClass" class="form-control fw-semibold" value="{{ $examination->student->class->name ?? '-' }}" readonly style="background-color: #fafbfc; border-color: #e2e8f0;">
                    </div>
                </div>

                <!-- Informasi Petugas Piket -->
                <div class="p-4 rounded-3 mb-3" style="background: #ffffff; border: 1px solid #fee2e2; box-shadow: 0 2px 8px rgba(239, 68, 68, 0.04);">
                    <h6 class="fw-bold mb-3" style="color: #991b1b;">
                        <i class="fas fa-user-nurse me-2"></i>Informasi Petugas Piket
                    </h6>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kelompok Piket <span style="color: #ef4444;">*</span></label>
                        <select id="piketGroup" class="form-select" required style="border-color: #fecaca;">
                            <option value="">-- Pilih Kelompok --</option>
                            @foreach(array_keys($jadwalPiket ?? []) as $group)
                                <option value="{{ $group }}">{{ $group }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Petugas <span style="color: #ef4444;">*</span></label>
                        <select name="officer_name" id="officerName" class="form-select @error('officer_name') is-invalid @enderror" required disabled style="border-color: #fecaca;">
                            <option value="">-- Pilih Kelompok Terlebih Dahulu --</option>
                        </select>
                        @error('officer_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row g-2">
                        <div class="col-6">
                            <label class="form-label fw-semibold">Tanggal</label>
                            <input type="date" name="examination_date" class="form-control" value="{{ old('examination_date', \Carbon\Carbon::parse($examination->examination_date)->format('Y-m-d')) }}" style="border-color: #fecaca;">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold">Jam</label>
                            <input type="time" name="arrival_time" class="form-control" value="{{ old('arrival_time', \Carbon\Carbon::parse($examination->arrival_time)->format('H:i')) }}" style="border-color: #fecaca;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Pemeriksaan -->
            <div class="col-lg-7">
                <div class="p-4 rounded-3 mb-3" style="background: #ffffff; border: 1px solid #fee2e2; box-shadow: 0 2px 8px rgba(239, 68, 68, 0.04);">
                    <h6 class="fw-bold mb-3" style="color: #ef4444;">
                        <i class="fas fa-notes-medical me-2"></i>Diagnosa & Tindakan
                    </h6>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Keluhan Utama <span style="color: #ef4444;">*</span></label>
                        <textarea name="complaint" class="form-control @error('complaint') is-invalid @enderror" rows="2" placeholder="Contoh: Demam, pusing, mual, sakit perut..." required style="border-color: #fecaca;">{{ old('complaint', $examination->complaint) }}</textarea>
                        @error('complaint') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Diagnosa <span style="color: #ef4444;">*</span></label>
                        <textarea name="diagnosis" class="form-control @error('diagnosis') is-invalid @enderror" rows="2" required style="border-color: #fecaca;">{{ old('diagnosis', $examination->diagnosis) }}</textarea>
                        @error('diagnosis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Obat yang Diberikan</label>
                        <input type="text" name="medicine" class="form-control @error('medicine') is-invalid @enderror" 
                               list="medicineList" placeholder="Ketik nama obat atau pilih dari daftar..." value="{{ old('medicine', $examination->medicine) }}" style="border-color: #fecaca;">
                        
                        <datalist id="medicineList">
                            @if(isset($medicines))
                                @foreach($medicines as $med)
                                    <option value="{{ $med->name }}" label="Sisa Stok: {{ $med->stock }} {{ $med->unit }}">
                                @endforeach
                            @endif
                        </datalist>
                        
                        <small class="text-muted mt-1 d-block">
                            <i class="fas fa-info-circle me-1" style="color: #f59e0b;"></i>
                            Ketik nama obat untuk melihat saran & sisa stok, atau ketik manual untuk dosis spesifik.
                        </small>
                        @error('medicine') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status Kepulangan <span style="color: #ef4444;">*</span></label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required style="border-color: #fecaca;">
                                <option value="">Pilih Status</option>
                                <option value="pulang" {{ old('status', $examination->status) == 'pulang' ? 'selected' : '' }}>Pulang</option>
                                <option value="istirahat_uks" {{ old('status', $examination->status) == 'istirahat_uks' ? 'selected' : '' }}>Istirahat di UKS</option>
                                <option value="rawat_jalan" {{ old('status', $examination->status) == 'rawat_jalan' ? 'selected' : '' }}>Rawat Jalan (kembali ke kelas)</option>
                                <option value="rujuk_puskesmas" {{ old('status', $examination->status) == 'rujuk_puskesmas' ? 'selected' : '' }}>Rujuk ke Puskesmas</option>
                                <option value="rujuk_rs" {{ old('status', $examination->status) == 'rujuk_rs' ? 'selected' : '' }}>Rujuk ke Rumah Sakit</option>
                                <option value="hubungi_ortu" {{ old('status', $examination->status) == 'hubungi_ortu' ? 'selected' : '' }}>Hubungi Orang Tua/Wali</option>
                            </select>
                            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Catatan Tambahan</label>
                            <input type="text" name="notes" class="form-control" placeholder="Catatan untuk orang tua (opsional)" value="{{ old('notes', $examination->notes) }}" style="border-color: #fecaca;">
                        </div>
                    </div>
                </div>

                <!-- ✅ DOKUMENTASI DENGAN KAMERA REALTIME -->
                <div class="p-4 rounded-3" style="background: #ffffff; border: 1px solid #fee2e2; box-shadow: 0 2px 8px rgba(239, 68, 68, 0.04);">
                    <h6 class="fw-bold mb-3" style="color: #f43f5e;">
                        <i class="fas fa-camera me-2"></i>Dokumentasi
                    </h6>
                    <div class="mb-2">
                        <label class="form-label fw-semibold">Foto Kondisi/Fisik</label>
                        
                        @if($examination->photo)
                            <div class="mb-3">
                                <small class="text-muted d-block mb-2">Foto saat ini:</small>
                                <img src="{{ asset('storage/' . $examination->photo) }}" alt="Foto Lama" class="img-thumbnail" style="max-height: 200px; border: 2px solid #fee2e2;">
                            </div>
                        @endif

                        <div class="d-flex gap-2 mb-2">
                            <button type="button" class="btn flex-fill" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; border: none; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);" onclick="openCamera()">
                                <i class="fas fa-video me-1"></i> Buka Kamera
                            </button>
                            <label class="btn flex-fill mb-0" style="background: #ffffff; color: #475569; border: 1px solid #cbd5e1;">
                                <i class="fas fa-image me-1"></i> Pilih dari File
                                <input type="file" id="photoInput" name="photo" accept="image/*" class="d-none" onchange="processPhotoWithWatermark(this)">
                            </label>
                        </div>
                        <small class="text-muted">
                            <i class="fas fa-magic me-1" style="color: #f59e0b;"></i>Foto otomatis diberi watermark tanggal & jam. Kosongkan jika tidak ingin mengganti foto.
                        </small>
                        @error('photo') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror

                        <div class="mt-3">
                            <img id="imagePreview" src="#" alt="Preview" style="display: none; max-width: 280px; border-radius: 8px; border: 2px solid #fee2e2;" class="img-thumbnail">
                            <div id="watermarkInfo" class="d-none mt-2">
                                <span class="badge px-3 py-2" style="background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; font-weight: 500;">
                                    <i class="fas fa-check-circle me-1"></i> Watermark tanggal & jam berhasil ditambahkan
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Submit -->
            <div class="col-12 text-end mt-4 pt-3" style="border-top: 1px solid #fee2e2;">
                <a href="{{ route('petugas.examinations.index') }}" class="btn me-2" style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;">Batal</a>
                <button type="submit" class="btn px-4" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; border: none; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);">
                    <i class="fas fa-save me-2"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>

{{-- ✅ MODAL KAMERA REALTIME --}}
<div class="modal fade" id="cameraModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border: none; border-radius: 16px; overflow: hidden;">
            <div class="modal-header" style="background: #fef2f2; border-bottom: 1px solid #fee2e2;">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-camera me-2" style="color: #ef4444;"></i>Kamera Realtime
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body p-2" style="background: #000;">
                <video id="cameraVideo" autoplay playsinline class="w-100 rounded" style="min-height:250px; object-fit:cover;"></video>
            </div>
            <div class="modal-footer justify-content-center border-0 pt-0 pb-3" style="background: #fef2f2;">
                <button type="button" class="btn px-4" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; border: none; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);" onclick="capturePhoto()">
                    <i class="fas fa-camera me-2"></i>Ambil Foto
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // 1. Data Jadwal Piket dari Controller
    const jadwalPiket = @json($jadwalPiket ?? []);
    const currentOfficerName = "{{ old('officer_name', $examination->officer_name) }}";

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
        const initialGroup = findGroupByOfficerName(currentOfficerName) || "{{ old('piket_group') }}";
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

        // ✅ PERUBAHAN: Bar merah gelap transparan (sesuai tema)
        ctx.fillStyle = 'rgba(153, 27, 27, 0.85)'; 
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
@endpush