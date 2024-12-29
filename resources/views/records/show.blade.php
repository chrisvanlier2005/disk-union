<?php
/**
 * @var \App\Models\Record $record
 */
?>

<x-layouts.application class="max-w-7xl mx-auto space-y-6">
    <section class="card bg-base-100 border border-base-300">
        <div class="card-body">
            <div class="flex justify-between items-center">

                <h1 class="card-title text-3xl">{{ $record->name }}</h1>
                <div class="flex gap-3">
                    <a href="{{ route('records.edit', $record) }}" class="btn btn-primary">Edit Record</a>
                    <form action="{{ route('records.destroy', $record) }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @method('delete')

                        <button class="btn btn-error btn-outline">
                            Delete Record
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="grid md:grid-cols-3 gap-6">
        <article class="card border border-base-300 bg-base-100 rounded-xl overflow-hidden col-span-1">
            <figure>
                <img
                    src="{{ $record->thumbnail() }}"
                    alt="{{ $record->name }}"
                    class="w-full aspect-square object-cover"
                    loading="lazy"
                >

                @if ($record->barcode !== null)
                <div>
                    <img
                        src="https://barcode.orcascan.com/?type=qr&data={{ $record->barcode }}"
                        alt="Barcode"
                        class="w-24 h-24 absolute bottom-2 left-2 rounded-xl"
                        loading="lazy"
                    >
                </div>
                @endif
            </figure>
        </article>

        <article class="card border-base-300 border bg-base-100 md:col-span-2">
            <div class="card-body">
                <div class="overflow-x-auto">
                    <table class="table">
                        <tbody>
                        @if ($record->artist !== null)
                        <tr>
                            <th>Artist</th>
                            <td>{{ $record->artist }}</td>
                        </tr>
                        @endif

                        @if ($record->label !== null)
                        <tr>
                            <th>Label</th>
                            <td>{{ $record->label }}</td>
                        </tr>
                        @endif

                        @if ($record->release_date !== null)
                        <tr>
                            <th>Release Date</th>
                            <td>{{ $record->release_date->format('F j, Y') }}</td>
                        </tr>
                        @endif

                        @if ($record->genre !== null)
                        <tr>
                            <th>Genre</th>
                            <td>{{ $record->genre }}</td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </article>

        <article class="card border md:col-span-3 border-base-300">
            <div class="card-body">
                <header class="flex justify-between">
                    <h2 class="text-2xl font-bold">Tracklist</h2>

                    <a href="{{ route('records.tracks.create', $record) }}">
                        <button class="btn btn-primary">
                            Add Track
                        </button>
                    </a>
                </header>

                <div class="overflow-x-auto">
                    <table class="table">
                        <!-- head -->
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Duration</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- row 1 -->
                        @foreach ($record->tracks as $track)
                        <tr>
                            <td>
                                {{ $track->title }}
                            </td>

                            <td>
                                {{ $track->getFormattedDuration() }}
                            </td>
                            
                            <td>
                            
                            </td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>


            </div>
        </article>
    </section>
</x-layouts.application>
