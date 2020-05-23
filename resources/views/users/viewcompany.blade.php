@extends('layout.master')
@section('title', 'Company Profile')
@section('parentPageTitle', 'Company Profile')
@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/footable-bootstrap/css/footable.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/footable-bootstrap/css/footable.standalone.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/dropify/css/dropify.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}"/>
@stop
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="body">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf()
                        <h2 class="card-inside-title"> Details</h2>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label" for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{$user->name}}" readonly/>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="name">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{$user->email}}" readonly/>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="name">Phone</label>
                                    <input type="text" name="phone" class="form-control" value="{{$user->phone_number}}" readonly/>
                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="name">Location</label>
                                    <input type="text" name="location" class="form-control" value="{{$user->location}}" readonly/>
                                    @if ($errors->has('location'))
                                        <span class="text-danger">{{ $errors->first('location') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="name">Product Category</label>
                                    <input type="text" name="name" class="form-control" value="{{$user->productCategory->name}}" readonly/>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <p>User Photo</p>
                                    <input type="file" name="profile_pic" class="dropify" data-allowed-file-extensions="jpg jpeg png" data-default-file="{{($user->profile_pic)?url($user->profile_pic):''}}" data-max-file-size="2048K" disabled>
                                    @if ($errors->has('profile_pic'))
                                        <span class="text-danger">{{ $errors->first('profile_pic') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12 text-center">
                                <a href="{{route('processingcompanies')}}" class="btn btn-default right_icon_toggle_btn">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('page-script')
    <script src="{{asset('assets/plugins/dropify/js/dropify.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/forms/dropify.js')}}"></script>
    <script src="{{asset('assets/plugins/momentjs/moment.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>
    <script src="{{asset('assets/js/pages/forms/basic-form-elements.js')}}"></script>
@stop
