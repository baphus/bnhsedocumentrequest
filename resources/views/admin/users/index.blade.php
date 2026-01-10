<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-900">Users Management</h2>
    </x-slot>

    <div class="space-y-6">
        <!-- Main Actions Area -->
        <div class="flex items-center justify-between bg-white p-4 rounded-xl shadow-sm border border-gray-100">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">System Users</h3>
                <p class="text-sm text-gray-500">Manage administrator and registrar accounts</p>
            </div>
            <button
                x-data=""
                x-on:click="$dispatch('openUserModal')"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-bnhs-blue text-white rounded-lg hover:bg-bnhs-blue-600 transition shadow-md hover:shadow-lg font-bold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                </svg>
                Add New User
            </button>
        </div>

        <!-- Table Container -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
            <livewire:users-table />
        </div>

        <livewire:user-modal />
    </div>


</x-app-layout>