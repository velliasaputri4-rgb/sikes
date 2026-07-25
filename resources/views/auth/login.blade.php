<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 class="fw-bold text-primary">SIKES</h2>
        <p class="text-muted small">Sistem Informasi Unit Kesehatan Sekolah</p>
    </div>

    <!-- Tab Navigasi -->
    <ul class="nav nav-pills nav-justified mb-4" id="loginTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="staff-tab" data-bs-toggle="pill" data-bs-target="#staff-login" type="button">Petugas / Admin</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="student-tab" data-bs-toggle="pill" data-bs-target="#student-login" type="button">Siswa</button>
        </li>
    </ul>

    <div class="tab-content">
        <!-- FORM STAFF (Email & Password) -->
        <div class="tab-pane fade show active" id="staff-login" role="tabpanel">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email -->
                <div class="mt-3">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-3 w-full justify-center">
                        {{ __('Masuk') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

        <!-- FORM SISWA (NIS & Tanggal Lahir) -->
        <div class="tab-pane fade" id="student-login" role="tabpanel">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="hidden" name="login_type" value="student">
                
                <!-- NIS -->
                <div class="mt-3">
                    <x-input-label for="nis" value="NIS (Nomor Induk Siswa)" />
                    <x-text-input id="nis" class="block mt-1 w-full" type="text" name="nis" :value="old('nis')" required autofocus />
                    <x-input-error :messages="$errors->get('nis')" class="mt-2" />
                </div>

                <!-- Tanggal Lahir -->
                <div class="mt-4">
                    <x-input-label for="birth_date" value="Tanggal Lahir" />
                    <x-text-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" :value="old('birth_date')" required />
                    <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-3 w-full justify-center bg-success">
                        Masuk Sebagai Siswa
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>