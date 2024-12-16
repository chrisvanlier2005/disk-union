<?php
/**
 * @var \Illuminate\Database\Eloquent\Collection<int, \App\Models\Record> $records
 * @var int $totalRecordsCount
 * @var int $recentlyAddedRecordsCount
 */
?>

<x-layouts.application class="max-w-7xl mx-auto space-y-12">
    <h1 class="text-4xl">
        Welcome back,
        <span class="font-bold">
            {{ auth()->user()->name }}
        </span>
    </h1>

    <section class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
        <article class="card bg-base-100 w-full shadow-xl border border-base-300">
            <div class="card-body">
                <p>Your complete collection</p>
                <h2 class="text-4xl font-bold text-primary">
                    {{ $totalRecordsCount }}
                </h2>
            </div>
        </article>

        <article class="card bg-base-100 w-full shadow-xl border border-base-300">
            <div class="card-body">
                <p>Recently added</p>
                <h2 class="text-4xl font-bold text-primary">
                    {{ $recentlyAddedRecordsCount }}
                </h2>
            </div>
        </article>
    </section>
</x-layouts.application>
