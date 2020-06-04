@extends('layout.master')
@section('title', 'Create Category')
@section('parentPageTitle', 'Products')
@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/footable-bootstrap/css/footable.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/footable-bootstrap/css/footable.standalone.min.css')}}">
@stop
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="body">
                    <form action="{{route('product_category.store')}}" method="POST">
                        @csrf()
                        <h2 class="card-inside-title">Products Category Form</h2>
                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="control-label" for="name">Category Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter category name" />
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="display_name">Category Display Name</label>
                                    <input type="text" name="display_name" class="form-control" placeholder="Enter a display name" />
                                    @if ($errors->has('display_name'))
                                        <span class="text-danger">{{ $errors->first('display_name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12 text-center">
                                <a href="{{route('product_category.index')}}" class="btn btn-default right_icon_toggle_btn">Back</a>
                                <button type="submit" class="btn btn-primary right_icon_toggle_btn">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('page-script')
    <script src="{{asset('assets/bundles/footable.bundle.js')}}"></script>
    <script src="{{asset('assets/js/pages/tables/footable.js')}}"></script>
@stop
