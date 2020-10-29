<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\PasswordResetEmail;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Mail;

class SetUserEmailAsVerified
{
    /**
     * Create the event listener.
     * @return void
     */
    public function __construct()
    {
        //
    }
  
    /**
     * Handle the event.
     * @param  PasswordReset  $event
     * @return void
     */
    public function handle(PasswordReset $event)
    {
        //\Log::debug('Listener: passwordreset');
        $user = $event->user;
        $user->updateVarifyEmailAt($user->id);
    }
}
