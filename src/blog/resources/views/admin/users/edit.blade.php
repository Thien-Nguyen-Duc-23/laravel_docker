@extends('admin.master.master')

@section('main-content')
    <div class="main-content">
        <div class="breadcrumb">
            <ul>
                <li><a href="{{ route('users.index') }}">Manage Users</a></li>
                <li>Edit User</li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="{{ route('users.update', $getInformation->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="firstName1">Full name</label>
                                        <input type="text" name="fullName" value="{{ old('fullName', $getInformation->userInformation->full_name) }}" class="form-control" placeholder="Enter your full name">
                                    </div>
                                    <div class="form-group">
                                        <label for="picker1">Gender</label>
                                        <select class="form-control" name="gender">
                                            <option value="{{ config('define.male') }}" {{ $getInformation->userInformation->gender == config('define.male') ? 'selected' : '' }}>Male</option>
                                            <option value="{{ config('define.female') }}" {{ $getInformation->userInformation->gender == config('define.female') ? 'selected' : '' }}>Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="picker3">Birthday</label>
                                        <div class="input-group">
                                            <input class="form-control" name="birthday" type="date" value="{{ old('birthday', $getInformation->userInformation->date_of_birth) }}">
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
                                        <input class="form-control" name="email1" value="{{ $getInformation->email }}" placeholder="Enter email" disabled>
                                        <input class="form-control" name="email" value="{{ $getInformation->email }}" placeholder="Enter email" hidden>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input class="form-control" name="phone" value="{{ old('phone', $getInformation->userInformation->phone) }}" placeholder="Enter phone">
                                    </div>
                                    <div class="form-group">
                                        <label for="credit1">Address</label>
                                        <input class="form-control" name="address" value="{{ old('address', $getInformation->userInformation->address) }}" placeholder="Enter Address">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Upload Image</label>
                                        <div class="input-group">
                                            <input type="hidden" name="oldFile" value="{{ $getInformation->userInformation->avatar }}">
                                            <span class="input-group-btn">
                                                <span class="btn-default btn-primary btn-file">
                                                    Browse… <input type="file" id="imgInp" name="avatarImage" value="{{ old('avatarImage') }}">
                                                </span>
                                            </span>
                                            <input type="text" class="form-control" readonly value="{{ old('avatarImage', $getInformation->userInformation->avatar) }}">
                                        </div>
                                        <div class="box-image-upload">
                                            <div class="js--image-preview">
                                                @php
                                                    $image = \Storage::disk('public')->exists('/admin/accounts/'.$getInformation->userInformation->avatar) ? \Storage::url('admin/accounts/'.$getInformation->userInformation->avatar) : asset('admin/images/no-image.png');
                                                @endphp
                                                <img id='img-upload' src="{{ $image }}" class="set-img"/>
                                            </div>
                                        </div>
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
