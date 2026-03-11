@extends('layouts.admin')

@php
    $pageTitle = 'Teacher Class Assignments';
@endphp

@section('admin-content')
    <div class="content-header">
        <div class="header-left">
            <h1 class="page-title">Teacher Class Assignments</h1>
            <p class="page-subtitle">Manage teacher assignments to classes</p>
        </div>
        <div class="header-right">
            <a href="{{ route('admin.class-subject.create') }}" class="btn btn-primary">+ Assign Teacher</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Class</th>
                            <th>Teacher</th>
                            <th>Subject</th>
                            <th>Assigned Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assignments as $assignment)
                            <tr>
                                <td>
                                    {{ $assignment->schoolClass->class_name }}
                                    {{ $assignment->schoolClass->section ? '(' . $assignment->schoolClass->section . ')' : '' }}
                                    - {{ $assignment->schoolClass->academic_year }}
                                </td>
                                <td>{{ $assignment->teacher->user->name ?? 'N/A' }}</td>
                                <td>
                                    {{ $assignment->subject->subject_name ?? 'N/A' }}
                                    @if($assignment->subject)
                                        ({{ $assignment->subject->subject_code }})
                                    @endif
                                </td>
                                <td>{{ $assignment->created_at->format('M d, Y') }}</td>
                                <td>
                                    <form action="{{ route('admin.class-subject.destroy', $assignment) }}" method="POST" onsubmit="return confirm('Delete this assignment?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No assignments found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $assignments->links() }}
        </div>
    </div>
@endsection