<?php

namespace App\Livewire\Pages\Users;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('User Management')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.pages.users.index');
    }
}
