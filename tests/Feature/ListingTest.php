<?php

namespace Tests\Feature;

use App\Domain\Listing\Models\Listing;
use App\Domain\Shared\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListingTest extends TestCase
{
    use RefreshDatabase;
    public function test_homepage_if_it_contains_listings(): void
    {
        $response = $this->get('/');
        $response->assertDontSeeText('No results found');
        $response->assertStatus(200);
    }

    public function test_that_you_cannot_add_listing_if_not_logged_in(): void
    {
        $response = $this->post(route('listing.store'), [
            'title' => 'Test title',
            'slug' => \Illuminate\Support\Str::slug('Test title'),
            'description' => "trefjdfndf",
        ])->assertStatus(302)->assertRedirect(route('login'));
    }

    public function test_if_you_can_view_listing_details_page(): void
    {
        Category::factory()->create([
            'name' => 'Electronics'
        ]);

        Listing::factory()->count(10)->create();

        $listing = Listing::latest()->first();

        $this->get(route('listing.show', $listing->slug))->assertStatus(200);
    }
}
