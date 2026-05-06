@extends('layouts.student')

@php
    $pageTitle = 'My Profile';
@endphp

@section('student-content')
<div class="content-header">
    <div class="header-left">
        <h1 class="page-title">My Profile</h1>
        <p class="page-subtitle">View your personal and academic information</p>
    </div>
    <div class="header-right">
        <a href="{{ route('student.profile.edit') }}" class="btn btn-primary">
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
                        <span class="info-value">
                            @if($student->class)
                                {{ $student->class->class_name }}
                                {{ $student->class->section ? '(' . $student->class->section . ')' : '' }}
                                - {{ $student->class->academic_year }}
                            @else
                                N/A
                            @endif
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email</span>
                        <span class="info-value">{{ $student->user->email }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Phone</span>
                        <span class="info-value">{{ $student->user->phone ?? 'N/A' }}</span>
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
                    <div class="info-item-full" style="margin-top: 1rem;">
                        <span class="info-label">Address</span>
                        <span class="info-value">{{ $student->address }}</span>
                    </div>
                @endif
            </div>
        </div>

        {{-- Parent / Guardian --}}
        <div class="card">
            <div class="card-header">
                <h2>Parent / Guardian Information</h2>
            </div>
            <div class="card-body">
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Parent / Guardian Name</span>
                        <span class="info-value">{{ $student->parent_name ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Parent / Guardian Phone</span>
                        <span class="info-value">{{ $student->parent_phone ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Academic Records --}}
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

    {{-- Sidebar --}}
    <div class="details-sidebar">
        <div class="card">
            <div class="card-header">
                <h3>Quick Info</h3>
            </div>
            <div class="card-body">
                <div class="stat-item">
                    <span class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="stat-icon-svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
                        </svg>
                    </span>
                    <div class="stat-content">
                        <span class="stat-value">
                            @if($student->class)
                                {{ $student->class->class_name }}
                                {{ $student->class->section ? '(' . $student->class->section . ')' : '' }}
                            @else
                                N/A
                            @endif
                        </span>
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
                        <span class="stat-label">Joined</span>
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
                    <span class="status-label">Role:</span>
                    <span class="badge badge-info">{{ ucfirst($student->user->role) }}</span>
                </div>
                <div class="status-item">
                    <span class="status-label">Member since:</span>
                    <span>{{ $student->created_at->format('M d, Y') }}</span>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Actions</h3>
            </div>
            <div class="card-body">
                <a href="{{ route('student.profile.edit') }}" class="action-link">
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
