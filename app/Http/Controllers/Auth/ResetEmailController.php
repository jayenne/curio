<?php

namespace App\Http\Controllers\Auth;

use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\SendVerifyEmailNotificationTrait;
use Auth;
use App\User;

class ResetEmailController extends Controller
{
    use SendVerifyEmailNotificationTrait;
    /*
    |--------------------------------------------------------------------------
    | Email Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email reset requests
    | and uses a simple trait to send an email varification to the given email address.
    |
    */

    protected function update(Request $request)
    {
        $user = Auth::user();
        $user->forceFill([
                'email' => $request->email,
            ])->save();
        
        //$this->sendWelcomeEmail($user);
        $this->sendVerifyEmailNotification($user);
        return redirect()->route($this->redirectTo);
    }

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

}
