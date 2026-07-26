<x-guest-layout>
    <div class="text-center mb-4">
        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
            <i class="fas fa-user-shield fa-2x"></i>
        </div>
        <h2 class="fw-bold text-primary mb-1">Login Admin</h2>
        <p class="text-muted small mb-0">Sistem Informasi Unit Kesehatan Sekolah</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="admin@sikes.com">
            @error('email')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" class="form-control" name="password" required placeholder="••••••••">
            @error('password')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Ingat saya</label>
        </div>

        <button type="submit" class="btn btn-primary w-100 mb-3">
            <i class="fas fa-sign-in-alt me-2"></i> Masuk sebagai Admin
        </button>
    </form>

    <div class="text-center">
        <p class="small text-muted mb-2">
            Bukan admin? 
            <a href="{{ route('login.petugas') }}" class="text-success fw-semibold">Login sebagai Petugas</a>
        </p>
        <a href="{{ route('landing') }}" class="text-muted text-decoration-none small">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
        </a>
    </div>
</x-guest-layout>