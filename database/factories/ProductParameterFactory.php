<?php

namespace Database\Factories;

use App\Models\ProductParameter;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductParameterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductParameter::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [

        ];
    }

    protected static function colorParam()
    {
        return [

        ];
    }

    protected static function countryParam()
    {
        return [

        ];
    }

    protected static function manufacturerParam()
    {
        return [

        ];
    }
}
