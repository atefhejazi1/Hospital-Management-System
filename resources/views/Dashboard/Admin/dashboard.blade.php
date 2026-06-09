@extends('Dashboard.layouts.master')

@section('css')
@vite('resources/css/app.css')
<style>
    /* ── Scoped overrides: keep Bootstrap's existing sidebar/header intact;
       these rules only affect the new Tailwind content area ── */

    /* Ensure Tailwind card text doesn't inherit Bootstrap's h4/p resets */
    .tw-card h4, .tw-card p { margin: 0; }
    .tw-card * { box-sizing: border-box; }

    /* Table hover row */
    .appt-row:hover { background: #f8fafc; }

    /* Timeline connector line */
    .tl-connector {
        position: absolute;
        left: 19px; top: 40px;
        width: 2px;
        bottom: 0;
        background: #e2e8f0;
    }

    /* Stat card micro-sparkline (pure CSS, no library) */
    .spark { display: flex; align-items: flex-end; gap: 2px; height: 28px; }
    .spark-bar { width: 4px; border-radius: 2px 2px 0 0; background: currentColor; opacity: 0.35; }
    .spark-bar.hi { opacity: 0.85; }

    /* Department bar transition */
    .dept-bar { transition: width 0.8s cubic-bezier(0.22, 1, 0.36, 1); }
</style>
@endsection


{{-- ── Page header replaces the old Bootstrap breadcrumb ── --}}
@section('page-header')
@php
    $today = \Carbon\Carbon::now();
@endphp
<div class="tw-card flex flex-wrap items-center justify-between gap-4 mb-6 mt-2">
    {{-- Greeting --}}
    <div>
        <h2 class="text-2xl font-extrabold leading-tight"
            style="color: #0f172a; font-family: 'Segoe UI', system-ui, sans-serif; letter-spacing: -0.3px;">
            Good morning, Admin
            <span class="text-2xl" style="font-weight: 400;">👋</span>
        </h2>
        <p class="text-sm mt-1" style="color: #64748b; font-family: 'Segoe UI', system-ui, sans-serif;">
            {{ $today->format('l, F j, Y') }} &nbsp;&middot;&nbsp; Here's what's happening today.
        </p>
    </div>

    {{-- Quick actions --}}
    <div class="flex items-center gap-2 flex-wrap">
        <a href="{{ url('Doctors/create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold text-white no-underline transition-all hover:opacity-90"
           style="background: #0162e8; box-shadow: 0 3px 10px rgba(1,98,232,0.28);">
            <i class="fas fa-plus text-xs"></i> Add Doctor
        </a>
        <a href="{{ url('Patients/create') }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold no-underline transition-all"
           style="color: #0162e8; background: #e8f0fe; border: 1px solid #c7d7fd;">
            <i class="fas fa-user-plus text-xs"></i> New Patient
        </a>
    </div>
</div>
@endsection


@section('content')
@php
/* ═══════════════════════════════════════════════════════════════════
   MOCK DATA — All hardcoded here; no seeders required.
   Real DB counts (Doctor, Patient, Section, Service) are still used
   in the stat cards below for the primary numbers.
═══════════════════════════════════════════════════════════════════ */

// ── Operational stats (mock operational/real-time data) ──────────
$operationalStats = [
    [
        'label'      => 'Available Doctors',
        'value'      => 18,
        'sub'        => 'of ' . \App\Models\Doctor::count() . ' total',
        'trend'      => '+3 since yesterday',
        'trend_up'   => true,
        'icon_class' => 'fas fa-user-md',
        'icon_bg'    => '#eff6ff',
        'icon_color' => '#2563eb',
        'bar_pct'    => 75,
        'bar_color'  => '#2563eb',
        'spark'      => [30, 45, 38, 60, 55, 70, 75],
    ],
    [
        'label'      => 'Inpatients Today',
        'value'      => 47,
        'sub'        => 'of ' . \App\Models\Patient::count() . ' registered',
        'trend'      => '+12 vs last week',
        'trend_up'   => true,
        'icon_class' => 'fas fa-procedures',
        'icon_bg'    => '#ecfdf5',
        'icon_color' => '#059669',
        'bar_pct'    => 62,
        'bar_color'  => '#059669',
        'spark'      => [20, 35, 28, 40, 38, 44, 47],
    ],
    [
        'label'      => 'Ongoing Surgeries',
        'value'      => 3,
        'sub'        => 'across ' . \App\Models\Section::count() . ' departments',
        'trend'      => '−1 vs yesterday',
        'trend_up'   => false,
        'icon_class' => 'fas fa-heartbeat',
        'icon_bg'    => '#fff7ed',
        'icon_color' => '#ea580c',
        'bar_pct'    => 30,
        'bar_color'  => '#ea580c',
        'spark'      => [5, 3, 6, 4, 5, 4, 3],
    ],
    [
        'label'      => 'Vacant Rooms',
        'value'      => 12,
        'sub'        => '18 of 30 occupied',
        'trend'      => '−5 vs last week',
        'trend_up'   => null,  // neutral
        'icon_class' => 'fas fa-door-open',
        'icon_bg'    => '#fdf4ff',
        'icon_color' => '#9333ea',
        'bar_pct'    => 40,
        'bar_color'  => '#9333ea',
        'spark'      => [18, 15, 20, 14, 16, 13, 12],
    ],
];

// ── Weekly patient intake (Mon → Sun, this week) ─────────────────
$weeklyIntake = [
    'Mon' => 42, 'Tue' => 58, 'Wed' => 35,
    'Thu' => 71, 'Fri' => 63, 'Sat' => 29, 'Sun' => 19,
];
$weekMax = max($weeklyIntake);
$weekTotal = array_sum($weeklyIntake);

// ── Department patient breakdown ─────────────────────────────────
$departments = [
    ['name' => 'Emergency',   'count' => 34, 'bar_color' => '#ef4444', 'badge' => 'bg-red-50 text-red-700'],
    ['name' => 'Cardiology',  'count' => 28, 'bar_color' => '#3b82f6', 'badge' => 'bg-blue-50 text-blue-700'],
    ['name' => 'Orthopedics', 'count' => 21, 'bar_color' => '#8b5cf6', 'badge' => 'bg-purple-50 text-purple-700'],
    ['name' => 'Neurology',   'count' => 17, 'bar_color' => '#f59e0b', 'badge' => 'bg-amber-50 text-amber-700'],
    ['name' => 'Pediatrics',  'count' => 15, 'bar_color' => '#10b981', 'badge' => 'bg-emerald-50 text-emerald-700'],
];
$deptMax   = max(array_column($departments, 'count'));
$deptTotal = array_sum(array_column($departments, 'count'));

// ── Recent activity timeline ──────────────────────────────────────
$timeline = [
    ['time' => '09:15 AM', 'text' => 'Patient #4821 admitted — Emergency Dept.',    'icon' => 'fas fa-ambulance',           'dot_bg' => '#fef2f2', 'dot_color' => '#dc2626'],
    ['time' => '09:40 AM', 'text' => 'Surgery completed — Dr. Nadia Al-Rashid',     'icon' => 'fas fa-check-circle',        'dot_bg' => '#f0fdf4', 'dot_color' => '#16a34a'],
    ['time' => '10:05 AM', 'text' => 'Lab results ready for Patient #4816',         'icon' => 'fas fa-flask',               'dot_bg' => '#eff6ff', 'dot_color' => '#2563eb'],
    ['time' => '10:30 AM', 'text' => 'Appointment booked — Cardiology Dept.',       'icon' => 'fas fa-calendar-plus',       'dot_bg' => '#faf5ff', 'dot_color' => '#7c3aed'],
    ['time' => '11:00 AM', 'text' => 'Invoice #INV-2847 generated — $340',         'icon' => 'fas fa-file-invoice-dollar', 'dot_bg' => '#fffbeb', 'dot_color' => '#d97706'],
    ['time' => '11:20 AM', 'text' => 'Dr. Khalid Al-Mansoori signed in',            'icon' => 'fas fa-sign-in-alt',         'dot_bg' => '#f0fdfa', 'dot_color' => '#0d9488'],
];

// ── Upcoming appointments (today) ─────────────────────────────────
$appointments = [
    ['time' => '09:00 AM', 'patient' => 'Hassan Al-Ahmad',   'doctor' => 'Dr. N. Al-Rashid', 'dept' => 'Cardiology',   'status' => 'Confirmed',    'status_bg' => 'bg-emerald-50', 'status_text' => 'text-emerald-700'],
    ['time' => '10:30 AM', 'patient' => 'Sara Chaudhary',    'doctor' => 'Dr. O. Haddad',    'dept' => 'Neurology',    'status' => 'In Progress',  'status_bg' => 'bg-blue-50',    'status_text' => 'text-blue-700'],
    ['time' => '11:15 AM', 'patient' => 'Maria Costa',       'doctor' => 'Dr. Y. Nassif',    'dept' => 'Orthopedics',  'status' => 'Waiting',      'status_bg' => 'bg-amber-50',   'status_text' => 'text-amber-700'],
    ['time' => '01:00 PM', 'patient' => 'Ahmed Karimi',      'doctor' => 'Dr. N. Al-Rashid', 'dept' => 'Cardiology',   'status' => 'Confirmed',    'status_bg' => 'bg-emerald-50', 'status_text' => 'text-emerald-700'],
    ['time' => '02:30 PM', 'patient' => 'Lena Müller',       'doctor' => 'Dr. F. Nassar',    'dept' => 'Emergency',    'status' => 'Cancelled',    'status_bg' => 'bg-rose-50',    'status_text' => 'text-rose-700'],
    ['time' => '03:45 PM', 'patient' => 'Ramy Selim',        'doctor' => 'Dr. A. Ibrahim',   'dept' => 'Pediatrics',   'status' => 'Waiting',      'status_bg' => 'bg-amber-50',   'status_text' => 'text-amber-700'],
];
@endphp


{{-- ════════════════════════════════════════════════════════════════════
     ROW 1 — Four Operational Stats Cards
════════════════════════════════════════════════════════════════════ --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-6"
     style="font-family: 'Segoe UI', system-ui, sans-serif;">

    @foreach ($operationalStats as $stat)
    <div class="tw-card bg-white rounded-2xl p-5 flex flex-col gap-3"
         style="border: 1px solid #f1f5f9; box-shadow: 0 1px 8px rgba(0,0,0,0.05);">

        {{-- Icon + number row --}}
        <div class="flex items-start justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-widest mb-1" style="color: #94a3b8; letter-spacing: 0.08em;">
                    {{ $stat['label'] }}
                </p>
                <p class="text-3xl font-extrabold leading-none" style="color: #0f172a; letter-spacing: -1px;">
                    {{ $stat['value'] }}
                </p>
                <p class="text-xs mt-1" style="color: #94a3b8;">{{ $stat['sub'] }}</p>
            </div>
            <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0"
                 style="background: {{ $stat['icon_bg'] }};">
                <i class="{{ $stat['icon_class'] }} text-lg" style="color: {{ $stat['icon_color'] }};"></i>
            </div>
        </div>

        {{-- Mini CSS sparkline --}}
        <div class="spark" style="color: {{ $stat['bar_color'] }};">
            @foreach ($stat['spark'] as $idx => $sp)
            @php $h = round($sp / max($stat['spark']) * 28); $isLast = $idx === count($stat['spark']) - 1; @endphp
            <div class="spark-bar {{ $isLast ? 'hi' : '' }}" style="height: {{ $h }}px;"></div>
            @endforeach
        </div>

        {{-- Trend badge + progress bar --}}
        <div class="space-y-2">
            <div class="flex items-center justify-between">
                @if ($stat['trend_up'] === true)
                <span class="inline-flex items-center gap-1 text-xs font-semibold rounded-full px-2 py-0.5"
                      style="background: #f0fdf4; color: #16a34a;">
                    <i class="fas fa-arrow-up text-xs"></i> {{ $stat['trend'] }}
                </span>
                @elseif ($stat['trend_up'] === false)
                <span class="inline-flex items-center gap-1 text-xs font-semibold rounded-full px-2 py-0.5"
                      style="background: #fff7ed; color: #c2410c;">
                    <i class="fas fa-arrow-down text-xs"></i> {{ $stat['trend'] }}
                </span>
                @else
                <span class="inline-flex items-center gap-1 text-xs font-semibold rounded-full px-2 py-0.5"
                      style="background: #f8fafc; color: #64748b;">
                    <i class="fas fa-minus text-xs"></i> {{ $stat['trend'] }}
                </span>
                @endif
                <span class="text-xs font-semibold" style="color: #64748b;">{{ $stat['bar_pct'] }}%</span>
            </div>
            <div class="w-full rounded-full" style="height: 4px; background: #f1f5f9;">
                <div class="h-full rounded-full dept-bar" style="width: {{ $stat['bar_pct'] }}%; background: {{ $stat['bar_color'] }};"></div>
            </div>
        </div>

    </div>
    @endforeach

</div>{{-- /stats row --}}


{{-- ════════════════════════════════════════════════════════════════════
     ROW 2 — Weekly Intake Chart (left) + Department Breakdown (right)
════════════════════════════════════════════════════════════════════ --}}
<div class="grid grid-cols-1 xl:grid-cols-12 gap-5 mb-6"
     style="font-family: 'Segoe UI', system-ui, sans-serif;">

    {{-- ── Weekly Intake — SVG Bar Chart ─────────────────────────────── --}}
    <div class="xl:col-span-7 tw-card bg-white rounded-2xl p-6"
         style="border: 1px solid #f1f5f9; box-shadow: 0 1px 8px rgba(0,0,0,0.05);">

        {{-- Card header --}}
        <div class="flex items-start justify-between mb-1">
            <div>
                <h4 class="text-base font-bold" style="color: #0f172a;">Weekly Patient Intake</h4>
                <p class="text-xs mt-0.5" style="color: #94a3b8;">
                    Total this week:
                    <span class="font-bold" style="color: #0162e8;">{{ $weekTotal }}</span> patients
                </p>
            </div>
            <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1 rounded-full"
                  style="background: #eff6ff; color: #2563eb;">
                <span class="w-1.5 h-1.5 rounded-full inline-block" style="background: #2563eb;"></span>
                This Week
            </span>
        </div>

        {{-- SVG Bar Chart — pure Blade + SVG, zero JS libraries --}}
        @php
            // SVG coordinate system
            $svgW  = 580;
            $svgH  = 180;
            $padT  = 24;  // top padding for value labels
            $padB  = 22;  // bottom padding for day labels
            $padL  = 8;
            $padR  = 8;
            $chartH = $svgH - $padT - $padB;  // usable chart height = 134
            $dayCount = count($weeklyIntake);
            $colW  = ($svgW - $padL - $padR) / $dayCount;
            $barW  = $colW * 0.54;
            $barX0 = $padL + ($colW - $barW) / 2;
            $avgVal = round($weekTotal / $dayCount);
            $avgY   = $padT + $chartH - round($avgVal / $weekMax * $chartH);
        @endphp

        <svg viewBox="0 0 {{ $svgW }} {{ $svgH }}" class="w-full"
             style="height: 190px; overflow: visible;"
             xmlns="http://www.w3.org/2000/svg">

            {{-- Subtle horizontal gridlines --}}
            @foreach ([0.25, 0.5, 0.75, 1.0] as $frac)
            @php $gy = $padT + $chartH - round($frac * $chartH); @endphp
            <line x1="{{ $padL }}" y1="{{ $gy }}"
                  x2="{{ $svgW - $padR }}" y2="{{ $gy }}"
                  stroke="#e2e8f0" stroke-width="1" stroke-dasharray="4,4"/>
            <text x="{{ $padL }}" y="{{ $gy - 3 }}"
                  font-size="9" fill="#cbd5e1"
                  font-family="system-ui, sans-serif">{{ round($frac * $weekMax) }}</text>
            @endforeach

            {{-- Average line --}}
            <line x1="{{ $padL }}" y1="{{ $avgY }}"
                  x2="{{ $svgW - $padR }}" y2="{{ $avgY }}"
                  stroke="#94a3b8" stroke-width="1" stroke-dasharray="6,3" opacity="0.6"/>
            <text x="{{ $svgW - $padR - 2 }}" y="{{ $avgY - 4 }}"
                  font-size="9" fill="#94a3b8" text-anchor="end"
                  font-family="system-ui, sans-serif">avg {{ $avgVal }}</text>

            {{-- Bars --}}
            @php $col = 0; @endphp
            @foreach ($weeklyIntake as $day => $val)
            @php
                $bH    = round($val / $weekMax * $chartH);
                $bX    = $padL + $col * $colW + ($colW - $barW) / 2;
                $bY    = $padT + $chartH - $bH;
                $cx    = $padL + $col * $colW + $colW / 2;
                $isMax = ($val === $weekMax);
                $fill  = $isMax ? '#0162e8' : '#bfdbfe';
                $textC = $isMax ? '#0162e8' : '#94a3b8';
                $col++;
            @endphp

            {{-- Bar shadow (subtle) --}}
            @if ($isMax)
            <rect x="{{ $bX + 1 }}" y="{{ $bY + 2 }}" width="{{ $barW }}" height="{{ $bH }}"
                  rx="5" fill="#0162e8" opacity="0.15"/>
            @endif

            {{-- Bar --}}
            <rect x="{{ $bX }}" y="{{ $bY }}" width="{{ $barW }}" height="{{ $bH }}"
                  rx="5" fill="{{ $fill }}"/>

            {{-- Value label --}}
            <text x="{{ $cx }}" y="{{ $bY - 5 }}"
                  text-anchor="middle" font-size="10" font-weight="600"
                  fill="{{ $textC }}" font-family="system-ui, sans-serif">{{ $val }}</text>

            {{-- Day label --}}
            <text x="{{ $cx }}" y="{{ $svgH - 4 }}"
                  text-anchor="middle" font-size="10" fill="#94a3b8"
                  font-family="system-ui, sans-serif">{{ substr($day, 0, 3) }}</text>

            @endforeach
        </svg>

    </div>


    {{-- ── Department Patient Breakdown ──────────────────────────────── --}}
    <div class="xl:col-span-5 tw-card bg-white rounded-2xl p-6"
         style="border: 1px solid #f1f5f9; box-shadow: 0 1px 8px rgba(0,0,0,0.05);">

        <div class="flex items-start justify-between mb-5">
            <div>
                <h4 class="text-base font-bold" style="color: #0f172a;">Department Breakdown</h4>
                <p class="text-xs mt-0.5" style="color: #94a3b8;">
                    {{ $deptTotal }} patients across {{ count($departments) }} depts
                </p>
            </div>
            <span class="text-xs font-semibold px-2.5 py-1 rounded-full"
                  style="background: #f8fafc; color: #64748b; border: 1px solid #e2e8f0;">
                Today
            </span>
        </div>

        <div class="space-y-4">
            @foreach ($departments as $dept)
            @php $pct = round($dept['count'] / $deptMax * 100); @endphp
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <div class="flex items-center gap-2">
                        <div class="w-2.5 h-2.5 rounded-full flex-shrink-0"
                             style="background: {{ $dept['bar_color'] }};"></div>
                        <span class="text-sm font-medium" style="color: #374151;">{{ $dept['name'] }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-bold" style="color: #1e293b;">{{ $dept['count'] }}</span>
                        <span class="inline-flex text-xs font-semibold px-1.5 py-0.5 rounded-md {{ $dept['badge'] }}">
                            {{ round($dept['count'] / $deptTotal * 100) }}%
                        </span>
                    </div>
                </div>
                <div class="w-full rounded-full" style="height: 6px; background: #f1f5f9;">
                    <div class="h-full rounded-full dept-bar"
                         style="width: {{ $pct }}%; background: {{ $dept['bar_color'] }};"></div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Donut legend strip --}}
        <div class="flex flex-wrap gap-3 mt-6 pt-4" style="border-top: 1px solid #f1f5f9;">
            @foreach ($departments as $dept)
            <div class="flex items-center gap-1.5">
                <div class="w-2 h-2 rounded-sm" style="background: {{ $dept['bar_color'] }};"></div>
                <span class="text-xs" style="color: #64748b;">{{ $dept['name'] }}</span>
            </div>
            @endforeach
        </div>

    </div>

</div>{{-- /row 2 --}}


{{-- ════════════════════════════════════════════════════════════════════
     ROW 3 — Activity Timeline (left) + Appointments Table (right)
════════════════════════════════════════════════════════════════════ --}}
<div class="grid grid-cols-1 xl:grid-cols-12 gap-5 mb-6"
     style="font-family: 'Segoe UI', system-ui, sans-serif;">

    {{-- ── Activity Timeline ───────────────────────────────────────── --}}
    <div class="xl:col-span-4 tw-card bg-white rounded-2xl p-6"
         style="border: 1px solid #f1f5f9; box-shadow: 0 1px 8px rgba(0,0,0,0.05);">

        <div class="flex items-center justify-between mb-5">
            <h4 class="text-base font-bold" style="color: #0f172a;">Recent Activity</h4>
            <span class="flex items-center gap-1.5 text-xs font-semibold"
                  style="color: #64748b;">
                <span class="w-1.5 h-1.5 rounded-full inline-block" style="background: #22c55e; animation: pulse 2s infinite;"></span>
                Live
            </span>
        </div>

        <ul class="list-none p-0 m-0 space-y-0">
            @foreach ($timeline as $idx => $event)
            <li class="relative flex gap-3 {{ !$loop->last ? 'pb-5' : '' }}">

                {{-- Vertical connector --}}
                @if (!$loop->last)
                <div class="tl-connector" style="left: 19px; top: 38px;"></div>
                @endif

                {{-- Dot --}}
                <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 z-10"
                     style="background: {{ $event['dot_bg'] }};">
                    <i class="{{ $event['icon'] }} text-xs" style="color: {{ $event['dot_color'] }};"></i>
                </div>

                {{-- Content --}}
                <div class="flex-1 min-w-0 pt-1">
                    <p class="text-sm leading-snug m-0" style="color: #374151;">
                        {{ $event['text'] }}
                    </p>
                    <p class="text-xs mt-1 m-0 font-medium" style="color: #94a3b8;">
                        {{ $event['time'] }}
                    </p>
                </div>

            </li>
            @endforeach
        </ul>

        {{-- View all link --}}
        <div class="mt-5 pt-4" style="border-top: 1px solid #f1f5f9;">
            <a href="#" class="text-xs font-semibold no-underline flex items-center gap-1"
               style="color: #0162e8;">
                View full activity log
                <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>

    </div>


    {{-- ── Upcoming Appointments Table ─────────────────────────────── --}}
    <div class="xl:col-span-8 tw-card bg-white rounded-2xl"
         style="border: 1px solid #f1f5f9; box-shadow: 0 1px 8px rgba(0,0,0,0.05); overflow: hidden;">

        {{-- Table header --}}
        <div class="flex items-center justify-between px-6 py-5"
             style="border-bottom: 1px solid #f1f5f9;">
            <div>
                <h4 class="text-base font-bold" style="color: #0f172a;">Today's Appointments</h4>
                <p class="text-xs mt-0.5 m-0" style="color: #94a3b8;">
                    {{ count($appointments) }} scheduled for {{ $today->format('M j') }}
                </p>
            </div>
            <a href="{{ url('appointments') }}"
               class="inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-lg no-underline transition-all"
               style="color: #0162e8; background: #eff6ff; border: 1px solid #bfdbfe;">
                View all
                <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full" style="border-collapse: collapse;">
                <thead>
                    <tr style="background: #f8fafc;">
                        <th class="px-5 py-3 text-left text-xs font-bold uppercase tracking-wider"
                            style="color: #94a3b8; letter-spacing: 0.08em;">Time</th>
                        <th class="px-5 py-3 text-left text-xs font-bold uppercase tracking-wider"
                            style="color: #94a3b8; letter-spacing: 0.08em;">Patient</th>
                        <th class="px-5 py-3 text-left text-xs font-bold uppercase tracking-wider"
                            style="color: #94a3b8; letter-spacing: 0.08em;">Doctor</th>
                        <th class="px-5 py-3 text-left text-xs font-bold uppercase tracking-wider hidden md:table-cell"
                            style="color: #94a3b8; letter-spacing: 0.08em;">Department</th>
                        <th class="px-5 py-3 text-left text-xs font-bold uppercase tracking-wider"
                            style="color: #94a3b8; letter-spacing: 0.08em;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appt)
                    <tr class="appt-row transition-colors" style="border-top: 1px solid #f8fafc;">

                        {{-- Time --}}
                        <td class="px-5 py-3.5">
                            <span class="text-sm font-bold" style="color: #1e293b; font-variant-numeric: tabular-nums;">
                                {{ $appt['time'] }}
                            </span>
                        </td>

                        {{-- Patient --}}
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 text-xs font-bold text-white"
                                     style="background: #0162e8;">
                                    {{ strtoupper(substr($appt['patient'], 0, 1)) }}
                                </div>
                                <span class="text-sm font-medium" style="color: #374151;">
                                    {{ $appt['patient'] }}
                                </span>
                            </div>
                        </td>

                        {{-- Doctor --}}
                        <td class="px-5 py-3.5">
                            <span class="text-sm" style="color: #64748b;">{{ $appt['doctor'] }}</span>
                        </td>

                        {{-- Department --}}
                        <td class="px-5 py-3.5 hidden md:table-cell">
                            <span class="text-sm" style="color: #64748b;">{{ $appt['dept'] }}</span>
                        </td>

                        {{-- Status badge --}}
                        <td class="px-5 py-3.5">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold
                                         {{ $appt['status_bg'] }} {{ $appt['status_text'] }}">
                                @if ($appt['status'] === 'In Progress')
                                <span class="w-1.5 h-1.5 rounded-full mr-1.5 flex-shrink-0"
                                      style="background: currentColor; animation: pulse 1.5s infinite;"></span>
                                @endif
                                {{ $appt['status'] }}
                            </span>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</div>{{-- /row 3 --}}

@endsection


@section('js')
{{-- All charts are pure SVG/CSS — no external JS libraries needed.
     The @section('js') is kept to avoid breaking the layout's @yield('js'). --}}
@endsection
