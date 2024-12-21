@props(['record'])

<?php
/**
 * @var \App\Models\Record $record
 */
?>

<div class="w-full card bg-base-100 shadow-xl border border-base-300">
    <figure>
        <img
            src="{{ $record->thumbnail() }}"
            alt="{{ $record->name }}"
            class="w-full aspect-square object-cover"
            loading="lazy"
        />
    </figure>

    <div class="card-body">
        <h2 class="card-title">{{ $record->name }}</h2>
    </div>
</div>
