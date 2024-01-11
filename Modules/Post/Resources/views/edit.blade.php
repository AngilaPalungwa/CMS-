@extends('backend.layout.master')
@section('title', 'Post')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header ">
                    <span class="fs-4 fw-bold">Edit Post</span>
                </div>
                <div class="card-body">

                    <form action="{{ route('post.update',$post->id) }}" , method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name"> Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control"
                                placeholder="Enter your title" value="{{ $post->title }}">
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
                            <label for="name"> Description <span class="text-danger">*</span></label>
                            <textarea name="description" id="editor" cols="30" rows="10">{{ old('description') }}</textarea>
                            @if ($errors->first('description'))
                                <span style="color: red">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name"> Featured Image <span class="text-danger">*</span></label>
                            <input type="file" name="image" id="image" class="form-control"
                                placeholder="Enter  image" value="{{ $post->image }}" accept="images/jpeg, images/jpg, images/png">
                            @if ($errors->first('image'))
                                <span style="color: red">{{ $errors->first('image') }}</span>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
