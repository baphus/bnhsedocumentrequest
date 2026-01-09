<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-900">Audit Logs</h2>
    </x-slot>

    <!-- Filter Bar -->
    <div class="bg-white rounded-xl shadow-lg mb-6">
        <div class="p-6">
            <form method="GET" class="flex flex-wrap gap-4 items-end">
                <div class="min-w-[150px]">
                    <label class="block text-xs font-medium text-gray-700 mb-1">Date From</label>
                    <input type="date" name="date_from" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                </div>
                <div class="min-w-[150px]">
                    <label class="block text-xs font-medium text-gray-700 mb-1">Date To</label>
                    <input type="date" name="date_to" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                </div>
                <div class="min-w-[150px]">
                    <label class="block text-xs font-medium text-gray-700 mb-1">User</label>
                    <select name="user_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                        <option value="">All Users</option>
                    </select>
                </div>
                <div class="min-w-[150px]">
                    <label class="block text-xs font-medium text-gray-700 mb-1">Action Type</label>
                    <select name="action" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                        <option value="">All Actions</option>
                        <option value="created">Created</option>
                        <option value="updated">Updated</option>
                        <option value="deleted">Deleted</option>
                    </select>
                </div>
                <button type="submit" class="px-6 py-2 bg-bnhs-blue text-white rounded-lg hover:bg-bnhs-blue-600 transition font-semibold">
                    Filter
                </button>
            </form>
        </div>
    </div>

    <!-- Audit Logs Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Timestamp</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Details</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IP Address</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">2024-01-15 10:30 AM</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Admin User</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Updated</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">Request status changed to "processing"</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">192.168.1.1</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200 text-center text-sm text-gray-500">
            Audit logs functionality coming soon
        </div>
    </div>
</x-app-layout>
