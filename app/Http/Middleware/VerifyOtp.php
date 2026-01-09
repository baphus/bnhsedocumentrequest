<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyOtp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $purpose = 'submission'): Response
    {
        // Check if OTP is verified
        if (!session('otp_verified') || session('otp_purpose') !== $purpose) {
            return redirect()->route('otp.request', ['purpose' => $purpose])
                ->withErrors(['error' => 'Please verify your email with OTP first.']);
        }

        // Check if OTP verification is still valid (30 minutes)
        $verifiedAt = session('otp_verified_at');
        if ($verifiedAt && now()->diffInMinutes($verifiedAt) > 30) {
            session()->forget(['otp_verified', 'otp_verified_at']);
            return redirect()->route('otp.request', ['purpose' => $purpose])
                ->withErrors(['error' => 'OTP verification expired. Please verify again.']);
        }

        return $next($request);
    }
}
