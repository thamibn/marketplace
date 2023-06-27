<?php

namespace App\Domain\Listing\Actions;

use App\Domain\Listing\DataTransferObjects\ListingData;
use App\Domain\Listing\Models\Listing;


class UpsertListingAction
{
    public static function execute(ListingData $data): Listing
    {
        return Listing::create($data->all());
    }
}
