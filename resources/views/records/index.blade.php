<?php
/**
 * @var \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection<int, \App\Models\Record> $records
 */
?>
<x-layouts.application class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold">Records</h1>
        <a href="{{ route('records.create') }}" class="btn btn-primary">
            Add Record
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse ($records as $record)
            <a href="{{ route('records.show', $record) }}">
                <div class="w-full space-y-2 p-3">
                    <img
                        src="{{ $record->thumbnail() }}"
                        alt="{{ $record->name }}"
                        class="rounded-xl w-full aspect-square object-cover"
                    />

                    <div class="flex justify-between">
                        <h2 class="card-title">{{ $record->name }}</h2>

                        @if ($record->is_limited_edition)
                            <span class="badge badge-primary">Limited</span>
                        @endif
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-full text-center py-12">
                <div class="flex flex-col items-center text-center">
                    <h2 class="card-title">No Records Found</h2>
                    <p class="text-gray-500">Start by adding your first record!</p>
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $records->links() }}
    </div>
</x-layouts.application>
