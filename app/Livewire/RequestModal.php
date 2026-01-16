<?php

namespace App\Livewire;

use App\Models\Request;
use App\Models\Document;
use App\Models\Track;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Forms\RequestForm;
use Illuminate\Support\Facades\Auth;

class RequestModal extends Component
{
    public bool $isOpen = false;
    public ?int $requestId = null;
    public RequestForm $form;

    public function mount()
    {
        $this->isOpen = false;
    }    #[On('openRequestModal')]
    public function openModal($requestId = null)
    {
        // Close delete modal if it's open
        $this->dispatch('close-modal', 'delete-request-modal');
        
        $this->resetValidation();
        $this->form->reset();
        $this->requestId = null;

        if ($requestId) {
            if (is_array($requestId)) {
                $requestId = $requestId['requestId'] ?? null;
            }

            $this->requestId = $requestId;
            // Removed 'logs' relation as it is not used in the form
            $request = Request::with(['documentType', 'processor'])->find($requestId);
            if ($request) {
                $this->form->contact_number = $request->contact_number;
                $this->form->first_name = $request->first_name;
                $this->form->middle_name = $request->middle_name;
                $this->form->last_name = $request->last_name;
                $this->form->suffix = $request->suffix ?? '';
                $this->form->lrn = $request->lrn;
                $this->form->grade_level = $request->grade_level;
                $this->form->section = $request->section ?? '';
                $this->form->track_strand = $request->track_strand ?? 'N/A';
                $this->form->school_year_last_attended = $request->school_year_last_attended;
                $this->form->document_type_id = $request->document_type_id;
                $this->form->purpose = $request->purpose;
                $this->form->quantity = $request->quantity;
                $this->form->signature = $request->signature ?? 'N/A';
                $this->form->status = $request->status;
            }
        } else {
            $this->form->signature = 'ADMIN_ADDED';
            $this->form->status = 'pending';
        }

        $this->isOpen = true;
        $this->dispatch('open-modal', 'request-management-modal');
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->dispatch('close-modal', 'request-management-modal');
    }

    public function save()
    {
        $this->validate();

        if ($this->requestId) {
            $request = Request::findOrFail($this->requestId);
            $request->update([
                'contact_number' => $this->form->contact_number,
                'first_name' => $this->form->first_name,
                'middle_name' => $this->form->middle_name,
                'last_name' => $this->form->last_name,
                'suffix' => $this->form->suffix,
                'lrn' => $this->form->lrn,
                'grade_level' => $this->form->grade_level,
                'section' => $this->form->section,
                'track_strand' => $this->form->track_strand,
                'school_year_last_attended' => $this->form->school_year_last_attended,
                'document_type_id' => $this->form->document_type_id,
                'purpose' => $this->form->purpose,
                'quantity' => $this->form->quantity,
                'status' => $this->form->status,
            ]);
            $message = 'Request updated successfully.';
        } else {
            $this->form->save();
            $message = 'Request created successfully.';
        }

        $this->closeModal();
        $this->dispatch('refreshDatatable');
        $this->dispatch('notify', type: 'success', message: $message);
    }

    public function render()
    {
        return view('livewire.request-modal', [
            'documents' => Document::active()->get(),
            'tracks' => Track::active()->get(),
        ]);
    }
}
