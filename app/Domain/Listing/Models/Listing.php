<?php

namespace App\Domain\Listing\Models;

use App\Domain\Listing\DataTransferObjects\ListingData;
use App\Domain\Listing\MoneyCast;
use App\Domain\Shared\Models\BaseModel;
use App\Domain\Shared\Models\Category;
use App\Domain\Shared\Trait\Searchable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Spatie\LaravelData\WithData;

class Listing extends BaseModel
{
    use hasUuids;
    use withData;
    use HasFactory;
    use Searchable;
    protected string $thisClass = ListingData::class;

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

    protected static function newFactory()
    {
        $parts = Str::of(get_called_class())->explode("\\");
        $domain = $parts[2];
        $model = $parts->last();

        return app("Database\\Factories\\{$domain}\\{$model}Factory");
    }

    public function toSearchArray()
    {
        return [
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'description' => $this->description,
            'price' => $this->price,
            'currency' => $this->currency,
            'date_online' => \Illuminate\Support\Carbon::parse($this->date_online)->format('Y-m-d'),
            'date_offline' => Carbon::parse($this->date_offline)->format('Y-m-d'),
            'mobile' => $this->mobile,
            'email' => $this->email,
            'category_id' => $this->category->id,
            'category' => $this->category
        ];
    }
}
