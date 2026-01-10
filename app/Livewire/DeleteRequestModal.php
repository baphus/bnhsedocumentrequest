<?php

namespace App\Livewire;

use App\Models\Request;
use Livewire\Component;
use Livewire\Attributes\On;

class DeleteRequestModal extends Component
{
    public bool $isOpen = false;
    public ?int $requestId = null;
    public ?Request $request = null;

    #[On('openDeleteModal')]
    public function openModal($requestId)
    {
        if (is_array($requestId)) {
            $requestId = $requestId['requestId'] ?? null;
        }

        $this->requestId = $requestId;
        $this->request = Request::with('documentType')->find($requestId);
        $this->isOpen = true;
        $this->dispatch('open-modal', 'delete-request-modal');
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->dispatch('close-modal', 'delete-request-modal');
    }

    public function delete()
    {
        if ($this->request) {
            $this->request->delete();
            $this->dispatch('refreshDatatable');
            $this->dispatch('notify', type: 'success', message: 'Request deleted successfully.');
            $this->closeModal();
        }
    }

    public function render()
    {
        return view('livewire.delete-request-modal');
    }
}
