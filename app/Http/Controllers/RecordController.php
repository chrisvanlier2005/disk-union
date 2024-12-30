<?php

namespace App\Http\Controllers;

use App\Actions\Images\UploadRecordImage;
use App\Http\Requests\IndexRecordRequest;
use App\Models\Record;
use App\Http\Requests\StoreRecordRequest;
use App\Http\Requests\UpdateRecordRequest;
use App\Models\RecordCategory;
use App\Models\Taps\ApplyRecordFilters;
use Illuminate\Contracts\Database\Eloquent\Builder;
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
        /** @var \App\Models\User $user */
        $user = $request->user();

        /** @var \Illuminate\Pagination\LengthAwarePaginator<int, \App\Models\Record> $records */
        $records = $user->records()
            ->with([
                'recordImages',
                'recordCategories' => function (Builder $query) {
                    $query->latest()->limit(6);
                },
            ])
            ->tap(new ApplyRecordFilters($request->filters()))
            ->latest()
            ->paginate(9);

        $recordCategories = $user->recordCategories()
            ->latest()
            ->get();

        return view('records.index', [
            'records' => $records->withQueryString(),
            'recordCategories' => $recordCategories,
        ]);
    }

    public function create(Request $request): View
    {
        $this->authorize('create', Record::class);

        $recordCategories = $request->user()->recordCategories;

        return view('records.create', [
            'recordCategories' => $recordCategories,
        ]);
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

        DB::transaction(function () use ($request, $uploadRecordImage, $recordImages, $record) {
            $record->save();
            $record->recordCategories()->attach($request->categories());

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
    public function edit(Request $request, Record $record): View
    {
        $this->authorize('update', $record);

        $recordCategories = $request->user()->recordCategories;

        return view('records.edit', [
            'record' => $record,
            'recordCategories' => $recordCategories,
        ]);
    }

    public function update(UpdateRecordRequest $request, Record $record): RedirectResponse
    {
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

        DB::transaction(function () use ($request, $record) {
            $record->save();

            $record->recordCategories()->sync($request->categories());
        });

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
