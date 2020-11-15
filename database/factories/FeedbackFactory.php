<?php

namespace Database\Factories;

use App\Models\Feedback;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeedbackFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Feedback::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::all()->random(1)->first();
        $type = array_rand(Feedback::TYPES);
        if($type === Feedback::TYPE_PAYMENT) {
            $order = Order::all()->random(1)->first();
        }
        if(!$type == Feedback::TYPE_CALL_ME && !$type == Feedback::TYPE_PAYMENT) {
            $comment = $this->faker->text(100);
        }

        return [
            'user_id' => $user->id,
            'type' => $type,
            'is_processed' => rand(0, 1),
            'order_id' => $order ? $order->id : null,
            'comment' => $comment ?? null,
        ];
    }
}
