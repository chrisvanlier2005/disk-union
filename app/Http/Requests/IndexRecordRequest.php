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
        );
    }
}
