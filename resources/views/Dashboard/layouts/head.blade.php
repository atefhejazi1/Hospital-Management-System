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

    /* ── MediCore: Sidebar skin (applies to every role's sidebar) ───── */
    .app-sidebar { background: #fff; }
    .app-sidebar::-webkit-scrollbar-thumb { background: rgba(2,132,199,.25); border-radius: 10px; }

    .app-sidebar__user { padding: 22px 18px 18px !important; border-bottom: 1px solid var(--mc-border); margin-bottom: 8px; }
    .app-sidebar__user .user-pro-body img { border: 3px solid var(--mc-bg-soft); box-shadow: none; }
    .app-sidebar__user .user-info h4 { font-size: .92rem; font-weight: 700; color: var(--mc-dark); }
    .app-sidebar__user .user-info .text-muted { font-size: .76rem; }
    .app-sidebar__user .mc-role-tag {
        display: inline-block; font-size: .65rem; font-weight: 700; letter-spacing: .04em;
        text-transform: uppercase; color: var(--mc-primary); background: var(--mc-bg-soft);
        padding: 2px 8px; border-radius: 100px; margin-top: 6px;
    }

    .app-sidebar .side-item-category {
        font-size: .7rem; font-weight: 700; letter-spacing: .07em; text-transform: uppercase;
        color: #94a3b8; padding: 20px 20px 8px;
    }
    .app-sidebar .side-menu__item { border-radius: 8px; color: #475569; transition: background-color .15s, color .15s; }
    .app-sidebar .side-menu__icon { color: #94a3b8; fill: #94a3b8; transition: color .15s, fill .15s; }
    .app-sidebar .side-menu__item:not(.active):hover { background: var(--mc-bg-soft); color: var(--mc-primary) !important; }
    .app-sidebar .side-menu__item:not(.active):hover .side-menu__icon { color: var(--mc-primary) !important; fill: var(--mc-primary) !important; }

    .app-sidebar .side-menu__item.active { background: var(--mc-primary) !important; box-shadow: 0 6px 14px rgba(2,132,199,.28); }
    .app-sidebar .side-menu__item.active .side-menu__icon,
    .app-sidebar .side-menu__item.active .side-menu__label,
    .app-sidebar .side-menu__item.active .angle { color: #fff !important; fill: #fff !important; }

    .app-sidebar .slide-item { border-radius: 6px; color: #64748b; transition: color .15s, background-color .15s; }
    .app-sidebar .slide-item:hover, .app-sidebar .slide-item.active { color: var(--mc-primary) !important; background: var(--mc-bg-soft); }
    .app-sidebar .angle { color: #cbd5e1; transition: transform .2s, color .15s; }
    .app-sidebar .slide:hover .angle, .app-sidebar .slide.is-expanded .angle { color: var(--mc-primary) !important; }

    /* ── MediCore: Header skin (applies to every role's header) ─────── */
    .main-header { box-shadow: 0 1px 2px rgba(15,23,42,.04); }
    .main-header-center .form-control { background: var(--mc-bg-soft); border: 1px solid var(--mc-border); border-radius: 30px; }
    .main-header-center .btn { color: var(--mc-muted); }
    .header-icon-svgs { color: #64748b; transition: color .15s; }
    .main-header-message > a, .main-header-notification > a, .nav-item.full-screen > a {
        border-radius: 50%; transition: background-color .15s;
    }
    .main-header-message > a:hover, .main-header-notification > a:hover, .nav-item.full-screen > a:hover {
        background: var(--mc-bg-soft);
    }
    .main-header-message > a:hover .header-icon-svgs,
    .main-header-notification > a:hover .header-icon-svgs { color: var(--mc-primary); }
    .main-header .dropdown-menu {
        border: 1px solid var(--mc-border); border-radius: 14px;
        box-shadow: 0 12px 32px rgba(15,23,42,.12); overflow: hidden;
    }
    .main-header .dropdown-menu .dropdown-item { border-radius: 8px; font-size: .85rem; }
    .main-header .dropdown-menu .dropdown-item:hover { background: var(--mc-bg-soft); color: var(--mc-primary); }
    .main-header .menu-header-content.bg-primary,
    .main-header .main-header-profile.bg-primary { background: var(--mc-primary) !important; }
    .main-header .dropdown-title-text.notif-count { background: rgba(255,255,255,.18); border-radius: 100px; padding: 1px 8px; }
</style>

