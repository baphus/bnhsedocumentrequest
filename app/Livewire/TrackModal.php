<?php

namespace App\Livewire;

use App\Models\Track;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Validation\Rule;

class TrackModal extends Component
{
    public bool $isOpen = false;
    public ?int $trackId = null;
    public ?Track $track = null;
    
    public $category;
    public $code;
    public $name;
    public $is_active = true;

    protected function rules()
    {
        return [
            'category' => 'required|string|max:255',
            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('tracks', 'code')->ignore($this->trackId),
            ],
            'name' => 'required|string|max:255',
            'is_active' => 'boolean',
        ];
    }

    public function mount()
    {
        $this->isOpen = false;
    }

    #[On('openTrackModal')]
    public function openModal($trackId = null)
    {
        // Close delete modal if it's open
        $this->dispatch('close-modal', 'delete-track-modal');
        
        $this->resetValidation();
        $this->trackId = $trackId;
        if ($this->trackId) {
            $this->track = Track::find($this->trackId);
            $this->category = $this->track->category;
            $this->code = $this->track->code;
            $this->name = $this->track->name;
            $this->is_active = $this->track->is_active;
        } else {
            $this->track = new Track();
            $this->reset(['category', 'code', 'name', 'is_active']);
            $this->is_active = true;
        }
        $this->isOpen = true;
        $this->dispatch('open-modal', 'track-modal');
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->dispatch('close-modal', 'track-modal');
    }

    public function save()
    {
        $this->validate();

        $data = [
            'category' => $this->category,
            'code' => $this->code,
            'name' => $this->name,
            'is_active' => $this->is_active,
        ];

        if ($this->trackId) {
            $this->track->update($data);
        } else {
            Track::create($data);
        }

        $this->dispatch('refreshDatatable');
        $this->closeModal();
        $this->dispatch('notify', type: 'success', message: 'Track saved successfully.');
    }

    public function render()
    {
        return view('livewire.track-modal');
    }
}
