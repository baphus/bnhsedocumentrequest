<?php

namespace App\Livewire\Pages\Settings;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Settings')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.pages.settings.index');
    }
}
