@props([
    'status' => 'pending',
])

@php
    $styles = match($status) {
        'pending' => 'bg-gray-100 text-gray-800',
        'verified' => 'bg-teal-100 text-teal-800',
        'processing' => 'bg-blue-100 text-blue-800',
        'ready' => 'bg-green-100 text-green-800',
        'completed' => 'bg-purple-100 text-purple-800',
        'rejected' => 'bg-red-100 text-red-800',
        default => 'bg-gray-100 text-gray-800',
    };
@endphp

<span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium {{ $styles }}">
    {{ ucfirst($status) }}
</span>
