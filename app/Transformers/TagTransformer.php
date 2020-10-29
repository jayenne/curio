<?php

namespace App\Transformers;

use Spatie\Tags\Tag;

use League\Fractal\TransformerAbstract;

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
