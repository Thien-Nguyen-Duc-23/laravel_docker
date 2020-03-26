<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Admin Review Book</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('admin/css/lite-purple.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/css/perfect-scrollbar.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/css/datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/css/styleAdmin.css') }}">
        <script src="{{ asset('admin/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('admin/ckfinder/ckfinder.js') }}"></script>
        <link rel="shortcut icon" type="image/png" href="{{ asset("fonts/font-awesome/css/all.css") }}"/>
        <style>
@import url(https://fonts.googleapis.com/icon?family=Material+Icons);
@import url("https://fonts.googleapis.com/css?family=Raleway");

.box-image-upload {
    display: block;
    width: 100%;
    height: 270px;
    margin-top: 10px;
    background-color: white;
    border-radius: 5px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    -webkit-transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    overflow: hidden;
}
.js--image-preview {
    height: 100%;
    width: 100%;
    position: relative;
    overflow: hidden;
    background-image: url("");
    background-color: white;
    background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;
}
.js--image-preview::after {
    content: "photo_size_select_actual";
    font-family: 'Material Icons';
    position: relative;
    font-size: 4.5em;
    color: #e6e6e6;
    top: calc(50% - 3rem);
    left: calc(50% - 2.25rem);
    z-index: 0;
}
.js--image-preview.js--no-default::after {
    display: none;
}
.js--image-preview:nth-child(2) {
    background-image: url("http://bastianandre.at/giphy.gif");
}

@-webkit-keyframes ripple {
    100% {
        opacity: 0;
        -webkit-transform: scale(2.5);
                transform: scale(2.5);
    }
}

@keyframes ripple {
    100% {
        opacity: 0;
        -webkit-transform: scale(2.5);
                transform: scale(2.5);
    }
}
</style>
    </head>
    <body>
        <div class="app-admin-wrap">
            <!-- header top menu start -->
            <div class="main-header">
                @include('admin.layouts.header')
            </div>
            <!-- header top menu end -->
            <!--=============== Left side Start ================-->
            <div class="side-content-wrap">
                @include('admin.layouts.sidebar')
            </div>
            <!--=============== Left side End ================-->
            <!-- ============ Body content start ============= -->
            <div class="main-content-wrap sidenav-open d-flex flex-column">

                @include('commons.errors')
                @yield('main-content')

                <!-- Footer Start -->
                <div class="flex-grow-1">
                </div>
                <div class="app-footer">
                @include('admin.layouts.footer')
                </div>
                <!-- fotter end -->
            </div>
            <!-- ============ Body content End ============= -->
        </div>
        <!--=============== End app-admin-wrap ================-->
        <script src="{{ asset('fonts/font-awesome/js/all.js') }}"></script>
        <script src="{{ asset('admin/js/common-bundle-script.js') }}"></script>
        <script src="{{ asset('admin/js/echarts.min.js') }}"></script>
        <script src="{{ asset('admin/js/echart.options.min.js') }}"></script>
        <script src="{{ asset('admin/js/dashboard.v1.script.js') }}"></script>
        <script src="{{ asset('admin/js/script.min.js') }}"></script>
        <script src="{{ asset('admin/js/datatables.min.js') }}"></script>
        <script src="{{ asset('admin/js/datatables.script.js') }}"></script>
        <script src="{{ asset('admin/js/sidebar.large.script.min.js') }}"></script>
        <script src="{{ asset('admin/js/sidebar-horizontal.script.js') }}"></script>
        <script src="{{ asset('admin/js/customizer.script.min.js') }}"></script>
        <script src="{{ asset('admin/js/script.js') }}"></script>
        <script src="{{ asset('admin/js/main.js') }}"></script>
        <script src="{{ asset('admin/js/ajax.js') }}"></script>
        <script src="{{ asset('admin/js/ckeditor.js') }}"></script>
        <script src="{{ asset('admin/js/chart.bundle.js') }}"></script>
        <script src="{{ asset('admin/js/pusher4.4.js') }}"></script>
        <script src="{{ asset('admin/js/notification.js') }}"></script>
    </body>
</html>
