<?php

namespace Database\Seeders;

use App\Helpers\Template;
use Database\Seeders\Fake\FakeCatalogSeeder;
use Database\Seeders\Fake\FakeFeedbackSeeder;
use Database\Seeders\Fake\FakeOrderSeeder;
use Database\Seeders\Fake\FakeUserSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

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
            $this->call(FakeCatalogSeeder::class);
            $this->call(FakeOrderSeeder::class);
            $this->call(FakeFeedbackSeeder::class);
        }

        if(config('database.run_template_seeders')) {
            Template::seederLoader($this);
        }
    }
}
