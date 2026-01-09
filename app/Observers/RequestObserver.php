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

        // Log status changes
        if ($request->isDirty('status')) {
            $oldStatus = $request->getOriginal('status');
            $newStatus = $request->status;
            
            $action = "Status changed from '{$oldStatus}' to '{$newStatus}'";
            RequestLog::log($request->id, $action, $userId);

            // Send email notification on status change
            try {
                Mail::to($request->email)->send(new RequestStatusChanged($request));
            } catch (\Exception $e) {
                \Log::error('Failed to send status change email: ' . $e->getMessage());
            }
        }

        // Log admin remarks changes
        if ($request->isDirty('admin_remarks') && !empty($request->admin_remarks)) {
            RequestLog::log(
                $request->id,
                'Admin remarks updated',
                $userId
            );
        }

        // Log internal notes changes
        if ($request->isDirty('internal_notes') && !empty($request->internal_notes)) {
            RequestLog::log(
                $request->id,
                'Internal notes updated',
                $userId
            );
        }

        // Log estimated completion date changes
        if ($request->isDirty('estimated_completion_date')) {
            $date = $request->estimated_completion_date?->format('M d, Y');
            RequestLog::log(
                $request->id,
                "Estimated completion date set to {$date}",
                $userId
            );
        }

        // Log processor assignment
        if ($request->isDirty('processed_by')) {
            $processor = $request->processor;
            $action = $processor 
                ? "Assigned to {$processor->name}"
                : "Processor unassigned";
            RequestLog::log($request->id, $action, $userId);
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
