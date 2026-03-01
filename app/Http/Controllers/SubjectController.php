<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::withCount('classSubjects')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('admin.Subject.list', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Subject.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_name' => 'required|string|max:255',
            'subject_code' => 'required|string|max:50|unique:subjects,subject_code',
        ]);

        Subject::create($validated);

        return redirect()->route('admin.subject.list')
            ->with('success', 'Subject created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        $subject->load(['classSubjects.class', 'classSubjects.teacher']);
        return view('admin.Subject.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        return view('admin.Subject.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'subject_name' => 'required|string|max:255',
            'subject_code' => 'required|string|max:50|unique:subjects,subject_code,' . $subject->id,
        ]);

        $subject->update($validated);

        return redirect()->route('admin.subject.list')
            ->with('success', 'Subject updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        try {
            $subject->delete();
            return redirect()->route('admin.subject.list')
                ->with('success', 'Subject deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.subject.list')
                ->with('error', 'Cannot delete subject. It may be assigned to classes.');
        }
    }
}
