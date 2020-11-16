<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostRemoteMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'url', 'image', 'title', 'alt', 'type', 'content_type', 'grid_image', 'brightness', 'color',
    ];

    public function posts()
    {
        return $this->belongsToMany(\App\Post::class)->withTimestamps();
    }
}
