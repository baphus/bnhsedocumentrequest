<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Document;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documents = [
            [
                'name' => 'Form 137 (SF10)',
                'category' => 'Academic Record',
                'processing_days' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Diploma',
                'category' => 'Certification',
                'processing_days' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'Certificate of Enrollment',
                'category' => 'Certification',
                'processing_days' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Good Moral Certificate',
                'category' => 'Certification',
                'processing_days' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Certificate of Grades',
                'category' => 'Academic Record',
                'processing_days' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Transcript of Records',
                'category' => 'Academic Record',
                'processing_days' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($documents as $document) {
            Document::updateOrCreate(
                ['name' => $document['name']],
                $document
            );
        }
    }
}
