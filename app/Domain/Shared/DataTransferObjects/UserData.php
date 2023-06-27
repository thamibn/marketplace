<?php

namespace App\Domain\Shared\DataTransferObjects;

use App\Domain\Shared\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;

class UserData extends Data
{
    public function __construct(
        public readonly ?string $uuid,
        public readonly string  $name,
        public readonly string  $email,
    )
    {
    }

    public static function fromRequest(Request $request): static
    {
        return self::from([
            ...$request->all(),
        ]);
    }

    public static function fromModel(User $user): self
    {
        return self::from([
            ...$user->toArray(),
        ]);
    }

    public static function rules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore(request('user'))],
        ];
    }
}
