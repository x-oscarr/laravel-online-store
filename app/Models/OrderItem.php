<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getTotalPriceAttribute()
    {
        return (int)$this->count * $this->price;
    }

    public function getProductUrlAttribute()
    {
        return product_route($this->product);
    }
}
