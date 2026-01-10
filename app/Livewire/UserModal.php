<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class UserModal extends Component
{
    public bool $isOpen = false;
    public ?int $userId = null;
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $role = 'registrar';
    public string $status = 'active';

    public function mount()
    {
        $this->isOpen = false;
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->userId),
            ],
            'password' => $this->userId ? 'nullable|min:8' : 'required|min:8',
            'role' => 'required|in:admin,registrar',
            'status' => 'required|in:active,inactive',
        ];
    }

    #[On('openUserModal')]
    public function openModal($userId = null)
    {
        // Close delete modal if it's open
        $this->dispatch('close-modal', 'delete-user-modal');
        
        $this->resetValidation();
        $this->reset(['name', 'email', 'password', 'role', 'status', 'userId']);

        if ($userId) {
            if (is_array($userId)) {
                $userId = $userId['userId'] ?? $userId['id'] ?? $userId[0] ?? null;
            }
            $this->userId = $userId;
            $user = User::find($userId);
            if ($user) {
                $this->name = $user->name;
                $this->email = $user->email;
                $this->role = $user->role;
                $this->status = $user->status;
            }
        }
        $this->isOpen = true;
        $this->dispatch('open-modal', 'user-management-modal');
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->dispatch('close-modal', 'user-management-modal');
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'status' => $this->status,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->userId) {
            $user = User::findOrFail($this->userId);
            $user->update($data);
            $message = 'User updated successfully.';
        } else {
            User::create($data);
            $message = 'User created successfully.';
        }

        $this->closeModal();
        $this->dispatch('refreshDatatable'); // Custom refresh for Rappasoft table
        $this->dispatch('notify', type: 'success', message: $message);
    }

    public function render()
    {
        return view('livewire.user-modal');
    }
}
