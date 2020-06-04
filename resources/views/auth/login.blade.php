@extends('layout.authentication')
@section('title', 'Login')
@section('content')
<div class="row">
    <div class="col-lg-4 col-sm-12">
        <form class="card auth_form" action="{{route('login')}}" method="post">
            @csrf()
            <div class="header">
                <img class="logo" src="{{asset('assets/images/logo1.png')}}" alt="">
                <h5>Log in</h5>
            </div>
            <div class="body">
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" value="{{old('email')}}" placeholder="Email">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                    </div>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="zmdi zmdi-lock"></i></span>
                    </div>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="checkbox">
                    <input id="remember_me" type="checkbox">
                    <label for="remember_me">Remember Me</label>
                </div>
                <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">SIGN IN</button>
{{--                <div class="signin_with mt-3">--}}
{{--                    <a class="link" href="{{route('register')}}">Don't have an account? Sign Up here</a>--}}
{{--                </div>--}}
            </div>
        </form>
{{--        <div class="copyright text-center">--}}
{{--            &copy;--}}
{{--            <script>document.write(new Date().getFullYear())</script>,--}}
{{--            <span>Designed by <a href="https://thememakker.com/" target="_blank">ThemeMakker</a></span>--}}
{{--        </div>--}}
    </div>
    <div class="col-lg-8 col-sm-12">
        <div class="card">
            <img src="{{asset('assets/images/bg1.png')}}" alt="Sign In"/>
        </div>
    </div>
</div>
@stop
