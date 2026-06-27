<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ App::getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>{{ trans('login_trans.meta_title') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

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
            height: 100%; margin: 0;
            font-family: 'Inter', sans-serif;
            background: var(--bg-soft); color: var(--dark);
            -webkit-font-smoothing: antialiased;
        }
        a { text-decoration: none; }

        .auth-shell { min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 32px 16px; }
        .auth-back { font-size: .85rem; font-weight: 600; color: var(--muted); margin-bottom: 22px; display: inline-flex; align-items: center; gap: 6px; }
        .auth-back:hover { color: var(--primary); }

        .auth-card { background: #fff; border-radius: 20px; padding: 40px 38px; width: 100%; max-width: 460px; box-shadow: 0 1px 3px rgba(15,23,42,.06), 0 12px 28px rgba(15,23,42,.07); }

        .brand-mark { width: 52px; height: 52px; border-radius: 12px; background: var(--primary); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 1.5rem; margin: 0 auto 18px; }
        .auth-card h1 { font-size: 1.45rem; font-weight: 800; text-align: center; margin: 0 0 6px; }
        .auth-card .sub { font-size: .88rem; color: var(--muted); text-align: center; margin: 0 0 26px; }

        .err-box { background: #fef2f2; border: 1px solid #fecaca; border-radius: 10px; padding: 12px 14px; margin-bottom: 22px; }
        .err-box p { font-size: .82rem; margin: 0; color: #b91c1c; }
        .err-box p + p { margin-top: 4px; }

        .role-pills { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 26px; }
        .role-pill {
            flex: 1 1 calc(33.333% - 6px); min-width: 84px;
            display: flex; flex-direction: column; align-items: center; gap: 5px;
            border: 1.5px solid var(--border); border-radius: 10px; padding: 10px 6px;
            background: #fff; color: var(--muted); cursor: pointer; transition: all .15s;
            font-size: .72rem; font-weight: 600;
        }
        .role-pill i { font-size: 1.05rem; }
        .role-pill:hover { border-color: var(--primary); color: var(--primary); }
        .role-pill.is-active { background: var(--primary); border-color: var(--primary); color: #fff; }

        .portal-line { display: flex; align-items: center; gap: 8px; background: var(--bg-soft); color: var(--accent); border-radius: 8px; padding: 9px 13px; font-size: .82rem; font-weight: 600; margin-bottom: 20px; }

        .field { margin-bottom: 16px; }
        .field label { display: block; font-size: .82rem; font-weight: 700; color: var(--dark); margin-bottom: 6px; }
        .field-row { display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 6px; }
        .field-row a { font-size: .78rem; font-weight: 600; color: var(--primary); }
        .field-row a:hover { color: var(--accent); }

        .input-group-mc { display: flex; align-items: stretch; border: 1.5px solid var(--border); border-radius: 8px; background: #fff; transition: border-color .15s, box-shadow .15s; overflow: hidden; }
        .input-group-mc:focus-within { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(2,132,199,.15); }
        .input-group-mc .ig-icon { display: flex; align-items: center; padding: 0 12px; color: var(--muted); background: #f8fafc; border-right: 1px solid var(--border); }
        .input-group-mc input { flex: 1; border: 0; outline: none; padding: 11px 13px; font-size: .92rem; font-family: 'Inter', sans-serif; background: transparent; color: var(--dark); }
        .input-group-mc .ig-toggle { display: flex; align-items: center; padding: 0 13px; color: var(--muted); background: #fff; border: 0; cursor: pointer; }
        .input-group-mc .ig-toggle:hover { color: var(--primary); }

        .submit-mc {
            width: 100%; border: 0; border-radius: 8px; background: var(--primary); color: #fff;
            font-weight: 700; font-size: .94rem; padding: 13px 0; margin-top: 6px; cursor: pointer;
            transition: background-color .15s;
        }
        .submit-mc:hover:not(:disabled) { background: var(--accent); }
        .submit-mc:disabled { opacity: .65; cursor: progress; }

        .auth-foot { text-align: center; margin-top: 22px; font-size: .8rem; color: var(--muted); }
    </style>
</head>

<body>

    <div class="auth-shell">

        <a href="{{ route('home') }}" class="auth-back"><i class="bi bi-arrow-left"></i> {{ trans('login_trans.back_to_home') }}</a>

        <div class="auth-card">
            <div class="brand-mark"><i class="bi bi-hospital-fill"></i></div>
            <h1>{{ trans('login_trans.welcome_title') }}</h1>
            <p class="sub">{{ trans('login_trans.welcome_sub') }}</p>

            @if ($errors->any())
            <div class="err-box">
                @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            @php
                $guards = [
                    ['key' => 'admin',                'icon' => 'bi-shield-lock-fill', 'label' => trans('login_trans.role_admin'),      'title' => trans('login_trans.title_admin')],
                    ['key' => 'doctor',               'icon' => 'bi-heart-pulse-fill', 'label' => trans('login_trans.role_doctor'),     'title' => trans('login_trans.title_doctor')],
                    ['key' => 'patient',              'icon' => 'bi-person-fill',      'label' => trans('login_trans.role_patient'),    'title' => trans('login_trans.title_patient')],
                    ['key' => 'ray_employee',         'icon' => 'bi-camera-fill',      'label' => trans('login_trans.role_radiology'),  'title' => trans('login_trans.title_radiology')],
                    ['key' => 'laboratorie_employee', 'icon' => 'bi-droplet-fill',     'label' => trans('login_trans.role_laboratory'), 'title' => trans('login_trans.title_laboratory')],
                ];
            @endphp

            <!--
                Role picked here only changes the displayed title/icon/button
                label — one single form below always posts to the same
                endpoint, and the server tries every guard in turn (see
                LoginRequest::authenticate()). There is exactly one <form> on
                this page.
            -->
            <div class="role-pills" role="tablist">
                @foreach($guards as $g)
                <button type="button" class="role-pill @if($loop->first) is-active @endif"
                        data-role="{{ $g['key'] }}" onclick="lpSelectRole('{{ $g['key'] }}')">
                    <i class="bi {{ $g['icon'] }}"></i>
                    {{ $g['label'] }}
                </button>
                @endforeach
            </div>

            <div class="portal-line" id="portal-line">
                <i class="bi {{ $guards[0]['icon'] }}"></i>
                <span id="portal-line-text">{{ trans('login_trans.signing_in_as', ['title' => $guards[0]['title']]) }}</span>
            </div>

            <form method="POST" action="{{ route('login.user') }}" autocomplete="on">
                @csrf

                <div class="field">
                    <label for="email">{{ trans('login_trans.email_label') }}</label>
                    <div class="input-group-mc">
                        <span class="ig-icon"><i class="bi bi-envelope-fill"></i></span>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="you@medicore.test"
                            required
                            autofocus
                        >
                    </div>
                </div>

                <div class="field">
                    <div class="field-row">
                        <label for="password" style="margin:0;">{{ trans('login_trans.password_label') }}</label>
                        <a href="{{ route('password.request') }}">{{ trans('login_trans.forgot_password') }}</a>
                    </div>
                    <div class="input-group-mc">
                        <span class="ig-icon"><i class="bi bi-lock-fill"></i></span>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="••••••••"
                            autocomplete="current-password"
                            required
                        >
                        <button type="button" class="ig-toggle" onclick="lpTogglePw('password', this)">
                            <i class="bi bi-eye-fill"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="submit-mc" id="submit-btn">
                    {{ trans('login_trans.sign_in_as', ['label' => $guards[0]['label']]) }}
                </button>
            </form>
        </div>

        <p class="auth-foot">{{ trans('login_trans.footer_copyright', ['year' => date('Y')]) }}</p>
    </div>

    <script>
    (function () {
        'use strict';

        var signingInText = @json(trans('login_trans.signing_in_progress'));
        var signingInAsTemplate = @json(trans('login_trans.signing_in_as', ['title' => '__TITLE__']));
        var signInAsTemplate = @json(trans('login_trans.sign_in_as', ['label' => '__LABEL__']));
        var roles = @json(collect($guards)->keyBy('key'));

        function selectRole(key) {
            var role = roles[key];
            if (!role) return;

            document.querySelectorAll('.role-pill').forEach(function (btn) {
                btn.classList.toggle('is-active', btn.dataset.role === key);
            });

            var line = document.getElementById('portal-line');
            var lineText = document.getElementById('portal-line-text');
            if (line) line.querySelector('i').className = 'bi ' + role.icon;
            if (lineText) lineText.textContent = signingInAsTemplate.replace('__TITLE__', role.title);

            var submitBtn = document.getElementById('submit-btn');
            if (submitBtn) submitBtn.textContent = signInAsTemplate.replace('__LABEL__', role.label);

            sessionStorage.setItem('hms_last_role', key);
        }

        function togglePw(inputId, btn) {
            var input = document.getElementById(inputId);
            if (!input) return;
            var reveal = input.type === 'password';
            input.type = reveal ? 'text' : 'password';
            btn.innerHTML = reveal ? '<i class="bi bi-eye-slash-fill"></i>' : '<i class="bi bi-eye-fill"></i>';
        }

        var loginForm = document.querySelector('.auth-card form');
        if (loginForm) {
            loginForm.addEventListener('submit', function () {
                var btn = document.getElementById('submit-btn');
                if (!btn) return;
                btn.disabled = true;
                btn.textContent = signingInText;
            });
        }

        window.lpSelectRole = selectRole;
        window.lpTogglePw = togglePw;

        var lastRole = sessionStorage.getItem('hms_last_role');
        if (lastRole && roles[lastRole]) {
            selectRole(lastRole);
        }
    }());
    </script>

</body>

</html>
