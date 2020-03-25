@extends('admin.master.master')

@section('main-content')
    <div class="main-content">
        <div class="breadcrumb">
            <h1>User Profile</h1>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        @if (Auth::guard('admin')->check())
            <div class="card-body">
                <ul class="nav nav-tabs profile-nav mb-4" id="profileTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-selected="true">Change Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-selected="false">Change Password</a>
                    </li>
                </ul>

                <div class="tab-content" id="profileTabContent">
                    <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form action="{{ route('users.update', Auth::guard('admin')->user()->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="card user-profile o-hidden mb-4">
                                <div class="user-info">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' name="avatarImage" id="imageUpload" accept=".png, .jpg, .jpeg" />
                                            <label for="imageUpload"><i class="fas fa-pen pen2"></i></label>
                                        </div>
                                        <div class="avatar-preview">
                                            @php
                                                $image = \Storage::disk('public')->exists('/admin/accounts/'.Auth::guard('admin')->user()->userInformation->avatar) ? \Storage::url('admin/accounts/'.Auth::guard('admin')->user()->userInformation->avatar) : asset('admin/images/no-image.png');
                                            @endphp
                                            <div id="imagePreview" style="background-image: url('{{ $image }}');">
                                            </div>
                                        </div>
                                    </div>
                                    <p class="m-0 text-24">{{ Auth::guard('admin')->user()->userInformation->full_name }}</p>
                                    <p class="text-muted m-0">{{ Auth::guard('admin')->user()->role->name }}</p>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="profileTabContent">
                                        <div class="tab-pane fade active show" id="about" role="tabpanel" aria-labelledby="about-tab">
                                            <hr>
                                            <div class="row edit-tab">
                                                <div class="col-md-4 col-6">
                                                    <div class="mb-4">
                                                        <p class="text-primary mb-1"><i class="i-Checked-User text-16 mr-1"></i> Name</p>
                                                        <input type="text" name="fullName" value="{{ old('fullName', Auth::guard('admin')->user()->userInformation->full_name) }}" class="form-control edit-input" placeholder="Enter your full name">
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-primary mb-1"><i class="i-Calendar text-16 mr-1"></i> Birth Date</p>
                                                        <input type="date" name="birthday" value="{{ old('birthday', Auth::guard('admin')->user()->userInformation->date_of_birth) }}" class="form-control edit-input" placeholder="Enter your birthday">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-6">
                                                    <div class="mb-4">
                                                        <p class="text-primary mb-1"><i class="i-MaleFemale text-16 mr-1"></i> Gender</p>
                                                        <select class="form-control edit-input" name="gender">
                                                            <option value="{{ config('define.male') }}" {{ Auth::guard('admin')->user()->userInformation->gender == config('define.male') ? 'selected' : '' }}>Male</option>
                                                            <option value="{{ config('define.female') }}" {{ Auth::guard('admin')->user()->userInformation->gender == config('define.female') ? 'selected' : '' }}>Female</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-primary mb-1"><i class="i-Email text-16 mr-1"></i> Email</p>
                                                        <input type="text" name="email" value="{{ old('email', Auth::guard('admin')->user()->email) }}" class="form-control edit-input" placeholder="Enter your email">
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-primary mb-1"><i class="i-Edit-Map text-16 mr-1"></i> Address</p>
                                                        <input type="text" name="address" value="{{ old('address', Auth::guard('admin')->user()->userInformation->address) }}" class="form-control edit-input" placeholder="Enter your address">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-6">
                                                    <div class="mb-4">
                                                        <p class="text-primary mb-1"><i class="i-Face-Style-4 text-16 mr-1"></i> Profession</p>
                                                        <span>{{ Auth::guard('admin')->user()->role->name }}</span>
                                                    </div>
                                                    <div class="mb-4">
                                                        <p class="text-primary mb-1"><i class="fas fa-phone text-16 mr-1"></i> Phone</p>
                                                        <input type="text" name="phone" value="{{ old('phone', Auth::guard('admin')->user()->userInformation->phone) }}" class="form-control edit-input" placeholder="Enter your phone">
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group previewSubmit">
                                                        <button class="btn btn-primary" type="submit">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab" >
                        <h4>Please enter the information below.</h4>
                        <hr>
                        <form id="clear">
                            @csrf
                            <input id="urlChangePass" name="urlChangePass" value="{{ route('admin.change_password') }}" hidden>
                            <div class="alert alert-danger" style="display:none"></div>
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <p class="text-primary mb-1">Old Password</p>
                                        <input type="password" id="oldPassword" name="oldPassword" class="form-control" placeholder="Enter your old password">
                                    </div>
                                    <div class="form-group">
                                        <p class="text-primary mb-1"> New Password</p>
                                        <input type="password" id="newPassword" name="newPassword" class="form-control " placeholder="Enter your new password">
                                    </div>
                                    <div class="form-group">
                                        <p class="text-primary mb-1">Confirm Password</p>
                                        <input type="password" id="comfirmPassword" name="comfirmPassword" class="form-control" placeholder="Enter your comfrim password">
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group previewSubmit">
                                        <button class="btn btn-primary" id="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
