<?php

namespace App\Domain\Listing\ViewModels;

use App\Domain\Listing\DataTransferObjects\ListingData;
use App\Domain\Listing\Models\Listing;
use Domain\Listing\Filters\CategoryFilter;
use Domain\Shared\ViewModels\BaseViewModel;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class GetListingsViewModel extends BaseViewModel
{
    public function __construct(private readonly int $currentPage = 10)
    {
    }

    public function listings()
    {
        $listings = QueryBuilder::for(Listing::query())
            ->with('category')
            ->defaultSort('title')
            ->allowedSorts('title', 'price')
            ->allowedFilters([
                'title',
                AllowedFilter::custom('category', new CategoryFilter(
                    'category.name'
                ))
            ])
            ->paginate($this->currentPage)
            ->appends(request()->query());

        return ListingData::collection($listings);
    }
}
