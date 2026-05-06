<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\TeacherProfile;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function index(Request $request)
    {
        $query = Classes::withCount(['students', 'classSubjects'])
            ->with('classTeacher.user');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('class_name', 'like', "%{$search}%")
                  ->orWhere('section', 'like', "%{$search}%")
                  ->orWhere('academic_year', 'like', "%{$search}%");
            });
        }

        if ($request->filled('academic_year')) {
            $query->where('academic_year', $request->academic_year);
        }

        $classes = $query->orderBy('academic_year', 'desc')->orderBy('class_name')->paginate(10);
        $academicYears = Classes::distinct()->orderBy('academic_year', 'desc')->pluck('academic_year');

        return view('admin.Classes.list', compact('classes', 'academicYears'));
    }

    public function create()
    {
        // Only show teachers not already assigned as class teacher
        $teachers = TeacherProfile::with('user')
            ->whereDoesntHave('classTeacher')
            ->get();
        return view('admin.Classes.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_name'       => 'required|string|max:255',
            'section'          => 'nullable|string|max:10',
            'academic_year'    => ['required', 'string', 'regex:/^\d{4}-\d{4}$/'],
            'class_teacher_id' => 'nullable|exists:teacher_profiles,id|unique:classes,class_teacher_id',
        ]);

        Classes::create($request->only('class_name', 'section', 'academic_year', 'class_teacher_id'));

        return redirect()->route('admin.classes.list')
            ->with('success', 'Class created successfully.');
    }

    public function show(Classes $class)
    {
        $class->load(['classTeacher.user', 'students.user', 'classSubjects.subject', 'classSubjects.teacher.user']);
        return view('admin.Classes.show', compact('class'));
    }

    public function edit(Classes $class)
    {
        // Show teachers who are unassigned OR are already the teacher of this class
        $teachers = TeacherProfile::with('user')
            ->where(function ($q) use ($class) {
                $q->whereDoesntHave('classTeacher')
                  ->orWhere('id', $class->class_teacher_id);
            })
            ->get();
        $class->load(['students', 'classSubjects']);
        return view('admin.Classes.edit', compact('class', 'teachers'));
    }

    public function update(Request $request, Classes $class)
    {
        $request->validate([
            'class_name'       => 'required|string|max:255',
            'section'          => 'nullable|string|max:10',
            'academic_year'    => ['required', 'string', 'regex:/^\d{4}-\d{4}$/'],
            'class_teacher_id' => 'nullable|exists:teacher_profiles,id|unique:classes,class_teacher_id,' . $class->id,
        ]);

        $class->update($request->only('class_name', 'section', 'academic_year', 'class_teacher_id'));

        return redirect()->route('admin.classes.list')
            ->with('success', 'Class updated successfully.');
    }

    public function destroy(Classes $class)
    {
        $class->delete();
        return redirect()->route('admin.classes.list')
            ->with('success', 'Class deleted successfully.');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate(['ids' => 'required|array', 'ids.*' => 'exists:classes,id']);
        Classes::whereIn('id', $request->ids)->delete();
        return redirect()->route('admin.classes.list')
            ->with('success', count($request->ids) . ' class(es) deleted successfully.');
    }
}
