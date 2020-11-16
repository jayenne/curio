<?php

namespace App\Transformers\Posts;

use App\Helpers\CuriousPeople\CuriousStr;
use League\Fractal\TransformerAbstract;

class RemoteMediaTransformer extends TransformerAbstract
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
                'url' => $item->url,
                'cover' => $item->image,
                'color' => $item->color,
                'invert' => $item->brightness <= 0.5 ? 'invert' : '',
                'fallback' => $item->grid_image ?? null,
                'title' => (string) $item->title ?: ((string) $item->alt ?: null),
                //'created_at' => $item->created_at->toIso8601String(),
                //'updated_at' => $item->updated_at->toIso8601String(),
            ];
        }

        return ['data' => $data];
    }
}
