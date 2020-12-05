<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    # !Constants
    const STATUS_NEW = 0;
    const STATUS_ACCEPTED = 1;
    const STATUS_PAYED = 2;
    const STATUS_SENT = 3;
    const STATUS_COMPLETED = 4;
    const STATUS_CANCELED = 5;

    const STATUSES = [
        self::STATUS_NEW => 'model.order.status.new',
        self::STATUS_ACCEPTED => 'model.order.status.accepted',
        self::STATUS_PAYED => 'model.order.status.payed',
        self::STATUS_SENT => 'model.order.status.sent',
        self::STATUS_COMPLETED => 'model.order.status.completed',
        self::STATUS_CANCELED => 'model.order.status.canceled'
    ];

    const DELIVERY_TYPE_WAREHOUSE = 'warehouse';
    const DELIVERY_TYPE_ADDRESS = 'address';
    const DELIVERY_TYPE_PICK_UP = 'pick_up';

    const DELIVERY_TYPES = [
        self::DELIVERY_TYPE_WAREHOUSE => 'model.order.delivery_type.warehouse',
        self::DELIVERY_TYPE_ADDRESS => 'model.order.delivery_type.address',
        self::DELIVERY_TYPE_PICK_UP => 'model.order.delivery_type.pick_up',
    ];

    const PAY_TYPE_PREPAYMENT = 'prepayment';
    const PAY_TYPE_COD = 'C.O.D';
    const PAY_TYPE_CASH = 'cash';

    const PAY_TYPES = [
        self::PAY_TYPE_PREPAYMENT => 'model.order.pay_type.prepayment',
        self::PAY_TYPE_COD => 'model.order.pay_type.cod',
        self::PAY_TYPE_CASH => 'model.order.pay_type.cash',
    ];

    # !Parameters
    public $fillable = ['user_id', 'status', 'city', 'warehouse', 'address', 'comment', 'delivery_type', 'pay_type', ];

    # !Relations
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    # !Attributes
    public function getTotalPriceAttribute()
    {
        $totalPrice = 0;
        foreach($this->items as $item) {
            $totalPrice += $item->price * $item->count;
        }
        return $totalPrice;
    }

    # !Methods
    public function setItem(Product $product, int $qty)
    {
        $orderItem = new OrderItem();
        $orderItem->order_id = $this->id;
        $orderItem->product_id = $product->id;
        $orderItem->count = $qty;
        $orderItem->price = $product->price;
        $orderItem->save();

        if($product->amount) {
            $product->amount = $product->amount - $qty;
            ($product->amount === 0) ? $product->amount = false : null;
            $product->save();
        }

        return $this;
    }
}
