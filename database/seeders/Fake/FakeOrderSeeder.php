<?php

namespace Database\Seeders\Fake;

use App\Models\Order;
use Illuminate\Database\Seeder;

class FakeOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::factory()
            ->times(rand(30, 100))
            ->create();
    }
}
