<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Languages extends Model
{
    //
    public function posts()
    {
        return $this->belongsToMany(\App\UserPosts::class);
    }
}
