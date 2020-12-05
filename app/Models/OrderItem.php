<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    # !Parameters
    public $timestamps = false;
    public $fillable = ['order_id', 'product_id', 'price', 'count', 'discount', 'product_info'];

    # !Relations
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    # !Attributes
    public function getTotalPriceAttribute()
    {
        return (int)$this->count * $this->price;
    }
}
