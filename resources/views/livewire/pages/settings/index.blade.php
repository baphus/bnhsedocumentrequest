<div class="space-y-6">
    <!-- Educational Tracks Management -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold text-gray-900">Educational Tracks</h3>
                <button
                    x-data="{}"
                    x-on:click="Livewire.dispatch('openTrackModal')"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-bnhs-blue text-white rounded-lg hover:bg-bnhs-blue-600 transition font-semibold text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add Track
                </button>
            </div>
        </div>
        <div class="p-6" wire:key="tracks-container">
            <livewire:tables.track-table />
        </div>
    </div>

    <!-- General Settings -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-900">General Settings</h3>
        </div>
        <div class="p-6">
            <form wire:submit.prevent="save" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="from_email" class="font-medium text-gray-700">Contact Email</label>
                        <p class="text-sm text-gray-500">This email address will be displayed on the public website for users to contact.</p>
                        <input wire:model="from_email" id="from_email" name="from_email" type="email" autocomplete="email" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                    </div>
                    <div class="space-y-2">
                        <label for="phone_number" class="font-medium text-gray-700">Phone Number</label>
                        <p class="text-sm text-gray-500">Contact number displayed on the footer.</p>
                        <input wire:model="phone_number" id="phone_number" name="phone_number" type="text" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                    </div>
                    <div class="space-y-2">
                        <label for="location" class="font-medium text-gray-700">Location</label>
                        <p class="text-sm text-gray-500">Office location/address displayed on the footer.</p>
                        <input wire:model="location" id="location" name="location" type="text" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                    </div>
                    <div class="space-y-2">
                        <label for="availability_times" class="font-medium text-gray-700">Availability Times</label>
                        <p class="text-sm text-gray-500">Office hours displayed on the footer.</p>
                        <input wire:model="availability_times" id="availability_times" name="availability_times" type="text" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                    </div>
                    <div class="space-y-2">
                        <label for="maintenance_mode" class="font-medium text-gray-700">Maintenance Mode</label>
                        <p class="text-sm text-gray-500">Enable maintenance mode to disable the website for users.</p>
                        <div class="relative flex items-start mt-2">
                            <div class="flex items-center h-5">
                                <input wire:model="maintenance_mode" id="maintenance_mode" name="maintenance_mode" type="checkbox" class="focus:ring-bnhs-blue h-4 w-4 text-bnhs-blue border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="maintenance_mode" class="font-medium text-gray-700">Enable</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-4 pt-6 border-t border-gray-200">
                    <button type="button" class="px-6 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold">
                        Cancel
                    </button>
                    <button type="submit" wire:loading.attr="disabled" wire:target="save" class="px-6 py-2.5 bg-bnhs-blue text-white rounded-lg hover:bg-bnhs-blue-600 transition font-semibold flex items-center gap-2">
                        <span wire:loading.remove wire:target="save">Save Changes</span>
                        <span wire:loading wire:target="save">
                            <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modals -->
    <livewire:track-modal wire:key="track-modal-component" />
    <livewire:delete-track-modal wire:key="delete-track-modal-component" />
</div>
