<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'processing_days',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Requests using this document type
     */
    public function requests()
    {
        return $this->hasMany(Request::class, 'document_type_id');
    }

    /**
     * Scope for active documents only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
