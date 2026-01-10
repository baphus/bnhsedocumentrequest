<?php

namespace App\Livewire\Pages\Public\Tracking;

use App\Models\Request as DocumentRequest;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Layout;

#[Layout('layouts.public')]
class TrackRequest extends Component
{
    #[Validate('required|string')]
    public string $tracking_id = '';

    #[Validate('required|email')]
    public string $email = '';

    public ?DocumentRequest $documentRequest = null;
    public bool $showResults = false;

    public function mount()
    {
        $this->tracking_id = request()->query('tracking_id', '');
        $this->email = request()->query('email', '');

        if ($this->tracking_id && $this->email) {
            $this->track();
        }
    }

    public function track()
    {
        $this->validate();

        $trackingId = strtoupper(trim($this->tracking_id));
        $email = strtolower(trim($this->email));

        // Find request by tracking ID and email
        $this->documentRequest = DocumentRequest::where('tracking_id', $trackingId)
            ->where('email', $email)
            ->first();

        if (!$this->documentRequest) {
            $this->addError('tracking_id', 'No request found with this tracking code and email combination. Please verify your information.');
            $this->showResults = false;
            return;
        }

        // Load relationships
        $this->documentRequest->load(['documentType', 'processor', 'logs.user']);
        $this->showResults = true;
    }

    public function resetForm()
    {
        $this->reset(['tracking_id', 'email', 'documentRequest', 'showResults']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.pages.public.tracking.track-request');
    }
}
