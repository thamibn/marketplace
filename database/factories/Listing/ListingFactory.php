<?php

namespace Database\Factories\Listing;

use App\Domain\Listing\Models\Listing;
use App\Domain\Shared\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ListingFactory extends Factory
{
    protected $model = Listing::class;
    public function definition(): array
    {

        $title = $this->faker->words(4, true);
        $slug = Str::slug($title);

        return [
            'title' => $title,
            'slug' => $slug,
            'description' => $this->faker->paragraph,
            'date_online' => $this->faker->date('Y-m-d'),
            'date_offline' => $this->faker->date('Y-m-d'),
            'price' => $this->faker->numberBetween(100, 1000000),
            'currency' => $this->faker->randomElement(['ZAR', 'USD', 'EUR', 'GBP']),
            'mobile' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail(),
            'category_id' => Category::all()->random()->id,
        ];
    }
}
