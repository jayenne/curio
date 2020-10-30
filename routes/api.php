<?php

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Route;

/*
VIEWS
c = create
r = show
u = update
d = delte

// CONTROLLERS
me = me
m = member
a = all
o = others
f = form

// ACTIONS
f = react (love)
r = follow (member)
s = subscribe (board/post)
 */
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::Post('/login', function (Request $request) {
    $data = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        
    $user = User::whereEmail($request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response([
                'message' => ["login failed"]
            ], 401);
    }

    return ['access_token'=>$user->createToken('token')->plainTextToken];
});

Route::group(['middleware' => ['auth:sanctum','verified']], function () {
    // STATS
    Route::name('api.stats.')->prefix('s')->group(function () {
        Route::get('m', 'UserStatsController@count')->name('members');
        Route::get('m/o', 'UserStatsController@online')->name('online');
    });

    // ME PROFILE
    Route::name('api.me.')->prefix('me')->group(function () {
        Route::get('r', 'UserProfileController@show')->name('profile');
        Route::post('u', 'UserProfileController@update')->name('profile-update');
        Route::post('d', 'UserProfileController@delete')->name('profile-delete');

        Route::get('/', 'UserController@showMe')->name('me');
    });

    //MEMBERS
    Route::name('api.curators.')->prefix('c')->group(function () {
         
        // USERS
        Route::get('a', 'UserController@index')->name('all');
        Route::get('o', 'UserController@indexOthers')->name('others');
        Route::get('{id}', 'UserController@show')->name('id');

        //Route::post('/', 'UserController@store');
        //Route::put('/{id}', 'UserController@update');
        //Route::patch('/{id}', 'UserController@update');
        //Route::delete('/{id}', 'UserController@destroy');
    });

    //BOARDS
    Route::name('api.boards.')->prefix('b')->group(function () {
        // ERRORS
        //Route::get('last', 'BoardController@getLastItem')->name('last');

        // VIEWS / FORMS
        Route::view('f/c', 'models/board/forms/create', ['name' => 'form-create']);
        Route::view('f/u', 'models/board/forms/update', ['name' => 'form-update']);
        
        // CONTROLLERS
        //Route::get('me/last', 'BoardController@getLastItem')->name('me-last');
        Route::get('me', 'BoardController@indexMe')->name('me');
        Route::get('o', 'BoardController@indexOthers')->name('others');
        Route::get('c/{user}', 'BoardController@index')->name('user');
        Route::get('{id}', 'BoardController@show')->name('id');

        //Route::post('/c', 'BoardController@new')->name('new');
        Route::get('/', 'BoardController@index')->name('index');
        Route::post('/', 'BoardController@store')->name('create');
        Route::patch('/', 'BoardController@update')->name('update');
        Route::delete('/', 'BoardController@destroy')->name('destroy');
        Route::post('/ri', 'BoardController@reindex')->name('reindex');

        //Route::put('/{id}', 'BoardController@update');
        //Route::patch('/{id}', 'BoardController@update');
    });

    //POSTS
    Route::name('api.posts.')->prefix('p')->group(function () {
        Route::get('me', 'PostController@indexMe')->name('me');
        Route::get('o/{order}', 'PostController@index');
        Route::get('/', 'PostController@index')->name('all');
        Route::get('{id}', 'PostController@show')->name('id');

        //Route::post('/', 'PostController@store');
        //Route::put('/{id}', 'PostController@update');
        //Route::patch('/{id}', 'PostController@update');
        //Route::delete('/{id}', 'PostController@destroy');
    });

    // USER ACTIONS
    Route::name('api.action.')->prefix('a')->group(function () {
        Route::post('r', 'ReactionController@toggle')->name('react');
        Route::post('f', 'FollowController@toggle')->name('follow');
        Route::post('s', 'SubscriptionController@toggle')->name('subscribe');
    });
});
