@props(['status'])

@php
    $classes = \App\View\Components\RequestStatus::getStatusClasses($status);
@endphp

<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $classes['badge'] }}">
    {{ ucfirst($status) }}
</span>
