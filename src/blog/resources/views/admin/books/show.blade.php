@extends('admin.master.master')

@section('main-content')
    <div class="breadcrumb">
        <ul>
            <li><a href="">Manage Book</a></li>
            <li>Show Detail Book</li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="firstName1">Title</label>
                                <input type="text" name="titleBook" value="{{ $getBook->title }}" class="form-control" placeholder="Enter title" disabled>
                            </div>
                            <div class="form-group">
                                <label for="picker1">Select the category</label>
                                <input type="text" name="titleBook" value="{{ $getBook->category->name }}" class="form-control" placeholder="Enter title" disabled>
                            </div>
                            <div class="form-group">
                                <label for="firstName1">Isbn</label>
                                <input type="text" name="isbn" value="{{ $getBook->isbn }}" class="form-control" placeholder="Enter Isbn" disabled>
                            </div>
                            <div class="form-group">
                                <label for="firstName1">Description</label>
                                <textarea type="text" name="descriptionBook" class="form-control" placeholder="Enter description" rows="5" disabled>{!! $getBook->discription !!}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="firstName1">Author</label>
                                <input type="text" name="authorBook" value="{{ $getBook->author }}" class="form-control" placeholder="Enter author" disabled>
                            </div>
                            <div class="form-group">
                                <label>Cover</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" disabled value="{{ old('coverImage', $getBook->conver) }}">
                                </div>
                                @php
                                    $image = \Storage::disk('public')->exists('/admin/books/'.$getBook->conver) ? \Storage::url('admin/books/'.$getBook->conver) : asset('admin/images/no-image.png');
                                @endphp
                                <img id='img-upload' src="{{ $image }}" class="set-img"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="firstName1">Content</label>
                                <textarea name="contentBook" id="editor1" class="form-control" placeholder="Enter Content" rows="20" readonly>{!! $getBook->content !!}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
