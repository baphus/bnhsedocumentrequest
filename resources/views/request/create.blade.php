@extends('layouts.public')

@section('content')
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
        <div class="mb-6 flex justify-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-100 border border-green-200 text-green-800 rounded-full text-sm font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                Email Verified
            </div>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-xl shadow-xl overflow-hidden">
            <div class="bg-bnhs-blue px-6 py-4">
                <h2 class="text-2xl font-bold text-white">
                    Document Request Form
                </h2>
                <p class="text-bnhs-blue-100 text-sm mt-1">Complete all required fields to submit your request</p>
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

                <form method="POST" action="{{ route('request.store') }}" id="requestForm">
                    @csrf

                    <!-- Personal Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Personal Information</h3>
                        <div class="grid md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    First Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="first_name" value="{{ old('first_name') }}" required
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Middle Name
                                </label>
                                <input type="text" name="middle_name" value="{{ old('middle_name') }}"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Last Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="last_name" value="{{ old('last_name') }}" required
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Contact Number <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="contact_number" value="{{ old('contact_number') }}" required
                                placeholder="e.g., 09123456789"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                        </div>
                    </div>

                    <!-- Student Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Student Information</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    LRN (12 digits) <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="lrn" value="{{ old('lrn') }}" required maxlength="12" pattern="[0-9]{12}"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Grade Level <span class="text-red-500">*</span>
                                </label>
                                <select name="grade_level" required
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                                    <option value="">Select Grade Level</option>
                                    <option value="Grade 7" {{ old('grade_level') == 'Grade 7' ? 'selected' : '' }}>Grade 7</option>
                                    <option value="Grade 8" {{ old('grade_level') == 'Grade 8' ? 'selected' : '' }}>Grade 8</option>
                                    <option value="Grade 9" {{ old('grade_level') == 'Grade 9' ? 'selected' : '' }}>Grade 9</option>
                                    <option value="Grade 10" {{ old('grade_level') == 'Grade 10' ? 'selected' : '' }}>Grade 10</option>
                                    <option value="Grade 11" {{ old('grade_level') == 'Grade 11' ? 'selected' : '' }}>Grade 11</option>
                                    <option value="Grade 12" {{ old('grade_level') == 'Grade 12' ? 'selected' : '' }}>Grade 12</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Section
                                </label>
                                <input type="text" name="section" value="{{ old('section') }}"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Track/Strand <span class="text-red-500">*</span>
                                </label>
                                <select name="track_strand" required
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                                    <option value="">Select Track/Strand</option>
                                    @foreach($tracks as $track)
                                    <option value="{{ $track->code }}" {{ old('track_strand') == $track->code ? 'selected' : '' }}>
                                        {{ $track->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    School Year Last Attended <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="school_year_last_attended" value="{{ old('school_year_last_attended') }}"
                                    required placeholder="e.g., 2023-2024"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Class Adviser
                                </label>
                                <input type="text" name="advisor" value="{{ old('advisor') }}"
                                    placeholder="e.g., Mr. Juan Dela Cruz"
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">Additional Information</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Document Type <span class="text-red-500">*</span>
                                </label>
                                <select name="document_type_id" required
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                                    <option value="">Select Document</option>
                                    @foreach($documents as $document)
                                    <option value="{{ $document->id }}" {{ (old('document_type_id', $selectedDocumentId ?? null) == $document->id) ? 'selected' : '' }}>
                                        {{ $document->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Quantity <span class="text-red-500">*</span>
                                </label>
                                <select name="quantity" required
                                    class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition text-sm font-bold text-bnhs-blue">
                                    @for($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ old('quantity', 1) == $i ? 'selected' : '' }}>{{ $i }} {{ $i > 1 ? 'Copies' : 'Copy' }}</option>
                                        @endfor
                                </select>
                            </div>
                            <div class="md:col-span-2" x-data="{ 
                                showOther: {{ old('purpose') && !in_array(old('purpose'), ['Enrollment', 'Scholarship', 'Job Application', 'PRC/Board Exam', 'Passport/Travel', 'Transfer to Another School']) ? 'true' : 'false' }},
                                presetPurposes: ['Enrollment', 'Scholarship', 'Job Application', 'PRC/Board Exam', 'Passport/Travel', 'Transfer to Another School']
                            }">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Purpose of Request <span class="text-red-500">*</span>
                                </label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-2">
                                    <template x-for="purpose in presetPurposes" :key="purpose">
                                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 transition border-gray-200">
                                            <input type="radio" name="purpose_preset" :value="purpose" @change="showOther = false; $refs.purposeText.value = purpose"
                                                :checked="!showOther && $refs.purposeText.value === purpose" class="text-bnhs-blue focus:ring-bnhs-blue">
                                            <span class="ml-2 text-sm text-gray-700" x-text="purpose"></span>
                                        </label>
                                    </template>
                                    <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 transition border-gray-200" :class="showOther ? 'border-bnhs-blue bg-blue-50' : ''">
                                        <input type="radio" name="purpose_preset" value="other" :checked="showOther" @change="showOther = true; $refs.purposeText.value = ''; $nextTick(() => $refs.purposeText.focus())" class="text-bnhs-blue focus:ring-bnhs-blue">
                                        <span class="ml-2 text-sm text-gray-700">Other</span>
                                    </label>
                                </div>
                                <div x-show="showOther" x-transition class="mt-3">
                                    <input type="text" name="purpose" x-ref="purposeText" value="{{ old('purpose') }}"
                                        placeholder="Please specify your purpose..."
                                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bnhs-blue focus:border-bnhs-blue transition">
                                </div>
                                <input type="hidden" name="purpose" x-ref="purposeText" value="{{ old('purpose') }}" x-show="!showOther">
                            </div>
                        </div>
                    </div>

                    <!-- Digital Signature -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 pb-2 border-b border-gray-200">
                            Digital Signature <span class="text-red-500">*</span>
                        </h3>
                        <p class="text-sm text-gray-600 mb-4">Draw your signature in the box below using your mouse or touchscreen</p>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 bg-gray-50">
                            <canvas id="signatureCanvas" width="600" height="200" class="border border-gray-300 rounded bg-white cursor-crosshair w-full"></canvas>
                            <input type="hidden" name="signature" id="signatureInput" required>
                            <div class="flex justify-between items-center mt-3">
                                <p class="text-xs text-gray-500">Sign above</p>
                                <button type="button" onclick="clearSignature()" class="inline-flex items-center gap-1 text-sm text-red-600 hover:text-red-800 font-medium transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Clear Signature
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('home') }}" class="sm:order-1 text-center text-gray-600 hover:text-bnhs-blue transition py-3 px-6 font-medium">
                            Start Over
                        </a>
                        <button type="submit" class="sm:order-2 sm:flex-1 bg-bnhs-blue text-white py-3 px-6 rounded-lg hover:bg-bnhs-blue-600 transition font-semibold shadow-lg">
                            Submit Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    const canvas = document.getElementById('signatureCanvas');
    const ctx = canvas.getContext('2d');
    let isDrawing = false;

    function resizeCanvas() {
        const ratio = window.devicePixelRatio || 1;
        const tempData = canvas.toDataURL();
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = 200 * ratio;
        ctx.scale(ratio, ratio);

        ctx.strokeStyle = '#0038a8';
        ctx.lineWidth = 2;
        ctx.lineCap = 'round';
        ctx.lineJoin = 'round';

        const image = new Image();
        image.src = tempData;
        image.onload = () => {
            ctx.drawImage(image, 0, 0, canvas.offsetWidth, 200);
        };
    }

    window.addEventListener('resize', resizeCanvas);
    resizeCanvas();

    canvas.addEventListener('mousedown', startDrawing);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', stopDrawing);
    canvas.addEventListener('mouseout', stopDrawing);

    // Touch events
    canvas.addEventListener('touchstart', (e) => {
        if (e.cancelable) e.preventDefault();
        const touch = e.touches[0];
        const mouseEvent = new MouseEvent('mousedown', {
            clientX: touch.clientX,
            clientY: touch.clientY
        });
        canvas.dispatchEvent(mouseEvent);
    });

    canvas.addEventListener('touchmove', (e) => {
        if (e.cancelable) e.preventDefault();
        const touch = e.touches[0];
        const mouseEvent = new MouseEvent('mousemove', {
            clientX: touch.clientX,
            clientY: touch.clientY
        });
        canvas.dispatchEvent(mouseEvent);
    });

    canvas.addEventListener('touchend', (e) => {
        const mouseEvent = new MouseEvent('mouseup', {});
        canvas.dispatchEvent(mouseEvent);
    });

    function startDrawing(e) {
        isDrawing = true;
        const rect = canvas.getBoundingClientRect();
        ctx.strokeStyle = '#0038a8';
        ctx.lineWidth = 2;
        ctx.lineCap = 'round';
        ctx.lineJoin = 'round';
        ctx.beginPath();
        ctx.moveTo(e.clientX - rect.left, e.clientY - rect.top);
    }

    function draw(e) {
        if (!isDrawing) return;
        const rect = canvas.getBoundingClientRect();
        ctx.lineTo(e.clientX - rect.left, e.clientY - rect.top);
        ctx.stroke();
    }

    function stopDrawing() {
        if (!isDrawing) return;
        isDrawing = false;
        // Save signature as base64
        document.getElementById('signatureInput').value = canvas.toDataURL();
    }

    function clearSignature() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        document.getElementById('signatureInput').value = '';
    }

    // Validate signature before submit
    document.getElementById('requestForm').addEventListener('submit', function(e) {
        if (!document.getElementById('signatureInput').value) {
            e.preventDefault();
            alert('Please provide your digital signature.');
        }
    });
</script>
@endsection