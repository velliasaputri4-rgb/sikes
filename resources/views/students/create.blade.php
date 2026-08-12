@extends('layouts.petugas')

@section('title', 'Input Kunjungan')
@section('page-title', 'Input Kunjungan Siswa')

@section('content')
<div class="content-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0"><i class="fas fa-plus-circle text-success me-2"></i>Form Pemeriksaan Baru</h5>
        <a href="{{ route('petugas.examinations.index') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i>Kembali</a>
    </div>

    <form action="{{ route('petugas.examinations.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <!-- Kiri: Siswa & Petugas -->
            <div class="col-lg-5">
                <div class="p-3 bg-light rounded-3 mb-3">
                    <h6 class="fw-bold text-success mb-3"><i class="fas fa-user-graduate me-2"></i>Identitas Siswa</h6>

                    <div class="mb-2">
                        <label class="form-label fw-semibold">NIS <span class="text-danger">*</span></label>
                        <input type="text" name="nis" id="nis" class="form-control @error('nis') is-invalid @enderror"
                               value="{{ old('nis') }}" placeholder="Ketik NIS siswa..." required autocomplete="off">
                        <div id="nisFeedback" class="form-text"></div>
                        @error('nis')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-2">
                        <label class="form-label small text-muted">Nama</label>
                        <input type="text" id="studentName" class="form-control bg-white fw-semibold" readonly>
                    </div>
                    <div class="row g-2 mb-2">
                        <div class="col-6">
                            <label class="form-label small text-muted">Jenis Kelamin</label>
                            <input type="text" id="studentGender" class="form-control bg-white" readonly>
                        </div>
                        <div class="col-6">
                            <label class="form-label small text-muted">Kelas</label>
                            <input type="text" id="studentClass" class="form-control bg-white" readonly>
                        </div>
                    </div>

                    <!-- Muncul hanya jika NIS belum terdaftar -->
                    <div id="newStudentBox" class="d-none border-2 border-danger rounded-3 p-3 bg-white">
                        <small class="fw-bold text-danger d-block mb-2">Siswa belum terdaftar — lengkapi untuk simpan sebagai siswa baru:</small>
                        <input type="text" name="full_name" class="form-control mb-2" placeholder="Nama Lengkap" value="{{ old('full_name') }}">
                        <div class="row g-2">
                            <div class="col-5">
                                <select name="gender" class="form-select">
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-7">
                                <input type="text" name="class_name" class="form-control" placeholder="Kelas (cth: XII PPLG 2)" value="{{ old('class_name') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-light rounded-3">
                    <h6 class="fw-bold text-primary mb-3"><i class="fas fa-user-nurse me-2"></i>Petugas Piket</h6>
                    <div class="row g-2">
                        <div class="col-6">
                            <label class="form-label fw-semibold">Kelompok <span class="text-danger">*</span></label>
                            <select name="piket_group" id="piketGroup" class="form-select" required>
                                <option value="">-- Pilih --</option>
                                @foreach(array_keys($jadwalPiket ?? []) as $group)
                                    <option value="{{ $group }}" {{ old('piket_group') == $group ? 'selected' : '' }}>{{ $group }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold">Nama Petugas <span class="text-danger">*</span></label>
                            <select name="officer_name" id="officerName" class="form-select @error('officer_name') is-invalid @enderror" required disabled>
                                <option value="">-- Pilih Kelompok --</option>
                            </select>
                            @error('officer_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold">Tanggal</label>
                            <input type="date" name="examination_date" class="form-control" value="{{ old('examination_date', date('Y-m-d')) }}">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold">Jam</label>
                            <input type="time" name="arrival_time" class="form-control" value="{{ old('arrival_time', date('H:i')) }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kanan: Pemeriksaan -->
            <div class="col-lg-7">
                <div class="p-3 bg-light rounded-3">
                    <h6 class="fw-bold text-danger mb-3"><i class="fas fa-notes-medical me-2"></i>Diagnosa & Tindakan</h6>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Keluhan Utama <span class="text-danger">*</span></label>
                        <textarea name="complaint" class="form-control @error('complaint') is-invalid @enderror" rows="2" placeholder="Contoh: Demam, pusing, mual..." required>{{ old('complaint') }}</textarea>
                        @error('complaint')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Diagnosa <span class="text-danger">*</span></label>
                            <textarea name="diagnosis" class="form-control @error('diagnosis') is-invalid @enderror" rows="2" required>{{ old('diagnosis') }}</textarea>
                            @error('diagnosis')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Tindakan / Pengobatan</label>
                            <textarea name="treatment" class="form-control" rows="2" placeholder="Contoh: Istirahat, kompres...">{{ old('treatment') }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Obat yang Diberikan</label>
                            <input type="text" name="medicine" class="form-control" placeholder="Contoh: Paracetamol 500mg (2 tablet)" value="{{ old('medicine') }}">
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status Kepulangan <span class="text-danger">*</span></label>
                            <select name="status" class="form-select" required>
                                <option value="">Pilih Status</option>
                                @foreach(['pulang' => 'Pulang (Sehat/Sembuh)', 'istirahat_uks' => 'Istirahat di UKS', 'rawat_jalan' => 'Rawat Jalan', 'rujuk_puskesmas' => 'Rujuk Puskesmas', 'rujuk_rs' => 'Rujuk Rumah Sakit', 'hubungi_ortu' => 'Hubungi Orang Tua'] as $value => $label)
                                    <option value="{{ $value }}" {{ old('status') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Catatan Tambahan</label>
                            <input type="text" name="notes" class="form-control" placeholder="Opsional" value="{{ old('notes') }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Foto (opsional)</label>
                            <input type="file" name="photo" class="form-control" accept="image/*" onchange="previewImage(this)">
                            <img id="imagePreview" src="#" style="display:none; max-width:150px" class="img-thumbnail mt-2">
                            @error('photo')<div class="text-danger small">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 text-end mt-4 pt-3 border-top">
                <a href="{{ route('petugas.examinations.index') }}" class="btn btn-outline-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-success px-4"><i class="fas fa-save me-2"></i>Simpan Kunjungan</button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    // ===== Cari siswa by NIS (auto-fill / siswa baru) =====
    const searchUrl = @json(route('petugas.examinations.search', ['nis' => '__NIS__']));
    const nisInput  = document.getElementById('nis');
    let timer;

    nisInput.addEventListener('input', () => { clearTimeout(timer); timer = setTimeout(cariSiswa, 350); });
    nisInput.addEventListener('keydown', e => { if (e.key === 'Enter') { e.preventDefault(); cariSiswa(); } });

    async function cariSiswa() {
        const nis = nisInput.value.trim();
        const fb  = document.getElementById('nisFeedback');
        const box = document.getElementById('newStudentBox');
        if (!nis) { isiReadonly(null); fb.innerHTML = ''; box.classList.add('d-none'); return; }

        const s = await (await fetch(searchUrl.replace('__NIS__', encodeURIComponent(nis)))).json();

        if (s) {
            isiReadonly(s);
            box.classList.add('d-none');
            fb.innerHTML = '<span class="text-success fw-bold">✓ Siswa ditemukan</span>';
        } else {
            isiReadonly(null);
            box.classList.remove('d-none');
            fb.innerHTML = '<span class="text-danger fw-bold">Siswa belum terdaftar — lengkapi sebagai siswa baru</span>';
        }
    }

    function isiReadonly(s) {
        document.getElementById('studentName').value   = s ? s.full_name : '';
        document.getElementById('studentGender').value = s ? (s.gender === 'L' ? 'Laki-laki' : 'Perempuan') : '';
        document.getElementById('studentClass').value  = s && s.class ? s.class.name : '';
    }

    // ===== Petugas piket =====
    const jadwalPiket   = @json($jadwalPiket ?? []);
    const officerSelect = document.getElementById('officerName');

    document.getElementById('piketGroup').addEventListener('change', function () {
        officerSelect.innerHTML = '<option value="">-- Pilih Petugas --</option>';
        if (this.value && jadwalPiket[this.value]) {
            officerSelect.disabled = false;
            jadwalPiket[this.value].forEach(n => officerSelect.add(new Option(n, n)));
        } else officerSelect.disabled = true;
    });

    // Restore saat validasi gagal + trigger cari NIS dari old input
    document.addEventListener('DOMContentLoaded', () => {
        if (nisInput.value.trim()) cariSiswa();
        @if(old('officer_name'))
            document.getElementById('piketGroup').dispatchEvent(new Event('change'));
            officerSelect.value = @json(old('officer_name'));
        @endif
    });

    // ===== Preview foto =====
    function previewImage(input) {
        const p = document.getElementById('imagePreview');
        if (input.files && input.files[0]) {
            p.src = URL.createObjectURL(input.files[0]);
            p.style.display = 'block';
        } else p.style.display = 'none';
    }
</script>
@endpush