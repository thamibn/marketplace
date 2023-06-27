<?php

namespace App\Domain\Listing;

use Cknow\Money\Money;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
class MoneyCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        return is_null($value) ? null : Money::parse($value, $attributes['currency'])->toArray()['formatted'];
    }

    public function set($model, string $key, $value, array $attributes)
    {
        if($value instanceof Money){
            return $value;
        }
        return is_null($value) ? null : intval(Money::ZAR($value)->getAmount());
    }
}
