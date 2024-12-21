<?php

namespace App\Http\Requests\RecordCategories;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateRecordCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        $category = $this->route('record_category');

        return $this->user()->can('update', $category);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
        ];
    }
}
