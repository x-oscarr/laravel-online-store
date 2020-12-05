<?php

namespace Database\Factories;

use App\Helpers\Template;
use App\Models\Category;
use App\Models\FileModel;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
            'slug' => $this->faker->slug(2).rand(000, 111),
            'type' => array_rand(Category::TYPES),
            'position' => rand(1, 20)
        ], $this->translations());
    }

    public function configure()
    {
        return $this->afterCreating(function (Category $category) {
            Template::factoryFilesLoader($category);
            $this->productLoader($category);
        });
    }

    protected function translations()
    {
        $data = [];
        foreach (config('app.locales') as $locale) {
            $faker = \Faker\Factory::create($locale);
            $data[$locale] = [
                'name' => $faker->text(35),
                'description' => $faker->text(250)
            ];
        }
        return $data;
    }

    protected function productLoader(Category $category)
    {
        $productFactory = Product::factory();
        $productFactory->times(rand(15, 60))->create([
            'category_id' => $category->id,
            'type' => $category->type
        ]);
    }
}
