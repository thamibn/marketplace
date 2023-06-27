<?php

namespace Database\Seeders;

use App\Domain\Listing\Models\Listing;
use Illuminate\Database\Seeder;

class ListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Listing::factory()->count(100)->create();
    }
}
