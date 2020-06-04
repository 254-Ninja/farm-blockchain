@extends('layout.master')
@section('title', 'Users Blacklist')
@section('parentPageTitle', 'Blacklist')
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
                            <th>User</th>
                            <th>Customer</th>
                            <th>Reason</th>
                            <th>Filed</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($users->count())
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->user->name}}</td>
                                    <td>{{$user->customer->name}}</td>
                                    <td>{{$user->reason}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td>
                                        <a href="{{route('blacklist/user',$user->user_id)}}" class="btn btn-primary waves-effect waves-float btn-sm waves-red"> Blacklist</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">Ooops!! No user flags filed</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="body">
                    <div class="pagination pagination-primary m-b-0">
                        {{$users->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('page-script')
    <script src="{{asset('assets/bundles/footable.bundle.js')}}"></script>
    <script src="{{asset('assets/js/pages/tables/footable.js')}}"></script>
@stop
