<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function catalog()
    {
        return view('category.index');
    }

    public function category($slug)
    {
        $category = Category::slugOrFail($slug);
        $products = $category->products()->paginate(config('view.pagination.category'));
        return view('category.index', [
            'category' => $category,
            'products' => $products
        ]);
    }
}
