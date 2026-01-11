<?php

namespace App\Livewire\Pages\Public\Otp;

use App\Models\Otp;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Layout;

#[Layout('layouts.public')]
class VerifyOtp extends Component
{
    #[Validate('required|string|size:6')]
    public string $code = '';

    public string $purpose = 'submission';
    public ?string $email = null;

    public function mount()
    {
        $this->purpose = request()->query('purpose', 'submission');
        $this->email = Session::get('otp_email');

        if (!$this->email) {
            return redirect()->route('otp.request', ['purpose' => $this->purpose])
                ->with('error', 'Please request an OTP first.');
        }
    }

    public function verify()
    {
        $this->validate();

        $key = 'otp-verify:' . $this->email . ':' . $this->purpose;

        // Rate limiting: 5 failed attempts
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $this->addError('code', 'Too many failed attempts. Please request a new OTP.');
            return;
        }

        // Verify OTP
        if (Otp::verify($this->email, $this->code, $this->purpose)) {
            RateLimiter::clear($key);
            
            Session::put([
                'otp_verified' => true,
                'otp_verified_at' => now(),
            ]);

            $this->dispatch('notify', type: 'success', message: 'Email verified successfully.');

            // Redirect based on purpose
            if ($this->purpose === 'submission') {
                return $this->redirect(route('request.create'), navigate: true);
            } else {
                return $this->redirect(route('tracking.form'), navigate: true);
            }
        }

        RateLimiter::hit($key, 300); // 5 minutes lockout
        $this->addError('code', 'Invalid or expired OTP code.');
        $this->code = '';
    }

    public function resend()
    {
        // Resend OTP without redirecting back to email input
        $email = $this->email ?? Session::get('otp_email');

        if (!$email) {
            return $this->redirect(route('otp.request', ['purpose' => $this->purpose]))
                ->with('error', 'Please request an OTP first.');
        }

        $key = 'otp-send:' . $email . ':' . $this->purpose;

        // Rate limiting: 3 attempts per 10 minutes
        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            $this->addError('code', 'Too many OTP requests. Please try again in ' . ceil($seconds / 60) . ' minutes.');
            return;
        }

        RateLimiter::hit($key, 600); // 10 minutes

        $otp = Otp::generate($email, $this->purpose);

        try {
            \Illuminate\Support\Facades\Mail::to($email)->send(new \App\Mail\OtpMail($otp, $this->purpose));
        } catch (\Exception $e) {
            \Log::error('Failed to resend OTP email: ' . $e->getMessage());
            $this->addError('code', 'Failed to resend OTP. Please try again.');
            return;
        }

        Session::put([
            'otp_email' => $email,
            'otp_purpose' => $this->purpose,
        ]);

        $this->dispatch('notify', type: 'success', message: 'A new OTP has been sent to your email.');
    }

    public function render()
    {
        return view('livewire.pages.public.otp.verify-otp');
    }
}
