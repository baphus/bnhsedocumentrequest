<?php

namespace App\Livewire;

use App\Models\Document;
use Livewire\Component;
use Livewire\Attributes\On;

class DocumentModal extends Component
{
    public bool $isOpen = false;
    public ?int $documentId = null;
    public ?Document $document = null;
    
    public $name;
    public $category;
    public $processing_days;
    public $is_active = true;

    protected $rules = [
        'name' => 'required|string|max:255',
        'category' => 'nullable|string|max:255',
        'processing_days' => 'required|integer|min:1',
        'is_active' => 'boolean',
    ];

    public function mount()
    {
        $this->isOpen = false;
    }

    #[On('openDocumentModal')]
    public function openModal($documentId = null)
    {
        // Close delete modal if it's open
        $this->dispatch('close-modal', 'delete-document-modal');
        
        $this->resetValidation();
        $this->documentId = $documentId;
        if ($this->documentId) {
            $this->document = Document::find($this->documentId);
            $this->name = $this->document->name;
            $this->category = $this->document->category;
            $this->processing_days = $this->document->processing_days;
            $this->is_active = $this->document->is_active;
        } else {
            $this->document = new Document();
            $this->reset(['name', 'category', 'processing_days', 'is_active']);
            $this->is_active = true;
        }
        $this->isOpen = true;
        $this->dispatch('open-modal', 'document-modal');
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->dispatch('close-modal', 'document-modal');
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'category' => $this->category,
            'processing_days' => $this->processing_days,
            'is_active' => $this->is_active,
        ];

        if ($this->documentId) {
            $this->document->update($data);
        } else {
            Document::create($data);
        }

        $this->dispatch('refreshDatatable');
        $this->closeModal();
        $this->dispatch('notify', type: 'success', message: 'Document saved successfully.');
    }

    public function render()
    {
        return view('livewire.document-modal');
    }
}
