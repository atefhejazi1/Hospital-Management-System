@extends('Dashboard.layouts.master2')

@section('css')
@vite('resources/css/app.css')
<style>
    html, body { height: 100% !important; }
    body.main-body { background: transparent !important; padding: 0 !important; }
    #global-loader { display: none !important; }

    /* ── Inputs ─────────────────────────────────────────────── */
    .lp-input {
        transition: border-color 0.15s, box-shadow 0.15s, background-color 0.15s;
    }
    .lp-input:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(1, 98, 232, 0.14);
        border-color: #0162e8 !important;
        background: #fff !important;
    }

    /* ── Role cards ─────────────────────────────────────────── */
    .role-card {
        transition: all 0.22s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .role-card:hover:not(.r-active) {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.09) !important;
        border-color: #cbd5e1 !important;
    }

    /* ── Form panel slide-in ─────────────────────────────────── */
    .form-panel {
        animation: fpSlide 0.28s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    }
    @keyframes fpSlide {
        from { opacity: 0; transform: translateY(14px) scale(0.98); }
        to   { opacity: 1; transform: translateY(0)    scale(1);    }
    }

    /* ── Submit button ───────────────────────────────────────── */
    .submit-btn {
        transition: transform 0.15s, filter 0.15s, box-shadow 0.15s;
    }
    .submit-btn:hover  { transform: translateY(-1px); filter: brightness(1.06); }
    .submit-btn:active { transform: translateY(0);    filter: brightness(0.97); }

    /* ── Password toggle ─────────────────────────────────────── */
    .pw-toggle {
        cursor: pointer; background: none; border: none; padding: 0;
        color: #94a3b8; transition: color 0.15s; line-height: 1;
    }
    .pw-toggle:hover { color: #475569; }

    /* ── Left panel extras ───────────────────────────────────── */
    .dot-grid {
        position: absolute; inset: 0; pointer-events: none;
        background-image: radial-gradient(circle, rgba(255,255,255,0.09) 1.5px, transparent 1.5px);
        background-size: 28px 28px;
    }
    .blob { border-radius: 50%; position: absolute; pointer-events: none; }
    .blob-a { animation: blobFloat  9s ease-in-out infinite; }
    .blob-b { animation: blobFloat 12s ease-in-out 2.5s infinite; }
    @keyframes blobFloat {
        0%, 100% { transform: translate(0, 0)      scale(1);    }
        50%       { transform: translate(8px,-14px) scale(1.06); }
    }

    /* ── ECG heartbeat ───────────────────────────────────────── */
    .ecg-track {
        stroke-dasharray: 3200;
        stroke-dashoffset: 3200;
        animation: ecgDraw 4.5s linear infinite;
    }
    @keyframes ecgDraw {
        0%   { stroke-dashoffset: 3200; }
        75%  { stroke-dashoffset: 0; }
        100% { stroke-dashoffset: 0; }
    }

    /* ── Form card (white card on light-gray right panel) ────── */
    .form-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 2.25rem 2.5rem;
        box-shadow: 0 4px 32px rgba(0,0,0,0.07), 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #eef2f7;
    }

    /* ── Placeholder dashed box ──────────────────────────────── */
    .ph-box {
        border: 1.5px dashed #e2e8f0;
        border-radius: 16px;
        background: #fafbfc;
    }

    /* ── Back-to-home pill ───────────────────────────────────── */
    .back-pill {
        transition: border-color 0.15s, color 0.15s, background-color 0.15s;
    }
    .back-pill:hover {
        border-color: #94a3b8 !important;
        color: #1e293b !important;
        background: #f1f5f9 !important;
    }

    /* ── Mobile adjustments ──────────────────────────────────── */
    @media (max-width: 640px) {
        .form-card { padding: 1.5rem 1.25rem; border-radius: 16px; }
    }
</style>
@endsection


@section('content')
<div class="min-h-screen flex" style="font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;">

    {{-- ══════════════════════════════════════════════════════════
         LEFT PANEL — Branding
    ══════════════════════════════════════════════════════════ --}}
    <div class="hidden lg:flex lg:w-[57%] flex-col relative overflow-hidden"
         style="background: linear-gradient(148deg, #0162e8 0%, #0246b0 52%, #031b4e 100%);">

        {{-- Dot grid texture --}}
        <div class="dot-grid"></div>

        {{-- Blobs --}}
        <div class="blob blob-a" style="width:380px;height:380px;top:-100px;right:-80px;background:rgba(255,255,255,0.07);"></div>
        <div class="blob blob-b" style="width:260px;height:260px;bottom:120px;left:-80px;background:rgba(255,255,255,0.06);"></div>
        <div class="blob"       style="width:180px;height:180px;top:42%;right:40px;background:rgba(100,180,255,0.07);"></div>

        {{-- Logo --}}
        <div class="relative z-10 px-12 pt-10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                     style="background:rgba(255,255,255,0.14);border:1px solid rgba(255,255,255,0.24);">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m-8-8h16"/>
                    </svg>
                </div>
                <div>
                    <span class="text-white font-bold text-lg tracking-tight leading-none block">MediCore HMS</span>
                    <span class="text-xs font-medium" style="color:rgba(160,205,255,0.8);">Hospital Management System</span>
                </div>
            </div>
        </div>

        {{-- Hero copy --}}
        <div class="relative z-10 px-12 mt-14 flex-1">

            {{-- Live badge --}}
            <div class="inline-flex items-center gap-2 rounded-full px-3.5 py-1.5 mb-6"
                 style="background:rgba(255,255,255,0.10);border:1px solid rgba(255,255,255,0.18);">
                <span class="w-2 h-2 rounded-full" style="background:#4ade80;box-shadow:0 0 6px #4ade80;"></span>
                <span class="text-xs font-medium text-white">All systems operational</span>
            </div>

            <h1 class="text-white font-extrabold leading-tight m-0"
                style="font-size:clamp(1.75rem,2.5vw,2.45rem);letter-spacing:-0.5px;">
                Modern Healthcare,<br>Intelligently Managed.
            </h1>
            <p class="mt-4 text-sm leading-relaxed m-0"
               style="color:rgba(200,220,255,0.80);max-width:390px;">
                A unified platform connecting doctors, patients, labs, and
                administrators — streamlining every step of the care journey
                from a single, secure interface.
            </p>

            {{-- Feature bullets --}}
            <ul class="mt-10 space-y-4 list-none p-0 m-0">
                @foreach([
                    ['icon'=>'fas fa-calendar-check',     'text'=>'Smart appointment scheduling with SMS alerts'],
                    ['icon'=>'fas fa-flask',               'text'=>'Integrated laboratory & radiology management'],
                    ['icon'=>'fas fa-file-invoice-dollar', 'text'=>'Automated billing, invoicing & insurance'],
                    ['icon'=>'fas fa-comments',            'text'=>'Real-time secure doctor–patient messaging'],
                ] as $f)
                <li class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0"
                         style="background:rgba(255,255,255,0.10);border:1px solid rgba(255,255,255,0.14);">
                        <i class="{{ $f['icon'] }} text-sm" style="color:rgba(160,210,255,0.90);"></i>
                    </div>
                    <span class="text-sm" style="color:rgba(200,225,255,0.82);">{{ $f['text'] }}</span>
                </li>
                @endforeach
            </ul>
        </div>

        {{-- Stat strip --}}
        <div class="relative z-10 px-12">
            <div class="pt-7" style="border-top:1px solid rgba(255,255,255,0.10);">
                <div class="grid grid-cols-3 gap-4 mb-6">
                    @foreach([
                        ['n'=>'5,000+','l'=>'Patients Served',   'icon'=>'fas fa-user-injured'],
                        ['n'=>'120+',  'l'=>'Specialist Doctors','icon'=>'fas fa-user-md'],
                        ['n'=>'99.9%', 'l'=>'System Uptime',     'icon'=>'fas fa-server'],
                    ] as $s)
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0"
                             style="background:rgba(255,255,255,0.08);">
                            <i class="{{ $s['icon'] }} text-xs" style="color:rgba(160,210,255,0.80);"></i>
                        </div>
                        <div>
                            <p class="text-xl font-extrabold text-white m-0 leading-none">{{ $s['n'] }}</p>
                            <p class="text-xs mt-0.5 m-0 leading-tight" style="color:rgba(155,200,255,0.70);">{{ $s['l'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ECG heartbeat animation --}}
        <div class="relative z-10 overflow-hidden" style="height:60px;">
            <svg viewBox="0 0 600 60" fill="none" xmlns="http://www.w3.org/2000/svg"
                 preserveAspectRatio="xMidYMid meet" style="width:100%;height:100%;">
                {{-- Faint guide --}}
                <path d="M-10,30 L55,30 L66,25 L73,30 L76,34 L83,3 L88,48 L93,30 L103,22 L113,30
                         L175,30 L240,30 L251,25 L258,30 L261,34 L268,3 L273,48 L278,30 L288,22 L298,30
                         L360,30 L425,30 L436,25 L443,30 L446,34 L453,3 L458,48 L463,30 L473,22 L483,30 L610,30"
                      stroke="rgba(255,255,255,0.13)" stroke-width="1.5" fill="none"
                      stroke-linecap="round" stroke-linejoin="round"/>
                {{-- Animated draw --}}
                <path class="ecg-track"
                      d="M-10,30 L55,30 L66,25 L73,30 L76,34 L83,3 L88,48 L93,30 L103,22 L113,30
                         L175,30 L240,30 L251,25 L258,30 L261,34 L268,3 L273,48 L278,30 L288,22 L298,30
                         L360,30 L425,30 L436,25 L443,30 L446,34 L453,3 L458,48 L463,30 L473,22 L483,30 L610,30"
                      stroke="rgba(96,210,255,0.75)" stroke-width="2" fill="none"
                      stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
    </div>


    {{-- ══════════════════════════════════════════════════════════
         RIGHT PANEL — Login Form
    ══════════════════════════════════════════════════════════ --}}
    <div class="flex-1 flex flex-col" style="background:#f0f4f9;">

        {{-- Top bar --}}
        <div class="flex items-center justify-between px-8 py-5 lg:px-10">
            {{-- Mobile logo --}}
            <div class="flex items-center gap-2 lg:hidden">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#0162e8;">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m-8-8h16"/>
                    </svg>
                </div>
                <span class="font-bold text-sm" style="color:#0f172a;">MediCore HMS</span>
            </div>
            <div class="hidden lg:block"></div>

            {{-- Back link --}}
            <a href="{{ url('/') }}"
               class="back-pill flex items-center gap-1.5 text-sm no-underline rounded-lg px-3 py-1.5"
               style="color:#64748b;background:#ffffff;border:1px solid #e2e8f0;">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to home
            </a>
        </div>

        {{-- Form area --}}
        <div class="flex-1 flex items-center justify-center px-5 py-6 lg:px-10">
            <div class="form-card w-full" style="max-width:448px;">

                {{-- Heading block --}}
                <div class="mb-7">
                    <div class="flex items-center gap-2.5 mb-4">
                        <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                             style="background:#eff6ff;border:1px solid #dbeafe;">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 style="color:#0162e8;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m-8-8h16"/>
                            </svg>
                        </div>
                        <span class="text-xs font-bold uppercase tracking-widest" style="color:#0162e8;letter-spacing:0.1em;">
                            MediCore HMS
                        </span>
                    </div>
                    <h2 class="font-extrabold m-0 leading-tight" style="font-size:1.6rem;color:#0f172a;letter-spacing:-0.4px;">
                        Welcome back
                    </h2>
                    <p class="text-sm mt-1.5 m-0" style="color:#64748b;">
                        Select your role and sign in to continue.
                    </p>
                </div>

                {{-- Error messages --}}
                @if ($errors->any())
                <div class="mb-5 rounded-xl p-4" style="background:#fef2f2;border:1px solid #fecaca;">
                    <div class="flex items-start gap-2.5">
                        <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             style="color:#ef4444;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <ul class="list-none p-0 m-0 space-y-0.5">
                            @foreach ($errors->all() as $error)
                            <li class="text-sm" style="color:#b91c1c;">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                {{-- ── Role selector ── --}}
                @php
                $roleCards = [
                    ['key'=>'admin',                'label'=>'Admin',  'desc'=>'System',    'icon'=>'fas fa-shield-alt',   'color'=>'#6366f1','bg'=>'#eef2ff'],
                    ['key'=>'doctor',               'label'=>'Doctor', 'desc'=>'Clinical',  'icon'=>'fas fa-user-md',      'color'=>'#0162e8','bg'=>'#eff6ff'],
                    ['key'=>'patient',              'label'=>'Patient','desc'=>'Health',    'icon'=>'fas fa-user-injured', 'color'=>'#10b981','bg'=>'#f0fdf4'],
                    ['key'=>'ray_employee',         'label'=>'X-Ray',  'desc'=>'Radiology', 'icon'=>'fas fa-radiation-alt','color'=>'#8b5cf6','bg'=>'#f5f3ff'],
                    ['key'=>'laboratorie_employee', 'label'=>'Lab',    'desc'=>'Analysis',  'icon'=>'fas fa-flask',        'color'=>'#f59e0b','bg'=>'#fffbeb'],
                ];
                @endphp

                <div class="mb-5">
                    <label class="block text-xs font-bold uppercase tracking-widest mb-3"
                           style="color:#94a3b8;letter-spacing:0.08em;">Select your role</label>

                    <div class="grid grid-cols-5 gap-2">
                        @foreach($roleCards as $rc)
                        <button type="button"
                            id="role-btn-{{ $rc['key'] }}"
                            data-role="{{ $rc['key'] }}"
                            data-color="{{ $rc['color'] }}"
                            data-bg="{{ $rc['bg'] }}"
                            onclick="selectRole('{{ $rc['key'] }}')"
                            class="role-card flex flex-col items-center gap-2 rounded-2xl py-3.5 px-1 border-2 cursor-pointer"
                            style="background:#ffffff;border-color:#e8edf2;">
                            <div class="role-icon-wrap w-10 h-10 rounded-xl flex items-center justify-center"
                                 style="background:#f1f5f9;transition:background 0.2s,box-shadow 0.2s;">
                                <i class="{{ $rc['icon'] }} text-sm" style="color:#94a3b8;transition:color 0.2s;"></i>
                            </div>
                            <div class="text-center">
                                <p class="role-label text-xs font-bold m-0 leading-none" style="color:#475569;">
                                    {{ $rc['label'] }}
                                </p>
                                <p class="text-center m-0 mt-0.5 leading-tight" style="font-size:9px;color:#94a3b8;">
                                    {{ $rc['desc'] }}
                                </p>
                            </div>
                        </button>
                        @endforeach
                    </div>
                </div>

                {{-- No-role placeholder --}}
                <div id="no-role-placeholder" class="ph-box text-center py-8 px-4">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center mx-auto mb-3"
                         style="background:#f1f5f9;">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             style="color:#c8d4e0;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <p class="text-sm font-semibold m-0" style="color:#94a3b8;">Select a role above to continue</p>
                    <p class="m-0 mt-1" style="font-size:11px;color:#b8c4d0;">Your session will be secured automatically</p>
                </div>

                {{-- ── Login forms (one per role) ── --}}
                @php
                $forms = [
                    ['key'=>'admin',                'action'=>route('login.admin'),                'title'=>'Admin Portal',    'color'=>'#6366f1','bg'=>'#eef2ff'],
                    ['key'=>'doctor',               'action'=>route('login.doctor'),               'title'=>'Doctor Portal',   'color'=>'#0162e8','bg'=>'#eff6ff'],
                    ['key'=>'patient',              'action'=>route('login.patient'),              'title'=>'Patient Portal',  'color'=>'#10b981','bg'=>'#f0fdf4'],
                    ['key'=>'ray_employee',         'action'=>route('login.ray_employee'),         'title'=>'Radiology Portal','color'=>'#8b5cf6','bg'=>'#f5f3ff'],
                    ['key'=>'laboratorie_employee', 'action'=>route('login.laboratorie_employee'),'title'=>'Lab Portal',      'color'=>'#f59e0b','bg'=>'#fffbeb'],
                ];
                @endphp

                @foreach($forms as $frm)
                <div id="form-{{ $frm['key'] }}" class="form-panel" style="display:none;">

                    {{-- Role accent bar --}}
                    <div class="rounded-full mb-5" style="height:3px;background:{{ $frm['color'] }};opacity:0.25;"></div>

                    <form method="POST" action="{{ $frm['action'] }}" class="space-y-4">
                        @csrf

                        {{-- Portal badge --}}
                        <div class="flex items-center gap-2 rounded-xl px-3 py-2.5 mb-2"
                             style="background:{{ $frm['bg'] }};">
                            <div class="w-2 h-2 rounded-full flex-shrink-0" style="background:{{ $frm['color'] }};"></div>
                            <span class="text-xs font-semibold" style="color:{{ $frm['color'] }};">
                                Signing in &mdash; {{ $frm['title'] }}
                            </span>
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-sm font-semibold mb-1.5" style="color:#334155;">
                                Email address
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                         style="color:#94a3b8;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </span>
                                <input type="email" name="email" required autofocus
                                    value="{{ old('email') }}"
                                    placeholder="you@hospital.com"
                                    class="lp-input w-full text-sm rounded-xl"
                                    style="padding:11px 14px 11px 40px;border:1.5px solid #e2e8f0;background:#f8fafc;color:#1e293b;">
                            </div>
                        </div>

                        {{-- Password + toggle --}}
                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label class="block text-sm font-semibold" style="color:#334155;">
                                    Password
                                </label>
                                <a href="{{ route('password.request') }}"
                                   class="text-xs no-underline font-semibold"
                                   style="color:{{ $frm['color'] }};">
                                    Forgot password?
                                </a>
                            </div>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                         style="color:#94a3b8;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </span>
                                <input type="password" id="pw-{{ $frm['key'] }}" name="password" required
                                    autocomplete="current-password"
                                    placeholder="Enter your password"
                                    class="lp-input w-full text-sm rounded-xl"
                                    style="padding:11px 42px 11px 40px;border:1.5px solid #e2e8f0;background:#f8fafc;color:#1e293b;">
                                {{-- Show / hide toggle --}}
                                <button type="button"
                                    class="pw-toggle absolute inset-y-0 right-0 flex items-center pr-3"
                                    onclick="togglePw('pw-{{ $frm['key'] }}',this)"
                                    tabindex="-1" aria-label="Toggle password visibility">
                                    {{-- Eye-slash (default — password hidden) --}}
                                    <svg class="pw-icon-off w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                    </svg>
                                    {{-- Eye (password visible) --}}
                                    <svg class="pw-icon-on w-4 h-4" style="display:none;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <button type="submit"
                            class="submit-btn w-full py-3 px-6 rounded-xl text-white text-sm font-bold
                                   flex items-center justify-center gap-2 focus:outline-none mt-1"
                            style="background:{{ $frm['color'] }};box-shadow:0 4px 18px rgba(0,0,0,0.15);">
                            Sign in to {{ $frm['title'] }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </button>
                    </form>
                </div>
                @endforeach

            </div>
        </div>

        {{-- Footer --}}
        <div class="px-8 py-4 lg:px-12" style="border-top:1px solid #e8edf2;">
            <div class="flex items-center justify-between" style="max-width:448px;margin:0 auto;">
                <p class="text-xs m-0" style="color:#94a3b8;">&copy; {{ date('Y') }} MediCore HMS</p>
                <div class="flex items-center gap-1.5">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:#10b981;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <span style="font-size:11px;color:#64748b;">Secure, encrypted connection</span>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection


@section('js')
<script>
(function () {
    'use strict';

    function hexToRgba(hex, a) {
        var r = parseInt(hex.slice(1,3),16),
            g = parseInt(hex.slice(3,5),16),
            b = parseInt(hex.slice(5,7),16);
        return 'rgba('+r+','+g+','+b+','+a+')';
    }

    function selectRole(key) {
        // Reset all cards to default state
        document.querySelectorAll('.role-card').forEach(function(btn) {
            btn.classList.remove('r-active');
            btn.style.background   = '#ffffff';
            btn.style.borderColor  = '#e8edf2';
            btn.style.boxShadow    = '';
            btn.style.transform    = '';
            var wrap = btn.querySelector('.role-icon-wrap');
            if (wrap) {
                wrap.style.background = '#f1f5f9';
                wrap.style.boxShadow  = '';
                var ico = wrap.querySelector('i');
                if (ico) ico.style.color = '#94a3b8';
            }
            var lbl = btn.querySelector('.role-label');
            if (lbl) lbl.style.color = '#475569';
        });

        // Activate the chosen card with its role-specific colour
        var active = document.getElementById('role-btn-' + key);
        if (active) {
            var color = active.dataset.color;
            var bg    = active.dataset.bg;
            active.classList.add('r-active');
            active.style.background  = bg;
            active.style.borderColor = color;
            active.style.boxShadow   = '0 6px 20px ' + hexToRgba(color, 0.22);
            active.style.transform   = 'translateY(-3px)';
            var wrap = active.querySelector('.role-icon-wrap');
            if (wrap) {
                wrap.style.background = '#ffffff';
                wrap.style.boxShadow  = '0 2px 10px ' + hexToRgba(color, 0.22);
                var ico = wrap.querySelector('i');
                if (ico) ico.style.color = color;
            }
            var lbl = active.querySelector('.role-label');
            if (lbl) lbl.style.color = '#0f172a';
        }

        // Hide the placeholder
        var ph = document.getElementById('no-role-placeholder');
        if (ph) ph.style.display = 'none';

        // Swap visible form panel with animation
        document.querySelectorAll('.form-panel').forEach(function(p) { p.style.display = 'none'; });
        var target = document.getElementById('form-' + key);
        if (target) {
            target.style.display = 'block';
            target.classList.remove('form-panel');
            void target.offsetWidth; // force reflow to re-trigger CSS animation
            target.classList.add('form-panel');
            // Auto-focus email field for faster login
            var em = target.querySelector('input[type="email"]');
            if (em) setTimeout(function() { em.focus(); }, 40);
        }
    }

    function togglePw(inputId, btn) {
        var inp = document.getElementById(inputId);
        if (!inp) return;
        var reveal = inp.type === 'password';
        inp.type = reveal ? 'text' : 'password';
        var off = btn.querySelector('.pw-icon-off');
        var on  = btn.querySelector('.pw-icon-on');
        if (off) off.style.display = reveal ? 'none' : '';
        if (on)  on.style.display  = reveal ? ''     : 'none';
    }

    window.selectRole = selectRole;
    window.togglePw   = togglePw;

    // Restore the last-chosen role after a validation-error redirect
    @if ($errors->any() && old('_token'))
    document.addEventListener('DOMContentLoaded', function () {
        var last = sessionStorage.getItem('hms_last_role');
        if (last) selectRole(last);
    });
    @endif

    // Persist the role choice across the POST/redirect cycle
    document.querySelectorAll('.role-card').forEach(function(btn) {
        btn.addEventListener('click', function () {
            sessionStorage.setItem('hms_last_role', btn.dataset.role);
        });
    });
}());
</script>
@endsection
