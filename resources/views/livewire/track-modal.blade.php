<div x-on:close-modal.window="if($event.detail == 'track-modal') $wire.set('isOpen', false)">
    <x-modal name="track-modal" :show="$isOpen" focusable maxWidth="md">
        <form wire:submit.prevent="save" class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                {{ $trackId ? 'Edit Track' : 'Create Track' }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ $trackId ? 'Update the track details below.' : 'Fill in the details to create a new track.' }}
            </p>

            <div class="mt-6 space-y-4">
                <div>
                    <x-input-label for="category" value="Category" />
                    <x-text-input id="category" type="text" class="mt-1 block w-full" wire:model="category" placeholder="e.g., Academic, TVL" required />
                    <x-input-error :messages="$errors->get('category')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="code" value="Code" />
                    <x-text-input id="code" type="text" class="mt-1 block w-full" wire:model="code" placeholder="e.g., GAS, HUMSS" required />
                    <x-input-error :messages="$errors->get('code')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="name" value="Name" />
                    <x-text-input id="name" type="text" class="mt-1 block w-full" wire:model="name" placeholder="e.g., General Academic Strand" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="flex items-center">
                    <input wire:model="is_active" id="is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <label for="is_active" class="ml-2 text-sm text-gray-600">Active</label>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6 border-t pt-4">
                <x-secondary-button type="button" wire:click="closeModal">Cancel</x-secondary-button>
                <x-primary-button type="submit" class="bg-bnhs-blue hover:bg-bnhs-blue-600">Save</x-primary-button>
            </div>
        </form>
    </x-modal>
</div>
