@props(['name', 'placeholder' => ''])

<x-form.field>
    <x-form.label name="{{ $name }}" />

    <textarea type="text" name="{{ $name }}" class="border border-gray-200 p-2 w-full rounded"
        id="{{ $name }}" placeholder="{{ $placeholder }}" required>{{ $slot ?? old($name) }}</textarea>

    <x-form.error name="{{ $name }}" />
</x-form.field>
