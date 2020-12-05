<?php


namespace App\Helpers\Traits;


use App\Models\Category;
use App\Models\Product;
use App\Models\StaticPage;
use Illuminate\Database\Eloquent\Model;

trait RouteUtils
{
    static public function routeByModel(Model $model)
    {
        if($model instanceof Category) {
            return self::categoryRoute($model);
        } elseif ($model instanceof Product) {
            return self::productRoute($model);
        } elseif ($model instanceof StaticPage){
            return self::staticPageRoute($model);
        }
    }

    static public function categoryRoute(Category $category)
    {
        $route = $category->parent ? 'category' : 'catalog';
        return route($route, ['slug' => $category->slug]);
    }

    static public function productRoute(Product $product)
    {
        return route('product', ['slug' => $product->slug]);
    }

    static public function staticPageRoute(StaticPage $page)
    {
        return route('staticPage', ['slug' => $page->slug]);
    }
}
