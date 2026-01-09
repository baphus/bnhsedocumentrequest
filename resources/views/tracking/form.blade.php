@extends('layouts.public')

@section('content')
<div class="py-12">
    <div class="max-w-md mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                    Track Your Request
                </h2>

                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    Enter your tracking ID to view the status of your document request.
                </p>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('tracking.track') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="tracking_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Tracking ID
                        </label>
                        <input 
                            type="text" 
                            id="tracking_id" 
                            name="tracking_id" 
                            value="{{ old('tracking_id') }}"
                            required 
                            placeholder="DOC-XXXXXX"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white uppercase"
                        >
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                        Track Request
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <a href="{{ route('home') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        ← Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
