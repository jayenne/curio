<?php

namespace App\Http\Controllers;

//use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FollowController extends Controller
{
    public function toggle(Request $request)
    {
        $reaction = $request->reaction;
        $type = (string) ucfirst(strtolower($request['type']));
        $model = 'App\\'.$type;
        $data = $model::findOrFail($request->id);
        $user = \Auth::user();
        $user->toggleFollow($data);
        /*
        $isFollowing = $user->isFollowing($data);
        $isFollowed = $user->isFollowedBy($data);
        $isReciprocal = $user->areFollowingEachOther($data);

        $following = $user->followings->count();
        $follows = $user->followers->count();
        //dd($this->user)
        //$this->user->togglefollow($data);
        */
        // RETURN
        $resource = \Fractal::create()
        ->collection([$model])
        ->parseIncludes(['follow'])
        ->transformWith(new FollowTransformer)
        ->toArray();

        $resource = $resource['data'][0];

        return $resource;
        /*
        return response()->json(
            [
                'totals' => [
                    'reacted' => (boolean) $isFollowing,
                    'followers_count' => (integer) $followers,
                    'following_count' => (integer) $following,
                ],
                'items' => [
                    'reacted' => (boolean) $isFollowing,
                    'is_following' => (boolean) $isFollowing,
                    'is_followed' => (boolean) $isFollowed,
                    'is_reciprocal'=> (boolean) $isReciprocal,
                    'followers_count' => (integer) $followers,
                    'following_count' => (integer) $following,
                ],
                'meta' => [],
            ],
            202
        );
        */
    }
}
