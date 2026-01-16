<?php

namespace App\Livewire\Tables;

use App\Models\Request as DocumentRequest;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class PendingRequestsTable extends Component
{
    use WithPagination;

    #[On('refreshTable')]
    public function refresh()
    {
        $this->resetPage();
    }

    public function approve($requestId)
    {
        $this->dispatch('openModal', 'approve-request-modal', ['requestId' => $requestId]);
    }

    public function reject($requestId)
    {
        $this->dispatch('openModal', 'reject-request-modal', ['requestId' => $requestId]);
    }

    public function getPendingRequestsProperty()
    {
        return DocumentRequest::with('documentType')
            ->where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.tables.pending-requests-table', [
            'requests' => $this->pending_requests,
        ]);
    }
}
