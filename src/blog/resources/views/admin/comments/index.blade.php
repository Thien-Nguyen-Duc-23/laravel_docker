@extends('admin.master.master') 

@section('main-content')
    <div class="breadcrumb">
        <h1>Manage Comments</h1>
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
                                                <table id="zero_configuration_table" class="display table table-striped table-bordered dataTable style-table" role="grid" aria-describedby="zero_configuration_table_info">
                                                    <thead>
                                                        <tr role="row">
                                                            <th>ID</th>
                                                            <th>User Name</th>
                                                            <th>Book</th>
                                                            <th>Comment</th>
                                                            <th>Status</th>
                                                            <th class="sorting_desc_disabled sorting_asc_disabled sorting disabled">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($comments as $index => $value)
                                                            <tr id="{{ $value->id }}">
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ $value->userInfo->full_name }}</td>
                                                                <td>{{ $value->book->title }}</td>
                                                                <td>{{ $value->content }}</td>
                                                                <td class="testRomeve{{ $value->id }}">
                                                                    @if($value->status == config('define.active'))
                                                                        <span class="badge badge-success">Accept</span>
                                                                    @else
                                                                        <span class="badge badge-warning">Non Accept</span>
                                                                    @endif
                                                                </td>   
                                                                <td class="style-td testRomeve{{ $value->id }}">
                                                                    @if($value->status == config('define.active'))
                                                                        <a href="#" class="text-success mr-2">
                                                                            <i class="fas fa-unlock-alt" onClick="return ajaxActiveStatus({{ $value->id }}, 0, '{{ route("comments.accept") }}')"></i>
                                                                        </a>
                                                                    @else
                                                                        <a href="#" class="text-danger mr-2">
                                                                            <i class="nav-icon i-Close-Window font-weight-bold" onClick="return ajaxActiveStatus({{ $value->id }}, 1, '{{ route("comments.accept") }}')"></i>
                                                                        </a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>User Name</th>
                                                            <th>Book</th>
                                                            <th>Comment</th>
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
