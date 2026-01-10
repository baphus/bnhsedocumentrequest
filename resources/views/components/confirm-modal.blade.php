@props([
    'id' => 'confirm-modal',
    'title' => 'Confirm Action',
    'message' => 'Are you sure you want to perform this action?',
    'confirmText' => 'Confirm',
    'cancelText' => 'Cancel',
    'variant' => 'danger', // danger, warning, primary
])

<x-modal-base :id="$id" :title="$title" size="sm" :persistent="true">
    <div class="py-2">
        <p class="text-sm text-gray-600">{{ $message }}</p>
    </div>
    
    <x-slot name="footer">
        <div class="flex items-center justify-end gap-3">
            <x-button
                variant="outline"
                wire:click="$dispatch('close-modal', '{{ $id }}')"
            >
                {{ $cancelText }}
            </x-button>
            <x-button
                :variant="$variant"
                wire:click="confirmAction"
                :loading="false"
            >
                {{ $confirmText }}
            </x-button>
        </div>
    </x-slot>
</x-modal-base>
