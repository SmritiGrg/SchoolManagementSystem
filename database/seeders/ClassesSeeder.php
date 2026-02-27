<?php

namespace Database\Seeders;

use App\Models\Classes;
use App\Models\TeacherProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $academicYear = '2082/83';

        // Get all teachers
        $teachers = TeacherProfile::all();

        if ($teachers->isEmpty()) {
            $this->command->info('No teachers found. Please run TeacherProfileSeeder first.');
            return;
        }

        $teacherIndex = 0;
        $totalTeachers = $teachers->count();

        // Create Grade 1 to Grade 10
        for ($grade = 1; $grade <= 10; $grade++) {

            foreach (['A', 'B'] as $section) {

                Classes::create([
                    'class_name' => 'Grade ' . $grade,
                    'section' => $section,
                    'academic_year' => $academicYear,
                    'class_teacher_id' => $teachers[$teacherIndex % $totalTeachers]->id,
                ]);

                $teacherIndex++;
            }
        }
    }
}
