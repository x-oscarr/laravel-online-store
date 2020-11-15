<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoSettingTrans extends Model
{
    protected $fillable = [
        'title', 'description',
        'meta_title', 'meta_description', 'meta_keywords', 'meta_robots',
        'og_title', 'og_description', 'og_image', 'og_type', 'og_site_name',
    ];
    public $timestamps = false;
}
