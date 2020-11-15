<?php

namespace App\Models;

use App\Models\Traits\SeoSettings;
use App\Scopes\IsEnabledScope;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use Translatable;
    use SeoSettings;

    protected $fillable = ['slug', 'code'];
    public $translatedAttributes = ['name', 'description'];

    protected static function booted()
    {
        static::addGlobalScope(new IsEnabledScope());
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
