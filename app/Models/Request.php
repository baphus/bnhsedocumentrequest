<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\RequestObserver;

#[ObservedBy([RequestObserver::class])]
class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_id',
        'email',
        'contact_number',
        'first_name',
        'middle_name',
        'last_name',
        'lrn',
        'grade_level',
        'section',
        'track_strand',
        'school_year_last_attended',
        'document_type_id',
        'purpose',
        'signature',
        'quantity',
        'status',
        'estimated_completion_date',
        'admin_remarks',
        'internal_notes',
        'processed_by',
    ];

    protected $casts = [
        'estimated_completion_date' => 'date',
    ];

    /**
     * Boot method to generate tracking ID
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($request) {
            if (empty($request->tracking_id)) {
                $request->tracking_id = self::generateTrackingId();
            }
        });
    }

    /**
     * Generate unique tracking ID
     */
    public static function generateTrackingId(): string
    {
        do {
            $trackingId = 'DOC-' . strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6));
        } while (self::where('tracking_id', $trackingId)->exists());

        return $trackingId;
    }

    /**
     * Full name accessor
     */
    public function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->middle_name} {$this->last_name}");
    }

    /**
     * Status badge color
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'gray',
            'processing' => 'blue',
            'ready' => 'green',
            'completed' => 'indigo',
            default => 'gray',
        };
    }

    /**
     * Document type relationship
     */
    public function documentType()
    {
        return $this->belongsTo(Document::class, 'document_type_id');
    }

    /**
     * Processor relationship
     */
    public function processor()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    /**
     * Activity logs
     */
    public function logs()
    {
        return $this->hasMany(RequestLog::class)->orderBy('created_at', 'desc');
    }

    /**
     * Scope for status filtering
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope for search
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(function($q) use ($term) {
            $q->where('tracking_id', 'like', "%{$term}%")
              ->orWhere('email', 'like', "%{$term}%")
              ->orWhere('first_name', 'like', "%{$term}%")
              ->orWhere('last_name', 'like', "%{$term}%")
              ->orWhere('lrn', 'like', "%{$term}%");
        });
    }

    /**
     * Check if the signature is valid base64 image data
     */
    public function getHasSignatureAttribute()
    {
        return str_starts_with($this->signature, 'data:image');
    }
}
