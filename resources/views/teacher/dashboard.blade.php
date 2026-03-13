@extends('layouts.teacher')

@php $pageTitle = 'Teacher Dashboard'; @endphp


@section('teacher-content')
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
