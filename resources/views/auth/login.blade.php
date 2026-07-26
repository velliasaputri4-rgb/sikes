<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="fw-bold text-primary">SIKES</h2>
        <p class="text-muted small">Sistem Informasi Unit Kesehatan Sekolah</p>
    </div>

    <!-- Tab Navigasi: Hanya Admin & Petugas -->
    <ul class="nav nav-pills nav-justified mb-4" id="loginTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="admin-tab" data-bs-toggle="pill" data-bs-target="#admin-login" type="button">
                <i class="fas fa-user-shield me-1"></i> Admin
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="petugas-tab" data-bs-toggle="pill" data-bs-target="#petugas-login" type="button">
                <i class="fas fa-user-nurse me-1"></i> Petugas UKS
            </button>
        </li>
    </ul>

    <div class="tab-content">
        <!-- FORM ADMIN -->
        <div class="tab-pane fade show active" id="admin-login" role="tabpanel">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mt-3">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-3 w-full justify-center bg-primary">
                        <i class="fas fa-sign-in-alt me-2"></i> Masuk sebagai Admin
                    </x-primary-button>
                </div>
            </form>
        </div>

        <!-- FORM PETUGAS -->
        <div class="tab-pane fade" id="petugas-login" role="tabpanel">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="hidden" name="role_type" value="petugas">
                
                <div class="mt-3">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-3 w-full justify-center bg-success">
                        <i class="fas fa-sign-in-alt me-2"></i> Masuk sebagai Petugas
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-4 text-center">
        <small class="text-muted">
            <i class="fas fa-info-circle me-1"></i>
            Siswa dapat melihat riwayat kunjungan melalui form khusus (akan tersedia di halaman utama)
        </small>
    </div>
</x-guest-layout>