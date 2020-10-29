<?php

namespace App\Transformers\Users;

use Spatie\Permission\Models\Role;
use League\Fractal\TransformerAbstract;

/**
 * Class RoleTransformer.
 */
class RoleTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    //protected $defaultIncludes = ['permissions'];

    /**
     * @param Role $model
     * @return array
     */
    public function transform(Role $model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            //'created_at' => $model->created_at->toIso8601String(),
            //'updated_at' => $model->updated_at->toIso8601String(),
        ];
    }

    /**
     * @param Role $model
     * @return \League\Fractal\Resource\Collection
     */
    public function includePermissions(Role $model)
    {
        return $this->collection($model->permissions, new PermissionTransformer());
    }
}
