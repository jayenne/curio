<?php

namespace App\Http\Controllers;

use App\Board;
use App\Post;
use App\Transformers\SubscriptionTransformer;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SubscriptionController extends Controller
{
    public function toggle(Request $request)
    {
        $reaction = $request->reaction;
        $type = (string) ucfirst(strtolower($request['type']));
        $modelclass = 'App\\'.$type;
        $model = $modelclass::findOrFail($request->id);

        $user = Auth::user();
        $user->toggleSubscribe($model);

        $hasSubscribed = $user->hasSubscribed($model);
        $subscription_count = $user->subscriptions()->count();
        $post_count = $user->subscriptions()->withType(Post::class)->count();
        $board_count = $user->subscriptions()->withType(Board::class)->count();

        // RETURN
        $resource = \Fractal::create()
        ->collection([$model])
        ->parseIncludes(['reaction'])
        ->transformWith(new SubscriptionTransformer)
        ->toArray();

        $resource = $resource['data'][0];

        return $resource;
    }
}
