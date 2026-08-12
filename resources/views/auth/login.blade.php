<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIKES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --gold: #f59e0b;
            --gold-dark: #d97706;
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
            background: rgba(245, 158, 11, 0.08);
            top: -100px; right: -100px;
        }
        body::after {
            width: 260px; height: 260px;
            background: rgba(59, 130, 246, 0.1);
            bottom: -80px; left: -80px;
        }

        /* ✅ CARD DIPERKECIL */
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

        /* ✅ LOGO DIPERKECIL */
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

        /* ✅ FONT JUDUL DIPERKECIL */
        .login-title { font-weight: 800; color: var(--navy-900); font-size: 1.3rem; letter-spacing: 0.5px; }
        .login-subtitle { color: #64748b; font-size: 12.5px; }

        /* ✅ TAB PILIHAN ROLE DIPERKECIL */
        .role-tabs {
            display: flex;
            background: #f1f5f9;
            border-radius: 10px;
            padding: 4px;
            gap: 4px;
            margin: 16px 0 18px;
        }
        .role-tab {
            flex: 1;
            border: none;
            background: transparent;
            padding: 9px 8px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 13px;
            color: #64748b;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
        .role-tab:hover { color: #1e293b; }
        .role-tab.active-admin {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            box-shadow: 0 5px 14px rgba(245, 158, 11, 0.35);
        }
        .role-tab.active-petugas {
            background: linear-gradient(135deg, #1e3a8a, #2563eb);
            color: white;
            box-shadow: 0 5px 14px rgba(37, 99, 235, 0.35);
        }
        .role-tab i { font-size: 12px; }

        /* ✅ FORM DIPERKECIL */
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
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.15);
        }
        .toggle-pass {
            position: absolute;
            right: 12px; top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
        }
        .toggle-pass:hover { color: var(--navy-800); }

        .form-check-input {
            width: 14px; height: 14px;
        }
        .form-check-label {
            font-size: 12.5px;
        }
        .form-check-input:checked {
            background-color: var(--gold);
            border-color: var(--gold);
        }

        /* ✅ TOMBOL SUBMIT DIPERKECIL */
        .btn-login {
            width: 100%;
            border: none;
            color: white;
            font-weight: 700;
            padding: 10px;
            border-radius: 9px;
            font-size: 14px;
            letter-spacing: 0.3px;
            transition: all 0.2s ease;
        }
        .btn-login:hover { transform: translateY(-2px); color: white; }
        .btn-login.gold {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            box-shadow: 0 6px 16px rgba(245, 158, 11, 0.35);
        }
        .btn-login.gold:hover { box-shadow: 0 10px 22px rgba(245, 158, 11, 0.5); }
        .btn-login.blue {
            background: linear-gradient(135deg, #1e3a8a, #2563eb);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.35);
        }
        .btn-login.blue:hover { box-shadow: 0 10px 22px rgba(37, 99, 235, 0.5); }

        .link-home { color: #64748b; text-decoration: none; font-size: 12.5px; font-weight: 600; }
        .link-home:hover { color: var(--gold); }

        .siswa-note {
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 11.5px;
            color: #64748b;
            margin-top: 16px !important;
        }
        .siswa-note a { color: var(--primary); font-weight: 700; text-decoration: none; }
        .siswa-note a:hover { color: var(--primary-dark); }
        
        .mb-3 { margin-bottom: 12px !important; }
    </style>
</head>
<body>

    <div class="login-card">
        {{-- Logo --}}
        <div class="logo-circle">
            <i class="fas fa-heartbeat"></i>
        </div>

        <div class="text-center">
            <h3 class="login-title mb-1">SIKES</h3>
            <p class="login-subtitle mb-0">Sistem Informasi Unit Kesehatan Sekolah</p>
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
            <div class="alert alert-danger py-2 px-3 mb-3" style="font-size: 12px; border-radius: 9px;">
                <i class="fas fa-exclamation-circle me-1"></i>
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
                    <label class="form-check-label text-muted" for="remember">Ingat saya</label>
                </div>
                <a href="{{ route('landing') }}" class="link-home">
                    <i class="fas fa-arrow-left me-1"></i> Beranda
                </a>
            </div>

            {{-- Tombol berubah sesuai tab --}}
            <button type="submit" id="btnSubmit" class="btn-login gold">
                <i class="fas fa-sign-in-alt me-2"></i><span id="btnLabel">Masuk sebagai Admin</span>
            </button>
        </form>

        {{-- Catatan siswa --}}
        <div class="siswa-note text-center">
            <i class="fas fa-info-circle me-1"></i>
            Siswa? Lihat riwayat melalui <a href="{{ route('login.siswa') }}">form khusus</a>
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