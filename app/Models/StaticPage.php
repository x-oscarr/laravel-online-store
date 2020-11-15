<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
    use HasFactory;
    use Translatable;

    const ROUTE_NAME = 'static-page';

    protected $fillable = ['slug'];
    public $translatedAttributes = ['menu_text', 'seo_title', 'seo_description', 'seo_keywords'];
    public $timestamps = false;

    public function parts()
    {
        return $this->hasMany(StaticPagePart::class);
    }

    public function getRouteAttribute()
    {
        return route(self::ROUTE_NAME, ['url' => $this->url]);
    }

    public static function getDisplayingPages()
    {
        return self::where('is_displayed', true)->get();
    }
}
