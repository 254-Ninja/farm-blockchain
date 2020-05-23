<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blacklist extends Model
{
    //
    protected  $table = 'blacklist';

    public function files (){
        return $this->hasMany(BlacklistFile::class);
    }
}
