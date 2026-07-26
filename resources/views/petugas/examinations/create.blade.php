@extends('layouts.petugas')

@section('title', 'Input Kunjungan')
@section('page-title', 'Input Kunjungan Siswa')

@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0"><i class="fas fa-plus-circle text-success me-2"></i>Form Pemeriksaan Baru</h5>
            <a href="{{ route('petugas.examinations.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
            </a>
        </div>

        <form action="{{ route('petugas.examinations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-4">
                <!-- Kolom Kiri: Data Siswa -->
                <div class="col-lg-5">
                    <div class="p-3 bg-light rounded-3 mb-3">
                        <h6 class="fw-bold text-success mb-3"><i class="fas fa-user-graduate me-2"></i>Identitas Siswa</h6>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pilih Siswa <span class="text-danger">*</span></label>
                            <select name="student_id" id="studentSelect" class="form-select @error('student_id') is-invalid @enderror" required>
                                <option value="">-- Cari Nama atau NIS Siswa --</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}" 
                                        data-nis="{{ $student->nis }}" 
                                        data-name="{{ $student->full_name }}"
                                        data-class="{{ $student->class->name ?? '-' }}"
                                        data-gender="{{ $student->gender }}">
                                        {{ $student->nis }} - {{ $student->full_name }} ({{ $student->class->name ?? '-' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('student_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row g-2 mb-2">
                            <div class="col-6">
                                <label class="form-label small text-muted">NIS</label>
                                <input type="text" id="studentNis" class="form-control bg-white fw-semibold" readonly>
                            </div>
                            <div class="col-6">
                                <label class="form-label small text-muted">Jenis Kelamin</label>
                                <input type="text" id="studentGender" class="form-control bg-white" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small text-muted">Kelas</label>
                            <input type="text" id="studentClass" class="form-control bg-white fw-semibold" readonly>
                        </div>

                        <div class="row g-2">
                            <div class="col-6">
                                <label class="form-label fw-semibold">Tanggal</label>
                                <input type="date" name="examination_date" class="form-control" value="{{ date('Y-m-d') }}" readonly>
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-semibold">Jam</label>
                                <input type="time" name="arrival_time" class="form-control" value="{{ date('H:i') }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Pemeriksaan -->
                <div class="col-lg-7">
                    <div class="p-3 bg-light rounded-3 mb-3">
                        <h6 class="fw-bold text-primary mb-3"><i class="fas fa-stethoscope me-2"></i>Hasil Pemeriksaan</h6>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Keluhan Utama <span class="text-danger">*</span></label>
                            <textarea name="complaint" class="form-control @error('complaint') is-invalid @enderror" rows="2" placeholder="Contoh: Demam, pusing, mual, sakit perut..." required>{{ old('complaint') }}</textarea>
                            @error('complaint') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-md-3">
                                <label class="form-label small">Suhu (°C)</label>
                                <input type="number" step="0.1" name="temperature" class="form-control" placeholder="36.5" value="{{ old('temperature') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small">Tekanan Darah</label>
                                <input type="text" name="blood_pressure" class="form-control" placeholder="120/80" value="{{ old('blood_pressure') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small">Nadi (x/mnt)</label>
                                <input type="number" name="pulse" class="form-control" placeholder="80" value="{{ old('pulse') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small">SpO2 (%)</label>
                                <input type="number" name="spo2" class="form-control" placeholder="98" value="{{ old('spo2') }}">
                            </div>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-md-4">
                                <label class="form-label small">Berat Badan (kg)</label>
                                <input type="number" step="0.1" name="weight" id="weight" class="form-control" placeholder="50" value="{{ old('weight') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small">Tinggi Badan (cm)</label>
                                <input type="number" step="0.1" name="height" id="height" class="form-control" placeholder="160" value="{{ old('height') }}">
                                <small class="text-muted" style="font-size: 10px;">*BMI dihitung otomatis</small>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small">BMI</label>
                                <input type="text" id="bmiResult" class="form-control bg-white fw-bold text-primary" readonly placeholder="-">
                            </div>
                        </div>
                    </div>

                    <div class="p-3 bg-light rounded-3 mb-3">
                        <h6 class="fw-bold text-danger mb-3"><i class="fas fa-notes-medical me-2"></i>Diagnosa & Tindakan</h6>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Diagnosa <span class="text-danger">*</span></label>
                                <textarea name="diagnosis" class="form-control @error('diagnosis') is-invalid @enderror" rows="2" required>{{ old('diagnosis') }}</textarea>
                                @error('diagnosis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tindakan / Pengobatan</label>
                                <textarea name="treatment" class="form-control" rows="2" placeholder="Contoh: Diberikan Paracetamol 1 tablet">{{ old('treatment') }}</textarea>
                            </div>
                        </div>

                        <div class="row g-3 mt-1">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Status Kepulangan <span class="text-danger">*</span></label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="">Pilih Status</option>
                                    <option value="pulang" {{ old('status') == 'pulang' ? 'selected' : '' }}>Pulang (Sehat/Sembuh)</option>
                                    <option value="istirahat_uks" {{ old('status') == 'istirahat_uks' ? 'selected' : '' }}>Istirahat di UKS</option>
                                    <option value="rawat_jalan" {{ old('status') == 'rawat_jalan' ? 'selected' : '' }}>Rawat Jalan</option>
                                    <option value="rujuk_puskesmas" {{ old('status') == 'rujuk_puskesmas' ? 'selected' : '' }}>Rujuk ke Puskesmas</option>
                                    <option value="rujuk_rs" {{ old('status') == 'rujuk_rs' ? 'selected' : '' }}>Rujuk ke Rumah Sakit</option>
                                </select>
                                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Catatan Tambahan</label>
                                <input type="text" name="notes" class="form-control" placeholder="Catatan untuk orang tua/wali (opsional)" value="{{ old('notes') }}">
                            </div</div>
                        </div>
                    </div>

                    <div class="p-3 bg-light rounded-3">
                        <h6 class="fw-bold text-info mb-3"><i class="fas fa-camera me-2"></i>Dokumentasi</h6>
                        <div class="mb-2">
                            <label class="form-label fw-semibold">Upload Foto Kondisi/Fisik</label>
                            <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*" onchange="previewImage(this)">
                            <small class="text-muted">Format: JPG, PNG. Maksimal 2MB.</small>
                            @error('photo') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            
                            <div class="mt-3">
                                <img id="imagePreview" src="#" alt="Preview" style="display: none; max-width: 200px; border-radius: 8px;" class="img-thumbnail border">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="col-12 text-end mt-4 pt-3 border-top">
                    <a href="{{ route('petugas.examinations.index') }}" class="btn btn-outline-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-save me-2"></i> Simpan Data Kunjungan
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    // 1. Auto-fill data siswa saat dipilih dari dropdown
    document.getElementById('studentSelect').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        document.getElementById('studentNis').value = selectedOption.dataset.nis || '';
        document.getElementById('studentClass').value = selectedOption.dataset.class || '';
        
        const gender = selectedOption.dataset.gender;
        document.getElementById('studentGender').value = gender === 'L' ? 'Laki-laki' : (gender === 'P' ? 'Perempuan' : '-');
    });

    // 2. Hitung BMI otomatis saat berat atau tinggi badan diubah
    function calculateBMI() {
        const weight = parseFloat(document.getElementById('weight').value);
        const height = parseFloat(document.getElementById('height').value);
        const bmiInput = document.getElementById('bmiResult');

        if (weight > 0 && height > 0) {
            const heightInMeters = height / 100;
            const bmi = (weight / (heightInMeters * heightInMeters)).toFixed(1);
            bmiInput.value = bmi;
            
            // Ubah warna teks berdasarkan kategori BMI
            if (bmi < 18.5) bmiInput.className = 'form-control bg-white fw-bold text-warning';
            else if (bmi >= 18.5 && bmi <= 24.9) bmiInput.className = 'form-control bg-white fw-bold text-success';
            else bmiInput.className = 'form-control bg-white fw-bold text-danger';
        } else {
            bmiInput.value = '';
            bmiInput.className = 'form-control bg-white fw-bold text-primary';
        }
    }

    document.getElementById('weight').addEventListener('input', calculateBMI);
    document.getElementById('height').addEventListener('input', calculateBMI);

    // 3. Preview gambar sebelum upload
    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.style.display = 'none';
        }
    }
</script>
@endpush
