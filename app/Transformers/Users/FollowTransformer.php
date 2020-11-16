<?php

namespace App\Transformers\Users;

use League\Fractal\TransformerAbstract;

class FollowTransformer extends TransformerAbstract
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

        $isFollowing = $user->isFollowing($model);
        $isFollowed = $user->isFollowedBy($model);
        $isReciprocal = $user->areFollowingEachOther($model);

        $following = $model->followings->count();
        $followers = $model->followers->count();

        return [
            'totals' => [
                'reacted' => (bool) $isFollowing,
                'is_following' => (bool) $isFollowing,
                'is_followed' => (bool) $isFollowed,
                'is_reciprocal'=> (bool) $isReciprocal,
                'followers_count' => (int) $followers,
                'following_count' => (int) $following,
            ],
            'items' => [],
            'meta' => [],
        ];
    }
}
