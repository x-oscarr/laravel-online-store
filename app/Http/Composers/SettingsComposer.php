<?php

namespace App\Http\Composers;

use App\Models\Setting;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class SettingsComposer
{
    protected function settings(): Collection
    {
        $settingsModels = Setting::all();
        $settingsParams = collect();
        foreach($settingsModels as $model) {
            $settingsParams->put($model->key, $model->value ?? json_decode($model->vars));
        }
        return $settingsParams;
    }

    protected function metadata(): Collection
    {
        return collect();
    }

    public function compose(View $view): void
    {
        $view->with('settings', $this->settings());
        $view->with('metadata', $this->metadata());
    }
}
