<?php

namespace App\Models;

use App\Models\Traits\SeoSettings;
use App\Scopes\IsEnabledScope;
use App\Scopes\Local\FindBySlugScope;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use Translatable;
    use SeoSettings;

    # !Scopes
    use FindBySlugScope;

    # !Constant

    # !Parameters
    protected $fillable = [
        'slug', 'type', 'code', 'price', 'unit', 'amount',
        'is_new', 'is_available', 'is_enabled', 'seo_settings'
    ];
    public $translatedAttributes = ['name', 'description'];

    protected static function booted()
    {
        static::addGlobalScope(new IsEnabledScope());
    }

    # !Relations
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->morphMany(FileModel::class, 'model')->where(FileModel::TYPE_PRODUCT_IMAGE);
    }

    # !Mutators
    public function getRouteAttribute()
    {
        return route('product', ['url' => $this->url]);
    }
}
