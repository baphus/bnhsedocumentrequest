<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto"
        x-data="{
            selectedDocId: @entangle('selectedDocumentId'),
            quantity: @entangle('quantity'),
            documents: {{ \App\Models\Document::active()->get()->mapWithKeys(fn($d) => [$d->id => ['name' => $d->name, 'processing_days' => $d->processing_days]])->toJson() }}
        }"
    >
        <!-- Progress Steps -->
        <div class="mb-8">
            <div class="flex items-center justify-center">
                <!-- Step 1: Select Document (Current) -->
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-bnhs-blue text-white flex items-center justify-center font-semibold">
                        1
                    </div>
                    <span class="ml-2 text-sm font-medium text-bnhs-blue hidden sm:block">Select Document</span>
                </div>

                <div class="w-12 sm:w-24 h-1 bg-gray-300 mx-2"></div>

                <!-- Step 2: Fill Form -->
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-semibold">
                        2
                    </div>
                    <span class="ml-2 text-sm font-medium text-gray-500 hidden sm:block">Fill Form</span>
                </div>
            </div>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-bnhs-blue to-bnhs-blue-600 px-6 py-6">
                <h2 class="text-2xl font-bold text-white">
                    Select Document Type
                </h2>
                <p class="text-bnhs-blue-100 text-sm mt-1">Choose the document you need to request</p>
            </div>

            <div class="p-6 sm:p-8">
                @if ($errors->any())
                <x-alert type="error" dismissible class="mb-6">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </x-alert>
                @endif

                <div class="space-y-12">
                    @forelse($this->groupedDocuments as $categoryName => $categoryDocs)
                    <div class="scroll-mt-24">
                        <div>
                            <div class="flex items-center gap-4 mb-6">
                                @if($categoryName === 'Official')
                                <div class="w-10 h-10 bg-bnhs-blue-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-bnhs-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                @elseif($categoryName === 'Informal')
                                <div class="w-10 h-10 bg-bnhs-gold-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-bnhs-gold-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                @elseif($categoryName === 'Certified')
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                    </svg>
                                </div>
                                @else
                                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                @endif
                                <h3 class="text-xl font-bold text-gray-900 tracking-tight">{{ $categoryName ?? 'Other' }} Documents</h3>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($categoryDocs as $document)
                                <label class="group relative cursor-pointer">
                                    <input
                                        type="radio"
                                        name="selectedDocumentId"
                                        x-model="selectedDocId"
                                        value="{{ $document->id }}"
                                        class="peer sr-only"
                                        required>
                                    <div class="h-full bg-white border-2 border-gray-100 rounded-2xl p-5 transition-all duration-200 ease-out
                                                hover:border-bnhs-blue/30 hover:shadow-lg hover:-translate-y-1
                                                peer-checked:border-bnhs-blue peer-checked:bg-bnhs-blue/5 peer-checked:shadow-bnhs-blue/10 peer-checked:ring-1 peer-checked:ring-bnhs-blue
                                                peer-checked:[&_.selection-circle]:bg-bnhs-blue peer-checked:[&_.selection-circle]:border-bnhs-blue
                                                peer-checked:[&_.selection-icon]:opacity-100
                                            ">
                                        <div class="flex justify-between items-start">
                                            <div class="w-12 h-12 rounded-xl flex items-center justify-center transition-colors
                                                        @if($categoryName === 'Official') bg-bnhs-blue-50 text-bnhs-blue group-hover:bg-bnhs-blue-100
                                                        @elseif($categoryName === 'Informal') bg-bnhs-gold-50 text-bnhs-gold-600 group-hover:bg-bnhs-gold-100
                                                        @elseif($categoryName === 'Certified') bg-green-50 text-green-600 group-hover:bg-green-100
                                                        @else bg-gray-50 text-gray-600 group-hover:bg-gray-100
                                                        @endif
                                                    ">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </div>
                                            
                                            <div class="selection-circle w-6 h-6 rounded-full border-2 border-gray-200 flex items-center justify-center transition-all">
                                                <svg class="selection-icon w-4 h-4 text-white opacity-0 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <h4 class="font-bold text-gray-900 text-lg group-hover:text-bnhs-blue transition-colors line-clamp-2">
                                                {{ $document->name }}
                                            </h4>
                                            @if($document->processing_days)
                                            <div class="mt-2 flex items-center gap-2 text-sm text-gray-500">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span>{{ $document->processing_days }} {{ $document->processing_days == 1 ? 'day' : 'days' }} processing</span>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-10">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No documents available</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            We couldn't find any documents to display at the moment.
                        </p>
                    </div>
                    @endforelse

                    <div x-show="selectedDocId" x-transition x-cloak class="fixed bottom-0 left-0 right-0 px-4 pt-4 pb-6 bg-white border-t border-gray-200 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.1)] z-50 sm:static sm:bg-transparent sm:border-0 sm:shadow-none sm:p-0 sm:mt-8">
                        <div class="max-w-4xl mx-auto sm:bg-bnhs-blue-50 sm:border sm:border-bnhs-blue-200 sm:rounded-xl sm:p-6">
                            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                                <div class="hidden sm:flex items-center gap-4">
                                    <div class="w-12 h-12 bg-bnhs-blue text-white rounded-xl flex items-center justify-center shadow-md">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-bnhs-blue font-bold uppercase tracking-wider mb-1">Selected Document</p>
                                        <h4 class="text-lg font-bold text-gray-900 leading-tight" x-text="documents[selectedDocId]?.name"></h4>
                                    </div>
                                </div>
                                
                                <div class="w-full sm:w-auto">
                                    <!-- Mobile Document Name (Visible only on mobile) -->
                                    <div class="block sm:hidden mb-3">
                                        <div class="flex items-center gap-2">
                                            <p class="text-xs text-gray-500 font-medium uppercase tracking-wider">Selected:</p>
                                            <h4 class="text-sm font-bold text-bnhs-blue truncate flex-1" x-text="documents[selectedDocId]?.name"></h4>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between gap-3">
                                        <div class="flex items-center bg-white border border-gray-300 rounded-lg overflow-hidden shadow-sm flex-shrink-0">
                                            <button 
                                                type="button" 
                                                @click="if(quantity > 1) quantity--"
                                                class="w-10 h-10 flex items-center justify-center bg-gray-50 hover:bg-gray-100 border-r border-gray-300 text-gray-600 transition-colors disabled:opacity-50"
                                                :disabled="quantity <= 1"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" /></svg>
                                            </button>
                                            <span class="w-10 text-center font-bold text-gray-900 text-base" x-text="quantity"></span>
                                            <button 
                                                type="button" 
                                                @click="if(quantity < 10) quantity++"
                                                class="w-10 h-10 flex items-center justify-center bg-gray-50 hover:bg-gray-100 border-l border-gray-300 text-gray-600 transition-colors disabled:opacity-50"
                                                :disabled="quantity >= 10"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                                            </button>
                                        </div>

                                        <button
                                            type="button"
                                            wire:click="validateSelection"
                                            wire:loading.attr="disabled"
                                            wire:target="validateSelection"
                                            class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-6 py-3 text-base font-bold text-white bg-bnhs-blue rounded-xl shadow-lg shadow-bnhs-blue/30 hover:bg-bnhs-blue-600 hover:-translate-y-0.5 transition-all disabled:opacity-50 disabled:cursor-not-allowed whitespace-nowrap">
                                            <span wire:loading.remove wire:target="validateSelection">Continue</span>
                                            <span wire:loading wire:target="validateSelection" class="flex items-center gap-2">
                                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                            </span>
                                            <svg wire:loading.remove wire:target="validateSelection" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Spacer for fixed bottom bar on mobile -->
                    <div x-show="selectedDocId" class="h-32 sm:hidden"></div>
                    
                    @error('selectedDocumentId')
                    <x-alert type="error" class="mt-4">
                        {{ $message }}
                    </x-alert>
                    @enderror

                    <!-- Default Continue Button (Visible when no document is selected) -->
                    <div x-show="!selectedDocId" class="mt-8 flex justify-end border-t border-gray-100 pt-6">
                        <div class="flex flex-col items-end gap-2 w-full sm:w-auto">
                            <span class="text-sm text-gray-500 hidden sm:block">Please select a document to proceed</span>
                            <button
                                type="button"
                                disabled
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3 text-base font-bold text-gray-400 bg-gray-100 border border-gray-200 rounded-xl cursor-not-allowed transition-all">
                                Continue
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>