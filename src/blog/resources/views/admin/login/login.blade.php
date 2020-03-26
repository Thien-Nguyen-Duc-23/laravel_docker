<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Review Book</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/lite-purple.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/styleAdmin.css') }}">
</head>
<body>
    <div class="auth-layout-wrap">
        <div class="auth-content">
            <div class="card o-hidden login">
                    <div class="col-md-12">
                        <div class="p-4">
                            <div class="auth-logo text-center mb-4">
                                <img src="{{ asset('admin/images/avatars/logo.png') }}" alt="">
                            </div>
                            <h1 class="mb-3 text-18">Login</h1>
                            @include('commons.errors')
                            <form action="{{ route('admin.login.submit') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input id="email" value="{{ old('email') }}" name="email" class="form-control form-control-rounded" type="email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" name="password" class="form-control form-control-rounded" type="password">
                                </div>
                                <button class="btn btn-rounded btn-primary btn-block mt-2">Login</button>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin/js/common-bundle-script.js') }}"></script>
    <script src="{{ asset('admin/js/script.js') }}"></script>
</body>
</html>
