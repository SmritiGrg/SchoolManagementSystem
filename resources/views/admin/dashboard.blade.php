@extends('layouts.dashboard')

@php
    $pageTitle = 'Admin Dashboard';
    $sidebarTitle = 'Admin Panel';
    $menuItems = [
        ['label' => 'Dashboard', 'url' => '#', 'icon' => 'icon-dashboard', 'active' => 'admin/dashboard'],
        ['label' => 'Users', 'url' => '#', 'icon' => 'icon-users', 'active' => 'admin/users*'],
        ['label' => 'Teachers', 'url' => '#', 'icon' => 'icon-teacher', 'active' => 'admin/teachers*'],
        ['label' => 'Students', 'url' => '#', 'icon' => 'icon-student', 'active' => 'admin/students*'],
        ['label' => 'Courses', 'url' => '#', 'icon' => 'icon-courses', 'active' => 'admin/courses*'],
        ['label' => 'Reports', 'url' => '#', 'icon' => 'icon-reports', 'active' => 'admin/reports*'],
        ['label' => 'Settings', 'url' => '#', 'icon' => 'icon-settings', 'active' => 'admin/settings*'],
    ];
@endphp

@section('content')
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
            <h3>Total Courses</h3>
            <p class="stat-number">{{ $totalCourses ?? 0 }}</p>
        </div>
    </div>

    <div class="dashboard-content">
        <h2>Welcome, Admin!</h2>
        <p>Manage your educational platform from here.</p>
    </div>
@endsection
