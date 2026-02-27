<?php

namespace Database\Seeders;

use App\Models\Classes;
use App\Models\StudentProfile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            ['Jane Student', 'student@gmail.com', '9800000001'],
            ['Aarav Sharma', 'aarav@gmail.com', '9800000002'],
            ['Sita Rai', 'sita@gmail.com', '9800000003'],
            ['Rohan Gurung', 'rohan@gmail.com', '9800000004'],
            ['Anisha Thapa', 'anisha@gmail.com', '9800000005'],
            ['Bikash Karki', 'bikash@gmail.com', '9800000006'],
        ];

        // Get classes (make sure ClassSeeder ran first)
        $classes = Classes::all();

        if ($classes->isEmpty()) {
            $this->command->info('No classes found. Please run ClassSeeder first.');
            return;
        }

        $rollNumber = 1;
        $admissionCounter = 1;

        foreach ($students as $index => $studentData) {

            $user = User::where('email', $studentData[1])->first();

            if (!$user) {
                continue;
            }

            // Assign student to class (rotating through classes)
            $class = $classes[$index % $classes->count()];

            StudentProfile::create([
                'user_id' => $user->id,
                'roll_number' => $rollNumber++,
                'admission_number' => 'ADM-' . str_pad($admissionCounter++, 4, '0', STR_PAD_LEFT),
                'class_id' => $class->id,
                'date_of_birth' => now()->subYears(rand(10, 15)),
                'gender' => rand(0, 1) ? 'male' : 'female',
                'address' => 'Kathmandu, Nepal',
                'parent_name' => 'Parent of ' . $studentData[0],
                'parent_phone' => $studentData[2],
                'admission_date' => now()->subMonths(rand(1, 12)),
                'status' => 'active',
            ]);
        }
    }
}
