<?php


namespace App\Models\Traits;


use App\Models\SeoSetting;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Model
 */
trait SeoSettings
{
    public function seo()
    {
        return SeoSetting::model($this);
    }
}
