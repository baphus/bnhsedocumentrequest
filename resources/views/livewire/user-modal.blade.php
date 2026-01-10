<div x-on:close-modal.window="if($event.detail == 'user-management-modal') $wire.set('isOpen', false)">
    <x-modal name="user-management-modal" :show="$isOpen" focusable>
        <form wire:submit.prevent="save" class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                {{ $userId ? 'Edit User' : 'Add New User' }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ $userId ? 'Update the user details below.' : 'Fill in the details to create a new user account.' }}
            </p>

            <div class="mt-6 space-y-4">
                <!-- Name -->
                <div>
                    <x-input-label for="name" value="Name" />
                    <x-text-input
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        wire:model="name"
                        required
                        autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" value="Email" />
                    <x-text-input
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        wire:model="email"
                        required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="$userId ? 'Password (leave blank to keep current)' : 'Password'" />
                    <x-text-input
                        id="password"
                        type="password"
                        class="mt-1 block w-full"
                        wire:model="password"
                        :required="!$userId" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <!-- Role -->
                    <div>
                        <x-input-label for="role" value="Role" />
                        <select
                            id="role"
                            wire:model="role"
                            class="mt-1 block w-full border-gray-300 focus:border-bnhs-blue focus:ring-bnhs-blue rounded-md shadow-sm">
                            <option value="registrar">Registrar</option>
                            <option value="admin">Admin</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <!-- Status -->
                    <div>
                        <x-input-label for="status" value="Status" />
                        <select
                            id="status"
                            wire:model="status"
                            class="mt-1 block w-full border-gray-300 focus:border-bnhs-blue focus:ring-bnhs-blue rounded-md shadow-sm">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button wire:click="closeModal" type="button">
                    Cancel
                </x-secondary-button>

                <x-primary-button class="bg-bnhs-blue hover:bg-bnhs-blue-600">
                    {{ $userId ? 'Update User' : 'Create User' }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
</div>