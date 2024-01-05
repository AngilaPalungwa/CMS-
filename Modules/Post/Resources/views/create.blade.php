@extends('backend.layout.master')
@section('title', 'Post')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header ">
                    <span class="fs-4 fw-bold"> Post</span>
                </div>
                <div class="card-body">

                    <form action="{{ route('post.store') }}" , method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name"> Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control"
                                placeholder="Enter your title" value="">
                            @if ($errors->first('title'))
                                <span style="color: red">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name"> Category <span class="text-danger">*</span></label>
                            <select name="category_id" id="" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->first('category_id'))
                                <span style="color: red">{{ $errors->first('category_id') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name"> Author <span class="text-danger">*</span></label>
                            <input type="text" name="created_by" id="created_by" class="form-control"
                                placeholder="Enter  author" value="{{ old('created_by') }}">
                            @if ($errors->first('created_by'))
                                <span style="color: red">{{ $errors->first('created_by') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name"> Description <span class="text-danger">*</span></label>
                            <textarea name="description" id="editor" cols="30" rows="10"></textarea>
                            @if ($errors->first('description'))
                                <span style="color: red">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name"> Featured Image <span class="text-danger">*</span></label>
                            <input type="text" name="featured_image" id="featured_image" class="form-control"
                                placeholder="Enter  featured_image" value="">
                            @if ($errors->first('featured_image'))
                                <span style="color: red">{{ $errors->first('featured_image') }}</span>
                            @endif
                        </div>


                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select name="status" id="" class="form-control">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>

                        </div>
                        <button type="submit" class="btn btn-info">Add Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
