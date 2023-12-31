@extends('backend.layout.master')
@section('title', 'Category')


@section('content')
    @if (session()->has('success'))
        <div class="alert-success"> {{ session('success') }}</div>
    @endif

    @if (session()->has('error'))
        <div class="alert-danger"> {{ session('error') }}</div>
    @endif


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('category') }}">

                        <h3 class="card-title fw-bold text-dark">Category</h3>
                    </a>


                    <div class="card-tools">
                        <div class="row">
                            <div class="col">
                                <div class="input-group input-group-sm m-1" style="width: 175px;">
                                    <form action="{{ route('category') }}" method="GET">
                                        @csrf
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" name="search" class="form-control float-right" placeholder="Search" >
                                            </div>
                                            <div class="col input-group-append">
                                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div class="col">
                                <a href="{{ route('category.create') }}" class="float-end btn btn-info"><i
                                        class="fas fa-plus"></i><span class="hide-menu ps-2">Create Category </span></a>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                   <td>{{ $category->status }}</td>
                                    <td>
                                        <a href="{{ route('category.edit', $category->id) }} " class="btn btn-success">Edit</a>
                                        <a href="{{ route('category.delete', $category->id) }} " class="btn btn-danger">Delete</a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


@endsection
