<?php
/**
 * @var \App\Models\Record $record
 */
?>

<x-layouts.application class="max-w-7xl mx-auto">
    <header>
        <h1 class="text-4xl font-bold">
            Edit {{ $record->name }}
        </h1>
    </header>

    <div class="card bg-base-100 shadow-xl border border-base-300 mt-3">
        <div class="card-body">
            <div class="flex justify-between">
                <h2 class="card-title">Images</h2>

                @can('create', [\App\Models\RecordImage::class, $record])
                    <a href="{{ route('records.record-images.create', $record) }}" class="btn btn-primary">
                            Add Image
                    </a>
                @endcan
            </div>
            <div class="flex flex-wrap gap-4">
                @foreach ($record->recordImages as $image)
                    <div class="relative">
                        <img src="{{ $image->url() }}" alt="{{ $record->name }}" class="size-64 object-cover rounded-xl">

                        <form action="{{ route('record-images.destroy', $image) }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            @method('DELETE')
                            <button type="submit" class="btn btn-circle mt-2 absolute top-2 right-2">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="#000000"
                                    version="1.1"
                                    class="size-6"
                                    viewBox="0 0 485 485"
                                >
                                        <g>
                                            <g>
                                                <rect x="67.224" width="350.535" height="71.81" />
                                                <path d="M417.776,92.829H67.237V485h350.537V92.829H417.776z M165.402,431.447h-28.362V146.383h28.362V431.447z M256.689,431.447    h-28.363V146.383h28.363V431.447z M347.97,431.447h-28.361V146.383h28.361V431.447z" />
                                            </g>
                                        </g>
                                </svg>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <x-records.create-or-edit-record-form :$record :$recordCategories/>
</x-layouts.application>
