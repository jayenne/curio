<?php

namespace App\Http\Composers;

use Illuminate\Contracts\Auth\Authenticatable;

use Illuminate\View\View;
use Auth;
use App\User;

use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use App\Transformers\Users\UserTransformer;

class AuthenticatedUserComposer
{
    /**
    * The authenticated Client
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
