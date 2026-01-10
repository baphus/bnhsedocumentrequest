<?php

namespace App\Livewire;

use App\Models\Document;
use Livewire\Component;
use Livewire\Attributes\On;

class DeleteDocumentModal extends Component
{
    public bool $isOpen = false;
    public ?int $documentId = null;
    public ?Document $document = null;

    public function mount()
    {
        $this->isOpen = false;
    }

    #[On('openDeleteDocumentModal')]
    public function openModal($documentId)
    {
        // Close document modal if it's open
        $this->dispatch('close-modal', 'document-modal');
        
        $this->documentId = $documentId;
        $this->document = Document::find($documentId);
        $this->isOpen = true;
        $this->dispatch('open-modal', 'delete-document-modal');
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->dispatch('close-modal', 'delete-document-modal');
    }

    public function delete()
    {
        if ($this->document) {
            $this->document->delete();
            $this->dispatch('refreshDatatable');
            $this->closeModal();
        }
    }

    public function render()
    {
        return view('livewire.delete-document-modal');
    }
}
