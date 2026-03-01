@extends('layouts.admin')

@php 
    $pageTitle = 'Subject Details'; 
@endphp

@section('admin-content')
<div class="content-header">
    <div class="header-left">
        <a href="{{ route('admin.subject.list') }}" class="back-button">← Back</a>
        <h1 class="page-title">{{ $subject->subject_name }}</h1>
        <p class="page-subtitle">Subject Code: {{ $subject->subject_code }}</p>
    </div>
    <div class="header-right">
        <a href="{{ route('admin.subject.edit', $subject) }}" class="btn btn-primary">
            <span class="btn-icon">✏️</span>
            Edit Subject
        </a>
    </div>
</div>

<div class="details-container">
    <div class="details-main">
        <div class="card">
            <div class="card-header">
                <h2>Subject Information</h2>
            </div>
            <div class="card-body">
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Subject Name</span>
                        <span class="info-value">{{ $subject->subject_name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Subject Code</span>
                        <span class="info-value">
                            <span class="badge badge-code">{{ $subject->subject_code }}</span>
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Created Date</span>
                        <span class="info-value">{{ $subject->created_at->format('M d, Y h:i A') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Last Updated</span>
                        <span class="info-value">{{ $subject->updated_at->format('M d, Y h:i A') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Assigned Classes</h2>
                <span class="badge badge-count">{{ $subject->classSubjects->count() }} classes</span>
            </div>
            <div class="card-body">
                @if($subject->classSubjects->count() > 0)
                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Class Name</th>
                                    <th>Teacher</th>
                                    <th>Assigned Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subject->classSubjects as $classSubject)
                                    <tr>
                                        <td>{{ $classSubject->class->class_name ?? 'N/A' }}</td>
                                        <td>{{ $classSubject->teacher->user->name ?? 'Not Assigned' }}</td>
                                        <td>{{ $classSubject->created_at->format('M d, Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state-small">
                        <span class="empty-icon">📚</span>
                        <p>This subject is not assigned to any class yet</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="details-sidebar">
        <div class="card">
            <div class="card-header">
                <h3>Quick Stats</h3>
            </div>
            <div class="card-body">
                <div class="stat-item">
                    <span class="stat-icon">🏫</span>
                    <div class="stat-content">
                        <span class="stat-value">{{ $subject->classSubjects->count() }}</span>
                        <span class="stat-label">Classes</span>
                    </div>
                </div>
                <div class="stat-item">
                    <span class="stat-icon">👨‍🏫</span>
                    <div class="stat-content">
                        <span class="stat-value">{{ $subject->classSubjects->unique('teacher_id')->count() }}</span>
                        <span class="stat-label">Teachers</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Actions</h3>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.subject.edit', $subject) }}" class="action-link">
                    <span>✏️</span> Edit Subject
                </a>
                <form action="{{ route('admin.subject.destroy', $subject) }}" method="POST" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="action-link danger" onclick="return confirm('Are you sure you want to delete this subject?')">
                        <span>🗑️</span> Delete Subject
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
