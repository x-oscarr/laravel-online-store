<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\Category;
use App\Models\FileModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class IndexController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function test(Request $request)
    {

    }
}
