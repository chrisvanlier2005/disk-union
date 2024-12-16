<x-layouts.application class="max-w-7xl mx-auto">
    <div class="flex justify-between">
        <h1 class="text-4xl">
            Records
        </h1>

        <div>
            <a href="{{ route('records.create') }}">
                <button class="btn btn-primary">
                    Add Record
                </button>
            </a>
        </div>
    </div>
</x-layouts.application>
