<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|email|max:255|unique:users,email')]
    public string $email = '';

    #[Validate('nullable|min:8')]
    public string $password = '';

    #[Validate('required|in:admin,registrar')]
    public string $role = 'registrar';

    #[Validate('required|in:active,inactive')]
    public string $status = 'active';

    public ?int $userId = null;

    public function setUser(User $user): void
    {
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->status = $user->status;
        $this->password = '';
        
        // Update validation rules for edit mode
        $this->rules['email'] = ['required', 'email', 'max:255', 'unique:users,email,' . $user->id];
        $this->rules['password'] = ['nullable', 'min:8'];
    }

    public function save(): User
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
            return $user;
        }

        return User::create($data);
    }

    public function reset(...$properties): void
    {
        $this->userId = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->role = 'registrar';
        $this->status = 'active';
        
        // Reset validation rules
        $this->rules['email'] = ['required', 'email', 'max:255', 'unique:users,email'];
        $this->rules['password'] = ['required', 'min:8'];
    }
}
