<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Model;

class CategoryTrans extends Model
{
    protected $fillable = ['name', 'description'];
    public $timestamps = false;
}
