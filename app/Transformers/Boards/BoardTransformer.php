<?php

namespace App\Transformers\Boards;

use App\Board;
use App\Transformers\MediaTransformer;
//use App\Post;
use App\Transformers\Posts\PostTransformer;
use App\Transformers\ReactionTransformer;
//use App\Transformers\Boards\BoardPostTransformer;
use App\Transformers\SubscriptionTransformer;
use App\Transformers\TagTransformer;
use App\Transformers\Users\UserTransformer;
use App\User;
use League\Fractal\TransformerAbstract;
use Spatie\Tags\Tag;

class BoardTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        //'media',
        //'user',
        //'posts',
        //'subscriptions',
        //'reactions',
        //'tags',
    ];

    protected $availableIncludes = [
        'media',
        'user',
        'posts',
        'reactions',
        'subscriptions',
        'tags',
    ];

    public function transform(Board $model)
    {
        $posts_limit = $model->posts_limit ?: config('platform.database.boards.posts_limit');
        $columns = $model->columns ?? config('platform.database.boards.columns.default');
        $cols = config('platform.database.boards.columns.classes');
        $column_classes = $cols[$columns];

        return [
            'id' => (int) $model->id,
            'type' => 'board',
            'curator' => [
                'id' => (int) $model->user_id,
            ],
            //'slug' => (string) $model->slug,
            'cover' => 'foobar',
            'title' => ucfirst($model->title),
            'body' => ucfirst($model->body),
            'members' => (bool) $model->status,
            'post_count' => $model->posts_count,
            'subscribers_count' => $model->subscribers()->count(),
            'is_subscribed' => \Auth::User()->hasSubscribed($model),
            'categories' => $this->getTagsAsCSV($model->tagsWithType('cat', ' ')),
            'hashtags' => $this->getTagsAsCSV($model->tagsWithType('hashtag')),
            'notes' => $model->notes,
            'settings' => [
                'theme' => $model->theme,
                'layout' => $model->layout,
                'orderby' => $model->orderby,
                'columns' => $model->columns,
                'size' => $column_classes,
                'posts_limit' => $posts_limit,
                'sensitive' => (bool) $model->sensitive,
            ],
            'status' => [
                'name' => $model->status,
                'reason' => $model->status()->reason ?? null,
            ],
            'dates' => [
                'created' => $model->created_at->format('Y-m-d H:i:s'),
                'created_string' => \Carbon\Carbon::parse($model->created_at)->diffForHumans(),
                'updated' => $model->updated_at->format('Y-m-d H:i:s'),
                'updated_string' => \Carbon\Carbon::parse($model->updated_at)->diffForHumans(),
            ],
            'user' => $model->user ?? null,
            //'posts' => null,//$model->posts->take($posts_limit),
        ];
    }

    private function getTagsAsCSV($tags, $delimiter = ',')
    {
        $arr = [];
        foreach ($tags as $tag) {
            $arr[] = $tag['name'];
        }
        $str = implode($delimiter, $arr);

        return $str;
    }

    public function includeUser(Board $model)
    {
        return $this->item($model->user, new UserTransformer);
    }

    public function includePosts(Board $model)
    {
        $posts_limit = $model->posts_limit ?: config('platform.database.boards.posts_limit');
        $posts = $model->direction ? $model->posts->sortByDesc($model->orderby) : $model->posts->sortBy($model->orderby)->take($posts_limit);
        $posts = $model->posts;

        if ($model->posts_count > 0) {
            return $this->collection($posts, new PostTransformer);
        }
    }

    public function includeMedia(Board $model)
    {
        $transformer = new MediaTransformer;
        $transformer->type = ['cover'];
        $transformer->sizes = ['small']; // array_keys(config('platform.media.boards'));
        $transformer->fallback = config('platform.media.boards');
        $data = $this->collection($model->media, $transformer);

        return $data;
    }

    // public function includePostsMedia(Board $model)
    // {
    //     //dd('modelpostmedia', $models);
    //     $posts_limit = $model->posts_limit ?: config('platform.database.boards.posts_limit');
    //     //$posts_media = $model->direction ?
    //     ///$model->posts->sortByDesc($model->orderby) :
    //     dd('postsmediaall', $model->posts[0]->media[0]);

    //     $models =  $model->posts
    //             ->sortBy($model->orderby)
    //             ->take($posts_limit)
    //             ->pluck('media');

    //     //dd('board postmedia', $model->id, $models->count());
    //     //dd($models[0]->getMedia('cover')[0]->getUrl('small'));
    //     $transformer = new MediaTransformer;
    //     $transformer->type = ['cover'];
    //     $transformer->sizes = ['small']; // array_keys(config('platform.media.post'));
    //     $transformer->fallback = config('platform.media.post');
    //     $data = $this->collection($models[0], $transformer);
    //     //dd('modelpostmedia data', $data);
    //     return $data;
    // }
    // public function includePostsMedia(Board $model)
    // {
    //     $posts_limit = $model->posts_limit ?: config('platform.database.boards.posts_limit');
    //     //$posts_media = $model->direction ?
    //     ///$model->posts->sortByDesc($model->orderby) :
    //     $models =  $model->posts
    //             ->sortBy($model->orderby)
    //             ->take($posts_limit);

    //     //$covers = [];
    //     //foreach($models as $model) {
    //     $media = $model->getMedia('cover');
    //     $result =  $this->collection($media, new MediaTransformer);
    //     //}

    //     return $result;
    // }

    public function includeTags(Board $model)
    {
        $tags = $model->tags;
        if (! is_null($tags)) {
            return $this->collection($model->tags, new TagTransformer);
        }
    }

    public function includeReactions(Board $model)
    {
        return $this->item($model, new ReactionTransformer);
    }

    public function includeSubscriptions(Board $model)
    {
        return $this->item($model, new SubscriptionTransformer);
    }
}
