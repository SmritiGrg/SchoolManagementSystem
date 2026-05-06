@extends('layouts.admin')

@php
    $pageTitle = 'Class Details';
@endphp

@section('admin-content')
<div class="content-header">
    <div class="header-left">
        <a href="{{ route('admin.classes.list') }}" class="back-button">← Back</a>
        <h1 class="page-title">{{ $class->class_name }} {{ $class->section ? '('.$class->section.')' : '' }}</h1>
        <p class="page-subtitle">Academic Year: {{ $class->academic_year }}</p>
    </div>
    <div class="header-right">
        <a href="{{ route('admin.classes.edit', $class) }}" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="btn-icon-svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
            </svg>
            Edit Class
        </a>
    </div>
</div>

<div class="details-container">
    <div class="details-main">

        <div class="card">
            <div class="card-header"><h2>Class Information</h2></div>
            <div class="card-body">
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Class Name</span>
                        <span class="info-value">{{ $class->class_name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Section</span>
                        <span class="info-value">{{ $class->section ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Academic Year</span>
                        <span class="info-value">{{ $class->academic_year }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Class Teacher</span>
                        <span class="info-value">{{ $class->classTeacher->user->name ?? 'Not Assigned' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Total Students</span>
                        <span class="info-value"><span class="badge badge-count">{{ $class->students->count() }}</span></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Total Subjects</span>
                        <span class="info-value"><span class="badge badge-count">{{ $class->classSubjects->count() }}</span></span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Students --}}
        <div class="card">
            <div class="card-header">
                <h2>Enrolled Students</h2>
                <span class="badge badge-count">{{ $class->students->count() }}</span>
            </div>
            <div class="card-body">
                @if($class->students->count() > 0)
                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Admission No.</th>
                                    <th>Roll No.</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($class->students as $student)
                                    <tr>
                                        <td>{{ $student->user->name }}</td>
                                        <td><span class="badge badge-code">{{ $student->admission_number }}</span></td>
                                        <td>{{ $student->roll_number ?? 'N/A' }}</td>
                                        <td>
                                            @if($student->status == 'active')
                                                <span class="badge badge-success">Active</span>
                                            @elseif($student->status == 'graduated')
                                                <span class="badge badge-info">Graduated</span>
                                            @else
                                                <span class="badge badge-danger">Suspended</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state-small">
                        <p>No students enrolled in this class yet</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Subjects --}}
        <div class="card">
            <div class="card-header">
                <h2>Assigned Subjects</h2>
                <span class="badge badge-count">{{ $class->classSubjects->count() }}</span>
            </div>
            <div class="card-body">
                @if($class->classSubjects->count() > 0)
                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Code</th>
                                    <th>Teacher</th>
                                    <th>Assigned Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($class->classSubjects as $cs)
                                    <tr>
                                        <td>{{ $cs->subject->subject_name ?? 'N/A' }}</td>
                                        <td><span class="badge badge-code">{{ $cs->subject->subject_code ?? 'N/A' }}</span></td>
                                        <td>{{ $cs->teacher->user->name ?? 'Not Assigned' }}</td>
                                        <td>{{ $cs->created_at->format('M d, Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state-small">
                        <p>No subjects assigned to this class yet</p>
                    </div>
                @endif
            </div>
        </div>

    </div>

    <div class="details-sidebar">
        <div class="card">
            <div class="card-header"><h3>Quick Stats</h3></div>
            <div class="card-body">
                <div class="stat-item">
                    <span class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="stat-icon-svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                    </span>
                    <div class="stat-content">
                        <span class="stat-value">{{ $class->students->count() }}</span>
                        <span class="stat-label">Students</span>
                    </div>
                </div>
                <div class="stat-item">
                    <span class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="stat-icon-svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                    </span>
                    <div class="stat-content">
                        <span class="stat-value">{{ $class->classSubjects->count() }}</span>
                        <span class="stat-label">Subjects</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3>Actions</h3></div>
            <div class="card-body">
                <a href="{{ route('admin.classes.edit', $class) }}" class="action-link">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="action-link-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                    Edit Class
                </a>
                <a href="#delete-modal" class="action-link danger">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="action-link-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                    Delete Class
                </a>
            </div>
        </div>
    </div>
</div>

<div id="delete-modal" class="modal">
    <div class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Confirm Delete</h3>
                <a href="#" class="modal-close">&times;</a>
            </div>
            <div class="modal-body">
                <div class="modal-icon-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                </div>
                <p class="modal-text">Are you sure you want to delete <strong>{{ $class->class_name }} {{ $class->section ? '('.$class->section.')' : '' }}</strong>?</p>
                <p class="modal-subtext">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-secondary">Cancel</a>
                <form action="{{ route('admin.classes.destroy', $class) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
