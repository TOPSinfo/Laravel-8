<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @include('layouts.admin.header')
    </head>

    <body>
    <div id="app">
        <!-- Begin page -->
        <div id="wrapper">
            @include('layouts.admin.navbar')
            @include('layouts.admin.sidebar')
            <!-- Start Page Content here -->
            <div class="content-page">
                <div class="content">
                  @yield('content')
                </div>
            </div>
            <!-- End Page content -->
        </div>
        @include('layouts.admin.footer')
    </div>
    </body>
</html>
