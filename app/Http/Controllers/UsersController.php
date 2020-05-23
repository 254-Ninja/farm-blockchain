<?php

namespace App\Http\Controllers;

use App\Blacklist;
use App\ProductFlag;
use App\Role;
use App\User;
use App\UserFlag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laratrust\Laratrust;

class UsersController extends Controller
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
        if ($user->hasRole(['administrator','government'])){
            $users = User::all();

            return view('users.index',compact('users'));
        }
        else {
            return redirect()->route('dashboard')->with('error','Sorry. You are not authorised to access this service');
        }
    }

    public function verify($id){
        if (Auth::user()->hasRole(['government','administrator'])){
            $user = User::find($id);
            $user->verified = 1;
            $user->save();

            return redirect()->back()->with('success','User membership has been verified');
        }
        else {
            return redirect()->route('dashboard')->with('error','Sorry. You are not authorised to access this service');
        }
    }

    public function profile (){
        $user = Auth::user();

        return view('profile.view',compact('user'));
    }

    public function editProfile (){
        $user = Auth::user();

        return view('profile.edit',compact('user'));
    }

    public function updateProfile (Request $request){
        $this->validate($request,[
            'profile_pic'=>'sometimes|mimes:jpg,jpeg,png|max:2048'
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_pic')){
            $image = $request->file('profile_pic');
            $iname = time().$request->file('profile_pic')->getClientOriginalName();
            $image->move(public_path("assets/images/profile"), $iname);

            if ($user->profile_pic){
                unlink($user->profile_pic);
            }

            $user->profile_pic = 'assets/images/profile/'.$iname;
            $user->save();

            return redirect()->route('profile/view')->with('success','Profile Updated');
        }
        else {
            return redirect()->route('profile/view')->with('warning','Nothing to update');
        }
    }

    public function userBlacklist (){
        if (Auth::user()->hasRole(['government','administrator'])){
            $users = UserFlag::paginate(20);

            return view('blacklist.users',compact('users'));
        }
        else {
            return redirect()->route('dashboard')->with('error','Sorry. You are not authorised to access this service');
        }
    }

    public function blacklistUser ($id){
        if (Auth::user()->hasRole(['government','administrator'])){
            $user = User::find($id);
            $user->verified = 0;
            $user->save();

            //create blacklist record
            if (Blacklist::where('entity_id',$user->id)->first()){
                return redirect()->back()->with('warning','User membership already suspended');
            }
            else {
                $blacklist = new Blacklist();
                $blacklist->category = 'User';
                $blacklist->entity_id = $user->id;
                $blacklist->save();

                return redirect()->back()->with('success','User membership suspended');
            }
        }
        else {
            return redirect()->route('dashboard')->with('error','Sorry. You are not authorised to access this service');
        }
    }

    public function farmers (){
        if (Auth::user()->hasRole(['processingcompany','administrator'])){
            $farmers = Role::where('name','farmer')->with('users')->first();

            return view('users.farmers',compact('farmers'));
        }
        else {
            return redirect()->route('dashboard')->with('error','Sorry. You are not authorised to access this service');
        }

    }

    public function farmerShow ($id){
        $user = User::find($id);

        return view('users.viewfarmer',compact('user'));
    }

    public function processingCompanies (){
        if (Auth::user()->hasRole(['farmer','administrator'])){
            $companies = Role::where('name','processingcompany')->with('users')->first();

            return view('users.processingcompanies',compact('companies'));
        }
        else {
            return redirect()->route('dashboard')->with('error','Sorry. You are not authorised to access this service');
        }
    }

    public function processingcompanyShow ($id){
        $user = User::find($id);

        return view('users.viewcompany',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::find($id);

        return view('users.view',compact('user'));
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
