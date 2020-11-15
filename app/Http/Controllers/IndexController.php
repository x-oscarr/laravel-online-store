<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function test(Request $request)
    {
        if($request->all()) {
            $request->file('avatar');
        }
        return view('test');
    }
}
