<?php

namespace App\Http\Controllers;

use App\Models\Request;
use App\Models\Document;
use App\Models\Track;
use App\Mail\RequestConfirmation;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class RequestController extends Controller
{
    /**
     * Show the multi-step request form
     */
    public function create()
    {
        $documents = Document::active()->orderBy('name')->get();
        $tracks = Track::active()->orderBy('category')->orderBy('name')->get();
        
        return view('request.create', compact('documents', 'tracks'));
    }

    /**
     * Store the request
     */
    public function store(HttpRequest $request)
    {
        $validated = $request->validate([
            'contact_number' => 'required|string|max:20',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'lrn' => 'required|string|size:12',
            'grade_level' => 'required|string',
            'section' => 'nullable|string|max:255',
            'track_strand' => 'required|string',
            'school_year_last_attended' => 'required|string',
            'document_type_id' => 'required|exists:documents,id',
            'purpose' => 'required|string',
            'signature' => 'required|string',
            'quantity' => 'required|integer|min:1|max:10',
        ]);

        // Get email from session
        $email = session('otp_email');
        if (!$email) {
            return redirect()->route('otp.request', ['purpose' => 'submission'])
                ->withErrors(['error' => 'Session expired. Please start over.']);
        }

        // Normalize email to lowercase for consistency
        $email = strtolower(trim($email));

        // Get document to calculate processing time
        $document = Document::findOrFail($validated['document_type_id']);
        $estimatedDate = Carbon::now()->addDays($document->processing_days);

        // Create the request
        $documentRequest = Request::create([
            'email' => $email,
            'contact_number' => $validated['contact_number'],
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'],
            'last_name' => $validated['last_name'],
            'lrn' => $validated['lrn'],
            'grade_level' => $validated['grade_level'],
            'section' => $validated['section'],
            'track_strand' => $validated['track_strand'],
            'school_year_last_attended' => $validated['school_year_last_attended'],
            'document_type_id' => $validated['document_type_id'],
            'purpose' => $validated['purpose'],
            'signature' => $validated['signature'],
            'quantity' => $validated['quantity'],
            'status' => 'pending',
            'estimated_completion_date' => $estimatedDate,
        ]);

        // Send confirmation email
        try {
            Mail::to($email)->send(new RequestConfirmation($documentRequest));
        } catch (\Exception $e) {
            \Log::error('Failed to send confirmation email: ' . $e->getMessage());
        }

        // Clear OTP session data
        session()->forget(['otp_verified', 'otp_verified_at', 'otp_email', 'otp_purpose']);

        return redirect()->route('request.success', ['tracking_id' => $documentRequest->tracking_id]);
    }

    /**
     * Show success page
     */
    public function success($tracking_id)
    {
        $request = Request::where('tracking_id', $tracking_id)->firstOrFail();
        return view('request.success', compact('request'));
    }
}
