<?php

namespace App\Http\Requests;

use App\Value\Filters\RecordFilters;
use Illuminate\Foundation\Http\FormRequest;

class IndexRecordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'search' => [
                'nullable',
                'string',
                'max:255',
            ],
            'record_categories' => [
                'array',
            ],
            'record_categories.*' => [
                'int',
                'max:' . PHP_INT_MAX,
            ],
        ];
    }

    /**
     * Get the filters from the request.
     *
     * @return \App\Value\Filters\RecordFilters
     */
    public function filters(): RecordFilters
    {
        return new RecordFilters(
            search: $this->validated('search'),
            recordCategories: $this->validated('record_categories') ?? [],
        );
    }
}
