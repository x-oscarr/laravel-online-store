<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
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
            $manager = User::where('role', User::ROLE_MANAGER)->inRandomOrder()->first();
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
        return $this->afterCreating(function (Order $order) {
            $orderItemFactory = OrderItem::factory();
            $orderItemFactory->times(rand(1, 10))->create([
                'order_id' => $order->id,
            ]);
        });
    }
}
