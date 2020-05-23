@extends('layout.master')
@section('title', 'View Product')
@section('parentPageTitle', 'Products')
@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/footable-bootstrap/css/footable.bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/footable-bootstrap/css/footable.standalone.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/dropify/css/dropify.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}"/>
@stop
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="body">
                    <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf()
                        <h2 class="card-inside-title">Product Details</h2>
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{$product->name}}" readonly />
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="category">Category</label>
                                    <input type="text" name="category" id="category" class="form-control" value="{{$product->category}}" placeholder="Category" readonly/>
                                    @if ($errors->has('category'))
                                        <span class="text-danger">{{ $errors->first('category') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="name">Price</label>
                                    <input type="number" name="price" class="form-control" value="{{$product->price}}" readonly />
                                    @if ($errors->has('price'))
                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="unitofmeasure">Unit Of Measure</label>
                                    <select name="unitofmeasure" class="form-control show-tick ms select2" readonly>
                                        <option value="">Select a unit of measure</option>
                                        <option value="Kg" {{($product->unit_of_measure == 'Kg')?'selected':''}}>Kgs</option>
                                        <option value="Ltr" {{($product->unit_of_measure == 'Ltr')?'selected':''}}>Litres</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="quantity">Quantity</label>
                                    <input type="number" name="quantity" class="form-control" value="{{$product->quantity}}" readonly />
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="barcode">Bar Code</label>
                                    <input type="text" name="barcode" class="form-control" value="{{$product->bar_code}}" readonly/>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="description">Description</label>
                                    <textarea name="description" class="form-control" readonly>{{$product->description}}</textarea>
                                </div>
                                <div class="form-group">
                                    <p>Product Photo</p>
                                    <input type="file" name="photo" class="dropify" data-default-file="{{url($product->photo)}}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if($product->category == 'Farm')
                                    <div id="farm">
                                        <div class="form-group">
                                            <label class="control-label" for="seedname">Seed Name</label>
                                            <input type="text" name="seedname" class="form-control" value="{{$product->extra['seedname']}}" readonly/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="seedcompany">Seed Company</label>
                                            <input type="text" name="seedcompany" class="form-control" value="{{$product->extra['seedcompany']}}" readonly/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="fertilizer">Manure/Fertilizer</label>
                                            <input type="text" name="fertilizer" class="form-control" value="{{$product->extra['fertilizer']}}" readonly/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="fertilizer_company">Fertilizer Company</label>
                                            <input type="text" name="fertilizer_company" class="form-control" value="{{$product->extra['fertilizer_company']}}" readonly/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="water_source">Water Source</label>
                                            <input type="text" name="water_source" class="form-control" value="{{$product->extra['water_source']}}" readonly/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="location_of_land">Location of land</label>
                                            <select name="location_of_land" class="form-control show-tick ms select2" readonly>
                                                <option value="">Select a county</option>
                                                <option value="Nakuru" {{($product->location == 'Nakuru')?'selected':''}}>Nakuru</option>
                                                <option value="Eldoret" {{($product->location == 'Eldoret')?'selected':''}}>Eldoret</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="harvest_date">Date of Harvest <small>(DD/MM/YYYY)</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                                </div>
                                                <input name="harvest_date" type="text" value="{{$product->extra['harvest_date']}}" class="form-control datepicker" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="inspection_date">Date of Inspection <small>(DD/MM/YYYY)</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                                </div>
                                                <input name="inspection_date" type="text" value="{{$product->extra['inspection_date']}}" class="form-control datepicker" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="pesticide">Pesticide Used</label>
                                            <input type="text" name="pesticide" class="form-control" value="{{$product->extra['pesticide']}}" readonly/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="pesticide_company">Pesticide Company</label>
                                            <input type="text" name="pesticide_company" class="form-control" value="{{$product->extra['pesticide_company']}}" readonly/>
                                        </div>
                                    </div>
                                @endif
                                @if($product->category == 'Animal')
                                    <div id="animal">
                                        <div class="form-group">
                                            <label class="control-label" for="breed_type">Breed Type</label>
                                            <input type="text" name="breed_type" class="form-control" value="{{$product->extra['breed_type']}}" readonly/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="location_of_land">Type of Farming</label>
                                            <select name="type_of_farming" class="form-control show-tick ms select2" readonly>
                                                <option value="">Select a type of farming</option>
                                                <option value="Zero Grazing" {{($product->extra['type_of_farming'] == 'Zero Grazing')}}>Zero Grazing</option>
                                                <option value="Free Range" {{($product->extra['type_of_farming'] == 'Free Range')}}>Free Range</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="animal_feed_type">Animal Feed Type</label>
                                            <input type="text" name="animal_feed_type" class="form-control" value="{{$product->extra['animal_feed_type']}}" readonly/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="animal_feed_company">Animal Feed Company</label>
                                            <input type="text" name="animal_feed_company" class="form-control" value="{{$product->extra['animal_feed_company']}}" readonly/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="animal_age">Animal Age</label>
                                            <input type="text" name="animal_age" class="form-control" value="{{$product->extra['animal_age']}}" readonly/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="location_of_land">Location of Farm</label>
                                            <select name="location_of_farm" class="form-control show-tick ms select2" readonly>
                                                <option value="">Select a county</option>
                                                <option value="Nakuru" {{($product->location == 'Nakuru')?'selected':''}}>Nakuru</option>
                                                <option value="Eldoret" {{($product->location == 'Eldoret')?'selected':''}}>Eldoret</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                @if($product->user->hasRole('processingcompany'))
                                    <div id="processing">
                                        <div class="form-group">
                                            <label class="control-label" for="transport_mode">Mode of Transport</label>
                                            <input type="text" name="transport_mode" class="form-control" value="{{$product->extra['transport_mode']}}" readonly/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="processing_procedure">Processing Procedure</label>
                                            <input type="text" name="processing_procedure" class="form-control" value="{{$product->extra['processing_procedure']}}" readonly/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="processing_chemicals">Chemicals Used</label>
                                            <textarea type="text" name="processing_chemicals" class="form-control" readonly>{{$product->extra['processing_chemicals']}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="processing_chemicals_companies">Chemicals' Companies</label>
                                            <textarea type="text" name="processing_chemicals_companies" class="form-control" readonly>{{$product->extra['processing_chemicals_companies']}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="location_of_warehouse">Location of warehouse</label>
                                            <select name="location_of_warehouse" class="form-control show-tick ms select2" readonly>
                                                <option value="">Select a county</option>
                                                <option value="Nakuru" {{($product->extra['location_of_warehouse'] == 'Nakuru')}}>Nakuru</option>
                                                <option value="Eldoret" {{($product->extra['location_of_warehouse'] == 'Eldoret')}}>Eldoret</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="date_of_storage">Date of Storage in warehouse <small>(DD/MM/YYYY)</small></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                                </div>
                                                <input name="date_of_storage" type="text" value="{{$product->extra['date_of_storage']}}" class="form-control datepicker" readonly>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12 text-center">
                                <a href="{{route('product.index')}}" class="btn btn-default right_icon_toggle_btn">Back</a>
                                @if($product->status == 'Unverified' && \Illuminate\Support\Facades\Auth::user()->hasRole('government'))
                                    <a href="{{route('product/verify',$product->id)}}" class="btn btn-success waves-effect waves-float btn-sm waves-green"> Verify</a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('page-script')
    <script src="{{asset('assets/plugins/dropify/js/dropify.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/forms/dropify.js')}}"></script>
    <script src="{{asset('assets/plugins/momentjs/moment.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}"></script>
    <script src="{{asset('assets/js/pages/forms/basic-form-elements.js')}}"></script>
@stop
