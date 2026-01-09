@extends('layouts.public')

@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
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

                <!-- Step 2: Verify Email -->
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-semibold">
                        2
                    </div>
                    <span class="ml-2 text-sm font-medium text-gray-500 hidden sm:block">Verify Email</span>
                </div>

                <div class="w-12 sm:w-24 h-1 bg-gray-300 mx-2"></div>

                <!-- Step 3: Fill Form -->
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-semibold">
                        3
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
                    <div class="mb-6 p-4 bg-red-100 border border-red-200 text-red-700 rounded-lg">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('request.select.store') }}" id="documentSelectForm">
                    @csrf

                    <div class="space-y-6">
                        @foreach($groupedDocuments as $categoryName => $categoryDocs)
                            <div>
                                <div class="flex items-center gap-3 mb-4">
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
                                    <h3 class="text-lg font-bold text-gray-900">{{ $categoryName ?? 'Other' }} Documents</h3>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach($categoryDocs as $document)
                                        <label class="relative cursor-pointer">
                                            <input
                                                type="radio"
                                                name="document_type_id"
                                                value="{{ $document->id }}"
                                                class="peer sr-only"
                                                required
                                            >
                                            <div class="border-2 border-gray-200 rounded-lg p-4 transition-all
                                                @if($categoryName === 'Official')
                                                    hover:border-bnhs-blue-300 hover:bg-bnhs-blue-50 peer-checked:border-bnhs-blue-500 peer-checked:bg-bnhs-blue-50 peer-checked:ring-2 peer-checked:ring-bnhs-blue-200
                                                @elseif($categoryName === 'Informal')
                                                    hover:border-bnhs-gold-300 hover:bg-bnhs-gold-50 peer-checked:border-bnhs-gold-500 peer-checked:bg-bnhs-gold-50 peer-checked:ring-2 peer-checked:ring-bnhs-gold-200
                                                @elseif($categoryName === 'Certified')
                                                    hover:border-green-300 hover:bg-green-50 peer-checked:border-green-500 peer-checked:bg-green-50 peer-checked:ring-2 peer-checked:ring-green-200
                                                @else
                                                    hover:border-bnhs-blue-300 hover:bg-bnhs-blue-50 peer-checked:border-bnhs-blue-500 peer-checked:bg-bnhs-blue-50 peer-checked:ring-2 peer-checked:ring-bnhs-blue-200
                                                @endif
                                            ">
                                                <div class="flex items-start gap-3">
                                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5
                                                        @if($categoryName === 'Official')
                                                            bg-bnhs-blue-100
                                                        @elseif($categoryName === 'Informal')
                                                            bg-bnhs-gold-100
                                                        @elseif($categoryName === 'Certified')
                                                            bg-green-100
                                                        @else
                                                            bg-gray-100
                                                        @endif
                                                    ">
                                                        <svg class="w-5 h-5
                                                            @if($categoryName === 'Official')
                                                                text-bnhs-blue
                                                            @elseif($categoryName === 'Informal')
                                                                text-bnhs-gold-700
                                                            @elseif($categoryName === 'Certified')
                                                                text-green-600
                                                            @else
                                                                text-gray-600
                                                            @endif
                                                        " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                        </svg>
                                                    </div>
                                                    <div class="flex-1">
                                                        <h4 class="font-semibold text-gray-900 mb-1">{{ $document->name }}</h4>
                                                        @if($document->processing_days)
                                                            <p class="text-xs text-gray-500">
                                                                Processing: {{ $document->processing_days }} {{ $document->processing_days == 1 ? 'day' : 'days' }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <div class="w-5 h-5 border-2 rounded-full flex items-center justify-center transition
                                                            @if($categoryName === 'Official')
                                                                border-gray-300 peer-checked:border-bnhs-blue-500 peer-checked:bg-bnhs-blue-500
                                                            @elseif($categoryName === 'Informal')
                                                                border-gray-300 peer-checked:border-bnhs-gold-500 peer-checked:bg-bnhs-gold-500
                                                            @elseif($categoryName === 'Certified')
                                                                border-gray-300 peer-checked:border-green-500 peer-checked:bg-green-500
                                                            @else
                                                                border-gray-300 peer-checked:border-bnhs-blue-500 peer-checked:bg-bnhs-blue-500
                                                            @endif
                                                        ">
                                                            <div class="w-2 h-2 bg-white rounded-full hidden peer-checked:block"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Continue Button -->
                    <div class="mt-8 flex justify-end">
                        <button type="submit" class="inline-flex items-center gap-2 px-8 py-3 bg-bnhs-blue text-white rounded-lg hover:bg-bnhs-blue-600 transition font-semibold shadow-lg">
                            Continue
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </form>

                <div class="mt-6 text-center">
                    <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-bnhs-blue transition inline-flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
