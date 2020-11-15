<?php

namespace Database\Seeders;

use Database\Seeders\Fake\FakeCategorySeeder;
use Database\Seeders\Fake\FakeFeedbackSeeder;
use Database\Seeders\Fake\FakeOrderSeeder;
use Database\Seeders\Fake\FakeProductSeeder;
use Database\Seeders\Fake\FakeUserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(SettingSeeder::class);
        if(config('database.run_fake_seeders')) {
            $this->call(FakeUserSeeder::class);
            $this->call(FakeCategorySeeder::class);
            $this->call(FakeProductSeeder::class);
            $this->call(FakeOrderSeeder::class);
            $this->call(FakeFeedbackSeeder::class);
        }
    }
}
