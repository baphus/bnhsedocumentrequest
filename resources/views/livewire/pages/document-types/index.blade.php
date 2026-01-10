<div class="space-y-6">
    <!-- Main Actions Area -->
    <div class="flex items-center justify-between bg-white p-4 rounded-xl shadow-sm border border-gray-100">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Document Types</h3>
            <p class="text-sm text-gray-500">Manage document types and processing requirements</p>
        </div>
        <button
            x-data=""
            x-on:click="Livewire.dispatch('openDocumentModal')"
            class="inline-flex items-center gap-2 px-5 py-2.5 bg-bnhs-blue text-white rounded-lg hover:bg-bnhs-blue-600 transition shadow-md hover:shadow-lg font-bold">
            Add Document Type
        </button>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="p-6" wire:key="documents-container">
            <livewire:document-table />
        </div>
    </div>

    <!-- Modals -->
    <livewire:document-modal wire:key="document-modal-component" />
    <livewire:delete-document-modal wire:key="delete-document-modal-component" />
</div>

