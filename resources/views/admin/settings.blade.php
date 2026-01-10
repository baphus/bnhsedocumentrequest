<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-900">Settings</h2>
    </x-slot>

    <div class="space-y-6">
        <!-- General Settings -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-900">General Settings</h3>
            </div>
            <div class="p-6">
                <form class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">School Name</label>
                        <input type="text" value="Bato National High School" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input type="email" value="bnhs@deped.gov.ph" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Contact Number</label>
                        <input type="text" value="(032) 123-4567" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                    </div>
                    <button type="submit" class="px-6 py-2.5 bg-bnhs-blue text-white rounded-lg hover:bg-bnhs-blue-600 transition font-semibold">
                        Save Changes
                    </button>
                </form>
            </div>
        </div>

        <!-- Email Settings -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-900">Email Settings</h3>
            </div>
            <div class="p-6">
                <form class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">SMTP Host</label>
                        <input type="text" value="smtp.gmail.com" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">SMTP Port</label>
                        <input type="number" value="587" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                    </div>
                    <button type="submit" class="px-6 py-2.5 bg-bnhs-blue text-white rounded-lg hover:bg-bnhs-blue-600 transition font-semibold">
                        Save Changes
                    </button>
                </form>
            </div>
        </div>

        <!-- System Settings -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-900">System Settings</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Maintenance Mode</p>
                            <p class="text-xs text-gray-500">Enable maintenance mode to restrict access</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-bnhs-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-bnhs-blue"></div>
                        </label>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Email Notifications</p>
                            <p class="text-xs text-gray-500">Send email notifications for status updates</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" checked class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-bnhs-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-bnhs-blue"></div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>