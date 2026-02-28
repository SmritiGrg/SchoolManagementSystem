<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
            'is_active' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Teachers (5 Total)
        |--------------------------------------------------------------------------
        */

        $teachers = [
            ['John Teacher', 'teacher@gmail.com'],
            ['Sarah Smith', 'sarah@gmail.com'],
            ['Michael Brown', 'michael@gmail.com'],
            ['Emily Johnson', 'emily@gmail.com'],
            ['David Wilson', 'david@gmail.com'],
        ];

        foreach ($teachers as $teacher) {
            User::create([
                'name' => $teacher[0],
                'email' => $teacher[1],
                'password' => Hash::make('password'),
                'role' => 'teacher',
                'email_verified_at' => now(),
                'is_active' => true,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Students (6 Total)
        |--------------------------------------------------------------------------
        */

        // Students (6 Base)
        $students = [
            ['Jane Student', 'student@gmail.com', '9800000001'],
            ['Aarav Sharma', 'aarav@gmail.com', '9800000002'],
            ['Sita Rai', 'sita@gmail.com', '9800000003'],
            ['Rohan Gurung', 'rohan@gmail.com', '9800000004'],
            ['Anisha Thapa', 'anisha@gmail.com', '9800000005'],
            ['Bikash Karki', 'bikash@gmail.com', '9800000006'],
        ];

        // Add 20 more students
        for ($i = 1; $i <= 20; $i++) {
            $students[] = [
                "Student $i",
                "student$i@gmail.com",
                '9800000' . str_pad($i + 6, 3, '0', STR_PAD_LEFT),
            ];
        }

        foreach ($students as $student) {
            User::updateOrCreate(
                ['email' => $student[1]],
                [
                    'name' => $student[0],
                    'phone' => $student[2],
                    'password' => Hash::make('password'),
                    'role' => 'student',
                    'email_verified_at' => now(),
                    'is_active' => true,
                ]
            );
        }
    }
}
