<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\ClassSubject;
use App\Models\TeacherProfile;
use Illuminate\Http\Request;

class ClassSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assignments = ClassSubject::with(['schoolClass', 'subject', 'teacher.user'])
            ->latest()
            ->paginate(10);

        return view('admin.ClassSubject.list', compact('assignments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = Classes::orderByRaw("CAST(REPLACE(class_name, 'Grade ', '') AS UNSIGNED) ASC")
            ->orderBy('section')
            ->get();

        $teachers = TeacherProfile::with(['user', 'subject'])
            ->whereNotNull('subject_id')
            ->get();

        return view('admin.ClassSubject.create', compact('classes', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_id' => ['required', 'exists:classes,id'],
            'teacher_id' => ['required', 'exists:teacher_profiles,id'],
        ]);

        $teacher = TeacherProfile::with('subject')->findOrFail($validated['teacher_id']);

        if (!$teacher->subject_id) {
            return back()->withInput()->with('error', 'Selected teacher has no subject assigned.');
        }

        $exists = ClassSubject::where('class_id', $validated['class_id'])
            ->where('subject_id', $teacher->subject_id)
            ->exists();

        if ($exists) {
            return back()->withInput()->with(
                'error',
                'This subject is already assigned to this class.'
            );
        }

        ClassSubject::create([
            'class_id' => $validated['class_id'],
            'teacher_id' => $teacher->id,
            'subject_id' => $teacher->subject_id,
        ]);

        return redirect()
            ->route('admin.class-subject.list')
            ->with('success', 'Teacher assigned to class successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassSubject $classSubject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassSubject $classSubject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassSubject $classSubject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassSubject $classSubject)
    {
        $classSubject->delete();

        return redirect()
            ->route('admin.class-subject.list')
            ->with('success', 'Assignment deleted successfully.');
    }
}
