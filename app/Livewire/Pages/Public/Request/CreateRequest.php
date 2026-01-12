<?php

namespace App\Livewire\Pages\Public\Request;

use App\Livewire\Forms\RequestForm;
use App\Models\Document;
use App\Models\Track;
use App\Mail\RequestConfirmation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;

#[Layout('layouts.public')]
class CreateRequest extends Component
{
    public RequestForm $form;
    public string $signature = '';
    public bool $emailVerified = false;

    #[Computed]
    public function tracks()
    {
        return Track::active()->orderBy('category')->orderBy('name')->get();
    }

    #[Computed]
    public function selectedDocumentId()
    {
        return Session::get('selected_document_id');
    }

    #[Computed]
    public function selectedDocument()
    {
        return Document::find($this->selectedDocumentId);
    }

    public function mount()
    {
        // Check if email is verified
        $this->emailVerified = Session::has('otp_verified');
        $email = Session::get('otp_email');

        if (!$email) {
            return redirect()->route('otp.request', ['purpose' => 'submission'])
                ->with('error', 'Session expired. Please verify your email first.');
        }

        $this->form->setEmail($email);

        // Set selected document and quantity from session
        $this->form->document_type_id = Session::get('selected_document_id');
        $this->form->quantity = Session::get('selected_quantity', 1);
    }

    public function clearSignature()
    {
        $this->signature = '';
        $this->form->signature = '';
        $this->dispatch('signature-cleared');
    }

    public function updatedSignature($value)
    {
        $this->form->signature = $value;
    }

    public function save()
    {
        // Add manual validation for track_strand if grade 11 or 12
        if (in_array($this->form->grade_level, ['Grade 11', 'Grade 12']) && !$this->form->track_strand) {
            $this->addError('form.track_strand', 'Track/Strand is required for senior high school students.');
            return;
        }

        // Ensure signature is present
        if (!$this->form->signature) {
            $this->addError('form.signature', 'Please provide a digital signature.');
            return;
        }

        try {
            // If not grade 11 or 12, clear track_strand
            if (!in_array($this->form->grade_level, ['Grade 11', 'Grade 12'])) {
                $this->form->track_strand = 'N/A';
            }

            $documentRequest = $this->form->save();

            // Send confirmation email
            try {
                Mail::to($this->form->email)->queue(new RequestConfirmation($documentRequest));
            } catch (\Exception $e) {
                Log::error('Failed to send confirmation email: ' . $e->getMessage());
            }

            // Clear session data
            Session::forget(['otp_verified', 'otp_verified_at', 'otp_email', 'otp_purpose', 'selected_document_id', 'selected_quantity']);

            // Redirect to success page
            return $this->redirect(
                route('request.success', ['tracking_id' => $documentRequest->tracking_id]),
                navigate: true
            );
        } catch (\Exception $e) {
            $this->dispatch('notify', type: 'error', message: $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pages.public.request.create-request');
    }
}
