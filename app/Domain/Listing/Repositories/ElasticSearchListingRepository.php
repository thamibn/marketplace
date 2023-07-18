<?php

namespace App\Domain\Listing\Repositories;

use App\Domain\Listing\DataTransferObjects\ListingData;
use App\Domain\Listing\Interfaces\ListingRepositoryInterface;
use App\Domain\Listing\Models\Listing;
use Elastic\Elasticsearch\Client;
use Illuminate\Support\Arr;

class ElasticSearchListingRepository implements ListingRepositoryInterface
{
    public function __construct(private readonly Client $elasticsearch)
    {
    }

    public function search(string $query = '', int $currentPerPage = 10)
    {
        $model = new Listing;

        if ($query === '') {
            $params = [
                'index' => $model->getSearchIndex(),
                'type' => $model->getSearchType(),
            ];
        } else {
            $params = [
                'index' => $model->getSearchIndex(),
                'type' => $model->getSearchType(),
                'body' => [
                    'query' => [
                        'multi_match' => [
                            'fields' => ['title'],
                            'query' => $query,
                        ],
                    ],
                ],
            ];
        }

        $listings = $this->elasticsearch->search($params);

        return $this->buildCollection($listings, $currentPerPage);
    }

    private function buildCollection($listings, int $currentPerPage)
    {
        $ids = Arr::pluck($listings['hits']['hits'], '_id');
        $listings = Listing::with('category')->whereIn('id', $ids)
            ->paginate($currentPerPage)
            ->appends(request()->query());

        return ListingData::collection($listings);
    }
}
