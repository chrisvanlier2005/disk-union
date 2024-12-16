<?php

namespace App\Actions\Images;

use App\Models\Record;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadRecordImage
{
    /**
     * Upload the given file and returns the path.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return string
     */
    public function __invoke(UploadedFile $file): string
    {
        $path = "record-images/" . Str::uuid() . "." . $file->guessExtension();

        Storage::put($path, $file->getContent());

        return $path;
    }
}
