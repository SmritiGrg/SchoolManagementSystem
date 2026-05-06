@extends('layouts.student')

@php
    $pageTitle = 'Student Dashboard';
@endphp

@section('student-content')
    <div class="dashboard-stats">
        <div class="stat-card">
            <h3>Enrolled Courses</h3>
            <p class="stat-number">{{ $enrolledCourses ?? 0 }}</p>
        </div>
        <div class="stat-card">
            <h3>Pending Assignments</h3>
            <p class="stat-number">{{ $pendingAssignments ?? 0 }}</p>
        </div>
        <div class="stat-card">
            <h3>Average Grade</h3>
            <p class="stat-number">{{ $averageGrade ?? 'N/A' }}</p>
        </div>
        <div class="stat-card">
            <h3>Attendance</h3>
            <p class="stat-number">{{ $attendanceRate ?? '0%' }}</p>
        </div>
    </div>

    <div class="dashboard-content">
        <h2>Welcome back, {{ Auth::user()->name ?? 'Student' }}!</h2>
        <p>Continue your learning journey.</p>
    </div>
@endsection
