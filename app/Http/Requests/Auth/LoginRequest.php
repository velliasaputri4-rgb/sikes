<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\Student;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // 1. Jika login sebagai siswa, validasi NIS dan Tanggal Lahir
        if ($this->has('nis')) {
            return [
                'nis' => ['required', 'string'],
                'birth_date' => ['required', 'date'],
            ];
        }

        // 2. Jika login sebagai Staff, validasi Email dan Password
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

            if (!$student) {
                RateLimiter::hit($this->throttleKey());
                throw ValidationException::withMessages([
                    'nis' => 'NIS atau Tanggal Lahir tidak sesuai.',
                ]);
            }

            // Format tanggal dari database (Y-m-d)
            $dbBirthDate = $student->birth_date->format('Y-m-d');
            
            // Format tanggal dari input (HTML date input selalu Y-m-d, tapi kita parse untuk jaga-jaga)
            $inputBirthDate = \Carbon\Carbon::parse($this->birth_date)->format('Y-m-d');

            if ($dbBirthDate !== $inputBirthDate) {
                RateLimiter::hit($this->throttleKey());
                throw ValidationException::withMessages([
                    'nis' => 'NIS atau Tanggal Lahir tidak sesuai.',
                ]);
            }

            // Login berhasil menggunakan akun user milik siswa
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
        // Gunakan NIS jika ada, jika tidak gunakan email
        $identifier = $this->has('nis') ? $this->string('nis') : $this->string('email');
        return Str::transliterate(Str::lower($identifier) . '|' . $this->ip());
    }
}