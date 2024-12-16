<?php
/**
 * @var \App\Models\Record $record
 */
?>

<x-layouts.application class="max-w-7xl mx-auto">
    <header>
        <h1 class="text-4xl font-bold">
            Edit {{ $record->name }}
        </h1>
    </header>

    <div class="card bg-base-100 shadow-xl border border-base-300 mt-3">
        <div class="card-body">
            <h2 class="card-title">Images</h2>
            <div class="flex flex-wrap gap-4">
                @foreach ($record->recordImages as $image)
                    <div>
                        <img src="{{ $image->url() }}" alt="{{ $record->name }}" class="size-64 object-cover rounded-xl">

                        <form action="{{ route('record-images.destroy', $image) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-error mt-2">Delete</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <x-records.create-or-edit-record-form :$record/>
</x-layouts.application>
