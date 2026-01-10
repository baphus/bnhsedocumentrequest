<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl w-full">
        <!-- Progress Steps -->
        <div class="mb-8">
            <div class="flex items-center justify-center">
                <!-- Step 1: Select Document -->
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-bnhs-blue-100 border-2 border-bnhs-blue text-bnhs-blue flex items-center justify-center font-semibold">
                        1
                    </div>
                    <span class="ml-2 text-sm font-medium text-bnhs-blue hidden sm:block">Select Document</span>
                </div>
                
                <div class="w-12 sm:w-24 h-1 bg-bnhs-blue mx-2"></div>
                
                <!-- Step 2: Verify Email (Current) -->
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-bnhs-blue text-white flex items-center justify-center font-semibold">
                        2
                    </div>
                    <span class="ml-2 text-sm font-medium text-bnhs-blue hidden sm:block">Verify Email</span>
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
        <div class="bg-white rounded-xl shadow-xl p-8">
            <!-- Icon -->
            <div class="w-16 h-16 bg-bnhs-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-bnhs-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 text-center mb-3">
                Verify Your Email
            </h2>

            <p class="text-gray-600 text-center mb-8">
                We'll send a 6-digit verification code to your email address to secure your request
            </p>

            <form wire:submit="send">
                <input type="hidden" wire:model="purpose">

                <div class="mb-6">
                    <x-input-label for="email" value="Email Address *" />
                    <x-text-input 
                        wire:model.blur="email" 
                        type="email" 
                        class="mt-1 block w-full" 
                        placeholder="your.email@example.com"
                        required
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    <p class="mt-2 text-sm text-gray-500">
                        We'll send updates about your request to this email
                    </p>
                </div>

                <x-button type="submit" variant="primary" size="lg" class="w-full">
                    Send Verification Code
                </x-button>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" wire:navigate class="text-sm text-gray-600 hover:text-bnhs-blue transition inline-flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Home
                </a>
            </div>
        </div>
    </div>
</div>
