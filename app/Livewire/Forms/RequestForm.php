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

    #[Validate('nullable|string|max:10')]
    public string $suffix = '';

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

    #[Validate('nullable|string|max:255')]
    public ?string $advisor = null;

    #[Validate('required|exists:documents,id')]
    public ?int $document_type_id = null;

    #[Validate('required|string')]
    public string $purpose = '';

    #[Validate('required|string')]
    public string $signature = '';

    #[Validate('required|integer|min:1|max:10')]
    public int $quantity = 1;

    #[Validate('required|string|in:pending,verified,processing,ready,completed,rejected')]
    public string $status = 'pending';

    public function save(): DocumentRequest
    {
        $this->validate();

        // Get document to calculate processing time
        $document = Document::findOrFail($this->document_type_id);
        $estimatedDate = Carbon::now()->addDays($document->processing_days);

        // Create the request
        return DocumentRequest::create([
            'email' => null,
            'contact_number' => $this->contact_number,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'suffix' => $this->suffix,
            'lrn' => $this->lrn,
            'grade_level' => $this->grade_level,
            'section' => $this->section,
            'track_strand' => $this->track_strand,
            'school_year_last_attended' => $this->school_year_last_attended,
            'advisor' => $this->advisor,
            'document_type_id' => $this->document_type_id,
            'purpose' => $this->purpose,
            'signature' => $this->signature,
            'quantity' => $this->quantity,
            'status' => $this->status,
            'estimated_completion_date' => $estimatedDate,
        ]);
    }

    public function reset(...$properties): void
    {
        $this->contact_number = '';
        $this->first_name = '';
        $this->middle_name = '';
        $this->last_name = '';
        $this->suffix = '';
        $this->lrn = '';
        $this->grade_level = '';
        $this->section = '';
        $this->track_strand = '';
        $this->school_year_last_attended = '';
        $this->document_type_id = null;
        $this->purpose = '';
        $this->signature = '';
        $this->quantity = 1;
        $this->status = 'pending';
    }
}
