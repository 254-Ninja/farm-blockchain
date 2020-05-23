<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //
    protected $table = 'sales';

    public function product (){
       return $this->belongsTo(Product::class);
    }

    public function user (){
        return $this->product()->with('user');
    }
}
