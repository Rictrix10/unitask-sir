<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="{{ URL::asset('assets/img/favicon/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <script src="{{ URL::asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ URL::asset('assets/js/config.js') }}"></script>
    @yield('head')
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            {{-- Remove or comment out the sidebar --}}
            {{-- @include('layouts.sidebar') --}}
            <div class="layout-page">
                {{-- Remove or comment out the navbar --}}
                {{-- @include('layouts.navbar') --}}
                <div class="content-wrapper">
                    @yield('content')                 
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <script src="{{ URL::asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ URL::asset('assets/bootstrap-5.3.2-dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ URL::asset('assets/vendor/js/menu.js') }}"></script>
    <script src="{{ URL::asset('assets/js/main.js') }}"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
@yield('script')

</html>
