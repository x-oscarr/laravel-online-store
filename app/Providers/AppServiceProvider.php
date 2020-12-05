<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\FileModel;
use App\Models\Product;
use App\Observers\CategoryObserver;
use App\Observers\FileModelObserver;
use App\Observers\ProductObserver;
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
        FileModel::observe(FileModelObserver::class);
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
    }
}
