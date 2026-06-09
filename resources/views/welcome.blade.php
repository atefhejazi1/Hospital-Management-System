@extends('layouts.landing')

@section('content')

{{-- ============================================================
     SECTION 1 · HERO
     ============================================================ --}}
<section class="lp-hero" id="home">
    <div class="hero-orb hero-orb-1"></div>
    <div class="hero-orb hero-orb-2"></div>
    <div class="hero-orb hero-orb-3"></div>

    <div class="container hero-content">
        <div class="row align-items-center">

            {{-- Left: copy --}}
            <div class="col-lg-6 col-md-12">
                <div class="hero-badge">
                    <span class="badge-dot"></span>
                    Trusted by Healthcare Professionals
                </div>

                <h1 class="hero-title">
                    Elevate Patient Care<br>
                    <span class="highlight">From Every Angle.</span>
                </h1>

                <p class="hero-sub">
                    MediCore HMS unifies patient management, clinical workflows, diagnostics,
                    billing, and real-time communication — so your team can focus on what
                    matters most: delivering outstanding care.
                </p>

                <div class="hero-actions">
                    <a href="{{ route('login') }}" class="btn-hero-primary">
                        <i class="fas fa-rocket"></i> Get Started
                    </a>
                    <a href="#features" class="btn-hero-secondary">
                        <i class="fas fa-play-circle"></i> Explore Features
                    </a>
                </div>

                <div class="hero-trust">
                    <div class="hero-trust-avatars">
                        <span>DR</span><span>AH</span><span>MN</span><span>SL</span>
                    </div>
                    <span>Join hundreds of doctors &amp; administrators already on board</span>
                </div>
            </div>

            {{-- Right: dashboard illustration --}}
            <div class="col-lg-6 col-md-12 hero-illustration">
                <div class="position-relative" style="max-width:500px;margin:0 auto;">

                    {{-- Main dashboard card --}}
                    <div class="dashboard-card main-card wow fadeInRight" data-wow-duration="0.7s">
                        <div class="card-header-bar">
                            <span class="card-title-text">Hospital Overview</span>
                            <span class="card-badge-live">Live</span>
                        </div>

                        <div class="stat-row">
                            <div class="stat-item">
                                <span class="stat-num">247</span>
                                <span class="stat-lbl">Patients</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-num">38</span>
                                <span class="stat-lbl">Doctors</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-num">12</span>
                                <span class="stat-lbl">Depts</span>
                            </div>
                        </div>

                        <div style="margin-bottom:8px;">
                            <div class="chart-bars">
                                <div class="chart-bar" style="height:35%"></div>
                                <div class="chart-bar" style="height:55%"></div>
                                <div class="chart-bar active" style="height:80%"></div>
                                <div class="chart-bar" style="height:65%"></div>
                                <div class="chart-bar" style="height:90%"></div>
                                <div class="chart-bar active" style="height:75%"></div>
                                <div class="chart-bar" style="height:50%"></div>
                            </div>
                            <div class="chart-labels">
                                <span>Mon</span><span>Tue</span><span>Wed</span>
                                <span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span>
                            </div>
                        </div>

                        <ul class="mini-list" style="margin-top:12px;">
                            <li>
                                <span><i class="fas fa-user-md" style="margin-right:6px;opacity:.7;"></i> Dr. Nadia Al-Rashid</span>
                                <span class="pill pill-green">Available</span>
                            </li>
                            <li>
                                <span><i class="fas fa-calendar-check" style="margin-right:6px;opacity:.7;"></i> Next Appointment</span>
                                <span class="pill pill-blue">10:30 AM</span>
                            </li>
                            <li>
                                <span><i class="fas fa-flask" style="margin-right:6px;opacity:.7;"></i> Lab Results</span>
                                <span class="pill pill-yellow">Pending</span>
                            </li>
                        </ul>
                    </div>

                    {{-- Floating micro-cards --}}
                    <div class="floating-card float-1 wow fadeInLeft" data-wow-delay="0.4s" data-wow-duration="0.6s">
                        <span class="fc-icon fc-green"><i class="fas fa-check"></i></span>
                        Appointment Confirmed
                    </div>

                    <div class="floating-card float-2 wow fadeInRight" data-wow-delay="0.6s" data-wow-duration="0.6s">
                        <span class="fc-icon fc-blue"><i class="fas fa-file-medical"></i></span>
                        Lab Report Ready
                    </div>

                    <div class="floating-card float-3 wow fadeInRight" data-wow-delay="0.8s" data-wow-duration="0.6s">
                        <span class="fc-icon fc-purple"><i class="fas fa-comment-dots"></i></span>
                        New Message
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Wave divider --}}
<div class="wave-divider" style="background:var(--gradient);margin-bottom:-2px;">
    <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,60 C360,0 1080,60 1440,0 L1440,60 Z" fill="#f8faff"/>
    </svg>
</div>


{{-- ============================================================
     SECTION 2 · FEATURES
     ============================================================ --}}
<section class="lp-features section-pad" id="features">
    <div class="container">

        <div class="text-center mb-5">
            <div class="sec-eyebrow"><i class="fas fa-th-large"></i> System Modules</div>
            <h2 class="sec-title">Everything a Modern Hospital <span>Needs</span></h2>
            <p class="sec-subtitle">
                From patient intake to final billing — every module is purpose-built,
                tightly integrated, and designed for real clinical environments.
            </p>
        </div>

        <div class="row">

            {{-- 1 --}}
            <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.05s">
                <div class="feature-card">
                    <div class="feature-icon-wrap"><i class="fas fa-user-injured"></i></div>
                    <h4>Patient Management</h4>
                    <p>Maintain complete patient profiles — demographics, medical history, insurance, and linked financial accounts — all in one structured record.</p>
                </div>
            </div>

            {{-- 2 --}}
            <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="feature-card">
                    <div class="feature-icon-wrap"><i class="fas fa-calendar-alt"></i></div>
                    <h4>Appointment Scheduling</h4>
                    <p>Patients book directly online; admins approve or redirect. SMS and email confirmations keep everyone in sync before the visit.</p>
                </div>
            </div>

            {{-- 3 --}}
            <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.15s">
                <div class="feature-card">
                    <div class="feature-icon-wrap"><i class="fas fa-user-md"></i></div>
                    <h4>Doctor Portal</h4>
                    <p>Dedicated doctor dashboard for viewing assigned patients, recording diagnoses, ordering diagnostics, and tracking personal schedules.</p>
                </div>
            </div>

            {{-- 4 --}}
            <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.05s">
                <div class="feature-card">
                    <div class="feature-icon-wrap"><i class="fas fa-flask"></i></div>
                    <h4>Laboratory Management</h4>
                    <p>Lab employees process test requests, record results, and attach reports to patient records — creating a seamless diagnostic chain.</p>
                </div>
            </div>

            {{-- 5 --}}
            <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="feature-card">
                    <div class="feature-icon-wrap"><i class="fas fa-x-ray"></i></div>
                    <h4>Radiology &amp; X-Ray</h4>
                    <p>Radiology staff manage imaging requests and attach scan results directly to invoices and patient records for instant physician access.</p>
                </div>
            </div>

            {{-- 6 --}}
            <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.15s">
                <div class="feature-card">
                    <div class="feature-icon-wrap"><i class="fas fa-file-invoice-dollar"></i></div>
                    <h4>Billing &amp; Invoicing</h4>
                    <p>Generate single-service and grouped invoices, track payment and receipt accounts, and produce printable financial summaries on demand.</p>
                </div>
            </div>

            {{-- 7 --}}
            <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.05s">
                <div class="feature-card">
                    <div class="feature-icon-wrap"><i class="fas fa-shield-alt"></i></div>
                    <h4>Insurance Management</h4>
                    <p>Register insurance providers, link them to patient profiles, and automatically apply coverage rules during invoice generation.</p>
                </div>
            </div>

            {{-- 8 --}}
            <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="feature-card">
                    <div class="feature-icon-wrap"><i class="fas fa-comments"></i></div>
                    <h4>Real-Time Messaging</h4>
                    <p>Secure, instant chat between doctors and patients via Laravel Echo &amp; Pusher — no third-party apps, no lost context, full history preserved.</p>
                </div>
            </div>

            {{-- 9 --}}
            <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.15s">
                <div class="feature-card">
                    <div class="feature-icon-wrap"><i class="fas fa-ambulance"></i></div>
                    <h4>Ambulance Services</h4>
                    <p>Track and manage the hospital's ambulance fleet — dispatch records, availability status, and maintenance logs all in one place.</p>
                </div>
            </div>

            {{-- 10 --}}
            <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.05s">
                <div class="feature-card">
                    <div class="feature-icon-wrap"><i class="fas fa-hospital-alt"></i></div>
                    <h4>Department Management</h4>
                    <p>Configure hospital sections, assign specialist doctors, and control which services are offered per department — fully multi-lingual.</p>
                </div>
            </div>

            {{-- 11 --}}
            <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="feature-card">
                    <div class="feature-icon-wrap"><i class="fas fa-chart-line"></i></div>
                    <h4>Financial Accounts</h4>
                    <p>Dual-entry fund tracking across payment and receipt accounts gives administrators a real-time view of the hospital's financial health.</p>
                </div>
            </div>

            {{-- 12 --}}
            <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.15s">
                <div class="feature-card">
                    <div class="feature-icon-wrap"><i class="fas fa-users-cog"></i></div>
                    <h4>Multi-Role Access</h4>
                    <p>Five distinct dashboards — Admin, Doctor, Patient, Lab Staff, and Radiology Staff — each with role-scoped permissions and workflows.</p>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- Wave divider --}}
<div class="wave-divider" style="background:var(--light-bg);">
    <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,0 C480,60 960,0 1440,60 L1440,0 Z" fill="white"/>
    </svg>
</div>


{{-- ============================================================
     SECTION 3 · STATS
     ============================================================ --}}
<section class="lp-stats section-pad-sm" id="stats">
    <div class="container">
        <div class="row text-center">

            <div class="col-lg-3 col-md-6">
                <div class="stat-counter-card wow fadeInUp" data-wow-delay="0s">
                    <div class="stat-icon"><i class="fas fa-user-injured"></i></div>
                    <span class="stat-number" data-count="5000" data-suffix="+">0+</span>
                    <span class="stat-label">Patients Managed</span>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stat-counter-card wow fadeInUp" data-wow-delay="0.1s">
                    <div class="stat-icon"><i class="fas fa-user-md"></i></div>
                    <span class="stat-number" data-count="120" data-suffix="+">0+</span>
                    <span class="stat-label">Specialist Doctors</span>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stat-counter-card wow fadeInUp" data-wow-delay="0.2s">
                    <div class="stat-icon"><i class="fas fa-hospital-alt"></i></div>
                    <span class="stat-number" data-count="24" data-suffix="">0</span>
                    <span class="stat-label">Active Departments</span>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="stat-counter-card wow fadeInUp" data-wow-delay="0.3s">
                    <div class="stat-icon"><i class="fas fa-calendar-check"></i></div>
                    <span class="stat-number" data-count="15000" data-suffix="+">0+</span>
                    <span class="stat-label">Appointments Booked</span>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- Wave divider --}}
<div class="wave-divider" style="background:var(--gradient);">
    <svg viewBox="0 0 1440 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,60 C480,0 960,60 1440,0 L1440,60 Z" fill="white"/>
    </svg>
</div>


{{-- ============================================================
     SECTION 4 · HOW IT WORKS
     ============================================================ --}}
<section class="lp-how section-pad" id="how-it-works">
    <div class="container">

        <div class="text-center mb-5">
            <div class="sec-eyebrow"><i class="fas fa-route"></i> The Workflow</div>
            <h2 class="sec-title">How <span>MediCore HMS</span> Works</h2>
            <p class="sec-subtitle">
                Three clearly defined roles — each with their own streamlined workflow —
                working together seamlessly on a single platform.
            </p>
        </div>

        <div class="row justify-content-center">

            {{-- Step 1: Admin --}}
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <div class="step-card wow fadeInUp" data-wow-delay="0.05s">
                    <div class="step-connector"></div>
                    <div class="step-number">1</div>
                    <div class="step-role-tag">Administrator</div>
                    <div class="step-icon"><i class="fas fa-cogs"></i></div>
                    <h4>Configure &amp; Onboard</h4>
                    <p>The admin sets up hospital departments, registers doctors and support staff, configures medical services, insurance providers, and ambulance resources. The entire system operates from this control center.</p>
                </div>
            </div>

            {{-- Step 2: Patient --}}
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <div class="step-card wow fadeInUp" data-wow-delay="0.15s">
                    <div class="step-connector"></div>
                    <div class="step-number">2</div>
                    <div class="step-role-tag">Patient</div>
                    <div class="step-icon"><i class="fas fa-calendar-plus"></i></div>
                    <h4>Register &amp; Book</h4>
                    <p>Patients create an account, browse available doctors and departments, and request appointments online. They receive SMS and email confirmations and can chat directly with their assigned physician.</p>
                </div>
            </div>

            {{-- Step 3: Doctor / Clinical Staff --}}
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <div class="step-card wow fadeInUp" data-wow-delay="0.25s">
                    <div class="step-number">3</div>
                    <div class="step-role-tag">Doctor &amp; Clinical Staff</div>
                    <div class="step-icon"><i class="fas fa-stethoscope"></i></div>
                    <h4>Diagnose &amp; Document</h4>
                    <p>Doctors review appointments, record diagnoses, and order lab or imaging tests. Lab and radiology staff process results and attach them to the patient record, while billing is generated automatically.</p>
                </div>
            </div>

        </div>

    </div>
</section>


{{-- Subtle divider --}}
<div style="background:var(--light-bg);height:1px;"></div>


{{-- ============================================================
     SECTION 5 · TESTIMONIALS
     ============================================================ --}}
<section class="lp-testimonials section-pad">
    <div class="container">

        <div class="text-center mb-5">
            <div class="sec-eyebrow"><i class="fas fa-quote-left"></i> Testimonials</div>
            <h2 class="sec-title">Trusted by the <span>People Inside the Hospital</span></h2>
            <p class="sec-subtitle">
                From surgeons to administrators — here is what the people using
                MediCore HMS every day have to say.
            </p>
        </div>

        <div class="row">

            {{-- Testimonial 1 --}}
            <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.05s">
                <div class="testimonial-card">
                    <span class="testimonial-quote-mark">&ldquo;</span>
                    <div class="testimonial-stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">
                        "Before MediCore, tracking lab orders and diagnostic results meant endless
                        phone calls and paper printouts. Now everything lands in the patient record
                        automatically. I spend more time with patients and less time chasing paperwork."
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar av-1">NR</div>
                        <div>
                            <p class="author-name">Dr. Nadia Al-Rashid</p>
                            <p class="author-role">Senior Cardiologist</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Testimonial 2 --}}
            <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.15s">
                <div class="testimonial-card">
                    <span class="testimonial-quote-mark">&ldquo;</span>
                    <div class="testimonial-stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">
                        "Managing five departments, dozens of doctors, and real-time billing used to
                        require a team of five. With the admin dashboard, one administrator can oversee
                        the entire operation — from insurance claims to ambulance dispatch — in a
                        single view."
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar av-2">KM</div>
                        <div>
                            <p class="author-name">Khalid Al-Mansoori</p>
                            <p class="author-role">Hospital Administrator</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Testimonial 3 --}}
            <div class="col-lg-4 col-md-6 mb-4 wow fadeInUp" data-wow-delay="0.25s">
                <div class="testimonial-card">
                    <span class="testimonial-quote-mark">&ldquo;</span>
                    <div class="testimonial-stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="testimonial-text">
                        "I booked my first appointment in under two minutes and received an SMS
                        confirmation straight away. When I needed follow-up, I just messaged my
                        doctor directly through the app. This is exactly how healthcare should feel."
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar av-3">SC</div>
                        <div>
                            <p class="author-name">Sara Chaudhary</p>
                            <p class="author-role">Patient — General Medicine</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- ============================================================
     SECTION 6 · CALL TO ACTION
     ============================================================ --}}
<section class="lp-cta section-pad">
    <div class="container">
        <div class="cta-inner">

            {{-- Decorative medical SVG --}}
            <div style="margin-bottom:24px;">
                <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="64" height="64" rx="16" fill="rgba(255,255,255,0.15)"/>
                    <path d="M32 18v28M18 32h28" stroke="white" stroke-width="4" stroke-linecap="round"/>
                    <circle cx="32" cy="32" r="14" stroke="rgba(255,255,255,0.4)" stroke-width="2"/>
                </svg>
            </div>

            <h2 class="cta-title">
                Ready to Transform<br>Your Hospital Operations?
            </h2>
            <p class="cta-sub">
                Get your entire clinical team — doctors, lab staff, radiology, admin,
                and patients — working on one integrated platform today.
            </p>

            <div style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap;">
                <a href="{{ route('login') }}" class="btn-cta">
                    <i class="fas fa-sign-in-alt"></i> Login Now
                </a>
                <a href="{{ route('register') }}" class="btn-cta" style="background:transparent;color:white;border:2px solid rgba(255,255,255,0.45);">
                    <i class="fas fa-user-plus"></i> Create Account
                </a>
            </div>

            <p style="color:rgba(255,255,255,0.5);font-size:.82rem;margin-top:20px;">
                <i class="fas fa-lock" style="margin-right:4px;"></i>
                Secure multi-role authentication &nbsp;&middot;&nbsp;
                <i class="fas fa-bolt" style="margin-right:4px;"></i>
                Real-time updates &nbsp;&middot;&nbsp;
                <i class="fas fa-language" style="margin-right:4px;"></i>
                Arabic &amp; English support
            </p>

        </div>
    </div>
</section>

@endsection
