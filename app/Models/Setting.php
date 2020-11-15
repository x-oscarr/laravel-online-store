<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public $timestamps = false;

    static public function get($key) {
        return self::where('key', $key)->first();
    }

    public function getParametersAttribute() {
        return json_decode($this->params);
    }
}
