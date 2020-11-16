<?php

namespace App\Transformers\Users;

use League\Fractal\TransformerAbstract;

class SocialsTransformer extends TransformerAbstract
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
        $data = [];
        foreach ($model as $item) {
            $data[$item->service] = [
                'nickname' => ucfirst($item->nickname),
                'cover' => $item->cover ?: config('platform.fallback.user.cover'),
                'avatar' => $item->avatar ?: config('platform.fallback.user.avatar'),
            ];
        }

        return $data;
    }
}
