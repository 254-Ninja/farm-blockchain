<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductFlag extends Model
{
    //
    public function product (){
        return $this->belongsTo(Product::class);
    }

    public function customer (){
        return $this->belongsTo(User::class,'customer_id');
    }
}
