<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    public const TYPE_MAIN = 'main';

    public const TYPES = [
        self::TYPE_MAIN => 'model.slider.main'
    ];

    public $timestamps = false;

    public function getTypeNameAttribute()
    {
        return trans(self::TYPES[$this->type]);
    }

    public function getSliderUrlAttribute()
    {
        return \Request::root().$this->url;
    }

    public function setSliderUrlAttribute($url)
    {
        $url = preg_replace('/https?:\/\/[a-zA-Z0-9-_.:]+/i', '', $url);
        return $this->url = $url;
    }
}
