<?php

namespace App\Observers;

use App\Models\Request;
use App\Models\RequestLog;
use App\Mail\RequestStatusChanged;
use Illuminate\Support\Facades\Mail;

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

        // 1. Handle Status Changes
        if ($request->isDirty('status')) {
            $oldStatus = $request->getOriginal('status');
            $newStatus = $request->status;
            
            RequestLog::log($request->id, "Status changed from '{$oldStatus}' to '{$newStatus}'", $userId);

            // Since the Mailable now implements ShouldQueue, this call is nearly instant!
            Mail::to($request->email)->send(new RequestStatusChanged($request));
        }

        // 2. Handle Admin Remarks (Only log if actually changed)
        if ($request->isDirty('admin_remarks')) {
            RequestLog::log($request->id, 'Admin remarks updated', $userId);
        }

        // 3. Handle Internal Notes
        if ($request->isDirty('internal_notes')) {
            RequestLog::log($request->id, 'Internal notes updated', $userId);
        }

        // 4. Handle Estimated Completion Date
        if ($request->isDirty('estimated_completion_date')) {
            $date = $request->estimated_completion_date?->format('M d, Y') ?? 'cleared';
            RequestLog::log($request->id, "Estimated completion date set to {$date}", $userId);
        }
    }
    /**
     * Handle the Request "deleted" event.
     */
    public function deleted(Request $request): void
    {
        RequestLog::log(
            $request->id,
            'Request deleted',
            auth()->id()
        );
    }
}
