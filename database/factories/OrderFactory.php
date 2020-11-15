<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::all()->random(1)->first();
        $status = array_rand(Order::STATUSES);
        $deliveryType = array_rand(Order::DELIVERY_TYPES);
        $payType = array_rand(Order::PAY_TYPES);
        if($status != Order::STATUS_NEW) {
            $manager = User::where('role', User::ROLE_MANAGER)->random(1)->first();
        }
        if($deliveryType == Order::DELIVERY_TYPE_WAREHOUSE) {
            $warehouse = "Отделение №{$this->faker->numberBetween(0, 30)}";
            $address = null;
        } elseif ($deliveryType == Order::DELIVERY_TYPE_ADDRESS) {
            $warehouse = null;
            $address = $this->faker->address;
        } else {
            $warehouse = null;
            $address = null;
        }
        return [
            'user_id' => $user->id,
            'status' => $status,
            'delivery_type' => $deliveryType,
            'pay_type' => $payType,
            'city' => $this->faker->city,
            'warehouse' => $warehouse,
            'address' => $address,
            'ip' => $this->faker->ipv4,
            'user_agent' => $this->faker->userAgent,
            'manager_id' => $manager ?? null,
        ];
    }

    public function configure()
    {
        $this->afterCreating(function (Order $order) {
            $itemQuantity = rand(1, 7);
            $products = Product::where('is_available', true)
                ->random($itemQuantity)
                ->first();
            for ($i = $itemQuantity; $i > 0; $i--) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $products[$i],
                    'price' => $products[$i]->price,
                    'count' => rand(0, 3) ? 1 : rand(2, 7),
                    'discount' => rand(0, 10) ? null : rand(10, ($products[$i]->price/3))
                ]);
            }
        });
    }
}
