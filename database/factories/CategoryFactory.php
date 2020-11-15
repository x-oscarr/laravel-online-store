<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return array_merge([
            'parent_id' => null,
            'slug' => $this->faker->slug(2),
            'type' => array_rand(Category::TYPES),
            'position' => rand(1, 20)
        ], $this->translations());
    }

    protected function translations()
    {
        $data = [];
        foreach (config('app.locales') as $locale)
        {
            $faker = \Faker\Factory::create($locale);
            $data[$locale] = [
                'name' => $faker->text(35),
                'description' => $faker->text(250)
            ];
        }
        return $data;
    }
}
