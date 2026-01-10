<?php

namespace App\Livewire\Forms;

use App\Models\Request as DocumentRequest;
use Livewire\Attributes\Validate;
use Livewire\Form;

class RequestStatusForm extends Form
{
    #[Validate('required|in:pending,processing,ready,completed')]
    public string $status = 'pending';

    #[Validate('nullable|string|max:1000')]
    public string $remarks = '';

    public ?int $requestId = null;

    public function setRequest(DocumentRequest $request): void
    {
        $this->requestId = $request->id;
        $this->status = $request->status;
        $this->remarks = '';
    }

    public function update(): DocumentRequest
    {
        $this->validate();

        $request = DocumentRequest::findOrFail($this->requestId);
        
        $oldStatus = $request->status;
        $request->update([
            'status' => $this->status,
        ]);

        // Create log entry if status changed
        if ($oldStatus !== $this->status) {
            $request->logs()->create([
                'user_id' => auth()->id(),
                'action' => "Status changed from {$oldStatus} to {$this->status}",
                'remarks' => $this->remarks,
            ]);
        }

        return $request->fresh();
    }
}
