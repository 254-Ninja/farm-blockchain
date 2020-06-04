<?php

namespace App\Http\Controllers;

use App\Blacklist;
use App\BlacklistFile;
use App\Product;
use App\User;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    //
    public function blacklists (){
        $blacklists = Blacklist::paginate(20);
        foreach ($blacklists as $blacklist){
            if ($blacklist->category == 'User'){
                $user = User::find($blacklist->entity_id);
                $blacklist->entity = $user;
            }
            else {
                $product = Product::find($blacklist->entity_id);
                $blacklist->entity = $product;
            }
        }


        return view('blacklist.documents.index',compact('blacklists'));
    }

    public function blacklistDocuments ($id){
        $blacklist = Blacklist::find($id);

        if ($blacklist->category == 'User'){
            $user = User::find($blacklist->entity_id);
            $blacklist->entity = $user;
        }
        else {
            $product = Product::find($blacklist->entity_id);
            $blacklist->entity = $product;
        }

        return view('blacklist.documents.view',compact('blacklist'));
    }

    public function uploadFile (Request $request){
        $this->validate($request, [
            'blacklistfile'=>'required|mimes:doc,pdf,docx|max:2048'
        ]);

        if ($request->hasFile('blacklistfile')){
            $image = $request->file('blacklistfile');
            $iname = time().$request->file('blacklistfile')->getClientOriginalName();
            $image->move(public_path("assets/files/blacklist"), $iname);

            $blacklistfile = new BlacklistFile();
            $blacklistfile->blacklist_id = $request->input('blacklist_id');
            $blacklistfile->name = $request->file('blacklistfile')->getClientOriginalName();
            $blacklistfile->file_url = 'assets/files/blacklist/'.$iname;
            $blacklistfile->save();

            return redirect()->back()->with('success','Blacklist file added successfully');
        }
        else {
            return redirect()->back()->with('warning','Nothing to upload');
        }
    }
}
