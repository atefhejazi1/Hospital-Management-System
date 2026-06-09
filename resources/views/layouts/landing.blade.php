<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MediCore HMS &mdash; Hospital Management System</title>

    <link href="{{ asset('WebSite/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('WebSite/css/fontawesome-all.css') }}" rel="stylesheet">
    <link href="{{ asset('WebSite/css/animate.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('WebSite/images/favicon.png') }}" type="image/x-icon">

    <style>
        /* ─── Design Tokens ─── */
        :root {
            --primary:       #004cda;
            --primary-dark:  #0038a8;
            --primary-light: #e8f0fe;
            --secondary:     #009dcd;
            --dark:          #031b4e;
            --text:          #4a5568;
            --muted:         #718096;
            --light-bg:      #f8faff;
            --border:        #e2e8f0;
            --white:         #ffffff;
            --gradient:      linear-gradient(135deg, #004cda 0%, #009dcd 100%);
            --shadow-sm:     0 2px 8px rgba(0,76,218,.08);
            --shadow:        0 4px 24px rgba(0,76,218,.14);
            --shadow-lg:     0 8px 40px rgba(0,76,218,.18);
            --radius:        12px;
            --radius-sm:     8px;
            --transition:    all 0.28s ease;
        }

        /* ─── Reset / Base ─── */
        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Segoe UI', system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
            color: var(--text);
            line-height: 1.7;
            overflow-x: hidden;
            background: var(--white);
        }
        a { text-decoration: none; transition: var(--transition); }
        img { max-width: 100%; height: auto; }
        section { position: relative; }

        /* ─── Navbar ─── */
        .lp-nav {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 9999;
            padding: 0 0;
            background: rgba(255,255,255,.96);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid transparent;
            transition: var(--transition);
        }
        .lp-nav.is-scrolled {
            border-bottom-color: var(--border);
            box-shadow: var(--shadow-sm);
        }
        .lp-nav .container { max-width: 1200px; }
        .lp-nav .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--dark) !important;
            font-weight: 700;
            font-size: 1.25rem;
            letter-spacing: -0.3px;
        }
        .lp-nav .brand-icon {
            width: 38px; height: 38px;
            background: var(--gradient);
            border-radius: var(--radius-sm);
            display: flex; align-items: center; justify-content: center;
            color: var(--white);
            font-size: 1rem;
            flex-shrink: 0;
        }
        .lp-nav .brand-text em {
            color: var(--primary);
            font-style: normal;
        }
        .lp-nav .navbar-nav .nav-link {
            color: var(--dark) !important;
            font-weight: 500;
            font-size: .92rem;
            padding: 8px 14px !important;
            border-radius: var(--radius-sm);
            transition: var(--transition);
        }
        .lp-nav .navbar-nav .nav-link:hover {
            color: var(--primary) !important;
            background: var(--primary-light);
        }
        .lp-nav .btn-nav-login {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--primary);
            color: var(--white) !important;
            padding: 9px 22px;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: .92rem;
            border: 2px solid var(--primary);
            transition: var(--transition);
        }
        .lp-nav .btn-nav-login:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(0,76,218,.32);
        }
        .lp-nav .navbar-toggler {
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 6px 10px;
        }
        .lp-nav .navbar-toggler:focus { box-shadow: none; }
        .lp-nav .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280%2C76%2C218%2C0.85%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* ─── Shared Section Styles ─── */
        .section-pad { padding: 96px 0; }
        .section-pad-sm { padding: 72px 0; }
        .sec-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--primary-light);
            color: var(--primary);
            font-size: .8rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 6px 14px;
            border-radius: 100px;
            margin-bottom: 16px;
        }
        .sec-eyebrow i { font-size: .72rem; }
        .sec-title {
            font-size: 2.1rem;
            font-weight: 800;
            color: var(--dark);
            line-height: 1.25;
            margin-bottom: 16px;
            letter-spacing: -0.5px;
        }
        .sec-title span { color: var(--primary); }
        .sec-subtitle {
            font-size: 1.05rem;
            color: var(--muted);
            max-width: 560px;
            margin: 0 auto;
            line-height: 1.7;
        }
        .text-center .sec-subtitle { margin: 0 auto; }

        /* ─── Hero Section ─── */
        .lp-hero {
            background: var(--gradient);
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding-top: 90px;
            overflow: hidden;
        }
        .lp-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .hero-orb {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,.06);
            pointer-events: none;
        }
        .hero-orb-1 { width: 500px; height: 500px; top: -120px; right: -100px; }
        .hero-orb-2 { width: 300px; height: 300px; bottom: -80px; left: -60px; }
        .hero-orb-3 { width: 180px; height: 180px; top: 40%; left: 30%; opacity: .5; }
        .hero-content { position: relative; z-index: 2; }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,.15);
            border: 1px solid rgba(255,255,255,.25);
            color: var(--white);
            font-size: .82rem;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 100px;
            margin-bottom: 24px;
            backdrop-filter: blur(6px);
        }
        .hero-badge .badge-dot {
            width: 7px; height: 7px;
            background: #4ade80;
            border-radius: 50%;
            animation: pulse-dot 2s infinite;
        }
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: .6; transform: scale(1.3); }
        }
        .hero-title {
            font-size: clamp(2.2rem, 4.5vw, 3.4rem);
            font-weight: 900;
            color: var(--white);
            line-height: 1.15;
            letter-spacing: -1px;
            margin-bottom: 20px;
        }
        .hero-title .highlight {
            position: relative;
            display: inline-block;
        }
        .hero-title .highlight::after {
            content: '';
            position: absolute;
            left: 0; bottom: 4px; right: 0;
            height: 4px;
            background: rgba(255,255,255,.35);
            border-radius: 2px;
        }
        .hero-sub {
            font-size: 1.1rem;
            color: rgba(255,255,255,.85);
            max-width: 520px;
            margin-bottom: 36px;
            line-height: 1.75;
        }
        .hero-actions { display: flex; gap: 14px; flex-wrap: wrap; }
        .btn-hero-primary {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--white);
            color: var(--primary);
            font-weight: 700;
            font-size: .95rem;
            padding: 14px 28px;
            border-radius: var(--radius-sm);
            transition: var(--transition);
            box-shadow: 0 4px 16px rgba(0,0,0,.15);
        }
        .btn-hero-primary:hover {
            background: var(--primary-light);
            color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0,0,0,.2);
        }
        .btn-hero-secondary {
            display: inline-flex; align-items: center; gap: 8px;
            background: transparent;
            color: var(--white);
            font-weight: 600;
            font-size: .95rem;
            padding: 13px 28px;
            border-radius: var(--radius-sm);
            border: 2px solid rgba(255,255,255,.45);
            transition: var(--transition);
        }
        .btn-hero-secondary:hover {
            background: rgba(255,255,255,.12);
            border-color: rgba(255,255,255,.75);
            color: var(--white);
            transform: translateY(-2px);
        }
        .hero-trust {
            display: flex; align-items: center; gap: 12px;
            margin-top: 36px;
            color: rgba(255,255,255,.7);
            font-size: .85rem;
        }
        .hero-trust-avatars {
            display: flex;
        }
        .hero-trust-avatars span {
            width: 32px; height: 32px;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,.5);
            display: flex; align-items: center; justify-content: center;
            font-size: .7rem;
            font-weight: 700;
            color: white;
            margin-right: -8px;
        }
        .hero-trust-avatars span:nth-child(1) { background: #6366f1; }
        .hero-trust-avatars span:nth-child(2) { background: #ec4899; }
        .hero-trust-avatars span:nth-child(3) { background: #10b981; }
        .hero-trust-avatars span:nth-child(4) { background: #f59e0b; }

        /* Hero Illustration */
        .hero-illustration { position: relative; z-index: 2; }
        .dashboard-card {
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.2);
            border-radius: 16px;
            backdrop-filter: blur(12px);
            padding: 20px;
            color: white;
        }
        .dashboard-card.main-card {
            padding: 24px;
        }
        .card-header-bar {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(255,255,255,.15);
        }
        .card-title-text {
            font-size: .78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: .8;
        }
        .card-badge-live {
            display: flex; align-items: center; gap: 5px;
            font-size: .7rem;
            background: rgba(74,222,128,.2);
            color: #4ade80;
            padding: 3px 8px;
            border-radius: 100px;
            font-weight: 600;
        }
        .card-badge-live::before {
            content: '';
            width: 5px; height: 5px;
            background: #4ade80;
            border-radius: 50%;
            animation: pulse-dot 1.5s infinite;
        }
        .stat-row {
            display: grid; grid-template-columns: repeat(3, 1fr);
            gap: 10px; margin-bottom: 16px;
        }
        .stat-item {
            background: rgba(255,255,255,.08);
            border-radius: 8px;
            padding: 10px;
            text-align: center;
        }
        .stat-num {
            font-size: 1.3rem;
            font-weight: 800;
            display: block;
            line-height: 1;
            margin-bottom: 3px;
        }
        .stat-lbl {
            font-size: .65rem;
            opacity: .7;
            text-transform: uppercase;
            letter-spacing: .5px;
        }
        .chart-bars {
            display: flex; align-items: flex-end; gap: 5px;
            height: 60px; margin-bottom: 12px;
        }
        .chart-bar {
            flex: 1;
            border-radius: 4px 4px 0 0;
            background: rgba(255,255,255,.25);
            transition: height .5s ease;
        }
        .chart-bar.active { background: rgba(255,255,255,.65); }
        .chart-label { font-size: .62rem; opacity: .6; text-align: center; margin-top: 4px; }
        .chart-labels { display: flex; gap: 5px; }
        .chart-labels span { flex: 1; font-size: .62rem; opacity: .6; text-align: center; }
        .mini-list { list-style: none; padding: 0; margin: 0; }
        .mini-list li {
            display: flex; align-items: center; justify-content: space-between;
            padding: 6px 0;
            border-bottom: 1px solid rgba(255,255,255,.08);
            font-size: .78rem;
        }
        .mini-list li:last-child { border-bottom: none; }
        .mini-list .pill {
            font-size: .65rem; padding: 2px 8px;
            border-radius: 100px; font-weight: 600;
        }
        .pill-green { background: rgba(74,222,128,.2); color: #4ade80; }
        .pill-blue  { background: rgba(96,165,250,.2); color: #93c5fd; }
        .pill-yellow { background: rgba(251,191,36,.2); color: #fde68a; }
        .floating-card {
            position: absolute;
            background: white;
            border-radius: 12px;
            padding: 12px 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,.2);
            font-size: .8rem;
            color: var(--dark);
            white-space: nowrap;
            animation: float-card 4s ease-in-out infinite;
        }
        .floating-card .fc-icon {
            width: 28px; height: 28px;
            border-radius: 6px;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: .75rem; margin-right: 6px;
        }
        .fc-green { background: #dcfce7; color: #16a34a; }
        .fc-blue  { background: #dbeafe; color: #2563eb; }
        .fc-purple { background: #ede9fe; color: #7c3aed; }
        .float-1 { bottom: -20px; left: -30px; animation-delay: 0s; }
        .float-2 { top: -16px; right: -24px; animation-delay: 1.5s; }
        .float-3 { top: 40%; right: -40px; animation-delay: .8s; }
        @keyframes float-card {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        /* ─── Features Section ─── */
        .lp-features { background: var(--light-bg); }
        .feature-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 28px 24px;
            border: 1.5px solid var(--border);
            height: 100%;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }
        .feature-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: var(--gradient);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .3s ease;
        }
        .feature-card:hover {
            border-color: rgba(0,76,218,.2);
            box-shadow: var(--shadow);
            transform: translateY(-4px);
        }
        .feature-card:hover::before { transform: scaleX(1); }
        .feature-icon-wrap {
            width: 52px; height: 52px;
            border-radius: 12px;
            background: var(--primary-light);
            display: flex; align-items: center; justify-content: center;
            color: var(--primary);
            font-size: 1.35rem;
            margin-bottom: 16px;
            transition: var(--transition);
        }
        .feature-card:hover .feature-icon-wrap {
            background: var(--primary);
            color: var(--white);
            transform: scale(1.05);
        }
        .feature-card h4 {
            font-size: .98rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
        }
        .feature-card p {
            font-size: .85rem;
            color: var(--muted);
            line-height: 1.6;
            margin: 0;
        }

        /* ─── Stats Section ─── */
        .lp-stats {
            background: var(--gradient);
            overflow: hidden;
        }
        .lp-stats::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='50' cy='50' r='40' fill='none' stroke='%23ffffff' stroke-width='.5' opacity='.08'/%3E%3C/svg%3E") repeat;
            background-size: 120px 120px;
        }
        .stat-counter-card {
            text-align: center;
            padding: 40px 24px;
            position: relative;
            z-index: 2;
        }
        .stat-counter-card + .stat-counter-card::before {
            content: '';
            position: absolute;
            left: 0; top: 25%; bottom: 25%;
            width: 1px;
            background: rgba(255,255,255,.2);
        }
        .stat-icon {
            width: 60px; height: 60px;
            background: rgba(255,255,255,.12);
            border: 1px solid rgba(255,255,255,.2);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin: 0 auto 18px;
        }
        .stat-number {
            font-size: clamp(2.2rem, 4vw, 3rem);
            font-weight: 900;
            color: var(--white);
            line-height: 1;
            display: block;
            margin-bottom: 8px;
        }
        .stat-suffix {
            font-size: 1.6rem;
            font-weight: 700;
            color: rgba(255,255,255,.75);
        }
        .stat-label {
            font-size: .88rem;
            color: rgba(255,255,255,.75);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* ─── How It Works ─── */
        .lp-how { background: var(--white); }
        .step-card {
            position: relative;
            text-align: center;
            padding: 36px 28px;
        }
        .step-connector {
            position: absolute;
            top: 45px;
            left: calc(50% + 55px);
            right: calc(-50% + 55px);
            height: 2px;
            background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
            display: none;
        }
        @media (min-width: 992px) { .step-connector { display: block; } }
        .step-number {
            width: 62px; height: 62px;
            border-radius: 50%;
            background: var(--gradient);
            color: var(--white);
            font-size: 1.3rem;
            font-weight: 900;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 22px;
            box-shadow: 0 8px 24px rgba(0,76,218,.3);
            position: relative;
            z-index: 2;
        }
        .step-icon {
            width: 48px; height: 48px;
            background: var(--primary-light);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.15rem;
            color: var(--primary);
            margin: 0 auto 16px;
        }
        .step-card h4 {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 10px;
        }
        .step-card p {
            font-size: .88rem;
            color: var(--muted);
            line-height: 1.65;
            margin: 0;
        }
        .step-role-tag {
            display: inline-block;
            font-size: .7rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--primary);
            background: var(--primary-light);
            padding: 3px 10px;
            border-radius: 100px;
            margin-bottom: 12px;
        }

        /* ─── Testimonials ─── */
        .lp-testimonials { background: var(--light-bg); }
        .testimonial-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 32px 28px;
            border: 1.5px solid var(--border);
            height: 100%;
            transition: var(--transition);
            position: relative;
        }
        .testimonial-card:hover {
            box-shadow: var(--shadow);
            border-color: rgba(0,76,218,.15);
        }
        .testimonial-quote-mark {
            position: absolute;
            top: 20px; right: 24px;
            font-size: 4rem;
            color: var(--primary-light);
            font-family: Georgia, serif;
            line-height: 1;
            pointer-events: none;
        }
        .testimonial-text {
            font-size: .93rem;
            color: var(--text);
            line-height: 1.75;
            margin-bottom: 24px;
            font-style: italic;
        }
        .testimonial-stars {
            color: #f59e0b;
            margin-bottom: 16px;
            font-size: .85rem;
        }
        .testimonial-author {
            display: flex; align-items: center; gap: 12px;
        }
        .author-avatar {
            width: 46px; height: 46px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: .9rem;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
        }
        .av-1 { background: linear-gradient(135deg, #6366f1, #8b5cf6); }
        .av-2 { background: linear-gradient(135deg, #0ea5e9, #006dcd); }
        .av-3 { background: linear-gradient(135deg, #10b981, #059669); }
        .author-name {
            font-weight: 700;
            font-size: .9rem;
            color: var(--dark);
            margin: 0;
        }
        .author-role {
            font-size: .78rem;
            color: var(--muted);
            margin: 0;
        }

        /* ─── CTA Section ─── */
        .lp-cta {
            background: var(--gradient);
            text-align: center;
            overflow: hidden;
        }
        .lp-cta::before {
            content: '';
            position: absolute;
            width: 600px; height: 600px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,.08);
            top: -200px; left: -100px;
        }
        .lp-cta::after {
            content: '';
            position: absolute;
            width: 400px; height: 400px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,.06);
            bottom: -150px; right: -50px;
        }
        .cta-inner { position: relative; z-index: 2; }
        .cta-title {
            font-size: clamp(1.8rem, 3.5vw, 2.6rem);
            font-weight: 900;
            color: var(--white);
            line-height: 1.2;
            margin-bottom: 16px;
            letter-spacing: -0.5px;
        }
        .cta-sub {
            font-size: 1rem;
            color: rgba(255,255,255,.8);
            max-width: 480px;
            margin: 0 auto 32px;
        }
        .btn-cta {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--white);
            color: var(--primary);
            font-weight: 700;
            font-size: 1rem;
            padding: 15px 36px;
            border-radius: var(--radius-sm);
            box-shadow: 0 4px 20px rgba(0,0,0,.15);
            transition: var(--transition);
        }
        .btn-cta:hover {
            background: var(--primary-light);
            color: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0,0,0,.22);
        }

        /* ─── Footer ─── */
        .lp-footer {
            background: var(--dark);
            color: rgba(255,255,255,.7);
            padding: 64px 0 0;
        }
        .footer-brand {
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 16px;
        }
        .footer-brand-icon {
            width: 36px; height: 36px;
            background: var(--gradient);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: .9rem;
        }
        .footer-brand-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: white;
        }
        .footer-desc {
            font-size: .88rem;
            line-height: 1.7;
            margin-bottom: 20px;
            max-width: 280px;
        }
        .footer-socials { display: flex; gap: 10px; }
        .social-btn {
            width: 36px; height: 36px;
            border-radius: 8px;
            background: rgba(255,255,255,.08);
            border: 1px solid rgba(255,255,255,.1);
            display: flex; align-items: center; justify-content: center;
            color: rgba(255,255,255,.6);
            font-size: .85rem;
            transition: var(--transition);
        }
        .social-btn:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
            transform: translateY(-2px);
        }
        .footer-heading {
            font-size: .78rem;
            font-weight: 700;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 20px;
        }
        .footer-links { list-style: none; padding: 0; margin: 0; }
        .footer-links li { margin-bottom: 10px; }
        .footer-links a {
            color: rgba(255,255,255,.6);
            font-size: .88rem;
            transition: var(--transition);
            display: inline-flex; align-items: center; gap: 6px;
        }
        .footer-links a:hover { color: white; padding-left: 4px; }
        .footer-links a i { font-size: .7rem; opacity: .5; }
        .contact-item {
            display: flex; align-items: flex-start; gap: 10px;
            margin-bottom: 14px;
        }
        .contact-item i {
            color: var(--secondary);
            font-size: .9rem;
            margin-top: 3px;
            flex-shrink: 0;
        }
        .contact-item span {
            font-size: .87rem;
            color: rgba(255,255,255,.6);
            line-height: 1.5;
        }
        .footer-bottom {
            margin-top: 48px;
            padding: 20px 0;
            border-top: 1px solid rgba(255,255,255,.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }
        .footer-bottom p {
            font-size: .82rem;
            color: rgba(255,255,255,.4);
            margin: 0;
        }
        .footer-bottom a { color: rgba(255,255,255,.5); }
        .footer-bottom a:hover { color: white; }

        /* ─── Scroll To Top ─── */
        .lp-scroll-top {
            position: fixed;
            bottom: 28px; right: 28px;
            width: 42px; height: 42px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: .9rem;
            cursor: pointer;
            z-index: 9000;
            opacity: 0; pointer-events: none;
            transition: var(--transition);
            box-shadow: 0 4px 16px rgba(0,76,218,.4);
        }
        .lp-scroll-top.visible { opacity: 1; pointer-events: auto; }
        .lp-scroll-top:hover { background: var(--primary-dark); transform: translateY(-3px); }

        /* ─── Divider Wave ─── */
        .wave-divider { display: block; width: 100%; overflow: hidden; line-height: 0; }
        .wave-divider svg { display: block; width: 100%; }

        /* ─── Responsive ─── */
        @media (max-width: 991px) {
            .section-pad { padding: 72px 0; }
            .lp-hero { min-height: auto; padding: 120px 0 80px; }
            .hero-illustration { margin-top: 48px; }
            .stat-counter-card + .stat-counter-card::before { display: none; }
            .stat-counter-card { border-top: 1px solid rgba(255,255,255,.1); }
            .stat-counter-card:first-child { border-top: none; }
        }
        @media (max-width: 767px) {
            .section-pad { padding: 56px 0; }
            .sec-title { font-size: 1.7rem; }
            .float-2, .float-3 { display: none; }
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- ===== Navbar ===== -->
    <nav class="lp-nav navbar navbar-expand-lg" id="lpNav">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <span class="brand-icon"><i class="fas fa-heartbeat"></i></span>
                <span class="brand-text">Medi<em>Core</em> HMS</span>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#lpNavLinks" aria-controls="lpNavLinks"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="lpNavLinks">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#how-it-works">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
                <div class="navbar-nav">
                    <a href="{{ route('login') }}" class="btn-nav-login">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <!-- ===== /Navbar ===== -->

    @yield('content')

    <!-- ===== Footer ===== -->
    <footer class="lp-footer" id="contact">
        <div class="container">
            <div class="row">
                <!-- Brand -->
                <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                    <div class="footer-brand">
                        <div class="footer-brand-icon"><i class="fas fa-heartbeat"></i></div>
                        <span class="footer-brand-name">MediCore HMS</span>
                    </div>
                    <p class="footer-desc">
                        A complete hospital management platform designed to streamline patient care,
                        clinical workflows, and administrative operations under one roof.
                    </p>
                    <div class="footer-socials">
                        <a href="#" class="social-btn"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-btn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-btn"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-btn"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6 mb-5 mb-lg-0">
                    <p class="footer-heading">Quick Links</p>
                    <ul class="footer-links">
                        <li><a href="#home"><i class="fas fa-chevron-right"></i> Home</a></li>
                        <li><a href="#features"><i class="fas fa-chevron-right"></i> Features</a></li>
                        <li><a href="#how-it-works"><i class="fas fa-chevron-right"></i> How It Works</a></li>
                        <li><a href="{{ route('login') }}"><i class="fas fa-chevron-right"></i> Login</a></li>
                        <li><a href="{{ route('register') }}"><i class="fas fa-chevron-right"></i> Register</a></li>
                    </ul>
                </div>

                <!-- Modules -->
                <div class="col-lg-2 col-md-6 mb-5 mb-lg-0">
                    <p class="footer-heading">Modules</p>
                    <ul class="footer-links">
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Appointments</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Patient Portal</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Laboratory</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Radiology</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Billing</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                    <p class="footer-heading">Contact</p>
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Medical District, Healthcare Ave,<br>City, Country</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone-alt"></i>
                        <span>+1 (800) 123-4567</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <span>support@medicorehms.com</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-clock"></i>
                        <span>Mon – Fri: 08:00 – 20:00<br>Emergency: 24/7</span>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} MediCore HMS. All rights reserved.</p>
                <p>Built with <i class="fas fa-heart" style="color:#ef4444;font-size:.75rem;"></i> for better healthcare</p>
            </div>
        </div>
    </footer>
    <!-- ===== /Footer ===== -->

    <!-- Scroll To Top -->
    <div class="lp-scroll-top" id="scrollTop" onclick="window.scrollTo({top:0,behavior:'smooth'})">
        <i class="fas fa-chevron-up"></i>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('WebSite/js/jquery.js') }}"></script>
    <script src="{{ asset('WebSite/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('WebSite/js/wow.js') }}"></script>

    <script>
        // Init WOW animations
        new WOW({ offset: 80, mobile: false }).init();

        // Navbar scroll behavior
        var lpNav = document.getElementById('lpNav');
        window.addEventListener('scroll', function () {
            if (window.scrollY > 50) {
                lpNav.classList.add('is-scrolled');
            } else {
                lpNav.classList.remove('is-scrolled');
            }
            // Scroll to top visibility
            var st = document.getElementById('scrollTop');
            if (window.scrollY > 400) st.classList.add('visible');
            else st.classList.remove('visible');
        });

        // Counter animation
        function animateCounter(el, target, suffix) {
            var duration = 1800;
            var start = performance.now();
            function step(now) {
                var elapsed = now - start;
                var progress = Math.min(elapsed / duration, 1);
                var ease = 1 - Math.pow(1 - progress, 3);
                el.textContent = Math.floor(ease * target).toLocaleString() + (suffix || '');
                if (progress < 1) requestAnimationFrame(step);
            }
            requestAnimationFrame(step);
        }

        // Trigger counters when stats section enters viewport
        var countersTriggered = false;
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting && !countersTriggered) {
                    countersTriggered = true;
                    document.querySelectorAll('[data-count]').forEach(function (el) {
                        var target = parseInt(el.getAttribute('data-count'), 10);
                        var suffix = el.getAttribute('data-suffix') || '';
                        animateCounter(el, target, suffix);
                    });
                }
            });
        }, { threshold: 0.3 });

        var statsSection = document.getElementById('stats');
        if (statsSection) observer.observe(statsSection);
    </script>

    @stack('scripts')
</body>
</html>
