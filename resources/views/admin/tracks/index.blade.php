<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold text-gray-900">Educational Tracks Management</h2>
            <a href="#" class="inline-flex items-center gap-2 px-4 py-2 bg-bnhs-blue text-white rounded-lg hover:bg-bnhs-blue-600 transition font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Track
            </a>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Academic Tracks -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-900">Academic Tracks</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">GAS</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">General Academic Strand</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="#" class="text-bnhs-blue hover:text-bnhs-blue-600 mr-4">Edit</a>
                                <a href="#" class="text-red-600 hover:text-red-800">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- TVL Tracks -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-900">TVL Tracks</h3>
            </div>
            <div class="px-6 py-4 text-center text-sm text-gray-500">
                No TVL tracks yet
            </div>
        </div>
    </div>
</x-app-layout>