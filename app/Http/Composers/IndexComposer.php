<?php

namespace App\Http\Composers;

use App\Models\Setting;
use Illuminate\View\View;

class IndexComposer
{
    protected $settings;

    public function __construct()
    {
        $settingsModels = Setting::all();
        $settingsParams = collect();
        foreach($settingsModels as $model) {
            $settingsParams->put($model->key, $model->value ?? json_decode($model->vars));
        }
    }

    public function compose(View $view)
    {
        $view->with('settings', $this->settings);
    }
}
