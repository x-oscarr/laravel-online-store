<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class SeoSetting extends Model
{
    use Translatable;

    const META_ROBOTS_INDEX = 'index';
    const META_ROBOTS_FOLLOW = 'follow';
    const META_ROBOTS_NOINDEX = 'noindex';
    const META_ROBOTS_NOFOLLOW = 'nofollow';
    const META_ROBOTS_ALL = 'all';
    const META_ROBOTS_NONE = 'none';

    public $timestamps = false;

    public function scopeModel(Builder $query, Model $model)
    {
        return $query
            ->where('model', get_class($model))
            ->where('model_id', $model->id);
    }

    public function owner()
    {
        return $this->model ? $this->belongsTo($this->model, 'model_id') : null;
    }

}
