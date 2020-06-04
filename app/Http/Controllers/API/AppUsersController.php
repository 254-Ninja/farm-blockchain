<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductCategory;
use App\Role;
use App\RoleUser;
use App\Sale;
use App\User;
use App\UserRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppUsersController extends Controller
{
    public function getFarmers(){
        $role = Role::where('name','farmer')->first();
        $roleUsers = RoleUser::where('role_id',$role->id)->get();
        $farmers = array();
        $i = 0;

        foreach ($roleUsers as $roleUser){
            $user = User::where('id',$roleUser->user_id)->where('verified',true)->first();
            if($user){
                $cat = ProductCategory::where('id',$user->product_category)->first();
                if($user->profile_pic){
                    $farmers[$i] = array(
                        'id' => $user->id,
                        'name' => $user->name,
                        'category' => $cat->name,
                        'location' => $user->location,
                        'image' => url($user->profile_pic)

                    );
                }else{
                    $farmers[$i] = array(
                        'id' => $user->id,
                        'name' => $user->name,
                        'category' => $cat->name,
                        'location' => $user->location,
                        'image' => ''

                    );
                }
                $i += 1;

            }
        }

        return response()->json(['success' => true, 'message' => 'Farmers List', 'farmers' => $farmers]);
    }

    public function getCompanies(){
        $role = Role::where('name','processingcompany')->first();
        $roleUsers = RoleUser::where('role_id',$role->id)->get();
        $companies = array();
        $i = 0;

        foreach ($roleUsers as $roleUser){
            $user = User::where('id',$roleUser->user_id)->where('verified',true)->first();
            if($user){
                $cat = ProductCategory::where('id',$user->product_category)->first();
                if($user->profile_pic){
                    $companies[$i] = array(
                        'id' => $user->id,
                        'name' => $user->name,
                        'category' => $cat->name,
                        'location' => $user->location,
                        'image' => url($user->profile_pic)

                    );
                }else{
                    $companies[$i] = array(
                        'id' => $user->id,
                        'name' => $user->name,
                        'category' => $cat->name,
                        'location' => $user->location,
                        'image' => ''

                    );
                }
                $i += 1;

            }
        }

        return response()->json(['success' => true, 'message' => 'Processing Companies List', 'companies' => $companies]);
    }

    public function oneUser($userId)
    {
        $category = '';
        $rate = 0;
        $user = User::where('id', $userId)->first();
        $cat = ProductCategory::where('id',$user->product_category)->first();
        if($cat){
            $category = $cat->display_name;
        }
        $rating = UserRating::where('user_id',$user->id)->orderBy('created_at', 'desc')->first();
        if($rating){
            $rate = $rating->rate;
        }

        if($user->profile_pic){
            return response()->json(['success' => true, 'message' => 'One Farmer Details', 'appuser' => $user, 'category' => $category, 'rate' => $rate, 'image' => url($user->profile_pic)]);
        }else{
            return response()->json(['success' => true, 'message' => 'One Farmer Details', 'appuser' => $user, 'category' => $category, 'rate' => $rate, 'image' => '']);
        }

    }
}
