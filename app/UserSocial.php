<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSocial extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'service',
        'social_id',
        'name',
        'first_name',
        'last_name',
        'email',
        'nickname',
        'cover',
        'avatar',
        'description',
        'url',
        'location',
        'following',
        'suspended',
        'token',
        'token_secret',
        'destroy'
    ];
    
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
