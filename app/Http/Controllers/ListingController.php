<?php

namespace App\Http\Controllers;

use App\Domain\Listing\Actions\UpsertListingAction;
use App\Domain\Listing\DataTransferObjects\ListingData;
use App\Domain\Listing\Models\Listing;
use App\Domain\Listing\ViewModels\GetListingsViewModel;
use App\Domain\Listing\ViewModels\UpsertListingViewModel;
use App\Domain\Shared\Models\Category;
use App\Domain\Shared\ViewModels\GetCategoriesViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ListingController extends Controller
{
    public function index(Request $request): Response
    {
        $per_page = $request->per_page ?: 15;
        $categories = new GetCategoriesViewModel();
        return Inertia::render('Listing/List', [
            'model' => new GetListingsViewModel($per_page),
            'categories' => $categories->categories(),
            'filters' => $request->only('filter', 'per_page', 'sort')
        ]);
    }

    public function show(Request $request, Listing $listing)
    {

        return Inertia::render('Listing/ListingDetails', [
            'model' => new UpsertListingViewModel($listing->load('category')),
        ]);
    }

    public function create()
    {
        return Inertia::render('Listing/CreateListing', [
            'categories' => Category::all()
        ]);
    }

    public function store(ListingData $data): RedirectResponse
    {
        UpsertListingAction::execute($data);

        return Redirect::route('listing.index')->with('success', 'Listing Created');
    }
}
