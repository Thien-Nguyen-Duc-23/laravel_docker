@extends('admin.master.master')

@section('main-content')
    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('books.index') }}">Manage Book</a></li>
            <li>Edit Book</li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('books.update', $getBook->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="firstName1">Title</label>
                                    <input type="text" name="titleBook" value="{{ old('titleBook', $getBook->title) }}" class="form-control" placeholder="Enter title">
                                </div>
                                <div class="form-group">
                                    <label for="picker1">Select the category</label>
                                    <select name="categoryId" class="form-control">
                                        <option value="{{ $getBook->category->id }}">{{ $getBook->category->name }}</option>
                                        @foreach ($getChildrenCategory as $item)
                                            <option value="{{ $item->id }}" {{ old('categoryId') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="firstName1">Isbn</label>
                                    <input type="text" name="isbn" value="{{ old('isbn', $getBook->isbn) }}" class="form-control" placeholder="Enter Isbn">
                                </div>
                                <div class="form-group">
                                    <label for="firstName1">Description</label>
                                    <textarea type="text" name="descriptionBook" class="form-control" placeholder="Enter description" rows="9">{!! old('descriptionBook', $getBook->discription) !!}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="firstName1">Author</label>
                                    <input type="text" name="authorBook" value="{{ old('authorBook', $getBook->author) }}" class="form-control" placeholder="Enter author">
                                </div>
                                <div class="form-group">
                                    <label>Upload Image</label>
                                    <div class="input-group">
                                        <input type="hidden" name="oldFile" value="{{ $getBook->conver }}">
                                        <span class="input-group-btn">
                                            <span class=" btn-default btn-primary btn-file">
                                                Browse… <input type="file" id="imgInp" name="coverImage" value="{{ old('coverImage') }}">
                                            </span>
                                        </span>
                                        <input type="text" class="form-control" readonly value="{{ old('coverImage', $getBook->conver) }}">
                                    </div>
                                    <div class="box-image-upload">
                                        <div class="js--image-preview">
                                            @php
                                                $image = \Storage::disk('public')->exists('/admin/books/'.$getBook->conver) ? \Storage::url('admin/books/'.$getBook->conver) : asset('admin/images/no-image.png');
                                            @endphp
                                            <img id='img-upload' src="{{ $image }}" class="set-img"  />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="firstName1">Content</label>
                                    <textarea name="contentBook" id="editor1" class="form-control" placeholder="Enter Content" rows="20">{!! old('contentBook', $getBook->content) !!}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 table-style">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
