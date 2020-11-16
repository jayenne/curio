<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * @group Statistics_User
 *
 * APIs for user statistics
 */
class UserStatsController extends Controller
{
    /**
     * Show user online status.
     * @group Statistics_User
     * @return int
     */
    public function count()
    {
        return User::all()->count();
    }

    /**
     * Show user online status.
     * @group Statistics_User
     * @return array
     */
    public function online()
    {
        $users = User::where('active_at', '>=', Carbon::now()->subMinutes(config('platform.cache.users.online'))->toDateString())->get();
        $online = [];
        foreach ($users as $user) {
            if (Cache::has('isOnline-'.$user->id)) {
                $online[$user->id] = [
                    'online_since' => $user->login_at,
                    'online_since_string' => Carbon::parse($user->login_at)->diffForHumans(),
                    'last_action' => $user->active_at,
                    'last_action_string' => Carbon::parse($user->active_at)->diffForHumans(),
                ];
            }
        }

        return $online;
    }
}
