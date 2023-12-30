@extends('backend.layout.master')
@section('title', 'System Setting')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header ">
                    <span class="fs-4 fw-bold"> Users</span>
                </div>
                <div class="card-body">

                    <form action="{{ route('users.update') }}" , method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name"> Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Enter your name" value="">
                            @if ($errors->first('name'))
                                <span style="color: red">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="text" name="email" id="email" class="form-control"
                                placeholder="Enter your email" value="">
                            @if ($errors->first('email'))
                                <span style="color: red">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="address">Address <span class="text-danger">*</span></label>
                            <input type="text" name="address" id="address" class="form-control"
                                placeholder="Enter your address" value="">
                            @if ($errors->first('address'))
                                <span style="color: red">{{ $errors->first('address') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="designation">Designation <span class="text-danger">*</span></label>
                            <input type="text" name="designation" id="designation" class="form-control"
                                placeholder="Enter your designation" value="">
                            @if ($errors->first('designation'))
                                <span style="color: red">{{ $errors->first('designation') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="">Phone <span class="text-danger">*</span></label>
                            <input type="text" name="mobile" id="phpne" class="form-control"
                                placeholder="Enter your phone" value="">
                            @if ($errors->first('mobile'))
                                <span style="color: red">{{ $errors->first('phone') }}</span>
                            @endif

                        </div>


                        <div class="form-group">
                            <label for="name">Username<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" placeholder="Username" name="username"
                                 value="">
                            @if ($errors->first('username'))
                                <span style="color: red">{{ $errors->first('username') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="profile">Profile<span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="profile" placeholder="Profile" name="profile"
                                 value="">
                            @if ($errors->first('profile'))
                                <span style="color: red">{{ $errors->first('profile') }}</span>
                            @endif
                        </div>
                        {{-- <div class="form-group">
                            <label for="status">Status </label>
                            <select name="status" id="" class="form-control">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>

                        </div> --}}
                        <button type="submit" class="btn btn-info">Add Record</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
