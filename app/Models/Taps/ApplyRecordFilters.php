<?php

namespace App\Models\Taps;

use App\Value\Filters\RecordFilters;
use Illuminate\Database\Eloquent\Builder;

final readonly class ApplyRecordFilters
{
    public function __construct(
        public RecordFilters $filters,
    ) {
    }

    public function __invoke(Builder $query): void
    {
        if ($this->filters->search !== null) {
            $query->where('name', 'like', '%' . $this->filters->search . '%');
        }
    }
}
