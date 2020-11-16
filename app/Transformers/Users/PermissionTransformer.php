<?php

namespace App\Transformers\Users;

use League\Fractal\TransformerAbstract;
use Spatie\Permission\Models\Permission;

/**
 * Class PermissionTransformer.
 */
class PermissionTransformer extends TransformerAbstract
{
    /**
     * @param Permission $model
     * @return array
     */
    public function transform(Permission $model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            //'created_at' => $model->created_at->toIso8601String(),
            //'updated_at' => $model->updated_at->toIso8601String(),
        ];
    }
}
