<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Auth;
use Cache;
use Carbon\Carbon;


class LastUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $expiresAt = Carbon::now()->addMinutes(config('platform.cache.users.online')); // keep online for 1 min
            Cache::put('isOnline-' . Auth::user()->id, true, $expiresAt);

            // active_at
            User::where('id', Auth::user()->id)->update(['active_at' => Carbon::now()]);
        }

        return $next($request);
    }
}
