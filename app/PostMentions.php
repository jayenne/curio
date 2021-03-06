<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//use Laravel\Scout\Searchable;

class PostMentions extends Model
{
    //use Searchable;
    //public $timestamps = false;
    
    protected $fillable = [
        'social_id', 'handle',
    ];
    
    public function posts()
    {
        return $this->belongsToMany(\App\Post::class)->withTimestamps();
    }
}
