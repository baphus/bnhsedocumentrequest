<?php

namespace App\Livewire\Pages;

use App\Models\Request as DocumentRequest;
use App\Models\RequestLog;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Carbon\Carbon;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public string $header = 'Dashboard';
    public $currentMonth;

    public function mount()
    {
        $this->currentMonth = now()->startOfMonth()->format('Y-m-d');
    }

    public function nextMonth()
    {
        $this->currentMonth = Carbon::parse($this->currentMonth)->addMonth()->format('Y-m-d');
    }

    public function prevMonth()
    {
        $this->currentMonth = Carbon::parse($this->currentMonth)->subMonth()->format('Y-m-d');
    }

    #[Computed]
    public function stats()
    {
        $counts = DocumentRequest::query()
            ->selectRaw("COUNT(*) as total")
            ->selectRaw("COUNT(CASE WHEN status = 'pending' THEN 1 END) as pending")
            ->selectRaw("COUNT(CASE WHEN status = 'processing' THEN 1 END) as processing")
            ->selectRaw("COUNT(CASE WHEN status = 'ready' THEN 1 END) as ready")
            ->selectRaw("COUNT(CASE WHEN status = 'completed' THEN 1 END) as completed")
            ->selectRaw("COUNT(CASE WHEN created_at >= ? THEN 1 END) as today", [now()->startOfDay()])
            ->first();

        return [
            'total' => (int) ($counts->total ?? 0),
            'pending' => (int) ($counts->pending ?? 0),
            'processing' => (int) ($counts->processing ?? 0),
            'ready' => (int) ($counts->ready ?? 0),
            'completed' => (int) ($counts->completed ?? 0),
            'today' => (int) ($counts->today ?? 0),
        ];
    }

    #[Computed]
    public function recentRequests()
    {
        return DocumentRequest::with('documentType')
            ->latest()
            ->take(5)
            ->get();
    }

    #[Computed]
    public function recentActivities()
    {
        return RequestLog::with('user')
            ->where('action', '!=', 'Request submitted')
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
