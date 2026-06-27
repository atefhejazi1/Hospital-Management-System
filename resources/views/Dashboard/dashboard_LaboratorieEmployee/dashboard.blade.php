@extends('Dashboard.layouts.master')

@section('title', trans('staff-dashboard_trans.lab_dashboard_title'))

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
    .mc-badge.badge-completed { background: #dcfce7; color: #166534; }

    .mc-empty { text-align: center; padding: 36px 12px; color: var(--mc-muted); font-size: .88rem; }
    .mc-empty i { font-size: 1.6rem; color: var(--mc-border); display: block; margin-bottom: 10px; }

    .mc-chart-wrap { position: relative; height: 250px; }
    .mc-donut-wrap { position: relative; height: 170px; margin: 0 auto 18px; max-width: 170px; }
    .mc-donut-total { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; }
    .mc-donut-total .num { font-size: 1.5rem; font-weight: 800; line-height: 1; }
    .mc-donut-total .lbl { font-size: .68rem; color: var(--mc-muted); font-weight: 600; }

    .mc-legend-row { display: flex; align-items: center; justify-content: space-between; padding: 7px 0; font-size: .85rem; }
    .mc-legend-key { display: flex; align-items: center; gap: 8px; font-weight: 600; }
    .mc-legend-dot { width: 9px; height: 9px; border-radius: 50%; display: inline-block; flex-shrink: 0; }
    .mc-legend-count { font-weight: 700; color: var(--mc-muted); }
</style>
@endsection

@section('page-header')
<div class="mc-page d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div class="mc-greeting">
        @php
            $mcGreetingKey = now()->hour < 12 ? 'greeting_morning' : (now()->hour < 18 ? 'greeting_afternoon' : 'greeting_evening');
        @endphp
        <h2>{{ trans('staff-dashboard_trans.' . $mcGreetingKey) }}, {{ $employee->name }}</h2>
        <p>{{ now()->translatedFormat('l, d F Y') }} — {{ trans('staff-dashboard_trans.lab_greeting_subtitle') }}</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('invoices_laboratorie_employee.index') }}" class="mc-action-btn"><i class="bi bi-receipt"></i> {{ trans('staff-dashboard_trans.view_invoices') }}</a>
        <a href="{{ route('completed_invoices') }}" class="mc-action-btn is-primary"><i class="bi bi-clipboard-check"></i> {{ trans('staff-dashboard_trans.view_completed') }}</a>
    </div>
</div>
@endsection

@section('content')
<div class="mc-page">

    <!-- KPI cards -->
    <div class="row row-sm mb-1">
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="mc-metric-card">
                <div class="mc-metric-icon"><i class="bi bi-hourglass-split"></i></div>
                <div class="mc-metric-value">{{ $metrics['pendingQueue'] }}</div>
                <div class="mc-metric-label">{{ trans('staff-dashboard_trans.lab_pending_queue_count') }}</div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="mc-metric-card">
                <div class="mc-metric-icon"><i class="bi bi-check-circle"></i></div>
                <div class="mc-metric-value">{{ $metrics['completedByMe'] }}</div>
                <div class="mc-metric-label">{{ trans('staff-dashboard_trans.completed_by_me_count') }}</div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="mc-metric-card">
                <div class="mc-metric-icon"><i class="bi bi-calendar-check"></i></div>
                <div class="mc-metric-value">{{ $metrics['completedToday'] }}</div>
                <div class="mc-metric-label">{{ trans('staff-dashboard_trans.completed_today_count') }}</div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="mc-metric-card">
                <div class="mc-metric-icon"><i class="bi bi-clipboard2-pulse"></i></div>
                <div class="mc-metric-value">{{ $metrics['totalLabs'] }}</div>
                <div class="mc-metric-label">{{ trans('staff-dashboard_trans.lab_total_labs_count') }}</div>
            </div>
        </div>
    </div>

    <!-- Trend + status breakdown -->
    <div class="row row-sm mt-3">
        <div class="col-xl-7 col-lg-12">
            <div class="mc-panel">
                <div class="mc-panel-head">
                    <div>
                        <h4 class="mc-panel-title">{{ trans('staff-dashboard_trans.lab_trend_title') }}</h4>
                        <p class="mc-panel-sub">{{ trans('staff-dashboard_trans.trend_sub') }}</p>
                    </div>
                </div>
                <div class="mc-chart-wrap">
                    <canvas id="mcTrendChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-5 col-lg-12 mt-3 mt-xl-0">
            <div class="mc-panel">
                <div class="mc-panel-head">
                    <div>
                        <h4 class="mc-panel-title">{{ trans('staff-dashboard_trans.status_breakdown_title') }}</h4>
                        <p class="mc-panel-sub">{{ trans('staff-dashboard_trans.lab_status_breakdown_sub') }}</p>
                    </div>
                </div>

                @php $statusTotal = array_sum($statusBreakdown); @endphp

                <div class="mc-donut-wrap">
                    <canvas id="mcStatusDonut"></canvas>
                    <div class="mc-donut-total">
                        <div class="num">{{ $statusTotal }}</div>
                        <div class="lbl">{{ trans('staff-dashboard_trans.labs_suffix') }}</div>
                    </div>
                </div>

                <div class="mc-legend-row">
                    <span class="mc-legend-key"><span class="mc-legend-dot" style="background:#eab308;"></span>{{ trans('staff-dashboard_trans.status_pending') }}</span>
                    <span class="mc-legend-count">{{ $statusBreakdown['pending'] }}</span>
                </div>
                <div class="mc-legend-row">
                    <span class="mc-legend-key"><span class="mc-legend-dot" style="background:#16a34a;"></span>{{ trans('staff-dashboard_trans.status_completed_label') }}</span>
                    <span class="mc-legend-count">{{ $statusBreakdown['completed'] }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent completed -->
    <div class="row row-sm mt-3">
        <div class="col-12">
            <div class="mc-panel">
                <div class="mc-panel-head">
                    <div>
                        <h4 class="mc-panel-title">{{ trans('staff-dashboard_trans.lab_recent_completed_title') }}</h4>
                        <p class="mc-panel-sub">{{ trans('staff-dashboard_trans.recent_completed_sub') }}</p>
                    </div>
                </div>

                @if ($recentCompleted->isEmpty())
                    <div class="mc-empty">
                        <i class="bi bi-clipboard2-x"></i>
                        {{ trans('staff-dashboard_trans.lab_no_completed_tests') }}
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="mc-table w-100">
                            <thead>
                                <tr>
                                    <th>{{ trans('staff-dashboard_trans.col_patient') }}</th>
                                    <th>{{ trans('staff-dashboard_trans.col_doctor') }}</th>
                                    <th>{{ trans('staff-dashboard_trans.col_required') }}</th>
                                    <th>{{ trans('staff-dashboard_trans.col_completed_at') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentCompleted as $lab)
                                    <tr>
                                        <td>{{ $lab->Patient->name ?? '-' }}</td>
                                        <td>{{ $lab->doctor->name ?? '-' }}</td>
                                        <td>{{ $lab->description }}</td>
                                        <td>{{ $lab->updated_at->format('Y-m-d h:i A') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection

@section('js')
<script src="{{URL::asset('Dashboard/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var trendCtx = document.getElementById('mcTrendChart');
        if (trendCtx) {
            new Chart(trendCtx, {
                type: 'line',
                data: {
                    labels: @json($completedTrend->pluck('label')),
                    datasets: [{
                        data: @json($completedTrend->pluck('count')),
                        borderColor: '#0284c7',
                        backgroundColor: 'rgba(2,132,199,.08)',
                        borderWidth: 2,
                        pointBackgroundColor: '#0284c7',
                        pointRadius: 3,
                        fill: true,
                        tension: 0.35,
                    }]
                },
                options: {
                    legend: { display: false },
                    scales: { yAxes: [{ ticks: { beginAtZero: true, precision: 0 } }] }
                }
            });
        }

        var donutCtx = document.getElementById('mcStatusDonut');
        if (donutCtx) {
            new Chart(donutCtx, {
                type: 'doughnut',
                data: {
                    labels: [
                        @json(trans('staff-dashboard_trans.status_pending')),
                        @json(trans('staff-dashboard_trans.status_completed_label'))
                    ],
                    datasets: [{
                        data: [
                            {{ $statusBreakdown['pending'] }},
                            {{ $statusBreakdown['completed'] }}
                        ],
                        backgroundColor: ['#eab308', '#16a34a'],
                        borderWidth: 0,
                    }]
                },
                options: {
                    legend: { display: false },
                    cutoutPercentage: 72,
                }
            });
        }
    });
</script>
@endsection
