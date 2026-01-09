<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Request;
use App\Models\RequestLog;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RequestManagementController extends Controller
{
    /**
     * Update single request status with optimized field handling.
     */
    public function updateStatus(HttpRequest $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,ready,completed',
            'estimated_completion_date' => 'nullable|date',
            'admin_remarks' => 'nullable|string',
            'internal_notes' => 'nullable|string',
        ]);

        $documentRequest = Request::findOrFail($id);
        $oldStatus = $documentRequest->status;

        // Use fill() to handle multiple fields efficiently
        $documentRequest->fill($validated);
        
        // Logical check for processor assignment
        if (!$documentRequest->processed_by) {
            $documentRequest->processed_by = Auth::id();
        }

        DB::transaction(function () use ($documentRequest, $oldStatus) {
            $documentRequest->save();

            RequestLog::create([
                'user_id' => Auth::id(),
                'request_id' => $documentRequest->id,
                'action' => "Status changed: {$oldStatus} -> {$documentRequest->status}",
            ]);
        });

        return redirect()->back()->with('success', 'Request updated successfully.');
    }

    /**
     * Highly optimized Bulk Update.
     * Replaces N+1 queries with 2 high-performance queries.
     */
    public function bulkUpdate(HttpRequest $request)
    {
        $validated = $request->validate([
            'request_ids' => 'required|array',
            'request_ids.*' => 'exists:requests,id',
            'status' => 'required|in:pending,processing,ready,completed',
        ]);

        $ids = $validated['request_ids'];
        $newStatus = $validated['status'];
        $userId = auth()->id();
        $now = now();

        DB::transaction(function () use ($ids, $newStatus, $userId, $now) {
            // 1. MASS UPDATE (Faster, but doesn't fire Model Events)
            Request::whereIn('id', $ids)->update([
                'status' => $newStatus,
                'processed_by' => DB::raw("COALESCE(processed_by, {$userId})"),
                'updated_at' => $now,
            ]);

            // 2. MASS LOG INSERTION
            $logEntries = array_map(fn($id) => [
                'user_id' => $userId,
                'request_id' => $id,
                'action' => "Bulk updated status to {$newStatus}",
                'created_at' => $now,
                'updated_at' => $now,
            ], $ids);

            RequestLog::insert($logEntries);
        });

        // 3. DISPATCH NOTIFICATIONS (Queue them!)
        // Instead of mailing inside a loop, dispatch a single Job or use Notify
        // Example: foreach($ids as $id) { Notification::send(...) } 
        // Ensure your Notification/Mailable uses the 'ShouldQueue' interface.

        return redirect()->back()->with('success', count($ids) . " requests updated.");
    }

    /**
     * Delete request with logging.
     */
    public function destroy($id)
    {
        $request = Request::findOrFail($id);
        
        DB::transaction(function () use ($request) {
            $trackingId = $request->tracking_id;
            $id = $request->id;
            
            $request->delete();

            RequestLog::create([
                'user_id' => Auth::id(),
                'request_id' => $id,
                'action' => "Permanent deletion of tracking ID: {$trackingId}",
            ]);
        });

        return redirect()->route('admin.dashboard')->with('success', 'Request deleted.');
    }
}