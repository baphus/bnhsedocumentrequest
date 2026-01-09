<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Otp extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'code',
        'purpose',
        'expires_at',
        'used',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'used' => 'boolean',
    ];

    /**
     * Generate a new OTP
     */
    public static function generate(string $email, string $purpose, int $minutes = 10): self
    {
        // Invalidate any existing unused OTPs for this email and purpose
        self::where('email', $email)
            ->where('purpose', $purpose)
            ->where('used', false)
            ->update(['used' => true]);

        return self::create([
            'email' => $email,
            'code' => str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT),
            'purpose' => $purpose,
            'expires_at' => Carbon::now()->addMinutes($minutes),
            'used' => false,
        ]);
    }

    /**
     * Verify OTP
     */
    public static function verify(string $email, string $code, string $purpose): bool
    {
        $otp = self::where('email', $email)
            ->where('code', $code)
            ->where('purpose', $purpose)
            ->where('used', false)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if ($otp) {
            $otp->update(['used' => true]);
            return true;
        }

        return false;
    }

    /**
     * Check if OTP is valid
     */
    public function isValid(): bool
    {
        return !$this->used && $this->expires_at->isFuture();
    }

    /**
     * Scope for unused OTPs
     */
    public function scopeUnused($query)
    {
        return $query->where('used', false);
    }

    /**
     * Scope for valid OTPs
     */
    public function scopeValid($query)
    {
        return $query->where('used', false)
                     ->where('expires_at', '>', Carbon::now());
    }
}
