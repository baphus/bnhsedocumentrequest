<?php

namespace App\Livewire;

use App\Models\Request as DocumentRequest;
use LivewireUI\Modal\ModalComponent;

class RejectRequestModal extends ModalComponent
{
    public DocumentRequest $request;
    public $admin_remarks;

    public function mount(int $requestId)
    {
        $this->request = DocumentRequest::findOrFail($requestId);
    }

    public function reject()
    {
        $this->validate([
            'admin_remarks' => 'required|string|max:500',
        ]);

        $this->request->update([
            'status' => 'rejected',
            'admin_remarks' => 'Reason for rejection: ' . $this->admin_remarks,
            'processed_by' => auth()->id(),
        ]);

        $this->dispatch('notify', [
            'type' => 'error',
            'message' => 'Request has been rejected.'
        ]);

        $this->closeModal();
        $this->dispatch('refreshTable')->to('tables.pending-requests-table');
    }

    public function render()
    {
        return view('livewire.reject-request-modal');
    }
}
