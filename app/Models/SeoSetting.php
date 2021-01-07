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

    public $fillable = [
        'meta_robots', 'og_image', 'og_type',
    ];

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

    public function seoAttributesToArray()
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'meta_robots' => $this->meta_robots,
            'og_title' => $this->og_title,
            'og_description' => $this->og_description,
            'og_image' => $this->og_image,
            'og_type' => $this->og_type,
            'og_site_name' => $this->og_site_name,
        ];
    }
}
