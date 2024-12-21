<?php

namespace App\Http\Controllers;

use App\Actions\Images\UploadRecordImage;
use App\Http\Requests\IndexRecordRequest;
use App\Models\Record;
use App\Http\Requests\StoreRecordRequest;
use App\Http\Requests\UpdateRecordRequest;
use App\Models\Taps\ApplyRecordFilters;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

final class RecordController extends Controller
{
    use AuthorizesRequests;

    public function index(IndexRecordRequest $request): View
    {
        $user = $request->user();

        $records = $user->records()
            ->with('recordImages')
            ->tap(new ApplyRecordFilters($request->filters()))
            ->latest()
            ->paginate();

        return view('records.index', [
            'records' => $records,
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', Record::class);

        return view('records.create');
    }

    public function store(StoreRecordRequest $request, UploadRecordImage $uploadRecordImage): RedirectResponse
    {
        /** @var \Illuminate\Http\UploadedFile[] $files */
        $recordImages = $request->file('images', []);

        $record = new Record();
        $record->user()->associate($request->user());
        $record->name = $request->validated('name');
        $record->artist = $request->validated('artist');
        $record->label = $request->validated('label');
        $record->code = $request->validated('code');
        $record->genre = $request->validated('genre');
        $record->country = $request->validated('country');
        $record->release_date = $request->date('release_date');
        $record->format = $request->validated('format');
        $record->rpm = $request->validated('rpm');
        $record->color = $request->validated('color');
        $record->is_limited_edition = $request->boolean('is_limited_edition');
        $record->edition_number = $request->validated('edition_number');
        $record->condition = $request->validated('condition');
        $record->barcode = $request->validated('barcode');
        $record->total_tracks = $request->validated('total_tracks');
        $record->spine_title = $request->validated('spine_title');
        $record->notes = $request->validated('notes');

        DB::transaction(function () use ($uploadRecordImage, $recordImages, $record) {
            $record->save();

            foreach ($recordImages as $image) {
                $path = $uploadRecordImage($image);

                $record->recordImages()->create([
                    'original_name' => $image->getClientOriginalName(),
                    'path' => $path,
                    'mime_type' => $image->getMimeType(),
                    'size' => $image->getSize(),
                ]);
            }
        });

        return redirect()->route('records.show', $record);
    }

    public function show(Record $record)
    {
        $this->authorize('view', $record);

        return view('records.show', [
            'record' => $record,
        ]);
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Record $record): View
    {
        $this->authorize('update', $record);

        return view('records.edit', [
            'record' => $record,
        ]);
    }

    public function update(UpdateRecordRequest $request, Record $record): RedirectResponse {
        $record->name = $request->validated('name');
        $record->artist = $request->validated('artist');
        $record->label = $request->validated('label');
        $record->code = $request->validated('code');
        $record->genre = $request->validated('genre');
        $record->country = $request->validated('country');
        $record->release_date = $request->date('release_date');
        $record->format = $request->validated('format');
        $record->rpm = $request->validated('rpm');
        $record->color = $request->validated('color');
        $record->is_limited_edition = $request->boolean('is_limited_edition');
        $record->edition_number = $request->validated('edition_number');
        $record->condition = $request->validated('condition');
        $record->barcode = $request->validated('barcode');
        $record->total_tracks = $request->validated('total_tracks');
        $record->spine_title = $request->validated('spine_title');
        $record->notes = $request->validated('notes');
        $record->save();

        return redirect()->route('records.show', $record);
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Record $record): RedirectResponse
    {
        $this->authorize('delete', $record);

        $record->delete();

        return redirect()->route('records.index');
    }
}
