<?php

namespace App\Domain\Shared\Models;

use App\Domain\Listing\Models\Listing;
use App\Domain\Shared\DataTransferObjects\CategoryData;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Spatie\LaravelData\WithData;


class Category extends BaseModel
{
    use hasUuids;
    use withData;
    use HasFactory;
    protected string $dataClass = CategoryData::class;

    public function uniqueIds()
    {
        return ['uuid'];
    }

    protected $fillable = [
        'name',
    ];

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    protected static function newFactory()
    {
        $parts = Str::of(get_called_class())->explode("\\");
        $domain = $parts[2];
        $model = $parts->last();

        return app("Database\\Factories\\{$domain}\\{$model}Factory");
    }
}
