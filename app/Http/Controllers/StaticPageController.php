<?php

namespace App\Http\Controllers;

use App\Models\StaticPage;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    public function view($slug)
    {
        $staticPage = StaticPage::findBySlug($slug);
        // TODO: MAKE RENDER
    }
}
