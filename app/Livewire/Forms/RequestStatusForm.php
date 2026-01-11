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
        
        $data = [
            'status' => $this->status,
        ];

        // Only update remarks if provided (or maybe we should overwrite? Use logic based on requirement)
        // Assuming we want to update admin_remarks if user typed something
        if (!empty($this->remarks)) {
            $data['admin_remarks'] = $this->remarks;
        }

        $request->update($data);

        return $request->fresh();
    }
}
