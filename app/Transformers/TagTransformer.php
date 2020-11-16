<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use Spatie\Tags\Tag;

/**
 * Class PermissionTransformer.
 */
class TagTransformer extends TransformerAbstract
{
    /**
     * @param Permission $model
     * @return array
     */
    public function transform(Tag $model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'slug' => $model->slug ?: \Str::uuid(),
            'created_at' => $model->created_at->toIso8601String(),
            'updated_at' => $model->updated_at->toIso8601String(),
        ];
    }
}
