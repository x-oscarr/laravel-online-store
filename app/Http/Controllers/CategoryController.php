<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function catalog()
    {
        return view('category.catalog');
    }

    public function category()
    {
        return view('category.catalog');
    }
}
