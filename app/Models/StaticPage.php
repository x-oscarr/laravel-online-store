<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
    use HasFactory;
    use Translatable;

    # !Constants
    private const ROUTE_NAME = 'static-page';

    # !Parameters
    protected $fillable = ['slug'];
    public $translatedAttributes = ['menu_text', 'seo_title', 'seo_description', 'seo_keywords'];
    public $timestamps = false;

    # !Relations
    public function parts()
    {
        return $this->hasMany(StaticPagePart::class);
    }

    # !Mutators
    public function getRouteAttribute()
    {
        return route('staticPage', ['url' => $this->url]);
    }

    public static function getDisplayingPages()
    {
        return self::where('is_displayed', true)->get();
    }
}
