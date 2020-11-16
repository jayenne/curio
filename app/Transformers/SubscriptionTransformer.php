<?php

namespace App\Transformers;

use App\Board;
use App\Post;
use League\Fractal\TransformerAbstract;

class SubscriptionTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include.
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include.
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
        $user = \Auth::user();
        $subscription_count = $model->subscriptions()->count();
        $subscribed = $user->hasSubscribed($model);

        $responce = [
            'totals' => [
                'reacted' =>  $subscribed ? true : false,
                'count' => $subscription_count ?: 0,
            ],
        ];

        return $responce;
    }
}
