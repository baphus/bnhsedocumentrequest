<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('settings')->insert([
            ['key' => 'phone_number', 'value' => '(032) 468-8195', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'location', 'value' => 'Bato, Toledo City, Cebu', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'availability_times', 'value' => 'Mon-Fri: 7:30AM - 5:00PM', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('settings')->whereIn('key', ['phone_number', 'location', 'availability_times'])->delete();
    }
};
