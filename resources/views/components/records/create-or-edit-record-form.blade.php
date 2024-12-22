@props([
   'record' => null,
   'recordCategories' => [],
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
    class="space-y-4"
    enctype="multipart/form-data"
>
    @csrf

    @if($record !== null)
        @method("PUT")
    @endif

    <div class="space-y-4">
        <div class="card bg-base-100 shadow-xl border border-base-300">
            <div class="card-body">
                <h2 class="card-title">General Information</h2>
                <div class="grid md:grid-cols-2 gap-2">
                    <x-text-input
                        label="Name"
                        name="name"
                        required
                        :value="old('name', $record?->name)"
                    />
                    <x-text-input
                        label="Artist"
                        name="artist"
                        :value="old('artist', $record?->artist)"
                    />
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-xl border border-base-300">
            <div class="card-body">
                <h2 class="card-title">Record Details</h2>
                <div class="grid md:grid-cols-2 gap-2">
                    <x-text-input
                        label="Label"
                        name="label"
                        :value="old('label', $record?->label)"
                    />
                    <x-text-input
                        label="Code"
                        name="code"
                        :value="old('code', $record?->code)"
                    />
                    <x-text-input
                        label="Genre"
                        name="genre"
                        :value="old('genre', $record?->genre)"
                    />
                    <x-text-input
                        label="Country"
                        name="country"
                        :value="old('country', $record?->country)"
                    />
                    <x-text-input
                        label="Release Date"
                        name="release_date"
                        type="date"
                        :value="old('release_date', $record?->release_date?->format('Y-m-d'))"
                    />
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-xl border border-base-300">
            <div class="card-body">
                <h2 class="card-title">Physical Details</h2>
                <div class="grid md:grid-cols-2 gap-2">
                    <label for="format" class="label">
                        <span class="label-text">
                            Format
                        </span>
                    </label>

                    <div>
                        <select class="select select-bordered w-full" name="format" id="format">
                            @foreach (\App\Value\RecordFormat::cases() as $format)
                                <option value="{{ $format }}" {{ old('format', $record?->format) === $format ? 'selected' : '' }}>
                                    {{ $format->displayName() }}
                                </option>
                            @endforeach
                        </select>

                        @error('format')
                        <span class="text-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <x-text-input
                        label="RPM"
                        name="rpm"
                        type="number"
                        :value="old('rpm', $record?->rpm)"
                    />
                    <x-text-input
                        label="Color"
                        name="color"
                        :value="old('color', $record?->color)"
                    />
                    <div class="col-span-2 ">
                        <label class="label cursor-pointer">
                            <span class="label-text">Limited Edition</span>
                            <input
                                type="checkbox"
                                name="is_limited_edition"
                                class="checkbox"
                                value="1"
                                {{ old('is_limited_edition', $record?->is_limited_edition) ? 'checked' : '' }}
                            >
                        </label>
                    </div>
                    <x-text-input
                        label="Edition Number"
                        name="edition_number"
                        type="number"
                        :value="old('edition_number', $record?->edition_number)"
                    />
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-xl border border-base-300">
            <div class="card-body">
                <h2 class="card-title">Condition</h2>
                <div class="grid md:grid-cols-2 gap-2">
                    <x-text-input
                        label="Condition"
                        name="condition"
                        :value="old('condition', $record?->condition)"
                    />
                </div>
            </div>
        </div>

        <div class="card bg-base-100 shadow-xl border border-base-300">
            <div class="card-body">
                <h2 class="card-title">Additional Information</h2>
                <div class="grid md:grid-cols-2 gap-2">
                    <x-text-input
                        label="Barcode"
                        name="barcode"
                        :value="old('barcode', $record?->barcode)"
                    />
                    <x-text-input
                        label="Total Tracks"
                        name="total_tracks"
                        type="number"
                        :value="old('total_tracks', $record?->total_tracks)"
                    />
                    <x-text-input
                        label="Spine Title"
                        name="spine_title"
                        :value="old('spine_title', $record?->spine_title)"
                    />
                    <div class="col-span-2">
                        <label for="notes" class="label">Notes</label>
                        <textarea
                            name="notes"
                            id="notes"
                            class="textarea textarea-bordered w-full"
                            rows="4"
                        >{{ old('notes', $record?->notes) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        @if ($record === null)
            <div class="card bg-base-100 shadow-xl border border-base-300" data-x-data="{ images: [] }">
                <div class="card-body">
                    <h2 class="card-title">Images</h2>

                    <div class="flex flex-col gap-2">
                        <template data-x-for="(image, index) in images">
                            <div class="flex justify-between">
                                <input
                                    type="file"
                                    name="images[]"
                                    accept="image/*"
                                    class="file-input"
                                />

                                <button
                                    type="button"
                                    class="btn btn-error btn-outline"
                                    data-x-on.click="images.splice(index, 1)"
                                >
                                    Remove
                                </button>
                            </div>
                        </template>

                        <button
                            type="button"
                            class="btn btn-secondary w-fit"
                            data-x-bind.disabled="images.length >= 3"
                            data-x-on.click="images.push(null)"
                        >
                            Add Image
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <div class="card bg-base-100 shadow-xl border border-base-300">
            <div class="card-body">
                <h2 class="card-title">Categories</h2>
                <div class="grid md:grid-cols-2 gap-2">
                    <label for="categories" class="label">
                        <span class="label-text">
                            Categories
                        </span>
                    </label>

                    <div>
                        <select
                            class="form-control"
                            name="categories[]"
                            id="categories"
                            multiple
                        >
                            @foreach ($recordCategories as $category)
                                <option value="{{ $category->id }}"
                                    @selected(
                                        $record?->recordCategories->contains('id', '=', $category->id)
                                    )
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('categories')
                        <span class="text-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

        <!-- Include Choices JavaScript (latest) -->
        <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

        <script>
            const choices = new Choices('#categories', {
                searchEnabled: false,
                itemSelectText: '',
                removeItemButton: true,
            });
        </script>
    </div>
</form>
