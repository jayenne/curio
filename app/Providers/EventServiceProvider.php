<?php

namespace App\Providers;

use App\Listeners\SendPasswordResetEmail;
use App\Listeners\SetUserEmailAsVerified;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        PasswordReset::class => [
            SetUserEmailAsVerified::class,
        ],
        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\LogUserLogin',
        ],
        'user.created' => [
            'App\Events\UserCreatedEvent@userCreated',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
