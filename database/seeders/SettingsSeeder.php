<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create(['key' => 'maintenance_mode', 'value' => 'false']);
        Setting::create(['key' => 'from_email', 'value' => 'noreply@bnhs.com']);
    }
}
