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

        $students = [
            ['Jane Student', 'student@gmail.com', '9800000001'],
            ['Aarav Sharma', 'aarav@gmail.com', '9800000002'],
            ['Sita Rai', 'sita@gmail.com', '9800000003'],
            ['Rohan Gurung', 'rohan@gmail.com', '9800000004'],
            ['Anisha Thapa', 'anisha@gmail.com', '9800000005'],
            ['Bikash Karki', 'bikash@gmail.com', '9800000006'],
        ];

        foreach ($students as $student) {
            User::create([
                'name' => $student[0],
                'email' => $student[1],
                'phone' => $student[2],
                'password' => Hash::make('password'),
                'role' => 'student',
                'email_verified_at' => now(),
                'is_active' => true,
            ]);
        }
    }
}
