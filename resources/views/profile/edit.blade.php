<x-app-layout>
    <x-slot name="header">
        Profile Settings
    </x-slot>

    <div class="space-y-6">
        <!-- Update Profile Information -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-900">Update Profile Information</h3>
                <p class="text-sm text-gray-600 mt-1">Update your account's profile information and email address.</p>
            </div>
            <div class="p-6">
                <div class="max-w-2xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>

        <!-- Update Password -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-bold text-gray-900">Update Password</h3>
                <p class="text-sm text-gray-600 mt-1">Ensure your account is using a strong, unique password.</p>
            </div>
            <div class="p-6">
                <div class="max-w-2xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        <!-- Delete Account -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden border-2 border-red-200">
            <div class="bg-red-50 px-6 py-4 border-b border-red-200">
                <h3 class="text-lg font-bold text-red-900">Delete Account</h3>
                <p class="text-sm text-red-700 mt-1">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
            </div>
            <div class="p-6">
                <div class="max-w-2xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
