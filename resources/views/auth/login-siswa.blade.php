<x-guest-layout>
    <div class="text-center mb-4">
        <div class="bg-info bg-opacity-10 text-info rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
            <i class="fas fa-user-graduate fa-2x"></i>
        </div>
        <h2 class="fw-bold text-info mb-1">Cek Riwayat Kunjungan</h2>
        <p class="text-muted small mb-0">Masukkan NIS dan Tanggal Lahir untuk melihat riwayat</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <div class="mb-3">
            <label for="nis" class="form-label">NIS (Nomor Induk Siswa)</label>
            <input id="nis" type="text" class="form-control" name="nis" required autofocus placeholder="Masukkan NIS Anda" value="{{ old('nis') }}">
            @error('nis')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="birth_date" class="form-label">Tanggal Lahir</label>
            <input id="birth_date" type="date" class="form-control" name="birth_date" required>
            @error('birth_date')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-info w-100 mb-3 text-white">
            <i class="fas fa-search me-2"></i> Lihat Riwayat
        </button>
    </form>

    <div class="text-center">
        <a href="{{ route('landing') }}" class="text-muted text-decoration-none small">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
        </a>
    </div>
</x-guest-layout>