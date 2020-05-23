<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\ProductCategory;
use App\Role;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function showRegistrationForm (){
        $categories = ProductCategory::all();
        return view('auth.register',compact('categories'));
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'membership' => ['required'],
            'phone' => ['required'],
            'location' => ['sometimes'],
            'product' => ['sometimes'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    /*protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }*/
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $errors = [];
        if($request->input('membership') != 'customer'){
            if (!$request->input('location')){
                $errors['location'] = 'Location is required for this membership type';
            }

            if (!$request->input('product')){
                $errors['product'] = 'Product category is required for this membership type';
            }

            if(count($errors)) {
                return  redirect()->back()->withErrors($errors);
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

        // $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect()->route('login')->with('success','Account created successfully. Please continue to login');
    }
}
