<?php

namespace App\Livewire;

use App\Models\Request as DocumentRequest;
use LivewireUI\Modal\ModalComponent;

class ApproveRequestModal extends ModalComponent
{
    public DocumentRequest $request;

    public function mount(int $requestId)
    {
        $this->request = DocumentRequest::findOrFail($requestId);
    }

    public function approve()
    {
        $this->request->update([
            'status' => 'processing',
            'processed_by' => auth()->id(),
        ]);

        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Request has been approved successfully.'
        ]);

        $this->closeModal();
        $this->dispatch('refreshTable')->to('tables.pending-requests-table');
    }

    public function render()
    {
        return view('livewire.approve-request-modal');
    }
}
