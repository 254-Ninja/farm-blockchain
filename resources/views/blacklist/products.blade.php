@extends('layout.master')
@section('title', 'Products Flag list')
@section('parentPageTitle', 'Products Flag List')
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
                            <th>Product</th>
                            <th>Customer</th>
                            <th>Reason</th>
                            <th>Filed</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($products->count())
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->product->name}}</td>
                                    <td>{{$product->customer->name}}</td>
                                    <td>{{$product->reason}}</td>
                                    <td>{{$product->created_at}}</td>
                                    <td>
                                        <a href="{{route('blacklist/product',$product->id)}}" class="btn btn-primary waves-effect waves-float btn-sm waves-red"> Blacklist</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">Ooops!! No product flags filed</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="body">
                    <div class="pagination pagination-primary m-b-0">
                        {{$products->links()}}
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
