<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\Student;
use Carbon\Carbon;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Jika ada input 'nis', berarti ini login siswa
        if ($this->has('nis')) {
            return [
                'nis' => ['required', 'string'],
                'birth_date' => ['required', 'date'],
            ];
        }

        // Jika tidak, berarti login Admin/Petugas (Email & Password)
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // === 1. LOGIC LOGIN SISWA (NIS + Tanggal Lahir) ===
        if ($this->has('nis') && $this->has('birth_date')) {
            $student = Student::where('nis', $this->nis)->first();

            if (!$student) {
                RateLimiter::hit($this->throttleKey());
                throw ValidationException::withMessages([
                    'nis' => 'NIS tidak terdaftar di sistem.',
                ]);
            }

            // Format tanggal dari input dan database agar sama (Y-m-d)
            $inputDate = Carbon::parse($this->birth_date)->format('Y-m-d');
            $dbDate = $student->birth_date->format('Y-m-d');

            if ($inputDate !== $dbDate) {
                RateLimiter::hit($this->throttleKey());
                throw ValidationException::withMessages([
                    'birth_date' => 'Tanggal lahir tidak sesuai dengan data kami.',
                ]);
            }

            // Jika cocok, login menggunakan akun User yang terhubung dengan Siswa ini
            Auth::login($student->user, $this->boolean('remember'));
            RateLimiter::clear($this->throttleKey());
            return;
        }

        // === 2. LOGIC LOGIN ADMIN / PETUGAS (Email + Password) ===
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
                'email' => 'Akun Anda telah dinonaktifkan oleh administrator.',
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
        // Gunakan NIS untuk rate limit siswa, atau Email untuk staff
        $identifier = $this->has('nis') ? $this->string('nis') : $this->string('email');
        return Str::transliterate(Str::lower($identifier) . '|' . $this->ip());
    }
}