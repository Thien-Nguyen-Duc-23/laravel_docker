@extends('admin.master.master')

@section('main-content')
    <div class="breadcrumb d-block">
        <ul>
            <li class="first-breadcumb"><a href="">Manage Users</a></li>
            @if (Auth::guard('admin')->user()->role_id == config('define.superAdmin'))
                <div class="float-right">
                    <a href="{{ route('users.create') }}" class="btn btn-success m-1">Insert</a>
                </div>
            @endif
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="zero_configuration_table_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="zero_configuration_table_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table id="zero_configuration_table" class="display table table-striped table-bordered dataTable table-style" role="grid" aria-describedby="zero_configuration_table_info">
                                                    <thead>
                                                        <tr role="row">
                                                            <th>ID</th>
                                                            <th>Avatar</th>
                                                            <th>Full Name</th>
                                                            <th>Email</th>
                                                            <th>Birthday</th>
                                                            <th>Gender</th>
                                                            <th>Phone</th>
                                                            <th>Address</th>
                                                            <th>Role</th>
                                                            <th>Status</th>
                                                            <th class="sorting_desc_disabled sorting_asc_disabled sorting disabled">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($getAllInformatons as $index => $value)
                                                            @php
                                                                $image = \Storage::disk('public')->exists('/admin/accounts/'.$value->userInformation->avatar) ? \Storage::url('admin/accounts/'.$value->userInformation->avatar) : asset('admin/images/no-image.png');
                                                            @endphp
                                                            <tr id="{{ $value->id }}">
                                                                <td>{{ $index + 1 }}</td>
                                                                <td><img src="{{ $image }}" class="config-img"/></td>
                                                                <td>{{ $value->userInformation->full_name }}</td>
                                                                <td>{{ $value->email }}</td>
                                                                <td>{{ $value->userInformation->date_of_birth }}</td>
                                                                <td>
                                                                    @if($value->userInformation->gender == config('define.male'))
                                                                        Male
                                                                    @else
                                                                        Female
                                                                    @endif
                                                                </td>
                                                                <td>{{ $value->userInformation->phone }}</td>
                                                                <td>{{ $value->userInformation->address }}</td>
                                                                <td>
                                                                    @if($value->role_id == config('define.admin'))
                                                                        <span class="badge badge-info">Admin</span>
                                                                    @else
                                                                        <span class="badge badge-warning">Users</span>
                                                                    @endif
                                                                </td>
                                                                <td class="testRomeve{{$value->id}}">
                                                                    @if($value->status == config('define.active'))
                                                                        <span class="badge badge-success">Active</span>
                                                                    @else
                                                                        <span class="badge badge-warning">Not Active</span>
                                                                    @endif
                                                                </td>
                                                                <td class="testRomeve{{ $value->id }}">
                                                                    <a class="text-infor mr-1">
                                                                        @if($value->status == config('define.active'))
                                                                            <i class="fas fa-unlock-alt" onClick="return ajaxActiveStatus({{ $value->id }}, 1, '{{ route("updateStatus") }}')"></i>
                                                                        @else
                                                                            <i class="fas fa-user-lock" onClick="return ajaxActiveStatus({{ $value->id }}, 0, '{{ route("updateStatus") }}')"></i>
                                                                        @endif
                                                                    </a>
                                                                    <a href="#" class="text-info mr-1">
                                                                        <i class="fas fa-eye"></i>
                                                                    </a>
                                                                    <a href="{{ route("users.edit", $value->id) }}" class="text-success mr-1">
                                                                        <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                                    </a>
                                                                    <div class="d-inline-block">
                                                                        <form action="{{ route('users.destroy', $value->id) }}" id="delForm-{{ $value->id }}" method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <a href="#" class="text-danger mr-1">
                                                                                <i class="nav-icon i-Close-Window font-weight-bold remove" onclick="checkDel({{ $value->id }})"></i>
                                                                            </a>
                                                                        </form>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Avatar</th>
                                                            <th>Full Name</th>
                                                            <th>Email</th>
                                                            <th>Birthday</th>
                                                            <th>Gender</th>
                                                            <th>Phone</th>
                                                            <th>Address</th>
                                                            <th>Role</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
