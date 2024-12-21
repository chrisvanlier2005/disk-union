<?php
/**
 * @var \App\Models\RecordCategory $recordCategory
 */
?>

<x-layouts.application class="max-w-7xl mx-auto">
    <header class="flex justify-between">
        <h1 class="text-4xl font-bold mb-4">
            {{ $recordCategory->name }}
        </h1>

        <div>
            @can('delete', $recordCategory)
                <form action="{{ route('record-categories.destroy', $recordCategory) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-error">
                        Delete
                    </button>
                </form>
            @endcan
        </div>
    </header>

    <section class="card border border-base-300">
        <div class="card-body">
            <h2 class="card-title">
               General Information
            </h2>

            <form action="{{ route('record-categories.update', $recordCategory) }}" method="post">
                @csrf
                @method('PUT')

                <div class="form-control">
                    <label for="name" class="label">
                <span>
                    Name
                    <span class="text-error">*</span>
                </span>
                    </label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="input input-bordered"
                        value="{{ old('name', $recordCategory->name) }}"
                        required
                        autofocus
                    >
                </div>

                <button type="submit" class="btn btn-primary mt-4">
                    Save Changes
                </button>
            </form>
        </div>
    </section>
</x-layouts.application>
