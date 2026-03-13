@extends('layouts.dashboard')

@php
    $pageTitle = $pageTitle ?? 'Teacher Panel';
    $sidebarTitle = 'Teacher Panel';
    $menuItems = [
        [
            'label' => 'Dashboard',
            'url' => route('teacher.dashboard'),
            'icon' => 'dashboard',
            'active' => 'teacher/dashboard'
        ],
        [
            'label' => 'My Courses',
            'url' => route('teacher.courses'),
            'icon' => 'book',
            'active' => 'teacher/courses*'
        ],
        [
            'label' => 'Students',
            'url' => route('teacher.students'),
            'icon' => 'students',
            'active' => 'teacher/students*'
        ],
        [
            'label' => 'Assignments',
            'url' => '#',
            'icon' => 'assignments',
            'active' => 'teacher/assignments*'
        ],
        [
            'label' => 'Grades',
            'url' => '#',
            'icon' => 'grades',
            'active' => 'teacher/grades*'
        ],
        [
            'label' => 'Schedule',
            'url' => '#',
            'icon' => 'schedule',
            'active' => 'teacher/schedule*'
        ],
        [
            'label' => 'Resources',
            'url' => '#',
            'icon' => 'resources',
            'active' => 'teacher/resources*'
        ],
    ];
@endphp

@section('content')
    @yield('teacher-content')
@endsection