@extends('layout.master')
@section('title', 'Dashboard')
@section('page-style')
<link rel="stylesheet" href="{{asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/plugins/charts-c3/plugin.css')}}" />
<link rel="stylesheet" href="{{asset('assets/plugins/morrisjs/morris.min.css')}}" />
@stop
@section('content')
    @if(\Illuminate\Support\Facades\Auth::user()->hasRole(['administrator','government']))
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon traffic">
                    <div class="body">
                        <h6>Farmers</h6>
                        <h2>{{$farmers->users_count}}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon sales">
                    <div class="body">
                        <h6>Processing Companies</h6>
                        <h2>{{$processing_companies->users_count}}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon email">
                    <div class="body">
                        <h6>Customers</h6>
                        <h2>{{$customers->users_count}}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon domains">
                    <div class="body">
                        <h6>Products</h6>
                        <h2>{{$products->count()}}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon traffic">
                    <div class="body">
                        <h6>User Ratings</h6>
                        <h2>{{$user_ratings->count()}}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon sales">
                    <div class="body">
                        <h6>Product Ratings</h6>
                        <h2>{{$product_ratings->count()}}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon email">
                    <div class="body">
                        <h6>Flagged Users</h6>
                        <h2>{{$userflags->count()}}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon domains">
                    <div class="body">
                        <h6>Flagged Products</h6>
                        <h2>{{$productflags->count()}}</h2>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(\Illuminate\Support\Facades\Auth::user()->hasRole(['farmer','processingcompany']))
        <div class="row clearfix">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon traffic">
                    <div class="body">
                        <h6>Products</h6>
                        <h2>{{$products->count()}}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon email">
                    <div class="body">
                        <h6>Orders</h6>
                        <h2>{{$total_orders}}</h2>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(\Illuminate\Support\Facades\Auth::user()->hasRole('customer'))
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon traffic">
                    <div class="body">
                        <h6>Orders</h6>
                        <h2>{{$orders->count()}}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon sales">
                    <div class="body">
                        <h6>Farmers</h6>
                        <h2>{{$farmers->users_count}}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon email">
                    <div class="body">
                        <h6>Products</h6>
                        <h2>{{$products->count()}}</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card widget_2 big_icon domains">
                    <div class="body">
                        <h6>Processing Companies</h6>
                        <h2>{{$processing_companies->users_count}}</h2>
                    </div>
                </div>
            </div>
        </div>
    @endif
@stop
@section('page-script')
<script src="{{asset('assets/bundles/jvectormap.bundle.js')}}"></script>
<script src="{{asset('assets/bundles/sparkline.bundle.js')}}"></script>
<script src="{{asset('assets/bundles/c3.bundle.js')}}"></script>
<script src="{{asset('assets/js/pages/index.js')}}"></script>
@stop
