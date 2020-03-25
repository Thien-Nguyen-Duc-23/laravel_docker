@extends('admin.master.master')

@section('main-content')
    <div class="breadcrumb">
        <ul>
            <li><a href="">Manage Category</a></li>
            <li>Insert Category</li>
        </ul>
    </div>
    <div class="separator-breadcrumb border-top"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="categoryName">Category Name</label>
                                <input type="text" name="categoryName" value="{{ old('categoryName') }}" class="form-control" placeholder="Enter category name">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="parentCategory">Select the parent category</label>
                                <select name="parentCategory" class="form-control">
                                    <option value="">Default</option>
                                    @foreach ($getParentCategory as $item)
                                        <option value="{{ $item->id }}" {{ old('parentCategory') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label>Cover Image</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn-default btn-primary btn-file">
                                                Browse… <input type="file" name="coverImage" id="imgInp">
                                            </span>
                                        </span>
                                        <input type="text" class="form-control" readonly>
                                    </div>
                                    <div class="box-image-upload">
                                        <div class="js--image-preview">
                                            <img id='img-upload' class="set-img"/>
                                        </div>
                                    </div>
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
