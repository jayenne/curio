<?php

namespace App\Listeners;

use App\User;
use App\UserLogin;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogUserLogin
{
    public $geo;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $this->user = $event->user;

        if (null != $this->user->locale_code) {
            \LocaleHero::setAllSessions($this->user->locale_country);
        }

        // log user location
        $ip = $_SERVER['REMOTE_ADDR'];
        $loc = geoip()->getLocation($ip = null);
        Log::debug(['ip'=>$ip, 'loc'=>$loc]);
        $loc->user_id = $this->user->id;
        $geo = $this->user->logins()->save(factory(UserLogin::class)->make($loc->toArray()));

        // log last seen
        $this->user->login_at = Carbon::now()->format('Y-m-d H:i:s');
        $this->user->save();

        //
    }
}
