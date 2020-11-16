<?php

namespace App\Traits;

use App\Notifications\VerifyEmailNotification;
use App\User;
use Illuminate\Support\Facades\Password;

trait SendVerifyEmailNotificationTrait
{
    public function sendVerifyEmailNotification(User $user)
    {
        $token = Password::broker()->createToken($user);
        $data = ['password_reset_token' => $token];
        $user->notify(new VerifyEmailNotification($user, $data));

        return null;
    }
}
