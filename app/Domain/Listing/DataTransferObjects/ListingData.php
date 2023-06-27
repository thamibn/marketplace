<?php

namespace App\Domain\Listing\DataTransferObjects;

use App\Domain\Listing\Models\Listing;
use Illuminate\Http\Request;
use Spatie\LaravelData\Data;

class ListingData extends Data
{
    public function __construct(
        public readonly ?string $uuid,
        public readonly string  $date,
        public readonly string  $reason,
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
            'date' => ['required', 'date', 'date_format:Y-m-d'],
            'reason' => ['required', 'min:3'],
        ];
    }
}
