@extends('Dashboard.layouts.master')

@section('title', 'Admin Dashboard')

@section('css')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<style>
    :root {
        --mc-primary: #0284c7;
        --mc-accent: #0369a1;
        --mc-dark: #0f172a;
        --mc-bg-soft: #f0f9ff;
        --mc-border: #e2e8f0;
        --mc-muted: #64748b;
    }

    .mc-page { font-family: 'Inter', sans-serif; color: var(--mc-dark); }

    .mc-greeting h2 { font-weight: 800; font-size: 1.5rem; margin: 0 0 2px; }
    .mc-greeting p { color: var(--mc-muted); font-size: .88rem; margin: 0; }

    .mc-action-btn {
        display: inline-flex; align-items: center; gap: 7px;
        border-radius: 8px; padding: 9px 16px; font-size: .85rem; font-weight: 700;
        border: 1.5px solid var(--mc-border) !important; background: #fff !important; color: var(--mc-dark) !important;
        text-decoration: none !important; transition: border-color .15s, color .15s;
    }
    .mc-action-btn:hover { border-color: var(--mc-primary) !important; color: var(--mc-primary) !important; }
    .mc-action-btn.is-primary { background: var(--mc-primary) !important; border-color: var(--mc-primary) !important; color: #fff !important; }
    .mc-action-btn.is-primary:hover { background: var(--mc-accent) !important; border-color: var(--mc-accent) !important; color: #fff !important; }

    .mc-metric-card {
        background: #fff; border: 1px solid var(--mc-border); border-radius: 14px;
        padding: 20px 22px; height: 100%; border-top: 3px solid var(--mc-primary);
    }
    .mc-metric-card .mc-metric-icon {
        width: 40px; height: 40px; border-radius: 10px; background: var(--mc-bg-soft);
        color: var(--mc-primary); display: flex; align-items: center; justify-content: center;
        font-size: 1.15rem; margin-bottom: 14px;
    }
    .mc-metric-card .mc-metric-value { font-size: 1.65rem; font-weight: 800; line-height: 1; margin-bottom: 4px; }
    .mc-metric-card .mc-metric-label { font-size: .82rem; font-weight: 600; color: var(--mc-muted); }

    .mc-panel { background: #fff; border: 1px solid var(--mc-border); border-radius: 14px; padding: 22px; height: 100%; }
    .mc-panel-head { display: flex; align-items: center; justify-content: between; margin-bottom: 18px; }
    .mc-panel-title { font-size: 1.02rem; font-weight: 800; margin: 0; }
    .mc-panel-sub { font-size: .8rem; color: var(--mc-muted); margin: 2px 0 0; }

    .mc-table thead th {
        font-size: .74rem; text-transform: uppercase; letter-spacing: .04em;
        color: var(--mc-muted); font-weight: 700; border-bottom: 1.5px solid var(--mc-border);
        padding-bottom: 10px; white-space: nowrap;
    }
    .mc-table tbody td { padding: 13px 8px; border-bottom: 1px solid var(--mc-border); font-size: .87rem; vertical-align: middle; }
    .mc-table tbody tr:last-child td { border-bottom: 0; }

    .mc-badge { display: inline-block; padding: 4px 11px; border-radius: 999px; font-size: .76rem; font-weight: 700; }
    .mc-badge.badge-pending { background: #fef9c3; color: #854d0e; }
    .mc-badge.badge-confirmed { background: #e0f2fe; color: #075985; }
    .mc-badge.badge-completed { background: #dcfce7; color: #166534; }

    .mc-empty { text-align: center; padding: 36px 12px; color: var(--mc-muted); font-size: .88rem; }
    .mc-empty i { font-size: 1.6rem; color: var(--mc-border); display: block; margin-bottom: 10px; }

    .mc-load-row { margin-bottom: 18px; }
    .mc-load-row:last-child { margin-bottom: 0; }
    .mc-load-top { display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 7px; }
    .mc-load-name { font-size: .85rem; font-weight: 700; }
    .mc-load-count { font-size: .78rem; color: var(--mc-muted); font-weight: 600; }
    .mc-progress { height: 8px; border-radius: 999px; background: var(--mc-bg-soft); overflow: hidden; }
    .mc-progress-bar { height: 100%; background: var(--mc-primary); border-radius: 999px; }

    .mc-status-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--mc-primary); display: inline-block; margin-right: 6px; }
</style>
@endsection

@section('page-header')
<div class="mc-page d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div class="mc-greeting">
        <h2>Good {{ now()->hour < 12 ? 'morning' : (now()->hour < 18 ? 'afternoon' : 'evening') }}, {{ Auth::guard('admin')->user()->name }}</h2>
        <p>{{ now()->translatedFormat('l, d F Y') }} — here's what's happening today.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ url('Doctors/create') }}" class="mc-action-btn"><i class="bi bi-person-plus"></i> Add Doctor</a>
        <a href="{{ url('Patients/create') }}" class="mc-action-btn is-primary"><i class="bi bi-clipboard-plus"></i> New Patient</a>
    </div>
</div>
@endsection

@section('content')
<div class="mc-page">

    {{-- ====================== METRIC GRID ====================== --}}
    <div class="row g-3 mb-3">
        <div class="col-lg-3 col-md-6">
            <div class="mc-metric-card">
                <div class="mc-metric-icon"><i class="bi bi-person-check"></i></div>
                <div class="mc-metric-value">{{ $metrics['registeredPatients'] }}</div>
                <div class="mc-metric-label">Registered Patients</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="mc-metric-card">
                <div class="mc-metric-icon"><i class="bi bi-heart-pulse"></i></div>
                <div class="mc-metric-value">{{ $metrics['activeDoctors'] }} / {{ $metrics['totalDoctors'] }}</div>
                <div class="mc-metric-label">Active Doctors</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="mc-metric-card">
                <div class="mc-metric-icon"><i class="bi bi-calendar-event"></i></div>
                <div class="mc-metric-value">{{ $metrics['pendingAppointmentsToday'] }}</div>
                <div class="mc-metric-label">Pending Appointments Today</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="mc-metric-card">
                <div class="mc-metric-icon"><i class="bi bi-cash-coin"></i></div>
                <div class="mc-metric-value">${{ number_format($metrics['invoicedToday'], 2) }}</div>
                <div class="mc-metric-label">Invoiced Today</div>
            </div>
        </div>
    </div>

    {{-- ====================== SPLIT SECTION ====================== --}}
    <div class="row g-3">

        {{-- Left 60% — Recent Critical Appointments --}}
        <div class="col-lg-8 col-md-12">
            <div class="mc-panel">
                <div class="mc-panel-head">
                    <div>
                        <h3 class="mc-panel-title">Recent Critical Appointments</h3>
                        <p class="mc-panel-sub">Latest scheduled appointments across all departments</p>
                    </div>
                </div>

                @if ($recentAppointments->isEmpty())
                    <div class="mc-empty">
                        <i class="bi bi-calendar-x"></i>
                        No appointments have been recorded yet.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table mc-table mb-0">
                            <thead>
                                <tr>
                                    <th>Patient</th>
                                    <th>Doctor</th>
                                    <th>Department</th>
                                    <th>Date &amp; Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentAppointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->name }}</td>
                                    <td>{{ $appointment->doctor->name ?? '—' }}</td>
                                    <td>{{ $appointment->section->name ?? '—' }}</td>
                                    <td>{{ $appointment->appointment ? \Illuminate\Support\Carbon::parse($appointment->appointment)->format('d M Y, h:i A') : '—' }}</td>
                                    <td>
                                        @if ($appointment->type === 'غير مؤكد')
                                            <span class="mc-badge badge-pending">Pending</span>
                                        @elseif ($appointment->type === 'مؤكد')
                                            <span class="mc-badge badge-confirmed">Confirmed</span>
                                        @else
                                            <span class="mc-badge badge-completed">Completed</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        {{-- Right 40% — Live System Status & Department Load --}}
        <div class="col-lg-4 col-md-12">
            <div class="mc-panel">
                <div class="mc-panel-head">
                    <div>
                        <h3 class="mc-panel-title"><span class="mc-status-dot"></span>Live System Status</h3>
                        <p class="mc-panel-sub">Open workload by department</p>
                    </div>
                </div>

                @foreach ($departmentLoad as $dept)
                <div class="mc-load-row">
                    <div class="mc-load-top">
                        <span class="mc-load-name">{{ $dept['label'] }}</span>
                        <span class="mc-load-count">{{ $dept['count'] }} &middot; {{ $dept['percent'] }}%</span>
                    </div>
                    <div class="mc-progress">
                        <div class="mc-progress-bar" style="width: {{ $dept['percent'] }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection

@section('js')
@endsection
