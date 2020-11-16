<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Transformers\Users\UserTransformer;
use App\User;
use Auth;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

/**
 * @group User management
 *
 * APIs for managing users
 */
class UserProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->isApi = \Request::is('api/u/*');
    }

    /**
     * Show user profile.
     * @group Users
     * @param int $id
     * @return Response
     */
    public function show(Request $request)
    {
        $id = Auth::id();
        $model = User::find([$id]);

        $resource = \Fractal::create()
        ->collection($model)
        ->parseIncludes(['profile', 'reactions', 'follows', 'subscriptions'])
        ->transformWith(new UserTransformer)
        ->toArray();
        // IF IS AJAX REQUEST FROM FRONTEND
        if ($request->ajax()) {
            $prefix = 'models.users.';
            $context = 'forms';
            $seperator = '.';
            $type = 'profile';
            $view = $prefix.$context.$seperator.$type;
            $resource = view($view)->with('item', $resource['data'][0])->render();
        }

        return $resource;
    }

    /**
     * Update the specified resource in storage.
     * @group Users
     * @param  int $id
     * @return Response
     */
    public function update(UpdateProfileRequest $request)
    {
        $id = Auth::id();
        $model = User::find($id);
        $model->first_name = $request->first_name;
        $model->last_name = $request->last_name;
        $model->profile->location = $request->location ?: $model->profile->location;
        $model->profile->title = $request->heading ?: $model->profile->body;
        $model->profile->body = $request->bio ?: $model->profile->body;

        //add media
        if ($request->cover) {
            $model->profile
                ->addMediaFromRequest('cover')
                ->usingFileName(Str::uuid())
                ->toMediaCollection('cover');
        }
        if ($request->avatar) {
            $model->profile
                ->addMediaFromRequest('avatar')
                ->usingFileName(Str::uuid())
                ->toMediaCollection('avatar');
        }

        $model->push();

        // HANDLE RESPONCE
        $resource = \Fractal::create()
        ->item($model)
        ->parseIncludes(['profile', 'reactions', 'follows', 'subscriptions'])
        ->transformWith(new UserTransformer)
        ->toArray();

        // dd($resource);
        // IF IS AJAX REQUEST FROM FRONTEND
        if ($request->ajax()) {
            $prefix = 'models.users.';
            $seperator = '_';
            $context = 'profile';
            $type = 'modal';
            $view = $prefix.$context.$seperator.$type;
            $returnHTML = view($view)->with('item', $resource)->render();

            $toast = [
                'title' => 'Success',
                'subtitle' => 'just now',
                'content' => 'Your profile was updated.',
                'type' => 'success',
                'delay' => 2000,
                'pause_on_hover' => false,
            ];

            $resource = ['toast' => $toast, 'message' => 'Profile updated', 'success' => false, 'html' => $returnHTML];

            //flash('Profile updated!');
            return response()->json($resource, 200);
        }

        return redirect()->back()->with('info', 'updated');
    }
}
