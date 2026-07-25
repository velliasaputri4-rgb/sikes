<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\Student; // Import Model Student

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Jika login sebagai siswa (ada input NIS)
        if ($this->has('nis')) {
            return [
                'nis' => ['required', 'string'],
                'birth_date' => ['required', 'date'],
            ];
        }

        // Login standar (Admin/Petugas/Super Admin)
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // === LOGIC LOGIN SISWA (NIS + TANGGAL LAHIR) ===
        if ($this->has('nis')) {
            $student = Student::where('nis', $this->nis)->first();

            if (!$student || $student->birth_date != $this->birth_date) {
                RateLimiter::hit($this->throttleKey());
                throw ValidationException::withMessages([
                    'nis' => 'NIS atau Tanggal Lahir tidak sesuai.',
                ]);
            }

            // Login menggunakan user_id milik siswa
            Auth::login($student->user, $this->boolean('remember'));
            RateLimiter::clear($this->throttleKey());
            return;
        }

        // === LOGIC LOGIN STANDAR (EMAIL + PASSWORD) ===
        if (!Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        // Cek status user (aktif/nonaktif)
        if (Auth::user()->status !== 'active') {
            Auth::logout();
            throw ValidationException::withMessages([
                'email' => 'Akun Anda telah dinonaktifkan.',
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}