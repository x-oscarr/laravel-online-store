<?php

namespace App\Models;

use App\Models\Traits\HasApi;
use App\Models\Traits\HasImages;
use App\Models\Traits\SeoSettings;
use App\Scopes\IsEnabledScope;
use App\Scopes\Local\FindBySlugScope;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Product extends Model
{
    use HasFactory;
    use HasImages;
    use Translatable;
    use SeoSettings;

    # !Scopes
    use FindBySlugScope;

    # !Constant

    # !Parameters
    protected $fillable = [
        'category_id',
        'slug', 'type', 'code', 'price', 'old_price', 'unit', 'amount',
        'is_new', 'is_available', 'is_enabled'
    ];
    public $translatedAttributes = ['name', 'description'];

    protected static function booted(): void
    {
        static::addGlobalScope(new IsEnabledScope());
    }

    # !Relations
    public function category(): Relation
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): Relation
    {
        return $this->morphMany(FileModel::class, 'model')->where('type', FileModel::TYPE_PRODUCT_IMAGE);
    }

    public function params(): Relation
    {
        return $this->hasMany(ProductParameter::class);
    }

    # !Mutators
    public function getRouteAttribute()
    {
        return route('product', ['url' => $this->url]);
    }
}
