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

            /* ✅ Background Gambar dengan Overlay Samar */
            background: 
                linear-gradient(135deg, rgba(15, 23, 42, 0.65) 0%, rgba(30, 58, 138, 0.55) 50%, rgba(15, 23, 42, 0.7) 100%),
                url('/images/login.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* ✅ Overlay tambahan untuk memastikan teks tetap terbaca */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: radial-gradient(circle at 20% 30%, rgba(59, 130, 246, 0.15) 0%, transparent 50%),
                        radial-gradient(circle at 80% 70%, rgba(30, 58, 138, 0.2) 0%, transparent 50%);
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
            padding: 26px 24px;
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
            background: linear-gradient(135deg, #93c5fd 0%, #ffffff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .login-subtitle {
            color: rgba(255, 255, 255, 0.85);
            font-size: 12.5px;
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
            border-color: rgba(147, 197, 253, 0.8);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
            color: #ffffff;
        }
        .input-icon:focus-within > i:first-child { color: #93c5fd; }

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
            box-shadow: 0 8px 22px rgba(30, 58, 138, 0.5);
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
            box-shadow: 0 12px 30px rgba(59, 130, 246, 0.6);
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
            color: #93c5fd;
            transform: translateX(-3px);
        }

        .mb-3 { margin-bottom: 12px !important; }

        .alert-error {
            background: rgba(254, 226, 226, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(252, 165, 165, 0.4);
            color: #fecaca;
            padding: 9px 12px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* ✅ Perbaikan warna text-danger agar terlihat di background gelap */
        .text-danger {
            color: #fca5a5 !important;
            font-size: 11.5px;
            margin-top: 4px;
        }

        @media (max-width: 480px) {
            body { padding: 24px 14px; }
            .login-card { padding: 22px 18px; border-radius: 16px; }
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

        <div class="text-center">
            <h3 class="login-title mb-1">Cek <span class="gradient-text">Riwayat</span> Kunjungan</h3>
            <p class="login-subtitle">Masukkan NIS dan Tanggal Lahir untuk melihat riwayat</p>
        </div>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
            <div class="alert-error mt-3">
                <i class="fas fa-exclamation-circle"></i>
                <?php echo e($errors->first()); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <form method="POST" action="<?php echo e(route('login.siswa')); ?>" class="mt-3">
            <?php echo csrf_field(); ?>

            <div class="mb-3">
                <label for="nis" class="form-label">NIS (Nomor Induk Siswa)</label>
                <div class="input-icon">
                    <i class="fas fa-id-card"></i>
                    <input id="nis" type="text" class="form-control <?php $__errorArgs = ['nis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           name="nis" required autofocus placeholder="Masukkan NIS Anda" value="<?php echo e(old('nis')); ?>">
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['nis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="birth_date" class="form-label">Tanggal Lahir</label>
                <div class="input-icon">
                    <i class="fas fa-cake-candles"></i>
                    <input id="birth_date" type="date" class="form-control <?php $__errorArgs = ['birth_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           name="birth_date" required>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['birth_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-danger"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-search"></i> Lihat Riwayat
            </button>
        </form>

        <div class="text-center mt-3">
            <a href="<?php echo e(route('landing')); ?>" class="link-home">
                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>
    </div>

</body>
</html><?php /**PATH C:\laragon\www\sikes\resources\views/auth/login-siswa.blade.php ENDPATH**/ ?>