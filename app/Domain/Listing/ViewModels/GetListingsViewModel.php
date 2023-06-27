<?php

namespace App\Domain\Listing\ViewModels;

use App\Domain\Listing\DataTransferObjects\ListingData;
use App\Domain\Listing\Models\Listing;
use Domain\Shared\ViewModels\BaseViewModel;
use Illuminate\Support\Facades\Log;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class GetListingsViewModel extends BaseViewModel
{
    public function __construct(private readonly int $currentPage = 10)
    {
    }

    public function listings()
    {

        Log::debug(request()->query());

        $listings = QueryBuilder::for(Listing::query())
            ->defaultSort('date')
            ->allowedSorts('date', 'reason')
            ->allowedFilters([
                'date',
                AllowedFilter::scope('from_date'),
                AllowedFilter::scope('to_date'),
            ])
            ->paginate($this->currentPage)
            ->appends(request()->query());

        return ListingData::collection($listings);
    }

    public function total(): int
    {
        return Listing::count();
    }

}
