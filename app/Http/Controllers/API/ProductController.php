<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductCategory;
use App\ProductFlag;
use App\ProductRating;
use App\Role;
use App\RoleUser;
use App\Sale;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function categories()
    {
        $categories = ProductCategory::get();
        $cats = array();
        $i = 0;
        foreach ($categories as $category){
            $cats[$i] = array(
                'id' => $category->id,
                'name' => $category->name
            );
            $i += 1;
        }

        return response()->json(['success' => true, 'message' => 'Product Categories List', 'data' => $cats]);
    }

    public function imageUpload(Request $request){
        if ($request->hasFile('file')){
            $image = $request->file('file');
            $iname = time().$request->file('file')->getClientOriginalName();
            $image->move(public_path("assets/images/products"), $iname);
            return response()->json(['success' => true, 'message' => 'File Upload successfully']);
        }else{
            return response()->json(['success' => false, 'message' => 'File Upload Unsuccessfully']);
        }

    }

    public function product(Request $request){
        if (!$request->input('name')){
            return response()->json(['success' => false, 'message' => 'Name is required']);
        }
        if (!$request->input('price')){
            return response()->json(['success' => false, 'message' => 'Price is required']);
        }
        if (!$request->input('unitofmeasure')){
            return response()->json(['success' => false, 'message' => 'Unit of Measure is required']);
        }
        if (!$request->input('quantity')){
            return response()->json(['success' => false, 'message' => 'Quantity is required']);
        }
        if (!$request->input('barcode')){
            return response()->json(['success' => false, 'message' => 'Barcode is required']);
        }
        if (!$request->input('description')){
            return response()->json(['success' => false, 'message' => 'Description is required']);
        }
        if (!$request->input('location_of_land')){
            return response()->json(['success' => false, 'message' => 'Location is required']);
        }
        if (!$request->input('category')){
            return response()->json(['success' => false, 'message' => 'Product Category is required']);
        }
        $user = Auth::guard('api')->user();
        $category = $request->input('category');

        if ($category == 'Farm'){
            if (!$request->input('seedname')){
                return response()->json(['success' => false, 'message' => 'Seed Name is required']);
            }
            if (!$request->input('seedcompany')){
                return response()->json(['success' => false, 'message' => 'Seed Company is required']);
            }
            if (!$request->input('fertilizer')){
                return response()->json(['success' => false, 'message' => 'Fertilizer is required']);
            }
            if (!$request->input('fertilizer_company')){
                return response()->json(['success' => false, 'message' => 'Fertilizer Company is required']);
            }
            if (!$request->input('water_source')){
                return response()->json(['success' => false, 'message' => 'Water Source is required']);
            }
            if (!$request->input('harvest_date')){
                return response()->json(['success' => false, 'message' => 'Harvest Date is required']);
            }
            if (!$request->input('inspection_date')){
                return response()->json(['success' => false, 'message' => 'Inspection Date is required']);
            }
            if (!$request->input('pesticide')){
                return response()->json(['success' => false, 'message' => 'Pesticide is required']);
            }
            if (!$request->input('pesticide_company')){
                return response()->json(['success' => false, 'message' => 'Pesticide Company is required']);
            }
        }else {
            if (!$request->input('breed_type')){
                return response()->json(['success' => false, 'message' => 'Breed Type is required']);
            }
            if (!$request->input('type_of_farming')){
                return response()->json(['success' => false, 'message' => 'Type of Farming is required']);
            }
            if (!$request->input('animal_feed_type')){
                return response()->json(['success' => false, 'message' => 'Animal Feed Type is required']);
            }
            if (!$request->input('animal_feed_company')){
                return response()->json(['success' => false, 'message' => 'Animal Feed Company is required']);
            }
            if (!$request->input('animal_age')){
                return response()->json(['success' => false, 'message' => 'Animal Age is required']);
            }
        }

        if (!$user->hasRole('processingcompany')){
            if (!$request->input('location_of_farm')){
                return response()->json(['success' => false, 'message' => 'Location of Farm is required']);
            }
            if ($category == 'Farm'){
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
                return response()->json(['success' => true, 'message' => 'Product added successfully', 'product_id' => $product->id]);
            }
            else {
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

                return response()->json(['success' => true, 'message' => 'Product added successfully', 'product_id' => $product->id]);
            }
        }
        else {
            if (!$request->input('transport_mode')){
                return response()->json(['success' => false, 'message' => 'Transport Mode is required']);
            }
            if (!$request->input('processing_procedure')){
                return response()->json(['success' => false, 'message' => 'Processing Procedure is required']);
            }
            if (!$request->input('processing_chemicals')){
                return response()->json(['success' => false, 'message' => 'Processing Chemicals is required']);
            }
            if (!$request->input('processing_chemicals_companies')){
                return response()->json(['success' => false, 'message' => 'Processing Chemicals Companies is required']);
            }
            if (!$request->input('location_of_warehouse')){
                return response()->json(['success' => false, 'message' => 'Location of Warehouse is required']);
            }
            if (!$request->input('date_of_storage')){
                return response()->json(['success' => false, 'message' => 'Date of Storage is required']);
            }
            if ($category == 'Farm'){
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

                return response()->json(['success' => true, 'message' => 'Product added successfully', 'product_id' => $product->id]);
            }
            else {
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

                return response()->json(['success' => true, 'message' => 'Product added successfully', 'product_id' => $product->id]);
            }
        }
    }

    public function getProducts(){
        $user = Auth::guard('api')->user();
        $roleUser = RoleUser::where('user_id',$user->id)->first();
        $role = Role::where('id',$roleUser->role_id)->first();
        $prods = array();
        $j = 0;

        if($role->name == 'customer'){
            $products = Product::where('status','Verified')->get();
            foreach ($products as $product){
                $prods[$j] = array(
                  'id' => $product->id,
                  'name' => $product->name,
                  'image' => url($product->photo),
                  'category' => $product->category,
                  'location' => $product->location,
                  'barcode' => $product->bar_code,
                  'price' => number_format($product->price,2),
                );
                $j += 1;
            }
        }else{
            $products = Product::where('user_id',$user->id)->get();
            foreach ($products as $product){
                $prods[$j] = array(
                    'id' => $product->id,
                    'name' => $product->name,
                    'image' => url($product->photo),
                    'category' => $product->category,
                    'location' => $product->location,
                    'barcode' => $product->bar_code,
                    'price' => number_format($product->price,2),
                );
                $j += 1;
            }
        }

        return response()->json(['success' => true, 'message' => 'Product List', 'products' => $prods]);

    }

    public function oneProduct($productId){
        $product = Product::where('id',$productId)->first();
        if($product){
            $user = User::where('id',$product->user_id)->first();
            $roleUser = RoleUser::where('user_id',$user->id)->first();
            $role = Role::where('id',$roleUser->role_id)->first();
            return response()->json(['success' => true, 'message' => 'Product Picked', 'product' => $product, 'image' => url($product->photo), 'price' => number_format($product->price,2), 'userRole' => $role->name, 'userName' => $user->name]);
        }else{
            return response()->json(['success' => false, 'message' => 'Product Doesn`t Exist', 'product' => array(), 'image' => '', 'price' => '0.00', 'userRole' => '', 'userName' => '']);
        }

    }

    public function oneProductBarcode($barcode){
        $product = Product::where('bar_code',$barcode)->first();
        if($product){
            $user = User::where('id',$product->user_id)->first();
            $roleUser = RoleUser::where('user_id',$user->id)->first();
            $role = Role::where('id',$roleUser->role_id)->first();
            return response()->json(['success' => true, 'message' => 'Product Picked', 'product' => $product, 'image' => url($product->photo), 'price' => number_format($product->price,2), 'userRole' => $role->name, 'userName' => $user->name]);
        }else{
            return response()->json(['success' => false, 'message' => 'Product Doesn`t Exist', 'product' => array(), 'image' => '', 'price' => '0.00', 'userRole' => '', 'userName' => '']);
        }

    }

    public function createOrder(Request $request){
        $user = Auth::guard('api')->user();
        if (!$request->input('quantity')){
            return response()->json(['success' => false, 'message' => 'Quantity is required']);
        }
        if (!$request->input('productId')){
            return response()->json(['success' => false, 'message' => 'Product is required']);
        }

        $product = Product::where('id',$request->input('productId'))->first();
        if($product){
            if($request->input('quantity') <= $product->quantity){
                $sale = new Sale();
                $sale->product_id = $product->id;
                $sale->customer_id = $user->id;
                $sale->amount = $product->price * $request->input('quantity');
                $sale->quantity = $request->input('quantity');
                $sale->unit_of_measure = $product->unit_of_measure;
                $sale->unit_price = $product->price;
                $sale->bar_code = $product->bar_code;
                $sale->status = "Pending";
                $sale->save();

                $rem = $product->quantity - $request->input('quantity');
                $product->quantity = $rem;
                $product->save();

                return response()->json(['success' => true, 'message' => 'Your order has been received. You will receive a message of its status once the product seller updates your order status']);

            }else {
                return response()->json(['success' => false, 'message' => 'The quantity requested is not available.Please enter a lower quantity value']);
            }
        }else{
            return response()->json(['success' => false, 'message' => 'An Error Has Occured.Please Try Again']);
        }
    }

    public function rateProduct(Request $request){
        $user = Auth::guard('api')->user();
        if (!$request->input('rating')){
            return response()->json(['success' => false, 'message' => 'The Rating is required']);
        }

        if (!$request->input('productId')){
            return response()->json(['success' => false, 'message' => 'Product is required']);
        }

        $product = Product::where('id',$request->input('productId'))->first();
        if($product){
            $productRating = new ProductRating();
            $productRating->product_id = $product->id;
            $productRating->customer_id = $user->id;
            $productRating->rate = $request->input('rating');
            $productRating->save();

            return response()->json(['success' => true, 'message' => 'Product Rating Successful']);
        }else{
            return response()->json(['success' => false, 'message' => 'An Error Has Occured.Please Try Again']);
        }
    }

    public function flagProduct(Request $request){
        $user = Auth::guard('api')->user();
        if (!$request->input('reason')){
            return response()->json(['success' => false, 'message' => 'Flagging Reason is Required']);
        }
        if (!$request->input('productId')){
            return response()->json(['success' => false, 'message' => 'Product is Required']);
        }

        $product = Product::where('id',$request->input('productId'))->first();
        if($product){
            $productFlag = new ProductFlag();
            $productFlag->product_id = $product->id;
            $productFlag->customer_id = $user->id;
            $productFlag->reason = $request->input('reason');
            $productFlag->save();

            return response()->json(['success' => true, 'message' => 'Product Flagged Successfully']);
        }else{
            return response()->json(['success' => false, 'message' => 'An Error Has Occured.Please Try Again']);
        }
    }
}
