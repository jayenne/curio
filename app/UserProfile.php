<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UserProfile extends Model implements HasMedia
{
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'nickname',
        'title',
        'body',
        'location',
        'url',
        'sex',
        'gender',
    ];

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('x-small')
            ->width(config('platform.media.users.x-small.width'))
            ->height(config('platform.media.users.x-small.height'))
            ->quality(80)
            ->performOnCollections('avatar')
            ->nonQueued();

        $this->addMediaConversion('small')
            ->width(config('platform.media.users.small.width'))
            ->height(config('platform.media.users.small.height'))
            ->quality(80)
            ->performOnCollections('avatar', 'cover')
            ->nonQueued();

        $this->addMediaConversion('medium')
            ->width(config('platform.media.users.medium.width'))
            ->height(config('platform.media.users.medium.height'))
            ->quality(80)
            ->performOnCollections('cover')
            ->nonQueued();
    }
}
