<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CuriousPeopleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path().'/Helpers/CuriousPeople/CuriousArr.php';
        require_once app_path().'/Helpers/CuriousPeople/CuriousStr.php';
        require_once app_path().'/Helpers/CuriousPeople/CuriousNum.php';
        require_once app_path().'/Helpers/CuriousPeople/CuriousStorage.php';
        require_once app_path().'/Helpers/CuriousPeople/CuriousUrl.php';
        require_once app_path().'/Helpers/CuriousPeople/CuriousImg.php';
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
