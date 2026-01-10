<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
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

                <div class="w-12 sm:w-24 h-1 bg-green-500 mx-2"></div>

                <!-- Step 2: Verify Email -->
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span class="ml-2 text-sm font-medium text-gray-700 hidden sm:block">Verify Email</span>
                </div>

                <div class="w-12 sm:w-24 h-1 bg-bnhs-blue mx-2"></div>

                <!-- Step 3: Fill Form (Current) -->
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-bnhs-blue text-white flex items-center justify-center font-semibold">
                        3
                    </div>
                    <span class="ml-2 text-sm font-medium text-bnhs-blue hidden sm:block">Fill Form</span>
                </div>
            </div>
        </div>

        <!-- Email Verified Badge -->
        @if($emailVerified)
        <div class="mb-6 flex justify-center">
            <x-alert type="success" class="inline-flex items-center gap-2 px-4 py-2 rounded-full">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                Email Verified
            </x-alert>
        </div>
        @endif

        <!-- Main Card -->
        <div class="bg-white rounded-xl shadow-xl overflow-hidden">
            <div class="bg-bnhs-blue px-6 py-4">
                <h2 class="text-2xl font-bold text-white">
                    Document Request Form
                </h2>
                <p class="text-bnhs-blue-100 text-sm mt-1">Complete all required fields to submit your request</p>
            </div>

            <div class="p-6 sm:p-8">
                <form wire:submit="save" id="requestForm">
                    <!-- Personal Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Personal Information</h3>
                        <div class="grid md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <x-input-label for="form.first_name" value="First Name *" />
                                <x-text-input wire:model.blur="form.first_name" class="mt-1 block w-full" required />
                                <x-input-error :messages="$errors->get('form.first_name')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="form.middle_name" value="Middle Name" />
                                <x-text-input wire:model.blur="form.middle_name" class="mt-1 block w-full" />
                                <x-input-error :messages="$errors->get('form.middle_name')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="form.last_name" value="Last Name *" />
                                <x-text-input wire:model.blur="form.last_name" class="mt-1 block w-full" required />
                                <x-input-error :messages="$errors->get('form.last_name')" class="mt-2" />
                            </div>
                        </div>
                        <div>
                            <x-input-label for="form.contact_number" value="Contact Number *" />
                            <x-text-input wire:model.blur="form.contact_number" class="mt-1 block w-full" placeholder="e.g., 09123456789" required />
                            <x-input-error :messages="$errors->get('form.contact_number')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Student Information -->
                    <div class="mb-8" x-data="{ gradeLevel: @entangle('form.grade_level') }">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Student Information</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="form.lrn" value="LRN (12 digits) *" />
                                <x-text-input wire:model.blur="form.lrn" class="mt-1 block w-full" maxlength="12" placeholder="12-digit student number" required />
                                <x-input-error :messages="$errors->get('form.lrn')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="form.grade_level" value="Grade Level *" />
                                <select wire:model.live="form.grade_level" x-model="gradeLevel" class="mt-1 block w-full border-gray-300 rounded-lg focus:ring-bnhs-blue focus:border-bnhs-blue" required>
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
                            <div>
                                <x-input-label for="form.section" value="Section" />
                                <x-text-input wire:model.blur="form.section" class="mt-1 block w-full" placeholder="e.g., Diamond, Newton" />
                                <x-input-error :messages="$errors->get('form.section')" class="mt-2" />
                            </div>

                            <!-- Track/Strand - Only for SHS -->
                            <div x-show="gradeLevel === 'Grade 11' || gradeLevel === 'Grade 12'"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform -translate-y-2"
                                x-transition:enter-end="opacity-100 transform translate-y-0">
                                <x-input-label for="form.track_strand" value="Track/Strand *" />
                                <select wire:model.blur="form.track_strand" class="mt-1 block w-full border-gray-300 rounded-lg focus:ring-bnhs-blue focus:border-bnhs-blue">
                                    <option value="">Select Track/Strand</option>
                                    @foreach($this->tracks as $track)
                                    <option value="{{ $track->code }}">{{ $track->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('form.track_strand')" class="mt-2" />
                            </div>

                            <div :class="gradeLevel === 'Grade 11' || gradeLevel === 'Grade 12' ? 'md:col-span-2' : 'md:col-span-1'">
                                <x-input-label for="form.school_year_last_attended" value="School Year Last Attended *" />
                                <x-text-input wire:model.blur="form.school_year_last_attended" class="mt-1 block w-full" placeholder="e.g., 2023-2024" required />
                                <x-input-error :messages="$errors->get('form.school_year_last_attended')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Selected Document Summary -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Request Details</h3>
                        <div class="bg-gray-50 rounded-lg p-5 border border-gray-200 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-bnhs-blue rounded-lg flex items-center justify-center text-white">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-900">{{ $this->selectedDocument?->name }}</p>
                                    <p class="text-xs text-gray-500">Document Type</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <select wire:model.live="form.quantity" class="block w-full border-gray-300 rounded-lg focus:ring-bnhs-blue focus:border-bnhs-blue text-sm font-bold text-bnhs-blue py-1 pl-3 pr-8">
                                    @for($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}">{{ $i }} {{ $i > 1 ? 'Copies' : 'Copy' }}</option>
                                        @endfor
                                </select>
                                <p class="text-xs text-gray-500 mt-1">Quantity</p>
                            </div>
                        </div>
                        <div class="mt-4" x-data="{ 
                            selectedPurpose: @entangle('form.purpose'),
                            presetPurposes: ['Enrollment', 'Scholarship', 'Job Application', 'PRC/Board Exam', 'Passport/Travel', 'Transfer to Another School'],
                            showOther: false,
                            init() {
                                if (this.selectedPurpose && !this.presetPurposes.includes(this.selectedPurpose)) {
                                    this.showOther = true;
                                }
                            },
                            selectPreset(p) {
                                this.showOther = false;
                                this.selectedPurpose = p;
                            },
                            selectOther() {
                                this.showOther = true;
                                this.selectedPurpose = '';
                                this.$nextTick(() => {
                                    this.$refs.otherInput.focus();
                                });
                            }
                        }">
                            <x-input-label value="Purpose of Request *" />
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-2">
                                <template x-for="purpose in presetPurposes" :key="purpose">
                                    <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 transition border-gray-200" :class="selectedPurpose === purpose && !showOther ? 'border-bnhs-blue bg-blue-50' : ''">
                                        <input type="radio" name="purpose_preset" :value="purpose" :checked="selectedPurpose === purpose && !showOther" @change="selectPreset(purpose)" class="text-bnhs-blue focus:ring-bnhs-blue">
                                        <span class="ml-2 text-sm text-gray-700" x-text="purpose"></span>
                                    </label>
                                </template>
                                <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 transition border-gray-200" :class="showOther ? 'border-bnhs-blue bg-blue-50' : ''">
                                    <input type="radio" name="purpose_preset" value="other" :checked="showOther" @change="selectOther()" class="text-bnhs-blue focus:ring-bnhs-blue">
                                    <span class="ml-2 text-sm text-gray-700">Other</span>
                                </label>
                            </div>

                            <div x-show="showOther" x-transition class="mt-3">
                                <x-text-input x-model="selectedPurpose" x-ref="otherInput" class="mt-1 block w-full" placeholder="Please specify your purpose..." />
                                <p class="text-xs text-gray-500 mt-1">Type your specific reason for document request</p>
                            </div>
                            <x-input-error :messages="$errors->get('form.purpose')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Digital Signature -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">
                            Digital Signature <span class="text-red-500">*</span>
                        </h3>
                        <div
                            x-data="signaturePad(@entangle('form.signature'))"
                            wire:ignore
                            class="space-y-4">
                            <div class="bg-white border-2 border-gray-200 rounded-xl overflow-hidden shadow-inner">
                                <canvas
                                    x-ref="canvas"
                                    class="w-full h-48 cursor-crosshair touch-none"
                                    @mousedown="startDrawing"
                                    @mousemove="draw"
                                    @mouseup="stopDrawing"
                                    @mouseleave="stopDrawing"
                                    @touchstart="startDrawing"
                                    @touchmove="draw"
                                    @touchend="stopDrawing"></canvas>
                            </div>

                            <div class="flex items-center justify-between">
                                <p class="text-xs text-gray-500 italic">Please sign within the box above</p>
                                <button
                                    type="button"
                                    @click="clear"
                                    class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-bnhs-blue transition">
                                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Clear Signature
                                </button>
                            </div>

                            <x-input-error :messages="$errors->get('form.signature')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <x-button type="submit" variant="primary" size="lg" class="sm:flex-1 h-14 text-lg">
                            Submit Request
                        </x-button>
                        <a href="{{ route('request.select') }}" wire:navigate class="text-center text-gray-500 hover:text-gray-700 transition py-3 px-6 font-medium">
                            Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function signaturePad(signatureValue) {
        return {
            signature: signatureValue,
            isDrawing: false,
            canvas: null,
            ctx: null,

            init() {
                this.canvas = this.$refs.canvas;
                this.ctx = this.canvas.getContext('2d');

                // Ensure canvas is ready
                setTimeout(() => {
                    this.resizeCanvas(false);
                    // Restore signature if it exists
                    if (this.signature) {
                        this.restoreSignature();
                    }
                }, 100);

                // Handle window resize
                window.addEventListener('resize', () => {
                    this.resizeCanvas(true);
                });

                // Listen for Livewire event to clear
                window.addEventListener('signature-cleared', () => this.clear(false));
            },

            restoreSignature() {
                if (!this.signature) return;
                const image = new Image();
                image.src = this.signature;
                image.onload = () => {
                    this.ctx.drawImage(image, 0, 0, this.canvas.offsetWidth, this.canvas.offsetHeight);
                };
            },

            resizeCanvas(preserveData = false) {
                if (!this.canvas) return;

                const ratio = window.devicePixelRatio || 1;
                const tempData = preserveData ? this.canvas.toDataURL() : null;

                // Adjust size
                this.canvas.width = this.canvas.offsetWidth * ratio;
                this.canvas.height = this.canvas.offsetHeight * ratio;
                this.ctx.scale(ratio, ratio);

                // Reset context state since it resets on resize
                this.ctx.strokeStyle = '#0038a8';
                this.ctx.lineWidth = 2;
                this.ctx.lineJoin = 'round';
                this.ctx.lineCap = 'round';

                if (tempData && preserveData) {
                    const image = new Image();
                    image.src = tempData;
                    image.onload = () => {
                        this.ctx.drawImage(image, 0, 0, this.canvas.offsetWidth, this.canvas.offsetHeight);
                    };
                }
            },

            getMousePos(e) {
                const rect = this.canvas.getBoundingClientRect();
                const clientX = e.touches ? e.touches[0].clientX : e.clientX;
                const clientY = e.touches ? e.touches[0].clientY : e.clientY;

                return {
                    x: clientX - rect.left,
                    y: clientY - rect.top
                };
            },

            startDrawing(e) {
                this.isDrawing = true;
                this.ctx.strokeStyle = '#0038a8';
                this.ctx.lineWidth = 2;
                this.ctx.lineJoin = 'round';
                this.ctx.lineCap = 'round';

                const pos = this.getMousePos(e);
                this.ctx.beginPath();
                this.ctx.moveTo(pos.x, pos.y);
            },

            draw(e) {
                if (!this.isDrawing) return;
                if (e.cancelable) e.preventDefault();
                const pos = this.getMousePos(e);
                this.ctx.lineTo(pos.x, pos.y);
                this.ctx.stroke();
            },

            stopDrawing() {
                if (!this.isDrawing) return;
                this.isDrawing = false;

                // Check if canvas is empty before saving
                if (!this.isCanvasEmpty()) {
                    this.signature = this.canvas.toDataURL();
                }
            },

            isCanvasEmpty() {
                const blank = document.createElement('canvas');
                blank.width = this.canvas.width;
                blank.height = this.canvas.height;
                return this.canvas.toDataURL() === blank.toDataURL();
            },

            clear(updateLivewire = true) {
                this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
                if (updateLivewire) {
                    this.signature = '';
                }
            }
        }
    }
</script>