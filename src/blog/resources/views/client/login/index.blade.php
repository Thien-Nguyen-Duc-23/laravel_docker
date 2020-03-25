<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')
    </title>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}"/>
    <link rel="shortcut icon" type="image/png" href="{{ asset("fonts/font-awesome/css/all.css") }}"/>
    <link type="text/css" rel="stylesheet" href="{{ asset("client/css/login.css") }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">@lang('home.lbSignIn')</h5>
                        @include('commons.errors')
                        <form class="form-signin" action="{{ route('client.login') }}" method="POST">
                            @csrf
                            <div class="form-label-group">
                                <input type="email" id="inputEmail" class="form-control" placeholder="@lang('home.lbEmail')" autofocus name="email" value="{{ old('email') }}">
                                <label for="inputEmail">@lang('home.lbEmail')</label>
                            </div>
                            <div class="form-label-group">
                                <input type="password" id="inputPassword" class="form-control" placeholder="@lang('home.lbPassword')" name="password">
                                <label for="inputPassword">@lang('home.lbPassword')</label>
                            </div>
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">@lang('home.lbSignIn')</button>
                            <a class="d-block text-center mt-2 small" href="#">@lang('home.lblCreate')</a>
                            <hr class="my-4">
                            <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit">
                                <a href="{{ route('redirect') }}" class="text-uppercase">
                                    <i class="fab fa-facebook-f mr-2"></i> @lang('home.btnFaceboook')
                                </a>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('fonts/font-awesome/js/all.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
