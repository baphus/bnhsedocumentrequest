<?php

namespace App\Livewire;

use App\Models\Track;
use Livewire\Component;
use Livewire\Attributes\On;

class DeleteTrackModal extends Component
{
    public bool $isOpen = false;
    public ?int $trackId = null;
    public ?Track $track = null;
    public string $error = '';

    public function mount()
    {
        $this->isOpen = false;
    }

    #[On('openDeleteTrackModal')]
    public function openModal($trackId)
    {
        // Close track modal if it's open
        $this->dispatch('close-modal', 'track-modal');
        
        $this->trackId = $trackId;
        $this->track = Track::find($trackId);
        $this->error = '';
        $this->isOpen = true;
        $this->dispatch('open-modal', 'delete-track-modal');
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->dispatch('close-modal', 'delete-track-modal');
    }

    public function delete()
    {
        if ($this->track) {
            // Check if track is being used in any requests
            $usageCount = \DB::table('requests')
                ->where('track_id', $this->track->id)
                ->count();

            if ($usageCount > 0) {
                $this->error = "Cannot delete this track. It is currently being used in {$usageCount} request(s).";
                return;
            }

            $this->track->delete();
            $this->dispatch('refreshDatatable');
            $this->closeModal();
        }
    }

    public function render()
    {
        return view('livewire.delete-track-modal');
    }
}
