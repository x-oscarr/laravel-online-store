<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use App\Http\Resources\BaseResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SliderResource;
use App\Http\Resources\UserResource;
use App\Models\Product;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
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
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(array_merge(
            ProductResource::apiScopes('read'),
            CategoryResource::apiScopes('read'),
            OrderResource::apiScopes('read'),
            OrderResource::apiScopes('create'),
            OrderResource::apiScopes('update'),
            UserResource::apiScopes('read'),
            UserResource::apiScopes('update'),
            SliderResource::apiScopes('read')
        ));

        Jetstream::permissions(array_merge(
            ProductResource::apiScopes('*'),
            ProductResource::apiScopes('*', true),
            CategoryResource::apiScopes('*'),
            CategoryResource::apiScopes('*', true),
            OrderResource::apiScopes('*'),
            OrderResource::apiScopes('*', true),
            UserResource::apiScopes('*'),
            UserResource::apiScopes('*', true),
            SliderResource::apiScopes('*'),
            SliderResource::apiScopes('*', true),
        ));
    }
}
