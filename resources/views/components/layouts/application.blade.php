<x-layouts.main>
    <x-navigation />

    <main {{ $attributes->class(['px-6 py-2']) }}>
        {{ $slot }}
    </main>
</x-layouts.main>
