<?php

namespace App\Models\Translations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTrans extends Model
{
    protected $fillable = ['name', 'description'];
    public $timestamps = false;
}
