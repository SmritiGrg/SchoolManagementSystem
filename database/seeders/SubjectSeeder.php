<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            ['Mathematics', 'MATH101'],
            ['English', 'ENG101'],
            ['Science', 'SCI101'],
            ['Social Studies', 'SOC101'],
            ['Computer Science', 'COMP101'],
            ['Nepali', 'NEP101'],
            ['Physics', 'PHY101'],
            ['Chemistry', 'CHEM101'],
            ['Biology', 'BIO101'],
            ['Accountancy', 'ACC101'],
        ];

        foreach ($subjects as $subject) {
            Subject::create([
                'subject_name' => $subject[0],
                'subject_code' => $subject[1],
            ]);
        }
    }
}
