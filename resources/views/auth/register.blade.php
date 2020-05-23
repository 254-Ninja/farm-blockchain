@extends('layout.authentication')
@section('title', 'Register')
@section('content')
<div class="row">
    <div class="col-lg-4 col-sm-12">
        <form class="card auth_form" action="{{route('register')}}" method="post">
            @csrf()
            <div class="header">
                <img class="logo" src="{{asset('assets/images/logo1.png')}}" alt="">
                <h5>Sign Up</h5>
                <span>Register a new membership</span>
            </div>
            <div class="body">
                <div class="input-group mb-3">
                    <select name="membership" class="form-control" required>
                        <option value="">Select membership type</option>
                        <option value="farmer">Farmer</option>
                        <option value="customer">Customer</option>
                        <option value="processingcompany">Processing Company</option>
                    </select>
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="zmdi zmdi-card-membership"></i></span>
                    </div>
                    @if ($errors->has('membership'))
                        <span class="text-danger">{{ $errors->first('membership') }}</span>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                    </div>
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Enter an email address" required>
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="zmdi zmdi-email"></i></span>
                    </div>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="phone" class="form-control" placeholder="Enter a phone number" required>
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="zmdi zmdi-phone"></i></span>
                    </div>
                    @if ($errors->has('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <select name="location" class="form-control">
                        <option value="">Select your location</option>
                        <option value="Eldoret">Eldoret</option>
                        <option value="Nakuru">Nakuru</option>
                    </select>
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="zmdi zmdi-pin-drop"></i></span>
                    </div>
                    @if ($errors->has('location'))
                        <span class="text-danger">{{ $errors->first('location') }}</span>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <select name="product" class="form-control">
                        <option value="">Select a product category</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="zmdi zmdi-pin-drop"></i></span>
                    </div>
                    @if ($errors->has('product'))
                        <span class="text-danger">{{ $errors->first('product') }}</span>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="zmdi zmdi-lock"></i></span>
                    </div>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Re-enter Password" required>
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="zmdi zmdi-lock"></i></span>
                    </div>
                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>
                <div class="checkbox">
                    <input id="remember_me" type="checkbox">
                    <label for="remember_me">I read and agree to the <a href="javascript:void(0);">terms of usage</a></label>
                </div>
                <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">SIGN UP</button>
                <div class="signin_with mt-3">
                    <a class="link" href="{{route('login')}}">You already have an account?</a>
                </div>
            </div>
        </form>
        <div class="copyright text-center">
            &copy;
            <script>document.write(new Date().getFullYear())</script>,
            <span>Designed by <a href="https://thememakker.com/" target="_blank">ThemeMakker</a></span>
        </div>
    </div>
    <div class="col-lg-8 col-sm-12">
        <div class="card">
            <img src="{{asset('assets/images/bg1.png')}}" alt="Sign Up" />
        </div>
    </div>
</div>
@stop
