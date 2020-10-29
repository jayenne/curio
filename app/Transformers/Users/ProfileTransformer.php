<?php

namespace App\Transformers\Users;

use App\User;
use App\UserProfile;
use League\Fractal\TransformerAbstract;
use App\Transformers\MediaTransformer;

class ProfileTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'media'
    ];
    
    /**
     * List of resources possible to include
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
        $social = $model->user->socials()->where('service', 'twitter')->first();
        
        //REFACTOR: COVER/AVATAR TO MEDIA TRANSFORMER
        $cover = $model->getMedia('cover')->last() ?
            $model->getMedia('cover')->last()->getUrl('medium') :
            (
                $social['cover'] ?: config('platform.media.users.cover')
            );

        $avatar = $model->getMedia('avatar')->last() ?
            $model->getMedia('avatar')->last()->getUrl('small') :
                (
                    $social['avatar'] ?: config('platform.media.avatar')
                );
        //dd([$cover,$avatar]);

        return [
            //'id' => $model->id,
            'nickname' => ucfirst($model->nickname),
            'cover' =>  $cover ?? null,
            'avatar' => $avatar,
            'intro' =>trim($model->title),
            'bio' =>trim($model->body),
            'location' => trim($model->location),
        ];
    }

    /**
     * [includeMedia description]
     * @param  UserProfile $model [description]
     * @return [type]             [description]
     */
    public function includeMedia(UserProfile $model)
    {
        $media = new MediaTransformer;
        $media->type = ['cover','avatar'];
        $media->sizes = ['small']; // array_keys(config('platform.media.boards'));
        $media->fallback = config('platform.media.users');
        return $this->collection($model->media, $media);
    }
}
