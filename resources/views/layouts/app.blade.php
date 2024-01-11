<!DOCTYPE html>

<html lang="en">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    </head>

    <body>
        @yield('head')
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                
        
                <div class="layout-page">
                    
                    <div class="content-wrapper">
                        @yield('content')                 
                        <div class="content-backdrop fade"></div>
                    </div>
                </div>
            </div>
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>


    </body>
    @yield('script')
</html>