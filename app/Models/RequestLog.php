<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestLog extends Model
{
    use HasFactory;

    const UPDATED_AT = null; // Only use created_at

    protected $fillable = [
        'request_id',
        'action',
        'user_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * Request relationship
     */
    public function request()
    {
        return $this->belongsTo(Request::class);
    }

    /**
     * User who performed the action
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Create a log entry
     */
    public static function log(int $requestId, string $action, ?int $userId = null): self
    {
        return self::create([
            'request_id' => $requestId,
            'action' => $action,
            'user_id' => $userId,
        ]);
    }
}
