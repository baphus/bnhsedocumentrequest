<div x-on:close-modal.window="if($event.detail == 'request-management-modal') $wire.set('isOpen', false)">
    <x-modal name="request-management-modal" :show="$isOpen" focusable maxWidth="2xl">
        <form wire:submit.prevent="save" class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                {{ $requestId ? 'Edit Request' : 'Add New Request' }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ $requestId ? 'Update the request details below.' : 'Fill in the details to manually create a new document request.' }}
            </p>

            <div class="mt-6 grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- First Name -->
                <div>
                    <x-input-label for="first_name" value="First Name" />
                    <x-text-input id="first_name" type="text" class="mt-1 block w-full" wire:model="form.first_name" required />
                    <x-input-error :messages="$errors->get('form.first_name')" class="mt-2" />
                </div>

                <!-- Middle Name -->
                <div>
                    <x-input-label for="middle_name" value="Middle Name" />
                    <x-text-input id="middle_name" type="text" class="mt-1 block w-full" wire:model="form.middle_name" />
                    <x-input-error :messages="$errors->get('form.middle_name')" class="mt-2" />
                </div>

                <!-- Last Name -->
                <div>
                    <x-input-label for="last_name" value="Last Name" />
                    <x-text-input id="last_name" type="text" class="mt-1 block w-full" wire:model="form.last_name" required />
                    <x-input-error :messages="$errors->get('form.last_name')" class="mt-2" />
                </div>

                <!-- Suffix -->
                <div>
                    <x-input-label for="suffix" value="Suffix" />
                    <select id="suffix" wire:model="form.suffix" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-bnhs-blue focus:border-bnhs-blue">
                        <option value="">None</option>
                        <option value="Jr.">Jr.</option>
                        <option value="Sr.">Sr.</option>
                        <option value="II">II</option>
                        <option value="III">III</option>
                        <option value="IV">IV</option>
                        <option value="V">V</option>
                    </select>
                    <x-input-error :messages="$errors->get('form.suffix')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="md:col-span-2">
                    <x-input-label for="email" value="Email" />
                    <x-text-input id="email" type="email" class="mt-1 block w-full" wire:model="form.email" required
                        placeholder="Required for tracking notifications" />
                    <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
                </div>

                <!-- Contact Number -->
                <div>
                    <x-input-label for="contact_number" value="Contact Number" />
                    <x-text-input id="contact_number" type="text" class="mt-1 block w-full" wire:model="form.contact_number" required />
                    <x-input-error :messages="$errors->get('form.contact_number')" class="mt-2" />
                </div>

                <!-- LRN -->
                <div>
                    <x-input-label for="lrn" value="LRN (12 Digits)" />
                    <x-text-input id="lrn" type="text" class="mt-1 block w-full" wire:model="form.lrn" maxlength="12" required />
                    <x-input-error :messages="$errors->get('form.lrn')" class="mt-2" />
                </div>

                <!-- Grade Level -->
                <div>
                    <x-input-label for="grade_level" value="Grade Level" />
                    <select id="grade_level" wire:model="form.grade_level" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-bnhs-blue focus:border-bnhs-blue">
                        <option value="">Select Grade Level</option>
                        <option value="Grade 7">Grade 7</option>
                        <option value="Grade 8">Grade 8</option>
                        <option value="Grade 9">Grade 9</option>
                        <option value="Grade 10">Grade 10</option>
                        <option value="Grade 11">Grade 11</option>
                        <option value="Grade 12">Grade 12</option>
                    </select>
                    <x-input-error :messages="$errors->get('form.grade_level')" class="mt-2" />
                </div>

                <!-- Section -->
                <div>
                    <x-input-label for="section" value="Section" />
                    <x-text-input id="section" type="text" class="mt-1 block w-full" wire:model="form.section" />
                    <x-input-error :messages="$errors->get('form.section')" class="mt-2" />
                </div>

                <!-- Track/Strand -->
                <div>
                    <x-input-label for="track_strand" value="Track/Strand" />
                    <select id="track_strand" wire:model="form.track_strand" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-bnhs-blue focus:border-bnhs-blue">
                        <option value="N/A">N/A (Junior High)</option>
                        @foreach($tracks as $track)
                        <option value="{{ $track->code }}">{{ $track->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('form.track_strand')" class="mt-2" />
                </div>

                <!-- School Year Last Attended -->
                <div>
                    <x-input-label for="school_year_last_attended" value="SY Last Attended" />
                    <x-text-input id="school_year_last_attended" type="text" class="mt-1 block w-full" wire:model="form.school_year_last_attended" required placeholder="e.g. 2023-2024" />
                    <x-input-error :messages="$errors->get('form.school_year_last_attended')" class="mt-2" />
                </div>

                <!-- Document Type -->
                <div>
                    <x-input-label for="document_type_id" value="Document Type" />
                    <select id="document_type_id" wire:model="form.document_type_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-bnhs-blue focus:border-bnhs-blue" required>
                        <option value="">Select Document</option>
                        @foreach($documents as $doc)
                        <option value="{{ $doc->id }}">{{ $doc->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('form.document_type_id')" class="mt-2" />
                </div>

                <!-- Quantity -->
                <div>
                    <x-input-label for="quantity" value="Quantity" />
                    <x-text-input id="quantity" type="number" class="mt-1 block w-full" wire:model="form.quantity" min="1" max="10" required />
                    <x-input-error :messages="$errors->get('form.quantity')" class="mt-2" />
                </div>

                <!-- Purpose -->
                <div class="md:col-span-2">
                    <x-input-label for="purpose" value="Purpose" />
                    <textarea id="purpose" wire:model="form.purpose" rows="2" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-bnhs-blue focus:border-bnhs-blue" required></textarea>
                    <x-input-error :messages="$errors->get('form.purpose')" class="mt-2" />
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3 border-t pt-4">
                <x-secondary-button wire:click="closeModal" type="button">Cancel</x-secondary-button>
                <x-primary-button class="bg-bnhs-blue hover:bg-bnhs-blue-600">{{ $requestId ? 'Update Request' : 'Create Request' }}</x-primary-button>
            </div>
        </form>
    </x-modal>
</div>