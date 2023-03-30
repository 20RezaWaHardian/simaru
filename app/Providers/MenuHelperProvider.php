<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MenuHelperProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path('Helpers/menuHelper.php');
        require_once app_path('Helpers/MyHelpers.php');
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
