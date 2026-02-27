<?php

namespace Database\Seeders;

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

        $count = 1;

        foreach ($teachers as $teacher) {
            $user = User::where('email', $teacher[1])
                ->where('role', 'teacher')
                ->first();

            // If user not found (maybe seeder not run), skip safely
            if (!$user) {
                continue;
            }

            // Avoid duplicate profile if already exists
            TeacherProfile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'employee_id' => 'EMP-' . str_pad($count, 3, '0', STR_PAD_LEFT),
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
