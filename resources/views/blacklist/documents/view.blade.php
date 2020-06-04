@extends('layout.master')
@section('title', 'View Blacklist Documents')
@section('parentPageTitle', 'Blacklist Documents')
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
                <div class="body row">
                    <h2 class="card-inside-title col-md-12">Blacklist Documents</h2>
                    <div class="tab-content col-md-12">
                        <div class="tab-pane active">
                            <div class="col-md-6 float-left">
                                <h2 class="card-inside-title col-md-12">Entity Details</h2>
                                @if($blacklist->category == 'User')
                                    <p><div class="col-md-6 float-left font-weight-bolder">Name: </div><div class="col-md-6 float-left">{{$blacklist->entity->name}}</div></p>
                                    <p><div class="col-md-6 float-left font-weight-bolder">Category: </div><div class="col-md-6 float-left">{{$blacklist->entity->roles->first()->name}}</div></p>
                                    <p><div class="col-md-6 float-left font-weight-bolder">Status: </div><div class="col-md-6 float-left">{{($blacklist->verified)?'':'Blacklisted'}}</div></p>
                                @else
                                    <p><div class="col-md-6 float-left font-weight-bolder">Name: </div><div class="col-md-6 float-left">{{$blacklist->entity->name}}</div></p>
                                    <p><div class="col-md-6 float-left font-weight-bolder">Category: </div><div class="col-md-6 float-left">{{$blacklist->category}}</div></p>
                                    <p><div class="col-md-6 float-left font-weight-bolder">Status: </div><div class="col-md-6 float-left">{{$blacklist->status}}</div></p>
                                @endif
                            </div>
                            <div class="col-md-6 float-left">
                                <h2 class="card-inside-title col-md-12">Blacklist Files</h2>
                                @if($blacklist->files()->count() > 0)
                                    <p><div class="col-md-6 float-left font-weight-bolder">Name</div><div class="col-md-6 float-left">Option</div></p>
                                    <br>
                                    @foreach($blacklist->files as $file)
                                        <p>
                                            <div class="col-md-6 float-left font-weight-bolder">{{$file->name}}</div>
                                            <div class="col-md-6 float-left"><a href="{{asset($file->file_url)}}" class="btn btn-info right_icon_toggle_btn">Download</a></div>
                                        </p>
                                    @endforeach
                                @else
                                    <p><div class="col-md-12 float-left font-weight-bolder text-center">No files uploaded for this entity</div></p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <div class="tab-pane active">
                            <form action="{{route('blacklist/documents/upload')}}" method="POST" enctype="multipart/form-data">
                                @csrf()
                                <div class="form-group">
                                    <br><br><br>
                                    <p style="text-align: left">Upload Blacklist File</p>
                                    <input type="hidden" name="blacklist_id" value="{{$blacklist->id}}">
                                    <input type="file" name="blacklistfile" class="dropify form-control" data-allowed-file-extensions="pdf doc docx" data-max-file-size="2048K" required>
                                    @if ($errors->has('blacklistfile'))
                                        <span class="text-danger">{{ $errors->first('blacklistfile') }}</span>
                                    @endif
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary right_icon_toggle_btn">Upload</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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

