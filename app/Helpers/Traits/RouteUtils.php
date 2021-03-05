<?php


namespace App\Helpers\Traits;


use App\Models\Category;
use App\Models\Product;
use App\Models\StaticPage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

trait RouteUtils
{
    public static function routeByModel(Model $model): string
    {
        if ($model instanceof Category) {
            return route('category', ['slug' => $model->slug]);
        }

        if ($model instanceof Product) {
            return route('product', ['slug' => $model->slug]);
        }

        if($model instanceof StaticPage) {
            return route('staticPage', ['slug' => $model->slug]);
        }

        return '';
    }

    public static function isCurrentPath($url): bool
    {
        if(static::routeByModel($url)) {
            $url = static::routeByModel($url);
        }

        return Request::url() === $url;
    }
}
