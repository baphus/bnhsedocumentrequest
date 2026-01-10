<div x-on:close-modal.window="if($event.detail == 'delete-request-modal') $wire.set('isOpen', false)">
    <x-modal name="delete-request-modal" :show="$isOpen" focusable>
        <div class="p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">
                Confirm Deletion
            </h2>

            @if($request)
            <div class="bg-red-50 border border-red-100 rounded-xl p-4 mb-6">
                <div class="flex items-start gap-3">
                    <div class="p-2 bg-red-100 rounded-lg text-red-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-red-900">Request Summary</h3>
                        <div class="mt-2 space-y-1 text-sm text-red-800">
                            <p><span class="font-semibold text-red-900">Tracking ID:</span> {{ $request->tracking_id }}</p>
                            <p><span class="font-semibold text-red-900">Student:</span> {{ $request->full_name }}</p>
                            <p><span class="font-semibold text-red-900">Document:</span> {{ $request->documentType?->name }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <p class="text-gray-600 mb-6 font-medium">
                Are you sure you want to delete the request for <span class="text-red-600 font-bold underline">{{ $request->full_name }}</span>? This action cannot be undone.
            </p>
            @endif

            <div class="flex justify-end gap-3 mt-6">
                <x-secondary-button wire:click="closeModal">Cancel</x-secondary-button>
                <x-danger-button wire:click="delete">Delete Request</x-danger-button>
            </div>
        </div>
    </x-modal>
</div>