<?php

namespace App\Models;

use App\Models\Traits\SeoSettings;
use App\Scopes\IsEnabledScope;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use Translatable;
    use SeoSettings;

    const TYPE_DEFAULT = 'default';

    const TYPES = [
        self::TYPE_DEFAULT => 'model.category.type.default',
    ];

    protected $fillable = ['slug', 'type', 'position', 'is_displayed'];
    public $translatedAttributes = ['name', 'description', 'seo_title', 'seo_description', 'seo_keywords'];

    protected static function booted()
    {
        static::addGlobalScope(new IsEnabledScope());
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function child()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

}
