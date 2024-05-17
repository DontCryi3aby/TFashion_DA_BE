<?php

namespace Database\Factories;

use App\Models\product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = product::class;

    public function definition()
    {
        return [
            'hinhanh' => $this->faker->imageUrl(),
            'title' => $this->faker->sentence(4),
            'gia' => $this->faker->randomFloat(2, 0, 10000),
            'category_id' => $this->faker->numberBetween(1, 3),
        ];
    }
}