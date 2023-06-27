<?php

namespace App\Domain\Listing\DataTransferObjects;

use App\Domain\Listing\Models\Listing;
use App\Domain\Shared\DataTransferObjects\CategoryData;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;

class ListingData extends Data
{
    public function __construct(
        public readonly ?string $uuid,
        public readonly string  $title,
        public readonly string  $slug,
        public readonly string  $description,
        public readonly string  $date_online,
        public readonly string  $date_offline,
        public readonly int     $price,
        public readonly string  $currency,
        public readonly string  $mobile,
        public readonly string  $email,
        public readonly Lazy|CategoryData $category,
    )
    {}

    public static function fromRequest(Request $request): static
    {
        return self::from([
            ...$request->all(),
        ]);
    }

    public static function fromModel(Listing $listing): self
    {
        return self::from([
            ...$listing->toArray(),
        ]);
    }

    public static function rules(): array
    {
        return [
            'title' => ['required', 'max:255', Rule::unique('listings', 'title')->ignore(request('title'))],
            'description' => ['required', 'min:3'],
            'price' => ['required', 'int'],
            'date_online' => ['required', 'date', 'date_format:Y-m-d'],
            'date_offline' => ['required', 'date', 'date_format:Y-m-d'],
            'mobile' => ['required'],
            'email' => ['required', 'email'],
        ];
    }
}
