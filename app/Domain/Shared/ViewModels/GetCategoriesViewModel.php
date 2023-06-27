<?php

namespace App\Domain\Shared\ViewModels;

use App\Domain\Shared\DataTransferObjects\CategoryData;
use App\Domain\Shared\Models\Category;
use Domain\Shared\ViewModels\BaseViewModel;
use Spatie\LaravelData\DataCollection;

class GetCategoriesViewModel extends BaseViewModel
{
    public function categories(): DataCollection
    {
        $categories = Category::all();
        return CategoryData::collection($categories);
    }
}
