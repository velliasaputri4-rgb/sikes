<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIKES - Sistem Informasi UKS Modern</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
    :root {
        --primary: #3b82f6;
        --primary-dark: #1e3a8a;
        --secondary: #2563eb;
        --accent: #8b5cf6;
        --emerald: #10b981;
        --rose: #f43f5e;
        --amber: #f59e0b;
        --ink: #0f172a;
        --slate: #475569;
        --light: #f8fafc;
        --pro: #1e3a8a;
        --pro-dark: #172c6e;
        --pro-light: #3b82f6;
        --gradient-pro: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        --gradient-primary: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        --gradient-accent: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);
        --gradient-dark: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        --shadow-sm: 0 4px 20px rgba(30, 58, 138, 0.08);
        --shadow-md: 0 10px 40px rgba(30, 58, 138, 0.12);
        --shadow-lg: 0 25px 60px rgba(30, 58, 138, 0.18);
        --radius: 18px;
    }

    * { 
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

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
        /* ✅ FIX: Prevent flickering on body */
        transform: translateZ(0);
        -webkit-transform: translateZ(0);
    }

    /* ============ NAVBAR ============ */
    .navbar {
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        box-shadow: 0 4px 30px rgba(30, 58, 138, 0.06);
        border-bottom: 1px solid rgba(30, 58, 138, 0.08);
        padding: 12px 0;
        transition: all 0.4s ease;
        /* ✅ FIX: Hardware acceleration */
        transform: translate3d(0, 0, 0);
        -webkit-transform: translate3d(0, 0, 0);
        will-change: auto; /* Reset will-change to prevent memory leak */
    }
    .navbar.scrolled { padding: 8px 0; box-shadow: 0 8px 40px rgba(30, 58, 138, 0.1); }
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
        color: var(--primary-dark) !important;
        background: linear-gradient(135deg, rgba(30,58,138,0.08), rgba(59,130,246,0.08));
        transform: translateY(-1px);
    }
    .nav-link.active {
        color: white !important;
        background: var(--gradient-primary);
        box-shadow: 0 6px 20px rgba(30, 58, 138, 0.25);
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
        box-shadow: 0 6px 20px rgba(30, 58, 138, 0.3);
        transition: all 0.3s;
    }
    .user-btn:hover { transform: translateY(-2px) rotate(5deg); box-shadow: 0 10px 28px rgba(30,58,138,0.4); }

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
        background: linear-gradient(135deg, rgba(30,58,138,0.08), rgba(59,130,246,0.08));
        transform: translateX(4px);
    }

    /* ============ HERO ============ */
    .hero-section {
        position: relative;
        padding: 100px 0 80px;
        background: linear-gradient(180deg, #f7fafc 0%, #edf2fa 100%);
        overflow: hidden;
    }
    .hero-decor { position: absolute; inset: 0; pointer-events: none; }
    .decor-dots {
        position: absolute;
        width: 140px; height: 95px;
        background-image: radial-gradient(circle, rgba(30,58,138,0.22) 2px, transparent 2.6px);
        background-size: 16px 16px;
    }
    .dots-1 { top: 55px; right: 55px; }
    .dots-2 { bottom: 55px; left: 35px; }
    .decor-plus { position: absolute; color: rgba(30,58,138,0.18); }
    .plus-1 { top: 42%; left: 3%; font-size: 22px; color: rgba(59,130,246,0.3); }
    .plus-2 { top: 16%; right: 24%; font-size: 15px; }
    .plus-3 { bottom: 20%; right: 6%; font-size: 20px; color: rgba(59,130,246,0.28); }
    .plus-4 { top: 12%; left: 22%; font-size: 14px; }
    .decor-circle { position: absolute; border-radius: 50%; background: rgba(30,58,138,0.05); }
    .circle-1 { width: 240px; height: 240px; right: -90px; bottom: -70px; }
    .circle-2 { width: 150px; height: 150px; left: -70px; top: -50px; background: rgba(59,130,246,0.07); }

    .hero-title {
        font-family: 'Poppins', sans-serif;
        font-size: clamp(1.9rem, 3.4vw, 2.9rem);
        font-weight: 700;
        color: var(--ink);
        line-height: 1.15;
        margin-bottom: 20px;
        letter-spacing: -0.5px;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .hero-line { line-height: 1.15; }
    .hero-accent {
        color: #2563eb !important;
        -webkit-text-fill-color: #2563eb !important;
        background: none !important;
        -webkit-background-clip: unset !important;
        background-clip: unset !important;
    }
    .hero-subtitle {
        color: var(--slate);
        font-size: 1rem;
        margin-bottom: 30px;
        max-width: 470px;
    }

    .btn-hero-primary {
        background: var(--gradient-primary);
        color: white;
        padding: 12px 26px;
        border-radius: 10px;
        border: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 6px 20px rgba(30,58,138,0.25);
        transition: all 0.3s;
        text-decoration: none;
    }
    .btn-hero-primary:hover {
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 10px 28px rgba(30,58,138,0.35);
        filter: brightness(1.08);
    }
    .btn-hero-outline {
        background: white;
        color: var(--pro);
        padding: 12px 26px;
        border-radius: 10px;
        border: 1px solid #d5e0ec;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
        box-shadow: 0 3px 12px rgba(30,58,138,0.06);
        text-decoration: none;
    }
    .btn-hero-outline:hover {
        color: var(--pro-light);
        border-color: var(--pro-light);
        transform: translateY(-3px);
    }

    /* ============ STAT CARDS ============ */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 22px;
    }
    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 24px 22px;
        display: flex;
        align-items: flex-start;
        gap: 16px;
        border: 1px solid #e4ebf5;
        box-shadow: 0 6px 20px rgba(30,58,138,0.06);
        transition: all 0.3s;
        /* ✅ FIX: Prevent flickering */
        transform: translate3d(0, 0, 0);
        -webkit-transform: translate3d(0, 0, 0);
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(30,58,138,0.1);
    }
    .stat-icon {
        flex: 0 0 52px;
        width: 52px; height: 52px;
        border-radius: 12px;
        background: linear-gradient(135deg, rgba(30,58,138,0.1), rgba(59,130,246,0.12));
        color: var(--pro);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.25rem;
    }
    .stat-card h3 {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        font-size: 1.55rem;
        color: var(--ink);
        line-height: 1.2;
        margin-bottom: 2px;
    }
    .stat-label { font-weight: 700; font-size: 0.85rem; color: #334155; margin-bottom: 2px; }
    .stat-note { color: #8a94a6; font-size: 0.72rem; }

    /* ============ MENU CARDS ============ */
    .menu-card {
        background: white;
        border-radius: var(--radius);
        padding: 32px 26px;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid #e4ebf5;
        height: 100%;
        position: relative;
        text-decoration: none;
        display: block;
        color: inherit;
        overflow: hidden;
        /* ✅ FIX: Prevent flickering */
        transform: translate3d(0, 0, 0);
        -webkit-transform: translate3d(0, 0, 0);
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
    }
    .menu-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 4px;
        background: var(--gradient-pro);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }
    .menu-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 25px 60px rgba(30,58,138,0.12);
        border-color: transparent;
    }
    .menu-card:hover::before { transform: scaleX(1); }

    .menu-icon {
        width: 76px; height: 76px;
        border-radius: 20px;
        margin: 0 auto 20px;
        display: flex; align-items: center; justify-content: center;
        font-size: 30px;
        color: white;
        background: var(--gradient-pro);
        box-shadow: 0 12px 30px rgba(30,58,138,0.25);
        transition: all 0.4s;
    }
    .menu-card:hover .menu-icon {
        transform: scale(1.1) rotate(-8deg);
        box-shadow: 0 18px 40px rgba(30,58,138,0.35);
    }
    .menu-card h5 { font-weight: 700; color: var(--ink); margin-bottom: 8px; }
    .menu-card .card-tag {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: 0.75rem; font-weight: 600;
        padding: 4px 10px; border-radius: 50px;
        margin-top: 10px;
    }
    .tag-public { background: #e4f4ec; color: #1e7a55; }
    .tag-login { background: #e6eef8; color: #1e3a8a; }

    /* ============ SECTIONS ============ */
    .section { padding: 90px 0; position: relative; }
    .section-label {
        display: inline-block;
        padding: 6px 16px;
        background: rgba(59,130,246,0.12);
        color: var(--pro);
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 16px;
    }
    .section-title {
        font-family: 'Poppins', sans-serif;
        font-size: clamp(1.8rem, 4vw, 2.6rem);
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 16px;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }
    .section-subtitle {
        color: var(--slate);
        font-size: 1.05rem;
        max-width: 600px;
    }
    .gradient-text {
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* ============ ABOUT ============ */
    .about-section { background: white; }
    .about-img-wrap {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
    }
    .about-img-wrap::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(30,58,138,0.15), transparent 60%);
        z-index: 1;
    }
    .about-img-wrap img { width: 100%; height: auto; display: block; }

    .about-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: linear-gradient(135deg, #f6f9fc, #eef3fb);
        border: 1px solid rgba(30,58,138,0.15);
        color: var(--primary-dark);
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s;
    }
    .about-pill:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-sm);
        border-color: rgba(59,130,246,0.4);
    }
    .about-pill i { color: var(--primary); }

    /* ============ SERVICES ============ */
    .services-section {
        background: linear-gradient(135deg, #f6f9fc 0%, #eef3fb 50%, #f3f7fc 100%);
    }
    .service-card {
        background: white;
        border-radius: var(--radius);
        box-shadow: 0 4px 20px rgba(30,58,138,0.06);
        margin-bottom: 25px;
        text-align: left;
        height: 100%;
        border: 1px solid rgba(30,58,138,0.08);
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
        /* ✅ FIX: Prevent flickering */
        transform: translate3d(0, 0, 0);
        -webkit-transform: translate3d(0, 0, 0);
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
    }
    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
        border-color: transparent;
    }
    
    .service-image-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 12px;
        margin: 20px 24px 16px 24px;
        cursor: pointer;
        /* ✅ FIX: Prevent flickering */
        transform: translate3d(0, 0, 0);
        -webkit-transform: translate3d(0, 0, 0);
        -webkit-backface-visibility: hidden;
    }
    .service-image {
        width: 100%;
        height: 120px;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .service-image-wrapper:hover .service-image {
        transform: scale(1.05);
    }
    
    .service-image-wrapper::after {
        content: '\f00e';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0);
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        font-size: 1.2rem;
        color: white;
        background: rgba(30, 58, 138, 0.7);
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        z-index: 2;
        pointer-events: none;
    }
    .service-image-wrapper:hover::after {
        transform: translate(-50%, -50%) scale(1);
    }

    .service-icon {
        position: absolute;
        top: 16px;
        right: 16px;
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(4px);
        color: var(--primary);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        z-index: 3;
        transition: all 0.3s ease;
    }
    .service-card:hover .service-icon {
        transform: scale(1.1);
        background: white;
        box-shadow: 0 6px 16px rgba(0,0,0,0.15);
    }
    .service-content {
        padding: 0 24px 24px 24px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    .service-card h5 { font-weight: 700; color: var(--ink); margin-bottom: 8px; font-size: 1.1rem; }
    .service-card p { color: var(--slate); font-size: 0.92rem; margin-bottom: 0; line-height: 1.6; }

    /* ============ DOCUMENTATION ============ */
    .doc-card {
        background: white;
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
        height: 100%;
        border: 1px solid rgba(30,58,138,0.08);
        /* ✅ FIX: Prevent flickering */
        transform: translate3d(0, 0, 0);
        -webkit-transform: translate3d(0, 0, 0);
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
    }

    .doc-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
    }

    .doc-image {
        width: 100%;
        height: 240px;
        overflow: hidden;
        position: relative;
    }

    .doc-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .doc-card:hover .doc-image img {
        transform: scale(1.05);
    }

    .doc-content {
        padding: 24px;
    }

    .doc-meta {
        display: flex;
        gap: 20px;
        margin-bottom: 12px;
        font-size: 0.85rem;
        color: var(--slate);
        flex-wrap: wrap;
    }

    .doc-meta span {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .doc-meta i {
        color: var(--primary);
        font-size: 0.9rem;
    }

    .doc-title {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 1.1rem;
        line-height: 1.4;
        margin-bottom: 0;
    }

    .doc-title a {
        color: var(--ink);
        text-decoration: none;
        transition: color 0.3s ease;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .doc-title a:hover {
        color: var(--primary);
    }

    .btn-doc-all {
        background: var(--gradient-primary);
        color: white;
        padding: 12px 32px;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 6px 20px rgba(30,58,138,0.25);
        transition: all 0.3s ease;
    }

    .btn-doc-all:hover {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(30,58,138,0.35);
    }

    .video-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(15, 23, 42, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: 2;
        text-decoration: none;
        cursor: pointer;
    }

    .doc-card:hover .video-overlay {
        opacity: 1;
    }

    .video-overlay i {
        font-size: 3.5rem;
        color: #ffffff;
        filter: drop-shadow(0 4px 10px rgba(0,0,0,0.4));
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .doc-card:hover .video-overlay i {
        transform: scale(1.15);
    }

    .badge-video {
        background: rgba(244, 63, 94, 0.1);
        color: var(--rose);
        padding: 3px 10px;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .doc-excerpt {
        color: var(--slate);
        font-size: 0.9rem;
        line-height: 1.6;
        margin-top: 8px;
        margin-bottom: 0;
    }

    /* ============ CONTACT ============ */
    .contact-section { background: white; }
    .info-card {
        background: linear-gradient(135deg, #f6f9fc, #f3f7fc);
        border-radius: var(--radius);
        padding: 40px 30px;
        height: 100%;
        border: 1px solid rgba(30,58,138,0.1);
        transition: all 0.3s;
        /* ✅ FIX: Prevent flickering */
        transform: translate3d(0, 0, 0);
        -webkit-transform: translate3d(0, 0, 0);
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
    }
    .info-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-md); }
    .info-icon {
        width: 60px; height: 60px;
        background: var(--gradient-primary);
        color: white;
        border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 20px;
        box-shadow: 0 10px 25px rgba(30,58,138,0.25);
    }
    
    .address-text {
        display: flex;
        flex-direction: column;
        gap: 6px;
        color: var(--slate);
        line-height: 1.6;
    }
    .address-line { line-height: 1.6; }

    /* ============ FOOTER ============ */
    footer {
        background: var(--gradient-dark);
        color: white;
        padding: 80px 0 30px;
        position: relative;
        overflow: hidden;
    }
    footer::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            radial-gradient(circle at 10% 20%, rgba(30,58,138,0.25) 0%, transparent 40%),
            radial-gradient(circle at 90% 80%, rgba(59,130,246,0.15) 0%, transparent 40%);
    }
    footer .container { position: relative; z-index: 1; }
    .footer-logo {
        display: inline-flex; align-items: center; gap: 12px;
        margin-bottom: 20px;
        font-family: 'Poppins', sans-serif;
        font-weight: 700; font-size: 1.4rem;
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
    .footer-menu a:hover { color: #93c5fd; transform: translateX(6px); }

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
        box-shadow: 0 10px 30px rgba(30,58,138,0.35);
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transform: translateY(20px);
        transition: all 0.3s;
        z-index: 999;
        /* ✅ FIX: Prevent flickering */
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
    }
    .scroll-top.show { opacity: 1; visibility: visible; transform: translateY(0); }
    .scroll-top:hover { transform: translateY(-4px); box-shadow: 0 15px 40px rgba(59,130,246,0.5); }

    /* ============ RESPONSIVE ============ */
    @media (max-width: 768px) {
        .hero-section { padding: 80px 0 60px; text-align: center; }
        .hero-subtitle { margin-left: auto; margin-right: auto; text-align: center; }
        .section { padding: 60px 0; }
        .navbar-brand img { max-height: 42px; }
        .hero-decor { display: none; }
        .d-flex.gap-3.flex-wrap { justify-content: center; gap: 12px !important; }
        .btn-hero-primary, .btn-hero-outline { width: 100%; max-width: 320px; justify-content: center; padding: 14px 20px; }
        .doc-image { height: 200px; }
        .doc-content { padding: 20px; }
        .doc-title { font-size: 1rem; }
        
        .service-image { height: 100px; }
        .service-icon { width: 36px; height: 36px; font-size: 1rem; top: 12px; right: 12px; }
        .service-content { padding: 0 20px 20px 20px; }
        .service-card h5 { font-size: 1.05rem; margin-bottom: 8px; }
        .service-card p { font-size: 0.85rem; line-height: 1.5; }
    }

    @media (max-width: 576px) {
        .hero-section { padding: 60px 0 40px; }
        .hero-title { font-size: 1.6rem; line-height: 1.3; margin-bottom: 16px; }
        .hero-subtitle { font-size: 0.9rem; margin-bottom: 24px; padding: 0 10px; }
        .stats-grid { grid-template-columns: 1fr; gap: 16px; padding: 0 10px; }
        .stat-card { padding: 18px 20px; align-items: center; }
        .stat-icon { width: 48px; height: 48px; font-size: 1.1rem; flex-shrink: 0; }
        .stat-card h3 { font-size: 1.35rem; margin-bottom: 2px; }
        .stat-label { font-size: 0.8rem; }
        .stat-note { font-size: 0.7rem; }
        .row.mt-5 { margin-top: 2rem !important; }
        .menu-card { padding: 28px 20px; margin-bottom: 0; }
        .menu-icon { width: 64px; height: 64px; font-size: 26px; margin-bottom: 16px; }
        .menu-card h5 { font-size: 1.05rem; margin-bottom: 8px; }
        .menu-card p { font-size: 0.85rem; margin-bottom: 12px; }
        
        .about-img-wrap { margin-bottom: 30px; }
        .about-pill { padding: 8px 16px; font-size: 0.8rem; margin: 4px; }
        .section-title { font-size: 1.5rem; text-align: center; }
        .section-subtitle { font-size: 0.9rem; text-align: center; }
        .info-card { padding: 28px 20px; text-align: center; }
        .info-icon { width: 56px; height: 56px; font-size: 1.4rem; margin: 0 auto 16px auto; }
        .info-card h5 { text-align: center; }
        .info-card p { text-align: center; }
        footer { padding: 50px 0 25px; text-align: center; }
        .footer-logo { justify-content: center; margin-bottom: 16px; }
        footer p { text-align: center; }
        footer h6 { text-align: center; margin-bottom: 16px; }
        .footer-menu { text-align: center; padding: 0; }
        .footer-menu li { margin-bottom: 10px; }
        .footer-menu a { justify-content: center; font-size: 0.9rem; }
        .scroll-top { bottom: 20px; right: 20px; width: 45px; height: 45px; }
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
                    <li class="nav-item"><a class="nav-link active" href="{{ route('landing') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="#layanan">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#dokumentasi">Dokumentasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>

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

    <!-- Hero -->
    <section class="hero-section" id="beranda">
        <div class="hero-decor">
            <span class="decor-dots dots-1"></span>
            <span class="decor-dots dots-2"></span>
            <i class="fas fa-plus decor-plus plus-1"></i>
            <i class="fas fa-plus decor-plus plus-2"></i>
            <i class="fas fa-plus decor-plus plus-3"></i>
            <i class="fas fa-plus decor-plus plus-4"></i>
            <span class="decor-circle circle-1"></span>
            <span class="decor-circle circle-2"></span>
        </div>
        <div class="container position-relative">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right" data-aos-duration="700">
                    @php
                        $heroText = \App\Models\Setting::get('hero_title', "Selamat Datang di\nSistem Informasi UKS\nSMK Negeri 1 Bangsri");
                        $heroText = str_replace(['<br>', '<br/>', '<br />'], "\n", $heroText);
                        $heroText = strip_tags($heroText);
                        $lines = explode("\n", trim($heroText));
                        $heroHtml = '';
                        foreach ($lines as $line) {
                            $line = trim(e($line));
                            if ($line === '') continue;
                            if (strpos($line, 'Sistem Informasi UKS') !== false) {
                                $heroHtml .= '<div class="hero-line hero-accent">' . $line . '</div>';
                            } else {
                                $heroHtml .= '<div class="hero-line">' . $line . '</div>';
                            }
                        }
                    @endphp
                    
                    <h1 class="hero-title">{!! $heroHtml !!}</h1>
                    <p class="hero-subtitle">{{ \App\Models\Setting::get('hero_subtitle', 'Layanan kesehatan sekolah yang modern, cepat, dan terpercaya. Kami siap melayani kebutuhan kesehatan siswa dengan profesional.') }}</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ auth()->check() && auth()->user()->hasRole('siswa') ? route('siswa.history') : route('login.siswa') }}" class="btn-hero-primary">
                            <i class="fas fa-history"></i> {{ \App\Models\Setting::get('hero_btn_1_text', 'Riwayat Kunjungan') }}
                        </a>
                        <a href="#tentang" class="btn-hero-outline">
                            <i class="fas fa-info-circle"></i> {{ \App\Models\Setting::get('hero_btn_2_text', 'Pelajari Lebih Lanjut') }}
                        </a>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-duration="700">
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fas fa-users"></i></div>
                            <div>
                                <h3>{{ number_format($totalStudents ?? 0) }}</h3>
                                <div class="stat-label">Siswa Terdaftar</div>
                                <div class="stat-note">Tahun Ajaran 2025/2026</div>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fas fa-clipboard-check"></i></div>
                            <div>
                                <h3>{{ $examsToday ?? 0 }}</h3>
                                <div class="stat-label">Kunjungan Hari Ini</div>
                                <div class="stat-note">Update: Hari Ini</div>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fas fa-heart-pulse"></i></div>
                            <div>
                                <h3>{{ $examsMonth ?? 0 }}</h3>
                                <div class="stat-label">Total Kunjungan</div>
                                <div class="stat-note">Bulan Ini</div>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fas fa-shield-alt"></i></div>
                            <div>
                                <h3>{{ $optimalPercentage ?? 100 }}%</h3>
                                <div class="stat-label">Layanan Optimal</div>
                                <div class="stat-note">Kami Siap Melayani</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menu Cards -->
            <div class="row g-4 mt-5 justify-content-center">
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="0">
                    <a href="{{ auth()->check() && auth()->user()->hasRole('siswa') ? route('siswa.history') : route('login.siswa') }}" class="menu-card">
                        <div class="menu-icon"><i class="fas fa-history"></i></div>
                        <h5 class="fw-bold mb-2">Riwayat Kunjungan</h5>
                        <p class="text-muted small mb-0">Cek riwayat rekam medis Anda</p>
                        @if(!auth()->check() || !auth()->user()->hasRole('siswa'))
                            <span class="card-tag tag-login"><i class="fas fa-lock"></i> Login Siswa</span>
                        @endif
                    </a>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                    <a href="{{ route('landing.medicines') }}" class="menu-card">
                        <div class="menu-icon"><i class="fas fa-pills"></i></div>
                        <h5 class="fw-bold mb-2">Informasi Obat</h5>
                        <p class="text-muted small mb-0">Daftar lengkap obat UKS</p>
                        <span class="card-tag tag-public"><i class="fas fa-globe"></i> Publik</span>
                    </a>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('landing.health-info') }}" class="menu-card">
                        <div class="menu-icon"><i class="fas fa-heartbeat"></i></div>
                        <h5 class="fw-bold mb-2">Informasi Kesehatan</h5>
                        <p class="text-muted small mb-0">Tips kesehatan dan kalkulator BMI</p>
                        <span class="card-tag tag-public"><i class="fas fa-globe"></i> Publik</span>
                    </a>
                </div>
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                    <a href="{{ route('landing.schedule') }}" class="menu-card">
                        <div class="menu-icon"><i class="fas fa-user-nurse"></i></div>
                        <h5 class="fw-bold mb-2">Jadwal Petugas</h5>
                        <p class="text-muted small mb-0">Jadwal bertugas petugas UKS</p>
                        <span class="card-tag tag-public"><i class="fas fa-globe"></i> Publik</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About -->
    <section class="section about-section" id="tentang">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-5" data-aos="fade-right">
                    <div class="about-img-wrap">
                        <img src="{{ asset('images/logo sikes.png') }}" alt="Tentang UKS">
                    </div>
                </div>
                <div class="col-lg-7" data-aos="fade-left">
                    <span class="section-label">{{ \App\Models\Setting::get('about_label', 'Tentang Kami') }}</span>
                    <h2 class="section-title">{!! \App\Models\Setting::get('about_title', 'Mengenal Lebih Dekat <span class="gradient-text">SIKES</span>') !!}</h2>
                    <p style="color: var(--slate); margin-bottom: 28px;">{{ \App\Models\Setting::get('about_desc', 'SIKES adalah sistem informasi berbasis web yang membantu Unit Kesehatan Sekolah (UKS) mengelola data kesehatan siswa secara digital, terintegrasi, dan efisien — mulai dari pencatatan pemeriksaan, pengelolaan stok obat, hingga pembuatan laporan.') }}</p>

                    <div class="d-flex flex-wrap gap-3">
                        <span class="about-pill"><i class="fas fa-database"></i> Data Digital</span>
                        <span class="about-pill"><i class="fas fa-link"></i> Terintegrasi</span>
                        <span class="about-pill"><i class="fas fa-bolt"></i> Efisien</span>
                        <span class="about-pill"><i class="fas fa-shield-alt"></i> Terpercaya</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services -->
    <section class="section services-section" id="layanan">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-label">{{ \App\Models\Setting::get('services_label', 'Layanan Kami') }}</span>
                <h2 class="section-title">{!! \App\Models\Setting::get('services_title', 'Layanan Kesehatan <span class="gradient-text">Profesional</span>') !!}</h2>
                <p class="section-subtitle mx-auto">{{ \App\Models\Setting::get('services_subtitle', 'Berbagai layanan kesehatan lengkap yang kami sediakan untuk siswa') }}</p>
            </div>
            <div class="row g-4">
                @php
                    $defaultServices = [
                        ['icon' => 'fa-stethoscope', 'title' => 'Pemeriksaan Kesehatan', 'desc' => 'Pemeriksaan rutin dan saat sakit dengan tenaga profesional.', 'image' => ''],
                        ['icon' => 'fa-pills', 'title' => 'Pelayanan Obat', 'desc' => 'Penyediaan obat lengkap dan terjamin kualitasnya.', 'image' => ''],
                        ['icon' => 'fa-heartbeat', 'title' => 'Pertolongan Pertama', 'desc' => 'Pertolongan pertama pada kecelakaan & keadaan darurat.', 'image' => ''],
                        ['icon' => 'fa-user-md', 'title' => 'Konsultasi Kesehatan', 'desc' => 'Konsultasi kesehatan fisik dan mental dengan petugas terlatih.', 'image' => ''],
                        ['icon' => 'fa-clipboard-check', 'title' => 'Pemeriksaan Berkala', 'desc' => 'Pemeriksaan berkala untuk memantau kondisi siswa.', 'image' => ''],
                        ['icon' => 'fa-graduation-cap', 'title' => 'Edukasi Kesehatan', 'desc' => 'Penyuluhan dan edukasi tentang pola hidup sehat.', 'image' => '']
                    ];
                    $servicesRaw = \App\Models\Setting::get('services_data', json_encode($defaultServices));
                    $servicesData = is_array($servicesRaw) ? $servicesRaw : json_decode($servicesRaw, true);
                @endphp
                
                @foreach($servicesData as $i => $s)
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                    <div class="service-card">
                        <div class="service-image-wrapper" 
                             data-bs-toggle="modal" 
                             data-bs-target="#serviceImageModal"
                             data-image="{{ !empty($s['image']) ? asset('storage/' . $s['image']) : 'https://via.placeholder.com/400x200/3b82f6/ffffff?text=Layanan+UKS' }}"
                             data-title="{{ $s['title'] ?? 'Layanan' }}">
                            
                            <img src="{{ !empty($s['image']) ? asset('storage/' . $s['image']) : 'https://via.placeholder.com/400x200/3b82f6/ffffff?text=Layanan+UKS' }}" 
                                 alt="{{ $s['title'] }}" 
                                 class="service-image"
                                 onerror="this.src='https://via.placeholder.com/400x200/3b82f6/ffffff?text=Layanan+UKS'">
                        </div>
                        
                        <div class="service-icon">
                            <i class="fas {{ $s['icon'] ?? 'fa-star' }}"></i>
                        </div>

                        <div class="service-content">
                            <h5 class="fw-bold">{{ $s['title'] ?? 'Layanan' }}</h5>
                            <p>{{ $s['desc'] ?? 'Deskripsi layanan' }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Documentation -->
    <section class="section" id="dokumentasi" style="background: linear-gradient(180deg, #fafbfc 0%, #f0f4f8 100%);">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-label">{{ \App\Models\Setting::get('docs_label', 'Dokumentasi') }}</span>
                <h2 class="section-title">{!! \App\Models\Setting::get('docs_title', 'Berita & <span class="gradient-text">Kegiatan</span>') !!}</h2>
                <p class="section-subtitle mx-auto">{{ \App\Models\Setting::get('docs_subtitle', 'Informasi terbaru seputar kegiatan dan program UKS di sekolah kami') }}</p>
            </div>

            <div class="row g-4">
                @forelse($documentations as $index => $doc)
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="doc-card">
                            <div class="doc-image">
                                <img src="{{ $doc->image ? asset('storage/' . $doc->image) : 'https://via.placeholder.com/600x400/3b82f6/ffffff?text=Dokumentasi+UKS' }}" 
                                     alt="{{ $doc->title }}" 
                                     onerror="this.src='https://via.placeholder.com/600x400/3b82f6/ffffff?text=Dokumentasi+UKS'">
                                
                                @if(!empty($doc->video_link))
                                    <a href="{{ $doc->video_link }}" 
                                       target="_blank" 
                                       class="video-overlay" 
                                       title="Putar Video">
                                        <i class="fas fa-play-circle"></i>
                                    </a>
                                @endif
                            </div>
                            <div class="doc-content">
                                <div class="doc-meta">
                                    <span><i class="far fa-calendar"></i> {{ \Carbon\Carbon::parse($doc->published_at)->format('d F Y') }}</span>
                                    @if(!empty($doc->video_link))
                                        <span class="badge-video"><i class="fas fa-video"></i> Video</span>
                                    @endif
                                </div>
                                <h5 class="doc-title">
                                    <a href="{{ !empty($doc->video_link) ? $doc->video_link : route('landing.docs-detail', \Illuminate\Support\Str::slug($doc->title)) }}" 
                                       target="{{ !empty($doc->video_link) ? '_blank' : '_self' }}">
                                        {{ \Illuminate\Support\Str::limit($doc->title, 65) }}
                                    </a>
                                </h5>
                                @if(!empty($doc->excerpt))
                                    <p class="doc-excerpt">{{ \Illuminate\Support\Str::limit($doc->excerpt, 90) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5" data-aos="fade-up">
                        <i class="far fa-folder-open fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada dokumentasi atau berita yang dipublikasikan.</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-5" data-aos="fade-up">
                <a href="{{ route('landing.docs') }}" class="btn-doc-all">
                    Semua Berita <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Contact -->
    <section class="section contact-section" id="kontak">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-label">{{ \App\Models\Setting::get('contact_label', 'Hubungi Kami') }}</span>
                <h2 class="section-title">{!! \App\Models\Setting::get('contact_title', 'Siap Melayani <span class="gradient-text">Anda</span>') !!}</h2>
                <p class="section-subtitle mx-auto">{{ \App\Models\Setting::get('contact_subtitle', 'Hubungi kami untuk informasi lebih lanjut tentang layanan UKS') }}</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="0">
                    <div class="info-card">
                        <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <h5 class="fw-bold mb-3">Alamat Kami</h5>
                        @php
                            $addressText = \App\Models\Setting::get('contact_address', "Komplek SMK Negeri 1 Bangsri\nJalan KH. Achmad Fauzan No.17, Bangsri, Jepara\nJawa Tengah, 59453");
                            $addressText = str_replace(['<br>', '<br/>', '<br />'], "\n", $addressText);
                            $addressText = strip_tags($addressText);
                            $addressLines = explode("\n", trim($addressText));
                        @endphp
                        <div class="address-text">
                            @foreach($addressLines as $line)
                                @if(trim($line) !== '')
                                    <div class="address-line">{{ e(trim($line)) }}</div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="info-card">
                        <div class="info-icon"><i class="fab fa-instagram"></i></div>
                        <h5 class="fw-bold mb-3">Sosial Media</h5>
                        <p style="color: var(--slate); line-height: 2; margin-bottom: 0;">
                            <i class="fab fa-instagram me-2 text-danger"></i>
                            <a href="{{ \App\Models\Setting::get('contact_ig_link', 'https://instagram.com/pmrwira_eskasaba') }}" target="_blank" style="color: var(--ink); text-decoration: none; font-weight: 600;">
                                {{ '@' . \App\Models\Setting::get('contact_ig_handle', 'pmrwira_eskasaba') }}
                            </a><br>
                            <i class="fab fa-youtube me-2 text-danger"></i>
                            <a href="{{ \App\Models\Setting::get('contact_yt_link', 'https://youtube.com/@wirasandyaadhimukti3463') }}" target="_blank" style="color: var(--ink); text-decoration: none; font-weight: 600;">
                                {{ '@' . \App\Models\Setting::get('contact_yt_handle', 'wirasandyaadhimukti3463') }}
                            </a>
                        </p>
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
                        <span>SIKES</span>
                    </div>
                    <p style="color: rgba(255,255,255,0.7); line-height: 1.8; margin-bottom: 24px;">
                        {{ \App\Models\Setting::get('footer_desc', 'Sistem Informasi Unit Kesehatan Sekolah modern dan terpercaya untuk meningkatkan kualitas kesehatan seluruh warga sekolah.') }}
                    </p>
                </div>

                <div class="col-6 col-lg-2">
                    <h6>Navigasi</h6>
                    <ul class="footer-menu">
                        <li><a href="{{ route('landing') }}"><i class="fas fa-chevron-right fa-xs"></i> Beranda</a></li>
                        <li><a href="{{ route('landing') }}#tentang"><i class="fas fa-chevron-right fa-xs"></i> Tentang</a></li>
                        <li><a href="{{ route('landing') }}#layanan"><i class="fas fa-chevron-right fa-xs"></i> Layanan</a></li>
                        <li><a href="{{ route('landing') }}#dokumentasi"><i class="fas fa-chevron-right fa-xs"></i> Dokumentasi</a></li>
                        <li><a href="{{ route('landing') }}#kontak"><i class="fas fa-chevron-right fa-xs"></i> Kontak</a></li>
                    </ul>
                </div>

                <div class="col-6 col-lg-3">
                    <h6>Layanan</h6>
                    <ul class="footer-menu">
                        <li><a href="{{ route('landing.medicines') }}"><i class="fas fa-chevron-right fa-xs"></i> Informasi Obat</a></li>
                        <li><a href="{{ route('landing.health-info') }}"><i class="fas fa-chevron-right fa-xs"></i> Informasi Kesehatan</a></li>
                        <li><a href="{{ route('landing.schedule') }}"><i class="fas fa-chevron-right fa-xs"></i> Jadwal Petugas</a></li>
                        <li><a href="{{ auth()->check() && auth()->user()->hasRole('siswa') ? route('siswa.history') : route('login.siswa') }}"><i class="fas fa-chevron-right fa-xs"></i> Riwayat</a></li>
                    </ul>
                </div>

                <div class="col-lg-3">
                    <h6>Kontak</h6>
                    <ul class="footer-menu">
                        <li><a href="#"><i class="fas fa-map-marker-alt"></i> Jl. KH. Achmad Fauzan No.17, Bangsri</a></li>
                        <li>
                            <a href="{{ \App\Models\Setting::get('contact_ig_link', '#') }}" target="_blank">
                                <i class="fab fa-instagram"></i> {{ '@' . \App\Models\Setting::get('contact_ig_handle', 'pmrwira_eskasaba') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ \App\Models\Setting::get('contact_yt_link', '#') }}" target="_blank">
                                <i class="fab fa-youtube"></i> {{ '@' . \App\Models\Setting::get('contact_yt_handle', 'wirasandyaadhimukti3463') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p class="mb-0">{!! \App\Models\Setting::get('footer_copyright', '&copy; ' . date('Y') . ' <strong>SIKES</strong> - Sistem Informasi UKS SMK Negeri 1 Bangsri. All rights reserved.') !!}</p>
            </div>
        </div>
    </footer>

    <!-- Modal Preview -->
    <div class="modal fade" id="serviceImageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="serviceImageModalLabel">Preview Gambar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-4">
                    <img src="" id="modalServiceImage" class="img-fluid rounded" style="max-height: 60vh; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll to Top -->
    <button class="scroll-top" id="scrollTop">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // ✅ FIX: Initialize AOS with safer settings
        document.addEventListener('DOMContentLoaded', function() {
            try {
                AOS.init({ 
                    duration: 800, 
                    once: true, 
                    offset: 80,
                    disable: function() {
                        // Disable AOS on mobile if causing issues
                        var maxWidth = 768;
                        return window.innerWidth < maxWidth;
                    }
                });
            } catch(e) {
                console.log('AOS initialization error:', e);
            }

            // Scroll handler
            window.addEventListener('scroll', function() {
                const navbar = document.querySelector('.navbar');
                const scrollTop = document.getElementById('scrollTop');
                
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
                
                if (window.scrollY > 300) {
                    scrollTop.classList.add('show');
                } else {
                    scrollTop.classList.remove('show');
                }
            }, { passive: true }); // ✅ FIX: Use passive listener for better performance

            // Scroll to top
            document.getElementById('scrollTop').addEventListener('click', function() {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            // Active nav link handler
            const sections = document.querySelectorAll("section[id]");
            const navLinks = document.querySelectorAll(".nav-link");

            window.addEventListener("scroll", function() {
                let current = "";
                sections.forEach((section) => {
                    const sectionTop = section.offsetTop;
                    if (pageYOffset >= (sectionTop - 150)) {
                        current = section.getAttribute("id");
                    }
                });

                navLinks.forEach((link) => {
                    link.classList.remove("active");
                    if (link.getAttribute("href") === "#" + current) {
                        link.classList.add("active");
                    } else if (current === "" && (link.getAttribute("href") === "{{ route('landing') }}" || link.getAttribute("href") === "#beranda")) {
                        link.classList.add("active");
                    }
                });
            }, { passive: true });

            // Modal handler
            const serviceImageModal = document.getElementById('serviceImageModal');
            if (serviceImageModal) {
                serviceImageModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    const imageUrl = button.getAttribute('data-image');
                    const imageTitle = button.getAttribute('data-title');
                    
                    const modalImg = serviceImageModal.querySelector('#modalServiceImage');
                    const modalTitle = serviceImageModal.querySelector('#serviceImageModalLabel');
                    
                    modalImg.src = imageUrl;
                    modalTitle.textContent = imageTitle;
                });
            }
        });
    </script>
</body>
</html>