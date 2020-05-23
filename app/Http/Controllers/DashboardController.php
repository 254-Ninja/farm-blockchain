<?php

namespace App\Http\Controllers;

use App\Blacklist;
use App\Product;
use App\ProductFlag;
use App\ProductRating;
use App\Rating;
use App\Role;
use App\Sale;
use App\User;
use App\UserFlag;
use App\UserRating;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class DashboardController extends BaseController
{
    function index(){
        $user = Auth::user();
        if ($user->hasRole(['administrator','government'])){
            $farmers = Role::where('name','farmer')->with('users')->withCount('users')->first();
            $processing_companies = Role::where('name','processingcompany')->with('users')->withCount('users')->first();
            $customers = Role::where('name','customer')->with('users')->withCount('users')->first();
            $products = Product::all();
            $userflags = UserFlag::all();
            $productflags = ProductFlag::all();
            $user_ratings = UserRating::all();
            $product_ratings = ProductRating::all();

            return view('dashboard.index',compact('farmers','processing_companies','customers','products','userflags','productflags','user_ratings','product_ratings'));
        }
        elseif ($user->hasRole('processingcompany')){
            $products = Product::all();
            $orders = User::where('id',Auth::id())->with('sales')->withCount('sales')->get();
            $total_orders = 0;
            foreach ($orders as $order){
                $total_orders += $order->sales_count;
            }

            return view('dashboard.index',compact('total_orders','products'));
        }
        elseif ($user->hasRole('farmer')){
            $products = Product::all();
            $orders = User::where('id',Auth::id())->with('sales')->withCount('sales')->get();
            $total_orders = 0;
            foreach ($orders as $order){
                $total_orders += $order->sales_count;
            }

            return view('dashboard.index',compact('total_orders','products'));
        }
        elseif ($user->hasRole('customer')) {
            $farmers = Role::where('name','farmer')->with('users')->withCount('users')->first();
            $processing_companies = Role::where('name','processingcompany')->with('users')->withCount('users')->first();
            $products = Product::all();
            $orders = Sale::where('customer_id',$user->id)->get();

            return view('dashboard.index',compact('farmers','processing_companies','products','orders'));
        }
        else {
            return redirect()->back()->with('danger','Unauthorised access. Please contact administrator for assistance');
        }
    }
    public function logout (){
        Session::flush();
        Auth::logout();
        return redirect('/login')->with('success', 'Successfully logged out');
    }
}
