<?php

namespace App\Domain\Listing\Repositories;

use App\Domain\Listing\Interfaces\ListingRepositoryInterface;

class EloquentListingRepository implements ListingRepositoryInterface
{
    public function search(string $query = '')
    {
        //TODO
    }
}
