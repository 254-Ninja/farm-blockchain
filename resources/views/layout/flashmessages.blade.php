<br>
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <i class="fa fa-times-circle"></i> Ooops!!! Some errors were encountered. Please check your inputs
        <br>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif

@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <i class="fa fa-check-circle"></i> {{Session::get('success')}}
    </div>
@endif
@if(Session::has('warning'))
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <i class="fa fa-warning"></i> {{Session::get('warning')}}
    </div>
@endif
@if(Session::has('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <i class="fa fa-times-circle"></i> {{Session::get('error')}}
    </div>
@endif
@if(Session::has('info'))
    <div class="alert alert-info alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <i class="fa fa-info-circle"></i> {{Session::get('info')}}
    </div>
@endif
