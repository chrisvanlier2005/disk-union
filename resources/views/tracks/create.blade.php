<?php
/** @var \App\Models\Record $record **/
?>

<x-layouts.application class="max-w-7xl mx-auto">
    <div class="flex gap-6 items-center">
        <img src="{{ $record->thumbnail() }}" alt="{{ $record->name }}" class="rounded-xl object-cover" width="60" height="60">
        <h1 class="text-4xl font-bold">Add track to {{ $record->name }}</h1>
    </div>

    <form action="{{ route('records.tracks.store', $record) }}" method="post" class="space-y-6">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div>
            <x-text-input
                name="title"
                label="Title"
                required
            />
        </div>

        <div>
            <x-text-input
                name="duration"
                label="Duration in seconds"
                type="number"
                required
            />
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</x-layouts.application>
