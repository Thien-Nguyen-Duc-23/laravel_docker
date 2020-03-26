@extends('client.layout.app')

@section('content')
    <div class="container-wrapper">
        <div class="tab">
            <button class="tablinks active" onclick="openTab(event, 'Profile')" id="defaultOpen">@lang('home.profile')</button>
            <button class="tablinks" onclick="openTab(event, 'Password')">@lang('home.lbPassword')</button>
        </div>
        <div id="Profile" class="tabcontent">
            <div class="alert alert-danger" id="alert-profile-fail" style="display:none"></div>
            <div class="alert alert-success" id="alert-profile-success" style="display:none"></div>
            <form method="POST" enctype="multipart/form-data">
                @csrf
                <div class="container" id="edit-profile">
                    <div class="row">
                    <div class="tie-col-md-12">
                        <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                            <div class="tie-col-md-12 lead">
                                @lang('home.editProfile')
                                <hr>
                            </div>
                            </div>
                            <div class="row">
                            <div class="tie-col-md-4 text-center">
                                @php
                                    $image = \Storage::disk('public')->exists('/admin/accounts/'.Auth::guard('client')->user()->userInformation->avatar) ? \Storage::url('admin/accounts/'.Auth::guard('client')->user()->userInformation->avatar) : asset('admin/images/no-image.png');
                                @endphp
                                <div id="img-preview-block" class="img-circle avatar avatar-original center-block" style="background-size:cover;
                                background-image:url({{ $image }})">
                                </div>
                                <br>
                                <span class="btn btn-link btn-file">@lang('home.editAvatar') <input type="file" name="avatarImage" id="upload-img"></span>
                            </div>
                            <div class="tie-col-md-8">
                                <div class="form-group">
                                    <label for="full_name">@lang('home.fullName')</label>
                                    <input name="user_full_name" value="{{ Auth::guard('client')->user()->userInformation->full_name }}" type="text" class="form-control" id="user_full_name">
                                </div>
                                <div class="form-group">
                                    <label for="user_email">@lang('home.lbEmail')</label>
                                    <input disabled value="{{ Auth::guard('client')->user()->userInformation->account->email }}" type="text" class="form-control" id="user_email">
                                </div>
                                <div class="form-group">
                                    <label for="user_address">@lang('home.address')</label>
                                    <input name="user_address" value="{{ Auth::guard('client')->user()->userInformation->address }}" type="text" class="form-control" id="user_address">
                                </div>
                                <div class="form-group">
                                    <label for="user_dob">@lang('home.dob')</label>
                                    <input name="user_dob" type="date" value="{{ Auth::guard('client')->user()->userInformation->date_of_birth }}" class="form-control" id="user_dob">
                                </div>
                                <div class="form-group">
                                    <label for="user_phone">@lang('home.phone')</label>
                                    <input name="user_phone" type="text" value="{{ Auth::guard('client')->user()->userInformation->phone }}" class="form-control" id="user_phone">
                                </div>
                                <div class="form-group">
                                    <label for="user_gender">@lang('home.gender')</label>
                                    <select name="user_gender" class="form-control" id="user_gender" name="gender">
                                        <option value="1" {{ Auth::guard('client')->user()->userInformation->gender == 1 ? 'selected' : '' }}>Male</option>
                                        <option value="0" {{ Auth::guard('client')->user()->userInformation->gender == 0 ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                            </div>
                            </div>
                            <div class="row">
                                <div class="tie-col-md-12">
                                    <hr>
                                    @php
                                        $id = Auth::guard('client')->user()->userInformation->id;
                                    @endphp
                                    <button type="button" onclick="return profile('{{ $id }}', '{{ route('profile.edit') }}')" class="button pull-right">@lang('home.btnSend')</button>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </form>
        </div>
        <div id="Password" class="tabcontent">
            <div class="alert alert-danger" id="alert-password-fail" style="display:none"></div>
            <div class="alert alert-success" id="alert-password-success" style="display:none"></div>
            <form method="POST" id="change-password">
                <div class="container" id="edit-profile">
                    <div class="row">
                    <div class="tie-col-md-12">
                        <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="tie-col-md-12 lead">
                                    @lang('home.changPass')
                                    <hr>
                                </div>
                            </div>
                            <div class="row" id="change-pass-form">
                                <div class="tie-col-md-8">
                                    <div class="form-group">
                                        <label for="current_password">@lang('home.lbPassword')</label>
                                        <input type="password"  class="form-control" id="current_password">
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password">@lang('home.lbPassword')</label>
                                        <input type="password" class="form-control" id="new_password">
                                    </div>
                                    <div class="form-group">
                                        <label for="user_phone">@lang('home.confirmPass')</label>
                                        <input type="password" class="form-control" id="confirm_password">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="tie-col-md-12">
                                    <hr>
                                    <button type="button" onclick="return changePassword('{{ $id }}', '{{ route('profile.change_password') }}')" class="button pull-right">@lang('home.btnSend')</button>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
