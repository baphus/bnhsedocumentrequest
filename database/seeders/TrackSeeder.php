<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Track;

class TrackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tracks = [
            [
                'category' => 'Academic',
                'code' => 'STEM',
                'name' => 'Science, Technology, Engineering and Mathematics',
                'is_active' => true,
            ],
            [
                'category' => 'Academic',
                'code' => 'HUMSS',
                'name' => 'Humanities and Social Sciences',
                'is_active' => true,
            ],
            [
                'category' => 'Academic',
                'code' => 'GAS',
                'name' => 'General Academic Strand',
                'is_active' => true,
            ],
            [
                'category' => 'Academic',
                'code' => 'ABM',
                'name' => 'Accountancy, Business and Management',
                'is_active' => true,
            ],
            [
                'category' => 'TVL',
                'code' => 'TVL-ICT',
                'name' => 'Technical-Vocational-Livelihood - Information and Communications Technology',
                'is_active' => true,
            ],
            [
                'category' => 'TVL',
                'code' => 'TVL-HE',
                'name' => 'Technical-Vocational-Livelihood - Home Economics',
                'is_active' => true,
            ],
        ];

        foreach ($tracks as $track) {
            Track::updateOrCreate(
                ['code' => $track['code']],
                $track
            );
        }
    }
}
