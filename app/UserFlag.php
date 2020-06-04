<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFlag extends Model
{
    //
    protected $table = 'user_flags';

    public function user (){
        return $this->belongsTo(User::class,'user_id');
    }

    public function customer (){
        return $this->belongsTo(User::class,'customer_id');
    }
}
