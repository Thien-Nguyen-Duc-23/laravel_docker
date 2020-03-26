@extends('admin.master.master')

@section('main-content')
    <div class="breadcrumb d-block">
        <ul>
            <li class="first-breadcumb"><a href="">Manage Book</a></li>
            <div class="float-right">
            <a href="{{ route('books.create') }}" class="btn btn-success m-1">Insert</a>
            </div>
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
                                                            <th>Cover</th>
                                                            <th>Title</th>
                                                            <th>Author</th>
                                                            <th>Isbn</th>
                                                            <th>Description</th>
                                                            <th>Category</th>
                                                            <th>Publisher</th>
                                                            <th>Status</th>
                                                            <th class="sorting_desc_disabled sorting_asc_disabled sorting disabled">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($getAllBook as $index => $value)
                                                            @php
                                                                $image = \Storage::disk('public')->exists('/admin/books/'.$value->conver) ? \Storage::url('admin/books/'.$value->conver) : asset('admin/images/no-image.png');
                                                            @endphp
                                                            <tr id="{{ $value->id }}">
                                                                <td>{{ $index + 1 }}</td>
                                                                <td><img src="{{ $image }}" class="config-img"/></td>
                                                                <td>{{ $value->title }}</td>
                                                                <td>{{ $value->author }}</td>
                                                                <td>{{ $value->isbn }}</td>
                                                                <td>{{ $value->discription }}</td>
                                                                <td>{{ $value->category->name }}</td>
                                                                <td>{{ $value->userInformation->full_name }}</td>
                                                                <td class="testRomeve{{ $value->id }}">
                                                                    @if($value->status == config('define.active'))
                                                                        <span class="badge badge-success">Active</span>
                                                                    @else
                                                                        <span class="badge badge-warning">Not Active</span>
                                                                    @endif
                                                                </td>
                                                                <td class="nav testRomeve{{ $value->id }}">
                                                                    <a class="text-infor mr-1">
                                                                        @if($value->status == config('define.active'))
                                                                            <i class="fas fa-unlock-alt" onClick="return ajaxActiveStatus({{ $value->id }}, 1, '{{ route("books.accept") }}')"></i>
                                                                        @else
                                                                            <i class="fas fa-user-lock" onClick="return ajaxActiveStatus({{ $value->id }}, 0, '{{ route("books.accept") }}')"></i>
                                                                        @endif
                                                                    </a>
                                                                    <a href="{{ route("books.show", $value->id) }}" class="text-info mr-1">
                                                                        <i class="fas fa-eye"></i>
                                                                    </a>
                                                                    <a href="{{ route("books.edit", $value->id) }}" class="text-success mr-1">
                                                                        <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                                    </a>
                                                                    <div class="d-inline-block">
                                                                        <form action="{{ route('books.destroy', $value->id) }}" id="delForm-{{ $value->id }}" method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <a class="text-danger mr-1">
                                                                                <i class="nav-icon i-Close-Window font-weight-bold remove" id="alert-confirm" onclick="checkDel({{ $value->id }})"></i>
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
                                                            <th>Cover</th>
                                                            <th>Title</th>
                                                            <th>Author</th>
                                                            <th>Isbn</th>
                                                            <th>Description</th>
                                                            <th>Category</th>
                                                            <th>publisher</th>
                                                            <th>Status</th>
                                                            <th class="sorting_desc_disabled sorting_asc_disabled sorting disabled">Action</th>
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
