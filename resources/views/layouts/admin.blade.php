@extends('layouts.dashboard')

@php
    $pageTitle = $pageTitle ?? 'Admin Panel';
    $sidebarTitle = 'Admin Panel';
    $menuItems = [
        [
            'label' => 'Dashboard',
            'url' => route('admin.dashboard'),
            'icon' => 'dashboard',
            'active' => 'admin/dashboard'
        ],
        [
            'label' => 'Users',
            'url' => '#',
            'icon' => 'users',
            'active' => 'admin/users*'
        ],
        [
            'label' => 'Teachers',
            'url' => route('admin.teacher.list'),
            'icon' => 'teacher',
            'active' => 'admin/teacher*'
        ],
        [
            'label' => 'Students',
            'url' => route('admin.student.list'),
            'icon' => 'students',
            'active' => 'admin/students*'
        ],
        [
            'label' => 'Subjects',
            'url' => route('admin.subject.list'),
            'icon' => 'book',
            'active' => 'admin/subject*'
        ],
        [
            'label' => 'Reports',
            'url' => '#',
            'icon' => 'chart',
            'active' => 'admin/reports*'
        ],
        [
            'label' => 'Settings',
            'url' => '#',
            'icon' => 'settings',
            'active' => 'admin/settings*'
        ],
    ];
@endphp

@section('content')
    @yield('admin-content')
@endsection