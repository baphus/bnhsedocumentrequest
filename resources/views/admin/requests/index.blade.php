<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-white leading-tight">
            Document Requests
        </h2>
    </x-slot>

    <div class="bg-white rounded-lg shadow border border-slate-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-slate-800">Requests List</h2>
            <button
                x-data="{ refreshing: false }"
                x-on:click="refreshing = true; $dispatch('refreshDatatable'); setTimeout(() => refreshing = false, 1000)"
                :disabled="refreshing"
                class="flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-slate-600 bg-white rounded-md hover:bg-slate-50 transition-colors border border-slate-300 disabled:opacity-50">
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

        <div class="p-6" wire:key="requests-container">
            <livewire:requests-table theme="tailwind" />
        </div>
    </div>
</x-app-layout>