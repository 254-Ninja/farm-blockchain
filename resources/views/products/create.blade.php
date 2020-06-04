@extends('layout.master')
@section('title', 'Create Product')
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
                        <h2 class="card-inside-title">Product Form</h2>
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label" for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Enter product name" />
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="category">Category</label>
                                    <input type="text" name="category" id="category" class="form-control" value="{{$user->productCategory->name}}" placeholder="Category" readonly/>
                                    @if ($errors->has('category'))
                                        <span class="text-danger">{{ $errors->first('category') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="name">Price</label>
                                    <input type="number" name="price" class="form-control" value="{{old('price')}}" placeholder="Enter product price" />
                                    @if ($errors->has('price'))
                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="unitofmeasure">Unit Of Measure</label>
                                    <select name="unitofmeasure" class="form-control show-tick ms select2" required>
                                        <option value="">Select a unit of measure</option>
                                        <option value="Kg">Kgs</option>
                                        <option value="Ltr">Litres</option>
                                    </select>
                                    @if ($errors->has('unitofmeasure'))
                                        <span class="text-danger">{{ $errors->first('unitofmeasure') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="quantity">Quantity</label>
                                    <input type="number" name="quantity" class="form-control" value="{{old('quantity')}}" placeholder="Enter product quantity" />
                                    @if ($errors->has('quantity'))
                                        <span class="text-danger">{{ $errors->first('quantity') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="barcode">Bar Code</label>
                                    <input type="text" name="barcode" class="form-control" value="{{old('barcode')}}" placeholder="Enter barcode" />
                                    @if ($errors->has('barcode'))
                                        <span class="text-danger">{{ $errors->first('barcode') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="description">Description</label>
                                    <textarea name="description" class="form-control" placeholder="Enter product description">{{old('description')}}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <p>Product Photo</p>
                                    <input type="file" name="photo" class="dropify form-control" data-allowed-file-extensions="jpg jpeg png" data-max-file-size="2048K">
                                    @if ($errors->has('photo'))
                                        <span class="text-danger">{{ $errors->first('photo') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="farm" style="display: none">
                                    <div class="form-group">
                                        <label class="control-label" for="seedname">Seed Name</label>
                                        <input type="text" name="seedname" class="form-control" value="{{old('seedname')}}" placeholder="Enter seed name"/>
                                        @if ($errors->has('seedname'))
                                            <span class="text-danger">{{ $errors->first('seedname') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="seedcompany">Seed Company</label>
                                        <input type="text" name="seedcompany" class="form-control" value="{{old('seedcompany')}}" placeholder="Enter seed company"/>
                                        @if ($errors->has('seedcompany'))
                                            <span class="text-danger">{{ $errors->first('seedcompany') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="fertilizer">Manure/Fertilizer</label>
                                        <input type="text" name="fertilizer" class="form-control" value="{{old('fertilizer')}}" placeholder="Enter manure/fertilizer used"/>
                                        @if ($errors->has('fertilizer'))
                                            <span class="text-danger">{{ $errors->first('fertilizer') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="fertilizer_company">Fertilizer Company</label>
                                        <input type="text" name="fertilizer_company" class="form-control" value="{{old('fertilizer_company')}}" placeholder="Enter fertilizer company"/>
                                        @if ($errors->has('fertilizer_company'))
                                            <span class="text-danger">{{ $errors->first('fertilizer_company') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="water_source">Water Source</label>
                                        <input type="text" name="water_source" class="form-control" value="{{old('water_source')}}" placeholder="Enter water source used"/>
                                        @if ($errors->has('water_source'))
                                            <span class="text-danger">{{ $errors->first('water_source') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="location_of_land">Location of land</label>
                                        <select name="location_of_land" class="form-control show-tick ms select2">
                                            <option value="">Select a county</option>
                                            <option value="Nakuru">Nakuru</option>
                                            <option value="Eldoret">Eldoret</option>
                                        </select>
                                        @if ($errors->has('location_of_land'))
                                            <span class="text-danger">{{ $errors->first('location_of_land') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="harvest_date">Date of Harvest <small>(DD/MM/YYYY)</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                            </div>
                                            <input name="harvest_date" type="text" value="{{old('harvest_date')}}" class="form-control datepicker" placeholder="Please choose a date...">
                                        </div>
                                        @if ($errors->has('harvest_date'))
                                            <span class="text-danger">{{ $errors->first('harvest_date') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="inspection_date">Date of Inspection <small>(DD/MM/YYYY)</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                            </div>
                                            <input name="inspection_date" type="text" value="{{old('inspection_date')}}" class="form-control datepicker" placeholder="Please choose a date...">
                                        </div>
                                        @if ($errors->has('inspection_date'))
                                            <span class="text-danger">{{ $errors->first('inspection_date') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="pesticide">Pesticide Used</label>
                                        <input type="text" name="pesticide" class="form-control" value="{{old('pesticide')}}" placeholder="Enter pesticide used"/>
                                        @if ($errors->has('pesticide'))
                                            <span class="text-danger">{{ $errors->first('pesticide') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="pesticide_company">Pesticide Company</label>
                                        <input type="text" name="pesticide_company" class="form-control" value="{{old('pesticide_company')}}" placeholder="Enter company of pesticide used"/>
                                        @if ($errors->has('pesticide_company'))
                                            <span class="text-danger">{{ $errors->first('pesticide_company') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div id="animal" style="display: none">
                                    <div class="form-group">
                                        <label class="control-label" for="breed_type">Breed Type</label>
                                        <input type="text" name="breed_type" class="form-control" value="{{old('breed_type')}}" placeholder="Enter breed type"/>
                                        @if ($errors->has('breed_type'))
                                            <span class="text-danger">{{ $errors->first('breed_type') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="location_of_land">Type of Farming</label>
                                        <select name="type_of_farming" class="form-control show-tick ms select2">
                                            <option value="">Select a type of farming</option>
                                            <option value="Zero Grazing">Zero Grazing</option>
                                            <option value="Free Range">Free Range</option>
                                        </select>
                                        @if ($errors->has('type_of_farming'))
                                            <span class="text-danger">{{ $errors->first('type_of_farming') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="animal_feed_type">Animal Feed Type</label>
                                        <input type="text" name="animal_feed_type" class="form-control" value="{{old('animal_feed_type')}}" placeholder="Enter type of animal feed"/>
                                        @if ($errors->has('animal_feed_type'))
                                            <span class="text-danger">{{ $errors->first('animal_feed_type') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="animal_feed_company">Animal Feed Company</label>
                                        <input type="text" name="animal_feed_company" class="form-control" value="{{old('animal_feed_company')}}" placeholder="Enter company of animal feed"/>
                                        @if ($errors->has('animal_feed_company'))
                                            <span class="text-danger">{{ $errors->first('animal_feed_company') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="animal_age">Animal Age</label>
                                        <input type="text" name="animal_age" class="form-control" value="{{old('animal_age')}}" placeholder="Enter age of animal"/>
                                        @if ($errors->has('animal_age'))
                                            <span class="text-danger">{{ $errors->first('animal_age') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="location_of_land">Location of Farm</label>
                                        <select name="location_of_farm" class="form-control show-tick ms select2">
                                            <option value="">Select a county</option>
                                            <option value="Nakuru">Nakuru</option>
                                            <option value="Eldoret">Eldoret</option>
                                        </select>
                                        @if ($errors->has('location_of_farm'))
                                            <span class="text-danger">{{ $errors->first('location_of_farm') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div id="processing" style="display: none">
                                    <input type="hidden" id="userinput" value="{{(\Illuminate\Support\Facades\Auth::user()->hasRole('processingcompany')?'processingcompany':'')}}">
                                    <div class="form-group">
                                        <label class="control-label" for="transport_mode">Mode of Transport</label>
                                        <input type="text" name="transport_mode" class="form-control" value="{{old('transport_mode')}}" placeholder="Enter Mode of transport used"/>
                                        @if ($errors->has('transport_mode'))
                                            <span class="text-danger">{{ $errors->first('transport_mode') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="processing_procedure">Processing Procedure</label>
                                        <input type="text" name="processing_procedure" class="form-control" value="{{old('processing_procedure')}}" placeholder="Enter Processing Procedure used"/>
                                        @if ($errors->has('processing_procedure'))
                                            <span class="text-danger">{{ $errors->first('processing_procedure') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="processing_chemicals">Chemicals Used</label>
                                        <textarea type="text" name="processing_chemicals" class="form-control" placeholder="List Chemicals used separating with comma">{{old('processing_chemicals')}}</textarea>
                                        @if ($errors->has('processing_chemicals'))
                                            <span class="text-danger">{{ $errors->first('processing_chemicals') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="processing_chemicals_companies">Chemicals' Companies</label>
                                        <textarea type="text" name="processing_chemicals_companies" class="form-control" placeholder="List companies of chemicals used separating with comma">{{old('processing_chemicals_companies')}}</textarea>
                                        @if ($errors->has('processing_chemicals_companies'))
                                            <span class="text-danger">{{ $errors->first('processing_chemicals_companies') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="location_of_warehouse">Location of warehouse</label>
                                        <select name="location_of_warehouse" class="form-control show-tick ms select2">
                                            <option value="">Select a county</option>
                                            <option value="Nakuru">Nakuru</option>
                                            <option value="Eldoret">Eldoret</option>
                                        </select>
                                        @if ($errors->has('location_of_warehouse'))
                                            <span class="text-danger">{{ $errors->first('location_of_warehouse') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" for="date_of_storage">Date of Storage in warehouse <small>(DD/MM/YYYY)</small></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                            </div>
                                            <input name="date_of_storage" type="text" value="{{old('date_of_storage')}}" class="form-control datepicker" placeholder="Please choose a date...">
                                        </div>
                                        @if ($errors->has('date_of_storage'))
                                            <span class="text-danger">{{ $errors->first('date_of_storage') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12 text-center">
                                <a href="{{route('product.index')}}" class="btn btn-default right_icon_toggle_btn">Back</a>
                                <button type="submit" class="btn btn-primary right_icon_toggle_btn">Save</button>
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
    <script type="text/javascript">
        $( function () {
            var input = $('#category');
            var userinput = $('#userinput').val();
            var category =input.val();

            if (category === 'Farm'){
                $('#animal').fadeOut();
                $('#farm').fadeIn();
            }
            else if (category === 'Animal'){
                $('#farm').fadeOut();
                $('#animal').fadeIn();
            }
            else {
                $('#farm').fadeOut();
                $('#animal').fadeOut();
            }

            if (userinput === 'processingcompany'){
                $('#processing').fadeIn();
            }
            else {
                $('#processing').fadeOut();
            }
        });
    </script>
@stop
