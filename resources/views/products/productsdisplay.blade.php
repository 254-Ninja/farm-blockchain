@extends('layout.master')
@section('title', 'Products List')
@section('parentPageTitle', 'Products')
@section('content')
    <div class="row clearfix">
        @if($products->count()>0)
            @foreach($products as $product)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                    <div class="card">
                        <div class="body product_item">
                            <span class="label onsale">Sale!</span>
                            <a href="{{route('product.show',$product->id)}}"><img src="{{asset($product->photo)}}" alt="Product" class="img-fluid cp_img" /></a>
                            <div class="product_details">
                                <a href="{{route('product.show',$product->id)}}">{{$product->name}}</a>
                                <ul class="product_price list-unstyled">
                                    <li class="new_price">Ksh. {{number_format($product->price,2)}}</li>
                                </ul>
                            </div>
                            <div class="action">
                                <a href="{{route('product.show',$product->id)}}" class="btn btn-info waves-effect"><i class="zmdi zmdi-eye"></i> View</a>
                                <a href="javascript:void(0);" class="btn btn-primary waves-effect">ADD TO CART</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        <div class="col-md-12 text-center">
            {{$products->links()}}
        </div>
    </div>
@stop
