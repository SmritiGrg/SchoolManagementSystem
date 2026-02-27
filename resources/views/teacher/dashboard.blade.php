@extends('layouts.dashboard')

@php
    $pageTitle = 'Teacher Dashboard';
    $sidebarTitle = 'Teacher Portal';
    $menuItems = [
        ['label' => 'Dashboard', 'url' => '#', 'icon' => 'icon-dashboard', 'active' => 'teacher/dashboard'],
        ['label' => 'My Courses', 'url' => '#', 'icon' => 'icon-courses', 'active' => 'teacher/courses*'],
        ['label' => 'Students', 'url' => '#', 'icon' => 'icon-students', 'active' => 'teacher/students*'],
        ['label' => 'Assignments', 'url' => '#', 'icon' => 'icon-assignments', 'active' => 'teacher/assignments*'],
        ['label' => 'Grades', 'url' => '#', 'icon' => 'icon-grades', 'active' => 'teacher/grades*'],
        ['label' => 'Schedule', 'url' => '#', 'icon' => 'icon-schedule', 'active' => 'teacher/schedule*'],
        ['label' => 'Resources', 'url' => '#', 'icon' => 'icon-resources', 'active' => 'teacher/resources*'],
    ];
@endphp

@section('content')
    <div class="dashboard-stats">
        <div class="stat-card">
            <h3>My Courses</h3>
            <p class="stat-number">{{ $totalCourses ?? 0 }}</p>
        </div>
        <div class="stat-card">
            <h3>Total Students</h3>
            <p class="stat-number">{{ $totalStudents ?? 0 }}</p>
        </div>
        <div class="stat-card">
            <h3>Pending Grading</h3>
            <p class="stat-number">{{ $pendingGrading ?? 0 }}</p>
        </div>
        <div class="stat-card">
            <h3>Upcoming Classes</h3>
            <p class="stat-number">{{ $upcomingClasses ?? 0 }}</p>
        </div>
    </div>

    <div class="dashboard-content">
        <h2>Welcome, {{ Auth::user()->name ?? 'Teacher' }}!</h2>
        <p>Manage your classes and students.</p>
    </div>
@endsection
