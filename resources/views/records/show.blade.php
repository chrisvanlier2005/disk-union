<?php
/**
 * @var \App\Models\Record $record
 */
?>

<x-layouts.application class="max-w-7xl mx-auto">
    <div class="card bg-base-100 shadow-xl border border-base-300">
        <div class="card-body">
            <div class="flex justify-between items-center">
                <h1 class="card-title text-3xl">{{ $record->name }}</h1>

                <div class="flex gap-3">
                    <a href="{{ route('records.edit', $record) }}" class="btn btn-primary">Edit Record</a>

                    <form action="{{ route('records.destroy', $record) }}" method="post">
                        @csrf
                        @method('delete')

                        <button class="btn btn-error btn-outline">
                            Delete Record
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.application>
