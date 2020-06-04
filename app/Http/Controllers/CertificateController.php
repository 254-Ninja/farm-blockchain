<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $certificates = Certificate::all();

        return view('certificates.index',compact('certificates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Auth::user()->hasRole('government')){
            $users = User::all();

            return view('certificates.create',compact('users'));
        }
        else {
            return redirect()->route('dashboard')->with('error','Sorry. You are not authorised to access this service');
        }
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
        if (Auth::user()->hasRole('government')){
            $this->validate($request,[
                'member'=>'required',
                'certificate'=>'required|mimes:pdf,doc,docx|max:2048',
                'description'=>'required'
            ]);

            $certificate = new Certificate();
            $certificate->user_id = $request->input('member');
            $certificate->description = $request->input('description');
            if ($request->hasFile('certificate')){
                $image = $request->file('certificate');
                $iname = time().$request->file('certificate')->getClientOriginalName();
                $image->move(public_path("assets/documents/certificates"), $iname);
                $certificate->certificate = 'assets/documents/certificates/'.$iname;
            }
            $certificate->status = 'Unverified';
            $certificate->save();

            return redirect()->route('certificate.index')->with('success','Certificate added successfully');
        }
        else {
            return redirect()->route('dashboard')->with('error','Sorry. You are not authorised to access this service');
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
            $certificate = Certificate::find($id);
            $certificate->status = 'Verified';
            $certificate->save();

            return redirect()->back()->with('success','Certificate has been verified');
        }
        else {
            return redirect()->route('dashboard')->with('error','Sorry. You are not authorised to access this service');
        }
    }

    public function show($id)
    {
        //
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
