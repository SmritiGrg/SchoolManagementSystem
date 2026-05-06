<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\TeacherProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class TeacherProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = TeacherProfile::with('user')
            ->withCount('classSubjects')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('admin.Teacher.list', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Generate next employee ID
        $lastTeacher = TeacherProfile::orderBy('id', 'desc')->first();
        
        if ($lastTeacher && preg_match('/EMP-(\d+)/', $lastTeacher->employee_id, $matches)) {
            $lastNumber = intval($matches[1]);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }
        
        $nextEmployeeId = 'EMP-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        $subjects = Subject::orderBy('subject_name')->get();
        
        // Generate random password
        $generatedPassword = $this->generatePassword();
        
        return view('admin.Teacher.create', compact('nextEmployeeId', 'generatedPassword', 'subjects'));
    }

    /**
     * Generate a random secure password
     */
    private function generatePassword($length = 12)
    {
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';
        $special = '!@#$%^&*';
        
        $password = '';
        $password .= $uppercase[random_int(0, strlen($uppercase) - 1)];
        $password .= $lowercase[random_int(0, strlen($lowercase) - 1)];
        $password .= $numbers[random_int(0, strlen($numbers) - 1)];
        $password .= $special[random_int(0, strlen($special) - 1)];
        
        $allChars = $uppercase . $lowercase . $numbers . $special;
        for ($i = 4; $i < $length; $i++) {
            $password .= $allChars[random_int(0, strlen($allChars) - 1)];
        }
        
        return str_shuffle($password);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8',
            'employee_id' => 'required|string|max:50|unique:teacher_profiles,employee_id',
            'qualification' => 'nullable|string|max:255',
            'experience_years' => 'nullable|integer|min:0',
            'joining_date' => 'nullable|date',
            'salary' => 'nullable|numeric|min:0',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        DB::beginTransaction();
        try {
            // Store plain password for email
            $plainPassword = $validated['password'];
            
            // Create user account
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'password' => Hash::make($validated['password']),
                'role' => 'teacher',
                'is_active' => true,
            ]);

            // Create teacher profile
            $teacher = TeacherProfile::create([
                'user_id' => $user->id,
                'employee_id' => $validated['employee_id'],
                'qualification' => $validated['qualification'],
                'experience_years' => $validated['experience_years'] ?? 0,
                'joining_date' => $validated['joining_date'],
                'salary' => $validated['salary'],
                'subject_id' => $validated['subject_id'],
            ]);

            // Send email with credentials
            try {
                Mail::to($user->email)->send(new \App\Mail\TeacherCredentials($user, $plainPassword, $validated['employee_id']));
            } catch (\Exception $e) {
                // Log email error but don't fail the creation
                Log::warning('Failed to send teacher credentials email: ' . $e->getMessage());
            }

            DB::commit();

            return redirect()->route('admin.teacher.list')
                ->with('success', 'Teacher created successfully! Login credentials have been sent to their email.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Failed to create teacher. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TeacherProfile $teacher)
    {
        $teacher->load(['user','subject', 'classSubjects.schoolClass', 'classSubjects.subject']);
        return view('admin.Teacher.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TeacherProfile $teacher)
    {
        $teacher->load('user');
        return view('admin.Teacher.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TeacherProfile $teacher)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $teacher->user_id,
            'phone' => 'required|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'employee_id' => 'required|string|max:50|unique:teacher_profiles,employee_id,' . $teacher->id,
            'qualification' => 'nullable|string|max:255',
            'experience_years' => 'nullable|integer|min:0',
            'joining_date' => 'nullable|date',
            'salary' => 'nullable|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            // Update user account
            $userData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
            ];

            if (!empty($validated['password'])) {
                $userData['password'] = Hash::make($validated['password']);
            }

            $teacher->user->update($userData);

            // Update teacher profile
            $teacher->update([
                'employee_id' => $validated['employee_id'],
                'qualification' => $validated['qualification'],
                'experience_years' => $validated['experience_years'] ?? 0,
                'joining_date' => $validated['joining_date'],
                'salary' => $validated['salary'],
            ]);

            DB::commit();

            return redirect()->route('admin.teacher.list')
                ->with('success', 'Teacher updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Failed to update teacher. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TeacherProfile $teacher)
    {
        try {
            DB::beginTransaction();
            
            $user = $teacher->user;
            $teacher->delete();
            $user->delete();
            
            DB::commit();

            return redirect()->route('admin.teacher.list')
                ->with('success', 'Teacher deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.teacher.list')
                ->with('error', 'Cannot delete teacher. They may be assigned to classes.');
        }
    }
}
