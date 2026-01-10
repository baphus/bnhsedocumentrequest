<div x-data="{ reportModal: false, contactModal: false, faqModal: false, openFaq: null }">
    <!-- Footer -->
    <footer class="border-t border-gray-200 bg-white py-8 mt-auto">
        <div class="w-full px-6 sm:px-10 lg:px-16 text-center md:text-left">
            <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                <!-- Logo & Info -->
                <div class="flex items-center gap-4">
                    @if(file_exists(public_path('images/logo.png')))
                    <img src="{{ asset('images/logo.png') }}" alt="BNHS Logo" class="h-16 w-auto" />
                    @else
                    <div class="w-12 h-12 bg-bnhs-blue rounded-xl flex items-center justify-center text-white shadow-lg">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    @endif
                    <div>
                        <p class="text-lg font-extrabold text-gray-900 tracking-tight">Bato National High School</p>
                        <p class="text-sm font-medium text-gray-500">DepEd Toledo City Division • Region 7</p>
                    </div>
                </div>

                <!-- Copyright & Support Links -->
                <div class="md:text-right space-y-3">
                    <p class="text-sm font-medium text-gray-600">
                        &copy; {{ date('Y') }} Bato National High School. All rights reserved.
                    </p>
                    <div class="flex flex-wrap justify-center md:justify-end gap-x-4 gap-y-2 text-xs font-semibold text-bnhs-blue">
                        <button @click="reportModal = true" class="hover:underline transition decoration-2 underline-offset-4">Report a Problem</button>
                        <span class="text-gray-300">•</span>
                        <button @click="contactModal = true" class="hover:underline transition decoration-2 underline-offset-4">Contact Information</button>
                        <span class="text-gray-300">•</span>
                        <button @click="faqModal = true" class="hover:underline transition decoration-2 underline-offset-4">FAQs</button>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Report Problem Modal -->
    <div x-show="reportModal"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-900/70 z-[100] flex items-center justify-center p-4">

        <div @click.away="reportModal = false" class="bg-white rounded-2xl shadow-2xl max-w-md w-full overflow-hidden transform transition-all">
            <div class="bg-bnhs-blue px-6 py-4 flex items-center justify-between">
                <h3 class="text-lg font-bold text-white">Report a Problem</h3>
                <button @click="reportModal = false" class="text-white/80 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-6">
                <form action="#" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Email Address</label>
                        <input type="email" name="email" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue outline-none transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Description of Issue</label>
                        <textarea name="description" rows="4" required class="w-full px-4 py-2 border border-gray-200 rounded-xl focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue outline-none transition" placeholder="Tell us what went wrong..."></textarea>
                    </div>
                    <div class="flex gap-3 pt-2">
                        <button type="submit" class="flex-1 bg-bnhs-blue text-white py-3 rounded-xl hover:bg-bnhs-blue-600 font-bold transition shadow-lg shadow-bnhs-blue/20">
                            Send Report
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Contact Information Modal -->
    <div x-show="contactModal"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-900/70 z-[100] flex items-center justify-center p-4">

        <div @click.away="contactModal = false" class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full overflow-hidden transform transition-all">
            <div class="bg-bnhs-blue px-6 py-4 flex items-center justify-between">
                <h3 class="text-lg font-bold text-white">Contact Us</h3>
                <button @click="contactModal = false" class="text-white/80 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Info Items -->
                <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-2xl">
                    <div class="w-10 h-10 bg-bnhs-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-bnhs-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Email</h4>
                        <p class="text-sm font-semibold text-gray-900">bnhs@deped.gov.ph</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-2xl">
                    <div class="w-10 h-10 bg-bnhs-gold-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-bnhs-gold-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Phone</h4>
                        <p class="text-sm font-semibold text-gray-900">(032) 123-4567</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-2xl">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Office Hours</h4>
                        <p class="text-sm font-semibold text-gray-900">Mon-Fri: 7:30AM - 5:00PM</p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-2xl">
                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Location</h4>
                        <p class="text-sm font-semibold text-gray-900">Bato, Toledo City, Cebu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQs Modal -->
    <div x-show="faqModal"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-900/70 z-[100] flex items-center justify-center p-4">

        <div @click.away="faqModal = false" class="bg-white rounded-2xl shadow-2xl max-w-3xl w-full overflow-hidden transform transition-all max-h-[90vh] flex flex-col">
            <div class="bg-bnhs-blue px-6 py-4 flex items-center justify-between">
                <h3 class="text-lg font-bold text-white">Frequently Asked Questions</h3>
                <button @click="faqModal = false" class="text-white/80 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="p-6 overflow-y-auto space-y-4">
                <div class="border border-gray-100 rounded-2xl overflow-hidden">
                    <button @click="openFaq = openFaq === 1 ? null : 1" class="w-full flex items-center justify-between p-4 text-left bg-gray-50 hover:bg-gray-100 transition">
                        <span class="font-bold text-gray-900">How long does it take to process my request?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': openFaq === 1 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openFaq === 1" x-collapse>
                        <div class="p-4 text-sm text-gray-600 bg-white">
                            Processing time varies by document. Most are ready within 3-5 business days. You will receive an email notification when it is ready.
                        </div>
                    </div>
                </div>

                <div class="border border-gray-100 rounded-2xl overflow-hidden">
                    <button @click="openFaq = openFaq === 2 ? null : 2" class="w-full flex items-center justify-between p-4 text-left bg-gray-50 hover:bg-gray-100 transition">
                        <span class="font-bold text-gray-900">Do I need to create an account?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': openFaq === 2 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openFaq === 2" x-collapse>
                        <div class="p-4 text-sm text-gray-600 bg-white">
                            No account required. Every request is verified via a One-Time Password (OTP) sent to your email address.
                        </div>
                    </div>
                </div>

                <div class="border border-gray-100 rounded-2xl overflow-hidden">
                    <button @click="openFaq = openFaq === 3 ? null : 3" class="w-full flex items-center justify-between p-4 text-left bg-gray-50 hover:bg-gray-100 transition">
                        <span class="font-bold text-gray-900">How do I track my request?</span>
                        <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': openFaq === 3 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openFaq === 3" x-collapse>
                        <div class="p-4 text-sm text-gray-600 bg-white">
                            After submission, you'll receive a Tracking ID. Enter this ID and your email on our "Track Request" page to see real-time status.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>