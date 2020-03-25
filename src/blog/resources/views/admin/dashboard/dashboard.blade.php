@extends('admin.master.master')

@section('main-content')
    <div class="breadcrumb">
        <h1>Dashboard</h1>
    </div>
    <div class="separator-breadcrumb border-top">
    </div>
    <div class="row">
        <!-- ICON BG -->
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body text-center">
                    <i class="i-Add-User">
                    </i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">Users</p>
                        <p class="text-primary text-24 line-height-1 mb-2">{{ $totalUser }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body text-center">
                    <i class="i-Mail-Reply-All"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">Contacts</p>
                        <p class="text-primary text-24 line-height-1 mb-2">{{ $totalContact }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body text-center">
                    <i class="i-ID-Card"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">Categories</p>
                        <p class="text-primary text-24 line-height-1 mb-2">{{ $totalCategory }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
            <div class="card-body text-center">
                <i class="i-Big-Data"></i>
                <div class="content">
                    <p class="text-muted mt-2 mb-0">Books</p>
                    <p class="text-primary text-24 line-height-1 mb-2">{{ $totalBook }}</p>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title">This year access number
                    </div>
                    <div class="echartPie">
                        {!! $accessYear->container() !!}
                    </div>
                    {!! $accessYear->script() !!}
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title">Number of views per type
                    </div>
                    <div class="echartPie">
                        {!! $chart->container() !!}
                    </div>
                    {!! $chart->script() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="card card-chart-bottom o-hidden mb-4">
                        <div class="card-body">
                            <div class="card-title">Top 3 most watched books</div>
                        </div>
                        @foreach($topBookViews as $value)
                            @php
                                $image = $value->conver == 'default.png' ? asset('admin/images/no-image.png') : asset('storage/admin/books').'/'.$value->conver;
                            @endphp
                            <div class="d-flex flex-column flex-sm-row align-items-center mb-3">
                                <img class="avatar-lg mb-3 mb-sm-0 rounded mr-sm-3 set-conver-top" src="{{ $image }}" alt="{{ $value->conver }}">
                                <div class="flex-grow-1">
                                    <h5 class="">
                                        <a href="{{ route('books.show', $value->id) }}">{{ $value->title }}</a>
                                    </h5>
                                    <p> {{ $value->view_count }}
                                        <i class="far fa-eye"></i>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card card-chart-bottom o-hidden mb-4">
                        <div class="card-body">
                            <div class="card-title">Top 3 most rating books</div>
                        </div>
                        @foreach($topBookByRate as $value)
                            @php
                                $image = \Storage::disk('public')->exists('/admin/books/'.$value->conver) ? \Storage::url('admin/books/'.$value->conver) : asset('admin/images/no-image.png');
                            @endphp
                            <div class="d-flex flex-column flex-sm-row align-items-center mb-3">
                                <img class="avatar-lg mb-3 mb-sm-0 rounded mr-sm-3 set-conver-top" src="{{ $image }}" alt="{{ $value->conver }}">
                                <div class="flex-grow-1">
                                    <h5 class="">
                                        <a href="{{ route('books.show', $value->id) }}">{{ $value->title }}</a>
                                    </h5>
                                    @if ($value->star != 0)
                                        @php $rating = $value->star; @endphp
                                        @foreach(range(1,5) as $i)
                                            <span class="fa-stack" style="width:1em">
                                                <i class="far fa-star fa-stack-1x"></i>
                                                @if($rating >0)
                                                    @if($rating >0.5)
                                                        <i class="fas fa-star fa-stack-1x"></i>
                                                    @else
                                                        <i class="fas fa-star-half fa-stack-1x"></i>
                                                    @endif
                                                @endif
                                                @php $rating--; @endphp
                                            </span>
                                        @endforeach
                                    @else
                                        <span class="fa-stack" style="width:1em">
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card o-hidden mb-4">
                        <div class="card-header d-flex align-items-center border-0">
                            <h3 class="w-50 float-left card-title m-0">New Contacts</h3>
                            <div class="dropdown dropleft text-right w-50 float-right">
                                <a href="{{ route('contacts-admin.index') }}">
                                    <button class="btn btn-outline-primary btn-rounded btn-sm">Show more</button>
                                </a>
                            </div>
                        </div>
                        <div class="">
                            <div class="table-responsive">
                                <table id="user_table" class="table  text-center">
                                    <thead>
                                    <tr>
                                        <th scope="col">#
                                        </th>
                                        <th scope="col">Name
                                        </th>
                                        <th scope="col">Email
                                        </th>
                                        <th scope="col">Subject
                                        </th>
                                        <th scope="col">Status
                                        </th>
                                        <th scope="col">Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($contactNotActive as $index => $value)
                                            <tr id="{{ $value->id }}">
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $value->full_name }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->subject }}</td>
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
                                                            <i class="fas fa-unlock-alt" onClick="return ajaxActiveStatus({{ $value->id }}, 0, '{{ route("contacts.accept") }}')"></i>
                                                        </a>
                                                    @else
                                                        <a href="#" class="text-danger mr-2">
                                                            <i class="nav-icon i-Close-Window font-weight-bold" onClick="return ajaxActiveStatus({{ $value->id }}, 1, '{{ route("contacts.accept") }}')"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title">Top 5 most followed books
                    </div>
                    @foreach($topBooks as $value)
                        @php
                            $image = \Storage::disk('public')->exists('/admin/books/'.$value->book->conver) ? \Storage::url('admin/books/'.$value->book->conver) : asset('admin/images/no-image.png');
                        @endphp
                        <div class="d-flex flex-column flex-sm-row align-items-center mb-3">
                            <img class="avatar-lg mb-3 mb-sm-0 rounded mr-sm-3" src="{{ $image }}" alt="{{ $value->book->conver }}">
                            <div class="flex-grow-1">
                                <h5 class="">
                                    <a href="#">{{ $value->book->title }}</a>
                                </h5>
                                <p class="m-0 text-small text-muted">{{ $value->book->short_title }}</p>
                                <p class="text-small text-danger m-0 ">{{ $value->total }}
                                    <button class="btn btn-outline-primary btn-rounded btn-sm" style="margin-left: 10px;" data-toggle="modal" data-idbook="{{ $value->book_id }}" data-url_route="{{ route('admin.user_follow_book', $value->book_id) }}" data-target=".bd-example-modal-sm">Follow</button>
                                </p>
                            </div>
                            <div>
                                <a href="{{ route('books.show', $value->book_id) }}">
                                    <button class="btn btn-outline-primary btn-rounded btn-sm">View details</button>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body p-0">
                    <div class="card-header d-flex align-items-center border-0">
                        <h3 class="w-50 float-left card-title m-0">New Comments</h3>
                        <div class="dropdown dropleft text-right w-50 float-right">
                            <a href="{{ route('comments.index') }}">
                                <button class="btn btn-outline-primary btn-rounded btn-sm">Show more</button>
                            </a>
                        </div>
                    </div>
                    <div class="d-flex border-bottom justify-content-between p-3">
                        <div class="table-responsive">
                            <table id="user_table" class="table  text-center">
                                <thead>
                                <tr>
                                    <th scope="col">#
                                    </th>
                                    <th scope="col">Name
                                    </th>
                                    <th scope="col">Book
                                    </th>
                                    <th scope="col">Content
                                    </th>
                                    <th scope="col">Status
                                    </th>
                                    <th scope="col">Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($commentNonAccept as $index => $value)
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
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-1" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title style-td" id="exampleModalCenterTitle-1">List User Follow</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body list-user"></div>
            </div>
        </div>
    </div>
@endsection
