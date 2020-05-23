@extends('layout.master')
@section('title', 'Products List')
@section('parentPageTitle', 'Products')
@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/footable-bootstrap/css/footable.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/footable-bootstrap/css/footable.standalone.min.css')}}">
@stop
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="table-responsive">
                    @permission('create-products')
                    <a class="btn btn-primary float-right right_icon_toggle_btn" href="{{route('product.create')}}"><i class="zmdi zmdi-plus"></i> Add Product</a>
                    @endpermission
                    <table class="table table-hover product_item_list c_table theme-color mb-0">
                        <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Location</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($products->count())
                            @foreach($products as $product)
                                <tr>
                                    <td><img src="{{asset($product->photo)}}" width="48" alt="Product img"></td>
                                    <td><h5>{{$product->name}}</h5></td>
                                    <td>{{$product->category}}</td>
                                    <td>{{$product->location}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->status}}</td>
                                    <td>
                                        <a href="{{route('product.show',$product->id)}}" class="btn btn-primary waves-effect waves-float btn-sm waves-green"> View</a>
                                        @if($product->status == 'Unverified' && \Illuminate\Support\Facades\Auth::user()->hasRole('government'))
                                            <a href="{{route('product/verify',$product->id)}}" class="btn btn-success waves-effect waves-float btn-sm waves-green"> Verify</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">Ooops!! No products found. Please add a product category</td>
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
