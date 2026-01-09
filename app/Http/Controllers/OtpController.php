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
        $purpose = $request->query('purpose', 'submission');
        $email = session('otp_email');

        if (!$email) {
            return redirect()->route('otp.request', ['purpose' => $purpose])
                ->withErrors(['error' => 'Please request an OTP first.']);
        }

        return view('otp.verify', compact('purpose', 'email'));
    }

    /**
     * Verify OTP with rate limiting
     */
    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6',
            'purpose' => 'required|in:submission,tracking',
        ]);

        $email = session('otp_email');
        $code = $request->code;
        $purpose = $request->purpose;

        if (!$email) {
            return redirect()->route('otp.request', ['purpose' => $purpose])
                ->withErrors(['error' => 'Session expired. Please request a new OTP.']);
        }

        $key = 'otp-verify:' . $email . ':' . $purpose;

        // Rate limiting: 5 failed attempts
        if (RateLimiter::tooManyAttempts($key, 5)) {
            return back()->withErrors(['code' => 'Too many failed attempts. Please request a new OTP.']);
        }

        // Verify OTP
        if (Otp::verify($email, $code, $purpose)) {
            RateLimiter::clear($key);
            
            session([
                'otp_verified' => true,
                'otp_verified_at' => now(),
            ]);

            // Redirect based on purpose
            if ($purpose === 'submission') {
                return redirect()->route('request.create');
            } else {
                return redirect()->route('tracking.form');
            }
        }

        RateLimiter::hit($key, 300); // 5 minutes lockout

        return back()->withErrors(['code' => 'Invalid or expired OTP code.']);
    }

    /**
     * Resend OTP
     */
    public function resend(Request $request)
    {
        $email = session('otp_email');
        $purpose = $request->query('purpose', 'submission');

        if (!$email) {
            return redirect()->route('otp.request', ['purpose' => $purpose]);
        }

        return $this->send($request->merge(['email' => $email, 'purpose' => $purpose]));
    }
}
