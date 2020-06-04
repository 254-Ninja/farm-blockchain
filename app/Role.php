<?php

namespace App;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    //
    public function roleUsers(){
        return $this->hasMany(RoleUser::class,'role_id','id');
    }

    public function users (){
        return $this->roleUsers()->with('user');
    }
}
