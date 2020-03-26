@extends('admin.master.master')

@section('main-content')
    <div class="breadcrumb d-block">
        <ul>
            <li class="first-breadcumb"><a href="">Manage Category</a></li>
            <div class="float-right">
            <a href="{{ route('categories.create') }}" class="btn btn-success m-1">Insert</a>
            </div>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($items as $item)
                            <li class="list-group-item">
                                <div class="accordion" id="accordionCategory">
                                    <div class="card-header" id="heading{{ $item->id }}">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="{{ $item['children']->count() > 0 ? 'collapse' : ''}}" data-target="#collapse{{ $item->id }}" aria-controls="collapse{{ $item->id }}">
                                                {{ $item->name }}
                                            </button>
                                            <div class="float-right mt-2">
                                                <div class="d-inline-block">
                                                    <a href="{{ route('categories.edit', $item->id) }}" class="close text-success mr-2">
                                                        <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                    </a>
                                                </div>
                                                
                                                <div class="d-inline-block">
                                                    <form action="{{ route('categories.destroy', $item->id) }}" id="delForm-{{ $item->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button id="alert-confirm" type="button" onclick="checkDel({{ $item->id }})" class="close text-danger mr-2">
                                                            <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </h5>
                                    </div>
                
                                    <div id="collapse{{ $item->id }}" class="collapse" aria-labelledby="heading{{ $item->id }}" data-parent="#accordionCategory" style="">
                                        <div class="card-body">
                                            <ul class="list-group">
                                                @foreach($item['children'] as $child)
                                                    <li class="list-group-item"> {{ $child->name }}
                                                        <div class="float-right mt-2">
                                                            <div class="d-inline-block">
                                                                <a href="{{ route('categories.edit', $child->id) }}" class="close text-success mr-2">
                                                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                                </a>
                                                            </div>
                                                            <div class="d-inline-block">
                                                                <form action="{{ route('categories.destroy', $child->id) }}" id="delForm-{{ $child->id }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button id="alert-confirm" type="button" onclick="checkDel({{ $child->id }})" class="close text-danger mr-2">
                                                                        <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach                                               
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
