<?php

namespace App\Http\Composers;

use App\Transformers\Users\UserTransformer;
use App\User;
use Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\View\View;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class AuthenticatedUserComposer
{
    /**
     * The authenticated Client.
     *
     * @var  \App\User
     */
    protected $authuser;

    /**
     * Create a new authenticated composer.
     *
     * @param  null|\Illuminate\Contracts\Auth\Authenticatable  $user
     */
    public function __construct()
    {
        $model = Auth::user();
        $resource = \Fractal::create()
            ->item($model)
            //->parseIncludes(['profile', 'reactions', 'follows', 'subscriptions'])
            ->transformWith(new UserTransformer)
            ->toArray();
        $this->authuser = $resource;
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('authuser', $this->authuser ?: null);
    }
}
