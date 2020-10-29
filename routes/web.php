<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes(['verify'=>true]);
// SOCIALITE ACCESS
Route::get('login/{service}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{service}/callback', 'Auth\LoginController@handleProviderCallback');
Route::view('email/register', 'auth.register-email')->name('email-register');
//LOGGED IN / PRE-VARIFIED
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('email/register', 'Auth\ResetEmailController@update')->name('email-reset');
});

Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// STATIC PAGES
Route::name('static.')->prefix('policies')->get('{view}', 'PageController@show')->name('policies');
Route::name('static.')->prefix('page')->group(function () {
    Route::get('{view}/{data?}', 'PageController@show')->name('pages');
});

Route::group(['middleware' => ['auth:sanctum','verified']], function () {
    Route::get('/', 'HomeController');
    Route::get('/home', 'HomeController')->name('home');

    // USER
    Route::name('me.')->prefix('me')->group(function () {
        //Route::view('/', 'grid', ['path' => '/u/me/'])->name('me');
        Route::put('profile', 'UserProfileController@update')->name('profile');
    });

    // CURATORS
    Route::name('user.')->prefix('c')->group(function () {
        Route::view('/{id}', 'grid', ['path' => '/b/c/','filter'=>['user'=>'{id}']])->name('user');
        Route::view('/', 'grid', ['path' => 'c/a'])->name('all');
    });
 
    // BOARDS
    Route::name('board.')->prefix('b')->group(function () {
        Route::view('{id}', 'grid', ['path' => 'b/'])->name('id');
        //LIVEWIRE
        //Route::livewire('/{id}', 'boards.jumbotron');
        Route::view('/me', 'grid', ['path' => '/b/me/'])->name('me');
        Route::view('/create', 'grid', ['path' => '/b/'])->name('create');
        Route::view('/', 'grid', ['path' => '/b'])->name('all');
        //Route::post('/c', 'BoardController@store')->name('create');
        Route::put('/u', 'BoardController@update')->name('update');
    });
    
    // POSTS
    // Route::name('posts.')->prefix('posts')->group(function () {
    //     Route::view('/', 'grid', ['path' => '/p/a/'])->name('all');
    //     Route::view('/me', 'grid', ['path' => '/p/me/'])->name('me');
    //     Route::view('/user/{id?}', 'grid', ['path' => '/p/u/'])->name('user');
    // });
});


// SYSTEM
Route::get('logs', '\Melihovv\LaravelLogViewer\Controller@index');

URL::forceScheme('https');
Auth::routes();
