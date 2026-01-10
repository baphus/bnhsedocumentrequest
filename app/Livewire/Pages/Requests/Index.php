<?php

namespace App\Livewire\Pages\Requests;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Index extends Component
{
    public string $header = 'Document Requests';

    public function render()
    {
        return view('livewire.pages.requests.index');
    }
}
