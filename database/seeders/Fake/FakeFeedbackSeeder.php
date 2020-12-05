<?php

namespace Database\Seeders\Fake;

use App\Models\Feedback;
use Illuminate\Database\Seeder;

class FakeFeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Feedback::factory()
            ->times(100)
            ->create();
    }
}
