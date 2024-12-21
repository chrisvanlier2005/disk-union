<?php
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator<int, \App\Models\RecordCategory> $recordCategories
 */
?>

<x-layouts.application class="max-w-7xl mx-auto">
    <header class="flex justify-between">
        <h1 class="text-4xl font-bold">Categories</h1>

        <a href="{{ route('record-categories.create') }}">
            <button class="btn btn-primary">
                Add Category
            </button>
        </a>
    </header>

    <div class="overflow-x-auto mt-6">
        <table class="table table-lg">
            <!-- head -->
            <thead>
            <tr>
                <th>Name</th>
                <th>
                    Usage Count
                </th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($recordCategories as $recordCategory)
                <tr>
                    <td>{{ $recordCategory->name }}</td>
                    <td>
                        0 {{-- TODO --}}
                    </td>
                    <td class="flex justify-end">
                        <a href="{{ route('record-categories.edit', $recordCategory) }}">
                            <button class="btn btn-sm btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M7.127 22.562l-7.127 1.438 1.438-7.128 5.689 5.69zm1.414-1.414l11.228-11.225-5.69-5.692-11.227 11.227 5.689 5.69zm9.768-21.148l-2.816 2.817 5.691 5.691 2.816-2.819-5.691-5.689z" />
                                </svg>

                                Manage
                            </button>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.application>
