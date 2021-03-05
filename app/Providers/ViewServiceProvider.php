<?php

namespace App\Providers;

use App\Http\Composers\IndexComposer;
use App\Http\Composers\SettingsComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
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
        View::composer('*', SettingsComposer::class);
        View::composer('_partials.header', IndexComposer::class);
    }
}
