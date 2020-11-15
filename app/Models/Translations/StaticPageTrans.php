<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticPageTrans extends Model
{
    use HasFactory;

    protected $fillable = ['menu_text'];
    public $timestamps = false;
}
