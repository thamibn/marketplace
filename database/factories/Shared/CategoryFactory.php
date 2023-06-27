<?php

namespace Database\Factories\Shared;

use App\Domain\Shared\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;
    public function definition(): array
    {
        return [
            'name' => fake()->title,
        ];
    }
}
