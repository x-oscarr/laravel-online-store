<?php


namespace App\Models\Traits;


use App\Models\SeoSetting;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Model
 */
trait SeoSettings
{
    public $seoSettings = [];

    # !Relations
    public function seo()
    {
        return $this->morphOne(SeoSetting::class, 'model');
    }

    # !Mutators
    public function setSeoSettingsAttribute(?array $attributes = null): array
    {
        $this->seoSettings = $attributes;
    }
}
