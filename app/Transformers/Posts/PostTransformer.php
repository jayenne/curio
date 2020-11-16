<?php

namespace App\Transformers\Posts;

use App\Board;
use App\Post;
use App\PostMentions;
use App\PostUrls;
use App\Transformers\Boards\BoardTransformer;
use App\Transformers\MediaTransformer;
use App\Transformers\Posts\RemoteMediaTransformer;
use App\Transformers\ReactionTransformer;
use App\Transformers\SubscriptionTransformer;
use App\Transformers\TagTransformer;
use App\Transformers\Users\UserTransformer;
use App\User;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;
use Spatie\Tags\Tag;

class PostTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        //'user',
        'remoteMedia',
        'media',
        'reactions',
        'subscriptions',
        'tags',
        //'boards',
    ];

    protected $availableIncludes = [
        'remoteMedia',
        'media',
        'user',
        'boards',
        'urls',
        'mentions',
        'reactions',
        'subscriptions',
        'tags',
    ];

    public function transform(Post $model)
    {
        return [
            'id' => (int) $model->id,
            'prid' => (int) $model->love_reactant_id,
            'puid' => (int) $model->user->id,
            'purid' => (int) $model->user->love_reactant_id,
            'position' => [
                'index' => $model->pivot->index ?? null,
                'x' => $model->pivot->position ?? 0.0,
            ],
            'created_by' => (int) $model->user_id,
            'title' => ucfirst($model->title),
            'body' => ucfirst($model->text),
            'type' => $this->typemap($model->type ?? 'text'),
            'theme' => $model->theme,
            'board_width' => 100 / 3,
            'notes' => ucfirst($model->notes),
            'language' => $model->lang,
            'source' => [
                'name' => $model->source_platform_id,
                'icon' => ['sources/'.$model->source_platform_id, 'icons/source-default'],
                'url' => $model->source_permalink,
                ],
                'sensitive' => $model->sensitive,
                'members' => (int) $model->public,
                'posted_at' => $model->posted_at,

            //USER
                'is_subscribed' => \Auth::User()->hasSubscribed($model),

            //COUNTS
                'boards_count' => $model->boards_count,
                'subscribers_count' => $model->subscribers()->count(),
                'status' => [
                'name' => $model->status,
                'reason' => $model->status()->reason ?? null,
                'online' => [
                    'online_since' => $model->login_at,
                    'online_since_string' => \Carbon\Carbon::parse($model->login_at)->diffForHumans(),
                    'last_action' => $model->active_at,
                    'last_action_string' => \Carbon\Carbon::parse($model->active_at)->diffForHumans(),
                ],

                ],
            ];
    }

    /*-------- OPTIONALS --------*/
    public function typemap($type)
    {
        switch ($type) {
            case 'animated_gif':
                $type = 'anim';
                break;
        }

        return $type;
    }

    public function includeUser(Post $model)
    {
        return $this->item($model->user, new UserTransformer);
    }

    public function includeBoards(Post $model)
    {
        $boards = $model->boards;

        return $this->collection($boards, new BoardTransformer);
    }

    public function includeTags(Post $model)
    {
        $tags = $model->tags;
        if (! is_null($tags)) {
            return $this->collection($model->tags, new TagTransformer);
        }
    }

    // public function includeMedia(Post $model)
    // {
    //     return $this->collection($model->media, new MediaTransformer);
    // }
    public function includeMedia(Post $model)
    {
        $media = new MediaTransformer;
        $media->type = ['cover'];
        $media->sizes = array_keys(config('platform.media.posts'));
        $media->fallback = config('platform.media.posts');

        return $this->collection($model->media, $media);
    }

    public function includeRemoteMedia(Post $model)
    {
        $media = new MediaTransformer;
        $media->type = ['cover'];
        $media->sizes = array_keys(config('platform.media.posts'));
        $media->fallback = config('platform.media.posts');

        return $this->item($model->remoteMedia, new RemoteMediaTransformer);
    }

    public function includeUrls(Post $model)
    {
        return $this->item($model->urls, new UrlsTransformer);
    }

    public function includeMentions(Post $model)
    {
        return $this->item($model->mentions, new MentionsTransformer);
    }

    public function includeReactions(Post $model)
    {
        return $this->item($model, new ReactionTransformer);
    }

    public function includeSubscriptions(Post $model)
    {
        return $this->item($model, new SubscriptionTransformer);
    }
}
