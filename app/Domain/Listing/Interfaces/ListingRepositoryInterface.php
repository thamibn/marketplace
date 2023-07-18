<?php

namespace App\Domain\Listing\Interfaces;
interface ListingRepositoryInterface
{
    public function search(string $query = '');
}
