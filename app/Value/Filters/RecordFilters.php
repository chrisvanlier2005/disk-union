<?php

namespace App\Value\Filters;

class RecordFilters
{
    public function __construct(
        public ?string $search = null,
    ) {
    }
}
