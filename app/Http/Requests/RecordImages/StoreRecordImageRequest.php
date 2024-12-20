<?php

namespace App\Http\Requests\RecordImages;

use App\Models\RecordImage;
use App\Support\FileContraints;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

final class StoreRecordImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        /** @var \App\Models\Record $record */
        $record = $this->route('record');

        return $this->user()->can('create', [RecordImage::class, $record]);
    }

    public function rules(): array
    {
        return [
            'image' => [
                'required',
                File::image()->max(FileContraints::maxImageSize()),
            ],
        ];
    }
}
