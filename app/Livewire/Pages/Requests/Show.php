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
    public bool $isEditing = false;

    public $contact_number;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $lrn;
    public $grade_level;
    public $section;
    public $track_strand;
    public $school_year_last_attended;
    public $advisor;

    public function mount($id)
    {
        $this->request = DocumentRequest::with(['documentType', 'processor', 'logs.user'])
            ->findOrFail($id);
        $this->form->setRequest($this->request);
        $this->initializeRequestData();
    }

    public function initializeRequestData()
    {
        $this->contact_number = $this->request->contact_number;
        $this->first_name = $this->request->first_name;
        $this->middle_name = $this->request->middle_name;
        $this->last_name = $this->request->last_name;
        $this->lrn = $this->request->lrn;
        $this->grade_level = $this->request->grade_level;
        $this->section = $this->request->section;
        $this->track_strand = $this->request->track_strand;
        $this->school_year_last_attended = $this->request->school_year_last_attended;
        $this->advisor = $this->request->advisor;
    }

    public function toggleEditing()
    {
        $this->isEditing = !$this->isEditing;
        if (!$this->isEditing) {
            $this->initializeRequestData();
        }
    }

    public function save()
    {
        $this->validate([
            'contact_number' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'lrn' => 'required|digits:12',
            'grade_level' => 'required',
            'school_year_last_attended' => 'required',
            'advisor' => 'nullable|string|max:255',
        ]);

        $this->request->update([
            'contact_number' => $this->contact_number,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'lrn' => $this->lrn,
            'grade_level' => $this->grade_level,
            'section' => $this->section,
            'track_strand' => $this->track_strand,
            'school_year_last_attended' => $this->school_year_last_attended,
            'advisor' => $this->advisor,
        ]);

        $this->isEditing = false;
        $this->request->refresh();
        $this->dispatch('notify', type: 'success', message: 'Request details updated successfully.');
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
