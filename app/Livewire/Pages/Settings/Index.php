<?php

namespace App\Livewire\Pages\Settings;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Setting;
use Illuminate\Support\Facades\Artisan;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Layout('layouts.app')]
#[Title('Settings')]
class Index extends Component
{
    public $from_email;
    public $phone_number;
    public $location;
    public $availability_times;
    public $maintenance_mode;

    public $original_from_email;
    public $original_phone_number;
    public $original_location;
    public $original_availability_times;
    public $original_maintenance_mode;

    public $isDirty = false;

    public function mount()
    {
        $this->from_email = Setting::where('key', 'from_email')->first()->value;
        $this->phone_number = Setting::where('key', 'phone_number')->first()->value ?? '';
        $this->location = Setting::where('key', 'location')->first()->value ?? '';
        $this->availability_times = Setting::where('key', 'availability_times')->first()->value ?? '';
        $this->maintenance_mode = Setting::where('key', 'maintenance_mode')->first()->value === 'true';

        $this->storeOriginalState();
    }

    public function storeOriginalState()
    {
        $this->original_from_email = $this->from_email;
        $this->original_phone_number = $this->phone_number;
        $this->original_location = $this->location;
        $this->original_availability_times = $this->availability_times;
        $this->original_maintenance_mode = $this->maintenance_mode;
        $this->isDirty = false;
    }

    public function updated($name, $value)
    {
        $this->isDirty = true;
    }

    public function cancel()
    {
        $this->from_email = $this->original_from_email;
        $this->phone_number = $this->original_phone_number;
        $this->location = $this->original_location;
        $this->availability_times = $this->original_availability_times;
        $this->maintenance_mode = $this->original_maintenance_mode;
        $this->isDirty = false;
    }

    public function save()
    {
        $this->validate([
            'from_email' => 'required|email',
            'phone_number' => 'required|string',
            'location' => 'required|string',
            'availability_times' => 'required|string',
        ]);

        Setting::where('key', 'from_email')->first()->update(['value' => $this->from_email]);
        Setting::updateOrCreate(['key' => 'phone_number'], ['value' => $this->phone_number]);
        Setting::updateOrCreate(['key' => 'location'], ['value' => $this->location]);
        Setting::updateOrCreate(['key' => 'availability_times'], ['value' => $this->availability_times]);

        $maintenance_mode_value = $this->maintenance_mode ? 'true' : 'false';
        Setting::where('key', 'maintenance_mode')->first()->update(['value' => $maintenance_mode_value]);

        $this->storeOriginalState();

        $this->dispatch('notify', type: 'success', message: 'Settings saved successfully!');
    }

    public function render()
    {
        return view('livewire.pages.settings.index');
    }
}
