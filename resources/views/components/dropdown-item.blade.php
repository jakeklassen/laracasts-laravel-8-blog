@props(['active' => false])

@php
$classes = 'block text-left px-3 text-small leading-6 hover:bg-gray-300 focus:bg-gray-300';

if ($active) {
    $classes .= ' bg-gray-300';
}
@endphp

<a {{ $attributes(['class' => $classes]) }}>{{ $slot }}</a>
