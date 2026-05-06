<?php

namespace App\Http\Controllers;

use App\Models\ClassSubject;
use App\Models\Classes;
use App\Models\StudentProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class TeacherController extends Controller
{
    public function courses(Request $request)
    {
        $teacher = Auth::user()->teacherProfile;

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')
                ->with('error', 'Teacher profile not found.');
        }

        $courses = ClassSubject::with(['subject', 'schoolClass'])
            ->where('teacher_id', $teacher->id)
            ->paginate(10);

        return view('teacher.courses', compact('courses'));
    }

    public function students(Request $request)
    {
        $teacher = Auth::user()->teacherProfile;

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')
                ->with('error', 'Teacher profile not found.');
        }

        // Get all classes taught by this teacher
        $teacherClassIds = ClassSubject::where('teacher_id', $teacher->id)
            ->pluck('class_id')
            ->unique();

        // Get students from those classes
        $query = StudentProfile::with(['user', 'class'])
            ->whereIn('class_id', $teacherClassIds);

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })->orWhere('admission_number', 'like', "%{$search}%")
              ->orWhere('roll_number', 'like', "%{$search}%");
        }

        // Apply class filter
        if ($request->filled('class_id')) {
            $query->where('class_id', $request->class_id);
        }

        $students = $query->paginate(10);

        // Get classes for filter dropdown
        $classes = Classes::whereIn('id', $teacherClassIds)->get();

        return view('teacher.students', compact('students', 'classes'));
    }

    public function profile()
    {
        $teacher = Auth::user()->teacherProfile()->with(['subject', 'classSubjects.schoolClass', 'classSubjects.subject'])->first();

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')
                ->with('error', 'Teacher profile not found.');
        }

        return view('teacher.profile', compact('teacher'));
    }

    public function editProfile()
    {
        $teacher = Auth::user()->teacherProfile()->with('subject')->first();

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')
                ->with('error', 'Teacher profile not found.');
        }

        return view('teacher.profile-edit', compact('teacher'));
    }

    public function updateProfile(Request $request)
    {
        $user    = Auth::user();
        $teacher = $user->teacherProfile;

        if (!$teacher) {
            return redirect()->route('teacher.dashboard')
                ->with('error', 'Teacher profile not found.');
        }

        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email,' . $user->id,
            'phone'            => 'nullable|string|max:20',
            'password'         => ['nullable', 'confirmed', Password::min(8)],
            'qualification'    => 'nullable|string|max:255',
            'experience_years' => 'nullable|integer|min:0|max:60',
        ]);

        // Update user account fields
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Update teacher profile fields
        $teacher->update([
            'qualification'    => $request->qualification,
            'experience_years' => $request->experience_years,
        ]);

        return redirect()->route('teacher.profile')
            ->with('success', 'Profile updated successfully.');
    }
}
