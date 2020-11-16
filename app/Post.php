<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Board;
use App\PostRemoteMedia;
use App\User;
use Cog\Contracts\Love\Reactable\Models\Reactable as ReactableContract;
use Cog\Laravel\Love\Reactable\Models\Traits\Reactable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Overtrue\LaravelSubscribe\Traits\Subscribable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\ModelStatus\HasStatuses;
use Spatie\Tags\HasTags;

class Post extends Model implements ReactableContract, HasMedia
{
    use HasFactory;

    use SoftDeletes,
        Searchable,
        InteractsWithMedia,
        Reactable,
        Subscribable,
        HasTags,
        HasStatuses,
        LogsActivity;

    protected $fillable = ['user_id', 'title', 'text', 'type', 'notes', 'sensitive', 'status', 'lang', 'source_id', 'source_permalink', 'source_user_id', 'source_platform_id', 'tags', 'hash', 'posted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function boards()
    {
        return $this->belongsToMany(Board::class)->withPivot('index');
    }

    public function mentions()
    {
        return $this->belongsToMany(\App\PostMentions::class);
    }

    public function urls()
    {
        return $this->belongsToMany(\App\PostUrls::class);
    }

    public function remoteMedia()
    {
        return $this->belongsToMany(\App\PostRemoteMedia::class);
    }

    public function lang()
    {
        return $this->hasOne(\App\Languages::class);
    }

    public function ProcessTweet()
    {
        dispatch(new ProcessTweet());
    }

    // Setup Algolia
    public function searchableAs()
    {
        return 'posts_index';
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();

        return $array;
    }

    public function getScoutKey()
    {
        return $this->id;
    }

    public function getScoutKeyName()
    {
        return 'id';
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('small')
            ->width(config('platform.media.posts.small.width'))
            ->height(config('platform.media.posts.small.height'))
            ->quality(80)
            ->performOnCollections('image', 'cover')
            ->nonQueued();

        $this->addMediaConversion('medium', 'cover')
            ->width(config('platform.media.posts.medium.width'))
            ->height(config('platform.media.posts.medium.height'))
            ->quality(80)
            ->performOnCollections('image', 'cover')
            ->nonQueued();

        $this->addMediaConversion('large')
            ->width(config('platform.media.posts.large.width'))
            ->height(config('platform.media.posts.large.height'))
            ->quality(80)
            ->performOnCollections('cover')
            ->nonQueued();
    }
}
