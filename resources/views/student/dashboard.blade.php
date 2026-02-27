@extends('layouts.dashboard')

@php
    $pageTitle = 'Student Dashboard';
    $sidebarTitle = 'Student Portal';
    $menuItems = [
        ['label' => 'Dashboard', 'url' => '#', 'icon' => 'icon-dashboard', 'active' => 'student/dashboard'],
        ['label' => 'My Courses', 'url' => '#', 'icon' => 'icon-courses', 'active' => 'student/courses*'],
        ['label' => 'Assignments', 'url' => '#', 'icon' => 'icon-assignments', 'active' => 'student/assignments*'],
        ['label' => 'Grades', 'url' => '#', 'icon' => 'icon-grades', 'active' => 'student/grades*'],
        ['label' => 'Schedule', 'url' => '#', 'icon' => 'icon-schedule', 'active' => 'student/schedule*'],
        ['label' => 'Resources', 'url' => '#', 'icon' => 'icon-resources', 'active' => 'student/resources*'],
    ];
@endphp

@section('content')
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
