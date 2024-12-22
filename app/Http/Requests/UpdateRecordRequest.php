<?php

namespace App\Http\Requests;

use App\Value\RecordFormat;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @method \App\Models\User user($guard = null)
 */
final class UpdateRecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        /** @var \App\Models\Record $record */
        $record = $this->route('record');

        return $this->user()->can('update', $record);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'artist' => ['string', 'max:255', 'nullable'],
            'label' => ['string', 'max:255', 'nullable'],
            'code' => ['string', 'max:255', 'nullable'],
            'genre' => ['string', 'max:255', 'nullable'],
            'country' => ['string', 'max:255', 'nullable'],
            'release_date' => ['date', 'nullable'],
            'format' => [Rule::enum(RecordFormat::class), 'required'],
            'rpm' => ['integer', 'nullable', 'max:2147483647'],
            'color' => ['string', 'max:255', 'nullable'],
            'is_limited_edition' => ['boolean'],
            'edition_number' => ['integer', 'nullable'],
            'condition' => ['string', 'max:255', 'nullable'],
            'barcode' => ['string', 'max:1000', 'nullable'],
            'total_tracks' => ['integer', 'nullable'],
            'spine_title' => ['string', 'max:255', 'nullable'],
            'notes' => ['string', 'nullable'],
            'categories' => ['array', 'max:50'],
            'categories.*' => ['integer', 'exists:record_categories,id'],
        ];
    }

    /**
     * Get the selected record categories from the request.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, \App\Models\RecordCategory>|null
     */
    public function categories(): ?Collection
    {
        if ($this->isNotFilled('categories')) {
            return null;
        }

        return $this->user()->recordCategories()
            ->whereIn('id', $this->validated('categories'))
            ->get();
    }
}
