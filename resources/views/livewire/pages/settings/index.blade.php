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
            <form class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">School Name</label>
                    <input type="text" value="Bato National High School" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input type="email" value="bnhs@deped.gov.ph" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Contact Number</label>
                    <input type="text" value="(032) 123-4567" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                </div>
                <button type="submit" class="px-6 py-2.5 bg-bnhs-blue text-white rounded-lg hover:bg-bnhs-blue-600 transition font-semibold">
                    Save Changes
                </button>
            </form>
        </div>
    </div>

    <!-- Modals -->
    <livewire:track-modal wire:key="track-modal-component" />
    <livewire:delete-track-modal wire:key="delete-track-modal-component" />
</div>
