<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Post;
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

//use Laravel\Scout\Searchable;

class Board extends Model implements ReactableContract, HasMedia
{
    use HasFactory;

    use SoftDeletes,
        Searchable,
        Reactable,
        InteractsWithMedia,
        HasTags,
        HasStatuses,
        Subscribable,
        LogsActivity;

    //use Searchable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'slug', 'title', 'body', 'sensitive', 'tags', 'theme', 'layout', 'direction', 'columns', 'posts_limit',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class)->withPivot('index', 'position')->orderBy('board_post.index')->withCount('boards');
    }

    public function isSubscriber()
    {
        return $this->subscribers();
    }

    // Setup Algolia
    public function searchableAs()
    {
        return 'boards_index';
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
            ->width(config('platform.media.boards.small.width'))
            ->height(config('platform.media.boards.small.height'))
            ->quality(80)
            ->performOnCollections('cover')
            ->nonQueued();

        $this->addMediaConversion('medium')
            ->width(config('platform.media.boards.medium.width'))
            ->height(config('platform.media.boards.medium.height'))
            ->quality(80)
            ->performOnCollections('cover')
            ->nonQueued();

        $this->addMediaConversion('large')
            ->width(config('platform.media.boards.large.width'))
            ->height(config('platform.media.boards.large.height'))
            ->quality(80)
            ->performOnCollections('cover')
            ->nonQueued();

        $this->addMediaConversion('x-large')
            ->width(config('platform.media.boards.x-large.width'))
            ->height(config('platform.media.boards.x-large.height'))
            ->quality(80)
            ->performOnCollections('cover')
            ->nonQueued();
    }
}
