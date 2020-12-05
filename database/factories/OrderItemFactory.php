<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $productInfo = rand(0, 1) ? true : null;
        $order = Order::all()->random(1)->first();
        $product = Product::all()->random(1)->first();
        if($productInfo) {
            $productInfo = [
                'width' => $this->faker->numberBetween(1000, 5000),
                'height' => $this->faker->numberBetween(1000, 3000),
                'model' => strtoupper($this->faker->randomLetter),
                'texture' => $this->faker->hexColor,
                'color' => $this->faker->colorName
            ];
        }

        return [
            'order_id' => $order,
            'product_id' => $product,
            'price' => $product->price,
            'count' => rand(0, 1) ? 1 : rand(1, 6),
            'discount' => rand(0, 10) ? rand(1, 70) : null,
            'product_info' => json_encode($productInfo)
        ];
    }
}
