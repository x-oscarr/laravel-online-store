<?php

use App\Models\Category;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('index', function ($trail) {
    $trail->push(trans('ui.menu.index'), route('index'));
});

Breadcrumbs::for('product', function ($trail, $product) {
    $trail->parent('category', $product->category);
    $trail->push($product->name, route('product', ['slug' => $product->slug]));
});

Breadcrumbs::for('catalog', function ($trail) {
    $trail->parent('index');
    $trail->push(trans('ui.menu.catalog'), route('catalog'));
});

Breadcrumbs::for('category', function ($trail, $category) {
    $trail->parent('index');
    $trail->push($category->name, route('category', ['slug' => $category->slug]));
});

Breadcrumbs::for('staticPage', function ($trail, $staticPage) {
    $trail->parent('index');
    $trail->push($staticPage->menu_text, route('staticPage', $staticPage->slug));
});

