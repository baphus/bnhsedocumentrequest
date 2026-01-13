<div x-data="{ reportModal: false }">
    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
                <!-- Brand Section -->
                <div class="col-span-1 md:col-span-2 space-y-6">
                    <div class="flex items-center gap-4">
                        <img src="https://res.cloudinary.com/dc3cbupaq/image/upload/v1768134861/Untitled_design_7_z0gxhq.png" alt="BNHS Logo" class="h-14 w-auto" />
                        <div>
                            <p class="text-xl font-bold text-gray-900 tracking-tight leading-none">Bato National High School</p>
                            <p class="text-sm font-medium text-gray-500 mt-1">DepEd Toledo City Division • Region 7</p>
                        </div>
                    </div>
                    <p class="text-gray-500 text-sm leading-relaxed max-w-sm">
                        The official eDocument Request System facilitates secure and efficient processing of school records for students, alumni, and faculty.
                    </p>
                </div>

                <!-- Contact Info -->
                <div class="col-span-1">
                    <h3 class="text-sm font-bold text-gray-900 tracking-wider uppercase mb-5">Contact Us</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-bnhs-blue flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="text-sm text-gray-600">303308@deped.gov.ph</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-bnhs-blue flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span class="text-sm text-gray-600">(032) 123-4567</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-bnhs-blue flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-sm text-gray-600">Bato, Toledo City, Cebu</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-bnhs-blue flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-sm text-gray-600">Mon-Fri: 7:30AM - 5:00PM</span>
                        </li>
                    </ul>
                </div>

                <!-- Quick Links -->
                <div class="col-span-1">
                    <h3 class="text-sm font-bold text-gray-900 tracking-wider uppercase mb-5">Help & Support</h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="{{ route('home') }}" wire:navigate class="text-sm text-gray-600 hover:text-bnhs-blue transition flex items-center gap-2 group">
                                <span class="group-hover:translate-x-1 transition-transform">Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('tracking.form') }}" wire:navigate class="text-sm text-gray-600 hover:text-bnhs-blue transition flex items-center gap-2 group">
                                <span class="group-hover:translate-x-1 transition-transform">Track Request</span>
                            </a>
                        </li>
                        <li>
                            <button @click="reportModal = true" class="text-sm text-gray-600 hover:text-bnhs-blue transition flex items-center gap-2 group">
                                <span class="group-hover:translate-x-1 transition-transform">Report a Problem</span>
                            </button>
                        </li>
                        <li>
                            <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-bnhs-blue transition flex items-center gap-2 group">
                                <span class="group-hover:translate-x-1 transition-transform">Login</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="mt-16 pt-8 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-sm text-gray-500">
                    &copy; {{ date('Y') }} Bato National High School. All rights reserved.
                </p>
                <div class="flex items-center gap-6">
                     <!-- Space for Social Icons or Terms in future -->
                </div>
            </div>
        </div>
    </footer>

    <!-- Report Problem Modal -->
    <div x-show="reportModal" x-cloak
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
</div>