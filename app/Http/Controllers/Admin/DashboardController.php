<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Request;
use Illuminate\Http\Request as HttpRequest;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function index(HttpRequest $request)
    {
        $status = $request->query('status', 'all');
        $search = $request->query('search');

        $query = Request::with(['documentType', 'processor'])
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        // Search
        if ($search) {
            $query->search($search);
        }

        $requests = $query->paginate(20);

        // Statistics
        $stats = [
            'total' => Request::count(),
            'pending' => Request::where('status', 'pending')->count(),
            'processing' => Request::where('status', 'processing')->count(),
            'ready' => Request::where('status', 'ready')->count(),
            'completed' => Request::where('status', 'completed')->count(),
        ];

        return view('admin.dashboard', compact('requests', 'stats', 'status', 'search'));
    }

    /**
     * Show request detail
     */
    public function show($id)
    {
        $request = Request::with(['documentType', 'processor', 'logs.user'])
            ->findOrFail($id);

        return view('admin.request-detail', compact('request'));
    }
}
