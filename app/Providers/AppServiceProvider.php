<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\CompanyProfile;
use App\Models\Map;

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
        view()->share('content', CompanyProfile::first());
        view()->share('map', Map::first());
    }
}
