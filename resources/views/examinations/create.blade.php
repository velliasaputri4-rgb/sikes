@extends('layouts.app')

@section('page-title', 'Form Kunjungan UKS')

@section('content')
    <div class="content-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0"><i class="fas fa-clipboard-list me-2 text-primary"></i>Form Kunjungan UKS</h5>
            <a href="{{ route('examinations.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <form action="{{ route('examinations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-4">
                <!-- Kolom Kiri: Data Siswa -->
                <div class="col-lg-6">
                    <h6 class="fw-bold border-bottom pb-2 mb-3">Data Siswa</h6>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Cari NIS / Nama Siswa <span class="text-danger">*</span></label>
                        <select name="student_id" id="studentSelect" class="form-select @error('student_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Siswa --</option>
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

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small text-muted">NIS</label>
                            <input type="text" id="studentNis" class="form-control bg-light" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small text-muted">Nama Lengkap</label>
                            <input type="text" id="studentName" class="form-control bg-light" readonly>
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small text-muted">Kelas</label>
                            <input type="text" id="studentClass" class="form-control bg-light" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small text-muted">Jenis Kelamin</label>
                            <input type="text" id="studentGender" class="form-control bg-light" readonly>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" name="examination_date" class="form-control" value="{{ date('Y-m-d') }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Jam <span class="text-danger">*</span></label>
                            <input type="time" name="arrival_time" class="form-control" value="{{ date('H:i') }}" readonly>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Pemeriksaan -->
                <div class="col-lg-6">
                    <h6 class="fw-bold border-bottom pb-2 mb-3">Pemeriksaan</h6>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Keluhan <span class="text-danger">*</span></label>
                        <textarea name="complaint" class="form-control @error('complaint') is-invalid @enderror" rows="2" placeholder="Contoh: Demam, pusing, mual..." required>{{ old('complaint') }}</textarea>
                        @error('complaint') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small">Suhu Tubuh (°C)</label>
                            <input type="number" step="0.1" name="temperature" class="form-control" placeholder="36.5" value="{{ old('temperature') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small">Tekanan Darah</label>
                            <input type="text" name="blood_pressure" class="form-control" placeholder="120/80" value="{{ old('blood_pressure') }}">
                        </div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small">Denyut Nadi (x/mnt)</label>
                            <input type="number" name="pulse" class="form-control" placeholder="80" value="{{ old('pulse') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small">Berat Badan (kg)</label>
                            <input type="number" step="0.1" name="weight" id="weight" class="form-control" placeholder="50" value="{{ old('weight') }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small">Tinggi Badan (cm)</label>
                        <input type="number" step="0.1" name="height" id="height" class="form-control" placeholder="160" value="{{ old('height') }}">
                        <small class="text-muted">BMI akan dihitung otomatis</small>
                    </div>
                </div>

                <!-- Kolom Penuh: Diagnosa & Tindakan -->
                <div class="col-12">
                    <h6 class="fw-bold border-bottom pb-2 mb-3">Diagnosa & Tindakan</h6>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Diagnosa <span class="text-danger">*</span></label>
                            <textarea name="diagnosis" class="form-control @error('diagnosis') is-invalid @enderror" rows="2" required>{{ old('diagnosis') }}</textarea>
                            @error('diagnosis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tindakan / Pengobatan</label>
                            <textarea name="treatment" class="form-control" rows="2">{{ old('treatment') }}</textarea>
                        </div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="">Pilih Status</option>
                                <option value="pulang" {{ old('status') == 'pulang' ? 'selected' : '' }}>Pulang</option>
                                <option value="istirahat_uks" {{ old('status') == 'istirahat_uks' ? 'selected' : '' }}>Istirahat di UKS</option>
                                <option value="rawat_jalan" {{ old('status') == 'rawat_jalan' ? 'selected' : '' }}>Rawat Jalan</option>
                                <option value="rujuk_puskesmas" {{ old('status') == 'rujuk_puskesmas' ? 'selected' : '' }}>Rujuk Puskesmas</option>
                                <option value="rujuk_rs" {{ old('status') == 'rujuk_rs' ? 'selected' : '' }}>Rujuk Rumah Sakit</option>
                            </select>
                            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fw-semibold">Catatan Tambahan</label>
                            <input type="text" name="notes" class="form-control" placeholder="Catatan tambahan (opsional)" value="{{ old('notes') }}">
                        </div>
                    </div>
                </div>

                <!-- Upload Foto -->
                <div class="col-12">
                    <h6 class="fw-bold border-bottom pb-2 mb-3">Dokumentasi</h6>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Upload Foto Pasien</label>
                        <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*" onchange="previewImage(this)">
                        <small class="text-muted">Format: JPG, PNG. Maksimal 2MB.</small>
                        @error('photo') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        
                        <div class="mt-3">
                            <img id="imagePreview" src="#" alt="Preview" style="display: none; max-width: 300px; border-radius: 8px;" class="img-thumbnail">
                        </div>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="col-12 text-end mt-4 pt-3 border-top">
                    <a href="{{ route('examinations.index') }}" class="btn btn-outline-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-2"></i> Kirim Form
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    // Auto-fill data siswa saat dipilih
    document.getElementById('studentSelect').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        document.getElementById('studentNis').value = selectedOption.dataset.nis || '';
        document.getElementById('studentName').value = selectedOption.dataset.name || '';
        document.getElementById('studentClass').value = selectedOption.dataset.class || '';
        
        const gender = selectedOption.dataset.gender;
        document.getElementById('studentGender').value = gender === 'L' ? 'Laki-laki' : (gender === 'P' ? 'Perempuan' : '');
    });

    // Preview gambar sebelum upload
    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush