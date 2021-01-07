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

    # !Mutators
    public function getTitleAttribute()
    {
        return $this->attributes['title'] ? trans("seo.templates.title", [
            'title' => $this->attributes['title'],
            'siteName' => config('app.name')
        ]) : null;
    }

    public function getDescriptionAttribute()
    {
        return $this->attributes['description'] ? trans("seo.templates.description", [
            'description' => $this->attributes['description'],
        ]) : null;
    }

    public function getMetaTitleAttribute()
    {
        return $this->attributes['meta_title'] ? trans("seo.templates.meta_title", [
            'metaTitle' => $this->attributes['meta_title']
        ]) : null;
    }

    public function getMetaDescriptionAttribute()
    {
        return $this->attributes['meta_description'] ? trans("seo.templates.meta_description", [
            'metaDescription' => $this->attributes['meta_description']
        ]) : null;
    }
}
