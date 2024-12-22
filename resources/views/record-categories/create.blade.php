<x-layouts.application class="max-w-7xl mx-auto">
    <header>
        <h1 class="text-4xl font-bold mb-4">
            Add Category
        </h1>
        <p>
            Categories are used to manage and group records together. For example, you could have a category for "Rock" records, another for "Jazz" records, and so on.
        </p>
    </header>

    <form action="{{ route('record-categories.store') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

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
                required
                autofocus
            >
        </div>

        <button type="submit" class="btn btn-primary mt-4">
            Add Category
        </button>
    </form>
</x-layouts.application>
