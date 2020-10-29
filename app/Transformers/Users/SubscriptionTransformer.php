<?php

namespace App\Transformers\Users;

use League\Fractal\TransformerAbstract;
use App\Board;
use App\Post;

class SubscriptionTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($model)
    {
        $subscription_count = $model->subscriptions()->count();
        $post_count = $model->subscriptions()->withType(Post::class)->count();
        $board_count = $model->subscriptions()->withType(Board::class)->count();
        
        return
            [
                'totals' => [
                    'count' => $subscription_count,
                    'posts' => $post_count,
                    'boards' => $board_count,
                ],
                'items' => [],
                'meta' => [],
            ];
    }
}
