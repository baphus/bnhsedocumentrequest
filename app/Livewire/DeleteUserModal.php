<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class DeleteUserModal extends Component
{
    public bool $isOpen = false;
    public ?int $userId = null;
    public ?User $user = null;

    #[On('openDeleteUserModal')]
    public function openModal($userId)
    {
        \Log::info('Raw userId received:', ['userId' => $userId, 'type' => gettype($userId)]);
        
        if (is_array($userId)) {
            \Log::info('userId is array:', $userId);
            $userId = $userId[0] ?? null;
        }
        
        \Log::info('Final userId after processing: ' . $userId);
        
        // Prevent deleting yourself
        if ($userId === Auth::id()) {
            $this->dispatch('notify', type: 'error', message: 'You cannot delete yourself.');
            return;
        }
        
        $this->userId = $userId;
        $this->user = User::find($userId);
        
        \Log::info('User found:', ['user' => $this->user ? $this->user->id : 'null']);
        
        if (!$this->user) {
            $this->dispatch('notify', type: 'error', message: 'User not found.');
            return;
        }
        
        $this->isOpen = true;
        $this->dispatch('open-modal', 'delete-user-modal');
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->dispatch('close-modal', 'delete-user-modal');
    }

    public function delete()
    {
        if ($this->user && (int)$this->user->id !== (int)Auth::id()) {
            $this->user->delete();
            $this->dispatch('refreshDatatable');
            $this->dispatch('notify', type: 'success', message: 'User deleted successfully.');
            $this->closeModal();
        }
    }

    public function render()
    {
        return view('livewire.delete-user-modal');
    }
}
