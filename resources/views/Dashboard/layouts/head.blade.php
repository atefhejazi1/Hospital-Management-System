<!-- Title -->
<title> @yield('title') </title>

@yield('css')
<!-- Internal Data table css -->
<link href="{{ URL::asset('Dashboard/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('Dashboard/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('Dashboard/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('Dashboard/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('Dashboard/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
@livewireStyles


@if (App::getLocale() == 'ar')
    <!-- Favicon -->
    <link rel="icon" href="{{ URL::asset('Dashboard/img/brand/favicon.png') }}" type="image/x-icon" />
    <!-- Icons css -->
    <link href="{{ URL::asset('Dashboard/css/icons.css') }}" rel="stylesheet">
    <!--  Custom Scroll bar-->
    <link href="{{ URL::asset('Dashboard/plugins/mscrollbar/jquery.mCustomScrollbar.css') }}" rel="stylesheet" />
    <!--  Sidebar css -->
    <link href="{{ URL::asset('Dashboard/plugins/sidebar/sidebar.css') }}" rel="stylesheet">
    <!-- Sidemenu css -->
    <link rel="stylesheet" href="{{ URL::asset('Dashboard/css-rtl/sidemenu.css') }}">
    <!--- Style css -->
    <link href="{{ URL::asset('Dashboard/css-rtl/style.css') }}" rel="stylesheet">
    <!--- Dark-mode css -->
    <link href="{{ URL::asset('Dashboard/css-rtl/style-dark.css') }}" rel="stylesheet">
    <!---Skinmodes css-->
    <link href="{{ URL::asset('Dashboard/css-rtl/skin-modes.css') }}" rel="stylesheet">
@else
    <!-- Favicon -->
    <link rel="icon" href="{{ URL::asset('Dashboard/img/brand/favicon.png') }}" type="image/x-icon" />
    <!-- Icons css -->
    <link href="{{ URL::asset('Dashboard/css/icons.css') }}" rel="stylesheet">
    <!--  Custom Scroll bar-->
    <link href="{{ URL::asset('Dashboard/plugins/mscrollbar/jquery.mCustomScrollbar.css') }}" rel="stylesheet" />
    <!--  Right-sidemenu css -->
    <link href="{{ URL::asset('Dashboard/plugins/sidebar/sidebar.css') }}" rel="stylesheet">
    <!-- Sidemenu css -->
    <link rel="stylesheet" href="{{ URL::asset('Dashboard/css/sidemenu.css') }}">
    <!-- Maps css -->
    <link href="{{ URL::asset('Dashboard/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
    <!-- style css -->
    <link href="{{ URL::asset('Dashboard/css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('Dashboard/css/style-dark.css') }}" rel="stylesheet">
    <!---Skinmodes css-->
    <link href="{{ URL::asset('Dashboard/css/skin-modes.css') }}" rel="stylesheet" />
@endif

<style>
    :root {
        --mc-primary: #0284c7;
        --mc-accent: #0369a1;
        --mc-dark: #0f172a;
        --mc-bg-soft: #f0f9ff;
        --mc-border: #e2e8f0;
        --mc-muted: #64748b;
    }

    .mc-brand-mark { display: flex; align-items: center; gap: 10px; font-weight: 800; font-size: 1.05rem; }
    .mc-brand-mark .mark {
        width: 34px; height: 34px; border-radius: 8px; background: var(--mc-primary);
        display: flex; align-items: center; justify-content: center; color: #fff; flex-shrink: 0;
    }
    .mc-brand-mark .mark svg { width: 18px; height: 18px; }

    .mc-avatar-initials {
        display: inline-flex; align-items: center; justify-content: center;
        border-radius: 50%; background: var(--mc-primary); color: #fff; font-weight: 700;
        flex-shrink: 0; line-height: 1;
    }
</style>

