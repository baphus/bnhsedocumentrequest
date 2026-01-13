<?php

namespace App\Livewire\Pages\Settings;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Setting;
use Illuminate\Support\Facades\Artisan;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{

    public $from_email;
    public $maintenance_mode;

    public function mount()
    {
        $this->from_email = Setting::where('key', 'from_email')->first()->value;
        $this->maintenance_mode = Setting::where('key', 'maintenance_mode')->first()->value === 'true';
    }

    public function save()
    {
        $this->validate([
            'from_email' => 'required|email',
        ]);

        Setting::where('key', 'from_email')->first()->update(['value' => $this->from_email]);

        $maintenance_mode_value = $this->maintenance_mode ? 'true' : 'false';

        Setting::where('key', 'maintenance_mode')->first()->update(['value' => $maintenance_mode_value]);



        $this->dispatch('alert', ['type' => 'success', 'message' => 'Settings saved successfully!']);
    }

    public function render()
    {
        return view('livewire.pages.settings.index');
    }
}
