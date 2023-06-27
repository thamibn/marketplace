<?php

namespace App\Domain\Listing\ViewModels;

use App\Domain\Listing\DataTransferObjects\ListingData;
use App\Domain\Listing\Models\Listing;
use Domain\Shared\ViewModels\BaseViewModel;

class UpsertListingViewModel extends BaseViewModel
{
    public function __construct(public readonly ?Listing $listing = null)
    {
    }

    public function listing(): ?ListingData
    {
        if (!$this->listing) {
            return null;
        }

        return $this->listing->getData();
    }
}
