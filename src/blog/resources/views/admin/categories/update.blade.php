@extends('admin.master.master')

@section('main-content')
    <div class="breadcrumb">
        <ul>
            <li><a href="{{ route('categories.index') }}">Manage Category</a></li>
            <li>Update Category</li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('categories.update', $getCategory->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="firstName1">Category Name</label>
                                <input type="text" name="editCategoryName" value="{{ $getCategory->name }}" class="form-control" placeholder="Enter category name">
                                <input type="hidden" name="oldCategoryName" value="{{ $getCategory->name }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="picker1">Select the parent category</label>
                                <select name="parentCategory" class="form-control">
                                    <option value="">Default</option>
                                    @foreach ($getParentCategory as $item)
                                        <option value="{{ $item->id }}" {{ $getCategory->parent_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Upload Image</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn-default btn-primary btn-file">
                                                Browse… <input type="file" name="editCoverImage" id="imgInp">
                                            </span>
                                        </span>
                                        <input type="text" class="form-control" readonly>
                                    </div>
                                    <div class="box-image-upload">
                                        <div class="js--image-preview">
                                        @php
                                            $image = \Storage::disk('public')->exists('/admin/categories/'.$getCategory->cover) ? \Storage::url('admin/categories/'.$getCategory->cover) : asset('admin/images/no-image.png');
                                        @endphp
                                            <img id='img-upload' src="{{ $image }}" class="set-img"  />
                                        </div>
                                    </div>
                                    <input type="hidden" name="oldFile" value="{{ $getCategory->cover }}">
                                </div>
                            </div>
                            <div>
                                <div class="col-md-12">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
