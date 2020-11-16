<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\CuriousPeople\CuriousStorage;
use App\Helpers\CuriousPeople\CuriousStr;
use App\Http\Controllers\Controller;
use App\Notifications\VerifyEmailNotification;
use App\Providers\RouteServiceProvider;
use App\Traits\SendVerifyEmailNotificationTrait;
use App\User;
use App\UserProfile;
use App\UserSocial;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Log;
use Socialite;

class LoginController extends Controller
{
    use SendVerifyEmailNotificationTrait;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectToRegister = RouteServiceProvider::REGISTER; //'social.registration';
    protected $password;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        $request = request();
        $type = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $request[$type] = $request->username;

        return $type;
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    // public function authenticate(Request $request)
    // {
    //     $credentials = $request->only('email', 'password', 'remember');
    //     if (Auth::attempt($credentials)) {
    //         return redirect()->intended($redirectTo);
    //     }
    // }

    // protected function authenticated(Request $request, $user)
    // {
    //     \Log::debug(['authenticated' => $user->id, 'authid' => \Auth::id(), 'route' => $this->redirectTo]);
    // }

    public function redirectToProvider($service)
    {
        return Socialite::driver($service)->redirect();
    }

    public function handleProviderCallback($service)
    {
        // INSTANTIATE A NEW SOCILALITE USER
        $social = Socialite::driver($service)->user();
        $password_string = CuriousStr::randomString(32);
        $temp_email = Str::uuid().'@example.org';

        // if socail has no email...
        if ($social->email === null) {
            // atempt to find an existing user by social handle.
            $user_socail = UserSocial::where('social_id', $social->id)->first();

            if ($user_socail !== null) {
                $social->email = $user_socail->user()->first()->email;
            }
        }

        // get email from user or temp email
        $user = User::firstOrCreate(
            [
                // PROMPT FOR EMAIL ADDRESS
                'email' => $social->email ?: $temp_email,
            ],
            [
                'username' => strtolower($social->nickname),
                'first_name' => $social->name,
                'last_name' => $social->name,
                'email' => $social->email,
                'password' => $password_string,
            ]
        );

        $user->socials()->updateOrCreate([
                    'user_id' => $user->id,
                    'service' => $service,
                    'social_id' => $social->id,
                ],
                [
                    'name' => $social->name,
                    'nickname' => $social->nickname,
                    'body' => $social->user['description'],
                    'location' => $social->user['location'],
                    'url' => $social->user['url'] != null ? $social->user['entities']['url']['urls'][0]['expanded_url'] : null,
                    'cover'=> $social->user['profile_banner_url'],
                    'avatar' => $social->user['profile_image_url_https'],
                    'following' => $social->user['following'],
                    'suspended' => $social->user['suspended'],
                    'token' => $social->token,
                    'token_secret' => $social->tokenSecret,
                ]);

        $user->profile()->firstOrCreate(
                [
                    'user_id' => $user->id,
                ],
                [
                    'nickname' => $social->nickname,
                    'body' => $social->user['description'],
                    'location' => $social->user['location'],
                    'url' => $social->user['url'],
                ]);

        if ($user->wasRecentlyCreated) {
            $user->setStatus('public', 'registered');

            if ($social->email != null) { //TODO: add email validation here
                $this->sendVerifyEmailNotification($user);
            } else {
                $this->redirectTo = 'email-register';
            }
        }

        // LOG USER IN
        auth()->login($user);
        // RETURN VIEW
        return redirect()->route($this->redirectTo);
    }
}
