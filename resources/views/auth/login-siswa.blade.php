<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa - SIKES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            /* Palet "Biru Profesional" - konsisten seluruh website */
            --primary: #3b82f6;
            --primary-dark: #1e3a8a;
            --secondary: #2563eb;
            --pro: #1e3a8a;
            --pro-light: #3b82f6;
            --ink: #0f172a;
            --slate: #475569;
            --muted: #94a3b8;
            --gradient-primary: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            --gradient-light: linear-gradient(180deg, #f7fafc 0%, #edf2fa 100%);
        }

        * { -webkit-font-smoothing: antialiased; }

        body {
            min-height: 100vh;
            display: flex;
            background: var(--gradient-light);
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            position: relative;
            overflow-x: hidden;
            padding: 40px 16px;
            color: var(--ink);
        }

        .blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            z-index: 0;
            pointer-events: none;
        }
        .blob-1 { width: 420px; height: 420px; background: #1e3a8a; top: -120px; left: -120px; animation: float1 22s ease-in-out infinite; opacity: 0.22; }
        .blob-2 { width: 380px; height: 380px; background: #3b82f6; top: 50%; right: -100px; animation: float2 28s ease-in-out infinite; opacity: 0.18; }
        .blob-3 { width: 300px; height: 300px; background: #2563eb; bottom: -100px; left: 30%; animation: float1 30s ease-in-out infinite reverse; opacity: 0.15; }
        @keyframes float1 { 0%,100% { transform: translate(0,0) scale(1); } 50% { transform: translate(60px,-40px) scale(1.1); } }
        @keyframes float2 { 0%,100% { transform: translate(0,0) scale(1); } 50% { transform: translate(-50px,50px) scale(0.9); } }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: radial-gradient(circle, rgba(30,58,138,0.06) 1px, transparent 1px);
            background-size: 28px 28px;
            z-index: 0;
            pointer-events: none;
        }

        .login-card {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 380px;
            margin: auto;
            background: white;
            border-radius: 20px;
            padding: 26px 24px;
            box-shadow: 0 25px 60px rgba(30, 58, 138, 0.14);
            border: 1px solid rgba(30, 58, 138, 0.08);
            animation: fadeUp 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(25px) scale(0.98); }
            to { opacity: 1; transform: none; }
        }

        .logo-circle {
            width: 60px; height: 60px;
            border-radius: 18px;
            background: var(--gradient-primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin: 0 auto 14px;
            box-shadow: 0 12px 28px rgba(30, 58, 138, 0.3);
            position: relative;
            transition: transform 0.3s;
        }
        .logo-circle::before {
            content: '';
            position: absolute;
            inset: -7px;
            border-radius: 22px;
            background: var(--gradient-primary);
            opacity: 0.18;
            z-index: -1;
        }
        .logo-circle:hover { transform: rotate(-6deg) scale(1.05); }

        .login-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            color: var(--ink);
            font-size: 1.35rem;
            letter-spacing: -0.5px;
            margin-bottom: 2px;
        }
        .login-title .gradient-text {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .login-subtitle {
            color: var(--slate);
            font-size: 12.5px;
            font-weight: 500;
            margin-bottom: 0;
        }

        .form-label {
            font-weight: 700;
            font-size: 12.5px;
            color: var(--ink);
            margin-bottom: 6px;
            letter-spacing: 0.1px;
        }
        .input-icon { position: relative; }
        .input-icon > i {
            position: absolute;
            left: 13px; top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: 13px;
            transition: color 0.2s;
        }
        .input-icon .form-control { padding-left: 38px; }
        .form-control {
            border-radius: 11px;
            padding: 10px 13px;
            border: 2px solid #e2e8f0;
            font-size: 13.5px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all 0.3s;
            background: white;
        }
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12);
        }
        .input-icon:focus-within > i:first-child { color: var(--primary); }

        .btn-login {
            width: 100%;
            border: none;
            color: white;
            font-weight: 700;
            padding: 11px;
            border-radius: 11px;
            font-size: 13.5px;
            letter-spacing: 0.3px;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            position: relative;
            overflow: hidden;
            margin-top: 6px;
            background: var(--gradient-primary);
            box-shadow: 0 8px 22px rgba(30, 58, 138, 0.3);
        }
        .btn-login::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.25), transparent);
            transition: left 0.6s;
        }
        .btn-login:hover::before { left: 100%; }
        .btn-login:hover {
            transform: translateY(-2px);
            color: white;
            box-shadow: 0 12px 30px rgba(30, 58, 138, 0.45);
        }

        .link-home {
            color: var(--slate);
            text-decoration: none;
            font-size: 12.5px;
            font-weight: 600;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .link-home:hover {
            color: var(--primary);
            transform: translateX(-3px);
        }

        .mb-3 { margin-bottom: 12px !important; }

        .alert-error {
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            border: 1px solid #fca5a5;
            color: #991b1b;
            padding: 9px 12px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        @media (max-width: 480px) {
            body { padding: 24px 14px; }
            .login-card { padding: 22px 18px; border-radius: 16px; }
            .login-title { font-size: 1.2rem; }
            .logo-circle { width: 54px; height: 54px; font-size: 20px; }
        }
    </style>
</head>
<body>

    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>

    <div class="login-card">
        {{-- Logo siswa --}}
        <div class="logo-circle">
            <i class="fas fa-user-graduate"></i>
        </div>

        <div class="text-center">
            <h3 class="login-title mb-1">Cek <span class="gradient-text">Riwayat</span> Kunjungan</h3>
            <p class="login-subtitle">Masukkan NIS dan Tanggal Lahir untuk melihat riwayat</p>
        </div>

        {{-- Error --}}
        @if($errors->any())
            <div class="alert-error mt-3">
                <i class="fas fa-exclamation-circle"></i>
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Form Login Siswa --}}
        <form method="POST" action="{{ route('login') }}" class="mt-3">
            @csrf

            <div class="mb-3">
                <label for="nis" class="form-label">NIS (Nomor Induk Siswa)</label>
                <div class="input-icon">
                    <i class="fas fa-id-card"></i>
                    <input id="nis" type="text" class="form-control @error('nis') is-invalid @enderror"
                           name="nis" required autofocus placeholder="Masukkan NIS Anda" value="{{ old('nis') }}">
                </div>
                @error('nis')
                    <div class="text-danger" style="font-size: 11.5px; margin-top: 4px;">{{ $message }}</div>
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
                    <div class="text-danger" style="font-size: 11.5px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-search"></i> Lihat Riwayat
            </button>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('landing') }}" class="link-home">
                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>
    </div>

</body>
</html>