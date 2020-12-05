<?php

namespace Database\Seeders\Fake;

use App\Models\Category;
use Illuminate\Database\Seeder;

class FakeCatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()
            ->times(rand(7, 20))
            ->create();
    }
}
