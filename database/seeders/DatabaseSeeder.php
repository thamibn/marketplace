<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Domain\Shared\Models\Category;
use App\Domain\Shared\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'uuid' => fake()->uuid(),
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password')
        ]);

        Category::factory()->create([
            'uuid' => fake()->uuid(),
            'name' => 'Furniture',
        ]);
        Category::factory()->create([
            'uuid' => fake()->uuid(),
            'name' => 'Electronics',
        ]);
        Category::factory()->create([
            'uuid' => fake()->uuid(),
            'name' => 'Cars',
        ]);
        Category::factory()->create([
            'uuid' => fake()->uuid(),
            'name' => 'Property',
        ]);


        $this->call([
            ListingSeeder::class
        ]);
    }
}
