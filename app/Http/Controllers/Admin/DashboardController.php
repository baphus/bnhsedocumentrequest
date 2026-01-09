<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Request;
use App\Models\RequestLog;
use Illuminate\Http\Request as HttpRequest;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function index(HttpRequest $request)
    {
        // Statistics
        $stats = [
            'total' => Request::count(),
            'pending' => Request::where('status', 'pending')->count(),
            'processing' => Request::where('status', 'processing')->count(),
            'ready' => Request::where('status', 'ready')->count(),
            'completed' => Request::where('status', 'completed')->count(),
        ];

        $requests = Request::with('documentType')->orderBy('created_at', 'desc')->take(5)->get();

        $activities = RequestLog::with('user', 'request')->latest()->take(10)->get();

        return view('admin.dashboard', compact('requests', 'stats', 'activities'));
    }

    /**
     * Show requests table
     */
    public function requests(HttpRequest $request)
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

        return view('admin.requests.index', compact('requests', 'status', 'search'));
    }

    /**
     * Show request detail
     */
    public function show($id)
    {
        $request = Request::with(['documentType', 'processor', 'logs.user'])
            ->findOrFail($id);

        return view('admin.requests.show', compact('request'));
    }
}
