<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl w-full">
        <!-- Progress Steps -->
        <div class="mb-8">
            <div class="flex items-center justify-center">
                <!-- Step 1: Select Document -->
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span class="ml-2 text-sm font-medium text-gray-700 hidden sm:block">Select Document</span>
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>

            <h2 class="text-2xl font-bold text-gray-900 text-center mb-3">
                Enter Verification Code
            </h2>

            <p class="text-gray-600 text-center mb-2">
                We've sent a 6-digit code to:
            </p>
            <p class="text-bnhs-blue font-semibold text-center mb-8">
                {{ $email }}
            </p>

            <form wire:submit="verify">
                <input type="hidden" wire:model="purpose">

                <div class="mb-6">
                    <x-input-label for="code" value="Verification Code" class="text-center block mb-3" />
                    <x-text-input 
                        wire:model.blur="code" 
                        type="text" 
                        maxlength="6"
                        pattern="[0-9]{6}"
                        class="mt-1 block w-full text-3xl text-center tracking-[0.5em] font-mono font-bold border-2"
                        placeholder="000000"
                        autofocus
                        required
                    />
                    <x-input-error :messages="$errors->get('code')" class="mt-2" />
                    <p class="mt-3 text-sm text-gray-500 text-center">
                        Enter the 6-digit code from your email
                    </p>
                </div>

                <x-button type="submit" variant="primary" size="lg" class="w-full">
                    Verify & Continue
                </x-button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-sm text-gray-600 mb-3">
                    Didn't receive the code?
                </p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center items-center">
                    <x-button variant="outline" size="sm" wire:click="resend" wire:loading.attr="disabled" wire:target="resend">
                        <span wire:loading.remove wire:target="resend" class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Resend Code
                        </span>
                        <span wire:loading wire:target="resend" class="flex items-center">
                            <svg class="animate-spin h-4 w-4 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Sending...
                        </span>
                    </x-button>
                    <span class="text-gray-400 hidden sm:block">|</span>
                    <a href="{{ route('otp.request', ['purpose' => $purpose]) }}" wire:navigate class="text-sm text-gray-600 hover:text-bnhs-blue transition">
                        Change Email
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
