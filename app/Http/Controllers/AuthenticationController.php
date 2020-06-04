<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class AuthenticationController extends BaseController
{
    function login(){
    	return view('auth.login');
    }

    function register(){
    	return view('auth.register');
    }

    function lockscreen(){
        return view('auth.lockscreen');
    }

    function forgot(){
    	return view('auth.forgot');
    }
    
    function page404(){
    	return view('auth.page404');
    }

    function page500(){
        return view('auth.page500');
    }

    function offline(){
    	return view('auth.offline');
    }
}
