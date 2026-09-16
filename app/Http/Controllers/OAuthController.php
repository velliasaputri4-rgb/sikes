<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class OAuthController extends Controller
{
    /**
     * Menerima kiriman pengguna dari Portal SiPintu Gateway via SSO
     */
    public function callback(Request $request)
    {
        // 1. Tangkap authorization code dari SiPintu Gateway
        $code = $request->input('code');

        if (! $code) {
            return redirect()->route('login')->with('error', 'Otorisasi SSO SiPintu gagal: Kode otorisasi tidak ditemukan.');
        }

        $baseUrl      = rtrim(config('services.sipintu.base_url', env('SIPINTU_BASE_URL', 'http://localhost:8000')), '/');
        $clientId     = config('services.sipintu.client_id', env('SIPINTU_CLIENT_ID'));
        $clientSecret = config('services.sipintu.client_secret', env('SIPINTU_CLIENT_SECRET'));
        $redirectUri  = config('services.sipintu.redirect_uri', env('SIPINTU_REDIRECT_URI'));

        // 2. Tukar authorization code dengan Access Token (Server-to-Server)
        try {
            $tokenResponse = Http::asForm()->acceptJson()->post("{$baseUrl}/oauth/token", [
                'grant_type'    => 'authorization_code',
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
                'redirect_uri'  => $redirectUri,
                'code'          => $code,
            ]);
        } catch (\Throwable $e) {
            return redirect()->route('login')->with('error', 'Tidak dapat menghubungi server SiPintu Gateway: ' . $e->getMessage());
        }

        if ($tokenResponse->failed()) {
            $errorMsg = $tokenResponse->json('error_description') ?? $tokenResponse->json('message') ?? 'Gagal memverifikasi token ke SiPintu Gateway.';
            return redirect()->route('login')->with('error', $errorMsg);
        }

        $accessToken = $tokenResponse->json('access_token');

        // 3. Ambil data profil siswa / pengguna dari endpoint SiPintu Gateway
        try {
            $userResponse = Http::withToken($accessToken)
                ->acceptJson()
                ->get("{$baseUrl}/api/v1/user");
        } catch (\Throwable $e) {
            return redirect()->route('login')->with('error', 'Gagal menghubungi endpoint pengguna SiPintu Gateway.');
        }

        if ($userResponse->failed()) {
            return redirect()->route('login')->with('error', 'Gagal mengambil data akun dari SiPintu Gateway.');
        }

        $sipintuUser = $userResponse->json('data') ?? $userResponse->json();

        $externalId = $sipintuUser['external_id'] ?? $sipintuUser['nis'] ?? null;
        $email      = $sipintuUser['email'] ?? null;
        $rawRole    = strtolower($sipintuUser['role'] ?? 'student');

        // Petakan role SiPintu ke role lokal SIKES
        $mappedRole = match ($rawRole) {
            'admin', 'super-admin'       => 'admin',
            'teacher', 'guru', 'petugas' => 'petugas',
            default                      => 'siswa',
        };

        // 4. Cocokkan dengan data user yang SUDAH ADA di database lokal SIKES
        $user = null;
        if ($externalId) {
            $user = User::where('external_id', $externalId)->first();
        }

        if (! $user && $email) {
            $user = User::where('email', $email)->first();
        }

        // Cari juga melalui NIS di tabel Student
        if (! $user && $externalId) {
            $student = Student::where('nis', $externalId)->first();
            if ($student && $student->user_id) {
                $user = User::find($student->user_id);
            }
        }

        $syncTime = now();

        // 5. Auto-provisioning jika user belum ada
        if (! $user) {
            $user = User::create([
                'name'                   => $sipintuUser['name'] ?? 'User',
                'email'                  => $email ?? ($externalId . '@sikes.sch.id'),
                'external_id'            => $externalId,
                'phone'                  => $sipintuUser['phone'] ?? null,
                'status'                 => $sipintuUser['status'] ?? 'active',
                'password'               => $sipintuUser['password'] ?? bcrypt(Str::random(24)),
                'email_verified_at'      => now(),
                'sipintu_last_synced_at' => $syncTime,
            ]);

            $user->assignRole($mappedRole);
        } else {
            // Update info esensial & sinkronisasi password hash dari SiPintu
            $updateData = [
                'sipintu_last_synced_at' => $syncTime,
            ];

            if ($externalId && empty($user->external_id)) {
                $updateData['external_id'] = $externalId;
            }

            if (! empty($sipintuUser['password'])) {
                $updateData['password'] = $sipintuUser['password'];
            }

            if (! empty($sipintuUser['status'])) {
                $updateData['status'] = $sipintuUser['status'];
            }

            $user->update($updateData);

            if (! $user->hasRole($mappedRole)) {
                $user->syncRoles([$mappedRole]);
            }
        }

        // 6. Pastikan relasi Student terhubung jika user adalah role siswa
        if ($user->hasRole('siswa')) {
            $student = Student::where('user_id', $user->id)
                ->when($externalId, fn ($q) => $q->orWhere('nis', $externalId))
                ->first();

            if ($student) {
                if ($student->user_id !== $user->id) {
                    $student->user_id = $user->id;
                }
                if ($externalId && empty($student->nis)) {
                    $student->nis = $externalId;
                }
                $student->save();
            } else {
                $classroom = ClassRoom::first();
                Student::create([
                    'user_id'      => $user->id,
                    'classroom_id' => $classroom ? $classroom->id : 1,
                    'nis'          => $externalId ?? (string) $user->id,
                    'full_name'    => $user->name,
                    'birth_date'   => '2008-01-01',
                    'parent_phone' => $user->phone,
                ]);
            }
        }

        // 7. Autentikasikan sesi lokal & arahkan ke dashboard
        Auth::login($user, true);
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'))->with('success', "Selamat datang kembali, {$user->name}!");
    }

    /**
     * Webhook Sinkronisasi Real-Time & Smart Conflict Resolution dari SiPintu Gateway
     */
    public function syncUser(Request $request)
    {
        // 1. Verifikasi Signature HMAC SHA-256
        $signature = $request->header('X-SiPintu-Signature');
        $secret    = config('services.sipintu.client_secret', env('SIPINTU_CLIENT_SECRET'));

        if ($secret && (! $signature || ! hash_equals(hash_hmac('sha256', $request->getContent(), $secret), $signature))) {
            return response()->json(['status' => 'error', 'message' => 'Invalid signature.'], 401);
        }

        // Tangani diagnostik ping SiPintu
        if ($request->input('ping')) {
            return response()->json(['status' => 'success', 'message' => 'pong']);
        }

        $userData = $request->input('user') ?? $request->all();
        $previous = $request->input('previous', []);

        $externalId = $userData['external_id'] ?? $userData['nis'] ?? null;
        $email      = $userData['email'] ?? null;
        $prevEmail  = $previous['email'] ?? null;

        // 2. Cari User lokal
        $user = User::query()
            ->when($externalId, fn ($q) => $q->where('external_id', $externalId))
            ->orWhere('email', $email)
            ->when($prevEmail, fn ($q) => $q->orWhere('email', $prevEmail))
            ->first();

        if (! $user && $externalId) {
            $student = Student::where('nis', $externalId)->first();
            if ($student && $student->user_id) {
                $user = User::find($student->user_id);
            }
        }

        $syncTime = now();
        $rawRole  = strtolower($userData['role'] ?? 'student');
        $mappedRole = match ($rawRole) {
            'admin', 'super-admin'       => 'admin',
            'teacher', 'guru', 'petugas' => 'petugas',
            default                      => 'siswa',
        };

        // 3. Jika user belum ada: Auto-provisioning akun baru
        if (! $user) {
            $user = User::create([
                'name'                   => $userData['name'] ?? 'User',
                'email'                  => $email ?? ($externalId . '@sikes.sch.id'),
                'external_id'            => $externalId,
                'phone'                  => $userData['phone'] ?? null,
                'status'                 => $userData['status'] ?? 'active',
                'password'               => $userData['password'] ?? bcrypt(Str::random(24)),
                'sipintu_last_synced_at' => $syncTime,
            ]);

            $user->assignRole($mappedRole);

            if ($mappedRole === 'siswa') {
                $classroom = ClassRoom::first();
                Student::create([
                    'user_id'      => $user->id,
                    'classroom_id' => $classroom ? $classroom->id : 1,
                    'nis'          => $externalId ?? (string) $user->id,
                    'full_name'    => $user->name,
                    'birth_date'   => '2008-01-01',
                    'parent_phone' => $user->phone,
                ]);
            }

            return response()->json([
                'status'  => 'success',
                'action'  => 'created',
                'user_id' => $user->id,
            ]);
        }

        // 4. Smart Conflict Resolution: Deteksi perubahan lokal pengguna
        $hasLocalEdits = $user->sipintu_last_synced_at !== null && $user->updated_at->gt($user->sipintu_last_synced_at);

        // Field Selalu Mengikuti SiPintu (Single Source of Truth)
        if ($email) {
            $user->email = $email;
        }
        if ($externalId) {
            $user->external_id = $externalId;
        }
        if (! empty($userData['status'])) {
            $user->status = $userData['status'];
        }
        if (! empty($userData['password'])) {
            $user->password = $userData['password'];
        }

        $user->syncRoles([$mappedRole]);

        // Field Lokal: Hanya ditimpa jika TIDAK ADA perubahan lokal oleh user
        if (! $hasLocalEdits) {
            if (isset($userData['name'])) {
                $user->name = $userData['name'];
            }
            if (isset($userData['phone'])) {
                $user->phone = $userData['phone'];
            }
        }

        // 5. Update & Selaraskan Timestamp
        $user->sipintu_last_synced_at = $syncTime;
        $user->updated_at             = $syncTime;
        $user->save();

        // Selaraskan relasi data Student
        if ($user->hasRole('siswa')) {
            $student = Student::where('user_id', $user->id)->first();
            if ($student) {
                if (! $hasLocalEdits && isset($userData['name'])) {
                    $student->full_name = $userData['name'];
                }
                if ($externalId && empty($student->nis)) {
                    $student->nis = $externalId;
                }
                $student->save();
            } else {
                $classroom = ClassRoom::first();
                Student::create([
                    'user_id'      => $user->id,
                    'classroom_id' => $classroom ? $classroom->id : 1,
                    'nis'          => $externalId ?? (string) $user->id,
                    'full_name'    => $user->name,
                    'birth_date'   => '2008-01-01',
                    'parent_phone' => $user->phone,
                ]);
            }
        }

        return response()->json([
            'status'  => 'success',
            'action'  => 'updated',
            'user_id' => $user->id,
        ]);
    }

    /**
     * Logout dari sesi lokal aplikasi downstream
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('info', 'Anda telah keluar dari aplikasi.');
    }
}
