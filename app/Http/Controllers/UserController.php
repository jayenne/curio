<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Transformers\Users\UserTransformer;
use App\User;
use Auth;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

/**
 * @group User management
 *
 * APIs for managing users
 */
class UserController extends Controller
{
    /**
     * Show all users.
     * @group Users
     * @return Response
     */
    public function index(Request $request)
    {
        $paginator = User::currentStatus('public')
            ->withCount(['boards', 'posts', 'subscriptions'])
            ->paginate(config('platform.pagination.user'));

        $model = $paginator->getCollection();

        $resource = \Fractal::create()
        ->collection($model)
        ->parseIncludes(['reactions', 'follows', 'subscriptions'])
        ->transformWith(new UserTransformer)
        ->paginateWith(new IlluminatePaginatorAdapter($paginator))
        ->toArray();

        // IF IS AJAX REQUEST FROM FRONTEND
        if ($request->ajax()) {
            $prefix = 'models.users.';
            $seperator = '_';
            $context = 'user';
            $type = 'default';
            $view = $prefix.$context.$seperator.$type;
            $resource = view($view)->with('data', $resource['data'])->render();
        }

        return $resource;
    }

    /**
     * Show user by given ID.
     * @group Users
     * @param int $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        $models = User::whereId([$id])
            ->currentStatus('public')
            ->withCount(['posts'])
            ->paginate(config('platform.pagination.board'));

        //$this->logView($models);

        $model = $models->getCollection();

        $resource = \Fractal::create()
        ->collection($model)
        ->parseIncludes([
            'user',
            'profile',
            'reactions',
            'follows',
            'subscriptions',
        ])
        ->transformWith(new UserTransformer)
        ->toArray();
        // IF IS AJAX REQUEST FROM FRONTEND
        if ($request->ajax()) {
            $prefix = 'models.users.';
            $seperator = '_';
            $context = 'user';
            $type = 'modal';
            $view = $prefix.$context.$seperator.$type;
            $resource = view($view)->with('item', $resource['data'][0])->render();
        }

        return $resource;
    }

    /**
     * Store user to datsabase by post form.
     * @group Users
     * @param form
     * @return Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::where(['email' => $request->email])->first();
        if ($user) {
            return $this->response->errorBadRequest();
        }

        $data = User::Create($request->all());

        return $this->response->item($data, new UserTransformer)
            ->setStatusCode(201);
    }

    /**
     * Update the specified resource in storage.
     * @group Users
     * @param  int $id
     * @return Response
     */
    public function update(Request $request)
    {
        $data = User::findOrFail($request->id);
        $data->update($request->all());

        return response()->json($data, 202);
    }

    /**
     * Remove the specified post.
     * @group Users
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();

        return $this->response->noContent();
    }

    /**
     * Log a viewed event for an collection of models.
     * @group Users
     * @param  object $model
     * @return true
     */
    private function logView(object $model)
    {
        foreach ($model as $item) {
            $item->updateViews();
        }

        return true;
    }
}
