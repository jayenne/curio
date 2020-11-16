<?php

namespace App\Transformers\Posts;

use League\Fractal\TransformerAbstract;

class MentionsTransformer extends TransformerAbstract
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
            $data[] = [
                //'id' => (int) $item->id,
                'social_id' => $item->social_id,
                'handle' => $item->handle,
                //'created_at' => $item->created_at->toIso8601String(),
                //'updated_at' => $item->updated_at->toIso8601String(),
            ];
        }

        return $data;
    }
}
