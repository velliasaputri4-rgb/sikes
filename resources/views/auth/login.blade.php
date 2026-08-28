<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIKES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            /* Palet "Biru Profesional": Tegas, Profesional, Terpercaya */
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

        /* ✅ LOGO TANPA LATAR BELAKANG KOTAK/CIRCLE */
        .logo-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }
        .logo-wrapper img {
            max-width: 150px; /* Ukuran maksimal agar proporsional */
            height: auto;
            object-fit: contain;
            transition: transform 0.3s ease;
        }
        .logo-wrapper img:hover {
            transform: scale(1.05); /* Efek hover halus langsung pada logo */
        }

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

        .role-tabs {
            display: flex;
            background: #f1f5f9;
            border-radius: 12px;
            padding: 4px;
            gap: 3px;
            margin: 18px 0;
            border: 1px solid rgba(30, 58, 138, 0.05);
        }
        .role-tab {
            flex: 1;
            border: none;
            background: transparent;
            padding: 9px 6px;
            border-radius: 9px;
            font-weight: 700;
            font-size: 12px;
            color: var(--slate);
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            letter-spacing: 0.2px;
        }
        .role-tab:hover:not(.active-admin):not(.active-petugas) {
            color: var(--ink);
            background: rgba(255,255,255,0.6);
        }
        .role-tab.active-admin,
        .role-tab.active-petugas {
            background: var(--gradient-primary);
            color: white;
            box-shadow: 0 6px 18px rgba(30, 58, 138, 0.3);
            transform: translateY(-1px);
        }
        .role-tab i { font-size: 11px; }

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

        .toggle-pass {
            position: absolute;
            right: 12px; top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--muted);
            cursor: pointer;
            padding: 3px;
            transition: color 0.2s;
        }
        .toggle-pass:hover { color: var(--primary); }

        .form-check-input {
            width: 15px; height: 15px;
            cursor: pointer;
            border: 2px solid #cbd5e1;
        }
        .form-check-label {
            font-size: 12.5px;
            color: var(--slate);
            cursor: pointer;
            font-weight: 500;
        }
        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        .form-check-input:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

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
        }
        .btn-login.gold,
        .btn-login.blue {
            background: var(--gradient-primary);
            box-shadow: 0 8px 22px rgba(30, 58, 138, 0.3);
        }
        .btn-login.gold:hover,
        .btn-login.blue:hover {
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

        .siswa-note {
            background: linear-gradient(135deg, #f6f9fc, #eef3fb);
            border: 1px solid rgba(30, 58, 138, 0.12);
            border-radius: 11px;
            padding: 10px 14px;
            font-size: 12px;
            color: var(--slate);
            margin-top: 16px !important;
            font-weight: 500;
        }
        .siswa-note i { color: var(--primary); }
        .siswa-note a {
            color: var(--pro);
            font-weight: 700;
            text-decoration: none;
            transition: color 0.2s;
        }
        .siswa-note a:hover { color: var(--pro-light); }

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
            .role-tab { font-size: 11px; padding: 8px 4px; }
            /* ✅ Penyesuaian ukuran logo di mobile agar tetap proporsional */
            .logo-wrapper img { max-width: 120px; }
        }
    </style>
</head>
<body>

    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>

    <div class="login-card">
        {{-- Logo Tanpa Background/Circle --}}
        <div class="logo-wrapper">
            <img src="{{ asset('images/logo sikes navbar.png') }}" alt="Logo SIKES">
        </div>

        <div class="text-center">
            <h3 class="login-title mb-1">Welcome to <span class="gradient-text">SIKES</span></h3>
            <p class="login-subtitle">Masuk ke Sistem Informasi UKS</p>
        </div>

        {{-- TAB PILIHAN ROLE --}}
        <div class="role-tabs">
            <button type="button" id="tabAdmin" class="role-tab active-admin" onclick="switchRole('admin')">
                <i class="fas fa-user-shield"></i> Admin
            </button>
            <button type="button" id="tabPetugas" class="role-tab" onclick="switchRole('petugas')">
                <i class="fas fa-user-nurse"></i> Petugas UKS
            </button>
        </div>

        {{-- Error --}}
        @if($errors->any())
            <div class="alert-error">
                <i class="fas fa-exclamation-circle"></i>
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Form Login --}}
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-icon">
                    <i class="fas fa-envelope"></i>
                    <input id="email" type="email" class="form-control" name="email"
                           value="{{ old('email') }}" placeholder="nama@sikes.com" required autofocus>
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-icon">
                    <i class="fas fa-lock"></i>
                    <input id="password" type="password" class="form-control" name="password"
                           placeholder="••••••••" required>
                    <button type="button" class="toggle-pass" onclick="togglePassword()" tabindex="-1">
                        <i class="fas fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Ingat saya</label>
                </div>
                <a href="{{ route('landing') }}" class="link-home">
                    <i class="fas fa-arrow-left"></i> Beranda
                </a>
            </div>

            <button type="submit" id="btnSubmit" class="btn-login gold">
                <i class="fas fa-sign-in-alt"></i><span id="btnLabel">Masuk sebagai Admin</span>
            </button>
        </form>

        {{-- Catatan siswa --}}
        <div class="siswa-note text-center">
            <i class="fas fa-info-circle me-1"></i>
            Siswa? Lihat riwayat melalui <a href="{{ route('login.siswa') }}">form khusus siswa</a>
        </div>
    </div>

    <script>
        function switchRole(role) {
            const tabAdmin = document.getElementById('tabAdmin');
            const tabPetugas = document.getElementById('tabPetugas');
            const btn = document.getElementById('btnSubmit');
            const label = document.getElementById('btnLabel');

            if (role === 'admin') {
                tabAdmin.className = 'role-tab active-admin';
                tabPetugas.className = 'role-tab';
                btn.className = 'btn-login gold';
                label.textContent = 'Masuk sebagai Admin';
            } else {
                tabAdmin.className = 'role-tab';
                tabPetugas.className = 'role-tab active-petugas';
                btn.className = 'btn-login blue';
                label.textContent = 'Masuk sebagai Petugas';
            }
        }

        function togglePassword() {
            const p = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            if (p.type === 'password') {
                p.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                p.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
</html>