<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class EventStatusFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        if ($value == 'finished') {
            return $query->finished();
        }

        if ($value == 'upcomming') {
            return $query->upcomming();
        }

        if ($value == 'upcomming-7-days') {
            return $query->upcommingInDays(7);
        }

        if ($value == 'finished-7-days') {
            return $query->finishedInDays(7);
        }

        $query;
    }
}
