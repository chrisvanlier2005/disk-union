<?php
/**
 * @var \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection<int, \App\Models\Record> $records
 * @var \Illuminate\Database\Eloquent\Collection<int, \App\Models\RecordCategory> $recordCategories
 */

function requestHasCategory(\App\Models\RecordCategory $category): bool
{
    /** @var list<string>|null $categories **/
    $categories = request()->input('record_categories') ?? [];

    return collect($categories)->contains(function (string $item) use ($category) {
        return intval($item) === $category->id;
    });
}

?>
<x-layouts.application class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold">Records</h1>
        <a href="{{ route('records.create') }}" class="btn btn-primary">
            Add Record
        </a>
    </div>

    <div class="mb-8">
        <form action="{{ route('records.index') }}">
            <label class="input input-bordered flex items-center gap-2">
                <input
                    type="text"
                    class="grow"
                    name="search"
                    placeholder="Search for record, track name..."
                    value="{{ request()->query('search') }}"
                    maxlength="255"
                >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 16 16"
                    fill="currentColor"
                    class="h-4 w-4 opacity-70">
                    <path
                        fill-rule="evenodd"
                        d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                        clip-rule="evenodd"
                    />
                </svg>
            </label>
        </form>
    </div>

    @if ($recordCategories->isNotEmpty())
    <div class="mb-8 flex flex-wrap gap-2">
        @foreach ($recordCategories as $category)
        @if (!requestHasCategory($category))
        <a href="{{ route('records.index', ['record_categories' => [$category->id]]) }}">
        @else
        <a href="{{ route('records.index') }}">
        @endif
            <span
            @class([
                'badge badge-md badge-neutral',
                'badge-outline' => !requestHasCategory($category)
            ]),
            >
                {{ $category->name }}
            </span>
        </a>
        @endforeach
    </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse ($records as $record)
        <a href="{{ route('records.show', $record) }}">
            <x-records.record-card :$record/>
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
