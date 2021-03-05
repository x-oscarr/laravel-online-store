<?php

namespace App\Http\Composers;

use App\Models\Category;
use App\Models\Setting;
use Illuminate\View\View;

class IndexComposer
{
    protected $settings;
    protected $menuCategories;

    public function __construct()
    {
        $this->menuCategories = Category::where('is_menu_item', true)->get();
    }

    public function compose(View $view): void
    {
        $view->with('menuCategories', $this->menuCategories);
    }
}
