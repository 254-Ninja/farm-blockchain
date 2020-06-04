<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public function user (){
        return $this->belongsTo(User::class);
    }

    public function orders (){
        return $this->hasMany(Sale::class);
    }

    protected $casts = [
        'extra'=>'array'
    ];
}
