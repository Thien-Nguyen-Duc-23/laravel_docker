@extends('admin.master.master')

@section('main-content')
    <div class="main-content">
        <div class="breadcrumb">
            <ul>
                <li><a href="{{ route("users.index") }}">Manage Users</a></li>
                <li>Insert User</li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="firstName1">Full name</label>
                                        <input type="text" name="fullName" value="{{ old('fullName') }}" class="form-control" placeholder="Enter your full name">
                                    </div>
                                    <div class="form-group">
                                        <label for="picker1">Gender</label>
                                        <select class="form-control" name="gender">
                                            <option value="{{ config('define.male') }}">Male</option>
                                            <option value="{{ config('define.female')}}">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="picker3">Birthday</label>
                                        <div class="input-group">
                                            <input class="form-control" name="birthday" type="date" value="{{ old('birthday') }}">
                                            <div class="input-group-append">
                                                <button class="btn btn-secondary" type="button">
                                                    <i class="icon-regular i-Calendar-4"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter email">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input class="form-control" name="phone" value="{{ old('phone') }}" placeholder="Enter phone">
                                    </div>
                                    <div class="form-group">
                                        <label for="credit1">Address</label>
                                        <input class="form-control" name="address" value="{{ old('address') }}" placeholder="Enter Address">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <img src="{{ asset('admin/images/avatars/default.png') }}" class="style-img"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group previewSubmit">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
