<?php

namespace App\Domain\Listing\DataTransferObjects;

use App\Domain\Listing\Models\Listing;
use App\Domain\Shared\DataTransferObjects\CategoryData;
use App\Domain\Shared\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;

class ListingData extends Data
{
    public function __construct(
        public readonly ?string $id,
        public readonly ?string $uuid,
        public readonly string  $title,
        public readonly ?string  $slug,
        public readonly string  $description,
        public readonly string  $date_online,
        public readonly string  $date_offline,
        public readonly int     $price,
        public readonly string  $currency,
        public readonly string  $mobile,
        public readonly string  $email,
        public readonly null|Lazy|CategoryData $category,
    )
    {}

    public static function fromRequest(Request $request): static
    {
        return self::from([
            ...$request->all(),
            'category' => Category::where('id', $request->category_id)->first(),
        ]);
    }

    public static function fromModel(Listing $listing): self
    {
        return self::from([
            ...$listing->toArray(),
            'category' => Lazy::whenLoaded('category', $listing, fn () => $listing->category),
        ]);
    }

    public static function rules(): array
    {
        return [
            'title' => ['required', 'max:50', Rule::unique('listings', 'title')->ignore(request('title'))],
            'description' => ['required', 'min:3'],
            'price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'currency' => ['required', 'string', 'max:2'],
            'date_online' => ['required', 'date', 'date_format:Y-m-d'],
            'date_offline' => ['required', 'date', 'date_format:Y-m-d'],
            'mobile' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10', 'max:20'],
            'email' => ['required', 'email', 'max:50'],
            'category_id' => ['required', 'int', 'exists:categories,id'],
        ];
    }
}
