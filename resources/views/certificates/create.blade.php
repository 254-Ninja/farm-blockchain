@extends('layout.master')
@section('title', 'Create Certificate')
@section('parentPageTitle', 'Certificates')
@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/footable-bootstrap/css/footable.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/footable-bootstrap/css/footable.standalone.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/dropify/css/dropify.min.css')}}"/>
@stop
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="body">
                    <form action="{{route('certificate.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf()
                        <h2 class="card-inside-title">Certificate Form</h2>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label" for="category">Member</label>
                                    <select name="member" class="form-control show-tick ms select2" required>
                                        <option value="">Select member to add certificate for</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name.' ( '.$user->roles->first()->name.' )'}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('member'))
                                        <span class="text-danger">{{ $errors->first('member') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="description">Description</label>
                                    <textarea class="form-control" name="description" placeholder="Enter certificate description"></textarea>
                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <p>Certificate File Upload</p>
                                    <input type="file" name="certificate" class="dropify form-control" data-allowed-file-extensions="pdf doc docx" data-max-file-size="2048K">
                                    @if ($errors->has('certificate'))
                                        <span class="text-danger">{{ $errors->first('certificate') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12 text-center">
                                <a href="{{route('certificate.index')}}" class="btn btn-default right_icon_toggle_btn">Back</a>
                                <button type="submit" class="btn btn-primary right_icon_toggle_btn">Upload</button>
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
@stop
