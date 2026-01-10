<?php

namespace App\Livewire\Pages\Public\Request;

use App\Models\Document;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Session;

#[Layout('layouts.public')]
class SelectDocument extends Component
{
    public ?int $selectedDocumentId = null;
    public int $quantity = 1;

    #[Computed]
    public function groupedDocuments()
    {
        $documents = Document::active()
            ->orderBy('category')
            ->orderBy('name')
            ->get();

        return $documents->groupBy('category');
    }

    public function selectDocument($documentId)
    {
        $this->selectedDocumentId = $documentId;
    }

    public function validateSelection()
    {
        // Convert to integer if it's a string
        if (is_string($this->selectedDocumentId)) {
            $this->selectedDocumentId = (int) $this->selectedDocumentId;
        }

        $this->validate([
            'selectedDocumentId' => 'required|integer|exists:documents,id',
            'quantity' => 'required|integer|min:1|max:10',
        ], [
            'selectedDocumentId.required' => 'Please select a document type to continue.',
            'selectedDocumentId.integer' => 'Invalid document selection.',
            'selectedDocumentId.exists' => 'The selected document type is invalid.',
            'quantity.required' => 'Please specify the number of copies.',
            'quantity.min' => 'Minimum quantity is 1.',
            'quantity.max' => 'Maximum quantity is 10.',
        ]);

        // Verify the document exists and is active
        $document = Document::where('id', $this->selectedDocumentId)->where('is_active', true)->first();

        if (!$document) {
            $this->addError('selectedDocumentId', 'The selected document is not available.');
            return;
        }

        // Store selected document and quantity in session
        Session::put('selected_document_id', $this->selectedDocumentId);
        Session::put('selected_quantity', $this->quantity);
        Session::save();

        // Redirect to OTP verification
        return $this->redirect(route('otp.request', ['purpose' => 'submission']), navigate: true);
    }

    public function render()
    {
        return view('livewire.pages.public.request.select-document');
    }
}
