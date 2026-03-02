<?php

namespace App\Http\Controllers;

use App\Models\StudentProfile;
use App\Models\User;
use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = StudentProfile::with(['user', 'class']);

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('admission_number', 'like', "%{$search}%")
                  ->orWhere('roll_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by class
        if ($request->has('class_id') && $request->class_id != '') {
            $query->where('class_id', $request->class_id);
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter by gender
        if ($request->has('gender') && $request->gender != '') {
            $query->where('gender', $request->gender);
        }

        $students = $query->orderBy('created_at', 'desc')->paginate(10);
        $classes = Classes::orderBy('class_name')->orderBy('section')->get();
        
        return view('admin.Student.list', compact('students', 'classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Generate next admission number
        $lastStudent = StudentProfile::orderBy('id', 'desc')->first();
        
        if ($lastStudent && preg_match('/ADM-(\d+)/', $lastStudent->admission_number, $matches)) {
            $lastNumber = intval($matches[1]);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }
        
        $nextAdmissionNumber = 'ADM-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        
        // Generate random password
        $generatedPassword = $this->generatePassword();
        
        // Get all classes
        $classes = Classes::orderBy('class_name')->get();
        
        return view('admin.Student.create', compact('nextAdmissionNumber', 'generatedPassword', 'classes'));
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
            'admission_number' => 'required|string|max:50|unique:student_profiles,admission_number',
            'roll_number' => 'nullable|string|max:50',
            'class_id' => 'required|exists:classes,id',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string',
            'parent_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:20',
            'admission_date' => 'nullable|date',
            'status' => 'nullable|in:active,graduated,suspended',
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
                'role' => 'student',
                'is_active' => true,
            ]);

            // Create student profile
            $student = StudentProfile::create([
                'user_id' => $user->id,
                'admission_number' => $validated['admission_number'],
                'roll_number' => $validated['roll_number'],
                'class_id' => $validated['class_id'],
                'date_of_birth' => $validated['date_of_birth'],
                'gender' => $validated['gender'],
                'address' => $validated['address'],
                'parent_name' => $validated['parent_name'],
                'parent_phone' => $validated['parent_phone'],
                'admission_date' => $validated['admission_date'] ?? now(),
                'status' => $validated['status'] ?? 'active',
            ]);

            // Send email with credentials
            try {
                \Mail::to($user->email)->send(new \App\Mail\StudentCredentials($user, $plainPassword, $validated['admission_number']));
            } catch (\Exception $e) {
                \Log::warning('Failed to send student credentials email: ' . $e->getMessage());
            }

            DB::commit();

            return redirect()->route('admin.student.list')
                ->with('success', 'Student created successfully! Login credentials have been sent to their email.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Failed to create student. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentProfile $student)
    {
        $student->load(['user', 'class', 'attendances', 'results']);
        return view('admin.Student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentProfile $student)
    {
        $student->load('user');
        $classes = Classes::orderBy('class_name')->get();
        return view('admin.Student.edit', compact('student', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentProfile $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $student->user_id,
            'phone' => 'required|string|max:20',
            'password' => 'nullable|string|min:8',
            'admission_number' => 'required|string|max:50|unique:student_profiles,admission_number,' . $student->id,
            'roll_number' => 'nullable|string|max:50',
            'class_id' => 'required|exists:classes,id',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string',
            'parent_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:20',
            'admission_date' => 'nullable|date',
            'status' => 'nullable|in:active,graduated,suspended',
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

            $student->user->update($userData);

            // Update student profile
            $student->update([
                'admission_number' => $validated['admission_number'],
                'roll_number' => $validated['roll_number'],
                'class_id' => $validated['class_id'],
                'date_of_birth' => $validated['date_of_birth'],
                'gender' => $validated['gender'],
                'address' => $validated['address'],
                'parent_name' => $validated['parent_name'],
                'parent_phone' => $validated['parent_phone'],
                'admission_date' => $validated['admission_date'],
                'status' => $validated['status'] ?? 'active',
            ]);

            DB::commit();

            return redirect()->route('admin.student.list')
                ->with('success', 'Student updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Failed to update student. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentProfile $student)
    {
        try {
            DB::beginTransaction();
            
            $user = $student->user;
            $student->delete();
            $user->delete();
            
            DB::commit();

            return redirect()->route('admin.student.list')
                ->with('success', 'Student deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.student.list')
                ->with('error', 'Cannot delete student. They may have attendance or result records.');
        }
    }
}
