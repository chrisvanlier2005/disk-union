<?php
/**
 * @var \App\Models\Record $record
 */
?>

<x-layouts.application class="max-w-7xl mx-auto">
    <h1 class="text-4xl font-bold">Add image to {{ $record->name }}</h1>

    <form action="{{ route('records.record-images.store', $record) }}" method="post" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="form-control">
            <input
                type="file"
                class="file-input file-input-bordered w-full max-w-xs"
                name="image"
                id="image"
            >
        </div>

        <button type="submit" class="btn btn-primary">Add Image</button>
    </form>
</x-layouts.application>
