@extends('layouts.petugas')

@section('title', 'Edit Kunjungan')
@section('page-title', 'Edit Data Kunjungan Siswa')

@section('content')
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0"><i class="fas fa-edit text-warning me-2"></i>Edit Data Kunjungan</h5>
        <a href="{{ route('petugas.examinations.index') }}" class="btn btn-outline-secondary btn-sm">
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
                                    data-gender="{{ $student->gender }}"
                                    {{ old('student_id', $examination->student_id) == $student->id ? 'selected' : '' }}>
                                    {{ $student->nis }} - {{ $student->full_name }} ({{ $student->class->name ?? '-' }})
                                </option>
                            @endforeach
                        </select>
                        @error('student_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row g-2 mb-2">
                        <div class="col-6">
                            <label class="form-label small text-muted">NIS</label>
                            <input type="text" id="studentNis" class="form-control bg-white fw-semibold" value="{{ $examination->student->nis ?? '-' }}" readonly>
                        </div>
                        <div class="col-6">
                            <label class="form-label small text-muted">Jenis Kelamin</label>
                            <input type="text" id="studentGender" class="form-control bg-white" value="{{ $examination->student->gender == 'L' ? 'Laki-laki' : ($examination->student->gender == 'P' ? 'Perempuan' : '-') }}" readonly>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small text-muted">Kelas</label>
                        <input type="text" id="studentClass" class="form-control bg-white fw-semibold" value="{{ $examination->student->class->name ?? '-' }}" readonly>
                    </div>
                </div>

                <!-- Informasi Petugas Piket -->
                <div class="p-3 bg-light rounded-3 mb-3">
                    <h6 class="fw-bold text-primary mb-3"><i class="fas fa-user-nurse me-2"></i>Informasi Petugas Piket</h6>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kelompok Piket <span class="text-danger">*</span></label>
                        <select id="piketGroup" class="form-select" required>
                            <option value="">-- Pilih Kelompok --</option>
                            @foreach(array_keys($jadwalPiket ?? []) as $group)
                                <option value="{{ $group }}">{{ $group }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Petugas <span class="text-danger">*</span></label>
                        <select name="officer_name" id="officerName" class="form-select @error('officer_name') is-invalid @enderror" required disabled>
                            <option value="">-- Pilih Kelompok Terlebih Dahulu --</option>
                        </select>
                        @error('officer_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row g-2">
                        <div class="col-6">
                            <label class="form-label fw-semibold">Tanggal</label>
                            <input type="date" name="examination_date" class="form-control" value="{{ old('examination_date', \Carbon\Carbon::parse($examination->examination_date)->format('Y-m-d')) }}">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold">Jam</label>
                            <input type="time" name="arrival_time" class="form-control" value="{{ old('arrival_time', \Carbon\Carbon::parse($examination->arrival_time)->format('H:i')) }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Pemeriksaan -->
            <div class="col-lg-7">
                <div class="p-3 bg-light rounded-3 mb-3">
                    <h6 class="fw-bold text-danger mb-3"><i class="fas fa-notes-medical me-2"></i>Diagnosa & Tindakan</h6>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Keluhan Utama <span class="text-danger">*</span></label>
                        <textarea name="complaint" class="form-control @error('complaint') is-invalid @enderror" rows="2" placeholder="Contoh: Demam, pusing, mual, sakit perut..." required>{{ old('complaint', $examination->complaint) }}</textarea>
                        @error('complaint') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Diagnosa <span class="text-danger">*</span></label>
                            <textarea name="diagnosis" class="form-control @error('diagnosis') is-invalid @enderror" rows="2" required>{{ old('diagnosis', $examination->diagnosis) }}</textarea>
                            @error('diagnosis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tindakan / Pengobatan</label>
                            <textarea name="treatment" class="form-control" rows="2" placeholder="Contoh: Diberikan Paracetamol 1 tablet">{{ old('treatment', $examination->treatment) }}</textarea>
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Obat yang Diberikan</label>
                            <textarea name="medicine" class="form-control" rows="2" placeholder="Contoh: Paracetamol 500mg (2 tablet), Vitamin C (1 tablet)">{{ old('medicine', $examination->medicine) }}</textarea>
                            <small class="text-muted">Sebutkan nama obat, dosis, dan jumlah yang diberikan</small>
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status Kepulangan <span class="text-danger">*</span></label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="">Pilih Status</option>
                                <option value="pulang" {{ old('status', $examination->status) == 'pulang' ? 'selected' : '' }}>Pulang (Sehat/Sembuh)</option>
                                <option value="istirahat_uks" {{ old('status', $examination->status) == 'istirahat_uks' ? 'selected' : '' }}>Istirahat di UKS</option>
                                <option value="rawat_jalan" {{ old('status', $examination->status) == 'rawat_jalan' ? 'selected' : '' }}>Rawat Jalan</option>
                                <option value="rujuk_puskesmas" {{ old('status', $examination->status) == 'rujuk_puskesmas' ? 'selected' : '' }}>Rujuk ke Puskesmas</option>
                                <option value="rujuk_rs" {{ old('status', $examination->status) == 'rujuk_rs' ? 'selected' : '' }}>Rujuk ke Rumah Sakit</option>
                                <!-- PERBAIKAN: Tambahkan opsi Hubungi Orang Tua -->
                                <option value="hubungi_ortu" {{ old('status', $examination->status) == 'hubungi_ortu' ? 'selected' : '' }}>Hubungi Orang Tua/Wali</option>
                            </select>
                            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Catatan Tambahan</label>
                            <input type="text" name="notes" class="form-control" placeholder="Catatan untuk orang tua/wali (opsional)" value="{{ old('notes', $examination->notes) }}">
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-light rounded-3">
                    <h6 class="fw-bold text-info mb-3"><i class="fas fa-camera me-2"></i>Dokumentasi</h6>
                    <div class="mb-2">
                        <label class="form-label fw-semibold">Upload Foto Kondisi/Fisik</label>
                        
                        @if($examination->photo)
                            <div class="mb-3">
                                <small class="text-muted d-block mb-2">Foto saat ini:</small>
                                <img src="{{ asset('storage/' . $examination->photo) }}" alt="Foto Lama" class="img-thumbnail" style="max-height: 200px;">
                            </div>
                        @endif

                        <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*" onchange="previewImage(this)">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti foto. Format: JPG, PNG. Maksimal 2MB.</small>
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
                <button type="submit" class="btn btn-warning px-4 text-white">
                    <i class="fas fa-save me-2"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
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
            const gender = selectedOption.dataset.gender;
            document.getElementById('studentGender').value = gender === 'L' ? 'Laki-laki' : (gender === 'P' ? 'Perempuan' : '-');
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
        
        const gender = selectedOption.dataset.gender;
        document.getElementById('studentGender').value = gender === 'L' ? 'Laki-laki' : (gender === 'P' ? 'Perempuan' : '-');
    });

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