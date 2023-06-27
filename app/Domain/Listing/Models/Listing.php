<?php

namespace App\Domain\Listing\Models;

use App\Domain\Listing\DataTransferObjects\ListingData;
use App\Domain\Shared\Models\BaseModel;
use App\Domain\Shared\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\LaravelData\WithData;

class Listing extends BaseModel
{
    use hasUuids;
    use withData;
    protected string $dataClass = ListingData::class;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'date_online',
        'date_offline',
        'price',
        'currency',
        'mobile',
        'email',
        'category_id',
    ];

    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    public function scopeFromDate(Builder $query, $date): Builder
    {
        return $query->where('date', '>=', $date);
    }
    public function scopeToDate(Builder $query, $date): Builder
    {
        return $query->where('date', '<=', $date);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
