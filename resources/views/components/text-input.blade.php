@props(['label' => null, 'name', 'type' => 'text', 'withError' => true])
@isset($label)

<label for="{{ $name }}" class="label">
    <span class="label-text">
        {{ $label }}

        @if ($attributes->has('required'))
            <span class="text-error">*</span>
        @endif
    </span>
</label>

@endisset

<div class="w-full">
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $attributes->class([
            'input input-bordered w-full',
        ]) }}
    >

    @if($withError)
        @error($name)
        <span class="text-error">{{ $message }}</span>
        @enderror
    @endif
</div>
