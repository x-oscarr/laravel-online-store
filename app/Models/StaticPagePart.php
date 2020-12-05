<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticPagePart extends Model
{
    use HasFactory;
    use Translatable;

    # !Parameters
    protected $fillable = ['key'];
    public $translatedAttributes = ['menu_text', 'title', 'sub_title', 'content'];
    public $timestamps = false;
}
