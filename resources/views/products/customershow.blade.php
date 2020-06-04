@extends('layout.master')
@section('title', 'View Product')
@section('parentPageTitle', 'Products')
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="body">
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-12">
                            <div class="preview preview-pic tab-content">
                                <div class="tab-pane active" id="product_1"><img src="{{asset($product->photo)}}" class="img-fluid" alt="" /></div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-8 col-md-12">
                            <div class="product details">
                                <h3 class="product-title mb-0">{{$product->name}}</h3>
                                <h5 class="price mt-0">Price: <span class="col-amber">Ksh. {{number_format($product->price,2)}}</span></h5>
                                <div class="rating">
                                    <div class="stars">
                                        <span class="zmdi zmdi-star col-amber"></span>
                                        <span class="zmdi zmdi-star col-amber"></span>
                                        <span class="zmdi zmdi-star col-amber"></span>
                                        <span class="zmdi zmdi-star col-amber"></span>
                                        <span class="zmdi zmdi-star-outline"></span>
                                    </div>
                                    <span class="m-l-10">41 reviews</span>
                                </div>
                                <hr>
                                <p class="product-description">{{$product->description}}</p>

                                <div class="action">
                                    <button class="btn btn-primary waves-effect" type="button"><i class="zmdi zmdi-shopping-cart"></i> BUY</button>
                                    <button class="btn btn-info waves-effect" type="button"><i class="zmdi zmdi-favorite"></i></button>
                                    <a href="{{route('product.index')}}" class="btn btn-default right_icon_toggle_btn">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="body row">
                    <h2 class="card-inside-title col-md-12">Product Details</h2>
                    <div class="tab-content col-md-12">
                        <div class="tab-pane active">
                            <div class="col-md-4 float-left">
                                <p><div class="col-md-6 float-left font-weight-bolder">Name: </div><div class="col-md-6 float-left">{{$product->name}}</div></p>
                                <p><div class="col-md-6 float-left font-weight-bolder">Category: </div><div class="col-md-6 float-left">{{$product->category}}</div></p>
                                <p><div class="col-md-6 float-left font-weight-bolder">Price: </div><div class="col-md-6 float-left">Ksh. {{number_format($product->price,2)}}</div></p>
                                <p><div class="col-md-6 float-left font-weight-bolder">Unit of Measure: </div><div class="col-md-6 float-left">{{$product->unit_of_measure}}</div></p>
                                <p><div class="col-md-6 float-left font-weight-bolder">Quantity: </div><div class="col-md-6 float-left">{{$product->quantity.' '.$product->unit_of_measure.'(s)'}}</div></p>
                                <p><div class="col-md-6 float-left font-weight-bolder">Bar Code: </div><div class="col-md-6 float-left">{{$product->bar_code}}</div></p>
                            </div>
                            @if($product->category == 'Farm')
                                <div class="col-md-4 float-left">
                                    <p><div class="col-md-6 float-left font-weight-bolder">Seed Name: </div><div class="col-md-6 float-left">{{$product->extra['seedname']}}</div></p>
                                    <p><div class="col-md-6 float-left font-weight-bolder">Seed Company: </div><div class="col-md-6 float-left">{{$product->extra['seedcompany']}}</div></p>
                                    <p><div class="col-md-6 float-left font-weight-bolder">Manure/Fertilizer: </div><div class="col-md-6 float-left">{{$product->extra['fertilizer']}}</div></p>
                                    <p><div class="col-md-6 float-left font-weight-bolder">Fertilizer Company: </div><div class="col-md-6 float-left">{{$product->extra['fertilizer_company']}}</div></p>
                                    <p><div class="col-md-6 float-left font-weight-bolder">Water Source: </div><div class="col-md-6 float-left">{{$product->extra['water_source']}}</div></p>
                                    <p><div class="col-md-6 float-left font-weight-bolder">Location of Land: </div><div class="col-md-6 float-left">{{$product->location}}</div></p>
                                    <p><div class="col-md-6 float-left font-weight-bolder">Location of Land: </div><div class="col-md-6 float-left">{{$product->extra['harvest_date']}}</div></p>
                                    <p><div class="col-md-6 float-left font-weight-bolder">Location of Land: </div><div class="col-md-6 float-left">{{$product->extra['inspection_date']}}</div></p>
                                    <p><div class="col-md-6 float-left font-weight-bolder">Location of Land: </div><div class="col-md-6 float-left">{{$product->extra['pesticide']}}</div></p>
                                    <p><div class="col-md-6 float-left font-weight-bolder">Location of Land: </div><div class="col-md-6 float-left">{{$product->extra['pesticide_company']}}</div></p>
                                </div>
                            @endif
                            @if($product->category == 'Animal')
                            <div class="col-md-4 float-left">
                                <p><div class="col-md-6 float-left font-weight-bolder">Breed Type: </div><div class="col-md-6 float-left">{{$product->extra['breed_type']}}</div></p>
                                <p><div class="col-md-6 float-left font-weight-bolder">Type of Farming: </div><div class="col-md-6 float-left">{{$product->extra['type_of_farming']}}</div></p>
                                <p><div class="col-md-6 float-left font-weight-bolder">Animal Feed Type: </div><div class="col-md-6 float-left">{{$product->extra['animal_feed_type']}}</div></p>
                                <p><div class="col-md-6 float-left font-weight-bolder">Animal Feed Company: </div><div class="col-md-6 float-left">{{$product->extra['animal_feed_company']}}</div></p>
                                <p><div class="col-md-6 float-left font-weight-bolder">Animal Age: </div><div class="col-md-6 float-left">{{$product->extra['animal_age']}}</div></p>
                                <p><div class="col-md-6 float-left font-weight-bolder">Location of Farm: </div><div class="col-md-6 float-left">{{$product->location}}</div></p>
                            </div>
                            @endif
                            @if($product->user->hasRole('processingcompany'))
                                <div class="col-md-4 float-left">
                                    <p><div class="col-md-6 float-left font-weight-bolder">Mode of Transport: </div><div class="col-md-6 float-left">{{$product->extra['transport_mode']}}</div></p>
                                    <p><div class="col-md-6 float-left font-weight-bolder">Processing Procedure: </div><div class="col-md-6 float-left">{{$product->extra['processing_procedure']}}</div></p>
                                    <p><div class="col-md-6 float-left font-weight-bolder">Processing CHemicals: </div><div class="col-md-6 float-left">{{$product->extra['processing_chemicals']}}</div></p>
                                    <p><div class="col-md-6 float-left font-weight-bolder">Chemicals' Companies: </div><div class="col-md-6 float-left">{{$product->extra['processing_chemicals_companies']}}</div></p>
                                    <p><div class="col-md-6 float-left font-weight-bolder">Warehouse Location: </div><div class="col-md-6 float-left">{{$product->extra['location_of_warehouse']}}</div></p>
                                    <p><div class="col-md-6 float-left font-weight-bolder">Warehouse Storage Date: </div><div class="col-md-6 float-left">{{$product->extra['date_of_storage']}}</div></p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 text-center">

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
