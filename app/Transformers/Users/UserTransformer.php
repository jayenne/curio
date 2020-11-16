<?php

namespace App\Transformers\Users;

use App\Transformers\MediaTransformer;
use App\Transformers\ReactionTransformer;
use App\Transformers\TagTransformer;
use App\Transformers\Users\FollowTransformer;
use App\Transformers\Users\SubscriptionTransformer;
use App\User;
use App\UserProfile;
use App\UserSocial;
use Jayenne\LaravelLocaleHero\LocaleHero;
use League\Fractal\TransformerAbstract;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Tags\Tag;

/**
 * Class UserTransformer.
 */
class UserTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'profile',
        'reactions',
        'follows',
        'subscriptions',
        // 'socials'
    ];

    protected $availableIncludes = [
        'roles',
        'permissions',
    ];

    /**
     * @param User $model
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id' => $model->id,
            'email' => $model->email,
            'username' => ucfirst($model->username),
            'name' => ucfirst($model->first_name).' '.ucfirst($model->last_name),
            'first_name' => ucfirst($model->first_name),
            'last_name' => ucfirst($model->last_name),
            'locale' => $model->locale_code,
            'locale_is_default' => $model->lang_country == null ? true : false,
            'country' => [
                'code' => \LocaleHero::countryCode(),
                'name' => \LocaleHero::countryName(),
                'name_local' => \LocaleHero::countryNameLocal(),
                'flag' => \LocaleHero::emojiFlag(),
            ],
            'language' => [
                'code' => \LocaleHero::languageCode(),
                'name' => ucfirst(\LocaleHero::languageName()),
                'all' => \LocaleHero::allLanguages(),
            ],
            'currency' => [
                'currency_code' => \LocaleHero::currencyCode(),
                'currency_symbol' => \LocaleHero::currencySymbol(),
                'currency_name' => \LocaleHero::currencyName(),
                'currency_name_local' => \LocaleHero::currencyNameLocal(),
            ],
            'last_seen' => $model->login_at,
            'last_active' => $model->active_at,
            'subscriptions_count' => $model->subscriptions_count,
            'boards_count' => $model->boards_count,
            'posts_count' => $model->posts_count,
            'status' => [
                'name' => $model->status,
                'reason' => $model->status()->reason ?? 'error',
                'online' => [
                    'online_since' => $model->login_at,
                    'online_since_string' => \Carbon\Carbon::parse($model->login_at)->diffForHumans(),
                    'last_action' => $model->active_at,
                    'last_action_string' => \Carbon\Carbon::parse($model->active_at)->diffForHumans(),
                ],

            ],
            //'created_at' => $model->created_at->toIso8601String(),
            //'updated_at' => $model->updated_at->toIso8601String(),
        ];
    }

    public function includeRoles(User $user)
    {
        $data = new Role;

        return $this->item($data, new RoleTransformer);
    }

    public function includePermissions(User $user)
    {
        $data = new Permission;

        return $this->item($data, new PermissionTransformer);
    }

    public function includeProfile(User $user)
    {
        return $this->item($user->profile, new ProfileTransformer);
    }

    public function includeSocials(User $user)
    {
        return $this->item($user->socials, new SocialsTransformer);
    }

    public function includeTags(User $model)
    {
        return $this->item($model, new TagTransformer);
    }

    public function includeReactions(User $model)
    {
        return $this->item($model, new ReactionTransformer);
    }

    public function includeFollows(User $model)
    {
        return $this->item($model, new FollowTransformer);
    }

    public function includeSubscriptions(User $model)
    {
        return $this->item($model, new SubscriptionTransformer);
    }
}
