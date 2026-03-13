<?php

namespace App\Http\Controllers;

use App\Models\ClassSubject;
use App\Models\Classes;
use App\Models\StudentProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
