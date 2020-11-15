<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ExternalServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('', function ($app) {
            return new Connection(config('riak'));
        });
    }
}
