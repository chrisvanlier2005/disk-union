<?php

namespace App\Value\Filters;

use App\Models\RecordCategory;

final readonly class RecordFilters
{
    /**
     * @param string|null $search
     * @param list<int> $recordCategories see {@link RecordCategory::$id}
     */
    public function __construct(
        public ?string $search = null,
        public array $recordCategories = [],
    ) {
    }
}
