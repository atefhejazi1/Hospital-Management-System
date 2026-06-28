<div class="main-sidemenu">
    <div class="app-sidebar__user clearfix">
        <div class="dropdown user-pro-body">
            @php
                $adminName = Auth::guard('admin')->user()->name;
                $adminInitials = \Illuminate\Support\Str::of($adminName)->explode(' ')->map(fn ($w) => mb_substr($w, 0, 1))->take(2)->implode('');
            @endphp
            <div class="text-center">
                <span class="avatar avatar-xl brround mc-avatar-initials" style="font-size: 1.1rem; margin: 0 auto;">{{ $adminInitials }}</span><span class="avatar-status profile-status bg-green"></span>
            </div>
            <div class="user-info">
                <h4 class="font-weight-semibold mt-3 mb-0">{{ $adminName }}</h4>
                <span class="mb-0 text-muted">{{ Auth::guard('admin')->user()->email }}</span><br>
                <span class="mc-role-tag">{{ trans('main-header_trans.role_admin') }}</span>
            </div>
        </div>
    </div>
    <ul class="side-menu">

        {{-- 1. Main Dashboard --}}
        <li class="side-item side-item-category">{{ trans('main-sidebar_trans.Main') }}</li>
        <li class="slide">
            <a class="side-menu__item" href="{{ route('dashboard.admin') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"/><path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/></svg>
                <span class="side-menu__label">{{ trans('main-sidebar_trans.index') }}</span>
            </a>
        </li>

        <li class="side-item side-item-category">{{ trans('main-sidebar_trans.management') }}</li>

        {{-- 2. Doctors Management --}}
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3.31 11l2.2 8.01L18.5 19l2.2-8H3.31zM12 17c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" opacity=".3"/><path d="M22 9h-4.79l-4.38-6.56c-.19-.28-.51-.42-.83-.42s-.64.14-.83.43L6.79 9H2c-.55 0-1 .45-1 1 0 .09.01.18.04.27l2.54 9.27c.23.84 1 1.46 1.92 1.46h13c.92 0 1.69-.62 1.93-1.46l2.54-9.27L23 10c0-.55-.45-1-1-1zM12 4.8L14.8 9H9.2L12 4.8zM18.5 19l-12.99.01L3.31 11H20.7l-2.2 8zM12 13c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg>
                <span class="side-menu__label">{{ trans('main-sidebar_trans.doctors') }}</span>
                <i class="angle fe fe-chevron-down"></i>
            </a>
            <ul class="slide-menu">
                <li><a class="slide-item" href="{{ route('Doctors.index') }}">{{ trans('main-sidebar_trans.view_all') }}</a></li>
                <li><a class="slide-item" href="{{ route('Doctors.create') }}">{{ trans('main-sidebar_trans.add_doctor') }}</a></li>
                <li><a class="slide-item" href="{{ route('Sections.index') }}">{{ trans('main-sidebar_trans.sections') }}</a></li>
            </ul>
        </li>

        {{-- 3. Patients Records --}}
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M6.26 9L12 13.47 17.74 9 12 4.53z" opacity=".3"/><path d="M19.37 12.8l-7.38 5.74-7.37-5.73L3 14.07l9 7 9-7zM12 2L3 9l1.63 1.27L12 16l7.36-5.73L21 9l-9-7zm0 11.47L6.26 9 12 4.53 17.74 9 12 13.47z"/></svg>
                <span class="side-menu__label">{{ trans('main-sidebar_trans.patients') }}</span>
                <i class="angle fe fe-chevron-down"></i>
            </a>
            <ul class="slide-menu">
                <li><a class="slide-item" href="{{ route('Patients.index') }}">{{ trans('main-sidebar_trans.view_all') }}</a></li>
                <li><a class="slide-item" href="{{ route('Patients.create') }}">{{ trans('main-sidebar_trans.add_patient') }}</a></li>
            </ul>
        </li>

        {{-- 4. Appointments --}}
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M5 5h4v4H5zm10 10h4v4h-4zM5 15h4v4H5zM16.66 4.52l-2.83 2.82 2.83 2.83 2.83-2.83z" opacity=".3"/><path d="M16.66 1.69L11 7.34 16.66 13l5.66-5.66-5.66-5.65zm-2.83 5.65l2.83-2.83 2.83 2.83-2.83 2.83-2.83-2.83zM3 3v8h8V3H3zm6 6H5V5h4v4zM3 21h8v-8H3v8zm2-6h4v4H5v-4zm8-2v8h8v-8h-8zm6 6h-4v-4h4v4z"/></svg>
                <span class="side-menu__label">{{ trans('main-sidebar_trans.appointments') }}</span>
                <i class="angle fe fe-chevron-down"></i>
            </a>
            <ul class="slide-menu">
                <li><a class="slide-item" href="{{ route('appointments.index') }}">{{ trans('main-sidebar_trans.appointments_list') }}</a></li>
                <li><a class="slide-item" href="{{ route('appointments.index2') }}">{{ trans('main-sidebar_trans.confirmed_appointments_list') }}</a></li>
            </ul>
        </li>

        {{-- 5. Invoicing & Finance --}}
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h15v3H5zm12 5h3v9h-3zm-7 0h5v9h-5zm-5 0h3v9H5z" opacity=".3"/><path d="M20 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h15c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM8 19H5v-9h3v9zm7 0h-5v-9h5v9zm5 0h-3v-9h3v9zm0-11H5V5h15v3z"/></svg>
                <span class="side-menu__label">{{ trans('main-sidebar_trans.invoicing') }}</span>
                <i class="angle fe fe-chevron-down"></i>
            </a>
            <ul class="slide-menu">
                <li><a class="slide-item" href="{{ route('single_invoices') }}">{{ trans('main-sidebar_trans.single_invoice') }}</a></li>
                <li><a class="slide-item" href="{{ route('group_invoices') }}">{{ trans('main-sidebar_trans.group_invoice') }}</a></li>
                <li><a class="slide-item" href="{{ route('Service.index') }}">{{ trans('main-sidebar_trans.Single_service') }}</a></li>
                <li><a class="slide-item" href="{{ route('Add_GroupServices') }}">{{ trans('main-sidebar_trans.group_services') }}</a></li>
                <li><a class="slide-item" href="{{ route('insurance.index') }}">{{ trans('main-sidebar_trans.Insurance') }}</a></li>
                <li><a class="slide-item" href="{{ route('Receipt.index') }}">{{ trans('main-sidebar_trans.receipt_voucher') }}</a></li>
                <li><a class="slide-item" href="{{ route('Payment.index') }}">{{ trans('main-sidebar_trans.payment_voucher') }}</a></li>
            </ul>
        </li>

        {{-- 6. Internal Modules --}}
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M13 4H6v16h12V9h-5V4zm3 14H8v-2h8v2zm0-6v2H8v-2h8z" opacity=".3"/><path d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"/></svg>
                <span class="side-menu__label">{{ trans('main-sidebar_trans.internal_modules') }}</span>
                <i class="angle fe fe-chevron-down"></i>
            </a>
            <ul class="slide-menu">
                <li><a class="slide-item" href="{{ route('laboratorie_employee.index') }}">{{ trans('main-sidebar_trans.lab_employees') }}</a></li>
                <li><a class="slide-item" href="{{ route('ray_employee.index') }}">{{ trans('main-sidebar_trans.ray_employees') }}</a></li>
                <li><a class="slide-item" href="{{ route('Ambulance.index') }}">{{ trans('main-sidebar_trans.ambulance') }}</a></li>
            </ul>
        </li>

    </ul>
</div>
