<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderTrans extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];
    public $timestamps = false;
}
