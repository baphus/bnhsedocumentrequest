<?php

namespace App\Livewire\Pages\Public\Tracking;

use App\Models\Request as DocumentRequest;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Layout;

#[Layout('layouts.public')]
class TrackRequest extends Component
{
    public string $tracking_id = '';
    
    public ?DocumentRequest $documentRequest = null;
    public $lrnRequests = [];
    public bool $showResults = false;
    public bool $isForgotId = false;

    public function mount()
    {
        $this->tracking_id = request()->query('tracking_id', '');

        if ($this->tracking_id) {
            $this->track();
        }
    }

    public function track()
    {
        $this->resetValidation();
        $this->showResults = false;
        $this->documentRequest = null;
        $this->lrnRequests = [];

        $this->validate([
            'tracking_id' => 'required|string',
        ]);

        $input = strtoupper(trim($this->tracking_id));

        // Check if input is in DOC-{LRN} format (DOC- followed by 12 digits)
        if (preg_match('/^DOC-(\d{12})$/', $input, $matches)) {
            $lrn = $matches[1];
            
            $this->lrnRequests = DocumentRequest::where('lrn', $lrn)
                ->with('documentType')
                ->latest()
                ->get();

            if ($this->lrnRequests->isEmpty()) {
                $this->addError('tracking_id', 'No requests found for this LRN. You haven\'t made any requests yet.');
                return;
            }
        } else {
            // Treat as regular tracking ID
            $this->documentRequest = DocumentRequest::where('tracking_id', $input)->first();

            if (!$this->documentRequest) {
                $this->addError('tracking_id', 'No request found with this tracking code.');
                return;
            }

            $this->documentRequest->load(['documentType', 'processor', 'logs.user']);
        }
        
        $this->showResults = true;
    }

    public function viewRequest($id)
    {
        $this->documentRequest = DocumentRequest::with(['documentType', 'processor', 'logs.user'])->find($id);
    }

    public function backToList()
    {
        $this->documentRequest = null;
    }

    public function toggleForgotId()
    {
        $this->isForgotId = !$this->isForgotId;
        $this->resetValidation();
        $this->tracking_id = '';
    }

    public function resetForm()
    {
        $this->reset(['tracking_id', 'documentRequest', 'lrnRequests', 'showResults']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.pages.public.tracking.track-request');
    }
}
