<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Http\Requests\StoreRecordRequest;
use App\Http\Requests\UpdateRecordRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class RecordController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): View
    {
        $user = $request->user();

        $records = $user->records()
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

    public function store(StoreRecordRequest $request): RedirectResponse
    {
        $record = new Record();
        $record->user()->associate($request->user());
        $record->name = $request->validated('name');
        $record->save();

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

    public function update(UpdateRecordRequest $request, Record $record): RedirectResponse
    {
        $record->name = $request->validated('name');
        $record->save();

        return redirect()->route('records.show', $record);
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Record $record)
    {
        $this->authorize('delete', $record);

        $record->delete();

        return redirect()->route('records.index');
    }
}
