<?php

namespace App\Domain\Shared\DataTransferObjects;

use App\Domain\Shared\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;

class CategoryData extends Data
{
    public function __construct(
        public readonly ?string $id,
        public readonly ?string $uuid,
        public readonly string  $name,
    )
    {
    }

    public static function fromRequest(Request $request): static
    {
        return self::from([
            ...$request->all(),
        ]);
    }

    public static function fromModel(Category $category): self
    {
        return self::from([
            ...$category->toArray(),
        ]);
    }

    public static function rules(): array
    {
        return [
            'name' => ['required',Rule::unique('categories', 'name')->ignore(request('category')), 'max:255'],
        ];
    }
}
