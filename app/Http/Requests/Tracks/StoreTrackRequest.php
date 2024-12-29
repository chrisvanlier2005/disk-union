<?php

namespace App\Http\Requests\Tracks;

use App\Models\Track;
use Illuminate\Foundation\Http\FormRequest;

final class StoreTrackRequest extends FormRequest
{
    public function authorize(): bool
    {
        /** @var \App\Models\Record $record */
        $record = $this->route('record');

        return $this->user()->can('create', [Track::class, $record]);
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'duration' => ['required', 'integer', 'min:1'],
        ];
    }
}
