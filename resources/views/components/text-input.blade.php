@props(['label' => null, 'name', 'type' => 'text', 'withError' => true])
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
    {{ $attributes->class([
        'input input-bordered',
    ]) }}
>

@if($withError)
    @error($name)
    <span class="text-error">{{ $message }}</span>
    @enderror
@endif
