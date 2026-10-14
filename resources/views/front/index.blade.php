<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PosIND Pematangsiantar - Solusi Logistik Terpercaya</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        :root { 
            --primary-navy: #003B73; 
            --primary-navy-hover: #002D59;
            --primary-navy-dark: #001F3F;
            --accent-orange: #F7941D; 
            --accent-orange-hover: #E08316;
            --accent-gold: #FFC107;
            --accent-green: #27AE60;
            --accent-green-hover: #219653;
            --bg-light: #F8FAFC;
            --bg-white: #FFFFFF;
            --text-dark: #1E293B;
            --text-muted: #64748B;
            --border-light: #E2E8F0;
            --shadow-sm: 0 4px 15px rgba(0,0,0,0.03);
            --shadow-md: 0 10px 30px rgba(0, 59, 115, 0.08);
            --shadow-lg: 0 20px 45px rgba(0, 59, 115, 0.12);
        }

        html {
            scroll-behavior: smooth;
        }

        body { 
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; 
            background-color: var(--bg-light); 
            color: var(--text-dark); 
            margin: 0; 
            padding-top: 80px; 
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* ==========================================================================
           ANIMASI SCROLL & VARIASI EFEK ELEMEN (CREATIVE CORPORATE CLEAN UI)
           ========================================================================== */
        .reveal, 
        .reveal-left, 
        .reveal-right, 
        .reveal-down, 
        .reveal-up, 
        .reveal-zoom, 
        .reveal-tilt-left, 
        .reveal-tilt-right,
        .reveal-pop,
        .reveal-zoom-glow {
            opacity: 0;
            transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1), 
                        transform 0.85s cubic-bezier(0.16, 1, 0.3, 1),
                        box-shadow 0.85s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }

        /* 1. Muncul dari Bawah */
        .reveal, .reveal-up {
            transform: translateY(40px);
        }
        .reveal.active, .reveal-up.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* 2. Muncul dari KIRI */
        .reveal-left {
            transform: translateX(-65px);
        }
        .reveal-left.active {
            opacity: 1;
            transform: translateX(0);
        }

        /* 3. Muncul dari KANAN */
        .reveal-right {
            transform: translateX(65px);
        }
        .reveal-right.active {
            opacity: 1;
            transform: translateX(0);
        }

        /* 4. Muncul dari ATAS (Untuk Judul & Subjudul Section) */
        .reveal-down {
            transform: translateY(-35px);
        }
        .reveal-down.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* 5. Muncul dengan ZOOM POP dari TENGAH */
        .reveal-zoom {
            transform: scale(0.88);
        }
        .reveal-zoom.active {
            opacity: 1;
            transform: scale(1);
        }

        /* 6. Muncul dengan 3D TILT SUDUT KIRI */
        .reveal-tilt-left {
            transform: perspective(1000px) rotateY(10deg) translateY(30px);
        }
        .reveal-tilt-left.active {
            opacity: 1;
            transform: perspective(1000px) rotateY(0) translateY(0);
        }

        /* 7. Muncul dengan 3D TILT SUDUT KANAN */
        .reveal-tilt-right {
            transform: perspective(1000px) rotateY(-10deg) translateY(30px);
        }
        .reveal-tilt-right.active {
            opacity: 1;
            transform: perspective(1000px) rotateY(0) translateY(0);
        }

        /* 8. Pop In Halus */
        .reveal-pop {
            transform: scale(0.85) translateY(20px);
        }
        .reveal-pop.active {
            opacity: 1;
            transform: scale(1) translateY(0);
        }

        /* 9. Zoom Glow Khusus untuk Kartu Rekomendasi POS Indonesia */
        .reveal-zoom-glow {
            transform: scale(0.92) translateY(25px);
        }
        .reveal-zoom-glow.active {
            opacity: 1;
            transform: scale(1.02) translateY(0);
            box-shadow: 0 16px 36px rgba(247, 148, 29, 0.22);
        }

        /* Stagger Delays */
        .delay-1 { transition-delay: 0.15s; }
        .delay-2 { transition-delay: 0.30s; }
        .delay-3 { transition-delay: 0.45s; }
        .delay-4 { transition-delay: 0.60s; }

        @keyframes pulseSubtle {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 4px 12px rgba(247, 148, 29, 0.3);
            }
            50% {
                transform: scale(1.04);
                box-shadow: 0 6px 20px rgba(247, 148, 29, 0.55);
            }
        }

        @keyframes badgeLiveGlow {
            0%, 100% {
                opacity: 1;
                transform: scale(1);
            }
            50% {
                opacity: 0.5;
                transform: scale(1.3);
            }
        }

        @keyframes floatGentle {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }

        /* ==========================================================================
           NAVBAR & BRANDING
           ========================================================================== */
        .navbar-public { 
            background-color: rgba(255, 255, 255, 0.96); 
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            height: 80px; 
            box-shadow: 0 4px 20px rgba(0,0,0,0.04); 
            position: fixed; 
            top: 0; 
            width: 100%; 
            z-index: 1030; 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            padding: 0 5%;
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            transition: height 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
        }
        .navbar-public.navbar-scrolled {
            height: 72px;
            box-shadow: 0 8px 30px rgba(0, 59, 115, 0.08);
            background-color: rgba(255, 255, 255, 0.98);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        .navbar-brand img { 
            height: 42px; 
            transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .navbar-brand:hover img {
            transform: scale(1.06);
        }
        .brand-text {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .brand-text .branch {
            font-size: 11px;
            font-weight: 800;
            color: var(--accent-orange);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            line-height: 1.1;
            margin-bottom: 2px;
        }
        .brand-text .city {
            font-size: 18px;
            font-weight: 800;
            color: var(--primary-navy);
            line-height: 1.1;
            letter-spacing: -0.5px;
        }

        .nav-links {
            display: flex;
            align-items: center;
        }
        .nav-links a { 
            text-decoration: none; 
            color: var(--primary-navy); 
            font-weight: 600; 
            margin-left: 28px; 
            font-size: 14.5px; 
            transition: color 0.3s ease; 
            position: relative;
            padding: 6px 0;
        }
        .nav-links a:not(.btn-login-nav)::after {
            content: "";
            position: absolute;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--accent-orange), #ffb300);
            bottom: 0;
            left: 0;
            border-radius: 2px;
            transition: width 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .nav-links a:not(.btn-login-nav):hover::after,
        .nav-links a:not(.btn-login-nav).active::after {
            width: 100%;
        }
        .nav-links a:not(.btn-login-nav):hover,
        .nav-links a:not(.btn-login-nav).active {
            color: var(--accent-orange);
        }

        .btn-login-nav { 
            background: linear-gradient(135deg, var(--primary-navy) 0%, #004d99 100%); 
            color: #fff !important; 
            padding: 10px 22px !important; 
            border-radius: 10px; 
            font-size: 14px; 
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0, 59, 115, 0.2);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            display: inline-flex;
            align-items: center;
            border: none;
        }
        .btn-login-nav:hover { 
            background: linear-gradient(135deg, #00284d 0%, var(--primary-navy) 100%); 
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(0, 59, 115, 0.32);
            color: #fff !important; 
        }
        .btn-login-nav:active {
            transform: translateY(0);
        }

        /* ==========================================================================
           HERO SECTION & FORM
           ========================================================================== */
        .hero-section { 
            background: radial-gradient(circle at 85% 20%, rgba(247, 148, 29, 0.15) 0%, transparent 45%),
                        radial-gradient(circle at 15% 85%, rgba(0, 80, 158, 0.25) 0%, transparent 50%),
                        linear-gradient(135deg, #001428 0%, #00284d 50%, var(--primary-navy) 100%);
            position: relative;
            color: #fff; 
            padding: 90px 5% 100px 5%; 
            display: flex; 
            flex-wrap: wrap; 
            align-items: center; 
            overflow: hidden;
        }
        .hero-section::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: radial-gradient(rgba(255, 255, 255, 0.07) 1px, transparent 1px);
            background-size: 28px 28px;
            opacity: 0.6;
            pointer-events: none;
        }
        .hero-text { 
            flex: 1.1; 
            min-width: 320px; 
            padding-right: 45px; 
            position: relative;
            z-index: 2;
        }
        .hero-badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            color: #f1f5f9;
            margin-bottom: 22px;
        }
        .hero-badge-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #22c55e;
            animation: badgeLiveGlow 2s infinite ease-in-out;
        }
        .hero-text h1 { 
            font-size: 44px; 
            font-weight: 800; 
            margin-bottom: 20px; 
            line-height: 1.22; 
            letter-spacing: -0.6px;
        }
        .hero-text h1 .text-highlight-orange { 
            color: var(--accent-orange); 
            text-shadow: 0 2px 15px rgba(247, 148, 29, 0.35);
        }
        .hero-text p.hero-desc { 
            font-size: 16.5px; 
            color: rgba(255,255,255,0.85); 
            margin-bottom: 28px; 
            line-height: 1.65;
            max-width: 540px;
        }
        .hero-cs-box {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 202, 40, 0.35);
            padding: 12px 20px;
            border-radius: 12px;
            color: #ffca28;
            font-weight: 700;
            font-size: 15px;
            text-shadow: 0 1px 3px rgba(0,0,0,0.4);
            transition: all 0.3s ease;
            backdrop-filter: blur(6px);
            text-decoration: none;
        }
        .hero-cs-box:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: #ffca28;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
        }
        
        .hero-form { 
            flex: 0.9; 
            min-width: 320px; 
            background: #ffffff; 
            padding: 38px; 
            border-radius: 20px; 
            box-shadow: 0 25px 60px rgba(0, 15, 40, 0.35); 
            position: relative;
            z-index: 2;
            border: 1px solid rgba(255, 255, 255, 0.8);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hero-form:hover {
            box-shadow: 0 30px 70px rgba(0, 15, 40, 0.42);
        }
        .hero-form h3 { 
            color: var(--primary-navy); 
            font-weight: 800; 
            font-size: 21px; 
            margin-bottom: 22px;
            letter-spacing: -0.3px;
            display: flex;
            align-items: center;
        }
        .form-label { 
            font-size: 12px; 
            font-weight: 700; 
            color: var(--text-muted); 
            margin-bottom: 8px; 
            text-transform: uppercase; 
            letter-spacing: 0.6px;
        }
        .form-control { 
            background-color: var(--bg-light); 
            border: 1px solid var(--border-light); 
            padding: 13px 16px; 
            border-radius: 10px; 
            margin-bottom: 18px; 
            font-size: 14.5px; 
            font-weight: 500; 
            color: var(--text-dark);
            transition: all 0.25s ease;
        }
        .form-control:focus { 
            border-color: var(--primary-navy); 
            box-shadow: 0 0 0 4px rgba(0, 59, 115, 0.12); 
            background-color: #ffffff;
        }
        .form-control:disabled { 
            background-color: #f1f5f9; 
            cursor: not-allowed; 
            opacity: 0.8;
        }
        
        .btn-cek { 
            width: 100%; 
            background: linear-gradient(135deg, var(--accent-orange) 0%, #ff9f43 100%); 
            color: #fff; 
            border: none; 
            padding: 14px 20px; 
            border-radius: 10px; 
            font-weight: 750; 
            font-size: 15px; 
            cursor: pointer; 
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1); 
            box-shadow: 0 6px 18px rgba(247, 148, 29, 0.35);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            position: relative;
            overflow: hidden;
        }
        .btn-cek::after {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 60%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transform: skewX(-25deg);
            transition: left 0.6s ease;
        }
        .btn-cek:hover::after {
            left: 150%;
        }
        .btn-cek:hover { 
            background: linear-gradient(135deg, #e08316 0%, var(--accent-orange) 100%); 
            transform: translateY(-2px); 
            box-shadow: 0 10px 25px rgba(247, 148, 29, 0.45);
            color: #fff;
        }
        .btn-cek:active {
            transform: translateY(0) scale(0.99);
        }

        /* ==========================================================================
           SECTION HEADERS (GLOBAL)
           ========================================================================== */
        .section-title { 
            text-align: center; 
            color: var(--primary-navy); 
            font-weight: 800; 
            font-size: 32px; 
            margin-bottom: 45px; 
            position: relative;
            letter-spacing: -0.5px;
        }
        .section-title::after {
            content: "";
            position: absolute;
            bottom: -14px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-orange), #ffca28);
            border-radius: 4px;
            transition: width 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.2s;
        }
        .section-title.active::after,
        .reveal.active .section-title::after,
        .reveal-down.active .section-title::after,
        .reveal-down.active.section-title::after {
            width: 64px;
        }
        .section-subtitle {
            text-align: center;
            color: var(--text-muted);
            font-size: 15.5px;
            max-width: 620px;
            margin: -25px auto 45px auto;
            line-height: 1.6;
        }

        /* ==========================================================================
           HASIL ONGKIR SECTION
           ========================================================================== */
        .result-section { 
            padding: 70px 5% 40px 5%; 
            background-color: var(--bg-light); 
            border-bottom: 1px solid var(--border-light);
            overflow-x: hidden;
        }
        .ongkir-list { 
            display: flex; 
            flex-direction: column; 
            gap: 16px; 
            max-width: 840px; 
            margin: 0 auto;
        }
        .ongkir-card { 
            background: #fff; 
            border-radius: 14px; 
            padding: 22px 28px; 
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03); 
            border: 1px solid var(--border-light); 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            flex-wrap: wrap; 
            gap: 16px; 
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
        }
        .ongkir-card:hover { 
            transform: translateX(6px); 
            box-shadow: 0 10px 25px rgba(0, 59, 115, 0.08); 
            border-color: #cbd5e1;
        }
        
        .brand-col { 
            display: flex; 
            align-items: center; 
            gap: 16px; 
            min-width: 220px;
        }
        .brand-color-box { 
            width: 48px; 
            height: 48px; 
            border-radius: 12px; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            color: #fff; 
            font-size: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .ongkir-card:hover .brand-color-box {
            transform: scale(1.08);
        }
        .brand-name { 
            font-weight: 800; 
            color: var(--primary-navy); 
            font-size: 16.5px; 
            margin-bottom: 3px;
        }
        .brand-service { 
            font-size: 12px; 
            color: var(--text-muted); 
            font-weight: 600; 
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        
        .price-col { 
            text-align: right; 
        }
        .price-val { 
            font-size: 23px; 
            font-weight: 800; 
            color: var(--text-dark); 
            margin-bottom: 2px;
            letter-spacing: -0.5px;
        }
        .price-eta { 
            font-size: 12.5px; 
            color: var(--text-muted); 
            font-weight: 500;
        }

        .ongkir-card.pos-highlight { 
            background: linear-gradient(135deg, #fff9f2 0%, #ffffff 100%); 
            border: 2px solid var(--accent-orange); 
            z-index: 2; 
            margin-bottom: 6px;
        }
        .ongkir-card.pos-highlight:hover {
            transform: scale(1.02) translateX(6px);
            box-shadow: 0 18px 40px rgba(247, 148, 29, 0.28);
        }
        .ongkir-card.pos-highlight .price-val { 
            color: var(--accent-orange); 
        }
        .badge-cheapest { 
            background: linear-gradient(135deg, var(--accent-orange), #ff9f43); 
            color: #fff; 
            font-size: 11px; 
            padding: 5px 14px; 
            border-radius: 20px; 
            font-weight: 800; 
            letter-spacing: 0.6px; 
            position: absolute; 
            top: -13px; 
            right: 25px; 
            box-shadow: 0 4px 12px rgba(247, 148, 29, 0.4);
            animation: pulseSubtle 3s infinite ease-in-out;
        }

        /* Front Ongkir Styles */
        .dropdown-menu-search-front {
            position: absolute;
            top: calc(100% + 4px);
            left: 0;
            right: 0;
            z-index: 70;
            background: #FFFFFF;
            border: 1px solid var(--border-light);
            border-radius: 12px;
            max-height: 280px;
            overflow-y: auto;
            box-shadow: 0 16px 36px -4px rgba(0, 59, 115, 0.18), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            text-align: left;
        }
        .dropdown-menu-search-front::-webkit-scrollbar {
            width: 6px;
        }
        .dropdown-menu-search-front::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 10px;
        }
        .front-courier-logo {
            width: 52px;
            height: 48px;
            border-radius: 12px;
            background: #FFFFFF;
            border: 1px solid var(--border-light);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4px 6px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            flex-shrink: 0;
        }
        .front-courier-logo img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
        .front-preset-btn {
            padding: 4px 10px;
            font-size: 11.5px;
            font-weight: 700;
            border-radius: 6px;
            border: 1px solid var(--border-light);
            background: var(--bg-light);
            color: var(--text-muted);
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .front-preset-btn:hover {
            border-color: var(--accent-orange);
            color: var(--accent-orange);
            background: #FFF5EA;
        }
        .front-preset-btn.active {
            border-color: var(--accent-orange);
            background: var(--accent-orange);
            color: #FFFFFF;
            box-shadow: 0 2px 6px rgba(247, 148, 29, 0.3);
        }
        .front-filter-tab {
            padding: 7px 16px;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        /* ==========================================================================
           CARA KIRIM SECTION (HOW IT WORKS)
           ========================================================================== */
        .how-it-works-section { 
            padding: 90px 5%; 
            background-color: var(--bg-light); 
            border-top: 1px solid var(--border-light); 
            overflow-x: hidden;
        }
        .method-card { 
            background: #fff; 
            border-radius: 18px; 
            padding: 38px 32px; 
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.04); 
            height: 100%; 
            position: relative; 
            border: 1px solid var(--border-light); 
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
        }
        .method-card:hover { 
            transform: translateY(-8px); 
            box-shadow: 0 20px 45px rgba(0, 59, 115, 0.09); 
            border-color: #cbd5e1;
        }
        .method-card.premium { 
            border-top: 5px solid var(--accent-orange); 
        }
        .method-card.digital { 
            border-top: 5px solid var(--primary-navy); 
        }
        .method-badge { 
            position: absolute; 
            top: -15px; 
            right: 25px; 
            padding: 6px 16px; 
            border-radius: 20px; 
            font-size: 11.5px; 
            font-weight: 800; 
            color: #fff; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            letter-spacing: 0.3px;
        }
        .method-badge.orange { background: linear-gradient(135deg, var(--accent-orange), #ff9f43); }
        .method-badge.navy { background: linear-gradient(135deg, var(--primary-navy), #00509e); }

        .method-title { 
            font-size: 22px; 
            font-weight: 800; 
            color: var(--primary-navy); 
            margin-bottom: 12px; 
            letter-spacing: -0.3px;
        }
        .method-desc { 
            font-size: 14.5px; 
            color: var(--text-muted); 
            line-height: 1.6; 
            margin-bottom: 28px; 
        }
        .step-list { 
            display: flex; 
            flex-direction: column; 
            gap: 20px; 
            margin-bottom: auto;
        }
        .step-item { 
            display: flex; 
            gap: 16px; 
            transition: transform 0.25s ease;
        }
        .step-item:hover {
            transform: translateX(5px);
        }
        .step-icon-wrap { 
            width: 46px; 
            height: 46px; 
            border-radius: 12px; 
            background-color: var(--bg-light); 
            color: var(--primary-navy); 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 18px; 
            flex-shrink: 0; 
            border: 1px solid var(--border-light);
            transition: all 0.3s ease;
        }
        .step-item:hover .step-icon-wrap {
            transform: scale(1.12);
        }
        .method-card.premium .step-icon-wrap { 
            color: var(--accent-orange); 
            background-color: #FFF5EA; 
            border-color: #ffe0b2;
        }
        .step-content h5 { 
            font-size: 15.5px; 
            font-weight: 750; 
            color: var(--text-dark); 
            margin-bottom: 4px;
        }
        .step-content p { 
            font-size: 13.5px; 
            color: var(--text-muted); 
            margin: 0; 
            line-height: 1.5;
        }

        .btn-app-store {
            background: var(--primary-navy);
            color: #fff;
            padding: 12px 18px;
            border-radius: 10px;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 4px 12px rgba(0, 59, 115, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.1);
            text-decoration: none;
        }
        .btn-app-store:hover { 
            transform: translateY(-3px); 
            box-shadow: 0 10px 20px rgba(0, 59, 115, 0.3); 
            background-color: var(--primary-navy-hover) !important;
            color: #fff !important;
        }

        /* ==========================================================================
           KEUNGGULAN / FEATURES SECTION
           ========================================================================== */
        .features-section { 
            padding: 90px 5%; 
            background-color: #ffffff; 
            border-top: 1px solid var(--border-light);
            overflow-x: hidden;
        }
        .features-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); 
            gap: 30px; 
        }
        .feature-box { 
            text-align: center; 
            padding: 45px 30px; 
            background-color: var(--bg-light); 
            border-radius: 18px; 
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1); 
            border: 1px solid var(--border-light);
            position: relative;
            overflow: hidden;
        }
        .feature-box::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-navy), var(--accent-orange));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .feature-box:hover::before {
            transform: scaleX(1);
        }
        .feature-box:hover { 
            transform: translateY(-8px); 
            box-shadow: 0 18px 40px rgba(0, 59, 115, 0.08); 
            background-color: #ffffff;
            border-color: #cbd5e1;
        }
        .feature-icon { 
            width: 76px; 
            height: 76px; 
            margin: 0 auto 24px auto; 
            background: linear-gradient(135deg, #FFF5EA 0%, #ffffff 100%); 
            color: var(--accent-orange); 
            border-radius: 50%; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 30px;
            box-shadow: 0 8px 20px rgba(247, 148, 29, 0.15);
            transition: transform 0.35s ease;
        }
        .feature-box:hover .feature-icon {
            transform: scale(1.15) rotate(6deg);
        }
        .feature-box h4 { 
            color: var(--primary-navy); 
            font-weight: 800; 
            font-size: 19px; 
            margin-bottom: 14px;
            letter-spacing: -0.3px;
        }
        .feature-box p { 
            color: var(--text-muted); 
            font-size: 14.5px; 
            line-height: 1.6; 
            margin: 0;
        }

        /* ==========================================================================
           PROMO SECTION
           ========================================================================== */
        .promo-section { 
            padding: 90px 5%; 
            background-color: var(--bg-light); 
            border-top: 1px solid var(--border-light);
            overflow-x: hidden;
        }
        .promo-card { 
            background: #fff; 
            border-radius: 16px; 
            padding: 28px; 
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.04); 
            height: 100%; 
            border-top: 4px solid var(--accent-orange); 
            border-left: 1px solid var(--border-light);
            border-right: 1px solid var(--border-light);
            border-bottom: 1px solid var(--border-light);
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1); 
            display: flex; 
            flex-direction: column;
        }
        .promo-card:hover { 
            transform: translateY(-8px); 
            box-shadow: 0 20px 40px rgba(0, 59, 115, 0.09); 
            border-color: #cbd5e1;
        }
        .promo-title { 
            font-size: 18.5px; 
            font-weight: 800; 
            color: var(--primary-navy); 
            margin-bottom: 10px; 
            line-height: 1.35;
            letter-spacing: -0.3px;
        }
        .promo-date { 
            font-size: 12.5px; 
            color: var(--accent-orange); 
            font-weight: 700; 
            margin-bottom: 16px; 
            display: inline-flex; 
            align-items: center;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .promo-preview { 
            flex-grow: 1; 
            font-size: 14px; 
            color: var(--text-muted); 
            line-height: 1.6; 
            max-height: 120px; 
            overflow: hidden; 
            position: relative; 
            margin-bottom: 22px; 
        }
        .promo-preview::after { 
            content: ""; 
            position: absolute; 
            bottom: 0; 
            left: 0; 
            right: 0; 
            height: 45px; 
            background: linear-gradient(to bottom, rgba(255,255,255,0), rgba(255,255,255,1)); 
        }
        .promo-preview img { display: none !important; }
        
        .btn-baca { 
            width: 100%; 
            border-radius: 10px; 
            font-weight: 700; 
            font-size: 14px; 
            padding: 12px; 
            background: linear-gradient(135deg, #f1f5f9, #e2e8f0); 
            color: var(--primary-navy); 
            border: none; 
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
        .btn-baca i {
            transition: transform 0.25s ease;
        }
        .btn-baca:hover { 
            background: linear-gradient(135deg, var(--primary-navy), #002d59); 
            color: #fff; 
            box-shadow: 0 6px 18px rgba(0, 59, 115, 0.2);
        }
        .btn-baca:hover i { 
            transform: translateX(4px); 
        }

        /* ==========================================================================
           MODAL DETAIL PROMO
           ========================================================================== */
        .modal.fade .modal-dialog {
            transform: scale(0.94);
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .modal.show .modal-dialog {
            transform: scale(1);
        }
        .modal-content.clean-modal { 
            border-radius: 20px; 
            border: none; 
            box-shadow: 0 30px 60px rgba(0, 20, 50, 0.3);
            overflow: hidden;
        }
        .modal-header { 
            padding: 28px 28px 18px 28px; 
            border-bottom: 1px dashed var(--border-light) !important;
            background-color: #ffffff;
        }
        .modal-promo-title { 
            color: var(--primary-navy); 
            font-weight: 800; 
            font-size: 23px; 
            line-height: 1.3; 
            margin-bottom: 6px;
            letter-spacing: -0.4px;
        }
        .modal-promo-date { 
            font-size: 13px; 
            color: var(--accent-orange); 
            font-weight: 700;
        }
        .modal-body.modal-promo-body { 
            font-size: 15px; 
            color: var(--text-dark); 
            line-height: 1.7; 
            padding: 28px;
        }
        .modal-promo-body img { 
            max-width: 100%; 
            height: auto !important; 
            border-radius: 12px; 
            margin: 18px 0; 
            box-shadow: 0 6px 18px rgba(0,0,0,0.08); 
            display: block;
        }
        .modal-footer { 
            padding: 22px 28px; 
            background-color: var(--bg-light); 
            border-radius: 0 0 20px 20px; 
            border-top: 1px solid var(--border-light);
        }
        .modal-footer-actions { 
            display: flex; 
            justify-content: space-between; 
            width: 100%; 
            align-items: center; 
            gap: 12px; 
            flex-wrap: wrap;
        }
        .btn-klaim-wa { 
            background: linear-gradient(135deg, var(--accent-orange), #ff9f43); 
            color: #fff; 
            padding: 11px 22px; 
            border-radius: 10px; 
            font-weight: 700; 
            text-decoration: none; 
            transition: all 0.3s ease; 
            display: inline-flex; 
            align-items: center; 
            gap: 8px; 
            border: none; 
            font-size: 14px;
            box-shadow: 0 4px 14px rgba(247, 148, 29, 0.3);
        }
        .btn-klaim-wa:hover { 
            background: linear-gradient(135deg, #e08316, var(--accent-orange)); 
            color: #fff; 
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(247, 148, 29, 0.4);
        }
        .btn-share-wa { 
            background: linear-gradient(135deg, #27ae60, #2ecc71); 
            color: #fff; 
            padding: 11px 22px; 
            border-radius: 10px; 
            font-weight: 700; 
            text-decoration: none; 
            transition: all 0.3s ease; 
            display: inline-flex; 
            align-items: center; 
            gap: 8px; 
            border: none; 
            font-size: 14px;
            box-shadow: 0 4px 14px rgba(46, 204, 113, 0.3);
        }
        .btn-share-wa:hover { 
            background: linear-gradient(135deg, #219653, #27ae60); 
            color: #fff; 
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(46, 204, 113, 0.4);
        }

        /* ==========================================================================
           CONTACT CHANNELS SECTION
           ========================================================================== */
        .contact-section { 
            padding: 90px 5%; 
            background-color: #ffffff; 
            border-top: 1px solid var(--border-light); 
            text-align: center;
            overflow-x: hidden;
        }
        .contact-grid { 
            display: grid; 
            grid-template-columns: repeat(3, 1fr); 
            gap: 24px; 
            max-width: 920px; 
            margin: 0 auto;
        }
        .contact-item { 
            background: var(--bg-light); 
            border-radius: 16px; 
            padding: 30px 22px; 
            box-shadow: 0 4px 16px rgba(0,0,0,0.03); 
            border: 1px solid var(--border-light); 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            text-decoration: none; 
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .contact-item:hover { 
            transform: translateY(-6px); 
            box-shadow: 0 16px 35px rgba(0, 59, 115, 0.09); 
            background: #ffffff;
            border-color: #cbd5e1;
        }
        .contact-icon { 
            font-size: 38px; 
            margin-bottom: 16px; 
            color: var(--primary-navy); 
            transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .contact-item:hover .contact-icon { 
            transform: scale(1.2) translateY(-3px); 
        }
        .contact-item h5 { 
            color: var(--text-dark); 
            font-weight: 800; 
            font-size: 16.5px; 
            margin-bottom: 6px;
        }
        .contact-item p { 
            color: var(--text-muted); 
            font-size: 14px; 
            margin: 0;
            font-weight: 500;
        }

        /* ==========================================================================
           FLOATING BACK TO TOP BUTTON
           ========================================================================== */
        .btn-back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-navy), #00509e);
            color: #fff;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            box-shadow: 0 8px 25px rgba(0, 59, 115, 0.35);
            cursor: pointer;
            z-index: 1020;
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px) scale(0.85);
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .btn-back-to-top.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }
        .btn-back-to-top:hover {
            background: linear-gradient(135deg, var(--accent-orange), #ff9f43);
            transform: translateY(-4px) scale(1.08);
            box-shadow: 0 12px 30px rgba(247, 148, 29, 0.4);
            color: #fff;
        }

        footer { 
            background: var(--primary-navy); 
            color: rgba(255,255,255,0.75); 
            text-align: center; 
            padding: 32px 20px; 
            font-size: 14px; 
            font-weight: 500;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        /* ==========================================================================
           RESPONSIVE BREAKPOINTS
           ========================================================================== */
        @media (max-width: 992px) {
            .hero-section { padding: 70px 5% 80px 5%; }
            .hero-text { padding-right: 0; margin-bottom: 40px; }
            .hero-text h1 { font-size: 38px; }
        }

        @media (max-width: 768px) {
            .hero-section { padding: 40px 5% 60px 5%; }
            .hero-text h1 { font-size: 30px; }
            .hero-form { padding: 26px 20px; }
            .nav-links a.hide-mobile { display: none; }
            .brand-text .city { font-size: 16px; }
            .brand-text .branch { font-size: 10px; }
            .reveal-left { transform: translateX(-30px); }
            .reveal-right { transform: translateX(30px); }
            .reveal-tilt-left, .reveal-tilt-right { transform: translateY(30px); }
            .ongkir-card.pos-highlight { transform: none; }
            .ongkir-card.pos-highlight:hover { transform: translateX(4px); }
            .price-col { text-align: left; width: 100%; border-top: 1px dashed var(--border-light); padding-top: 12px; }
            .badge-cheapest { right: 15px; }
            .contact-grid { grid-template-columns: repeat(2, 1fr); }
            .modal-header, .modal-body.modal-promo-body, .modal-footer { padding: 20px; }
            .modal-promo-title { font-size: 19px; }
            .btn-klaim-wa, .btn-share-wa { flex: 1; justify-content: center; text-align: center; padding: 12px 10px; font-size: 13px; }
            .modal-footer-actions > div:last-child { width: 100%; }
        }
        
        @media (max-width: 480px) {
            .contact-grid { grid-template-columns: 1fr; }
            .method-card { padding: 26px 20px; }
        }
    </style>
</head>
<body>

    @php
        $nomor_cs_pos = "6281234567890";
    @endphp

    <!-- NAVBAR -->
    <nav class="navbar-public">
        <a href="{{ route('front.index') }}" class="navbar-brand">
            <img src="{{ asset('assets/images/posind.png') }}" alt="Pos Indonesia">
            <div class="brand-text">
                <span class="branch">Cabang</span>
                <span class="city">Pematangsiantar</span>
            </div>
        </a>
        <div class="nav-links">
            <a href="#ongkir" class="nav-item hide-mobile">Cek Ongkir</a>
            <a href="#cara-kirim" class="nav-item hide-mobile">Cara Kirim</a>
            <a href="#layanan" class="nav-item hide-mobile">Layanan</a>
            <a href="#promo" class="nav-item hide-mobile">Promosi</a>
            <a href="#kontak" class="nav-item hide-mobile">Kontak</a>
            
            @auth
                <a href="{{ route('dashboard') }}" class="btn-login-nav"><i class="fa-solid fa-chart-line me-2"></i>Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn-login-nav"><i class="fa-solid fa-right-to-bracket me-2"></i>Login Admin</a>
            @endauth
        </div>
    </nav>

    <!-- HERO SECTION & CEK ONGKIR FORM -->
    <section class="hero-section scroll-section" id="ongkir">
        <div class="hero-text reveal-left">
            <div class="hero-badge-pill reveal-pop delay-1">
                <span class="hero-badge-dot"></span>
                <span>Kantor Cabang Pematangsiantar 21100</span>
            </div>
            <h1>Kirim Paket Lebih <span class="text-highlight-orange">Cepat & Hemat</span> Bersama <span class="text-highlight-orange">Pos Indonesia</span></h1>
            <p class="hero-desc">Jangkauan logistik terluas hingga ke pelosok nusantara. Nikmati layanan jemput paket gratis khusus untuk pebisnis online dan UMKM di Pematangsiantar.</p>
            <a href="https://wa.me/{{ $nomor_cs_pos }}?text={{ urlencode('Halo CS PosIND Pematangsiantar, saya ingin bertanya tentang layanan pengiriman paket / penjemputan B2B.') }}" target="_blank" class="hero-cs-box reveal-up delay-2">
                <i class="fa-solid fa-truck-fast text-warning fs-5"></i>
                <span>Hubungi CS B2B: {{ $nomor_cs_pos }} (Free Pick-up)</span>
            </a>
        </div>
        
        <div class="hero-form reveal-right delay-1">
            <h3><i class="fa-solid fa-calculator text-warning me-2"></i> Estimasi Ongkos Kirim</h3>
            
            <form id="frontOngkirForm">
                <!-- Titik Asal Pengiriman (Pematangsiantar) -->
                <div class="mb-3">
                    <label class="form-label mb-1">
                        <i class="fa-solid fa-location-dot text-warning me-1"></i> Titik Asal Pengiriman
                    </label>
                    <input 
                        type="text" 
                        class="form-control mb-0" 
                        value="Pematangsiantar" 
                        readonly 
                        style="background-color: #f8fafc; font-weight: 700; color: #1e293b; cursor: default;"
                    >
                </div>
                <input type="hidden" id="front_origin_id" name="origin" value="43847">
                
                <!-- Titik Tujuan (Destination) Search Autocomplete -->
                <div class="position-relative mb-3">
                    <label for="front_dest_search" class="form-label">
                        <i class="fa-solid fa-location-crosshairs text-primary me-1"></i> Kota / Kecamatan Tujuan <span class="text-danger">*</span>
                    </label>
                    <div class="position-relative">
                        <input 
                            type="text" 
                            id="front_dest_search" 
                            placeholder="Ketik kota atau kecamatan tujuan (cth: Jakarta, Medan)..." 
                            autocomplete="off"
                            class="form-control mb-0" 
                            style="padding-right: 38px;"
                            required
                        >
                        <button 
                            type="button" 
                            id="front_dest_clear_btn" 
                            class="btn p-0 border-0 position-absolute d-none text-muted" 
                            style="right: 12px; top: 12px; font-size: 16px; cursor: pointer;"
                            title="Hapus tujuan"
                        >
                            <i class="fa-solid fa-circle-xmark"></i>
                        </button>
                        <i id="front_dest_icon" class="fa-solid fa-magnifying-glass position-absolute text-muted" style="right: 14px; top: 15px; font-size: 13px; pointer-events: none;"></i>
                    </div>
                    
                    <input type="hidden" id="front_dest_id" name="destination" required>
                    <div id="front_dest_badge" class="mt-2 d-none"></div>
                    <div id="front_dest_dropdown" class="dropdown-menu-search-front d-none"></div>
                    
                    <small class="text-muted d-block mt-1" style="font-size: 11px;">
                        <i class="fa-regular fa-lightbulb text-warning"></i> Ketik minimal 2 karakter lalu klik salah satu wilayah dari saran pencarian.
                    </small>
                </div>
                
                <!-- Berat Paket (Kg) & Quick Presets -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label for="front_weight_input" class="form-label mb-0">
                            <i class="fa-solid fa-weight-hanging text-muted me-1"></i> Berat Paket (Kg) <span class="text-danger">*</span>
                        </label>
                        <small id="frontWeightGramDisplay" class="text-muted font-monospace" style="font-size: 11.5px; font-weight: 700;">= 1.000 Gram</small>
                    </div>
                    <input type="number" id="front_weight_input" name="berat" class="form-control mb-2" min="0.1" step="0.1" value="1" required>
                    
                    <div class="d-flex gap-1 flex-wrap align-items-center">
                        <small class="text-muted me-1" style="font-size: 11px;">Preset:</small>
                        <button type="button" class="front-preset-btn active" data-kg="1">1 Kg</button>
                        <button type="button" class="front-preset-btn" data-kg="2">2 Kg</button>
                        <button type="button" class="front-preset-btn" data-kg="3">3 Kg</button>
                        <button type="button" class="front-preset-btn" data-kg="5">5 Kg</button>
                        <button type="button" class="front-preset-btn" data-kg="10">10 Kg</button>
                    </div>
                </div>
                
                <button type="submit" id="btnFrontCalculate" class="btn-cek">
                    <i class="fa-solid fa-calculator me-1" id="btnFrontIcon"></i>
                    <span id="btnFrontText">Cek Tarif Sekarang (7 Ekspedisi)</span>
                </button>
            </form>
        </div>
    </section>

    <!-- SECTION HASIL ONGKIR (KOMPARASI 7 EKSPEDISI) -->
    <section class="result-section scroll-section d-none" id="hasil-ongkir">
        <div class="reveal-down text-center mb-4">
            <h2 class="section-title">Hasil Komparasi Ongkos Kirim Resmi</h2>
            <p class="section-subtitle mb-0" id="frontResultSubtitle">
                Rute dari <strong>Pematangsiantar</strong> <i class="fa-solid fa-arrow-right mx-2 text-warning"></i> <strong id="frontDestNameDisplay">-</strong> (<span id="frontWeightDisplay">1 Kg</span>)
            </p>
        </div>

        <!-- Highlight Banner POS Termurah jika POS adalah tarif terendah -->
        <div id="frontPosPromoBanner" class="mb-4 d-none" style="max-width: 840px; margin-left: auto; margin-right: auto;"></div>

        <!-- Filter Tab Buttons: Semua Ekspedisi / Khusus POS -->
        <div class="d-flex justify-content-center gap-2 mb-4">
            <button type="button" class="front-filter-tab" id="frontTabAll" style="background: #003B73; color:#fff; border: 1px solid #003B73;">
                <i class="fa-solid fa-layer-group me-1"></i> Semua Ekspedisi (<span id="frontTotalCount">0</span>)
            </button>
            <button type="button" class="front-filter-tab" id="frontTabPos" style="background: #fff; color: #003B73; border: 1px solid #E2E8F0;">
                <i class="fa-solid fa-box text-warning me-1"></i> Khusus POS Indonesia
            </button>
        </div>

        <!-- Loading State Spinner -->
        <div id="frontLoadingState" class="py-5 text-center d-none">
            <div class="spinner-border text-primary mb-3" style="width: 3rem; height: 3rem; color: #003B73 !important;" role="status">
                <span class="visually-hidden">Memuat...</span>
            </div>
            <h5 class="fw-bold text-dark">Sedang Memeriksa Biaya Pengiriman...</h5>
            <p class="text-muted" style="font-size: 13.5px;">Membandingkan tarif 7 ekspedisi terpercaya secara real-time</p>
        </div>

        <!-- Error State Alert -->
        <div id="frontErrorState" class="alert text-center border-0 rounded-4 py-4 d-none" style="max-width: 840px; margin: 0 auto; background:#FFF5EA; color:#d35400; box-shadow: 0 10px 25px rgba(247, 148, 29, 0.1);">
            <i class="fa-solid fa-triangle-exclamation" style="font-size:36px; margin-bottom:12px; display:block;"></i>
            <strong style="font-size:17px;" id="frontErrorTitle">Mohon Maaf!</strong><br>
            <span style="font-weight:500;" id="frontErrorMessage">Data tarif tidak ditemukan untuk rute tersebut.</span>
        </div>

        <!-- Daftar Kartu Komparasi Hasil Ongkir -->
        <div class="ongkir-list" id="frontOngkirList">
            <!-- Diisi secara dinamis oleh JavaScript -->
        </div>
        
        <!-- Tombol CTA Pesan Jemput / WhatsApp PosIND -->
        <div class="text-center mt-5 d-none" id="frontWaCtaWrap">
            <a href="#" id="frontBtnWaOrder" target="_blank" class="btn btn-lg px-5 py-3 rounded-3" style="background: linear-gradient(135deg, #27ae60, #2ecc71); color:#fff; font-weight:800; box-shadow:0 10px 25px rgba(46,204,113,0.35); text-decoration:none; transition: 0.3s; display:inline-flex; align-items:center;">
                <i class="fa-brands fa-whatsapp fs-4 me-2"></i> Langsung Order Pick-up PosIND Sekarang
            </a>
            <div class="text-muted mt-2" style="font-size: 12.5px;">
                <i class="fa-solid fa-truck-pickup text-success me-1"></i> Layanan Jemput Paket Gratis Khusus Wilayah Pematangsiantar &amp; Sekitarnya
            </div>
        </div>
    </section>

    <!-- CARA KIRIM SECTION: Kotak 1 Muncul dari KIRI, Kotak 2 Muncul dari KANAN -->
    <section class="how-it-works-section scroll-section" id="cara-kirim">
        <div class="reveal-down text-center">
            <h2 class="section-title">2 Cara Mudah Kirim Paket Bersama PosIND</h2>
            <p class="section-subtitle">Pilih metode pengiriman yang paling fleksibel untuk bisnismu. Duduk santai menunggu kurir datang, atau drop-off cepat tanpa antre di loket.</p>
        </div>

        <div class="container px-0 mt-4">
            <div class="row g-4">
                <!-- OPSI 1: JEMPUT BOLA -> MUNCUL DARI KIRI -->
                <div class="col-lg-6 reveal-left">
                    <div class="method-card premium">
                        <div class="method-badge orange"><i class="fa-solid fa-star me-1"></i> Paling Direkomendasikan</div>
                        <h3 class="method-title">Layanan Free Pick-up</h3>
                        <p class="method-desc">Spesial untuk pelaku Olshop & UMKM! Fokus urus pesananmu, biar kurir O-Ranger PosIND yang langsung menjemput paket ke lokasimu.</p>
                        
                        <div class="step-list">
                            <div class="step-item">
                                <div class="step-icon-wrap"><i class="fa-solid fa-calculator"></i></div>
                                <div class="step-content">
                                    <h5>1. Cek & Bandingkan Tarif</h5>
                                    <p>Gunakan fitur kalkulator ongkos kirim di atas untuk memastikan harga PosIND paling menguntungkan bagi tokomu.</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-icon-wrap"><i class="fa-solid fa-box-open"></i></div>
                                <div class="step-content">
                                    <h5>2. Siapkan & Kemas Paket</h5>
                                    <p>Kemas barang dengan aman dan pastikan alamat serta nomor WhatsApp penerima sudah tertempel rapi di paket.</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-icon-wrap"><i class="fa-brands fa-whatsapp"></i></div>
                                <div class="step-content">
                                    <h5>3. Hubungi Kurir O-Ranger</h5>
                                    <p>Kirim pesan WhatsApp untuk menjadwalkan penjemputan. Kami datang ke alamat tokomu secepatnya tanpa minimal kuota paket!</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-icon-wrap"><i class="fa-solid fa-handshake"></i></div>
                                <div class="step-content">
                                    <h5>4. Serahkan & Lacak (Bisa COD)</h5>
                                    <p>Serahkan paket ke kurir, bayar ongkir di tempat atau via saldo COD, lalu nomor resi otomatis dikirimkan ke WhatsApp Anda.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-4 border-top">
                            <a href="https://wa.me/{{ $nomor_cs_pos }}?text={{ urlencode('Halo O-Ranger PosIND! Saya ada paket yang mau dikirim dari Pematangsiantar, bisa bantu pickup ke lokasi saya?') }}" target="_blank" class="btn btn-cek w-100 text-center text-decoration-none" style="background: linear-gradient(135deg, #27ae60, #2ecc71); box-shadow: 0 8px 20px rgba(46,204,113,0.3);">
                                <i class="fa-brands fa-whatsapp fs-5 me-2"></i> Chat O-Ranger Sekarang
                            </a>
                        </div>
                    </div>
                </div>

                <!-- OPSI 2: POS AJA (DIGITAL) -> MUNCUL DARI KANAN -->
                <div class="col-lg-6 reveal-right delay-1">
                    <div class="method-card digital">
                        <div class="method-badge navy"><i class="fa-solid fa-mobile-screen me-1"></i> Opsi Mandiri & Digital</div>
                        <h3 class="method-title">Kirim via Aplikasi "Pos Aja!"</h3>
                        <p class="method-desc">Pilihan praktis buat kamu yang serba digital. Cetak resi mandiri lewat handphone dan langsung *drop-off* di kantor pos tanpa antre loket.</p>
                        
                        <div class="step-list">
                            <div class="step-item">
                                <div class="step-icon-wrap"><i class="fa-solid fa-download"></i></div>
                                <div class="step-content">
                                    <h5>1. Unduh Aplikasi Pos Aja!</h5>
                                    <p>Tersedia resmi di Google Play Store dan Apple App Store. Daftarkan akun hanya dalam hitungan menit.</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-icon-wrap"><i class="fa-solid fa-keyboard"></i></div>
                                <div class="step-content">
                                    <h5>2. Input Pengiriman & Bayar Online</h5>
                                    <p>Masukkan alamat tujuan langsung dari HP. Bayar ongkir cashless dengan QRIS, Pospay, atau Virtual Account Bank.</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-icon-wrap"><i class="fa-solid fa-qrcode"></i></div>
                                <div class="step-content">
                                    <h5>3. Dapatkan Barcode Resi Digital</h5>
                                    <p>Sistem mengeluarkan kode barcode resi resmi yang siap di-scan saat Anda tiba di gerai pos.</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-icon-wrap"><i class="fa-solid fa-person-walking-arrow-right"></i></div>
                                <div class="step-content">
                                    <h5>4. Drop-off Bebas Antre</h5>
                                    <p>Cukup taruh paket di loket khusus Drop-off Kantor Pos Pematangsiantar terdekat, scan barcode, dan selesai!</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 pt-4 border-top d-flex gap-3 flex-wrap">
                            <a href="https://play.google.com/store/apps/details?id=com.posindonesia.cob&hl=id" target="_blank" class="btn-app-store flex-fill d-flex align-items-center justify-content-center">
                                <i class="fa-brands fa-google-play fs-4 me-2 text-warning"></i>
                                <div class="text-start" style="line-height:1.2;">
                                    <span style="font-size:10px; font-weight:500; color:#cbd5e1;">GET IT ON</span><br>
                                    <span style="font-weight:700; font-size:14px;">Google Play</span>
                                </div>
                            </a>
                            <a href="https://apps.apple.com/id/app/posaja/id1545882949" target="_blank" class="btn-app-store flex-fill d-flex align-items-center justify-content-center">
                                <i class="fa-brands fa-apple fs-4 me-2"></i>
                                <div class="text-start" style="line-height:1.2;">
                                    <span style="font-size:10px; font-weight:500; color:#cbd5e1;">Download on the</span><br>
                                    <span style="font-weight:700; font-size:14px;">App Store</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- KEUNGGULAN / LAYANAN SECTION: KIRI - ZOOM TENGAH - KANAN -->
    <section class="features-section scroll-section" id="layanan">
        <div class="reveal-down text-center">
            <h2 class="section-title">Keunggulan PosIND Pematangsiantar</h2>
            <p class="section-subtitle">Didukung jaringan BUMN terbesar dan terpercaya, kami hadir menghadirkan infrastruktur logistik andal untuk mengakselerasi kemajuan bisnis Anda.</p>
        </div>

        <div class="container px-0 mt-4">
            <div class="features-grid">
                <!-- Card 1: Muncul dari KIRI -->
                <div class="feature-box reveal-left delay-1">
                    <div class="feature-icon"><i class="fa-solid fa-truck-ramp-box"></i></div>
                    <h4>Layanan Jemput Gratis</h4>
                    <p>Tidak perlu repot ke loket kantor pos. Kurir O-Ranger kami siap mengambil paket langsung ke alamat tokomu tanpa biaya tambahan berapapun jumlahnya.</p>
                </div>
                <!-- Card 2: Zoom Pop dari TENGAH -->
                <div class="feature-box reveal-zoom delay-2">
                    <div class="feature-icon"><i class="fa-solid fa-hand-holding-dollar"></i></div>
                    <h4>Cash on Delivery (COD)</h4>
                    <p>Tingkatkan konversi penjualan olshop dengan opsi bayar di tempat (COD). Pencairan dana cepat, aman, dan langsung ditransfer ke rekening bisnis Anda.</p>
                </div>
                <!-- Card 3: Muncul dari KANAN -->
                <div class="feature-box reveal-right delay-3">
                    <div class="feature-icon"><i class="fa-solid fa-earth-asia"></i></div>
                    <h4>Jangkauan Logistik Terluas</h4>
                    <p>Dengan titik jaringan terbesar di Indonesia, kami memastikan kiriman paket Anda sampai tepat waktu bahkan hingga ke pelosok kecamatan dan kelurahan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- PROMO & AKTIVITAS SECTION: 3D TILT KIRI - ZOOM - 3D TILT KANAN -->
    <section class="promo-section scroll-section" id="promo">
        <div class="reveal-down text-center">
            <h2 class="section-title">Info & Promosi Terbaru</h2>
            <p class="section-subtitle">Dapatkan informasi penawaran spesial, diskon ongkos kirim, dan program kemitraan B2B eksklusif dari Pos Indonesia Kantor Cabang Pematangsiantar.</p>
        </div>

        <div class="container px-0 mt-4">
            <div class="row g-4">
                @forelse($promos as $index => $promo)
                    @php
                        // Variasi 3D tilt & zoom yang dinamis
                        $animPromo = ($index % 3 === 0) ? "reveal-tilt-left" : (($index % 3 === 1) ? "reveal-zoom" : "reveal-tilt-right");
                        $delayPromo = "delay-" . (($index % 3) + 1);

                        $judul_bersih = strip_tags($promo->judul_topic);
                        $deskripsi_bersih = strip_tags($promo->isi_konten);
                        $deskripsi_bersih = html_entity_decode($deskripsi_bersih, ENT_QUOTES, 'UTF-8');
                        $deskripsi_bersih = preg_replace('/\s+/', ' ', $deskripsi_bersih);
                        if (mb_strlen($deskripsi_bersih) > 150) {
                            $deskripsi_bersih = mb_substr($deskripsi_bersih, 0, 147) . '...';
                        }
                        $teks_share = "📢 *INFO PROMO POS INDONESIA*\n\n*" . $judul_bersih . "*\n\n_" . trim($deskripsi_bersih) . "_\n\nCek selengkapnya di:\n" . url()->current();
                        $url_wa_share = "https://wa.me/?text=" . urlencode($teks_share);
                        $url_wa_klaim = "https://wa.me/" . $nomor_cs_pos . "?text=" . urlencode('Halo PosIND Pematangsiantar, saya ingin bertanya tentang promo: *' . $judul_bersih . '*. Mohon infonya.');
                    @endphp

                    <div class="col-md-4 {{ $animPromo }} {{ $delayPromo }}">
                        <div class="promo-card">
                            <h4 class="promo-title">{{ $promo->judul_topic }}</h4>
                            <span class="promo-date"><i class="fa-regular fa-calendar me-2"></i> {{ \Carbon\Carbon::parse($promo->created_at)->format('d M Y') }}</span>
                            <div class="promo-preview">{!! $promo->isi_konten !!}</div>
                            <button class="btn btn-baca mt-auto" data-bs-toggle="modal" data-bs-target="#modalPromo_{{ $promo->id_promo }}">
                                Baca Selengkapnya <i class="fa-solid fa-arrow-right ms-1"></i>
                            </button>
                        </div>
                    </div>

                    <!-- MODAL DETAIL PROMO -->
                    <div class="modal fade" id="modalPromo_{{ $promo->id_promo }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                            <div class="modal-content clean-modal">
                                <div class="modal-header">
                                    <div style="padding-right: 20px;">
                                        <h4 class="modal-promo-title">{{ $promo->judul_topic }}</h4>
                                        <div class="modal-promo-date"><i class="fa-regular fa-calendar text-warning me-1"></i> Dipublikasikan: {{ \Carbon\Carbon::parse($promo->created_at)->format('d M Y') }}</div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body modal-promo-body">
                                    {!! $promo->isi_konten !!}
                                </div>
                                <div class="modal-footer">
                                    <div class="modal-footer-actions">
                                        <div>
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="font-weight:700; color:var(--text-muted); border:1px solid var(--border-light); padding: 10px 22px; border-radius: 10px;">Tutup</button>
                                        </div>
                                        <div class="d-flex gap-2" style="flex-wrap: wrap; justify-content: flex-end;">
                                            <a href="{{ $url_wa_share }}" target="_blank" class="btn-share-wa" title="Teruskan isi promo ini ke WhatsApp rekan atau grup">
                                                <i class="fa-solid fa-share-nodes"></i> Teruskan ke Teman
                                            </a>
                                            <a href="{{ $url_wa_klaim }}" target="_blank" class="btn-klaim-wa" title="Kirim pesan ke CS PosIND untuk mengambil promo ini">
                                                <i class="fa-brands fa-whatsapp fs-5"></i> Tanya / Klaim Promo
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center text-muted reveal-pop py-5">
                        <i class="fa-regular fa-folder-open mb-3" style="font-size:42px; color:#cbd5e1;"></i>
                        <p style="font-size:15px; font-weight:500;">Belum ada pengumuman atau promosi terbaru saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- CONTACT CHANNELS SECTION: COMPASS CASCADE (KIRI - TENGAH - KANAN) -->
    <section class="contact-section scroll-section" id="kontak">
        <div class="reveal-down text-center">
            <h2 class="section-title">Hubungi Kami</h2>
            <p class="section-subtitle">Selain melalui kantor cabang utama kami di Pematangsiantar, Anda juga dapat menyampaikan pertanyaan, konsultasi pengiriman, atau keluhan melalui saluran resmi berikut:</p>
        </div>
        
        <div class="contact-grid mt-4">
            <!-- Row 1: Kiri, Atas, Kanan -->
            <a href="tel:1500161" class="contact-item reveal-left delay-1">
                <div class="contact-icon"><i class="fa-solid fa-phone-volume"></i></div>
                <h5>Halo Pos</h5>
                <p>1500161</p>
            </a>
            <a href="mailto:halopos@posindonesia.co.id" class="contact-item reveal-down delay-2">
                <div class="contact-icon"><i class="fa-solid fa-envelope"></i></div>
                <h5>Email Resmi</h5>
                <p>halopos@posindonesia.co.id</p>
            </a>
            <a href="https://instagram.com/posindonesia.ig" target="_blank" class="contact-item reveal-right delay-1">
                <div class="contact-icon" style="color: #E1306C;"><i class="fa-brands fa-instagram"></i></div>
                <h5>Instagram Resmi</h5>
                <p>@posindonesia.ig</p>
            </a>

            <!-- Row 2: Kiri, Bawah, Kanan -->
            <a href="https://t.me/posindonesia_officialbot" target="_blank" class="contact-item reveal-left delay-2">
                <div class="contact-icon" style="color: #0088cc;"><i class="fa-brands fa-telegram"></i></div>
                <h5>Telegram Resmi</h5>
                <p>@posindonesia_officialbot</p>
            </a>
            <a href="https://twitter.com/PosIndonesia" target="_blank" class="contact-item reveal-up delay-3">
                <div class="contact-icon" style="color: #000000;"><i class="fa-brands fa-x-twitter"></i></div>
                <h5>X (Twitter) Resmi</h5>
                <p>@PosIndonesia</p>
            </a>
            <a href="https://www.facebook.com/posindonesia" target="_blank" class="contact-item reveal-right delay-2">
                <div class="contact-icon" style="color: #1877F2;"><i class="fa-brands fa-facebook"></i></div>
                <h5>Facebook Resmi</h5>
                <p>Pos Indonesia</p>
            </a>
        </div>
    </section>

    <!-- FLOATING BACK TO TOP BUTTON -->
    <button type="button" class="btn-back-to-top" id="btnBackToTop" title="Kembali ke atas">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    <footer>
        &copy; {{ date('Y') }} Pos Indonesia Pematangsiantar. Smart Selling developed for Academic Project.
    </footer>

    <!-- Script jQuery & Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // 1. Intersection Observer Scroll Reveal Animation dengan Multi-Direction
            const revealSelector = '.reveal, .reveal-left, .reveal-right, .reveal-down, .reveal-up, .reveal-zoom, .reveal-tilt-left, .reveal-tilt-right, .reveal-pop, .reveal-zoom-glow';
            const revealElements = document.querySelectorAll(revealSelector);

            if ('IntersectionObserver' in window) {
                const revealObserver = new IntersectionObserver(function (entries, observer) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('active');
                        }
                    });
                }, {
                    threshold: 0.08,
                    rootMargin: '0px 0px -40px 0px'
                });

                revealElements.forEach(function (el) {
                    revealObserver.observe(el);
                });
            } else {
                // Fallback untuk browser lawas
                revealElements.forEach(function (el) {
                    el.classList.add('active');
                });
            }

            // Pemicu inisial agar elemen yang sudah berada di viewport atas langsung aktif mulus
            setTimeout(function () {
                revealElements.forEach(function (el) {
                    const rect = el.getBoundingClientRect();
                    if (rect.top < window.innerHeight && rect.bottom > 0) {
                        el.classList.add('active');
                    }
                });
            }, 80);

            // 2. ScrollSpy (Active Navbar Links & Scrolled Navbar Shadow)
            const navbar = document.querySelector('.navbar-public');
            const sections = document.querySelectorAll('.scroll-section');
            const navLinks = document.querySelectorAll('.nav-links .nav-item');
            const btnBackToTop = document.getElementById('btnBackToTop');

            window.addEventListener('scroll', function () {
                const scrollPos = window.pageYOffset || document.documentElement.scrollTop;

                // Transisi Shadow Navbar saat scroll
                if (scrollPos > 30) {
                    navbar.classList.add('navbar-scrolled');
                } else {
                    navbar.classList.remove('navbar-scrolled');
                }

                // Tombol Back To Top tampil/sembunyi
                if (btnBackToTop) {
                    if (scrollPos > 350) {
                        btnBackToTop.classList.add('show');
                    } else {
                        btnBackToTop.classList.remove('show');
                    }
                }

                // Deteksi Active Nav Link (Scrollspy)
                let currentSectionId = '';
                sections.forEach(function (section) {
                    const sectionTop = section.offsetTop - 160;
                    const sectionHeight = section.offsetHeight;
                    if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
                        currentSectionId = section.getAttribute('id');
                    }
                });

                navLinks.forEach(function (link) {
                    link.classList.remove('active');
                    const href = link.getAttribute('href');
                    if (href && href === '#' + currentSectionId) {
                        link.classList.add('active');
                    }
                });
            });

            // 3. Tombol Kembali Ke Atas
            if (btnBackToTop) {
                btnBackToTop.addEventListener('click', function () {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }

            // 4. Integrasi Real-Time Kalkulasi Ongkir di Landing Page
            const FRONT_ORIGIN_ID = "43847"; // Pematangsiantar (Proklamasi, Siantar Barat)
            const FRONT_ORIGIN_LABEL = "Pematangsiantar";
            const frontSearchApiUrl = "{{ route('rajaongkir.sandbox.search') }}";
            const frontCalculateApiUrl = "{{ route('rajaongkir.sandbox.calculate') }}";
            const csPosWaNumber = "{{ $nomor_cs_pos ?? '6281234567890' }}";

            const frontDestSearch = document.getElementById('front_dest_search');
            const frontDestId = document.getElementById('front_dest_id');
            const frontDestDropdown = document.getElementById('front_dest_dropdown');
            const frontDestBadge = document.getElementById('front_dest_badge');
            const frontDestClearBtn = document.getElementById('front_dest_clear_btn');
            const frontDestIcon = document.getElementById('front_dest_icon');
            const frontWeightInput = document.getElementById('front_weight_input');
            const frontWeightGramDisplay = document.getElementById('frontWeightGramDisplay');
            const frontPresetBtns = document.querySelectorAll('.front-preset-btn');
            const frontOngkirForm = document.getElementById('frontOngkirForm');
            const btnFrontCalculate = document.getElementById('btnFrontCalculate');
            const btnFrontIcon = document.getElementById('btnFrontIcon');
            const btnFrontText = document.getElementById('btnFrontText');

            const hasilOngkirSection = document.getElementById('hasil-ongkir');
            const frontLoadingState = document.getElementById('frontLoadingState');
            const frontErrorState = document.getElementById('frontErrorState');
            const frontOngkirList = document.getElementById('frontOngkirList');
            const frontPosPromoBanner = document.getElementById('frontPosPromoBanner');
            const frontDestNameDisplay = document.getElementById('frontDestNameDisplay');
            const frontWeightDisplay = document.getElementById('frontWeightDisplay');
            const frontTotalCount = document.getElementById('frontTotalCount');
            const frontTabAll = document.getElementById('frontTabAll');
            const frontTabPos = document.getElementById('frontTabPos');
            const frontWaCtaWrap = document.getElementById('frontWaCtaWrap');
            const frontBtnWaOrder = document.getElementById('frontBtnWaOrder');

            let frontCalculatedItems = [];
            let frontSelectedDestName = '';
            let frontActiveFilter = 'all';

            const frontCourierMeta = {
                pos: { name: 'POS Indonesia', fullName: 'PT Pos Indonesia (Persero)', tag: 'POS', logo: "{{ asset('assets/images/posind.png') }}", bg: '#F7941D' },
                jne: { name: 'JNE Express', fullName: 'Jalur Nugraha Ekakurir', tag: 'JNE', logo: "{{ asset('assets/images/logo_jne.png') }}", bg: '#003D79' },
                jnt: { name: 'J&T Express', fullName: 'PT Global Jet Express', tag: 'J&T', logo: "{{ asset('assets/images/logo_jnt.png') }}", bg: '#ED1C24' },
                tiki: { name: 'TIKI', fullName: 'Citra Van Titipan Kilat', tag: 'TIKI', logo: "{{ asset('assets/images/logo_tiki.png') }}", bg: '#0090D0' },
                lion: { name: 'Lion Parcel', fullName: 'PT Lion Express', tag: 'LION', logo: "{{ asset('assets/images/logo_lion.png') }}", bg: '#EC1C24' },
                sicepat: { name: 'SiCepat Express', fullName: 'PT SiCepat Ekspres Indonesia', tag: 'SICEPAT', logo: "{{ asset('assets/images/logo_sicepat.png') }}", bg: '#E52320' },
                sap: { name: 'SAP Express', fullName: 'PT Satria Antaran Prima Tbk', tag: 'SAP', logo: "{{ asset('assets/images/logo_sap.png') }}", bg: '#004C99' }
            };

            const getFrontCourierInfo = (code, rawName) => {
                const c = (code || '').toLowerCase().trim();
                for (const key of Object.keys(frontCourierMeta)) {
                    if (c.includes(key)) return frontCourierMeta[key];
                }
                return {
                    name: rawName || (code ? code.toUpperCase() : 'Ekspedisi'),
                    fullName: rawName || '',
                    tag: (code || 'EXP').toUpperCase(),
                    logo: null,
                    bg: '#334155'
                };
            };

            const formatIDR = (num) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(num);

            function updateFrontWeight() {
                const kg = parseFloat(frontWeightInput.value) || 1;
                const grams = Math.round(kg * 1000);
                frontWeightGramDisplay.textContent = `= ${grams.toLocaleString('id-ID')} Gram`;
            }

            frontWeightInput.addEventListener('input', () => {
                updateFrontWeight();
                const kgVal = parseFloat(frontWeightInput.value);
                frontPresetBtns.forEach(btn => btn.classList.toggle('active', parseFloat(btn.dataset.kg) === kgVal));
            });

            frontPresetBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    frontPresetBtns.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    frontWeightInput.value = btn.dataset.kg;
                    updateFrontWeight();
                });
            });

            function updateFrontClearBtn() {
                if (frontDestSearch.value.trim().length > 0) {
                    frontDestClearBtn.classList.remove('d-none');
                    frontDestIcon.classList.add('d-none');
                } else {
                    frontDestClearBtn.classList.add('d-none');
                    frontDestIcon.classList.remove('d-none');
                }
            }

            frontDestClearBtn.addEventListener('click', () => {
                frontDestSearch.value = '';
                frontDestId.value = '';
                frontDestBadge.classList.add('d-none');
                frontDestBadge.innerHTML = '';
                frontDestDropdown.classList.add('d-none');
                updateFrontClearBtn();
                frontDestSearch.focus();
            });

            // Debounced Autocomplete Search
            let searchTimeout = null;
            frontDestSearch.addEventListener('input', (e) => {
                frontDestId.value = '';
                frontDestBadge.classList.add('d-none');
                updateFrontClearBtn();

                clearTimeout(searchTimeout);
                const query = e.target.value.trim();
                if (query.length < 2) {
                    frontDestDropdown.innerHTML = '';
                    frontDestDropdown.classList.add('d-none');
                    return;
                }

                searchTimeout = setTimeout(async () => {
                    frontDestDropdown.innerHTML = `
                        <div class="p-3 text-center text-muted" style="font-size: 13px;">
                            <i class="fa-solid fa-spinner fa-spin text-warning me-1"></i> Mencari destinasi wilayah...
                        </div>
                    `;
                    frontDestDropdown.classList.remove('d-none');

                    try {
                        const res = await fetch(`${frontSearchApiUrl}?search=${encodeURIComponent(query)}&limit=10`);
                        const json = await res.json();

                        if (!res.ok || !json.data || json.data.length === 0) {
                            frontDestDropdown.innerHTML = `
                                <div class="p-3 text-center text-muted" style="font-size: 13px;">
                                    Tidak ditemukan wilayah dengan kata kunci "<b>${query}</b>".
                                </div>
                            `;
                            return;
                        }

                        frontDestDropdown.innerHTML = '';
                        json.data.forEach(item => {
                            const subName = item.subdistrict_name && item.subdistrict_name !== '-' ? item.subdistrict_name : item.district_name;
                            const cityName = item.city_name || '';
                            const provName = item.province_name || '';
                            const zipCode = item.zip_code ? item.zip_code : '';

                            const row = document.createElement('div');
                            row.className = 'p-3 border-bottom text-start d-flex gap-2 align-items-start';
                            row.style.cursor = 'pointer';
                            row.style.transition = 'background-color 0.2s';
                            row.onmouseover = () => row.style.backgroundColor = '#FFF5EA';
                            row.onmouseout = () => row.style.backgroundColor = '#FFFFFF';

                            row.innerHTML = `
                                <div class="rounded d-flex align-items-center justify-content-center text-primary mt-1" style="width: 24px; height: 24px; background: #e8f4fd; flex-shrink: 0; font-size: 12px;">
                                    <i class="fa-solid fa-map-pin"></i>
                                </div>
                                <div class="flex-grow-1 min-w-0">
                                    <div class="fw-bold text-dark text-truncate" style="font-size: 13px;">
                                        ${subName ? subName + ', ' : ''}${cityName}
                                    </div>
                                    <div class="text-muted text-truncate" style="font-size: 11px;">
                                        ${provName} ${zipCode ? '• Kode Pos: ' + zipCode : ''}
                                    </div>
                                </div>
                            `;

                            row.addEventListener('click', () => {
                                frontDestId.value = item.id;
                                frontDestSearch.value = item.label || `${subName}, ${cityName}`;
                                frontSelectedDestName = subName ? `${subName}, ${cityName}` : cityName;
                                updateFrontClearBtn();

                                frontDestBadge.innerHTML = `
                                    <div class="d-flex justify-content-between align-items-center p-2 rounded-3 border" style="background: #e8f8f0; border-color: #a3e6cd !important; font-size: 12px; color: #0f5132;">
                                        <div class="d-flex align-items-center gap-1.5 text-truncate">
                                            <i class="fa-solid fa-circle-check text-success"></i>
                                            <span class="text-truncate">Tujuan: <b>${subName || cityName}</b> (${cityName}, ${provName})</span>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-link p-0 text-success fw-bold text-decoration-none ms-2" style="font-size: 11px;" onclick="document.getElementById('front_dest_badge').classList.add('d-none');">
                                            Ubah
                                        </button>
                                    </div>
                                `;
                                frontDestBadge.classList.remove('d-none');
                                frontDestDropdown.classList.add('d-none');
                                frontDestDropdown.innerHTML = '';
                            });

                            frontDestDropdown.appendChild(row);
                        });

                    } catch (err) {
                        frontDestDropdown.innerHTML = `
                            <div class="p-3 text-center text-muted" style="font-size: 13px;">
                                Gagal memuat rekomendasi wilayah. Silakan coba lagi.
                            </div>
                        `;
                    }
                }, 350);
            });

            document.addEventListener('click', (e) => {
                if (!frontDestSearch.contains(e.target) && !frontDestDropdown.contains(e.target)) {
                    frontDestDropdown.classList.add('d-none');
                }
            });

            // Render Hasil Komparasi ke Kartu Landing Page
            function renderFrontOngkirCards(items) {
                frontOngkirList.innerHTML = '';

                const validCosts = items.map(i => Number(i.cost) || 0).filter(c => c > 0);
                const minCost = validCosts.length > 0 ? Math.min(...validCosts) : 0;

                const posItems = items.filter(i => (i.code || '').toLowerCase().includes('pos'));
                const isPosLowest = posItems.some(i => (Number(i.cost) || 0) === minCost);

                // Highlight Banner jika POS Pilihan Termurah
                if (isPosLowest) {
                    frontPosPromoBanner.innerHTML = `
                        <div class="p-3 p-md-4 rounded-4 text-start d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 shadow-sm" style="background: linear-gradient(135deg, #FFF9F2 0%, #FFF2E0 100%); border: 2px solid var(--accent-orange);">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-3 d-flex align-items-center justify-content-center text-white flex-shrink-0" style="width: 48px; height: 48px; background: var(--accent-orange); font-size: 22px; box-shadow: 0 4px 12px rgba(247, 148, 29, 0.4);">
                                    <i class="fa-solid fa-trophy"></i>
                                </div>
                                <div>
                                    <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                                        <h5 class="mb-0 fw-bold" style="color: var(--primary-navy); font-size: 16px;">POS Indonesia Pilihan Paling Hemat!</h5>
                                        <span class="badge" style="background: var(--accent-orange); color:#fff; font-size: 10px; font-weight:800; letter-spacing:0.5px;">REKOMENDASI TERBAIK</span>
                                    </div>
                                    <p class="mb-0 text-muted" style="font-size: 13px;">
                                        Tarif layanan reguler POS Indonesia dari Pematangsiantar paling kompetitif dengan harga <b>${formatIDR(minCost)}</b> dibandingkan ekspedisi lainnya.
                                    </p>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="badge px-3 py-2 text-white fw-bold d-inline-flex align-items-center gap-1.5" style="background: var(--primary-navy); font-size: 12px; border-radius: 8px;">
                                    <i class="fa-solid fa-award text-warning"></i> Terbaik & Hemat
                                </span>
                            </div>
                        </div>
                    `;
                    frontPosPromoBanner.classList.remove('d-none');
                } else {
                    frontPosPromoBanner.classList.add('d-none');
                    frontPosPromoBanner.innerHTML = '';
                }

                // Susun urutan: Jika POS termurah, letakkan POS di paling atas
                let displayItems = [...items];
                if (isPosLowest) {
                    displayItems.sort((a, b) => {
                        const aPos = (a.code || '').toLowerCase().includes('pos') ? 1 : 0;
                        const bPos = (b.code || '').toLowerCase().includes('pos') ? 1 : 0;
                        return bPos - aPos;
                    });
                }

                displayItems.forEach((row, index) => {
                    const isPos = (row.code || '').toLowerCase().includes('pos');
                    const isThisPosLowest = isPos && isPosLowest && (Number(row.cost) || 0) === minCost;
                    const meta = getFrontCourierInfo(row.code, row.name);

                    const card = document.createElement('div');
                    card.className = `ongkir-card ${isThisPosLowest ? 'pos-highlight' : ''}`;

                    let logoHtml = '';
                    if (meta.logo) {
                        logoHtml = `
                            <div class="front-courier-logo">
                                <img src="${meta.logo}" alt="${meta.name}" onerror="this.parentElement.innerHTML='<span class=\\'fw-bold text-primary\\' style=\\'font-size:11px;\\'>${meta.tag}</span>'">
                            </div>
                        `;
                    } else {
                        logoHtml = `
                            <div class="brand-color-box" style="background-color: ${meta.bg};">
                                ${meta.tag.substring(0, 3)}
                            </div>
                        `;
                    }

                    let badgeHtml = '';
                    if (isThisPosLowest) {
                        badgeHtml = `<div class="badge-cheapest"><i class="fa-solid fa-crown text-light me-1"></i> REKOMENDASI TERMURAH POS INDONESIA</div>`;
                    } else if (Number(row.cost) === minCost) {
                        badgeHtml = `<div class="badge-cheapest" style="background: linear-gradient(135deg, #27ae60, #2ecc71);"><i class="fa-solid fa-tag text-light me-1"></i> TARIF TERMURAH</div>`;
                    }

                    // Format ETD
                    let etdText = row.etd ? row.etd.trim() : '';
                    let etdDisplay = '-';
                    if (etdText) {
                        const hasDay = etdText.toLowerCase().includes('day') || etdText.toLowerCase().includes('hari');
                        etdDisplay = hasDay ? etdText : `${etdText} Hari`;
                    }

                    const rawDesc = row.description ? row.description.trim() : '';
                    const serviceDesc = (rawDesc && rawDesc !== row.service && rawDesc !== '240') ? rawDesc : 'Layanan Reguler';

                    card.innerHTML = `
                        ${badgeHtml}
                        <div class="brand-col">
                            ${logoHtml}
                            <div>
                                <div class="brand-name d-flex align-items-center gap-1.5 flex-wrap">
                                    <span>${meta.name}</span>
                                    <span class="badge ${isThisPosLowest ? 'bg-warning text-dark' : 'bg-light text-muted border'}" style="font-size: 10px; font-weight: 700;">${meta.tag}</span>
                                    ${isThisPosLowest ? '<span class="badge bg-success text-white" style="font-size: 10px;">Pilihan Utama</span>' : ''}
                                </div>
                                <div class="brand-service">
                                    Layanan: <b>${row.service || '-'}</b> <span class="text-muted font-normal">• ${serviceDesc}</span>
                                </div>
                            </div>
                        </div>
                        <div class="price-col">
                            <div class="price-val">${formatIDR(row.cost || 0)}</div>
                            <div class="price-eta"><i class="fa-regular fa-clock me-1 text-warning"></i> Estimasi Tiba: <b>${etdDisplay}</b></div>
                        </div>
                    `;

                    frontOngkirList.appendChild(card);
                });

                // Update WhatsApp CTA Message
                const kgVal = parseFloat(frontWeightInput.value) || 1;
                const destTitle = frontSelectedDestName || frontDestSearch.value;
                const posCostItem = items.find(i => (i.code || '').toLowerCase().includes('pos'));
                const posCostText = posCostItem ? ` (Estimasi Tarif POS: ${formatIDR(posCostItem.cost)})` : '';
                const waMessage = `Halo CS PosIND Pematangsiantar, saya telah mengecek tarif di website dari Pematangsiantar menuju ${destTitle} seberat ${kgVal} Kg${posCostText}. Saya ingin memesan layanan Pick-up gratis sekarang.`;
                frontBtnWaOrder.href = `https://wa.me/${csPosWaNumber}?text=${encodeURIComponent(waMessage)}`;
                frontWaCtaWrap.classList.remove('d-none');
            }

            // Filter Tabs
            frontTabAll.addEventListener('click', () => {
                frontTabAll.style.background = '#003B73';
                frontTabAll.style.color = '#fff';
                frontTabAll.style.borderColor = '#003B73';
                frontTabPos.style.background = '#fff';
                frontTabPos.style.color = '#003B73';
                frontTabPos.style.borderColor = '#E2E8F0';
                frontActiveFilter = 'all';
                renderFrontOngkirCards(frontCalculatedItems);
            });

            frontTabPos.addEventListener('click', () => {
                frontTabPos.style.background = '#003B73';
                frontTabPos.style.color = '#fff';
                frontTabPos.style.borderColor = '#003B73';
                frontTabAll.style.background = '#fff';
                frontTabAll.style.color = '#003B73';
                frontTabAll.style.borderColor = '#E2E8F0';
                frontActiveFilter = 'pos';
                const posFiltered = frontCalculatedItems.filter(i => (i.code || '').toLowerCase().includes('pos'));
                renderFrontOngkirCards(posFiltered);
            });

            // Form Submit Kalkulasi Ongkir
            frontOngkirForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                const destination = frontDestId.value;
                const weightKg = parseFloat(frontWeightInput.value) || 1;
                const weightGrams = Math.max(1, Math.round(weightKg * 1000));

                if (!destination) {
                    alert('Silakan ketik dan klik salah satu wilayah tujuan dari saran pencarian terlebih dahulu.');
                    frontDestSearch.focus();
                    return;
                }

                // Tampilkan Section Hasil & Set Loading State
                hasilOngkirSection.classList.remove('d-none');
                frontLoadingState.classList.remove('d-none');
                frontErrorState.classList.add('d-none');
                frontOngkirList.innerHTML = '';
                frontPosPromoBanner.classList.add('d-none');
                frontWaCtaWrap.classList.add('d-none');

                btnFrontCalculate.disabled = true;
                btnFrontCalculate.style.opacity = '0.75';
                btnFrontIcon.className = 'fa-solid fa-circle-notch fa-spin me-1';
                btnFrontText.textContent = 'Memeriksa Tarif...';

                // Smooth scroll ke section hasil
                hasilOngkirSection.scrollIntoView({ behavior: 'smooth', block: 'start' });

                try {
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                    const response = await fetch(frontCalculateApiUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            origin: FRONT_ORIGIN_ID,
                            destination: destination,
                            weight: weightGrams,
                            courier: 'pos:jne:jnt:tiki:lion:sicepat:sap',
                            price: 'lowest',
                            filter_regular: true
                        })
                    });

                    const res = await response.json();
                    frontLoadingState.classList.add('d-none');

                    if (!response.ok || !res.data || res.data.length === 0) {
                        const errMsg = (res.meta && res.meta.message) ? res.meta.message : 'Tarif pengiriman tidak ditemukan untuk rute tersebut.';
                        document.getElementById('frontErrorTitle').textContent = 'Tarif Tidak Ditemukan';
                        document.getElementById('frontErrorMessage').textContent = errMsg;
                        frontErrorState.classList.remove('d-none');
                        return;
                    }

                    // Filter layanan reguler
                    const isRegularService = (item) => {
                        const service = (item.service || '').toLowerCase().trim();
                        const desc = (item.description || '').toLowerCase().trim();
                        const combined = `${service} ${desc}`;

                        const excluded = [
                            'cargo', 'kargo', 'truck', 'trucking', 'jtr', 'gokil', 'bigpack', 'jumbo',
                            'instant', 'instan',
                            'same day', 'sameday', 'sds',
                            'next day', 'nextday', 'overnight', 'onepack', 'yes', 'besok', 'best',
                            'ons', 'udrons'
                        ];

                        for (const term of excluded) {
                            if (combined.includes(term)) return false;
                        }

                        if (/\b(express|ekspres)\b/i.test(service) && !/\b(reg|reguler|regular)\b/i.test(service)) {
                            return false;
                        }

                        const regularKeywords = [
                            'reg', 'reguler', 'regular', 'regpack', 'ez', 'siuntung',
                            'reg15', 'std', 'standard', 'standar', 'udrreg'
                        ];

                        return regularKeywords.some(pattern => combined.includes(pattern));
                    };

                    let regularItems = res.data.filter(isRegularService);

                    if (regularItems.length === 0) {
                        document.getElementById('frontErrorTitle').textContent = 'Tidak Ada Layanan Reguler';
                        document.getElementById('frontErrorMessage').textContent = 'Tidak ditemukan opsi pengiriman untuk kategori layanan Reguler (Standard) dari Pematangsiantar menuju tujuan ini.';
                        frontErrorState.classList.remove('d-none');
                        return;
                    }

                    // Urutkan lowest cost first
                    regularItems.sort((a, b) => (Number(a.cost) || 0) - (Number(b.cost) || 0));
                    frontCalculatedItems = regularItems;

                    // Update Subtitle & Info
                    frontDestNameDisplay.textContent = frontSelectedDestName || frontDestSearch.value.split(',')[0];
                    frontWeightDisplay.textContent = `${weightKg} Kg`;
                    frontTotalCount.textContent = regularItems.length;

                    // Render Kartu Hasil
                    renderFrontOngkirCards(regularItems);

                } catch (err) {
                    frontLoadingState.classList.add('d-none');
                    document.getElementById('frontErrorTitle').textContent = 'Koneksi Bermasalah';
                    document.getElementById('frontErrorMessage').textContent = err.message || 'Terjadi gangguan saat mengambil data tarif.';
                    frontErrorState.classList.remove('d-none');
                } finally {
                    btnFrontCalculate.disabled = false;
                    btnFrontCalculate.style.opacity = '1';
                    btnFrontIcon.className = 'fa-solid fa-calculator me-1';
                    btnFrontText.textContent = 'Cek Tarif Sekarang (7 Ekspedisi)';
                }
            });
        });
    </script>
</body>
</html>