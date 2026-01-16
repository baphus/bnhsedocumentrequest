<div>
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">
            Approve Request
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Are you sure you want to approve this request? This will move the status to "Processing".
        </p>

        <div class="mt-6 flex justify-end">
            <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-bnhs-blue" wire:click="$dispatch('closeModal')">
                Cancel
            </button>
            <button type="button" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500" wire:click="approve">
                Approve Request
            </button>
        </div>
    </div>
</div>
