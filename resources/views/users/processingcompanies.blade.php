@extends('layout.master')
@section('title', 'Processing Companies List')
@section('parentPageTitle', 'Processing Companies')
@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/footable-bootstrap/css/footable.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/footable-bootstrap/css/footable.standalone.min.css')}}">
@stop
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover product_item_list c_table theme-color mb-0">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Location</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($companies->users()->count())
                            @foreach($company->users as $user)
                                <tr>
                                    <td>{{$user->user->name}}</td>
                                    <td>{{$user->user->email}}</td>
                                    <td>{{$user->user->location}}</td>
                                    <td>
                                        <a href="{{route('processingcompany.show',$user->user->id)}}" class="btn btn-primary waves-effect waves-float btn-sm waves-blue-grey"> View</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">Ooops!! No processing companies found.</td>
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
