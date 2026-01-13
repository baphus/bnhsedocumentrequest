<?php

namespace App\Livewire\Pages\Public\Otp;

use App\Models\Otp;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Layout;

#[Layout('layouts.public')]
class RequestOtp extends Component
{
    #[Validate('required|email')]
    public string $email = '';

    public string $purpose = 'submission';

    public function mount()
    {
        $this->purpose = request()->query('purpose', 'submission');
    }

    public function send()
    {
        $this->validate();

        $email = strtolower(trim($this->email));
        $key = 'otp-send:' . $email . ':' . $this->purpose;

        // Rate limiting: 3 attempts per 10 minutes
        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'email' => ["Too many OTP requests. Please try again in " . ceil($seconds / 60) . " minutes."],
            ]);
        }

        RateLimiter::hit($key, 600); // 10 minutes

        // Generate and send OTP
        $otp = Otp::generate($email, $this->purpose);

        try {
            Mail::to($email)->send(new OtpMail($otp, $this->purpose));
        } catch (\Exception $e) {
            \Log::error('Failed to send OTP email: ' . $e->getMessage());
            $this->addError('email', 'Failed to send OTP. Please try again.');
            return;
        }

        Session::put([
            'otp_email' => $email,
            'otp_purpose' => $this->purpose,
        ]);

        $this->dispatch('notify', type: 'success', message: 'OTP has been sent to your email.');

        // Redirect to verification page
        return $this->redirect(route('otp.verify', ['purpose' => $this->purpose]), navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.public.otp.request-otp');
    }
}
