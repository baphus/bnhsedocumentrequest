@props([
    'type' => 'default', // default, table, card, list
    'lines' => 3,
])

@php
    $skeletonClass = 'animate-pulse bg-gray-200 rounded';
@endphp

@if($type === 'table')
    <div class="space-y-3">
        @for($i = 0; $i < $lines; $i++)
            <div class="flex items-center space-x-4">
                <div class="{{ $skeletonClass }} h-4 w-12"></div>
                <div class="{{ $skeletonClass }} h-4 flex-1"></div>
                <div class="{{ $skeletonClass }} h-4 w-24"></div>
                <div class="{{ $skeletonClass }} h-4 w-32"></div>
            </div>
        @endfor
    </div>
@elseif($type === 'card')
    <div class="space-y-4">
        <div class="{{ $skeletonClass }} h-6 w-1/3"></div>
        <div class="{{ $skeletonClass }} h-4 w-full"></div>
        <div class="{{ $skeletonClass }} h-4 w-5/6"></div>
        <div class="{{ $skeletonClass }} h-4 w-4/6"></div>
    </div>
@elseif($type === 'list')
    <div class="space-y-3">
        @for($i = 0; $i < $lines; $i++)
            <div class="{{ $skeletonClass }} h-16 w-full"></div>
        @endfor
    </div>
@else
    <div class="space-y-2">
        @for($i = 0; $i < $lines; $i++)
            <div class="{{ $skeletonClass }} h-4 {{ $i === $lines - 1 ? 'w-3/4' : 'w-full' }}"></div>
        @endfor
    </div>
@endif
