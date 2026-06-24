<!-- main-header opened -->
@php
    $headerAuthedUser = null;
    foreach (['web', 'admin', 'doctor', 'ray_employee', 'laboratorie_employee', 'patient'] as $headerGuard) {
        if (Auth::guard($headerGuard)->check()) {
            $headerAuthedUser = Auth::guard($headerGuard)->user();
            break;
        }
    }
    $headerInitials = $headerAuthedUser
        ? \Illuminate\Support\Str::of($headerAuthedUser->name)->explode(' ')->map(fn ($w) => mb_substr($w, 0, 1))->take(2)->implode('')
        : '?';
@endphp
<div class="main-header sticky side-header nav nav-item">
    <div class="container-fluid">
        <div class="main-header-left ">
            <div class="responsive-logo">
                <a href="{{ url('/') }}" class="mc-brand-mark" style="color: var(--mc-dark);">
                    <span class="mark">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M19 8h-3V5a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v3H5a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h3v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3h3a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1z"/></svg>
                    </span>
                    MediCore
                </a>
            </div>
            <div class="app-sidebar__toggle" data-toggle="sidebar">
                <a class="open-toggle" href="#"><i class="header-icon fe fe-align-left"></i></a>
                <a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
            </div>
            <div class="main-header-center mr-3 d-sm-none d-md-none d-lg-block">
                <input class="form-control" placeholder="{{ trans('main-header_trans.search_placeholder') }}" type="search">
                <button class="btn"><i class="fas fa-search d-none d-md-block"></i></button>
            </div>
        </div>
        <div class="main-header-right">
            <ul class="nav">
                <li class="">
                    <div class="dropdown  nav-itemd-none d-md-flex">
                        <a href="#" class="d-flex  nav-item nav-link pl-0 country-flag1" data-toggle="dropdown"
                            aria-expanded="false">
                            @if (App::getLocale() == 'ar')
                                <span class="avatar country-Flag mr-0 align-self-center bg-transparent"><i class="flag-icon flag-icon-eg"></i></span>
                                <strong
                                    class="mr-2 ml-2 my-auto">{{ LaravelLocalization::getCurrentLocaleName() }}</strong>
                            @else
                                <span class="avatar country-Flag mr-0 align-self-center bg-transparent"><i class="flag-icon flag-icon-us"></i></span>
                                <strong
                                    class="mr-2 ml-2 my-auto">{{ LaravelLocalization::getCurrentLocaleName() }}</strong>
                            @endif
                            <div class="my-auto">
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow" x-placement="bottom-end">
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    @if ($properties['native'] == 'English')
                                        <i class="flag-icon flag-icon-us"></i>
                                    @elseif($properties['native'] == 'العربية')
                                        <i class="flag-icon flag-icon-eg"></i>
                                    @endif
                                    {{ $properties['native'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </li>
            </ul>
            <div class="nav nav-item  navbar-nav-right ml-auto">
                <div class="nav-link" id="bs-example-navbar-collapse-1">
                    <form class="navbar-form" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <span class="input-group-btn">
                                <button type="reset" class="btn btn-default">
                                    <i class="fas fa-times"></i>
                                </button>
                                <button type="submit" class="btn btn-default nav-link resp-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-search">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="dropdown nav-item main-header-message ">
                    <a class="new nav-link" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-mail">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                            </path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        <span class=" pulse-danger"></span></a>
                    <div class="dropdown-menu">
                        <div class="menu-header-content bg-primary text-right">
                            <div class="d-flex">
                                <h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">{{ trans('main-header_trans.messages') }}</h6>
                            </div>
                        </div>
                        <div class="main-message-list chat-scroll">
                            <div class="text-center text-muted p-4" style="font-size: .85rem;">
                                {{ trans('main-header_trans.no_new_messages') }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dropdown nav-item main-header-notification">
                    <a class="new nav-link" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-bell">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        <span class=" pulse"></span></a>
                    <div class="dropdown-menu dropdown-notifications">
                        <div class="menu-header-content bg-primary text-right">
                            <div class="d-flex">
                                <h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">{{ trans('main-header_trans.notifications') }}</h6>
                            </div>
                            @if(auth()->check())
                                <p data-count="{{ App\Models\Notification::CountNotification(auth()->user()->id)->count() }}"
                                    class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 notif-count">
                                    {{ App\Models\Notification::CountNotification(auth()->user()->id)->count() }}</p>
                            @else
                                <p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 notif-count">0</p>
                            @endif
                        </div>
                        <div class="main-notification-list Notification-scroll">
                            @if(auth()->check())
                                <div class="new_message">
                                    <a class="d-flex p-3 border-bottom" href="#">
                                        <div class="notifyimg bg-pink">
                                            <i class="la la-file-alt text-white"></i>
                                        </div>
                                        <div class="mr-3">
                                            <h4 class="notification-label mb-1"></h4>
                                            <div class="notification-subtext"></div>
                                        </div>
                                        <div class="mr-auto">
                                            <i class="las la-angle-left text-left text-muted"></i>
                                        </div>
                                    </a>
                                </div>

                                @php $unreadNotifications = App\Models\Notification::where('user_id', auth()->user()->id)->where('reader_status', 0)->get(); @endphp
                                @forelse ($unreadNotifications as $notification)
                                    <a class="d-flex p-3 border-bottom" href="#">
                                        <div class="notifyimg bg-pink">
                                            <i class="la la-file-alt text-white"></i>
                                        </div>
                                        <div class="mr-3">
                                            <h5 class="notification-label mb-1">{{ $notification->message }}</h5>
                                            <div class="notification-subtext">{{ $notification->created_at }}</div>
                                        </div>
                                        <div class="mr-auto">
                                            <i class="las la-angle-left text-left text-muted"></i>
                                        </div>
                                    </a>
                                @empty
                                    <div class="text-center text-muted p-4" style="font-size: .85rem;">
                                        {{ trans('main-header_trans.no_new_notifications') }}
                                    </div>
                                @endforelse
                            @endif
                        </div>
                    </div>
                </div>
                <div class="nav-item full-screen fullscreen-button">
                    <a class="new nav-link full-screen-link" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-maximize">
                            <path
                                d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3">
                            </path>
                        </svg>
                    </a>
                </div>
                <div class="dropdown main-profile-menu nav nav-item nav-link">
                    @if($headerAuthedUser)
                        <a class="profile-user d-flex" href="">
                            <span class="mc-avatar-initials" style="width: 34px; height: 34px; font-size: .85rem;">{{ $headerInitials }}</span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="main-header-profile bg-primary p-3">
                                <div class="d-flex wd-100p">
                                    <div class="main-img-user">
                                        <span class="mc-avatar-initials" style="width: 44px; height: 44px; font-size: 1rem;">{{ $headerInitials }}</span>
                                    </div>
                                    <div class="mr-3 my-auto">
                                        <h6>{{ $headerAuthedUser->name }}</h6><span>{{ $headerAuthedUser->email }}</span>
                                    </div>
                                </div>
                            </div>
                            @if (auth('web')->check())
                                <form method="POST" action="{{ route('logout.user') }}" id="logout-form">
                            @elseif(auth('admin')->check())
                                <form method="POST" action="{{ route('logout.admin') }}" id="logout-form">
                            @elseif(auth('doctor')->check())
                                <form method="POST" action="{{ route('logout.doctor') }}" id="logout-form">
                            @elseif(auth('ray_employee')->check())
                                <form method="POST" action="{{ route('logout.ray_employee') }}" id="logout-form">
                            @elseif(auth('laboratorie_employee')->check())
                                <form method="POST" action="{{ route('logout.laboratorie_employee') }}" id="logout-form">
                            @else
                                <form method="POST" action="{{ route('logout.patient') }}" id="logout-form">
                            @endif
                                @csrf
                                <a class="dropdown-item" href="#"
                                    onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();"><i
                                        class="bx bx-log-out"></i> {{ trans('main-header_trans.logout') }}</a>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

@vite('resources/js/app.js')


<script>
    var notificationsWrapper = $('.dropdown-notifications');
    var notificationsCountElem = notificationsWrapper.find('p[data-count]');
    var notificationsCount = parseInt(notificationsCountElem.data('count'));

    var notifications = notificationsWrapper.find('h4.notification-label');
    var new_message = notificationsWrapper.find('.new_message');
    new_message.hide();

    window.addEventListener('DOMContentLoaded', function() {
        @if(auth()->check())
            window.Echo.private('create-invoice.{{ auth()->user()->id }}').listen('.create-invoice', (data) => {
                var newNotificationHtml = `
           <h4 class="notification-label mb-1">` + data.message + data.patient + `</h4>
           <div class="notification-subtext">` + data.created_at + `</div>`;
                new_message.show();
                notifications.html(newNotificationHtml);
                notificationsCount += 1;
                notificationsCountElem.attr('data-count', notificationsCount);
                notificationsWrapper.find('.notif-count').text(notificationsCount);
                notificationsWrapper.show();

                console.log();

            });
        @endif
    });
</script>




<!-- /main-header -->
