@extends('backend.layout.master')
@section('title', 'System Setting')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header ">
                    <span class="fs-4 fw-bold"> Settings</span>
                </div>
                <div class="card-body">

                    <form action="{{ route('system.setting.update') }}" , method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name"> Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Enter your name" value="{{ \App\Utils\SettingUtils::get('system_name') }}">
                            @if ($errors->first('name'))
                                <span style="color: red">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="text" name="email" id="email" class="form-control"
                                placeholder="Enter your email" value="{{ \App\Utils\SettingUtils::get('system_email') }}">
                            @if ($errors->first('email'))
                                <span style="color: red">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="">Phone <span class="text-danger">*</span></label>
                            <input type="text" name="phone" id="phpne" class="form-control"
                                placeholder="Enter your phone" value="{{ \App\Utils\SettingUtils::get('system_phone') }}">
                            @if ($errors->first('phone'))
                                <span style="color: red">{{ $errors->first('phone') }}</span>
                            @endif

                        </div>


                        <div class="form-group">
                            <label for="name">Footer</label>
                            <input type="text" class="form-control" id="name" placeholder="Footer" name="footer"
                                 value="{{ \App\Utils\SettingUtils::get('system_footer') }}">
                            @if ($errors->first('footer'))
                                <span style="color: red">{{ $errors->first('footer') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="logo">Upload logo </label>
                            <input type="file" name="logo" id="logo" class="form-control">

                        </div>
                        <button type="submit" class="btn btn-info">Add Record</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
