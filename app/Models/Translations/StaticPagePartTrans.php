<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticPagePartTrans extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'sub_title', 'content'];
    public $timestamps = false;
}
