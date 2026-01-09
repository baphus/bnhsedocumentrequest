<?php

namespace App\Http\Controllers;

use App\Models\Request;
use Illuminate\Http\Request as HttpRequest;

class TrackingController extends Controller
{
    /**
     * Show tracking form
     */
    public function form()
    {
        return view('tracking.form');
    }

    /**
     * Show tracking results
     */
    public function track(HttpRequest $request)
    {
        $validated = $request->validate([
            'tracking_id' => 'required|string',
        ]);

        $trackingId = strtoupper($validated['tracking_id']);
        $documentRequest = Request::where('tracking_id', $trackingId)->first();

        if (!$documentRequest) {
            return back()->withErrors(['tracking_id' => 'No request found with this tracking ID.']);
        }

        // Verify email matches session
        $email = session('otp_email');
        if ($documentRequest->email !== $email) {
            return back()->withErrors(['tracking_id' => 'Tracking ID does not match verified email.']);
        }

        // Load relationships
        $documentRequest->load(['documentType', 'processor', 'logs.user']);

        // Clear OTP session after successful tracking
        session()->forget(['otp_verified', 'otp_verified_at', 'otp_email', 'otp_purpose']);

        return view('tracking.show', compact('documentRequest'));
    }
}
