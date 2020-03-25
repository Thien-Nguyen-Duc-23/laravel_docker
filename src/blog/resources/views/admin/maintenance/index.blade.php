@extends('admin.master.master')

@section('main-content')
    <div class="breadcrumb d-block">
        <ul>
            <li><a href="">Maintenance management</a></li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row d-flex justify-content-center">
        <div class="card mb-8">
            <div class="card-body">
                <h5 class="card-title border-bottom text-capitalize text-danger">Maintenance mode</h5>
                <form action="" method="POST">
                    @csrf
                    <p class="card-text"><strong class="h3">Change Mode:</strong> 
                        <label class="switch switch-warning mr-3">
                            <span>Maintenance</span>
                            <input type="checkbox" name="maintenanceMode" {{ $checked == true ? 'checked' : '' }}>
                            <span class="slider"></span>
                        </label>
                    </p>
                    <div class="form-group">
                        <label for="maintenanceContent">Content</label>
                        <input type="text" id="maintenanceContent" class="form-control" value="Xin lỗi bạn, trang web đang bảo trì, bạn vui lòng quay trở lại sau!!!" name="maintenanceContent">
                    </div>
                    <div>
                        <div class="d-flex justify-content-center col-md-12">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
