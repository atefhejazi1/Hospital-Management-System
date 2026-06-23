<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active mc-brand-mark" href="{{ url('/') }}" style="color: var(--mc-dark);">
            <span class="mark">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M19 8h-3V5a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v3H5a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h3v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3h3a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1z"/></svg>
            </span>
            MediCore
        </a>
        <a class="desktop-logo logo-dark active mc-brand-mark" href="{{ url('/') }}" style="color: #fff;">
            <span class="mark">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M19 8h-3V5a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v3H5a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h3v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3h3a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1z"/></svg>
            </span>
            MediCore
        </a>
        <a class="logo-icon mobile-logo icon-light active" href="{{ url('/') }}">
            <span class="mark">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M19 8h-3V5a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v3H5a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h3v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3h3a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1z"/></svg>
            </span>
        </a>
        <a class="logo-icon mobile-logo icon-dark active" href="{{ url('/') }}">
            <span class="mark">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M19 8h-3V5a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v3H5a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h3v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3h3a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1z"/></svg>
            </span>
        </a>
    </div>

    @if(\Auth::guard('admin')->check())
        @include('Dashboard.layouts.main-sidebar.admin-sidebar-main')
    @endif

    @if(\Auth::guard('doctor')->check())
        @include('Dashboard.layouts.main-sidebar.doctor-sidebar-main')
    @endif

    @if(\Auth::guard('ray_employee')->check())
        @include('Dashboard.layouts.main-sidebar.ray_employee-sidebar-main')
    @endif

    @if(\Auth::guard('laboratorie_employee')->check())
        @include('Dashboard.layouts.main-sidebar.laboratorie_employee-sidebar-main')
    @endif

    @if(\Auth::guard('patient')->check())
        @include('Dashboard.layouts.main-sidebar.patient-sidebar-main')
    @endif

</aside>
<!-- main-sidebar -->
