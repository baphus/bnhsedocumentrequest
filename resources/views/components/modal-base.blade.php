@props([
    'id' => null,
    'size' => 'md', // sm, md, lg, xl, full
    'title' => null,
    'showClose' => true,
    'persistent' => false, // If true, clicking backdrop won't close
])

@php
    $sizeClasses = match($size) {
        'sm' => 'max-w-md',
        'md' => 'max-w-lg',
        'lg' => 'max-w-2xl',
        'xl' => 'max-w-4xl',
        'full' => 'max-w-full mx-4',
        default => 'max-w-lg',
    };
    
    $modalId = $id ?? 'modal-' . uniqid();
@endphp

    <div
        x-data="{
        open: false,
        id: '{{ $modalId }}',
        init() {
            this.$watch('open', value => {
                if (value) {
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = '';
                }
            });
            
            Livewire.on('open-modal', (modalId) => {
                if (modalId === this.id) {
                    this.open = true;
                }
            });
            
            Livewire.on('close-modal', (modalId) => {
                if (modalId === this.id) {
                    this.open = false;
                }
            });
        }
    }"
    x-show="open"
    x-on:close-modal.window="if ($event.detail === id) open = false"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 overflow-y-auto"
    style="display: none;"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true">
    
    <!-- Backdrop -->
    <div
        x-show="open"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @if(!$persistent)
        @click="open = false"
        @endif
        class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm"
    ></div>

    <!-- Modal Container -->
    <div class="flex min-h-full items-center justify-center p-4">
        <div
            x-show="open"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            @click.away="{{ !$persistent ? 'open = false' : '' }}"
            class="relative w-full {{ $sizeClasses }} transform overflow-hidden rounded-xl bg-white shadow-2xl transition-all"
        >
            <!-- Header -->
            @if($title || $showClose)
            <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4">
            @if($title)
            <h3 id="modal-title" class="text-lg font-semibold text-gray-900">
                {{ $title }}
            </h3>
            @endif
            
                @if($showClose)
                <button
                    type="button"
                    @click="open = false"
                    class="rounded-lg p-1.5 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-bnhs-blue"
                >
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                @endif
            </div>
            @endif

            <!-- Content -->
            <div class="px-6 py-4">
                {{ $slot }}
            </div>

            <!-- Footer -->
            @isset($footer)
            <div class="border-t border-gray-200 px-6 py-4 bg-gray-50">
                {{ $footer }}
            </div>
            @endisset
        </div>
    </div>
</div>
