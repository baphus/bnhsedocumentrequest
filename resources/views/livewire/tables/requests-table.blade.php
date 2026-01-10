<div>
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-3">
            <h2 class="text-lg font-semibold text-gray-900">Requests List</h2>
        </div>
        <button
            x-data="{ refreshing: false }"
            x-on:click="refreshing = true; $dispatch('refreshDatatable'); setTimeout(() => refreshing = false, 1000)"
            :disabled="refreshing"
            class="flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-gray-600 bg-white rounded-md hover:bg-gray-50 transition-colors border border-gray-300 disabled:opacity-50">
            <svg
                class="w-4 h-4"
                :class="{ 'animate-spin': refreshing }"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            <span x-text="refreshing ? 'Refreshing...' : 'Refresh'"></span>
        </button>
    </div>

    <div wire:key="requests-table-container">
        {{ $this->table }}
    </div>
</div>
