<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>MediCore — Hospital Management System</title>
    <meta name="description" content="MediCore HMS — clinical scheduling, records and billing, run from one trusted platform.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    @livewireStyles

    <style>
        :root {
            --primary: #0284c7;
            --accent: #0369a1;
            --dark: #0f172a;
            --bg-soft: #f0f9ff;
            --border: #e2e8f0;
            --muted: #64748b;
        }
        * { box-sizing: border-box; }
        html, body {
            font-family: 'Inter', sans-serif;
            color: var(--dark);
            background: #ffffff;
            -webkit-font-smoothing: antialiased;
        }
        a { text-decoration: none; }
        .text-primary-brand { color: var(--primary); }
        .bg-soft { background: var(--bg-soft); }

        .btn-brand {
            background: var(--primary); color: #fff; border: 1px solid var(--primary);
            font-weight: 600; font-size: .92rem; padding: 10px 20px; border-radius: 8px;
            transition: background-color .15s, border-color .15s;
        }
        .btn-brand:hover { background: var(--accent); border-color: var(--accent); color: #fff; }

        .btn-brand-dark {
            background: var(--accent); color: #fff; border: 1px solid var(--accent);
            font-weight: 600; font-size: .92rem; padding: 10px 20px; border-radius: 8px;
            transition: background-color .15s;
        }
        .btn-brand-dark:hover { background: var(--dark); border-color: var(--dark); color: #fff; }

        .btn-outline-brand {
            background: transparent; color: var(--primary); border: 1.5px solid var(--primary);
            font-weight: 600; font-size: .92rem; padding: 10px 20px; border-radius: 8px;
            transition: background-color .15s, color .15s;
        }
        .btn-outline-brand:hover { background: var(--primary); color: #fff; }

        /* ── Navbar ────────────────────────────────────────────── */
        .navbar-brand-mc { display: flex; align-items: center; gap: 10px; font-weight: 800; font-size: 1.25rem; color: var(--dark); }
        .navbar-brand-mc .mark {
            width: 38px; height: 38px; border-radius: 8px; background: var(--primary);
            display: flex; align-items: center; justify-content: center; color: #fff; font-size: 1.1rem; flex-shrink: 0;
        }
        .site-nav { border-bottom: 1px solid var(--border); background: #fff; padding: 14px 0; }
        .site-nav .nav-link-mc { color: var(--dark); font-weight: 500; font-size: .92rem; margin: 0 16px; }
        .site-nav .nav-link-mc:hover { color: var(--primary); }

        /* ── Hero ──────────────────────────────────────────────── */
        .hero { padding: 76px 0; background: #ffffff; }
        .hero-tag {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--bg-soft); color: var(--accent); border-radius: 30px;
            font-size: .82rem; font-weight: 600; padding: 7px 16px; margin-bottom: 22px;
        }
        .hero h1 { font-size: clamp(2.1rem, 4vw, 3.1rem); font-weight: 800; line-height: 1.18; letter-spacing: -0.01em; color: var(--dark); }
        .hero h1 span { color: var(--primary); }
        .hero p.lede { font-size: 1.05rem; color: var(--muted); max-width: 480px; line-height: 1.7; margin: 20px 0 30px; }
        .trust-row { display: flex; gap: 26px; margin-top: 32px; flex-wrap: wrap; }
        .trust-row .t-item { display: flex; align-items: center; gap: 10px; }
        .trust-row .t-ic { width: 34px; height: 34px; border-radius: 8px; background: var(--bg-soft); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: .95rem; flex-shrink: 0; }
        .trust-row .t-num { font-weight: 800; font-size: 1.15rem; color: var(--dark); line-height: 1; }
        .trust-row .t-lbl { font-size: .74rem; color: var(--muted); }

        /* ── Avatar stack (social proof) ─────────────────────── */
        .avatar-stack-row { display: flex; align-items: center; gap: 12px; margin-top: 28px; }
        .avatar-stack { display: flex; }
        .avatar-stack .av {
            width: 38px; height: 38px; border-radius: 50%; border: 2px solid #fff;
            background: var(--primary); color: #fff; font-size: .72rem; font-weight: 700;
            display: flex; align-items: center; justify-content: center; margin-right: -10px;
        }
        .avatar-stack .av:nth-child(2) { background: var(--accent); }
        .avatar-stack .av:nth-child(3) { background: var(--dark); }
        .avatar-stack .av.more { background: var(--bg-soft); color: var(--primary); font-size: .68rem; }
        .avatar-stack-row .txt { font-size: .82rem; color: var(--muted); font-weight: 500; }
        .avatar-stack-row .txt strong { color: var(--dark); }

        /* ── Hero visual backdrop ─────────────────────────────── */
        .hero-visual { position: relative; padding: 14px; background: var(--bg-soft); border-radius: 20px; }

        .feature-card {
            background: #fff; border: 1px solid var(--border); border-radius: 14px;
            padding: 22px; height: 100%;
        }
        .feature-card .ic {
            width: 46px; height: 46px; border-radius: 10px; background: var(--bg-soft);
            display: flex; align-items: center; justify-content: center; color: var(--primary);
            font-size: 1.3rem; margin-bottom: 14px;
        }
        .feature-card h3 { font-size: .98rem; font-weight: 700; margin-bottom: 6px; color: var(--dark); }
        .feature-card p { font-size: .82rem; color: var(--muted); margin: 0; line-height: 1.5; }
        .feature-card.featured { background: var(--primary); border-color: var(--primary); }
        .feature-card.featured .ic { background: rgba(255,255,255,.18); color: #fff; }
        .feature-card.featured h3, .feature-card.featured p { color: #fff; }
        .feature-card.featured p { color: rgba(255,255,255,.85); }

        /* ── Stats strip ───────────────────────────────────────── */
        .stats-strip { background: var(--bg-soft); padding: 44px 0; border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); }
        .stat-block { text-align: center; border-right: 1px solid var(--border); }
        .stat-block:last-child { border-right: 0; }
        .stat-block .num { font-size: 2rem; font-weight: 800; color: var(--primary); }
        .stat-block .lbl { font-size: .82rem; color: var(--muted); font-weight: 500; }

        /* ── Section heading ──────────────────────────────────── */
        .section-pad { padding: 86px 0; }
        .section-head { text-align: center; max-width: 640px; margin: 0 auto 48px; }
        .section-head .eyebrow { color: var(--primary); font-weight: 700; font-size: .82rem; letter-spacing: .06em; text-transform: uppercase; margin-bottom: 10px; display: block; }
        .section-head h2 { font-size: clamp(1.8rem, 3vw, 2.4rem); font-weight: 800; color: var(--dark); margin: 0 0 12px; }
        .section-head p { color: var(--muted); font-size: 1rem; margin: 0; }

        /* ── Department cards ─────────────────────────────────── */
        .dept-card { border: 1px solid var(--border); border-radius: 14px; padding: 26px; height: 100%; background: #fff; transition: border-color .15s, box-shadow .15s; }
        .dept-card:hover { border-color: var(--primary); box-shadow: 0 6px 18px rgba(2,132,199,.08); }
        .dept-card .ic-circle {
            width: 52px; height: 52px; border-radius: 50%; background: var(--bg-soft);
            display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 1.4rem; margin-bottom: 16px;
        }
        .dept-card h3 { font-size: 1.05rem; font-weight: 700; color: var(--dark); margin-bottom: 8px; }
        .dept-card p { font-size: .85rem; color: var(--muted); margin-bottom: 14px; line-height: 1.55; min-height: 42px; }
        .dept-card .meta { display: flex; align-items: center; justify-content: space-between; font-size: .8rem; padding-top: 14px; border-top: 1px solid var(--border); }
        .dept-card .meta .count { font-weight: 700; color: var(--dark); }
        .badge-status { font-size: .72rem; font-weight: 700; padding: 4px 10px; border-radius: 30px; }
        .badge-status.active { background: #ecfdf5; color: #15803d; }
        .badge-status.standby { background: #f1f5f9; color: var(--muted); }

        /* ── How it works ─────────────────────────────────────── */
        .step-card { position: relative; padding: 30px 26px 26px; height: 100%; }
        .step-num {
            width: 44px; height: 44px; border-radius: 10px; background: var(--primary); color: #fff;
            display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.05rem;
            margin-bottom: 18px;
        }
        .step-card h3 { font-size: 1.02rem; font-weight: 700; color: var(--dark); margin-bottom: 8px; }
        .step-card p { font-size: .86rem; color: var(--muted); margin: 0; line-height: 1.55; }
        .step-connector { display: none; }
        @media (min-width: 992px) {
            .step-connector { display: block; position: absolute; top: 22px; left: -16px; width: 32px; height: 2px; background: var(--border); }
        }

        /* ── Specialists ───────────────────────────────────────── */
        .doc-card { border: 1px solid var(--border); border-radius: 14px; padding: 22px; text-align: center; background: #fff; transition: border-color .15s, box-shadow .15s; height: 100%; }
        .doc-card:hover { border-color: var(--primary); box-shadow: 0 6px 18px rgba(2,132,199,.08); }
        .doc-avatar {
            width: 64px; height: 64px; border-radius: 50%; background: var(--primary); color: #fff;
            display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1.1rem;
            margin: 0 auto 14px;
        }
        .doc-card h3 { font-size: .95rem; font-weight: 700; color: var(--dark); margin-bottom: 4px; }
        .doc-card .spec { font-size: .78rem; color: var(--muted); margin-bottom: 10px; }
        .doc-badge { display: inline-flex; align-items: center; gap: 5px; background: var(--bg-soft); color: var(--accent); font-size: .72rem; font-weight: 700; padding: 4px 10px; border-radius: 30px; }

        /* ── CTA band ──────────────────────────────────────────── */
        .cta-band { background: var(--primary); border-radius: 20px; padding: 52px 48px; color: #fff; }
        .cta-band h2 { font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 800; margin: 0 0 8px; }
        .cta-band p { color: rgba(255,255,255,.85); margin: 0; font-size: .95rem; }
        .cta-band .btn-light-mc { background: #fff; color: var(--primary); border: 1px solid #fff; font-weight: 700; font-size: .92rem; padding: 11px 22px; border-radius: 8px; }
        .cta-band .btn-light-mc:hover { background: var(--bg-soft); }
        .cta-band .btn-outline-light-mc { background: transparent; color: #fff; border: 1.5px solid rgba(255,255,255,.5); font-weight: 700; font-size: .92rem; padding: 11px 22px; border-radius: 8px; }
        .cta-band .btn-outline-light-mc:hover { background: rgba(255,255,255,.12); border-color: #fff; }

        /* ── Book appointment ──────────────────────────────────── */
        .booking-side { height: 100%; }
        .booking-side .side-item { display: flex; gap: 14px; margin-bottom: 22px; }
        .booking-side .side-ic { width: 38px; height: 38px; border-radius: 9px; background: var(--bg-soft); color: var(--primary); display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 1rem; }
        .booking-side h4 { font-size: .92rem; font-weight: 700; color: var(--dark); margin-bottom: 3px; }
        .booking-side p { font-size: .82rem; color: var(--muted); margin: 0; line-height: 1.5; }
        .booking-card { background: var(--dark); border-radius: 20px; padding: 48px; color: #fff; }
        .booking-card .form-control, .booking-card .form-select {
            border-radius: 8px; border: 1px solid rgba(255,255,255,.18); background: rgba(255,255,255,.06);
            color: #fff; padding: 11px 14px; font-size: .92rem;
        }
        .booking-card .form-control::placeholder { color: rgba(255,255,255,.45); }
        .booking-card .form-control:focus, .booking-card .form-select:focus {
            background: rgba(255,255,255,.1); border-color: var(--primary); box-shadow: 0 0 0 3px rgba(2,132,199,.35); color: #fff;
        }
        .booking-card select.form-select option { color: #0f172a; }
        .booking-card label { font-size: .82rem; font-weight: 600; color: rgba(255,255,255,.7); margin-bottom: 6px; }

        /* ── Footer ────────────────────────────────────────────── */
        footer { background: var(--dark); color: rgba(255,255,255,.7); padding: 56px 0 24px; }
        footer h5 { color: #fff; font-weight: 700; font-size: .95rem; margin-bottom: 16px; }
        footer a { color: rgba(255,255,255,.65); font-size: .88rem; }
        footer a:hover { color: #fff; }
        footer .foot-bottom { border-top: 1px solid rgba(255,255,255,.12); margin-top: 36px; padding-top: 20px; font-size: .82rem; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 10px; }
    </style>
</head>

<body>

    <nav class="site-nav">
        <div class="container d-flex align-items-center justify-content-between flex-wrap gap-3">
            <a href="{{ route('home') }}" class="navbar-brand-mc">
                <span class="mark"><i class="bi bi-hospital-fill"></i></span>
                MediCore
            </a>
            <div class="d-none d-lg-flex align-items-center">
                <a href="#departments" class="nav-link-mc">Departments</a>
                <a href="#features" class="nav-link-mc">Why MediCore</a>
                <a href="#book-appointment" class="nav-link-mc">Book Appointment</a>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('login') }}" class="btn-brand">Patient Portal</a>
                <a href="{{ route('login') }}" class="btn-brand-dark">Staff Login</a>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="hero-tag"><i class="bi bi-patch-check-fill"></i> Trusted Hospital Management Platform</span>
                    <h1>Healthcare operations, run from <span>one connected system.</span></h1>
                    <p class="lede">
                        MediCore brings scheduling, clinical records, diagnostics, billing and
                        real-time communication into a single platform — built for doctors,
                        patients and clinical staff alike.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#book-appointment" class="btn-brand">
                            <i class="bi bi-calendar2-check-fill me-1"></i> Book Appointment
                        </a>
                        <a href="#departments" class="btn-outline-brand">Explore Departments</a>
                    </div>
                    <div class="trust-row">
                        <div class="t-item">
                            <span class="t-ic"><i class="bi bi-person-badge-fill"></i></span>
                            <div>
                                <div class="t-num">{{ $stats['active_staff'] }}+</div>
                                <div class="t-lbl">Specialist Doctors</div>
                            </div>
                        </div>
                        <div class="t-item">
                            <span class="t-ic"><i class="bi bi-grid-fill"></i></span>
                            <div>
                                <div class="t-num">{{ $stats['sections'] }}</div>
                                <div class="t-lbl">Clinical Departments</div>
                            </div>
                        </div>
                        <div class="t-item">
                            <span class="t-ic"><i class="bi bi-heart-pulse-fill"></i></span>
                            <div>
                                <div class="t-num">{{ $stats['patients_served'] }}+</div>
                                <div class="t-lbl">Patients Served</div>
                            </div>
                        </div>
                        <div class="t-item">
                            <span class="t-ic"><i class="bi bi-graph-up"></i></span>
                            <div>
                                <div class="t-num">99.9%</div>
                                <div class="t-lbl">System Uptime</div>
                            </div>
                        </div>
                    </div>

                    @if($doctors->count() > 0)
                    <div class="avatar-stack-row">
                        <div class="avatar-stack">
                            @foreach($doctors->take(3) as $doc)
                            <span class="av">{{ str($doc->name)->substr(0, 1) }}{{ str($doc->name)->after(' ')->substr(0, 1) }}</span>
                            @endforeach
                            @if($stats['active_staff'] > 3)
                            <span class="av more">+{{ $stats['active_staff'] - 3 }}</span>
                            @endif
                        </div>
                        <span class="txt"><strong>{{ $stats['active_staff'] }} specialists</strong> currently on staff</span>
                    </div>
                    @endif
                </div>

                <div class="col-lg-6" id="features">
                    <div class="hero-visual">
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="feature-card featured">
                                    <div class="ic"><i class="bi bi-clock-history"></i></div>
                                    <h3>24/7 Emergency</h3>
                                    <p>Round-the-clock emergency response, every day of the year.</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="feature-card">
                                    <div class="ic"><i class="bi bi-person-badge-fill"></i></div>
                                    <h3>Expert Consultants</h3>
                                    <p>{{ $stats['active_staff'] }}+ specialists across {{ $stats['sections'] }} departments.</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="feature-card">
                                    <div class="ic"><i class="bi bi-shield-check"></i></div>
                                    <h3>Secure Records</h3>
                                    <p>Clinical data encrypted in transit and at rest.</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="feature-card">
                                    <div class="ic"><i class="bi bi-chat-dots-fill"></i></div>
                                    <h3>Direct Messaging</h3>
                                    <p>Real-time, secure chat between doctors and patients.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-pad" style="padding-top:64px; padding-bottom:64px;" id="how-it-works">
        <div class="container">
            <div class="section-head">
                <span class="eyebrow">How It Works</span>
                <h2>Get seen in three simple steps</h2>
                <p>No account needed to request an appointment — sign in only when you're ready to manage your records.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="step-card">
                        <div class="step-num">1</div>
                        <h3>Choose a department</h3>
                        <p>Pick the department and doctor that matches what you need — browse {{ $stats['sections'] }} active departments below.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-card">
                        <span class="step-connector"></span>
                        <div class="step-num">2</div>
                        <h3>Submit your request</h3>
                        <p>Fill in your details once in the booking form — no login, no waiting on hold.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-card">
                        <span class="step-connector"></span>
                        <div class="step-num">3</div>
                        <h3>We confirm by phone &amp; email</h3>
                        <p>Our team confirms the date and time directly with you, then your visit is on the calendar.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="stats-strip">
        <div class="container">
            <div class="row gy-3">
                <div class="col-6 col-md-3 stat-block">
                    <div class="num">{{ $stats['active_staff'] }}</div>
                    <div class="lbl">Active Staff</div>
                </div>
                <div class="col-6 col-md-3 stat-block">
                    <div class="num">{{ $stats['sections'] }}</div>
                    <div class="lbl">Clinical Sections</div>
                </div>
                <div class="col-6 col-md-3 stat-block">
                    <div class="num">{{ $stats['patients_served'] }}+</div>
                    <div class="lbl">Patients Served</div>
                </div>
                <div class="col-6 col-md-3 stat-block">
                    <div class="num">99.9%</div>
                    <div class="lbl">Uptime (30d)</div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-pad" id="departments">
        <div class="container">
            <div class="section-head">
                <span class="eyebrow">Clinical Departments</span>
                <h2>Departments currently in operation</h2>
                <p>Every department below is staffed and operating under MediCore HMS today.</p>
            </div>

            @php
                $deptIcons = ['bi-clipboard2-pulse', 'bi-heart-pulse', 'bi-bandaid', 'bi-capsule', 'bi-eye', 'bi-lungs', 'bi-thermometer', 'bi-prescription2'];
            @endphp

            <div class="row g-4">
                @foreach($sections as $i => $section)
                <div class="col-md-6 col-lg-3">
                    <div class="dept-card">
                        <div class="ic-circle"><i class="bi {{ $deptIcons[$i % count($deptIcons)] }}"></i></div>
                        <h3>{{ $section->name }}</h3>
                        @if($section->description)
                        <p>{{ str($section->description)->limit(72) }}</p>
                        @else
                        <p>&nbsp;</p>
                        @endif
                        <div class="meta">
                            <span class="count">{{ $section->doctors_count }} staff</span>
                            @if($section->doctors_count > 0)
                            <span class="badge-status active">Active</span>
                            @else
                            <span class="badge-status standby">Standby</span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-5">
                <p class="text-muted mb-3" style="font-size:.92rem;">Not sure which department you need?</p>
                <a href="#book-appointment" class="btn-brand">Book an Appointment <i class="bi bi-arrow-right ms-1"></i></a>
            </div>
        </div>
    </section>

    @if($doctors->count() > 0)
    <section class="section-pad bg-soft" id="specialists">
        <div class="container">
            <div class="section-head">
                <span class="eyebrow">Our Team</span>
                <h2>Meet our specialists</h2>
                <p>A sample of the {{ $stats['active_staff'] }} active doctors currently on staff at MediCore.</p>
            </div>

            <div class="row g-4">
                @foreach($doctors as $doc)
                <div class="col-6 col-md-3">
                    <div class="doc-card">
                        <div class="doc-avatar">{{ str($doc->name)->substr(0, 1) }}{{ str($doc->name)->after(' ')->substr(0, 1) }}</div>
                        <h3>{{ $doc->name }}</h3>
                        <p class="spec">{{ optional($doc->section)->name ?? 'General Practice' }}</p>
                        <span class="doc-badge"><i class="bi bi-heart-pulse-fill"></i> DR</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <section class="section-pad" id="book-appointment">
        <div class="container">
            <div class="section-head">
                <span class="eyebrow">Get Started</span>
                <h2>Book your appointment</h2>
                <p>Tell us which department and doctor you'd like to see — our team will confirm by phone and email.</p>
            </div>

            <div class="row g-4 justify-content-center align-items-stretch">
                <div class="col-lg-3 d-none d-lg-block">
                    <div class="booking-side">
                        <div class="side-item">
                            <span class="side-ic"><i class="bi bi-1-circle-fill"></i></span>
                            <div>
                                <h4>Tell us about you</h4>
                                <p>Name, email and phone so we can reach you.</p>
                            </div>
                        </div>
                        <div class="side-item">
                            <span class="side-ic"><i class="bi bi-2-circle-fill"></i></span>
                            <div>
                                <h4>Pick department &amp; doctor</h4>
                                <p>Choosing a department filters the doctor list automatically.</p>
                            </div>
                        </div>
                        <div class="side-item">
                            <span class="side-ic"><i class="bi bi-3-circle-fill"></i></span>
                            <div>
                                <h4>We'll be in touch</h4>
                                <p>Confirmation follows by phone and email — usually the same day.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="booking-card">
                        @livewire('appointments.create')
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-pad bg-soft">
        <div class="container">
            <div class="cta-band d-flex flex-wrap align-items-center justify-content-between gap-4">
                <div>
                    <h2>Ready to get started?</h2>
                    <p>Patients, doctors and clinical staff each sign in through one guarded login screen.</p>
                </div>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('login') }}" class="btn-light-mc">Patient Portal</a>
                    <a href="{{ route('login') }}" class="btn-outline-light-mc">Staff Login</a>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="navbar-brand-mc" style="color:#fff;">
                        <span class="mark"><i class="bi bi-hospital-fill"></i></span>
                        MediCore
                    </div>
                    <p class="mt-3" style="font-size:.85rem; max-width: 320px;">
                        Hospital management system — scheduling, clinical records, diagnostics
                        and billing, run from one secure platform.
                    </p>
                </div>
                <div class="col-lg-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled d-flex flex-column gap-2">
                        <li><a href="#departments">Departments</a></li>
                        <li><a href="#book-appointment">Book Appointment</a></li>
                        <li><a href="{{ route('login') }}">Patient / Staff Login</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5>Access</h5>
                    <p style="font-size:.85rem;">
                        Patients, doctors and clinical staff each sign in through one guarded
                        login screen.
                    </p>
                    <a href="{{ route('login') }}" class="btn-outline-brand" style="border-color:rgba(255,255,255,.3); color:#fff;">Sign In</a>
                </div>
            </div>
            <div class="foot-bottom">
                <span>© {{ date('Y') }} MediCore HMS — All records encrypted in transit &amp; at rest.</span>
                <span>Build {{ date('Y.m.d') }}</span>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>

</html>
