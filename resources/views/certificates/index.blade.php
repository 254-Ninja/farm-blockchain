@extends('layout.master')
@section('title', 'Certificates List')
@section('parentPageTitle', 'Certificates')
@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/footable-bootstrap/css/footable.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/footable-bootstrap/css/footable.standalone.min.css')}}">
@stop
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="table-responsive">
                    @permission('create-certificates')
                        <a class="btn btn-primary float-right right_icon_toggle_btn" href="{{route('certificate.create')}}"><i class="zmdi zmdi-plus"></i> Add Certificate</a>
                    @endpermission
                    <table class="table table-hover product_item_list c_table theme-color mb-0">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Member</th>
                                <th>Membership Type</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($certificates->count())
                                @foreach($certificates as $certicate)
                                    <tr>
                                        <td>{{$certicate->description}}</td>
                                        <td>{{$certicate->user->name}}</td>
                                        <td>{{$certicate->user->roles->first()->name}}</td>
                                        <td>{{$certicate->status}}</td>
                                        <td>{{$certicate->created_at}}</td>
                                        <td>
                                            @if($certicate->status == 'Unverified')
                                                <a href="{{route('certificate/verify',$certicate->id)}}" class="btn btn-success waves-effect waves-float btn-sm waves-green"> Verify</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">Ooops!! No certificates found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="body">
                    <ul class="pagination pagination-primary m-b-0">
                        <li class="page-item"><a class="page-link" href="javascript:void(0);"><i class="zmdi zmdi-arrow-left"></i></a></li>
                        <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);">4</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0);"><i class="zmdi zmdi-arrow-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop
@section('page-script')
    <script src="{{asset('assets/bundles/footable.bundle.js')}}"></script>
    <script src="{{asset('assets/js/pages/tables/footable.js')}}"></script>
@stop
