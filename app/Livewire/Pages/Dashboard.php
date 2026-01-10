<?php

namespace App\Livewire\Pages;

use App\Models\Request as DocumentRequest;
use App\Models\RequestLog;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public string $header = 'Dashboard';

    #[Computed]
    public function stats()
    {
        return [
            'total' => DocumentRequest::count(),
            'pending' => DocumentRequest::where('status', 'pending')->count(),
            'processing' => DocumentRequest::where('status', 'processing')->count(),
            'ready' => DocumentRequest::where('status', 'ready')->count(),
            'completed' => DocumentRequest::where('status', 'completed')->count(),
        ];
    }

    #[Computed]
    public function recentRequests()
    {
        return DocumentRequest::with('documentType')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
    }

    #[Computed]
    public function recentActivities()
    {
        return RequestLog::with(['user', 'request'])
            ->latest()
            ->take(10)
            ->get();
    }

    #[Computed]
    public function fulfillmentRate()
    {
        $stats = $this->stats();
        return $stats['total'] > 0 
            ? round(($stats['completed'] / $stats['total']) * 100, 1) 
            : 0;
    }

    public function render()
    {
        return view('livewire.pages.dashboard');
    }
}
