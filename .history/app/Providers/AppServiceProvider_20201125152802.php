<?php

namespace App\Providers;

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route as FacadesRoute;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        FacadesRoute::prefix('api')
            ->middleware('api')
            ->namespace('App\Http\Controllers') // <---------
            ->group(base_path('routes/api.php'));
    }
}
