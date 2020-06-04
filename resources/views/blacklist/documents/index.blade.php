@extends('layout.master')
@section('title', 'Blacklist Documents')
@section('parentPageTitle', 'Blacklist Documents')
@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/footable-bootstrap/css/footable.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/footable-bootstrap/css/footable.standalone.min.css')}}">
@stop
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="table-responsive">
                    @permission('create-blacklist_document')
                    <a class="btn btn-primary float-right right_icon_toggle_btn" href="{{route('certificate.create')}}"><i class="zmdi zmdi-plus"></i> Add Document</a>
                    @endpermission
                    <table class="table table-hover product_item_list c_table theme-color mb-0">
                        <thead>
                        <tr>
                            <th>Entity name</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($blacklists->count())
                            @foreach($blacklists as $blacklist)
                                @if($blacklist->category == 'Product')
                                    <tr>
                                        <td>{{$blacklist->entity->name}}</td>
                                        <td>{{$blacklist->category}}</td>
                                        <td>{{$blacklist->status}}</td>
                                        <td>
                                            <a href="{{route('blacklist.documents',$blacklist->id)}}" class="btn btn-primary waves-effect waves-float btn-sm waves-blue-grey"> View</a>
                                        </td>
                                    </tr>

                                @else
                                    <tr>
                                        <td>{{$blacklist->entity->name}}</td>
                                        <td>{{$blacklist->entity->roles->first()->name}}</td>
                                        <td>{{($blacklist->verified)?'':'Blacklisted'}}</td>
                                        <td>
                                            <a href="{{route('blacklist.documents',$blacklist->id)}}" class="btn btn-primary waves-effect waves-float btn-sm waves-blue-grey"> View</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">Ooops!! No blacklisted entities found.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="body">
                    <div class="pagination pagination-primary m-b-0">
                        {{$blacklists->links()}}
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
