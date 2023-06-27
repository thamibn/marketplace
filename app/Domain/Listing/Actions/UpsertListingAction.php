<?php

namespace App\Domain\Listing\Actions;

use App\Domain\Listing\DataTransferObjects\ListingData;
use App\Domain\Listing\Models\Listing;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


class UpsertListingAction
{
    public static function execute(ListingData $data): Listing
    {

        return Listing::create([
            'title' => $data->title,
            'slug' => Str::slug($data->title),
            'description' => $data->description,
            'price' => $data->price,
            'currency' => $data->currency,
            'date_online' => Carbon::parse($data->date_online)->format('Y-m-d'),
            'date_offline' => Carbon::parse($data->date_offline)->format('Y-m-d'),
            'mobile' => $data->mobile,
            'email' => $data->email,
            'category_id' => $data->category->id,
        ]);
    }
}
