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
            /* ✅ TEMA MERAH (PMR/UKS) untuk elemen foreground */
            --primary: #ef4444;
            --primary-dark: #991b1b;
            --secondary: #dc2626;
            --pro: #991b1b;
            --pro-light: #ef4444;
            --ink: #0f172a;
            --slate: #475569;
            --muted: #cbd5e1;
            --gradient-primary: linear-gradient(135deg, #991b1b 0%, #ef4444 100%);
        }

        * { -webkit-font-smoothing: antialiased; }

        body {
            min-height: 100vh;
            display: flex;
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            position: relative;
            overflow-x: hidden;
            padding: 40px 16px;
            color: #ffffff;
            margin: 0;

            /* ✅ PERUBAHAN: Background Gambar dengan Overlay Gelap Netral (TANPA MERAH) */
            background: 
                linear-gradient(135deg, rgba(15, 23, 42, 0.85) 0%, rgba(30, 41, 59, 0.85) 100%),
                url('/images/login.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* ✅ PERUBAHAN: Overlay tambahan netral (highlight putih sangat halus) agar teks tetap terbaca */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: radial-gradient(circle at 20% 30%, rgba(255, 255, 255, 0.05) 0%, transparent 50%),
                        radial-gradient(circle at 80% 70%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
            z-index: 0;
            pointer-events: none;
        }

        .login-card {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 380px;
            margin: auto;

            /* ✅ Card Transparan dengan Glassmorphism */
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 32px 28px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35), 
                        inset 0 1px 0 rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.25);
            animation: fadeUp 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(25px) scale(0.98); }
            to { opacity: 1; transform: none; }
        }

        .logo-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }
        .logo-wrapper img {
            max-width: 150px;
            height: auto;
            object-fit: contain;
            transition: transform 0.3s ease;
            filter: drop-shadow(0 4px 12px rgba(0,0,0,0.3));
        }
        .logo-wrapper img:hover {
            transform: scale(1.05);
        }

        .login-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            color: #ffffff;
            font-size: 1.35rem;
            letter-spacing: -0.5px;
            margin-bottom: 2px;
            text-shadow: 0 2px 8px rgba(0,0,0,0.3);
        }
        .login-title .gradient-text {
            /* ✅ Gradient teks merah muda ke putih (tetap dipertahankan untuk branding) */
            background: linear-gradient(135deg, #fca5a5 0%, #ffffff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .login-subtitle {
            color: rgba(255, 255, 255, 0.85);
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 0;
        }

        .form-label {
            font-weight: 700;
            font-size: 12.5px;
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 6px;
            letter-spacing: 0.1px;
        }
        .input-icon { position: relative; }
        .input-icon > i {
            position: absolute;
            left: 13px; top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.6);
            font-size: 13px;
            transition: color 0.2s;
            z-index: 2;
        }
        .input-icon .form-control { padding-left: 38px; }
        .form-control {
            border-radius: 11px;
            padding: 10px 13px;
            border: 2px solid rgba(255, 255, 255, 0.25);
            font-size: 13.5px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all 0.3s;
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
        }
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        .form-control:focus {
            border-color: rgba(252, 165, 165, 0.8);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.25); /* Focus tetap merah sebagai feedback */
            color: #ffffff;
        }
        .input-icon:focus-within > i:first-child { color: #fca5a5; }

        .toggle-pass {
            position: absolute;
            right: 12px; top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
            padding: 3px;
            transition: color 0.2s;
            z-index: 2;
        }
        .toggle-pass:hover { color: #ffffff; }

        .form-check-input {
            width: 15px; height: 15px;
            cursor: pointer;
            border: 2px solid rgba(255, 255, 255, 0.4);
            background: rgba(255, 255, 255, 0.1);
        }
        .form-check-label {
            font-size: 12.5px;
            color: rgba(255, 255, 255, 0.9);
            cursor: pointer;
            font-weight: 500;
        }
        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        .form-check-input:focus {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.3);
        }

        .btn-login {
            width: 100%;
            border: none;
            color: white;
            font-weight: 700;
            padding: 12px;
            border-radius: 11px;
            font-size: 14px;
            letter-spacing: 0.3px;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            position: relative;
            overflow: hidden;
            margin-top: 8px;
            background: var(--gradient-primary);
            box-shadow: 0 8px 22px rgba(153, 27, 27, 0.5);
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
            box-shadow: 0 12px 30px rgba(239, 68, 68, 0.6);
        }

        .link-home {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-size: 12.5px;
            font-weight: 600;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .link-home:hover {
            color: #fca5a5;
            transform: translateX(-3px);
        }

        .siswa-note {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 11px;
            padding: 10px 14px;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.9);
            margin-top: 20px !important;
            font-weight: 500;
        }
        .siswa-note i { color: #fca5a5; }
        .siswa-note a {
            color: #ffffff;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.2s;
        }
        .siswa-note a:hover { color: #fca5a5; }

        .mb-3 { margin-bottom: 14px !important; }

        .alert-error {
            background: rgba(254, 226, 226, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(252, 165, 165, 0.4);
            color: #fecaca;
            padding: 10px 12px;
            border-radius: 10px;
            font-size: 12.5px;
            font-weight: 600;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        @media (max-width: 480px) {
            body { padding: 24px 14px; }
            .login-card { padding: 24px 20px; border-radius: 16px; }
            .login-title { font-size: 1.2rem; }
            .logo-wrapper img { max-width: 120px; }
        }
    </style>
</head>
<body>

    <div class="login-card">
        
        <div class="logo-wrapper">
            <img src="<?php echo e(asset('images/logo sikes navbar.png')); ?>" alt="Logo SIKES">
        </div>

        <div class="text-center mb-4">
            <h3 class="login-title mb-1">Welcome to <span class="gradient-text">SIKES</span></h3>
            <p class="login-subtitle">Masuk ke Dashboard Sistem Informasi UKS</p>
        </div>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
            <div class="alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <?php echo e($errors->first()); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-icon">
                    <i class="fas fa-envelope"></i>
                    <input id="email" type="email" class="form-control" name="email"
                           value="<?php echo e(old('email')); ?>" placeholder="nama@sikes.com" required autofocus>
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
                <a href="<?php echo e(route('landing')); ?>" class="link-home">
                    <i class="fas fa-arrow-left"></i> Beranda
                </a>
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i> Masuk ke Dashboard
            </button>
        </form>

        
        <div class="siswa-note text-center">
            <i class="fas fa-info-circle me-1"></i>
            Siswa? Lihat riwayat melalui <a href="<?php echo e(route('login.siswa')); ?>">form khusus siswa</a>
        </div>
    </div>

    <script>
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
</html><?php /**PATH C:\laragon\www\sikes\resources\views/auth/login.blade.php ENDPATH**/ ?>