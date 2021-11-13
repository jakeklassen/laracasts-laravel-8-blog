@props(['name'])

<x-form.field>
    <x-form.label name="{{ $name }}" />

    <input name="{{ $name }}" class="border border-gray-200 p-2 w-full rounded" id="{{ $name }}"
        value="{{ old($name) }}" {{ $attributes }} required>

    <x-form.error name="{{ $name }}" />
</x-form.field>
