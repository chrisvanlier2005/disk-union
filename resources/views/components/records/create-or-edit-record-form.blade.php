@props([
    'record'  => null,
])

<?php
    /**
     * @var \App\Models\Record|null $record
     */
?>



<form

    @if($record !== null)
        action="{{ route('records.update', $record) }}"
    @else
        action="{{ route('records.store') }}"
    @endif
    method="POST"
    class="space-y-2"
>
    @csrf

    @if($record !== null)
        @method("PUT")
    @endif


    <div class="w-full border-base-300 border p-6 rounded-xl shadow-xl flex flex-col gap-2">
        <h2 class="font-semibold">General</h2>

        <div class="flex flex-col">
            <x-text-input
                label="Name"
                name="name"
                :value="old('name', $record?->name)"
            />
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
</form>
