<?php

namespace App\Observers;

use App\Models\Request;
use App\Models\RequestLog;

class RequestObserver
{
    /**
     * Handle the Request "created" event.
     */
    public function created(Request $request): void
    {
        RequestLog::log(
            $request->id,
            'Request submitted',
            null
        );
    }

    /**
     * Handle the Request "updated" event.
     */
    public function updated(Request $request): void
    {
        $userId = auth()->id();
        \Illuminate\Support\Facades\Log::info("RequestObserver updated fired for ID: {$request->id}. Is Dirty Status: " . ($request->isDirty('status') ? 'Yes' : 'No'));

        // 1. Handle Status Changes
        if ($request->isDirty('status')) {
            $oldStatus = $request->getOriginal('status');
            $newStatus = $request->status;
            
            // Try to get document name safely
            $documentName = $request->documentType ? $request->documentType->name : 'Unknown Document';
            $requestOwner = "{$request->first_name} {$request->last_name}";

            RequestLog::log($request->id, "Status changed from '{$oldStatus}' to '{$newStatus}' for Request #{$request->tracking_id} ({$requestOwner}) - {$documentName}", $userId);
        }

        // 2. Handle Admin Remarks (Only log if actually changed)
        if ($request->isDirty('admin_remarks')) {
            $requestOwner = "{$request->first_name} {$request->last_name}";
            RequestLog::log($request->id, "Admin remarks updated for Request #{$request->tracking_id} ({$requestOwner})", $userId);
        }

        // 3. Handle Internal Notes
        if ($request->isDirty('internal_notes')) {
            $requestOwner = "{$request->first_name} {$request->last_name}";
            RequestLog::log($request->id, "Internal notes updated for Request #{$request->tracking_id} ({$requestOwner})", $userId);
        }

        // 4. Handle Estimated Completion Date
        if ($request->isDirty('estimated_completion_date')) {
            $date = $request->estimated_completion_date?->format('M d, Y') ?? 'cleared';
            $requestOwner = "{$request->first_name} {$request->last_name}";
            RequestLog::log($request->id, "Estimated completion date set to {$date} for Request #{$request->tracking_id} ({$requestOwner})", $userId);
        }
    }
    /**
     * Handle the Request "deleting" event.
     */
    public function deleting(Request $request): void
    {
        // We log it BEFORE it is gone from the database
        // Ensure RequestLog model doesn't strictly require the request_id 
        // to exist in the requests table at the moment of commit
        $requestOwner = "{$request->first_name} {$request->last_name}";
        RequestLog::create([
            'user_id' => auth()->id(),
            'request_id' => $request->id,
            'action' => "Deleted Request #{$request->tracking_id} ({$requestOwner})",
            'created_at' => now(),
        ]);
    }
}
