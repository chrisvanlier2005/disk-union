<?php

namespace App\Http\Controllers;

use App\Actions\Images\UploadRecordImage;
use App\Http\Requests\RecordImages\StoreRecordImageRequest;
use App\Models\Record;
use App\Models\RecordImage;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;

class RecordImageController extends Controller
{
    use AuthorizesRequests;

    public function create(Record $record): View
    {
        $this->authorize('create', [RecordImage::class, $record]);

        return view('record-images.create', [
            'record' => $record,
        ]);
    }

    public function store(
        StoreRecordImageRequest $request,
        Record $record,
        UploadRecordImage $uploadRecordImage,
    ): RedirectResponse {
        /** @var \Illuminate\Http\UploadedFile $image */
        $image = $request->file('image');

        $recordImage = new RecordImage();
        $recordImage->record()->associate($record);
        $recordImage->original_name = $image->getClientOriginalName();
        $recordImage->mime_type = $image->getMimeType();
        $recordImage->size = $image->getSize();
        $recordImage->path = $uploadRecordImage($image);
        $recordImage->save();

        return redirect()->route('records.edit', $record);
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(RecordImage $recordImage): RedirectResponse
    {
        $this->authorize('delete', $recordImage);

        $recordImage->delete();

        return back();
    }
}
