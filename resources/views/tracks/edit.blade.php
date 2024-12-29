<?php
/**
 * @var \App\Models\Track $track
 */
?>

<x-layouts.application class="max-w-7xl mx-auto">
    <header class="flex gap-6 items-center">
        <img src="{{ $track->record->thumbnail() }}" alt="{{ $track->record->name }}" class="rounded-xl object-cover"
             width="60" height="60">
        <h1 class="text-4xl">
            Update track:
            <span class="font-bold">{{ $track->title }}</span>
        </h1>
    </header>

    <form action="{{ route('tracks.update', $track) }}" method="post" class="space-y-6">
        @METHOD("PUT")
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div>
            <x-text-input
                name="title"
                label="Title"
                required
                :value="old('title', $track->title)"
            />
        </div>

        <div>
            <x-text-input
                name="duration"
                label="Duration in seconds"
                type="number"
                required
                :value="old('duration', $track->duration)"
            />
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</x-layouts.application>
