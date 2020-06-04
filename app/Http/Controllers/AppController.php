<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class AppController extends BaseController
{
    function inbox(){
    	return view('app.inbox');
    }

    function compose(){
    	return view('app.compose');
    }

    function single(){
    	return view('app.single');
    }

    function chat(){
    	return view('app.chat');
    }

    function calendar(){
        return view('app.calendar');
    }

    function contactList(){
    	return view('app.contact-list');
    }
}
