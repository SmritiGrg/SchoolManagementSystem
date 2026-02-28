@extends('layouts.admin')

@php $pageTitle = 'Admin Dashboard'; @endphp

@section('admin-content')
   <div class="dashboard-stats">
        <div class="stat-card">
            <h3>Total Users</h3>
            <p class="stat-number">{{ $totalUsers ?? 0 }}</p>
        </div>
        <div class="stat-card">
            <h3>Total Teachers</h3>
            <p class="stat-number">{{ $totalTeachers ?? 0 }}</p>
        </div>
        <div class="stat-card">
            <h3>Total Students</h3>
            <p class="stat-number">{{ $totalStudents ?? 0 }}</p>
        </div>
        <div class="stat-card">
            <h3>Total Subjects</h3>
            <p class="stat-number">{{ $totalSubjects ?? 0 }}</p>
        </div>
    </div>

    <div class="dashboard-content">
        <h2>Welcome, Admin!</h2>
        <p>Manage your educational platform from here.</p>
    </div>
@endsection