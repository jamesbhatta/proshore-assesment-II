<?php

namespace App\Queries;

use App\Filters\EventStatusFilter;
use App\Filters\ProjectSearch;
use App\Models\Event;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class EventsQuery extends QueryBuilder
{
    public function __construct()
    {
        $projectQuery = Event::query();

        parent::__construct($projectQuery);

        $this
            ->allowedFilters([
                'title', 'start_date', 'end_date',
                AllowedFilter::custom('status', new EventStatusFilter)
            ])
            ->allowedSorts(['id', 'title', 'start_date', 'end_date'])
            ->defaultSort('-start_date');
    }
}
