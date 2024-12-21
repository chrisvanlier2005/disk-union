<?php

namespace App\Http\Requests\RecordCategories;

use App\Models\RecordCategory;
use Illuminate\Foundation\Http\FormRequest;

final class StoreRecordCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', RecordCategory::class);
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }
}
