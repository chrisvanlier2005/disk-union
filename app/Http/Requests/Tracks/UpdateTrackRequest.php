<?php

namespace App\Http\Requests\Tracks;

use App\Models\Track;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTrackRequest extends FormRequest
{
    public function authorize(): bool
    {
        /** @var \App\Models\Track $track */
        $track = $this->route('track');

        return $this->user()->can('update', $track);
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'duration' => ['required', 'integer', 'min:1'],
        ];
    }
}
