<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class SeoSetting extends Model
{
    use Translatable;

    # !Constants
    const META_ROBOTS_INDEX = 'index';
    const META_ROBOTS_FOLLOW = 'follow';
    const META_ROBOTS_NOINDEX = 'noindex';
    const META_ROBOTS_NOFOLLOW = 'nofollow';
    const META_ROBOTS_ALL = 'all';
    const META_ROBOTS_NONE = 'none';

    # !Parameters
    public $timestamps = false;
    public $translatedAttributes = [
        'title', 'description',
        'meta_title', 'meta_description', 'meta_keywords',
        'og_title', 'og_description', 'og_site_name'
    ];

    # !Relations
    public function owner()
    {
        return $this->morphTo('model');
    }

    # !Mutators
    public function getTitleAttribute()
    {
        return trans("seo.templates.title", [$this->title]);
    }

    public function getDescriptionAttribute()
    {
        return trans("seo.templates.description", [$this->description]);
    }

    public function getMetaTitleAttribute()
    {
        return trans("seo.templates.meta_title", [$this->meta_title]);
    }

    public function getMetaDescriptionAttribute()
    {
        return trans("seo.templates.meta_description", [$this->meta_description]);
    }
}
