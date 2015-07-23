<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
//        $opera_checker = $_SERVER['HTTP_USER_AGENT'];
//        $is_opera = strpos(strtolower($opera_checker), "opera mini") !== false || strpos(strtolower($opera_checker), "opera mobi") !== false;
//
//        view()->share('is_opera', $is_opera);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
