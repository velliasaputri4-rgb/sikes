<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa - SIKES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --gold: #f59e0b;
            --navy-900: #0f172a;
            --navy-800: #1e293b;
            --primary: #2563eb;
            --primary-dark: #1e3a8a;
        }
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0c1324 0%, #1e293b 55%, #1e3a8a 100%);
            font-family: 'Segoe UI', system-ui, sans-serif;
            position: relative;
            overflow: hidden;
            padding: 16px;
        }
        body::before, body::after {
            content: '';
            position: absolute;
            border-radius: 50%;
        }
        body::before {
            width: 340px; height: 340px;
            background: rgba(59, 130, 246, 0.1);
            top: -100px; right: -100px;
        }
        body::after {
            width: 260px; height: 260px;
            background: rgba(245, 158, 11, 0.07);
            bottom: -80px; left: -80px;
        }

        .login-card {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 400px;
            background: white;
            border-radius: 18px;
            padding: 28px 26px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.4);
            animation: fadeUp 0.5s ease;
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(25px); }
            to { opacity: 1; transform: none; }
        }

        .logo-circle {
            width: 60px; height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0f172a, #1e293b);
            color: var(--gold);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin: 0 auto 12px;
            border: 2.5px solid rgba(245, 158, 11, 0.35);
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.3);
        }

        .login-title { font-weight: 800; color: var(--navy-900); font-size: 1.3rem; }
        .login-subtitle { color: #64748b; font-size: 12.5px; }

        .form-label { font-weight: 600; font-size: 12.5px; color: #334155; margin-bottom: 5px; }
        .input-icon { position: relative; }
        .input-icon > i {
            position: absolute;
            left: 12px; top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 13px;
        }
        .input-icon .form-control { padding-left: 36px; }
        .form-control {
            border-radius: 9px;
            padding: 9px 12px;
            border: 1.5px solid #e2e8f0;
            font-size: 14px;
        }
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        .btn-login {
            width: 100%;
            border: none;
            color: white;
            font-weight: 700;
            padding: 10px;
            border-radius: 9px;
            font-size: 14px;
            letter-spacing: 0.3px;
            background: linear-gradient(135deg, #1e3a8a, #2563eb);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.35);
            transition: all 0.2s ease;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            color: white;
            box-shadow: 0 10px 22px rgba(37, 99, 235, 0.5);
        }

        .link-home { color: #64748b; text-decoration: none; font-size: 12.5px; font-weight: 600; }
        .link-home:hover { color: var(--primary); }

        .staff-note {
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 11.5px;
            color: #64748b;
            margin-top: 16px;
        }
        .staff-note a { color: var(--gold); font-weight: 700; text-decoration: none; }
        .staff-note a:hover { color: #b45309; }

        .mb-3 { margin-bottom: 12px !important; }
        .error-text { font-size: 11.5px; margin-top: 4px; }
    </style>
</head>
<body>

    <div class="login-card">
        {{-- Logo siswa --}}
        <div class="logo-circle">
            <i class="fas fa-user-graduate"></i>
        </div>

        <div class="text-center">
            <h3 class="login-title mb-1">Cek Riwayat Kunjungan</h3>
            <p class="login-subtitle mb-0">Masukkan NIS dan Tanggal Lahir untuk melihat riwayat</p>
        </div>

        {{-- ✅ FORM TETAP SAMA (logika tidak berubah) --}}
        <form method="POST" action="{{ route('login') }}" class="mt-4">
            @csrf

            <div class="mb-3">
                <label for="nis" class="form-label">NIS (Nomor Induk Siswa)</label>
                <div class="input-icon">
                    <i class="fas fa-id-card"></i>
                    <input id="nis" type="text" class="form-control @error('nis') is-invalid @enderror"
                           name="nis" required autofocus placeholder="Masukkan NIS Anda" value="{{ old('nis') }}">
                </div>
                @error('nis')
                    <div class="text-danger error-text">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="birth_date" class="form-label">Tanggal Lahir</label>
                <div class="input-icon">
                    <i class="fas fa-cake-candles"></i>
                    <input id="birth_date" type="date" class="form-control @error('birth_date') is-invalid @enderror"
                           name="birth_date" required>
                </div>
                @error('birth_date')
                    <div class="text-danger error-text">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-login mt-1">
                <i class="fas fa-search me-2"></i> Lihat Riwayat
            </button>
        </form>

        {{-- Catatan petugas/admin --}}
        <div class="staff-note text-center">
            <i class="fas fa-user-nurse me-1"></i>
            Petugas / Admin? <a href="{{ route('login') }}">Masuk di sini</a>
        </div>

        <div class="text-center mt-3">
            <a href="{{ route('landing') }}" class="link-home">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda
            </a>
        </div>
    </div>

</body>
</html>