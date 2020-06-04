<?php

namespace App\Http\Controllers;

use App\Blacklist;
use App\Product;
use App\ProductCategory;
use App\ProductFlag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        if ($user->hasRole('customer')){
            $products = Product::where('status','Verified')->paginate(20);

            return view('products.productsdisplay',compact('products'));
        }
        else {
            if ($user->hasRole(['administrator','government'])){
                $products = Product::all();
            }
            else {
                $products = Product::where('user_id',$user->id)->get();
            }
            return view('products.index',compact('products'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = Auth::user();
        $categories = ProductCategory::all();

        return view('products.create',compact('user','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user = Auth::user();
        $category = $request->input('category');
        if (!$user->hasRole('processingcompany')){
           if ($category == 'Farm'){
               $this->validate($request,[
                   'name'=>'required',
                   'price'=>'required',
                   'unitofmeasure'=>'required',
                   'quantity'=>'required',
                   'barcode'=>'required',
                   'description'=>'required',
                   'photo'=>'required|mimes:jpg,jpeg,png|max:2048',
                   'seedname'=>'required',
                   'seedcompany'=>'required',
                   'fertilizer'=>'required',
                   'fertilizer_company'=>'required',
                   'water_source'=>'required',
                   'location_of_land'=>'required',
                   'harvest_date'=>'required',
                   'inspection_date'=>'required',
                   'pesticide'=>'required',
                   'pesticide_company'=>'required'
               ]);

               $product = new Product();
               $product->name = $request->input('name');
               $product->category = $request->input('category');
               $product->location = $request->input('location_of_land');
               $product->description = $request->input('description');
               $product->price = $request->input('price');
               $product->bar_code = $request->input('barcode');
               $product->quantity = $request->input('quantity');
               $product->unit_of_measure = $request->input('unitofmeasure');
               $product->status = 'Unverified';
               if ($request->hasFile('photo')){
                   $image = $request->file('photo');
                   $iname = time().$request->file('photo')->getClientOriginalName();
                   $image->move(public_path("assets/images/products"), $iname);
                   $product->photo = 'assets/images/products/'.$iname;
               }
               $product->user_id = $user->id;
               $product->extra = [
                   'seedname'=>$request->input('seedname'),
                   'seedcompany'=>$request->input('seedcompany'),
                   'fertilizer'=>$request->input('fertilizer'),
                   'fertilizer_company'=>$request->input('fertilizer_company'),
                   'water_source'=>$request->input('water_source'),
                   'harvest_date'=>$request->input('harvest_date'),
                   'inspection_date'=>$request->input('inspection_date'),
                   'pesticide'=>$request->input('pesticide'),
                   'pesticide_company'=>$request->input('pesticide_company')
               ];
               $product->save();

               return redirect()->route('product.index')->with('success','Product added successfully');
           }
           else {
               $this->validate($request,[
                   'name'=>'required',
                   'price'=>'required',
                   'unitofmeasure'=>'required',
                   'quantity'=>'required',
                   'barcode'=>'required',
                   'description'=>'required',
                   'photo'=>'required|mimes:jpg,jpeg,png|max:2048',
                   'breed_type'=>'required',
                   'type_of_farming'=>'required',
                   'animal_feed_type'=>'required',
                   'animal_feed_company'=>'required',
                   'animal_age'=>'required',
                   'location_of_farm'=>'required',
               ]);

               $product = new Product();
               $product->name = $request->input('name');
               $product->category = $request->input('category');
               $product->location = $request->input('location_of_farm');
               $product->description = $request->input('description');
               $product->price = $request->input('price');
               $product->bar_code = $request->input('barcode');
               $product->quantity = $request->input('quantity');
               $product->unit_of_measure = $request->input('unitofmeasure');
               $product->status = 'Unverified';
               if ($request->hasFile('photo')){
                   $image = $request->file('photo');
                   $iname = time().$request->file('photo')->getClientOriginalName();
                   $image->move(public_path("assets/images/products"), $iname);
                   $product->photo = 'assets/images/products/'.$iname;
               }
               $product->user_id = $user->id;
               $product->extra = [
                   'breed_type'=>$request->input('breed_type'),
                   'type_of_farming'=>$request->input('type_of_farming'),
                   'animal_feed_type'=>$request->input('animal_feed_type'),
                   'animal_feed_company'=>$request->input('animal_feed_company'),
                   'animal_age'=>$request->input('animal_age'),
               ];
               $product->save();

               return redirect()->route('product.index')->with('success','Product added successfully');
           }
        }
        else {
            if ($category == 'Farm'){
                $this->validate($request,[
                    'name'=>'required',
                    'price'=>'required',
                    'unitofmeasure'=>'required',
                    'quantity'=>'required',
                    'barcode'=>'required',
                    'description'=>'required',
                    'photo'=>'required|mimes:jpg,jpeg,png|max:2048',
                    'seedname'=>'required',
                    'seedcompany'=>'required',
                    'fertilizer'=>'required',
                    'fertilizer_company'=>'required',
                    'water_source'=>'required',
                    'location_of_land'=>'required',
                    'harvest_date'=>'required',
                    'inspection_date'=>'required',
                    'pesticide'=>'required',
                    'pesticide_company'=>'required',
                    'transport_mode'=>'required',
                    'processing_procedure'=>'required',
                    'processing_chemicals'=>'required',
                    'processing_chemicals_companies'=>'required',
                    'location_of_warehouse'=>'required',
                    'date_of_storage'=>'required'
                ]);

                $product = new Product();
                $product->name = $request->input('name');
                $product->category = $request->input('category');
                $product->location = $request->input('location_of_land');
                $product->description = $request->input('description');
                $product->price = $request->input('price');
                $product->bar_code = $request->input('barcode');
                $product->quantity = $request->input('quantity');
                $product->unit_of_measure = $request->input('unitofmeasure');
                $product->status = 'Unverified';
                if ($request->hasFile('photo')){
                    $image = $request->file('photo');
                    $iname = time().$request->file('photo')->getClientOriginalName();
                    $image->move(public_path("assets/images/products"), $iname);
                    $product->photo = 'assets/images/products/'.$iname;
                }
                $product->user_id = $user->id;
                $product->extra = [
                    'seedname'=>$request->input('seedname'),
                    'seedcompany'=>$request->input('seedcompany'),
                    'fertilizer'=>$request->input('fertilizer'),
                    'fertilizer_company'=>$request->input('fertilizer_company'),
                    'water_source'=>$request->input('water_source'),
                    'harvest_date'=>$request->input('harvest_date'),
                    'inspection_date'=>$request->input('inspection_date'),
                    'pesticide'=>$request->input('pesticide'),
                    'pesticide_company'=>$request->input('pesticide_company'),
                    'transport_mode'=>$request->input('transport_mode'),
                    'processing_procedure'=>$request->input('processing_procedure'),
                    'processing_chemicals'=>$request->input('processing_chemicals'),
                    'processing_chemicals_companies'=>$request->input('processing_chemicals_companies'),
                    'location_of_warehouse'=>$request->input('location_of_warehouse'),
                    'date_of_storage'=>$request->input('date_of_storage')
                ];
                $product->save();

                return redirect()->route('product.index')->with('success','Product added successfully');
            }
            else {
                $this->validate($request,[
                    'name'=>'required',
                    'price'=>'required',
                    'unitofmeasure'=>'required',
                    'quantity'=>'required',
                    'barcode'=>'required',
                    'description'=>'required',
                    'photo'=>'required|mimes:jpg,jpeg,png|max:2048',
                    'breed_type'=>'required',
                    'type_of_farming'=>'required',
                    'animal_feed_type'=>'required',
                    'animal_feed_company'=>'required',
                    'animal_age'=>'required',
                    'location_of_farm'=>'required',
                    'transport_mode'=>'required',
                    'processing_procedure'=>'required',
                    'processing_chemicals'=>'required',
                    'processing_chemicals_companies'=>'required',
                    'location_of_warehouse'=>'required',
                    'date_of_storage'=>'required'
                ]);

                $product = new Product();
                $product->name = $request->input('name');
                $product->category = $request->input('category');
                $product->location = $request->input('location_of_farm');
                $product->description = $request->input('description');
                $product->price = $request->input('price');
                $product->bar_code = $request->input('barcode');
                $product->quantity = $request->input('quantity');
                $product->unit_of_measure = $request->input('unitofmeasure');
                $product->status = 'Unverified';
                if ($request->hasFile('photo')){
                    $image = $request->file('photo');
                    $iname = time().$request->file('photo')->getClientOriginalName();
                    $image->move(public_path("assets/images/products"), $iname);
                    $product->photo = 'assets/images/products/'.$iname;
                }
                $product->user_id = $user->id;
                $product->extra = [
                    'breed_type'=>$request->input('breed_type'),
                    'type_of_farming'=>$request->input('type_of_farming'),
                    'animal_feed_type'=>$request->input('animal_feed_type'),
                    'animal_feed_company'=>$request->input('animal_feed_company'),
                    'animal_age'=>$request->input('animal_age'),
                    'transport_mode'=>$request->input('transport_mode'),
                    'processing_procedure'=>$request->input('processing_procedure'),
                    'processing_chemicals'=>$request->input('processing_chemicals'),
                    'processing_chemicals_companies'=>$request->input('processing_chemicals_companies'),
                    'location_of_warehouse'=>$request->input('location_of_warehouse'),
                    'date_of_storage'=>$request->input('date_of_storage')
                ];
                $product->save();

                return redirect()->route('product.index')->with('success','Product added successfully');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public  function verify ($id){
        if (Auth::user()->hasRole('government')){
            $product = Product::find($id);
            $product->status = 'Verified';
            $product->save();

            return redirect()->back()->with('success','Product has been verified');
        }
        else {
            return redirect()->route('dashboard')->with('error','Sorry. You are not authorised to access this service');
        }
    }


    public function show($id)
    {
        //
        $user = Auth::user();
        $product = Product::find($id);

        if (Auth::user()->hasRole('customer')){
            return view('products.customershow',compact('product'));
        }
        else {
            return view('products.show',compact('product','user'));
        }
    }

    public function productBlacklist (){
        if (Auth::user()->hasRole(['government','administrator'])){
            $products = ProductFlag::paginate(20);

            return view('blacklist.products',compact('products'));
        }
        else {
            return redirect()->route('dashboard')->with('error','Sorry. You are not authorised to access this service');
        }
    }

    public function blacklistProduct ($id){
        if (Auth::user()->hasRole(['government','administrator'])){
            $product = Product::find($id);
            $product->status = 'Suspended';
            $product->save();

            //create blacklist record
            if (Blacklist::where('entity_id',$product->id)->first()){
                return redirect()->back()->with('warning','Product has already been suspended');
            }
            else {
                $blacklist = new Blacklist();
                $blacklist->category = 'Product';
                $blacklist->entity_id = $product->id;
                $blacklist->save();

                return redirect()->back()->with('success','Product has been suspended');
            }
        }
        else {
            return redirect()->route('dashboard')->with('error','Sorry. You are not authorised to access this service');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
