@extends('layouts.teacher')

@php
    $pageTitle = 'My Profile';
@endphp

@section('teacher-content')
<div class="content-header">
    <div class="header-left">
        <h1 class="page-title">My Profile</h1>
        <p class="page-subtitle">View your personal and professional information</p>
    </div>
    <div class="header-right">
        <a href="{{ route('teacher.profile.edit') }}" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="btn-icon-svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
            </svg>
            Edit Profile
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="alert-icon-svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        {{ session('success') }}
    </div>
@endif

<div class="details-container">
    <div class="details-main">

        {{-- Personal Information --}}
        <div class="card">
            <div class="card-header">
                <h2>Personal Information</h2>
            </div>
            <div class="card-body">
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Full Name</span>
                        <span class="info-value">{{ $teacher->user->name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Employee ID</span>
                        <span class="info-value">
                            <span class="badge badge-code">{{ $teacher->employee_id }}</span>
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email</span>
                        <span class="info-value">{{ $teacher->user->email }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Phone</span>
                        <span class="info-value">{{ $teacher->user->phone ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Qualification</span>
                        <span class="info-value">{{ $teacher->qualification ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Assigned Subject</span>
                        <span class="info-value">
                            @if($teacher->subject)
                                {{ $teacher->subject->subject_name }}
                                <span class="badge badge-code">{{ $teacher->subject->subject_code }}</span>
                            @else
                                N/A
                            @endif
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Experience</span>
                        <span class="info-value">{{ $teacher->experience_years }} years</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Joining Date</span>
                        <span class="info-value">{{ $teacher->joining_date ? $teacher->joining_date->format('M d, Y') : 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Assigned Classes & Subjects --}}
        <div class="card">
            <div class="card-header">
                <h2>Assigned Classes & Subjects</h2>
                <span class="badge badge-count">{{ $teacher->classSubjects->count() }} assignments</span>
            </div>
            <div class="card-body">
                @if($teacher->classSubjects->count() > 0)
                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Class</th>
                                    <th>Subject</th>
                                    <th>Subject Code</th>
                                    <th>Assigned Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($teacher->classSubjects as $classSubject)
                                    <tr>
                                        <td>{{ $classSubject->schoolClass->class_name ?? 'N/A' }}</td>
                                        <td>{{ $classSubject->subject->subject_name ?? 'N/A' }}</td>
                                        <td>
                                            <span class="badge badge-code">{{ $classSubject->subject->subject_code ?? 'N/A' }}</span>
                                        </td>
                                        <td>{{ $classSubject->created_at->format('M d, Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state-small">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="empty-icon-svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                        <p>You are not assigned to any class yet</p>
                    </div>
                @endif
            </div>
        </div>

    </div>

    {{-- Sidebar --}}
    <div class="details-sidebar">
        <div class="card">
            <div class="card-header">
                <h3>Quick Stats</h3>
            </div>
            <div class="card-body">
                <div class="stat-item">
                    <span class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="stat-icon-svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                        </svg>
                    </span>
                    <div class="stat-content">
                        <span class="stat-value">{{ $teacher->classSubjects->unique('class_id')->count() }}</span>
                        <span class="stat-label">Classes</span>
                    </div>
                </div>
                <div class="stat-item">
                    <span class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="stat-icon-svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                    </span>
                    <div class="stat-content">
                        <span class="stat-value">{{ $teacher->classSubjects->unique('subject_id')->count() }}</span>
                        <span class="stat-label">Subjects</span>
                    </div>
                </div>
                <div class="stat-item">
                    <span class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="stat-icon-svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </span>
                    <div class="stat-content">
                        <span class="stat-value">{{ $teacher->experience_years }} yrs</span>
                        <span class="stat-label">Experience</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Account Status</h3>
            </div>
            <div class="card-body">
                <div class="status-item">
                    <span class="status-label">Account:</span>
                    @if($teacher->user->is_active)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-danger">Inactive</span>
                    @endif
                </div>
                <div class="status-item">
                    <span class="status-label">Role:</span>
                    <span class="badge badge-info">{{ ucfirst($teacher->user->role) }}</span>
                </div>
                <div class="status-item">
                    <span class="status-label">Member since:</span>
                    <span>{{ $teacher->created_at->format('M d, Y') }}</span>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Actions</h3>
            </div>
            <div class="card-body">
                <a href="{{ route('teacher.profile.edit') }}" class="action-link">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="action-link-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                    Edit Profile
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
