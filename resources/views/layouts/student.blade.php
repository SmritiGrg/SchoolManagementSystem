@extends('layouts.dashboard')

@php
    $pageTitle = $pageTitle ?? 'Student Portal';
    $sidebarTitle = 'Student Portal';
    $menuItems = [
        [
            'label' => 'Dashboard',
            'url' => route('student.dashboard'),
            'icon' => 'dashboard',
            'active' => 'student/dashboard'
        ],
        [
            'label' => 'My Profile',
            'url' => route('student.profile'),
            'icon' => 'students',
            'active' => 'student/profile'
        ],
        [
            'label' => 'My Courses',
            'url' => '#',
            'icon' => 'book',
            'active' => 'student/courses*'
        ],
        [
            'label' => 'Assignments',
            'url' => '#',
            'icon' => 'assignments',
            'active' => 'student/assignments*'
        ],
        [
            'label' => 'Grades',
            'url' => '#',
            'icon' => 'grades',
            'active' => 'student/grades*'
        ],
        [
            'label' => 'Schedule',
            'url' => '#',
            'icon' => 'schedule',
            'active' => 'student/schedule*'
        ],
    ];
@endphp

@section('content')
    @yield('student-content')
@endsection
