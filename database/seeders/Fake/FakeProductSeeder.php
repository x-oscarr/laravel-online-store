<?php

namespace Database\Seeders\Fake;

use App\Models\Product;
use Illuminate\Database\Seeder;

class FakeProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()
            ->times(100)
            ->create();
    }
}
