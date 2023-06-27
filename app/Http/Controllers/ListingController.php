<?php

namespace App\Http\Controllers;

use App\Domain\Listing\ViewModels\GetListingsViewModel;
use App\Domain\Shared\ViewModels\GetCategoriesViewModel;
use Illuminate\Http\Request;
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
}
