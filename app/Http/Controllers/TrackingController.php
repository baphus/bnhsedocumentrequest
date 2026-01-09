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
            'email' => 'required|email',
        ]);

        $trackingId = strtoupper($validated['tracking_id']);
        $email = strtolower(trim($validated['email']));

        // Find request by tracking ID and email
        $documentRequest = Request::where('tracking_id', $trackingId)
            ->where('email', $email)
            ->first();

        if (!$documentRequest) {
            return back()->withErrors([
                'tracking_id' => 'No request found with this tracking code and email combination. Please verify your information.',
            ])->withInput();
        }

        // Load relationships
        $documentRequest->load(['documentType', 'processor', 'logs.user']);

        return view('tracking.show', compact('documentRequest'));
    }
}
