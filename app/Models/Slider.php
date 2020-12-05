<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Slider extends Model
{
    use HasFactory;

    # !Constants
    public const TYPE_MAIN = 'main';

    public const TYPES = [
        self::TYPE_MAIN => 'model.slider.main'
    ];

    # !Parameters
    public $timestamps = false;

    # !Mutators
    public function getUrlAttribute()
    {
        return URL::to('/').$this->url;
    }

    public function getTypeNameAttribute()
    {
        return trans(self::TYPES[$this->type]);
    }
}
