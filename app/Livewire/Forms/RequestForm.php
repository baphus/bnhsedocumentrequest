<?php

namespace App\Livewire\Forms;

use App\Models\Request as DocumentRequest;
use App\Models\Document;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Form;

class RequestForm extends Form
{
    #[Validate('required|string|max:20')]
    public string $contact_number = '';

    #[Validate('required|string|max:255')]
    public string $first_name = '';

    #[Validate('nullable|string|max:255')]
    public string $middle_name = '';

    #[Validate('required|string|max:255')]
    public string $last_name = '';

    #[Validate('required|string|size:12')]
    public string $lrn = '';

    #[Validate('required|string')]
    public string $grade_level = '';

    #[Validate('nullable|string|max:255')]
    public string $section = '';

    #[Validate('nullable|string|max:255')]
    public string $track_strand = 'N/A';

    #[Validate('required|string')]
    public string $school_year_last_attended = '';

    #[Validate('required|exists:documents,id')]
    public ?int $document_type_id = null;

    #[Validate('required|string')]
    public string $purpose = '';

    #[Validate('required|string')]
    public string $signature = '';

    #[Validate('required|integer|min:1|max:10')]
    public int $quantity = 1;

    public ?string $email = null; // Set from session

    public function setEmail(string $email): void
    {
        $this->email = strtolower(trim($email));
    }

    public function save(): DocumentRequest
    {
        $this->validate();

        if (!$this->email) {
            throw new \Exception('Email is required. Please verify your email first.');
        }

        // Get document to calculate processing time
        $document = Document::findOrFail($this->document_type_id);
        $estimatedDate = Carbon::now()->addDays($document->processing_days);

        // Create the request
        return DocumentRequest::create([
            'email' => $this->email,
            'contact_number' => $this->contact_number,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'lrn' => $this->lrn,
            'grade_level' => $this->grade_level,
            'section' => $this->section,
            'track_strand' => $this->track_strand,
            'school_year_last_attended' => $this->school_year_last_attended,
            'document_type_id' => $this->document_type_id,
            'purpose' => $this->purpose,
            'signature' => $this->signature,
            'quantity' => $this->quantity,
            'status' => 'pending',
            'estimated_completion_date' => $estimatedDate,
        ]);
    }

    public function reset(...$properties): void
    {
        $this->contact_number = '';
        $this->first_name = '';
        $this->middle_name = '';
        $this->last_name = '';
        $this->lrn = '';
        $this->grade_level = '';
        $this->section = '';
        $this->track_strand = '';
        $this->school_year_last_attended = '';
        $this->document_type_id = null;
        $this->purpose = '';
        $this->signature = '';
        $this->quantity = 1;
        $this->email = null;
    }
}
