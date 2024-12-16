@props(['label' => null, 'name', 'type' => 'text'])
@isset($label)

<label for="{{ $name }}" class="label">
    <span class="label-text">
        {{ $label }}
    </span>
</label>

@endisset
<input
    type="{{ $type }}"
    name="{{ $name }}"
    id="{{ $name }}"
    {{ $attributes->class(['input input-bordered']) }}
>
