@extends('layouts.admin')

@php 
    $pageTitle = 'Student Details'; 
@endphp

@section('admin-content')
<div class="content-header">
    <div class="header-left">
        <a href="{{ route('admin.student.list') }}" class="back-button">← Back</a>
        <h1 class="page-title">{{ $student->user->name }}</h1>
        <p class="page-subtitle">Admission Number: {{ $student->admission_number }}</p>
    </div>
    <div class="header-right">
        <a href="{{ route('admin.student.edit', $student) }}" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="btn-icon-svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
            </svg>
            Edit Student
        </a>
    </div>
</div>

<div class="details-container">
    <div class="details-main">
        <div class="card">
            <div class="card-header">
                <h2>Personal Information</h2>
            </div>
            <div class="card-body">
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Full Name</span>
                        <span class="info-value">{{ $student->user->name }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Admission Number</span>
                        <span class="info-value">
                            <span class="badge badge-code">{{ $student->admission_number }}</span>
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Roll Number</span>
                        <span class="info-value">{{ $student->roll_number ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Class</span>
                        <span class="info-value">{{ $student->class->class_name ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email</span>
                        <span class="info-value">{{ $student->user->email }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Phone</span>
                        <span class="info-value">{{ $student->user->phone }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Date of Birth</span>
                        <span class="info-value">{{ $student->date_of_birth ? $student->date_of_birth->format('M d, Y') : 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Gender</span>
                        <span class="info-value">{{ ucfirst($student->gender ?? 'N/A') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Admission Date</span>
                        <span class="info-value">{{ $student->admission_date ? $student->admission_date->format('M d, Y') : 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Status</span>
                        <span class="info-value">
                            @if($student->status == 'active')
                                <span class="badge badge-success">Active</span>
                            @elseif($student->status == 'graduated')
                                <span class="badge badge-info">Graduated</span>
                            @else
                                <span class="badge badge-danger">Suspended</span>
                            @endif
                        </span>
                    </div>
                </div>

                @if($student->address)
                    <div class="info-item-full">
                        <span class="info-label">Address</span>
                        <span class="info-value">{{ $student->address }}</span>
                    </div>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Parent/Guardian Information</h2>
            </div>
            <div class="card-body">
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Parent/Guardian Name</span>
                        <span class="info-value">{{ $student->parent_name ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Parent/Guardian Phone</span>
                        <span class="info-value">{{ $student->parent_phone ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2>Academic Records</h2>
            </div>
            <div class="card-body">
                <div class="academic-stats">
                    <div class="stat-box">
                        <div class="stat-icon-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="stat-icon-svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                            </svg>
                        </div>
                        <div class="stat-content">
                            <span class="stat-value">{{ $student->attendances->count() }}</span>
                            <span class="stat-label">Attendance Records</span>
                        </div>
                    </div>

                    <div class="stat-box">
                        <div class="stat-icon-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="stat-icon-svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                            </svg>
                        </div>
                        <div class="stat-content">
                            <span class="stat-value">{{ $student->results->count() }}</span>
                            <span class="stat-label">Exam Results</span>
                        </div>
                    </div>
                </div>
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
                    <span class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="stat-icon-svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                        </svg>
                    </span>
                    <div class="stat-content">
                        <span class="stat-value">{{ $student->class->class_name ?? 'N/A' }}</span>
                        <span class="stat-label">Current Class</span>
                    </div>
                </div>
                <div class="stat-item">
                    <span class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="stat-icon-svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                        </svg>
                    </span>
                    <div class="stat-content">
                        <span class="stat-value">{{ $student->admission_date ? $student->admission_date->diffForHumans() : 'N/A' }}</span>
                        <span class="stat-label">Admission Date</span>
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
                    <span class="status-label">Status:</span>
                    @if($student->status == 'active')
                        <span class="badge badge-success">Active</span>
                    @elseif($student->status == 'graduated')
                        <span class="badge badge-info">Graduated</span>
                    @else
                        <span class="badge badge-danger">Suspended</span>
                    @endif
                </div>
                <div class="status-item">
                    <span class="status-label">Account:</span>
                    @if($student->user->is_active)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-danger">Inactive</span>
                    @endif
                </div>
                <div class="status-item">
                    <span class="status-label">Role:</span>
                    <span class="badge badge-info">{{ ucfirst($student->user->role) }}</span>
                </div>
                <div class="status-item">
                    <span class="status-label">Created:</span>
                    <span>{{ $student->created_at->format('M d, Y') }}</span>
                </div>
                <div class="status-item">
                    <span class="status-label">Last Updated:</span>
                    <span>{{ $student->updated_at->format('M d, Y') }}</span>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Actions</h3>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.student.edit', $student) }}" class="action-link">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="action-link-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                    Edit Student
                </a>
                <a href="#delete-modal" class="action-link danger">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="action-link-icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                    Delete Student
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
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
                <p class="modal-text">Are you sure you want to delete <strong>{{ $student->user->name }}</strong>?</p>
                <p class="modal-subtext">This will also delete their user account. This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-secondary">Cancel</a>
                <form action="{{ route('admin.student.destroy', $student) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
