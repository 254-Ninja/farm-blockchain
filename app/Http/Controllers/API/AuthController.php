<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\ProductCategory;
use App\Role;
use App\RoleUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'membership' => 'required',
            'password' => 'required',
            'phone' => 'required',
        ]);
        if($request->input('membership') != 'customer'){
            if (!$request->input('location')){
                return response()->json(['success' => false, 'message' => 'Location is required for this membership type']);
            }

            if (!$request->input('product')){
                return response()->json(['success' => false, 'message' => 'Product category is required for this membership type']);
            }
        }
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->phone_number = $request->input('phone');
        $user->location = $request->input('location');
        $user->product_category = $request->input('product');
        $user->save();

        $role = Role::where('display_name',$request->input('membership'))->first();
        $user->attachRole($role);

        if($user){
            return response()->json(['success' => true, 'message' => 'Registration Successfull']);
        }else{
            return response()->json(['success' => false, 'message' => 'Registration UnSuccessfull']);
        }



    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        $user = User::where('email',$request->input('email'))->where('verified',true)->first();
        if($user == null){
            return response()->json(['success' => false, 'message' => 'Your Account Has Not Been Verified Yet.Please Contact The Administrator For Further Details']);
        }

        if (! $token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['success' => false, 'message' => 'Unauthorized']);
        }

        $roleUser = RoleUser::where('user_id',$user->id)->first();
        $role = Role::where('id',$roleUser->role_id)->first();

        return $this->respondWithToken($token,$role->name);
    }

    public function logout()
    {
        Auth::guard('api')->logout();

        return response()->json(['success' => true, 'message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token,$role)
    {

        return response()->json([
            'success' => true,
            'message' => 'Successfully logged in',
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => Auth::guard('api')->factory()->getTTL() * 60,
            'role' => $role
        ]);
    }

    public function user()
    {
        $user = Auth::guard('api')->user();

        $roleUser = RoleUser::where('user_id',$user->id)->first();
        $role = Role::where('id',$roleUser->role_id)->first();
        $category = ProductCategory::where('id',$user->product_category)->first();

        if($category){
            return response()->json([
                'success' => true,
                'message' => 'User Details',
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $role->name,
                'phone' => $user->phone_number,
                'category' => $category->display_name,
            ]);
        }else{
            return response()->json([
                'success' => true,
                'message' => 'User Details',
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $role->name,
                'phone' => $user->phone_number,
                'category' => 'Farm',
            ]);
        }
    }
}
