<?php

namespace App\Domain\Listing\Models;

use App\Domain\Listing\DataTransferObjects\ListingData;
use App\Domain\Listing\MoneyCast;
use App\Domain\Shared\Models\BaseModel;
use App\Domain\Shared\Models\Category;
use Carbon\Carbon;
use Cknow\Money\Money;
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
    protected $casts = [
        'price' => MoneyCast::class,
    ];

    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->diffForHumans();
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
