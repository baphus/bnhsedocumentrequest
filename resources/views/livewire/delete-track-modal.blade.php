<div x-on:close-modal.window="if($event.detail == 'delete-track-modal') $wire.set('isOpen', false)">
    <x-modal name="delete-track-modal" :show="$isOpen" focusable maxWidth="sm">
        <div class="p-6">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 4v2M7 9H5a2 2 0 00-2 2v12a2 2 0 002 2h14a2 2 0 002-2V11a2 2 0 00-2-2h-2m-4-4V5a2 2 0 10-4 0v4m0 0a2 2 0 100 4h0a2 2 0 000-4z" />
                </svg>
            </div>

            <h3 class="mt-4 text-lg font-medium text-center text-gray-900">
                Delete Track
            </h3>

            @if($error)
                <div class="mt-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <p class="text-sm text-red-700">{{ $error }}</p>
                </div>
            @else
                <p class="mt-2 text-center text-sm text-gray-500">
                    Are you sure you want to delete <span class="font-medium">{{ $track?->name ?? 'this track' }}</span>? This action cannot be undone.
                </p>
            @endif

            <div class="flex justify-end gap-3 mt-6">
                @if(!$error)
                    <x-secondary-button type="button" wire:click="closeModal">Cancel</x-secondary-button>
                    <button
                        type="button"
                        wire:click="delete"
                        class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg font-semibold transition">
                        Delete
                    </button>
                @else
                    <x-secondary-button type="button" wire:click="closeModal" class="w-full">Close</x-secondary-button>
                @endif
            </div>
        </div>
    </x-modal>
</div>
