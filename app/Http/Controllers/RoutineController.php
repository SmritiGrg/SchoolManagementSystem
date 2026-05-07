<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\ClassSubject;
use App\Models\Routine;
use App\Models\Subject;
use App\Models\TeacherProfile;
use Illuminate\Http\Request;

class RoutineController extends Controller
{
    const DAYS = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];

    public function index(Request $request)
    {
        $classes = Classes::with('classTeacher.user')->orderBy('class_name')->get();
        $selectedClass = null;
        $routine = [];

        if ($request->filled('class_id')) {
            $selectedClass = Classes::findOrFail($request->class_id);

            // Load all slots for this class, keyed by day
            $slots = Routine::with(['subject', 'teacher.user'])
                ->where('class_id', $selectedClass->id)
                ->orderBy('start_time')
                ->get();

            foreach (self::DAYS as $day) {
                $routine[$day] = $slots->where('day', $day)->values();
            }
        }

        return view('admin.Routine.index', compact('classes', 'selectedClass', 'routine'));
    }

    public function create(Request $request)
    {
        $classes  = Classes::orderBy('class_name')->get();
        $subjects = Subject::orderBy('subject_name')->get();
        $teachers = TeacherProfile::with('user')->get();

        $selectedClassId = $request->class_id;

        // If a class is selected, only show its assigned subjects/teachers
        $classSubjects = $selectedClassId
            ? ClassSubject::with(['subject', 'teacher.user'])
                ->where('class_id', $selectedClassId)->get()
            : collect();

        return view('admin.Routine.create', compact(
            'classes', 'subjects', 'teachers', 'selectedClassId', 'classSubjects'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id'   => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teacher_profiles,id',
            'day'        => 'required|in:' . implode(',', self::DAYS),
            'start_time' => 'required|date_format:H:i',
            'end_time'   => 'required|date_format:H:i|after:start_time',
        ]);

        // Check teacher not already busy at this time on this day
        // True overlap: new_start < existing_end AND new_end > existing_start
        $conflict = Routine::where('teacher_id', $request->teacher_id)
            ->where('day', $request->day)
            ->where('start_time', '<', $request->end_time)
            ->where('end_time',   '>', $request->start_time)
            ->exists();

        if ($conflict) {
            return back()->withInput()
                ->with('error', 'This teacher already has a class at the selected time slot.');
        }

        Routine::create($request->only('class_id','subject_id','teacher_id','day','start_time','end_time'));

        return redirect()->route('admin.routine.index', ['class_id' => $request->class_id])
            ->with('success', 'Routine slot added successfully.');
    }

    public function edit(Routine $routine)
    {
        $classSubjects = ClassSubject::with(['subject', 'teacher.user'])
            ->where('class_id', $routine->class_id)->get();

        return view('admin.Routine.edit', compact('routine', 'classSubjects'));
    }

    public function update(Request $request, Routine $routine)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teacher_profiles,id',
            'day'        => 'required|in:' . implode(',', self::DAYS),
            'start_time' => 'required|date_format:H:i',
            'end_time'   => 'required|date_format:H:i|after:start_time',
        ]);

        $conflict = Routine::where('teacher_id', $request->teacher_id)
            ->where('day', $request->day)
            ->where('id', '!=', $routine->id)
            ->where('start_time', '<', $request->end_time)
            ->where('end_time',   '>', $request->start_time)
            ->exists();

        if ($conflict) {
            return back()->withInput()
                ->with('error', 'This teacher already has a class at the selected time slot.');
        }

        $routine->update($request->only('subject_id','teacher_id','day','start_time','end_time'));

        return redirect()->route('admin.routine.index', ['class_id' => $routine->class_id])
            ->with('success', 'Routine slot updated successfully.');
    }

    public function destroy(Routine $routine)
    {
        $classId = $routine->class_id;
        $routine->delete();

        return redirect()->route('admin.routine.index', ['class_id' => $classId])
            ->with('success', 'Routine slot deleted.');
    }

    // AJAX: get subjects+teachers for a class
    public function getClassSubjects(Request $request)
    {
        $classSubjects = ClassSubject::with(['subject', 'teacher.user'])
            ->where('class_id', $request->class_id)
            ->get()
            ->map(fn($cs) => [
                'subject_id'   => $cs->subject_id,
                'subject_name' => $cs->subject->subject_name,
                'teacher_id'   => $cs->teacher_id,
                'teacher_name' => $cs->teacher->user->name ?? 'N/A',
            ]);

        return response()->json($classSubjects);
    }
}
