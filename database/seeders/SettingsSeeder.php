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
        Setting::firstOrCreate(['key' => 'maintenance_mode'], ['value' => 'false']);
        Setting::firstOrCreate(['key' => 'from_email'], ['value' => 'batonhs303308@deped.gov.ph']);
        Setting::firstOrCreate(['key' => 'phone_number'], ['value' => '(032) 468-8195']);
        Setting::firstOrCreate(['key' => 'location'], ['value' => 'Bato, Toledo City, Cebu']);
        Setting::firstOrCreate(['key' => 'availability_times'], ['value' => 'Mon-Fri: 7:30AM - 5:00PM']);
    }
}
