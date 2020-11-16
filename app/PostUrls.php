<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostUrls extends Model
{
    use HasFactory;

    //public $timestamps = false;

    protected $fillable = [
        'url', 'site', 'title', 'body', 'image', 'alt', 'type', 'locale', 'opengraph',
    ];

    public function posts()
    {
        return $this->belongsToMany(\App\Post::class)->withTimestamps();
    }
}
