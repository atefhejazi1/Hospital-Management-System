<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="MediCore Hospital Management System">
    <meta name="Author" content="MediCore HMS">
    @include('Dashboard.layouts.head')

</head>

<body class="main-body app sidebar-mini">
    @include('Dashboard.layouts.main-sidebar')
    <!-- main-content -->
    <div class="main-content app-content">
        @include('Dashboard.layouts.main-header')
        <!-- container -->
        <div class="container-fluid">
            @yield('page-header')
            @yield('content')
            @include('Dashboard.layouts.footer')
            @include('Dashboard.layouts.footer-scripts')



</body>

</html>
