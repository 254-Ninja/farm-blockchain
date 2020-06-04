<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = "role_user";

    public function userRole (){
        return $this->belongsTo(Role::class,'role_id');
    }

    public function user (){
        return $this->belongsTo(User::class, 'user_id');
    }
}
