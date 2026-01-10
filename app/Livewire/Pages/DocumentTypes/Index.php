<?php

namespace App\Livewire\Pages\DocumentTypes;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Document Types')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.pages.document-types.index');
    }
}
