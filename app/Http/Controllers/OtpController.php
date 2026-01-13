<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class OtpController extends Controller
{
    /**
     * Show OTP request form
     */
    public function showRequestForm(Request $request)
    {
        $purpose = $request->query('purpose', 'submission');
        return view('otp.request', compact('purpose'));
    }

    /**
     * Send OTP to email with rate limiting
     */
    public function send(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'purpose' => 'required|in:submission,tracking',
        ]);

        $email = strtolower(trim($request->email));
        $purpose = $request->purpose;
        $key = 'otp-send:' . $email . ':' . $purpose;

        // Rate limiting: 3 attempts per 10 minutes
        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'email' => ["Too many OTP requests. Please try again in " . ceil($seconds / 60) . " minutes."],
            ]);
        }

        RateLimiter::hit($key, 600); // 10 minutes

        // Generate and send OTP
        $otp = Otp::generate($email, $purpose);

        try {
            Mail::to($email)->send(new OtpMail($otp, $purpose));
        } catch (\Exception $e) {
            \Log::error('Failed to send OTP email: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Failed to send OTP. Please try again.']);
        }

        session([
            'otp_email' => $email,
            'otp_purpose' => $purpose,
        ]);

        return redirect()->route('otp.verify', ['purpose' => $purpose])
            ->with('success', 'OTP has been sent to your email.');
    }

    /**
     * Show OTP verification form
     */
    public function showVerifyForm(Request $request)
    {
        // DEPRECATED: This now uses a Livewire component.
        // See App\Livewire\Pages\Public\Otp\VerifyOtp.php
        // and routes/public.php
        return redirect()->route('otp.verify', ['purpose' => $request->query('purpose', 'submission')]);
    }

    /**
     * Verify OTP with rate limiting
     */
    public function verify(Request $request)
    {
        // DEPRECATED: This logic is now handled in the Livewire component.
        // See App\Livewire\Pages\Public\Otp\VerifyOtp.php
        abort(404);
    }

    /**
     * Resend OTP
     */
    public function resend(Request $request)
    {
        // DEPRECATED: This logic is now handled in the Livewire component.
        // See App\Livewire\Pages\Public\Otp\VerifyOtp.php
        abort(404);
    }
}
