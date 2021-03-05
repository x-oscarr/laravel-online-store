<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\Category;
use App\Models\FileModel;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $heroItems = Product::orderBy('id', 'desc')->limit(9)->get();

        return view('index', [
            'heroItems' => $heroItems,
        ]);
    }

    public function test(Request $request)
    {

    }
}
