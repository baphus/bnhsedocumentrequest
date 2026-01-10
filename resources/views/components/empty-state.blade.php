@props([
    'icon' => null,
    'title' => 'No items found',
    'description' => 'Get started by creating a new item.',
    'action' => null,
    'actionText' => 'Create New',
])

<div class="text-center py-12 px-4">
    @if($icon)
        <div class="mx-auto w-16 h-16 text-gray-400 mb-4">
            {{ $icon }}
        </div>
    @else
        <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
        </svg>
    @endif
    
    <h3 class="mt-4 text-lg font-semibold text-gray-900">{{ $title }}</h3>
    @if($description)
    <p class="mt-2 text-sm text-gray-500 max-w-sm mx-auto">{{ $description }}</p>
    @endif
    
    @if($action)
    <div class="mt-6">
        {{ $action }}
    </div>
    @endif
</div>
