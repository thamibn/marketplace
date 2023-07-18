<?php

namespace App\Domain\Shared\Trait;

use App\Domain\Shared\Observers\ElasticSearchObserver;

trait Searchable
{
    public static function bootSearchable()
    {
        //enable the observer based on the elasticsearch flag if enable
        if (config('services.elasticsearch.enabled')) {
            static::observe(ElasticSearchObserver::class);
        }
    }

    public function getSearchIndex()
    {
        return $this->getTable();
    }

    public function getSearchType()
    {
        if (property_exists($this, 'useSearchType')) {
            return $this->useSearchType;
        }

        return $this->getTable();
    }

    public function toSearchArray()
    {
        // this is going to allows us to customize the
        // data that's going to be searchable per model.
        return $this->toArray();
    }
}
