<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    # Parameters
    public $timestamps = false;

    # Methods
    static public function get($key) {
        return self::where('key', $key)->first();
    }
}
