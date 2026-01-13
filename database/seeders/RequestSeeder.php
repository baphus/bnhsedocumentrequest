<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documents = Document::pluck('id')->toArray();
        $adminId = User::where('email', 'admin@bnhs.edu.ph')->value('id');
        $registrarId = User::where('email', 'registrar@bnhs.edu.ph')->value('id');
        
        $tracks = ['STEM', 'HUMSS', 'GAS', 'ABM', 'TVL-ICT', 'TVL-HE'];
        $gradeLevels = ['Grade 11', 'Grade 12'];
        $sections = ['Rizal', 'Luna', 'Bonifacio', 'Mabini', 'Aguinaldo', 'Del Pilar'];
        $statuses = ['pending', 'processing', 'ready', 'completed'];
        $purposes = [
            'College application requirements',
            'Scholarship application',
            'Employment onboarding',
            'Transfer requirements',
            'Personal records',
            'Government requirements',
            'Immigration purposes',
            'Academic evaluation'
        ];
        
        $firstNames = ['Juan', 'Maria', 'Carlos', 'Ana', 'Jose', 'Sofia', 'Miguel', 'Isabella', 'Gabriel', 'Emily'];
        $lastNames = ['Cruz', 'Reyes', 'Santos', 'Garcia', 'Ramos', 'Mendoza', 'Fernandez', 'Castillo', 'Navarro', 'Torres'];
        $middleNames = ['D.', 'S.', 'J.', 'L.', 'M.', 'P.', 'R.', 'T.', null, null];
        
        // Create a few sample requests
        $sampleRequests = [
            [
                'first_name' => 'Juan',
                'middle_name' => 'D.',
                'last_name' => 'Cruz',
                'email' => 'juan.cruz@example.com',
                'contact_number' => '09171234567',
                'lrn' => '123456789012',
                'grade_level' => 'Grade 12',
                'section' => 'Rizal',
                'track_strand' => 'STEM',
                'school_year_last_attended' => '2023-2024',
                'document_type_id' => $documents[0] ?? null,
                'purpose' => 'College application requirements',
                'signature' => 'data:image/png;base64,' . base64_encode('signature-placeholder-1'),
                'quantity' => 1,
                'status' => 'pending',
                'estimated_completion_date' => Carbon::now()->addDays(5),
                'admin_remarks' => null,
                'internal_notes' => null,
                'processed_by' => null,
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'first_name' => 'Maria',
                'middle_name' => 'S.',
                'last_name' => 'Reyes',
                'email' => 'maria.reyes@example.com',
                'contact_number' => '09179876543',
                'lrn' => '987654321098',
                'grade_level' => 'Grade 11',
                'section' => 'Luna',
                'track_strand' => 'ABM',
                'school_year_last_attended' => '2022-2023',
                'document_type_id' => $documents[1] ?? null,
                'purpose' => 'Scholarship application',
                'signature' => 'data:image/png;base64,' . base64_encode('signature-placeholder-2'),
                'quantity' => 2,
                'status' => 'processing',
                'estimated_completion_date' => Carbon::now()->addDays(3),
                'admin_remarks' => 'Processed by admin',
                'internal_notes' => 'Priority request',
                'processed_by' => $adminId ?? $registrarId,
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(3),
            ],
            [
                'first_name' => 'Carlos',
                'middle_name' => 'J.',
                'last_name' => 'Santos',
                'email' => 'carlos.santos@example.com',
                'contact_number' => '09172345678',
                'lrn' => '456789123456',
                'grade_level' => 'Grade 12',
                'section' => 'Bonifacio',
                'track_strand' => 'GAS',
                'school_year_last_attended' => '2021-2022',
                'document_type_id' => $documents[2] ?? null,
                'purpose' => 'Employment onboarding',
                'signature' => 'data:image/png;base64,' . base64_encode('signature-placeholder-3'),
                'quantity' => 1,
                'status' => 'completed',
                'estimated_completion_date' => Carbon::now()->subDays(1),
                'admin_remarks' => 'Processed by admin',
                'internal_notes' => null,
                'processed_by' => $adminId ?? $registrarId,
                'created_at' => Carbon::now()->subDays(10),
                'updated_at' => Carbon::now()->subDays(1),
            ],
        ];

        foreach ($sampleRequests as $sample) {
            $sample['tracking_id'] = Request::generateTrackingId();
            Request::create($sample);
        }
    }
}
