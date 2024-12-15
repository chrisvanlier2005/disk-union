@props(['label', 'name', 'type' => 'text'])
<label for="{{ $name }}" class="label">
    <span class="label-text">
        {{ $label }}
    </span>
</label>

<input
    type="{{ $type }}"
    name="{{ $name }}"
    id="{{ $name }}"
    class="input input-bordered"
    {{ $attributes }}
>
