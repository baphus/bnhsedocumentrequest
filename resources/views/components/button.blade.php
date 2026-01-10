@props([
    'type' => 'button',
    'variant' => 'primary', // primary, secondary, danger, success, outline
    'size' => 'md', // sm, md, lg
    'loading' => false,
    'disabled' => false,
    'href' => null,
    'wireClick' => null,
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-medium rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';
    
    $variantClasses = match($variant) {
        'primary' => 'bg-bnhs-blue text-white hover:bg-bnhs-blue-600 focus:ring-bnhs-blue',
        'secondary' => 'bg-gray-600 text-white hover:bg-gray-700 focus:ring-gray-500',
        'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500',
        'success' => 'bg-green-600 text-white hover:bg-green-700 focus:ring-green-500',
        'outline' => 'border-2 border-gray-300 text-gray-700 hover:bg-gray-50 focus:ring-gray-500',
        default => 'bg-bnhs-blue text-white hover:bg-bnhs-blue-600 focus:ring-bnhs-blue',
    };
    
    $sizeClasses = match($size) {
        'sm' => 'px-3 py-1.5 text-sm',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-6 py-3 text-base',
        default => 'px-4 py-2 text-sm',
    };
    
    $classes = "{$baseClasses} {$variantClasses} {$sizeClasses}";
    
    $tag = $href ? 'a' : 'button';
    $attributes = $attributes->merge(['class' => $classes]);
    
    if ($disabled || $loading) {
        $attributes = $attributes->merge(['disabled' => true]);
    }
    
    if ($href) {
        $attributes = $attributes->merge(['href' => $href]);
    }
    
    if ($wireClick && !$href) {
        $attributes = $attributes->merge(['wire:click' => $wireClick]);
    }
@endphp

<{{ $tag }} {{ $attributes }}>
    @if($loading)
        <svg class="animate-spin -ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    @endif
    {{ $slot }}
</{{ $tag }}>
