<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tracks\StoreTrackRequest;
use App\Http\Requests\Tracks\UpdateTrackRequest;
use App\Models\Record;
use App\Models\Track;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;

final class TrackController extends Controller
{
    use AuthorizesRequests;

    public function create(Record $record): View
    {
        $this->authorize('create', [Track::class, $record]);

        return view('tracks.create', [
            'record' => $record,
        ]);
    }

    public function store(StoreTrackRequest $request, Record $record): RedirectResponse
    {
        $track = new Track();
        $track->record()->associate($record);
        $track->title = $request->validated('title');
        $track->duration = $request->validated('duration');
        $track->save();

        return redirect()->route('records.show', $record);
    }

    public function edit(Track $track): View
    {
        $this->authorize('update', $track);

        return view('tracks.edit', [
            'track' => $track,
        ]); 
    }

    public function update(UpdateTrackRequest $request, Track $track): RedirectResponse
    {
        $track->title = $request->validated('title');
        $track->duration = $request->validated('duration');
        $track->save();

        return redirect()->route('records.show', $track->record);
    }

    public function destroy(Track $track): RedirectResponse
    {
        $this->authorize('delete', $track);

        $track->delete();

        return redirect()->route('records.show', $track->record);
    }
}
