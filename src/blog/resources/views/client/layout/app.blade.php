<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link type="text/css" media="all" href="{{ asset("client/css/all.css") }}" rel="stylesheet" />
    <link rel='stylesheet' id='dashicons-css' href='{{ asset("client/css/dashicons.min.css") }}' type='text/css' media='all' />
    <link rel="shortcut icon" type="image/png" href="{{ asset("client/images/icon/favicon.png") }}"/>
    <link rel="shortcut icon" type="itext/css" href="{{ asset("fonts/font-awesome/css/all.css") }}"/>
    <link type="text/css" rel="stylesheet" href="{{ asset("client/css/custom.css") }}"/>
    <link type="text/css" rel="stylesheet" href="{{ asset("client/css/search.css") }}"/>
</head>
<body data-rsssl=1 id="tie-body" class="page-template-default page page-id-43392 woocommerce woocommerce-no-js wrapper-has-shadow block-head-8 magazine1 is-thumb-overlay-disabled is-desktop is-header-layout-1 has-builder hide_breaking_news">
    <div class="background-overlay">
        <div id="tie-container" class="site tie-container">
            <div id="tie-wrapper">
                @include('client.layout.header')

                @section('main')
                    <div id="content" class="site-content container">
                        <div class="tie-row main-content-row">
                            <div class="main-content tie-col-md-8 tie-col-xs-12" role="main">
                                @yield('content')
                            </div>

                            <aside class="sidebar tie-col-md-4 tie-col-xs-12 normal-side" aria-label="Primary Sidebar">
                                @include('client.layout.sidebar')
                            </aside>
                        </div>
                    </div>
                @show

                <footer id="footer" class="site-footer dark-skin dark-widgetized-area">
                    @include('client.layout.footer')
                </footer>
                <a id="go-to-top" class="go-to-top-button show-top-button" href="#"> <span class="fa fa-angle-up"></span> <span class="screen-reader-text">Back to top button</span> </a>
            </div>
        </div>
    </div>
    <div id="fb-root"></div>
    <div id="tie-popup-search-wrap" class="tie-popup">
        <a href="#" class="tie-btn-close remove big-btn light-btn"> <span class="screen-reader-text">Close</span> </a>
        <div class="container">
            <div class="popup-search-wrap-inner">
                <div class="tie-row">
                    <div id="pop-up-live-search" class="tie-col-md-12 live-search-parent" data-skin="live-search-popup" aria-label="Search">
                        <form method="get" id="tie-popup-search-form" action="//">
                            <input id="tie-popup-search-input" type="text" name="s" title="Tìm kiếm" autocomplete="off" placeholder="Gõ từ khóa bạn tìm kiếm" />
                            <button id="tie-popup-search-submit" type="submit"><span class="fa fa-search" aria-hidden="true"></span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('client/js/jquery.js') }}"></script>
    <script src="{{ asset('client/js/typeahead.js') }}"></script>
    <script src="{{ asset('client/js/search.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('fonts/font-awesome/js/all.js') }}"></script>
    <script src="{{ asset('client/js/main.js') }}"></script>
    <script src="{{ asset('client/js/follow.js') }}"></script>
    <script src="{{ asset('client/js/comment.js') }}"></script>
    <script src="{{ asset('client/js/rating.js') }}"></script>
    <script src="{{ asset('client/js/profile.js') }}"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-142314870-1"></script>
</body>
</html>
