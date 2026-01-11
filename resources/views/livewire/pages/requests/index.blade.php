<style>
    /* Style Delete Selected in red */
    button[wire\:click*="bulkDelete"],
    a[wire\:click*="bulkDelete"] {
        color: #dc2626 !important;
    }

    button[wire\:click*="bulkDelete"]:hover,
    a[wire\:click*="bulkDelete"]:hover {
        color: #991b1b !important;
        background-color: #fef2f2 !important;
    }
</style>

<div class="space-y-6">
    <!-- Main Actions Area -->
    <div class="flex items-center justify-between bg-white p-4 rounded-xl shadow-sm border border-gray-100">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Document Requests</h3>
            <p class="text-sm text-gray-500">Manage and track student document requests</p>
        </div>
        <div class="flex items-center gap-3">
            <button
                x-data="{}"
                x-on:click="$dispatch('openRequestModal')"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition border border-blue-700 disabled:opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12 5l0 14"></path>
                    <path d="M5 12l14 0"></path>
                </svg>
                Add Request
            </button>
            <button
                x-data="{ refreshing: false }"
                x-on:click="refreshing = true; $dispatch('refreshDatatable'); setTimeout(() => refreshing = false, 1000)"
                :disabled="refreshing"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-slate-600 bg-white rounded-lg hover:bg-slate-50 transition border border-slate-200 disabled:opacity-50">
                <svg class="w-4 h-4" :class="{ 'animate-spin': refreshing }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Refresh
            </button>
        </div>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="p-6" wire:key="requests-container">
            <livewire:requests-table theme="tailwind" />
        </div>
    </div>

    <!-- Modals -->
    <livewire:request-modal wire:key="request-modal-component" />
    <livewire:delete-request-modal wire:key="delete-request-modal-component" />
</div>