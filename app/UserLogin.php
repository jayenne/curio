<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLogin extends Model
{
    //    
    function user() {
        return $this->hasOne(User::class);
    }
}
