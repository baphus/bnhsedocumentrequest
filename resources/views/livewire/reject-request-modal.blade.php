<div>
    <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">
            Reject Request
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Please provide a reason for rejecting this request. The reason will be visible to the student.
        </p>

        <div class="mt-4">
            <label for="admin_remarks" class="block text-sm font-medium text-gray-700">Reason for Rejection</label>
            <textarea wire:model="admin_remarks" id="admin_remarks" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-bnhs-blue focus:border-bnhs-blue sm:text-sm"></textarea>
            @error('admin_remarks') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="mt-6 flex justify-end">
            <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-bnhs-blue" wire:click="$dispatch('closeModal')">
                Cancel
            </button>
            <button type="button" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" wire:click="reject">
                Reject Request
            </button>
        </div>
    </div>
</div>
