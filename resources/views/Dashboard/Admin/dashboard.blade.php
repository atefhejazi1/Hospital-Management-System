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

    .mc-metric-delta { font-size: .76rem; font-weight: 700; color: #16a34a; margin-top: 6px; }

    .mc-chart-wrap { position: relative; height: 250px; }
    .mc-donut-wrap { position: relative; height: 170px; margin: 0 auto 18px; max-width: 170px; }
    .mc-donut-total { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; }
    .mc-donut-total .num { font-size: 1.5rem; font-weight: 800; line-height: 1; }
    .mc-donut-total .lbl { font-size: .68rem; color: var(--mc-muted); font-weight: 600; }

    .mc-legend-row { display: flex; align-items: center; justify-content: space-between; padding: 7px 0; font-size: .85rem; }
    .mc-legend-key { display: flex; align-items: center; gap: 8px; font-weight: 600; }
    .mc-legend-dot { width: 9px; height: 9px; border-radius: 50%; display: inline-block; flex-shrink: 0; }
    .mc-legend-count { font-weight: 700; color: var(--mc-muted); }

    .mc-doctor-row { display: flex; align-items: center; gap: 12px; padding: 11px 0; border-bottom: 1px solid var(--mc-border); }
    .mc-doctor-row:last-child { border-bottom: 0; }
    .mc-doctor-rank { width: 20px; text-align: center; font-weight: 700; color: var(--mc-muted); font-size: .8rem; flex-shrink: 0; }
    .mc-doctor-avatar { width: 36px; height: 36px; font-size: .8rem; flex-shrink: 0; }
    .mc-doctor-info { flex: 1; min-width: 0; }
    .mc-doctor-name { font-weight: 700; font-size: .87rem; }
    .mc-doctor-sub { font-size: .76rem; color: var(--mc-muted); }
    .mc-doctor-count { font-weight: 800; color: var(--mc-primary); font-size: .92rem; white-space: nowrap; }
</style>
@endsection

@section('page-header')
<div class="mc-page d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div class="mc-greeting">
        @php
            $mcGreetingKey = now()->hour < 12 ? 'greeting_morning' : (now()->hour < 18 ? 'greeting_afternoon' : 'greeting_evening');
        @endphp
        <h2>{{ trans('admin-dashboard_trans.' . $mcGreetingKey) }}, {{ Auth::guard('admin')->user()->name }}</h2>
        <p>{{ now()->translatedFormat('l, d F Y') }} — {{ trans('admin-dashboard_trans.greeting_subtitle') }}</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('appointments.index') }}" class="mc-action-btn"><i class="bi bi-calendar3"></i> {{ trans('admin-dashboard_trans.view_appointments') }}</a>
        <a href="{{ url('Doctors/create') }}" class="mc-action-btn"><i class="bi bi-person-plus"></i> {{ trans('admin-dashboard_trans.add_doctor') }}</a>
        <a href="{{ url('Patients/create') }}" class="mc-action-btn is-primary"><i class="bi bi-clipboard-plus"></i> {{ trans('admin-dashboard_trans.new_patient') }}</a>
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
                <div class="mc-metric-label">{{ trans('admin-dashboard_trans.registered_patients') }}</div>
                @if ($metrics['newPatientsThisWeek'] > 0)
                    <div class="mc-metric-delta"><i class="bi bi-arrow-up-short"></i> {{ trans('admin-dashboard_trans.new_this_week', ['count' => $metrics['newPatientsThisWeek']]) }}</div>
                @endif
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="mc-metric-card">
                <div class="mc-metric-icon"><i class="bi bi-heart-pulse"></i></div>
                <div class="mc-metric-value">{{ $metrics['activeDoctors'] }} / {{ $metrics['totalDoctors'] }}</div>
                <div class="mc-metric-label">{{ trans('admin-dashboard_trans.active_doctors') }}</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="mc-metric-card">
                <div class="mc-metric-icon"><i class="bi bi-calendar-event"></i></div>
                <div class="mc-metric-value">{{ $metrics['pendingAppointmentsToday'] }}</div>
                <div class="mc-metric-label">{{ trans('admin-dashboard_trans.pending_appointments_today') }}</div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="mc-metric-card">
                <div class="mc-metric-icon"><i class="bi bi-cash-coin"></i></div>
                <div class="mc-metric-value">${{ number_format($metrics['invoicedToday'], 2) }}</div>
                <div class="mc-metric-label">{{ trans('admin-dashboard_trans.invoiced_today') }}</div>
                @if ($metrics['invoicedThisWeek'] > 0)
                    <div class="mc-metric-delta" style="color: var(--mc-muted);">${{ number_format($metrics['invoicedThisWeek'], 2) }} {{ trans('admin-dashboard_trans.this_week_suffix') }}</div>
                @endif
            </div>
        </div>
    </div>

    {{-- ====================== TREND + STATUS BREAKDOWN ====================== --}}
    <div class="row g-3 mb-3">
        <div class="col-lg-8 col-md-12">
            <div class="mc-panel">
                <div class="mc-panel-head">
                    <div>
                        <h3 class="mc-panel-title">{{ trans('admin-dashboard_trans.trend_title') }}</h3>
                        <p class="mc-panel-sub">{{ trans('admin-dashboard_trans.trend_sub') }}</p>
                    </div>
                </div>
                <div class="mc-chart-wrap">
                    <canvas id="mcAppointmentsTrendChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-12">
            <div class="mc-panel">
                <div class="mc-panel-head">
                    <div>
                        <h3 class="mc-panel-title">{{ trans('admin-dashboard_trans.status_breakdown_title') }}</h3>
                        <p class="mc-panel-sub">{{ trans('admin-dashboard_trans.status_breakdown_sub') }}</p>
                    </div>
                </div>
                @php $statusTotal = array_sum($statusBreakdown); @endphp
                <div class="mc-donut-wrap">
                    <canvas id="mcStatusDonutChart"></canvas>
                    <div class="mc-donut-total">
                        <div class="num">{{ $statusTotal }}</div>
                        <div class="lbl">{{ trans('admin-dashboard_trans.appointments_suffix') }}</div>
                    </div>
                </div>
                <div class="mc-legend-row">
                    <span class="mc-legend-key"><span class="mc-legend-dot" style="background:#eab308;"></span>{{ trans('admin-dashboard_trans.status_pending') }}</span>
                    <span class="mc-legend-count">{{ $statusBreakdown['pending'] }}</span>
                </div>
                <div class="mc-legend-row">
                    <span class="mc-legend-key"><span class="mc-legend-dot" style="background:#0284c7;"></span>{{ trans('admin-dashboard_trans.status_confirmed') }}</span>
                    <span class="mc-legend-count">{{ $statusBreakdown['confirmed'] }}</span>
                </div>
                <div class="mc-legend-row">
                    <span class="mc-legend-key"><span class="mc-legend-dot" style="background:#22c55e;"></span>{{ trans('admin-dashboard_trans.status_completed') }}</span>
                    <span class="mc-legend-count">{{ $statusBreakdown['completed'] }}</span>
                </div>
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
                        <h3 class="mc-panel-title">{{ trans('admin-dashboard_trans.recent_appointments_title') }}</h3>
                        <p class="mc-panel-sub">{{ trans('admin-dashboard_trans.recent_appointments_sub') }}</p>
                    </div>
                </div>

                @if ($recentAppointments->isEmpty())
                    <div class="mc-empty">
                        <i class="bi bi-calendar-x"></i>
                        {{ trans('admin-dashboard_trans.no_appointments') }}
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table mc-table mb-0">
                            <thead>
                                <tr>
                                    <th>{{ trans('admin-dashboard_trans.col_patient') }}</th>
                                    <th>{{ trans('admin-dashboard_trans.col_doctor') }}</th>
                                    <th>{{ trans('admin-dashboard_trans.col_department') }}</th>
                                    <th>{{ trans('admin-dashboard_trans.col_datetime') }}</th>
                                    <th>{{ trans('admin-dashboard_trans.col_status') }}</th>
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
                                            <span class="mc-badge badge-pending">{{ trans('admin-dashboard_trans.status_pending') }}</span>
                                        @elseif ($appointment->type === 'مؤكد')
                                            <span class="mc-badge badge-confirmed">{{ trans('admin-dashboard_trans.status_confirmed') }}</span>
                                        @else
                                            <span class="mc-badge badge-completed">{{ trans('admin-dashboard_trans.status_completed') }}</span>
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

        {{-- Right 40% — Live System Status & Top Doctors --}}
        <div class="col-lg-4 col-md-12 d-flex flex-column gap-3">
            <div class="mc-panel">
                <div class="mc-panel-head">
                    <div>
                        <h3 class="mc-panel-title"><span class="mc-status-dot"></span>{{ trans('admin-dashboard_trans.system_status_title') }}</h3>
                        <p class="mc-panel-sub">{{ trans('admin-dashboard_trans.system_status_sub') }}</p>
                    </div>
                </div>

                @foreach ($departmentLoad as $dept)
                <div class="mc-load-row">
                    <div class="mc-load-top">
                        <span class="mc-load-name">{{ trans('admin-dashboard_trans.' . $dept['label']) }}</span>
                        <span class="mc-load-count">{{ $dept['count'] }} &middot; {{ $dept['percent'] }}%</span>
                    </div>
                    <div class="mc-progress">
                        <div class="mc-progress-bar" style="width: {{ $dept['percent'] }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mc-panel">
                <div class="mc-panel-head">
                    <div>
                        <h3 class="mc-panel-title">{{ trans('admin-dashboard_trans.top_doctors_title') }}</h3>
                        <p class="mc-panel-sub">{{ trans('admin-dashboard_trans.top_doctors_sub') }}</p>
                    </div>
                </div>

                @if ($topDoctors->isEmpty())
                    <div class="mc-empty">
                        <i class="bi bi-person-x"></i>
                        {{ trans('admin-dashboard_trans.no_doctors_data') }}
                    </div>
                @else
                    @foreach ($topDoctors as $i => $doc)
                    @php
                        $docInitials = \Illuminate\Support\Str::of($doc['name'])->explode(' ')->map(fn ($w) => mb_substr($w, 0, 1))->take(2)->implode('');
                    @endphp
                    <div class="mc-doctor-row">
                        <span class="mc-doctor-rank">{{ $i + 1 }}</span>
                        <span class="mc-avatar-initials mc-doctor-avatar">{{ $docInitials }}</span>
                        <div class="mc-doctor-info">
                            <div class="mc-doctor-name">{{ $doc['name'] }}</div>
                            <div class="mc-doctor-sub">{{ $doc['section'] }}</div>
                        </div>
                        <span class="mc-doctor-count">{{ $doc['count'] }}</span>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>

    </div>
</div>
@endsection

@section('js')
<script src="{{ URL::asset('Dashboard/plugins/chart.js/Chart.bundle.min.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var trendCtx = document.getElementById('mcAppointmentsTrendChart');
        if (trendCtx) {
            new Chart(trendCtx, {
                type: 'bar',
                data: {
                    labels: @json($appointmentsTrend->pluck('label')),
                    datasets: [{
                        data: @json($appointmentsTrend->pluck('count')),
                        backgroundColor: 'rgba(2, 132, 199, .85)',
                        borderRadius: 6,
                        maxBarThickness: 38,
                    }]
                },
                options: {
                    legend: { display: false },
                    scales: {
                        yAxes: [{ ticks: { beginAtZero: true, precision: 0 }, gridLines: { color: '#f0f9ff' } }],
                        xAxes: [{ gridLines: { display: false } }]
                    },
                    tooltips: { displayColors: false }
                }
            });
        }

        var donutCtx = document.getElementById('mcStatusDonutChart');
        if (donutCtx) {
            new Chart(donutCtx, {
                type: 'doughnut',
                data: {
                    labels: [
                        @json(trans('admin-dashboard_trans.status_pending')),
                        @json(trans('admin-dashboard_trans.status_confirmed')),
                        @json(trans('admin-dashboard_trans.status_completed'))
                    ],
                    datasets: [{
                        data: [{{ $statusBreakdown['pending'] }}, {{ $statusBreakdown['confirmed'] }}, {{ $statusBreakdown['completed'] }}],
                        backgroundColor: ['#eab308', '#0284c7', '#22c55e'],
                        borderWidth: 0,
                    }]
                },
                options: {
                    legend: { display: false },
                    cutoutPercentage: 72,
                    tooltips: { displayColors: false }
                }
            });
        }
    });
</script>
@endsection
