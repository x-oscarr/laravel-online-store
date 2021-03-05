<?php

namespace App\Models;

use App\Models\Traits\HasImages;
use App\Models\Traits\SeoSettings;
use App\Scopes\IsEnabledScope;
use App\Scopes\Local\FindBySlugScope;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;
    use HasImages;
    use Translatable;
    use SeoSettings;

    # !Scopes
    use FindBySlugScope;

    # !Constants
    const TYPE_DEFAULT = 'default';
    const TYPES = [
        self::TYPE_DEFAULT => 'model.category.type.default',
    ];

    # !Parameters
    protected $fillable = ['slug', 'type', 'position', 'is_displayed'];
    public $translatedAttributes = ['name', 'description'];

    protected static function booted()
    {
        static::addGlobalScope(new IsEnabledScope());
    }

    # !Relations
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function childs()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function images()
    {
        return $this->morphMany(FileModel::class, 'model')->where('type', FileModel::TYPE_CATEGORY_IMAGE);
    }

    # !Mutators
    public function getRouteAttribute()
    {
        if($this->parent) {
            return route('category', ['url' => $this->url]);
        }
        return route('catalog', ['url' => $this->url]);
    }
}
