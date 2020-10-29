<?php

namespace App\Http\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Sorts\Sort;

class RandomSort implements \Spatie\QueryBuilder\Sorts\Sort
{
    public function __invoke(Builder $query, bool $descending, string $property)
    {
        $query->inRandomOrder();
    }
}