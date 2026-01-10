<?php

namespace App\Livewire\Pages\Requests;

use App\Models\Request as DocumentRequest;
use App\Livewire\Forms\RequestStatusForm;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Show extends Component
{
    public DocumentRequest $request;
    public RequestStatusForm $form;
    public bool $showStatusModal = false;

    public function mount($id)
    {
        $this->request = DocumentRequest::with(['documentType', 'processor', 'logs.user'])
            ->findOrFail($id);
        $this->form->setRequest($this->request);
    }

    #[On('openUpdateStatusModal')]
    public function openUpdateStatusModal($requestId)
    {
        if (isset($requestId['requestId']) && $this->request->id == $requestId['requestId']) {
            $this->form->setRequest($this->request);
            $this->showStatusModal = true;
        } elseif ($this->request->id == $requestId) {
            $this->form->setRequest($this->request);
            $this->showStatusModal = true;
        }
    }

    public function closeStatusModal()
    {
        $this->showStatusModal = false;
    }

    public function updateStatus()
    {
        $this->form->update();
        $this->request->refresh();
        $this->showStatusModal = false;

        $this->dispatch('notify', type: 'success', message: 'Request status updated successfully.');
        $this->dispatch('refreshDatatable');
    }

    public function render()
    {
        return view('livewire.pages.requests.show');
    }
}
