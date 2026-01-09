<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Request;
use Illuminate\Http\Request as HttpRequest;
use Carbon\Carbon;

class RequestManagementController extends Controller
{
    /**
     * Update request status
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

        // Update fields
        $documentRequest->status = $validated['status'];
        
        if (isset($validated['estimated_completion_date'])) {
            $documentRequest->estimated_completion_date = $validated['estimated_completion_date'];
        }
        
        if (isset($validated['admin_remarks'])) {
            $documentRequest->admin_remarks = $validated['admin_remarks'];
        }
        
        if (isset($validated['internal_notes'])) {
            $documentRequest->internal_notes = $validated['internal_notes'];
        }

        // Assign processor if not already assigned
        if (!$documentRequest->processed_by) {
            $documentRequest->processed_by = auth()->id();
        }

        $documentRequest->save();

        return redirect()->back()->with('success', 'Request updated successfully.');
    }

    /**
     * Bulk update status
     */
    public function bulkUpdate(HttpRequest $request)
    {
        $validated = $request->validate([
            'request_ids' => 'required|array',
            'request_ids.*' => 'exists:requests,id',
            'status' => 'required|in:pending,processing,ready,completed',
        ]);

        $updated = 0;
        foreach ($validated['request_ids'] as $id) {
            $documentRequest = Request::find($id);
            if ($documentRequest) {
                $documentRequest->status = $validated['status'];
                
                // Assign processor if not already assigned
                if (!$documentRequest->processed_by) {
                    $documentRequest->processed_by = auth()->id();
                }
                
                $documentRequest->save();
                $updated++;
            }
        }

        return redirect()->back()->with('success', "{$updated} request(s) updated successfully.");
    }

    /**
     * Delete request
     */
    public function destroy($id)
    {
        $request = Request::findOrFail($id);
        $trackingId = $request->tracking_id;
        
        $request->delete();

        return redirect()->route('admin.dashboard')
            ->with('success', "Request {$trackingId} deleted successfully.");
    }
}
