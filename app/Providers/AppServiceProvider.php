<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        if (request()->header('x-forwarded-proto') == 'https' || request()->header('x-forwarded-scheme') == 'https' || request()->header('x-scheme') == 'https') {
            URL::forceScheme('https');
        }
    }
}
