<?php

namespace App\Providers;

use App\Domain\Listing\Interfaces\ListingRepositoryInterface;
use App\Domain\Listing\Repositories\ElasticSearchListingRepository;
use App\Domain\Listing\Repositories\EloquentListingRepository;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ListingRepositoryInterface::class, function ($app) {
            // This is useful in case we don't want to use elasticsearch
            if (!config('services.elasticsearch.enabled')) {
                return new EloquentListingRepository();
            }

            return new ElasticSearchListingRepository(
                $app->make(Client::class)
            );
        });

        $this->bindSearchClient();
    }

    private function bindSearchClient()
    {
        $this->app->bind(Client::class, function ($app) {
            return ClientBuilder::create()
                ->setHosts($app['config']->get('services.elasticsearch.hosts'))
                ->build();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
