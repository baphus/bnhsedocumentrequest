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
                onclick="refreshTable(this)"
                class="flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-slate-600 bg-white rounded-md hover:bg-slate-50 transition-colors border border-slate-300"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Refresh
            </button>
        </div>

        <div class="p-6">
            <div wire:key="requests-container"> {{-- Add a wire:key here --}}
            <livewire:requests-table theme="tailwind"/>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
function refreshTable(button) {
    button.classList.add('refreshing');
    button.disabled = true;

    Livewire.dispatch('$refresh');

    const tableComponent = Livewire.find(
        document.querySelector('[wire\\:id]')?.getAttribute('wire:id')
    );

    if (tableComponent) {
        tableComponent.call('$refresh');
    }

    setTimeout(() => {
        button.classList.remove('refreshing');
        button.disabled = false;
    }, 1000);
}
</script>
