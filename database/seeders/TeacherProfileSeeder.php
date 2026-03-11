<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\TeacherProfile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = [
            ['John Teacher', 'teacher@gmail.com'],
            ['Sarah Smith', 'sarah@gmail.com'],
            ['Michael Brown', 'michael@gmail.com'],
            ['Emily Johnson', 'emily@gmail.com'],
            ['David Wilson', 'david@gmail.com'],
        ];

        // Get all subjects
        $subjects = Subject::all();

        if ($subjects->isEmpty()) {
            $this->command->info('No subjects found. Please run SubjectSeeder first.');
            return;
        }

        $count = 1;

        foreach ($teachers as $index => $teacher) {

            $user = User::where('email', $teacher[1])
                ->where('role', 'teacher')
                ->first();

            if (!$user) {
                continue;
            }

            // Assign subject (rotate subjects if fewer teachers)
            $subject = $subjects[$index % $subjects->count()];

            TeacherProfile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'employee_id' => 'EMP-' . str_pad($count, 3, '0', STR_PAD_LEFT),
                    'subject_id' => $subject->id,
                    'qualification' => 'Bachelor Degree',
                    'experience_years' => rand(1, 10),
                    'joining_date' => now()->subYears(rand(1, 5))->toDateString(),
                    'salary' => rand(30000, 60000),
                ]
            );

            $count++;
        }
    }
}
