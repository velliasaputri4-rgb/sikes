<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Petugas UKS - SIKES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
    :root {
        --primary: #0ea5e9;
        --primary-dark: #0284c7;
        --secondary: #14b8a6;
        --accent: #8b5cf6;
        --emerald: #10b981;
        --rose: #f43f5e;
        --amber: #f59e0b;
        --ink: #0f172a;
        --slate: #475569;
        --light: #f8fafc;
        --gradient-primary: linear-gradient(135deg, #0ea5e9 0%, #14b8a6 100%);
        --gradient-accent: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
        --gradient-warm: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);
        --gradient-success: linear-gradient(135deg, #10b981 0%, #14b8a6 100%);
        --gradient-rose: linear-gradient(135deg, #f43f5e 0%, #ec4899 100%);
        --gradient-dark: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        --shadow-sm: 0 4px 20px rgba(14, 165, 233, 0.08);
        --shadow-md: 0 10px 40px rgba(14, 165, 233, 0.12);
        --shadow-lg: 0 25px 60px rgba(14, 165, 233, 0.18);
        --radius: 18px;
    }

    * { -webkit-font-smoothing: antialiased; }

    html {
        scroll-behavior: smooth;
        scroll-padding-top: 90px;
    }

    body {
        font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
        background: #fafbfc;
        color: var(--ink);
        line-height: 1.7;
        overflow-x: hidden;
    }

    /* ============ ANIMATED BLOBS ============ */
    .blob-bg {
        position: absolute;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.4;
        z-index: 0;
        pointer-events: none;
    }
    .blob-1 { width: 400px; height: 400px; background: #0ea5e9; top: -100px; left: -100px; animation: float1 20s ease-in-out infinite; }
    .blob-2 { width: 350px; height: 350px; background: #14b8a6; top: 100px; right: -80px; animation: float2 25s ease-in-out infinite; }
    .blob-3 { width: 300px; height: 300px; background: #8b5cf6; bottom: -80px; left: 30%; animation: float1 30s ease-in-out infinite reverse; }
    @keyframes float1 { 0%,100% { transform: translate(0,0) scale(1); } 50% { transform: translate(60px,-40px) scale(1.1); } }
    @keyframes float2 { 0%,100% { transform: translate(0,0) scale(1); } 50% { transform: translate(-50px,50px) scale(0.9); } }

    /* ============ NAVBAR ============ */
    .navbar {
        background: rgba(255,255,255,0.85);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        box-shadow: 0 4px 30px rgba(14, 165, 233, 0.06);
        border-bottom: 1px solid rgba(14, 165, 233, 0.08);
        padding: 12px 0;
        transition: all 0.4s ease;
    }
    .navbar.scrolled { padding: 8px 0; box-shadow: 0 8px 40px rgba(14, 165, 233, 0.1); }
    .navbar-brand { display: flex; align-items: center; }
    .navbar-brand img { max-height: 55px; width: auto; transition: transform 0.3s; }
    .navbar-brand:hover img { transform: scale(1.05); }
    .nav-link {
        font-weight: 600;
        font-size: 0.95rem;
        color: var(--slate) !important;
        padding: 10px 18px !important;
        border-radius: 10px;
        transition: all 0.3s ease;
        letter-spacing: 0.2px;
    }
    .nav-link:hover {
        color: var(--primary) !important;
        background: linear-gradient(135deg, rgba(14,165,233,0.1), rgba(20,184,166,0.1));
        transform: translateY(-1px);
    }
    .nav-link.active {
        color: white !important;
        background: var(--gradient-primary);
        box-shadow: 0 6px 20px rgba(14, 165, 233, 0.3);
    }

    .user-btn {
        background: var(--gradient-primary);
        color: white !important;
        border: none;
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 6px 20px rgba(14, 165, 233, 0.35);
        transition: all 0.3s;
    }
    .user-btn:hover { transform: translateY(-2px) rotate(5deg); box-shadow: 0 10px 28px rgba(14,165,233,0.45); }

    .dropdown-menu {
        border: none;
        border-radius: 14px;
        box-shadow: 0 20px 50px rgba(15,23,42,0.15);
        padding: 10px;
        margin-top: 10px;
    }
    .dropdown-item {
        border-radius: 8px;
        padding: 10px 14px;
        font-weight: 500;
        transition: all 0.2s;
    }
    .dropdown-item:hover {
        background: linear-gradient(135deg, rgba(14,165,233,0.1), rgba(20,184,166,0.1));
        transform: translateX(4px);
    }

    /* ============ PAGE HEADER ============ */
    .page-header {
        position: relative;
        padding: 90px 0 70px;
        background: linear-gradient(135deg, #f0f9ff 0%, #ecfeff 50%, #f0fdfa 100%);
        overflow: hidden;
    }
    .page-header-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 18px;
        background: rgba(14,165,233,0.1);
        color: var(--primary);
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 20px;
        border: 1px solid rgba(14,165,233,0.2);
    }
    .page-header-badge .pulse-dot {
        width: 8px; height: 8px;
        background: var(--emerald);
        border-radius: 50%;
        animation: pulse 2s infinite;
    }
    @keyframes pulse { 0%,100% { opacity: 1; transform: scale(1); } 50% { opacity: 0.6; transform: scale(1.4); } }

    .page-title {
        font-family: 'Poppins', sans-serif;
        font-size: clamp(2rem, 4.5vw, 3.2rem);
        font-weight: 700;
        color: var(--ink);
        line-height: 1.2;
        margin-bottom: 16px;
        letter-spacing: -1px;
    }
    .gradient-text {
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .page-subtitle {
        color: var(--slate);
        font-size: 1.1rem;
        max-width: 580px;
    }

    .header-icon-wrap {
        width: 140px; height: 140px;
        background: var(--gradient-primary);
        border-radius: 36px;
        display: flex; align-items: center; justify-content: center;
        color: white;
        font-size: 3.5rem;
        box-shadow: 0 25px 60px rgba(14,165,233,0.35);
        margin-left: auto;
        animation: iconFloat 5s ease-in-out infinite;
        position: relative;
    }
    .header-icon-wrap::before {
        content: '';
        position: absolute;
        inset: -12px;
        border-radius: 40px;
        background: var(--gradient-primary);
        opacity: 0.2;
        z-index: -1;
        animation: iconPulse 2.5s ease-in-out infinite;
    }
    .header-icon-wrap::after {
        content: '';
        position: absolute;
        inset: -24px;
        border-radius: 44px;
        background: var(--gradient-primary);
        opacity: 0.1;
        z-index: -2;
    }
    @keyframes iconFloat {
        0%,100% { transform: translateY(0) rotate(0); }
        50% { transform: translateY(-12px) rotate(4deg); }
    }
    @keyframes iconPulse {
        0%,100% { transform: scale(1); opacity: 0.2; }
        50% { transform: scale(1.15); opacity: 0.1; }
    }

    /* ============ SECTION ============ */
    .section { padding: 70px 0 90px; }
    .section-label {
        display: inline-block;
        padding: 6px 16px;
        background: rgba(14,165,233,0.1);
        color: var(--primary);
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 14px;
    }
    .section-title {
        font-family: 'Poppins', sans-serif;
        font-size: clamp(1.8rem, 4vw, 2.6rem);
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 14px;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }
    .section-subtitle {
        color: var(--slate);
        font-size: 1.05rem;
        max-width: 600px;
    }

    /* ============ SCHEDULE CARDS ============ */
    .schedule-card {
        background: white;
        border-radius: var(--radius);
        padding: 0;
        box-shadow: 0 4px 20px rgba(14,165,233,0.06);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        height: 100%;
        border: 1px solid rgba(14,165,233,0.08);
        overflow: hidden;
        position: relative;
    }
    .schedule-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-lg);
        border-color: transparent;
    }
    .schedule-card-top {
        position: relative;
        padding: 40px 28px 24px;
        background: linear-gradient(135deg, #f0f9ff 0%, #ecfeff 100%);
        border-bottom: 1px dashed #e0f2fe;
        text-align: center;
    }
    .schedule-card-top::before {
        content: '';
        position: absolute;
        top: -30px; right: -30px;
        width: 120px; height: 120px;
        background: var(--gradient-primary);
        border-radius: 50%;
        opacity: 0.08;
    }
    .officer-avatar {
        width: 90px; height: 90px;
        border-radius: 24px;
        background: var(--gradient-primary);
        color: white;
        display: flex; align-items: center; justify-content: center;
        font-size: 2.2rem;
        margin: 0 auto 18px;
        box-shadow: 0 15px 40px rgba(14,165,233,0.35);
        transition: all 0.4s;
        position: relative;
        z-index: 2;
    }
    .schedule-card:hover .officer-avatar {
        transform: scale(1.08) rotate(-6deg);
        box-shadow: 0 20px 50px rgba(14,165,233,0.45);
    }
    .officer-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 12px;
        background: rgba(14,165,233,0.1);
        color: var(--primary);
        border-radius: 50px;
        font-size: 0.72rem;
        font-weight: 700;
        margin-bottom: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .schedule-card h5 {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 4px;
        font-size: 1.2rem;
    }
    .schedule-card .team-name {
        color: var(--slate);
        font-size: 0.85rem;
        margin-bottom: 0;
    }

    .schedule-card-body {
        padding: 24px 28px;
    }
    .schedule-info-row {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 0;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.88rem;
    }
    .schedule-info-row:last-child { border-bottom: none; }
    .schedule-info-row i {
        color: var(--primary);
        width: 18px;
        font-size: 0.9rem;
    }
    .schedule-info-row .info-val {
        margin-left: auto;
        font-weight: 700;
        color: var(--ink);
    }
    .schedule-info-row .info-label {
        color: var(--slate);
    }

    .btn-view-members {
        background: var(--gradient-primary);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 12px 24px;
        font-weight: 600;
        width: 100%;
        margin-top: 18px;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        box-shadow: 0 8px 25px rgba(14,165,233,0.3);
        position: relative;
        overflow: hidden;
    }
    .btn-view-members::before {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s;
    }
    .btn-view-members:hover::before { left: 100%; }
    .btn-view-members:hover {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 12px 35px rgba(14,165,233,0.45);
    }

    /* ============ MODAL ============ */
    .modal-content {
        border: none;
        border-radius: var(--radius);
        box-shadow: 0 30px 80px rgba(15,23,42,0.25);
        overflow: hidden;
    }
    .modal-header-custom {
        background: var(--gradient-primary);
        color: white;
        padding: 24px 28px;
        border: none;
        position: relative;
    }
    .modal-header-custom::before {
        content: '';
        position: absolute;
        top: -30px; right: -30px;
        width: 120px; height: 120px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }
    .modal-header-custom::after {
        content: '';
        position: absolute;
        bottom: -40px; left: -40px;
        width: 100px; height: 100px;
        background: rgba(255,255,255,0.08);
        border-radius: 50%;
    }
    .modal-title {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
        position: relative;
        z-index: 2;
    }
    .modal-title-icon {
        width: 40px; height: 40px;
        background: rgba(255,255,255,0.2);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        backdrop-filter: blur(10px);
    }
    .btn-close-white {
        filter: brightness(0) invert(1);
        opacity: 0.8;
        position: relative;
        z-index: 2;
    }
    .btn-close-white:hover { opacity: 1; }

    .modal-body { padding: 0; }
    .members-list {
        max-height: 500px;
        overflow-y: auto;
    }
    .member-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 16px 28px;
        border-bottom: 1px solid #f1f5f9;
        transition: all 0.2s;
    }
    .member-item:hover {
        background: linear-gradient(135deg, #f0f9ff, #ecfeff);
    }
    .member-item:last-child { border-bottom: none; }
    .member-avatar {
        width: 48px; height: 48px;
        border-radius: 14px;
        background: var(--gradient-primary);
        color: white;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem;
        font-weight: 700;
        flex-shrink: 0;
        font-family: 'Poppins', sans-serif;
    }
    .member-avatar.is-emergency {
        background: var(--gradient-rose);
        animation: emergencyPulse 2s infinite;
    }
    @keyframes emergencyPulse {
        0%,100% { box-shadow: 0 0 0 0 rgba(244,63,94,0.4); }
        50% { box-shadow: 0 0 0 8px rgba(244,63,94,0); }
    }
    .member-info { flex: 1; min-width: 0; }
    .member-name {
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 4px;
        font-size: 0.95rem;
    }
    .member-phone {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.85rem;
        color: var(--rose);
        font-weight: 600;
        text-decoration: none;
        padding: 4px 10px;
        background: #fee2e2;
        border-radius: 50px;
        transition: all 0.2s;
    }
    .member-phone:hover {
        background: var(--gradient-rose);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(244,63,94,0.3);
    }
    .emergency-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 3px 10px;
        background: var(--gradient-rose);
        color: white;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-left: 6px;
    }
    .emergency-badge i { font-size: 0.65rem; }

    .modal-footer-custom {
        padding: 20px 28px;
        background: linear-gradient(135deg, #fef3c7, #fed7aa);
        border-top: none;
    }
    .note-box {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        color: #92400e;
        font-size: 0.88rem;
    }
    .note-box i {
        color: var(--amber);
        font-size: 1.1rem;
        margin-top: 2px;
        flex-shrink: 0;
    }
    .note-box strong { color: var(--rose); }

    /* ============ EMPTY STATE ============ */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: white;
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
    }
    .empty-icon-wrap {
        width: 120px; height: 120px;
        background: linear-gradient(135deg, #f0f9ff, #ecfeff);
        border-radius: 30px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 24px;
        position: relative;
    }
    .empty-icon-wrap i {
        font-size: 3.5rem;
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .empty-icon-wrap::before {
        content: '';
        position: absolute;
        inset: -8px;
        border-radius: 34px;
        background: var(--gradient-primary);
        opacity: 0.15;
        z-index: -1;
    }
    .empty-state h5 {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 10px;
    }
    .empty-state p {
        color: var(--slate);
        max-width: 400px;
        margin: 0 auto;
    }

    /* ============ INFO ALERT ============ */
    .info-alert-wrap {
        background: white;
        border-radius: var(--radius);
        padding: 36px;
        box-shadow: var(--shadow-md);
        border: 1px solid rgba(14,165,233,0.08);
        position: relative;
        overflow: hidden;
    }
    .info-alert-wrap::before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 6px; height: 100%;
        background: var(--gradient-primary);
    }
    .info-alert-icon {
        width: 70px; height: 70px;
        background: var(--gradient-primary);
        color: white;
        border-radius: 20px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.8rem;
        box-shadow: 0 12px 30px rgba(14,165,233,0.3);
        margin-bottom: 20px;
    }
    .info-alert-wrap h5 {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 16px;
    }
    .info-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .info-list li {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 10px 0;
        color: var(--slate);
    }
    .info-list li i {
        color: var(--emerald);
        font-size: 1rem;
        margin-top: 4px;
        flex-shrink: 0;
    }

    /* ============ FOOTER ============ */
    footer {
        background: var(--gradient-dark);
        color: white;
        padding: 80px 0 30px;
        position: relative;
        overflow: hidden;
        margin-top: 0;
    }
    footer::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            radial-gradient(circle at 10% 20%, rgba(14,165,233,0.15) 0%, transparent 40%),
            radial-gradient(circle at 90% 80%, rgba(139,92,246,0.15) 0%, transparent 40%);
    }
    footer .container { position: relative; z-index: 1; }
    .footer-logo {
        display: inline-flex; align-items: center; gap: 12px;
        margin-bottom: 20px;
        font-family: 'Poppins', sans-serif;
        font-weight: 700; font-size: 1.4rem;
    }
    .footer-logo-icon {
        width: 46px; height: 46px;
        background: var(--gradient-primary);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        color: white;
        font-size: 1.2rem;
    }
    footer h6 { font-weight: 700; margin-bottom: 22px; color: white; text-transform: uppercase; letter-spacing: 1px; font-size: 0.9rem; }
    .footer-menu { list-style: none; padding: 0; margin: 0; }
    .footer-menu li { margin-bottom: 12px; }
    .footer-menu a {
        color: rgba(255,255,255,0.7);
        text-decoration: none;
        font-weight: 500;
        font-size: 0.95rem;
        transition: all 0.3s;
        display: inline-flex; align-items: center; gap: 8px;
    }
    .footer-menu a:hover { color: var(--primary); transform: translateX(6px); }

    .social-links { display: flex; gap: 10px; margin-top: 20px; }
    .social-links a {
        width: 42px; height: 42px;
        border-radius: 12px;
        background: rgba(255,255,255,0.08);
        display: flex; align-items: center; justify-content: center;
        color: white;
        transition: all 0.3s;
        text-decoration: none;
    }
    .social-links a:hover {
        background: var(--gradient-primary);
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(14,165,233,0.4);
    }

    .footer-bottom {
        border-top: 1px solid rgba(255,255,255,0.1);
        margin-top: 50px;
        padding-top: 25px;
        text-align: center;
        color: rgba(255,255,255,0.5);
        font-size: 0.9rem;
    }

    /* ============ SCROLL TO TOP ============ */
    .scroll-top {
        position: fixed;
        bottom: 30px; right: 30px;
        width: 50px; height: 50px;
        background: var(--gradient-primary);
        color: white;
        border: none;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 10px 30px rgba(14,165,233,0.4);
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transform: translateY(20px);
        transition: all 0.3s;
        z-index: 999;
    }
    .scroll-top.show { opacity: 1; visibility: visible; transform: translateY(0); }
    .scroll-top:hover { transform: translateY(-4px); box-shadow: 0 15px 40px rgba(14,165,233,0.55); }

    /* ============ RESPONSIVE ============ */
    @media (max-width: 768px) {
        .page-header { padding: 70px 0 60px; }
        .header-icon-wrap {
            width: 100px; height: 100px;
            font-size: 2.5rem;
            margin: 20px auto 0;
        }
        .navbar-brand img { max-height: 45px; }
    }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('landing') }}">
                <img src="{{ asset('images/logo sikes navbar.png') }}" alt="Logo SIKES">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('landing') && !request()->is('*#*') ? 'active' : '' }}" href="{{ route('landing') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link anchor-link" href="{{ route('landing') }}#tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link anchor-link" href="{{ route('landing') }}#layanan">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link anchor-link" href="{{ route('landing') }}#kontak">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('landing.medicines*') ? 'active' : '' }}" href="{{ route('landing.medicines') }}">Obat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('landing.schedule*') ? 'active' : '' }}" href="{{ route('landing.schedule') }}">Jadwal</a>
                    </li>

                    <li class="nav-item ms-lg-3">
                        <div class="dropdown">
                            <button class="btn user-btn" type="button" data-bs-toggle="dropdown">
                                <i class="fas {{ auth()->check() ? 'fa-user-check' : 'fa-user' }}"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                @auth
                                    <li class="dropdown-header text-center pb-2">
                                        <small class="text-muted d-block">Halo,</small>
                                        <strong class="text-dark">{{ auth()->user()->name ?? 'User' }}</strong>
                                        <span class="badge bg-primary mt-1">{{ auth()->user()->getRoleNames()->first() ?? 'User' }}</span>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route(auth()->user()->hasRole(['super-admin', 'admin']) ? 'admin.dashboard' : (auth()->user()->hasRole('petugas') ? 'petugas.dashboard' : 'siswa.history')) }}">
                                            <i class="fas fa-tachometer-alt me-2 text-primary"></i> Dashboard
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                                            </button>
                                        </form>
                                    </li>
                                @else
                                    <li class="dropdown-header text-center">
                                        <small class="text-muted">Pilih Login</small>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item fw-semibold" href="{{ route('login') }}">
                                            <i class="fas fa-user-shield me-2 text-primary"></i> Admin / Petugas
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('login.siswa') }}">
                                            <i class="fas fa-user-graduate me-2 text-info"></i> Login Siswa
                                        </a>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <section class="page-header">
        <div class="blob-bg blob-1"></div>
        <div class="blob-bg blob-2"></div>
        <div class="container position-relative" style="z-index: 2;">
            <div class="row align-items-center g-4">
                <div class="col-lg-8" data-aos="fade-right">
                    <div class="page-header-badge">
                        <span class="pulse-dot"></span>
                        <span>Jadwal Petugas UKS Aktif</span>
                    </div>
                    <h1 class="page-title">
                        Jadwal <span class="gradient-text">Petugas</span><br>
                        UKS SMK Negeri 1 Bangsri
                    </h1>
                    <p class="page-subtitle">Informasi lengkap jadwal petugas yang bertugas di Unit Kesehatan Sekolah. Siap melayani siswa dengan profesional dan terlatih.</p>
                </div>
                <div class="col-lg-4 text-lg-end" data-aos="fade-left" data-aos-delay="200">
                    <div class="header-icon-wrap">
                        <i class="fas fa-user-nurse"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Schedule Section -->
    <section class="section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-label">Grup Piket</span>
                <h2 class="section-title">Daftar <span class="gradient-text">Petugas</span> Piket</h2>
                <p class="section-subtitle mx-auto">Klik tombol "Lihat Anggota" untuk melihat daftar lengkap anggota setiap grup piket</p>
            </div>

            <div class="row g-4">
                @forelse($schedules as $schedule)
                    @php
                        $members = $schedule->members ?? [];
                        $membersCount = count($members);
                        $emergencyCount = 0;
                        foreach($members as $m) {
                            if (is_array($m) && !empty($m['phone'])) $emergencyCount++;
                        }
                    @endphp
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                        <div class="schedule-card">
                            <div class="schedule-card-top">
                                <span class="officer-badge">
                                    <i class="fas fa-users"></i>
                                    Grup Piket {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <div class="officer-avatar">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h5>{{ $schedule->group_name }}</h5>
                                <p class="team-name">PMR Wira Sandya Adhimukti</p>
                            </div>

                            <div class="schedule-card-body">
                                <div class="schedule-info-row">
                                    <i class="fas fa-user-friends"></i>
                                    <span class="info-label">Total Anggota</span>
                                    <span class="info-val">{{ $membersCount }}</span>
                                </div>
                                <div class="schedule-info-row">
                                    <i class="fas fa-phone-volume"></i>
                                    <span class="info-label">Kontak Darurat</span>
                                    <span class="info-val" style="color: {{ $emergencyCount > 0 ? 'var(--rose)' : 'var(--slate)' }};">
                                        {{ $emergencyCount }} orang
                                    </span>
                                </div>
                                <div class="schedule-info-row">
                                    <i class="fas fa-shield-alt"></i>
                                    <span class="info-label">Status</span>
                                    <span class="info-val" style="color: var(--emerald);">
                                        <i class="fas fa-check-circle"></i> Aktif
                                    </span>
                                </div>

                                <button class="btn btn-view-members"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalAnggota{{ $schedule->id }}">
                                    <i class="fas fa-users"></i>
                                    Lihat Daftar Anggota
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Daftar Anggota -->
                    <div class="modal fade" id="modalAnggota{{ $schedule->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header-custom">
                                    <h5 class="modal-title">
                                        <div class="modal-title-icon">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <div>
                                            <div style="font-size: 0.75rem; opacity: 0.85; font-weight: 500;">Grup Piket</div>
                                            {{ $schedule->group_name }}
                                        </div>
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="members-list">
                                        @if(count($members) > 0)
                                            @foreach($members as $idx => $member)
                                                @php
                                                    $name = '-';
                                                    $phone = '';
                                                    $initials = 'U';
                                                    if (is_array($member)) {
                                                        $name = $member['name'] ?? '-';
                                                        $phone = $member['phone'] ?? '';
                                                    } else {
                                                        $name = $member;
                                                    }
                                                    $words = explode(' ', $name);
                                                    $initials = '';
                                                    foreach(array_slice($words, 0, 2) as $w) {
                                                        if (strlen($w) > 0) $initials .= strtoupper(substr($w, 0, 1));
                                                    }
                                                    if (empty($initials)) $initials = 'U';
                                                @endphp
                                                <div class="member-item">
                                                    <div class="member-avatar {{ !empty($phone) ? 'is-emergency' : '' }}">
                                                        {{ $initials }}
                                                    </div>
                                                    <div class="member-info">
                                                        <div class="member-name">
                                                            {{ $name }}
                                                            @if(!empty($phone))
                                                                <span class="emergency-badge">
                                                                    <i class="fas fa-bolt"></i> Darurat
                                                                </span>
                                                            @endif
                                                        </div>
                                                        @if(!empty($phone))
                                                            <a href="https://wa.me/{{ preg_replace('/\D/', '', $phone) }}"
                                                               target="_blank"
                                                               class="member-phone"
                                                               title="Hubungi via WhatsApp">
                                                                <i class="fab fa-whatsapp"></i>
                                                                {{ $phone }}
                                                            </a>
                                                        @else
                                                            <small style="color: var(--slate);">
                                                                <i class="fas fa-info-circle me-1"></i> Anggota biasa
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="text-center py-5">
                                                <div class="empty-icon-wrap" style="width: 80px; height: 80px;">
                                                    <i class="fas fa-user-slash" style="font-size: 2rem;"></i>
                                                </div>
                                                <p class="text-muted mb-0">Data anggota belum tersedia</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="modal-footer-custom">
                                    <div class="note-box">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <div>
                                            <strong>Catatan:</strong> Hubungi anggota dengan badge
                                            <span class="emergency-badge" style="margin: 0 4px;"><i class="fas fa-bolt"></i> Darurat</span>
                                            jika membutuhkan bantuan darurat di luar jam operasional.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state" data-aos="fade-up">
                            <div class="empty-icon-wrap">
                                <i class="fas fa-calendar-times"></i>
                            </div>
                            <h5>Belum Ada Jadwal</h5>
                            <p>Jadwal petugas belum tersedia. Silakan hubungi admin UKS untuk informasi lebih lanjut.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Info Alert -->
            <div class="info-alert-wrap mt-5" data-aos="fade-up">
                <div class="row align-items-center g-4">
                    <div class="col-md-2 text-center">
                        <div class="info-alert-icon mx-auto">
                            <i class="fas fa-info-circle"></i>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <h5>Informasi Penting</h5>
                        <ul class="info-list">
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>UKS melayani siswa selama jam operasional sekolah dengan petugas terlatih</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Untuk keadaan darurat di luar jam operasional, silakan hubungi guru piket atau petugas dengan badge darurat</span>
                            </li>
                            <li>
                                <i class="fas fa-check-circle"></i>
                                <span>Petugas UKS siap memberikan pertolongan pertama dan rujukan ke fasilitas kesehatan jika diperlukan</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="footer-logo">
                        <div class="footer-logo-icon"><i class="fas fa-heartbeat"></i></div>
                        <span>SIKES</span>
                    </div>
                    <p style="color: rgba(255,255,255,0.7); line-height: 1.8; margin-bottom: 24px;">
                        Sistem Informasi Unit Kesehatan Sekolah modern dan terpercaya untuk meningkatkan kualitas kesehatan seluruh warga sekolah.
                    </p>
                    <div class="social-links">
                        <a href="https://instagram.com/pmrwira_eskasaba" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://youtube.com/@wirasandyaadhimukti3463" target="_blank"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                        <a href="#"><i class="fas fa-envelope"></i></a>
                    </div>
                </div>

                <div class="col-6 col-lg-2">
                    <h6>Navigasi</h6>
                    <ul class="footer-menu">
                        <li><a href="{{ route('landing') }}"><i class="fas fa-chevron-right fa-xs"></i> Beranda</a></li>
                        <li><a href="{{ route('landing') }}#tentang"><i class="fas fa-chevron-right fa-xs"></i> Tentang</a></li>
                        <li><a href="{{ route('landing') }}#layanan"><i class="fas fa-chevron-right fa-xs"></i> Layanan</a></li>
                        <li><a href="{{ route('landing') }}#kontak"><i class="fas fa-chevron-right fa-xs"></i> Kontak</a></li>
                    </ul>
                </div>

                <div class="col-6 col-lg-3">
                    <h6>Layanan</h6>
                    <ul class="footer-menu">
                        <li><a href="{{ route('landing.medicines') }}"><i class="fas fa-chevron-right fa-xs"></i> Informasi Obat</a></li>
                        <li><a href="{{ route('landing.schedule') }}"><i class="fas fa-chevron-right fa-xs"></i> Jadwal Petugas</a></li>
                        <li><a href="{{ route('petugas.examinations.create') }}"><i class="fas fa-chevron-right fa-xs"></i> Form Kunjungan</a></li>
                        <li><a href="{{ auth()->check() && auth()->user()->hasRole('siswa') ? route('siswa.history') : route('login.siswa') }}"><i class="fas fa-chevron-right fa-xs"></i> Riwayat</a></li>
                    </ul>
                </div>

                <div class="col-lg-3">
                    <h6>Kontak</h6>
                    <ul class="footer-menu">
                        <li><a href="#"><i class="fas fa-map-marker-alt"></i> Jl. KH. Achmad Fauzan No.17, Bangsri</a></li>
                        <li><a href="https://instagram.com/pmrwira_eskasaba" target="_blank"><i class="fab fa-instagram"></i> @pmrwira_eskasaba</a></li>
                        <li><a href="https://youtube.com/@wirasandyaadhimukti3463" target="_blank"><i class="fab fa-youtube"></i> @wirasandyaadhimukti3463</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p class="mb-0">&copy; {{ date('Y') }} <strong>SIKES</strong> - Sistem Informasi UKS SMK Negeri 1 Bangsri. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top -->
    <button class="scroll-top" id="scrollTop">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        AOS.init({ duration: 700, once: true, offset: 60 });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            const scrollTop = document.getElementById('scrollTop');
            if (window.scrollY > 50) navbar.classList.add('scrolled');
            else navbar.classList.remove('scrolled');
            if (window.scrollY > 300) scrollTop.classList.add('show');
            else scrollTop.classList.remove('show');
        });

        // Scroll to top
        document.getElementById('scrollTop').addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Anchor link active state
        document.querySelectorAll('.anchor-link').forEach(link => {
            link.addEventListener('click', function() {
                document.querySelectorAll('.navbar-nav .nav-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });
    </script>
</body>
</html>