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
        
        // Generate 20 random requests
        for ($i = 0; $i < 20; $i++) {
            $status = $statuses[array_rand($statuses)];
            $createdAt = Carbon::now()->subDays(rand(1, 30));
            $estimatedDays = rand(3, 7);
            
            $request = [
                'email' => 'student' . ($i + 1) . '@example.com',
                'contact_number' => '09' . rand(10, 99) . rand(1000000, 9999999),
                'first_name' => $firstNames[array_rand($firstNames)],
                'middle_name' => $middleNames[array_rand($middleNames)],
                'last_name' => $lastNames[array_rand($lastNames)],
                'lrn' => str_pad(rand(100000000, 999999999), 12, '0', STR_PAD_LEFT),
                'grade_level' => $gradeLevels[array_rand($gradeLevels)],
                'section' => $sections[array_rand($sections)],
                'track_strand' => $tracks[array_rand($tracks)],
                'school_year_last_attended' => rand(2020, 2024) . '-' . (2021 + rand(0, 4)),
                'document_type_id' => $documents[array_rand($documents)],
                'purpose' => $purposes[array_rand($purposes)],
                'signature' => 'data:image/png;base64,' . base64_encode('signature-placeholder-' . $i),
                'quantity' => rand(1, 3),
                'status' => $status,
                'estimated_completion_date' => $createdAt->copy()->addDays($estimatedDays),
                'admin_remarks' => $status !== 'pending' ? 'Processed by admin' : null,
                'internal_notes' => rand(0, 1) ? 'Priority request' : null,
                'processed_by' => $status !== 'pending' ? ($adminId ?? $registrarId) : null,
                'created_at' => $createdAt,
                'updated_at' => $createdAt->copy()->addHours(rand(1, 24)),
            ];
            
            Request::create($request);
        }
    }
}
