<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class MediaTransformer extends TransformerAbstract
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
        $result = [];
        foreach ($this->sizes as $key => $size) {
            if ($model->hasGeneratedConversion($size)) {
                $result[$size] = $model->getUrl($size);
            }
        }

        return $result;
    }
}
