<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($slug)
    {
        $item = Product::slugOrFail($slug);

        return view('product.index', [
            'item' => $item
        ]);
    }
}
